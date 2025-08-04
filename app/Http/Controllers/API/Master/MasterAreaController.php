<?php

namespace App\Http\Controllers\API\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Exception;
use App\Models\Master\Area;

class MasterAreaController extends Controller
{
    public function getMasterArea(Request $request)
    {
        $date_now = date("Y-m-d H:i:s");
        $user_id = 2; //bot
        $method_controller = request()->route()->getAction()['controller'];

        $data_Area = Area::select(
            'master_areas.id AS id',
            'master_areas.area_name AS area_name',
            'master_areas.area_description AS area_description'
        )
            ->where('master_areas.is_active', '=', 1)
            ->orderBy('master_areas.id', 'asc')
            ->get();

        $array_all = [];
        foreach ($data_Area as $value) {

            $array_all[] = [
                'id' => $value->id,
                'area_name' => $value->area_name,
                'area_description' => $value->area_description
            ];
        }

        $respon = [
            'status_code' => 200,
            'status' => 'success',
            'message' => 'List Data Nama Area',
            'data' => [
                'data_area' => $array_all,
            ]
        ];
        return response()->json($respon, 200);
    }
}
