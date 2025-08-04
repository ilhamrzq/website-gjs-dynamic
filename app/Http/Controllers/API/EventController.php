<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\Event\EventCollection;
use App\Models\Master\Event;
use Illuminate\Http\Request;
use Inertia\Inertia;

class EventController extends Controller
{
    public function eventsByStatus()
    {
        $allowedStatuses = ['NEWS', 'COMING_SOON'];

        $status = strtoupper(request()->query('status', 'NEWS'));

        $lang_id = request()->query('lang_id', 1);

        if (!in_array($status, $allowedStatuses)) {
            return response()->json([
                'message' => "Invalid event status: $status",
            ], 400);
        }

        $limit = request()->query('limit', 5);
        $limit = is_numeric($limit) && $limit > 0 ? min($limit, 100) : 5;

        $events = Event::with('venue', 'selectedImage')
                    ->where('event_status', $status)
                    ->where('lang_id', $lang_id)
                    ->orderBy('created_at', 'desc')
                    ->paginate($limit);

        return response()->json([
            'meta' => [
                'current_page' => $events->currentPage(),
                'last_page' => $events->lastPage(),
                'per_page' => $events->perPage(),
                'total' => $events->total(),
            ],
            'data' => new EventCollection($events),
            'message' => "$status events retrieved successfully",
        ]);
    }

    public function eventsBySearch()
    {
        $event_title = strtolower(request()->query('event_title', ''));

        $lang_id = request()->query('lang_id', 1);

        $limit = request()->query('limit', 5);
        $limit = is_numeric($limit) && $limit > 0 ? min($limit, 100) : 5;

        $events = Event::with('venue', 'selectedImage')
                    ->whereRaw('LOWER(event_title) LIKE ?', ["%{$event_title}%"])
                    ->where('lang_id', $lang_id)
                    ->orderBy('created_at', 'desc')
                    ->paginate($limit);
    
        return response()->json([
            'meta' => [
                'current_page' => $events->currentPage(),
                'last_page' => $events->lastPage(),
                'per_page' => $events->perPage(),
                'total' => $events->total(),
            ],
            'data' => new EventCollection($events),
            'message' => "Events retrieved successfully",
        ]);
    }
}
