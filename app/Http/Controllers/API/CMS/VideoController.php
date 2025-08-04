<?php

namespace App\Http\Controllers\API\CMS;

use App\Http\Controllers\Controller;
use App\Http\Resources\Video\VideoCollection;
use Illuminate\Http\Request;
use App\Models\CMS\Video;

class VideoController extends Controller
{
    public function index(Request $request)
    {
        $videos = Video::select('id', 'video_title_id', 'video_title_en', 'file_path')
                    ->orderBy('created_at', 'desc')
                    ->get();
    
        return response()->json([
            'data' => new VideoCollection($videos),
            'message' => "Videos retrieved successfully",
        ]);
    }
}
