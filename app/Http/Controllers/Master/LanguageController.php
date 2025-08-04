<?php

namespace App\Http\Controllers\Master;

use App\DataTables\Master\LanguageDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Master\LanguageRequest;
use App\Models\Master\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;

class LanguageController extends Controller
{
    public function index(LanguageDataTable $dataTable)
    {
        return $dataTable->render('master.languages.index', [
            'table_title' => 'Language Table',
            'add_button' => 'Add New Language',
            'action' => route('master.languages.create')
        ]);
    }

    public function create()
    {
        session(['activeTab' => 'languageData']);
        return view('master.languages.add-edit', [
            'action' => route('master.languages.store'),
            'action_back' => route('master.languages.index'),
            'title' => "Add New Language",
        ]);
    }

    public function store(LanguageRequest $request, Language $language)
    {
        try {
            $user = Auth::user();
            $validated = $request->validated();

            $language = new Language();
            $language->language_name = $validated['language_name'];
            $language->language_code = $validated['language_code'];
            $language->created_by = $user->id;
            $language->updated_by = $user->id;
            $language->is_active = 1;
            $language->save();

            $encryptedId = Crypt::encrypt($language->id);
            return Redirect::route('master.languages.index', $encryptedId)
                            ->with('success', 'The new language was added successfully');

        } catch (\Throwable $e) {
            return responseError($e);
        }
    }

    public function editShow($encryptedId, $action, $title)
    {
        $language = getDecryptedModelId($encryptedId, Language::class);
        $languageName = Language::where('id', $language->id)->pluck('language_name')->first();

        return view('master.languages.add-edit', [
            'action' => $action,
            'action_back' => route('master.languages.index'),
            'record' => $language,
            'title' => $title . ' ' . $languageName,
            'language_name' => $languageName,
        ]);
    }

    public function show($encryptedId)
    {
        return $this->editShow($encryptedId, '', 'Detail Language');
    }

    public function edit($encryptedId)
    {
        return $this->editShow($encryptedId, route('master.languages.update', $encryptedId), 'Edit Language');
    }

    public function update(LanguageRequest $request, $encryptedId)
    {
        try {
            $user = Auth::user();
            $validated = $request->validated();
            $data = getDecryptedModelId($encryptedId, Language::class);
            $language = Language::find($data->id);

            $language->language_name = $validated['language_name'];
            $language->language_code = $validated['language_code'];
            $language->updated_by = $user->id;
            $language->is_active = 1;
            $language->save();

            return responseSuccess('update', route('master.languages.index'));

        } catch (\Throwable $e) {
            return responseError($e);
        }
    }

    public function destroy($encryptedId)
    {
        try {
            $user = Auth::user();
            $data = getDecryptedModelId($encryptedId, Language::class);
            $language = Language::find($data->id);

            $language->deleted_by = $user->id;
            $language->is_active = 0;
            $language->save();
            $language->delete();
            return responseSuccess('delete', route('master.languages.index'));
        } catch (\Throwable $e) {
            return responseError($e);
        }
    }

    public function multipleDestroy(Request $request)
    {
        try {
            DB::beginTransaction();
            if (!Auth::user()->can('delete master/languages')) {
                return response()->json([
                    'status' => 'error',
                    'status_code' => 401,
                    'message' => "This user do not have permission to delete language"
                ], 401);
            }

            $user = Auth::user();
            $validated = $request->validate([
                'ids' => ['required', 'array', 'min:1'],
                'ids.*' => ['integer', 'distinct']
            ]);

            $datas = $validated['ids'];
            foreach ($datas as $id) {
                $language = Language::find($id);
                $language->deleted_by = Auth::user()->id;
                $language->is_active = 0;
                $language->save();
                $language->delete();
            }

            DB::commit();
            return responseJsonSuccess("Language data has been successfully deleted");
        } catch (\Throwable $e) {
            DB::rollBack();
            return responseJsonError($e);
        }
    }
}
