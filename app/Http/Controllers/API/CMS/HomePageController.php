<?php

namespace App\Http\Controllers\API\CMS;

use App\Http\Controllers\Controller;
use App\Http\Resources\CMS\FacilityCollection;
use App\Http\Resources\CMS\HomepageResource;
use App\Http\Resources\CMS\LocalAreaCollection;
use App\Http\Resources\CMS\SponsorshipCollection;
use App\Http\Resources\Event\EventCollection;
use App\Http\Resources\Gallery\GalleryCollection;
use App\Http\Resources\Venue\VenueCollection;
use App\Http\Resources\Video\VideoCollection;
use App\Models\CMS\Facility;
use App\Models\CMS\GalleryCategory;
use App\Models\CMS\Homepage;
use App\Models\CMS\LocalArea;
use App\Models\CMS\Sponsorship;
use App\Models\CMS\Video;
use App\Models\Master\Event;
use App\Models\Master\Venue;
use Illuminate\Http\Request;

class HomePageController extends Controller
{
    public function index(Request $request)
    {
        $lang_id = $request->query('lang_id', 1);

        $homepage = Homepage::select(
            'id',
                'hero_title',
                'hero_description',
                'feature_left_title',
                'feature_left_description',
                'feature_center_title',
                'feature_center_description',
                'feature_right_title',
                'feature_right_description',
                'video_path',
            )
            ->with('selectedImage:file_path')
            ->where('lang_id', $lang_id)
            ->first();

        $facilities = Facility::select(
            'id',
                'facility_name',
                'facility_description',
                'facility_icon'
            )
            ->where('lang_id', $lang_id)
            ->orderBy('created_at', 'asc')
            ->get();

        $localAreas = LocalArea::select(
                'id',
                'place_name',
                'file_path',
            )
            ->orderBy('created_at', 'asc')
            ->get();

        $venues = Venue::select(
            'id',
                'venue_name',
                'venue_slug',
                'venue_address',
                'venue_price',
                'venue_opening_time',
                'venue_closing_time'
            )
            ->with('selectedImage:id,venue_id,file_path')
            ->get();

        $events = Event::select(
            'id',
                'event_title',
                'event_slug',
                'event_description',
                'event_start_date',
                'event_end_date',
                'event_status'
            )
            ->with(
                'venue:id,venue_name',
                'selectedImage:id,event_id,file_path'
            )
            ->where('lang_id', $lang_id)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        $galleries = GalleryCategory::select(
            'id',
                'category_name_id',
                'category_slug_id',
                'category_name_en',
                'category_slug_en'
            )
            ->with('previewImage:file_path')
            ->orderBy('created_at', 'desc')
            ->get();

        $videos = Video::select(
            'id',
                'video_title_id',
                'video_title_en',
                'file_path',
            )
            ->orderBy('created_at', 'desc')
            ->get();

        $sponsorships = Sponsorship::select(
                'id',
                'sponsor_type_name'
            )
            ->with('sponsorshipImages:sponsor_id,file_path')
            ->get();

        return response()->json([
            'data' =>  [
                'homepage' => $homepage ? new HomepageResource($homepage) : null,
                'facilities' => new FacilityCollection($facilities),
                'local_areas' => new LocalAreaCollection($localAreas),
                'venues' => new VenueCollection($venues),
                'events' => new EventCollection($events),
                'galleries' => new GalleryCollection($galleries),
                'videos' => new VideoCollection($videos),
                'sponsorships' => new SponsorshipCollection($sponsorships),
            ],
            'message' => 'Homepage content retrieved successfully',
        ]);
    }
}
