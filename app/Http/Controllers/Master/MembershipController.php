<?php

namespace App\Http\Controllers\Master;

use App\DataTables\Master\MembershipDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Master\MembershipRequest;
use App\Models\Master\Membership;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class MembershipController extends Controller
{
    public function signPage()
    {
        $memberships = Membership::active()->get()->map(function ($membership) {
            return [
                'id' => Crypt::encrypt($membership->id),
                'membership_name' => $membership->membership_name,
                'membership_price' => $membership->membership_price,
                'membership_description' => $membership->membership_description,
                'membership_color' => $membership->membership_color,
            ];
        });

        return Inertia::render('SignUp/index', [
            'title' => 'Sign Up',
            'memberships' => $memberships,
        ]);
    }

    public function index(MembershipDataTable $dataTable)
    {
        // dd(Auth::user()->getAllPermissions()->pluck('name'));

        return $dataTable->render('memberships.type.index', [
            'table_title' => 'Memberships Table',
            'add_button' => 'Add New Membership',
            'action' => route('memberships.type.create')
        ]);
    }

    public function create()
    {
        session(['activeTab' => 'membershipData']);
        return view('memberships.type.add-edit', [
            'action' => route('memberships.type.store'),
            'action_back' => route('memberships.type.index'),
            'title' => "Add New Membership",
        ]);
    }

    public function store(MembershipRequest $request, Membership $membership)
    {
        try {
            $user = Auth::user();
            $validated = $request->validated();

            $membership = new Membership();
            $membership->membership_name = $validated['membership_name'];
            $membership->membership_description= $validated['membership_description'];
            $membership->membership_price = $validated['membership_price'];
            $membership->membership_color = $validated['membership_color'];
            $membership->created_by = $user->id;
            $membership->updated_by = $user->id;
            $membership->is_active = 1;
            $membership->save();

            $encryptedId = Crypt::encrypt($membership->id);
            return Redirect::route('memberships.type.index', $encryptedId)
                            ->with('success', 'The new membership was added successfully');

        } catch (\Throwable $e) {
            return responseError($e);
        }
    }

    public function editShow($encryptedId, $action, $title)
    {
        $membership = getDecryptedModelId($encryptedId, Membership::class);
        $membershipName = Membership::where('id', $membership->id)->pluck('membership_name')->first();

        return view('memberships.type.add-edit', [
            'action' => $action,
            'action_back' => route('memberships.type.index'),
            'record' => $membership,
            'title' => $membershipName,
        ]);
    }

    public function show($encryptedId)
    {
        return $this->editShow($encryptedId, '', 'Detail Membership');
    }

    public function edit($encryptedId)
    {
        return $this->editShow($encryptedId, route('memberships.type.update', $encryptedId), 'Edit Membership');
    }

    public function update(MembershipRequest $request, $encryptedId)
    {
        try {
            $user = Auth::user();
            $validated = $request->validated();
            $data = getDecryptedModelId($encryptedId, Membership::class);
            $membership = Membership::find($data->id);

            $membership->membership_name = $validated['membership_name'];
            $membership->membership_description= $validated['membership_description'];
            $membership->membership_price = $validated['membership_price'];
            $membership->membership_color = $validated['membership_color'];
            $membership->updated_by = $user->id;
            $membership->is_active = 1;
            $membership->save();

            return responseSuccess('update', route('memberships.type.index'));

        } catch (\Throwable $e) {
            return responseError($e);
        }
    }

    public function destroy($encryptedId)
    {
        try {
            $user = Auth::user();
            $data = getDecryptedModelId($encryptedId, Membership::class);
            $menu = Membership::find($data->id);

            $menu->deleted_by = $user->id;
            $menu->is_active = 0;
            $menu->save();
            $menu->delete();
            return responseSuccess('delete', route('memberships.type.index'));
        } catch (\Throwable $e) {
            return responseError($e);
        }
    }

    public function multipleDestroy(Request $request)
    {
        try {
            DB::beginTransaction();
            if (!Auth::user()->can('delete memberships/type')) {
                return response()->json([
                    'status' => 'error',
                    'status_code' => 401,
                    'message' => "This user do not have permission to delete Memberships"
                ], 401);
            }

            $user = Auth::user();
            $validated = $request->validate([
                'ids' => ['required', 'array', 'min:1'],
                'ids.*' => ['integer', 'distinct']
            ]);

            $datas = $validated['ids'];
            foreach ($datas as $id) {
                $membership = Membership::find($id);
                $membership->deleted_by = Auth::user()->id;
                $membership->is_active = 0;
                $membership->save();
                $membership->delete();
            }

            DB::commit();
            return responseJsonSuccess("Memberships data has been successfully deleted");
        } catch (\Throwable $e) {
            DB::rollBack();
            return responseJsonError($e);
        }
    }
}
