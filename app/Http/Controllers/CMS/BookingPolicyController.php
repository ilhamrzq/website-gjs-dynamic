<?php

namespace App\Http\Controllers\CMS;

use App\DataTables\CMS\BookingPolicyDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\CMS\BookingPolicyRequest;
use App\Models\CMS\BookingPolicy;
use App\Models\Master\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;

class BookingPolicyController extends Controller
{
    public function index(BookingPolicyDataTable $dataTable)
    {
        return $dataTable->render('cms.booking-policies.index', [
            'table_title' => 'Booking Policy Table',
            'add_button' => 'Add New Booking Policy',
            'action' => route('cms.booking-policies.create')
        ]);
    }

    public function create()
    {
        session(['activeTab' => 'policyData']);
        return view('cms.booking-policies.add-edit', [
            'action' => route('cms.booking-policies.store'),
            'action_back' => route('cms.booking-policies.index'),
            'title' => "Add New Booking Policy",
            'languages' => Language::active()
        ]);
    }

    public function store(BookingPolicyRequest $request, BookingPolicy $policy)
    {
        try {
            $user = Auth::user();
            $validated = $request->validated();

            $policy = new BookingPolicy();
            $policy->lang_id = $validated['lang_id'];
            $policy->policy_description = $validated['policy_description'];
            $policy->created_by = $user->id;
            $policy->updated_by = $user->id;
            $policy->is_active = 1;
            $policy->save();

            $encryptedId = Crypt::encrypt($policy->id);
            return Redirect::route('cms.booking-policies.index', $encryptedId)
                            ->with('success', 'The new booking policy was added successfully');

        } catch (\Throwable $e) {
            return responseError($e);
        }
    }

    public function editShow($encryptedId, $action, $title)
    {
        $policy = getDecryptedModelId($encryptedId, BookingPolicy::class);
        $policyName = BookingPolicy::where('id', $policy->id)->pluck('policy_description')->first();

        return view('cms.booking-policies.add-edit', [
            'action' => $action,
            'action_back' => route('cms.booking-policies.index'),
            'record' => $policy,
            'title' => $title . ' ' . $policyName,
            'policy_name' => $policyName,
            'languages' => Language::active()
        ]);
    }

    public function show($encryptedId)
    {
        return $this->editShow($encryptedId, '', 'Detail Booking Policy');
    }

    public function edit($encryptedId)
    {
        return $this->editShow($encryptedId, route('cms.booking-policies.update', $encryptedId), 'Edit Booking Policy');
    }

    public function update(BookingPolicyRequest $request, $encryptedId)
    {
        try {
            $user = Auth::user();
            $validated = $request->validated();
            $data = getDecryptedModelId($encryptedId, BookingPolicy::class);
            $policy = BookingPolicy::find($data->id);

            $policy->lang_id = $validated['lang_id'];
            $policy->policy_description = $validated['policy_description'];
            $policy->updated_by = $user->id;
            $policy->is_active = 1;
            $policy->save();

            return responseSuccess('update', route('cms.booking-policies.index'));

        } catch (\Throwable $e) {
            return responseError($e);
        }
    }

    public function destroy($encryptedId)
    {
        try {
            $user = Auth::user();
            $data = getDecryptedModelId($encryptedId, BookingPolicy::class);
            $policy = BookingPolicy::find($data->id);

            $policy->deleted_by = $user->id;
            $policy->is_active = 0;
            $policy->save();
            $policy->delete();
            return responseSuccess('delete', route('cms.booking-policies.index'));
        } catch (\Throwable $e) {
            return responseError($e);
        }
    }

    public function multipleDestroy(Request $request)
    {
        try {
            DB::beginTransaction();
            if (!Auth::user()->can('delete cms/booking-policies')) {
                return response()->json([
                    'status' => 'error',
                    'status_code' => 401,
                    'message' => "This user do not have permission to delete Booking Policy"
                ], 401);
            }

            $user = Auth::user();
            $validated = $request->validate([
                'ids' => ['required', 'array', 'min:1'],
                'ids.*' => ['integer', 'distinct']
            ]);

            $datas = $validated['ids'];
            foreach ($datas as $id) {
                $policy = BookingPolicy::find($id);
                $policy->deleted_by = Auth::user()->id;
                $policy->is_active = 0;
                $policy->save();
                $policy->delete();
            }

            DB::commit();
            return responseJsonSuccess("Booking Policy data has been successfully deleted");
        } catch (\Throwable $e) {
            DB::rollBack();
            return responseJsonError($e);
        }
    }
}
