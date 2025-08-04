<?php

namespace App\Http\Controllers\API\CMS;

use App\Http\Controllers\Controller;
use App\Http\Resources\CMS\CompanyProfileResource;
use App\Http\Resources\CMS\SocialMediaCollection;
use App\Models\CMS\CompanyProfile;
use App\Models\CMS\SocialMedia;
use Illuminate\Http\Request;

class CompanyProfileController extends Controller
{
    public function index()
    {
        $companyProfile = CompanyProfile::select('id', 'company_email', 'company_address', 'company_iframe_maps_url', 'company_phone_number')
            ->first();

        $socialMedia = SocialMedia::select('id', 'socmed_name', 'socmed_icon', 'socmed_url', 'socmed_username')
            ->orderBy('id', 'asc')
            ->get();
 
        return response()->json([
            'data' => [
                'company_profile' => $companyProfile ? new CompanyProfileResource($companyProfile) : null,
                'social_media' => new SocialMediaCollection($socialMedia)
            ],
            'message' => $companyProfile ? 'Company profile content retrieved successfully' : 'No company profile content found',
        ]);
    }

    public function companyPhoneNumber()
    {
        $companyProfile = CompanyProfile::first();

        return response()->json([
            'data' => $companyProfile ? [
                'phone_number' => $companyProfile->company_phone_number
            ] : [
                'phone_number' => null
            ],
            'message' => $companyProfile ? 'Company phone number retrieved successfully' : 'No company phone number found',
        ]);
    }
}
