<?php

namespace App\Http\Controllers\API\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Exception;
use App\Models\Master\Building;
use App\Models\Master\BuildingImage;

class MasterBuildingController extends Controller
{
    public function getMasterBuilding(Request $request)
    {
        $date_now = date("Y-m-d H:i:s");
        $user_id = 2; //bot
        $method_controller = request()->route()->getAction()['controller'];

        $data_Building = Building::getBuildingAllArea();

        $array_all = [];
        foreach ($data_Building as $value) {
            $data_BuildingImage = BuildingImage::getActiveImagesByBuilding($value->id);

            $array_all[] = [
                'id' => $value->id,
                'building_name' => $value->building_name . ' - ' . $value->area_name,
                'building_description' => $value->building_description,
                'building_address' => $value->building_address,
                'building_url' => $value->building_url,
                'building_image' => $data_BuildingImage
            ];
        }

        $respon = [
            'status' => 'success',
            'status_code' => 200,
            'message' => 'List Data Nama Building',
            'data' => [
                'buildings' => $array_all,
            ]
        ];
        return response()->json($respon, 200);
    }
}
