<?php

namespace App\Http\Controllers\CMS;

use App\DataTables\CMS\CompanyProfileDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\CMS\CompanyProfileRequest;
use App\Models\CMS\CompanyProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;


class CompanyProfileController extends Controller
{
    public function index(CompanyProfileDataTable $dataTable)
    {
        return $dataTable->render('cms.profile.index', [
            'table_title' => 'Company Profile Table',
            'add_button' => 'Add New Company Profile',
            'action' => route('cms.profile.create')
        ]);
    }

    public function create()
    {
        session(['activeTab' => 'profileData']);
        return view('cms.profile.add-edit', [
            'action' => route('cms.profile.store'),
            'action_back' => route('cms.profile.index'),
            'title' => "Add New Company Profile",
            "hero_images" => [],
        ]);
    }

    public function store(CompanyProfileRequest $request, CompanyProfile $profile)
    {
        try {
            $user = Auth::user();
            $validated = $request->validated();

            $phone = $validated['company_phone_number'];
            if (str_starts_with($phone, '0')) {
                $phone = '62' . substr($phone, 1);
            }

            $profile = new CompanyProfile();
            $profile->company_email = $validated['company_email'];
            $profile->company_address = $validated['company_address'];
            $profile->company_iframe_maps_url = $validated['company_iframe_maps_url'];
            $profile->company_phone_number = $phone;
            $profile->created_by = $user->id;
            $profile->updated_by = $user->id;
            $profile->is_active = 1;
            $profile->save();

            $encryptedId = Crypt::encrypt($profile->id);
            return Redirect::route('cms.profile.index', $encryptedId)
                            ->with('success', 'The new company profile was added successfully');

        } catch (\Throwable $e) {
            return responseError($e);
        }
    }

    public function editShow($encryptedId, $action, $title)
    {
        $profile = getDecryptedModelId($encryptedId, CompanyProfile::class);
        $profileName = CompanyProfile::where('id', $profile->id)->pluck('company_email')->first();

        return view('cms.profile.add-edit', [
            'action' => $action,
            'action_back' => route('cms.profile.index'),
            'record' => $profile,
            'title' => $title . ' ' . $profileName,
            'profile_name' => $profileName,
        ]);
    }

    public function show($encryptedId)
    {
        return $this->editShow($encryptedId, '', 'Detail Company Profile');
    }

    public function edit($encryptedId)
    {
        return $this->editShow($encryptedId, route('cms.profile.update', $encryptedId), 'Edit Company Profile');
    }

    public function update(CompanyProfileRequest $request, $encryptedId)
    {
        try {
            $user = Auth::user();
            $validated = $request->validated();
            $data = getDecryptedModelId($encryptedId, CompanyProfile::class);
            $profile = CompanyProfile::find($data->id);

            $phone = $validated['company_phone_number'];
            if (str_starts_with($phone, '0')) {
                $phone = '62' . substr($phone, 1);
            }

            $profile->company_email = $validated['company_email'];
            $profile->company_address = $validated['company_address'];
            $profile->company_iframe_maps_url = $validated['company_iframe_maps_url'];
            $profile->company_phone_number = $phone;
            $profile->updated_by = $user->id;
            $profile->is_active = 1;
            $profile->save();

            return responseSuccess('update', route('cms.profile.index'));

        } catch (\Throwable $e) {
            return responseError($e);
        }
    }

    public function destroy($encryptedId)
    {
        try {
            $user = Auth::user();
            $data = getDecryptedModelId($encryptedId, CompanyProfile::class);
            $profile = CompanyProfile::find($data->id);

            $profile->deleted_by = $user->id;
            $profile->is_active = 0;
            $profile->save();
            $profile->delete();
            return responseSuccess('delete', route('cms.profile.index'));
        } catch (\Throwable $e) {
            return responseError($e);
        }
    }

    public function multipleDestroy(Request $request)
    {
        try {
            DB::beginTransaction();
            if (!Auth::user()->can('delete cms/profile')) {
                return response()->json([
                    'status' => 'error',
                    'status_code' => 401,
                    'message' => "This user do not have permission to delete company profile"
                ], 401);
            }

            $user = Auth::user();
            $validated = $request->validate([
                'ids' => ['required', 'array', 'min:1'],
                'ids.*' => ['integer', 'distinct']
            ]);

            $datas = $validated['ids'];
            foreach ($datas as $id) {
                $profile = CompanyProfile::find($id);
                $profile->deleted_by = Auth::user()->id;
                $profile->is_active = 0;
                $profile->save();
                $profile->delete();
            }

            DB::commit();
            return responseJsonSuccess("Company profile data has been successfully deleted");
        } catch (\Throwable $e) {
            DB::rollBack();
            return responseJsonError($e);
        }
    }
}
