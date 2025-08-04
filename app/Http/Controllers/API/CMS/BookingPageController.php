<?php

namespace App\Http\Controllers\API\CMS;

use App\Http\Controllers\Controller;
use App\Http\Resources\CMS\BookingPolicyCollection;
use App\Http\Resources\CMS\PriceListCollection;
use App\Http\Resources\Venue\VenueCollection;
use App\Http\Resources\Venue\VenueRoomCollection;
use App\Models\CMS\BookingPage;
use App\Models\CMS\BookingPolicy;
use App\Models\CMS\CompanyProfile;
use App\Models\CMS\HomepageHeroImage;
use App\Models\CMS\PriceList;
use App\Models\Master\Venue;
use App\Models\Master\VenueRoom;
use Illuminate\Http\Request;

class BookingPageController extends Controller
{
    public function index(Request $request)
    {
        $priceLists = PriceList::all();
        
        $bookingPolicies = BookingPolicy::where('lang_id', $request->query('lang_id', 1))
                                        ->orderBy('created_at', 'desc')
                                        ->get();

        $venueRooms = VenueRoom::with(['venue', 'selectedImage'])
                                ->get();

        $pbcPhoneNumber = CompanyProfile::first()->company_phone_number ?? null;

        $bookingPage = BookingPage::with(['images' => function ($query) {
            $query->orderByDesc('is_default')->orderBy('id');
        }])->first();

        // Ambil gambar: is_default = 1 > gambar pertama > null
        $selectedImage = $bookingPage?->images?->first()?->file_path ?? null;

        return response()->json([
            'data' => [
                'booking_policies' => new BookingPolicyCollection($bookingPolicies), 
                'price_lists' => new PriceListCollection($priceLists),
                'venue_rooms' => new VenueRoomCollection($venueRooms),
                'pbc_phone_number' => $pbcPhoneNumber,
                'image_url' => $selectedImage,
            ],
            'message' => 'Booking policies retrieved successfully',
        ]);
    }
}
