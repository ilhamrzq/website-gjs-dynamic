<?php

namespace App\Http\Controllers\Master;

use App\DataTables\Master\BilliardTableCategoryDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Master\BilliardTableCategoryRequest;
use App\Models\Master\BilliardTableCategory;
use App\Models\Master\TableDiscountType;
use App\Models\Master\TablePriceType;
use App\Models\Master\Venue;
use App\Models\Relation\RelTableDiscount;
use App\Models\Relation\RelTablePrice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class BilliardTableCategoryController extends Controller
{
    public function index(BilliardTableCategoryDataTable $dataTable)
    {
        return $dataTable->render('tables.categories.index', [
            'table_title' => 'Billiard Table Categories Table',
            'add_button' => 'Add New Billiard Table Category',
            'action' => route('tables.categories.create')
        ]);
    }

    public function create()
    {
        session(['activeTab' => 'tableCategoryData']);
        return view('tables.categories.add-edit', [
            'action' => route('tables.categories.store'),
            'action_back' => route('tables.categories.index'),
            'title' => "Add New Billiard Table Category",
            'venues' => Venue::active(),
            'price_types' => TablePriceType::active(),
            'discount_types' => TableDiscountType::active(),
        ]);
    }

    public function store(BilliardTableCategoryRequest $request, BilliardTableCategory $tableCategory)
    {
        try {
            $user = Auth::user();
            $validated = $request->validated();

            $tableCategory = new BilliardTableCategory();
            $tableCategory->venue_id = $validated['venue_id'];
            $tableCategory->table_category_name = $validated['table_category_name'];
            $tableCategory->table_category_description = $validated['table_category_name'];
            $tableCategory->created_by = $user->id;
            $tableCategory->updated_by = $user->id;
            $tableCategory->is_active = 1;
            $tableCategory->save();

            $priceData = $validated['price_data'] ?? [];

            foreach ($priceData as $key => $price) {
                // Extract price_type_id from the key (e.g., "1_Retail_Price" => 10000)
                $priceTypeId = explode('_', $key)[0]; // Get the ID part

                RelTablePrice::create([
                    'table_category_id' => $tableCategory->id,
                    'price_type_id' => $priceTypeId,
                    'price' => $price,
                    'created_by' => $user->id,
                    'updated_by' => $user->id,
                    'is_active' => 1,
                ]);
            }

            $discountData = $validated['discount_data'] ?? [];

            foreach ($discountData as $key => $discount) {
                // Extract discount_type_id from the key (e.g., "1_Retail_Discount" => 10000)
                $discountTypeId = explode('_', $key)[0]; // Get the ID part

                RelTableDiscount::create([
                    'table_category_id' => $tableCategory->id,
                    'discount_type_id' => $discountTypeId,
                    'discount' => $discount,
                    'created_by' => $user->id,
                    'updated_by' => $user->id,
                    'is_active' => 1,
                ]);
            }

            $encryptedId = Crypt::encrypt($tableCategory->id);
            return Redirect::route('tables.categories.index', $encryptedId)
                            ->with('success', 'The new billiard table category was added successfully');

        } catch (\Throwable $e) {
            return responseError($e);
        }
    }

    public function editShow($encryptedId, $action, $title)
    {
        $tableCategory = getDecryptedModelId($encryptedId, BilliardTableCategory::class);
        $tableCategoryName = BilliardTableCategory::where('id', $tableCategory->id)->pluck('table_category_name')->first();

        $tablePrices = RelTablePrice::where('table_category_id', $tableCategory->id)->get();

        $priceData = [];
        foreach ($tablePrices as $price) {
            $key = $price->price_type_id . '_' . str_replace(' ', '_', $price->priceType->price_type_name);
            $priceData[$key] = $price->price;
        }

        $productDiscounts = RelTableDiscount::where('table_category_id', $tableCategory->id)->get();

        $discountData = [];
        foreach ($productDiscounts as $discount) {
            $key = $discount->discount_type_id . '_' . str_replace(' ', '_', $discount->discountType->discount_type_name);
            $discountData[$key] = $discount->discount;
        }

        return view('tables.categories.add-edit', [
            'action' => $action,
            'action_back' => route('tables.categories.index'),
            'record' => $tableCategory,
            'title' => $tableCategoryName,
            'venues' => Venue::active(),
            'price_types' => TablePriceType::active(),
            'discount_types' => TableDiscountType::active(),
            'price_data' => $priceData,
            'discount_data' => $discountData,
        ]);
    }

    public function show($encryptedId)
    {
        return $this->editShow($encryptedId, '', 'Detail billiard table category');
    }

    public function edit($encryptedId)
    {
        return $this->editShow($encryptedId, route('tables.categories.update', $encryptedId), 'Edit billiard table category');
    }

    public function update(BilliardTableCategoryRequest $request, $encryptedId)
    {
        try {
            $user = Auth::user();
            $validated = $request->validated();
            $data = getDecryptedModelId($encryptedId, BilliardTableCategory::class);
            $tableCategory = BilliardTableCategory::find($data->id);

            $tableCategory->venue_id = $validated['venue_id'];
            $tableCategory->table_category_name = $validated['table_category_name'];
            $tableCategory->table_category_description = $validated['table_category_description'];
            $tableCategory->updated_by = $user->id;
            $tableCategory->is_active = 1;
            $tableCategory->save();

            $priceData = $validated['price_data'] ?? [];

            foreach ($priceData as $key => $price) {
                if (!is_numeric($price)) continue;
                // Extract price_type_id from the key (e.g., "1_Retail_Price" => 10000)
                $priceTypeId = explode('_', $key)[0]; // Get the ID part

                RelTablePrice::create([
                    'table_category_id' => $tableCategory->id,
                    'price_type_id' => $priceTypeId,
                    'price' => $price,
                    'created_by' => $user->id,
                    'updated_by' => $user->id,
                    'is_active' => 1,
                ]);
            }

            $discountData = $validated['discount_data'] ?? [];

            foreach ($discountData as $key => $discount) {
                if (!is_numeric($discount)) continue;
                // Extract discount_type_id from the key (e.g., "1_Retail_Price" => 10000)
                $discountTypeId = explode('_', $key)[0]; // Get the ID part

                RelTableDiscount::create([
                    'table_category_id' => $tableCategory->id,
                    'discount_type_id' => $discountTypeId,
                    'discount' => $discount,
                    'created_by' => $user->id,
                    'updated_by' => $user->id,
                    'is_active' => 1,
                ]);
            }

            return responseSuccess('update', route('tables.categories.index'));

        } catch (\Throwable $e) {
            return responseError($e);
        }
    }

    public function destroy($encryptedId)
    {
        try {
            $user = Auth::user();
            $data = getDecryptedModelId($encryptedId, BilliardTableCategory::class);
            $menu = BilliardTableCategory::find($data->id);

            $menu->deleted_by = $user->id;
            $menu->is_active = 0;
            $menu->save();
            $menu->delete();
            return responseSuccess('delete', route('tables.categories.index'));
        } catch (\Throwable $e) {
            return responseError($e);
        }
    }

    public function multipleDestroy(Request $request)
    {
        try {
            DB::beginTransaction();
            if (!Auth::user()->can('delete tables/categories')) {
                return response()->json([
                    'status' => 'error',
                    'status_code' => 401,
                    'message' => "This user do not have permission to delete billiard table category"
                ], 401);
            }

            $user = Auth::user();
            $validated = $request->validate([
                'ids' => ['required', 'array', 'min:1'],
                'ids.*' => ['integer', 'distinct']
            ]);

            $datas = $validated['ids'];
            foreach ($datas as $id) {
                $tableCategory = BilliardTableCategory::find($id);
                $tableCategory->deleted_by = Auth::user()->id;
                $tableCategory->is_active = 0;
                $tableCategory->save();
                $tableCategory->delete();
            }

            DB::commit();
            return responseJsonSuccess("Billiard table category data has been successfully deleted");
        } catch (\Throwable $e) {
            DB::rollBack();
            return responseJsonError($e);
        }
    }
}
