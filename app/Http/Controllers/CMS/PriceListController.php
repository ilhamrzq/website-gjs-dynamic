<?php

namespace App\Http\Controllers\CMS;

use App\DataTables\CMS\PriceListDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\CMS\PriceListRequest;
use App\Models\CMS\PriceList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;

class PriceListController extends Controller
{
    public function index(PriceListDataTable $dataTable)
    {
        return $dataTable->render('cms.price-lists.index', [
            'table_title' => 'Price List Table',
            'add_button' => 'Add New Price List',
            'action' => route('cms.price-lists.create')
        ]);
    }

    public function create()
    {
        session(['activeTab' => 'listData']);
        return view('cms.price-lists.add-edit', [
            'action' => route('cms.price-lists.store'),
            'action_back' => route('cms.price-lists.index'),
            'title' => "Add New Price List",
        ]);
    }

    public function store(PriceListRequest $request, PriceList $list)
    {
        try {
            $user = Auth::user();
            $validated = $request->validated();

            $list = new PriceList();
            $list->price_name = $validated['price_name'];
            $list->price_normal = $validated['price_normal'];
            $list->price_promo = $validated['price_promo'];
            $list->created_by = $user->id;
            $list->updated_by = $user->id;
            $list->is_active = 1;
            $list->save();

            $encryptedId = Crypt::encrypt($list->id);
            return Redirect::route('cms.price-lists.index', $encryptedId)
                            ->with('success', 'The new price list was added successfully');

        } catch (\Throwable $e) {
            return responseError($e);
        }
    }

    public function editShow($encryptedId, $action, $title)
    {
        $list = getDecryptedModelId($encryptedId, PriceList::class);
        $listName = PriceList::where('id', $list->id)->pluck('price_name')->first();

        return view('cms.price-lists.add-edit', [
            'action' => $action,
            'action_back' => route('cms.price-lists.index'),
            'record' => $list,
            'title' => $title . ' ' . $listName,
            'profile_name' => $listName,
        ]);
    }

    public function show($encryptedId)
    {
        return $this->editShow($encryptedId, '', 'Detail Price List');
    }

    public function edit($encryptedId)
    {
        return $this->editShow($encryptedId, route('cms.price-lists.update', $encryptedId), 'Edit Price List');
    }

    public function update(PriceListRequest $request, $encryptedId)
    {
        try {
            $user = Auth::user();
            $validated = $request->validated();
            $data = getDecryptedModelId($encryptedId, PriceList::class);
            $list = PriceList::find($data->id);

            $list->price_name = $validated['price_name'];
            $list->price_normal = $validated['price_normal'];
            $list->price_promo = $validated['price_promo'];
            $list->updated_by = $user->id;
            $list->is_active = 1;
            $list->save();

            return responseSuccess('update', route('cms.price-lists.index'));

        } catch (\Throwable $e) {
            return responseError($e);
        }
    }

    public function destroy($encryptedId)
    {
        try {
            $user = Auth::user();
            $data = getDecryptedModelId($encryptedId, PriceList::class);
            $list = PriceList::find($data->id);

            $list->deleted_by = $user->id;
            $list->is_active = 0;
            $list->save();
            $list->delete();
            return responseSuccess('delete', route('cms.price-lists.index'));
        } catch (\Throwable $e) {
            return responseError($e);
        }
    }

    public function multipleDestroy(Request $request)
    {
        try {
            DB::beginTransaction();
            if (!Auth::user()->can('delete cms/price-lists')) {
                return response()->json([
                    'status' => 'error',
                    'status_code' => 401,
                    'message' => "This user do not have permission to delete Price List"
                ], 401);
            }

            $user = Auth::user();
            $validated = $request->validate([
                'ids' => ['required', 'array', 'min:1'],
                'ids.*' => ['integer', 'distinct']
            ]);

            $datas = $validated['ids'];
            foreach ($datas as $id) {
                $list = PriceList::find($id);
                $list->deleted_by = Auth::user()->id;
                $list->is_active = 0;
                $list->save();
                $list->delete();
            }

            DB::commit();
            return responseJsonSuccess("Price List data has been successfully deleted");
        } catch (\Throwable $e) {
            DB::rollBack();
            return responseJsonError($e);
        }
    }
}
