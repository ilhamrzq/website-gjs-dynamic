<?php

namespace App\Http\Controllers\Master;

use App\DataTables\Master\EventDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Event\EventImageRequest;
use App\Http\Requests\Master\EventRequest;
use App\Models\Event\EventImage;
use App\Models\Master\Event;
use App\Models\Master\Language;
use App\Models\Master\Venue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;

class EventController extends Controller
{
    public function index(EventDataTable $dataTable)
    {
        return $dataTable->render('venues.events.index', [
            'table_title' => 'Event Table',
            'add_button' => 'Add New Event',
            'action' => route('venues.events.create')
        ]);
    }

    public function create()
    {
        session(['activeTab' => 'eventData']);

        return view('venues.events.add-edit', [
            'action' => route('venues.events.store'),
            'action_back' => route('venues.events.index'),
            'title' => "Add New Venue",
            'event_images' => [],
            'venues' => Venue::active(),
            'languages' => Language::active()
        ]);
    }

    public function store(EventRequest $request, Event $event)
    {
        try {
            $user = Auth::user();
            $validated = $request->validated();

            $event = new Event();
            $event->lang_id = $validated['lang_id'];
            $event->venue_id = $validated['venue_id'];
            $event->event_title = $validated['event_title'];
            $event->event_slug = Str::slug($validated['event_title']);
            $event->event_description = $validated['event_description'];
            $event->event_content = $validated['event_content'];
            $event->event_start_date = $validated['event_start_date'];
            $event->event_end_date = $validated['event_end_date'];
            $event->event_status = $validated['event_status'];
            $event->created_by = $user->id;
            $event->updated_by = $user->id;
            $event->is_active = 1;
            $event->save();

            $encryptedId = Crypt::encrypt($event->id);
            return Redirect::route('venues.events.edit', $encryptedId)
                            ->with('success', 'The new event was added successfully')
                            ->with('activeTab', 'eventImages');

        } catch (\Throwable $e) {
            return responseError($e);
        }
    }

    public function editShow($encryptedId, $action, $title)
    {
        $event = getDecryptedModelId($encryptedId, Event::class);
        $eventImages = EventImage::imagesByEvent($event->id);
        $eventName = Event::where('id', $event->id)->pluck('event_title')->first();

        return view('venues.events.add-edit', [
            'action' => $action,
            'action_back' => route('venues.events.index'),
            'record' => $event,
            'title' => $title . ' ' . $event->event_title,
            'event_images' => $eventImages ?? '',
            'event_title' => $eventName,
            'venues' => Venue::active(),
            'languages' => Language::active(),
        ]);
    }

    public function show($encryptedId)
    {
        return $this->editShow($encryptedId, '', 'Detail Event');
    }

    public function edit($encryptedId)
    {
        return $this->editShow($encryptedId, route('venues.events.update', $encryptedId), 'Edit Event');
    }

    public function update(EventRequest $request, $encryptedId)
    {
        try {
            $user = Auth::user();
            $validated = $request->validated();
            $data = getDecryptedModelId($encryptedId, Event::class);
            
            $event = Event::find($data->id);
            $event->lang_id = $validated['lang_id'];
            $event->venue_id = $validated['venue_id'];
            $event->event_title = $validated['event_title'];
            $event->event_slug = Str::slug($validated['event_title']);
            $event->event_description = $validated['event_description'];
            $event->event_content = $validated['event_content'];
            $event->event_start_date = $validated['event_start_date'];
            $event->event_end_date = $validated['event_end_date'];
            $event->event_status = $validated['event_status'];
            $event->updated_by = $user->id;
            $event->is_active = 1;
            $event->save();

            return responseSuccess('update', route('venues.events.index'));

        } catch (\Throwable $e) {
            return responseError($e);
        }
    }

    public function destroy($encryptedId)
    {
        try {
            $user = Auth::user();
            $data = getDecryptedModelId($encryptedId, Event::class);
            $menu = Event::find($data->id);

            $menu->deleted_by = $user->id;
            $menu->is_active = 0;
            $menu->save();
            $menu->delete();
            return responseSuccess('delete', route('venues.events.index'));
        } catch (\Throwable $e) {
            return responseError($e);
        }
    }

    public function multipleDestroy(Request $request)
    {
        try {
            DB::beginTransaction();
            if (!Auth::user()->can('delete venues/events')) {
                return response()->json([
                    'status' => 'error',
                    'status_code' => 401,
                    'message' => "This user do not have permission to delete event"
                ], 401);
            }

            $user = Auth::user();
            $validated = $request->validate([
                'ids' => ['required', 'array', 'min:1'],
                'ids.*' => ['integer', 'distinct']
            ]);

            $datas = $validated['ids'];
            foreach ($datas as $id) {
                $event = Event::find($id);
                $event->deleted_by = Auth::user()->id;
                $event->is_active = 0;
                $event->save();
                $event->delete();

                $images = EventImage::where('event_id', $id)->get();
                foreach ($images as $image) {
                    $eventImage = EventImage::find($image->id);
                    $eventImage->deleted_by = $user->id;
                    $eventImage->is_active = 0;
                    $eventImage->save();
                    $eventImage->delete();
                }
            }

            DB::commit();
            return responseJsonSuccess("Event data has been successfully deleted");
        } catch (\Throwable $e) {
            DB::rollBack();
            return responseJsonError($e);
        }
    }

    public function uploadEditorImage(Request $request)
    {
        if ($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName . '_' . time() . '.' . $extension;
            $request->file('upload')->move(public_path('assets/pbc/images/events/ckeditor/'), $fileName);
            $url = asset('assets/pbc/images/events/ckeditor/' . $fileName);

            return response()->json(['fileName' => $fileName, 'uploaded'=> 1, 'url' => $url]);
        }
    }

    public function uploadImages(EventImageRequest $request)
    {
        $validated = $request->validated();
        $files = $validated['file'];
        $user = Auth::user();
        $encryptedId = $request->input('encrypted');
        $data = getDecryptedModelId($encryptedId, Event::class);
        $event = Event::find($data->id);
        $eventName = $event->event_title;

        $basePath = public_path("assets/pbc/images/events/cover/" . implode("_", explode(" ", strtolower($eventName))));

        if (!File::exists($basePath)) {
            File::makeDirectory($basePath, 0755, true, true);
            // 0755 permission file buat linux 
            // awalan, mendanakan oktal
            // 7 (Read, Write, Execute - Owner; 
            // 5 Read, Execute - Group; 
            // 5 Read, Execute - Others)

            // true, artinya bisa membuat folder secara recursive (kalo subfolder di dalam basePath belom ada, nanti bakalan dibuat sama laravel)
            // agar Laravel tidak error jika folder sudah ada.
        }

        foreach ($files as $file) {
            $newImage = EventImage::create([
                'event_id' => $event->id,
                'file_path' => '',
                'file_name' => '',
                'file_size' => 0, 
                'is_default' => 0,
                'is_active' => 1,
                'created_by' => $user->id,
                'updated_by' => $user->id,
            ]);

            $idFormatted = str_pad($newImage->id, 6, '0', STR_PAD_LEFT);
            $extension = $file->getClientOriginalExtension();
            $fileName = "{$idFormatted}.{$extension}";

            $file->move($basePath, $fileName);
            $filePath = "assets/pbc/images/events/cover/" . implode("_", explode(" ", strtolower($eventName))) . "/" . $fileName;
            $fileSize = filesize($basePath . "/" . $fileName);

            // Update record dengan info file lengkap
            $newImage->update([
                'file_path' => $filePath,
                'file_name' => $fileName,
                'file_size' => $fileSize,
            ]);
        }

        session(['activeTab' => 'eventImages']);
        return redirect()->back();
    }

    public function updateDefaultImage(Request $request, $imageId)
    {
        try {
            $encryptedId = $request->input('encrypted');
            $data = getDecryptedModelId($encryptedId, Event::class);
            $imageDefault = EventImage::where('event_id', $data->id)->where('is_default', true)->first();

            if ($imageDefault) {
                $imageDefault->is_default = false;
                $imageDefault->updated_by = Auth::user()->id;
                $imageDefault->save();
            }

            $image = EventImage::find($imageId);
            if ($image) {
                $image->is_default = $request->is_default;
                $image->updated_by = Auth::user()->id;
                $image->save();
            }

            session(['activeTab' => 'EventImage']);
            return response()->json([
                'success' => true,
                'status_code' => 200,
                'message' => 'Image cover updated successfully'
            ], 200);
        } catch (\Throwable $e) {
            session(['activeTab' => 'EventImage']);
            return response()->json([
                'success' => false,
                'status_code' => 500,
                'message' => 'Failed to updated status'
            ], 500);
        }
    }

    public function deleteEventImage(Request $request, $imageId)
    {
        try {
            $imageId = $request->segment(3);
            $user = Auth::user();
            $image = EventImage::find($imageId);
            $image->deleted_by = $user->id;
            $image->is_active = 0;
            $image->save();
            $image->delete();

            session(['activeTab' => 'eventImages']);
            return redirect()->back()->with('success', 'Event image has been deleted successfully');
        } catch (\Throwable $e) {
            return responseError($e);
        }
    }
}
