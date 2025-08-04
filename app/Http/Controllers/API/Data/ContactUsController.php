<?php

namespace App\Http\Controllers\API\Data;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Exception;

class ContactUsController extends Controller
{
    public function saveContactUs(Request $request)
    {
        $date_now = date("Y-m-d H:i:s");
        $user_id = 2; //bot
        $method_controller = request()->route()->getAction()['controller'];

        $validate = Validator::make($request->all(), [
            'fullname' => 'required|regex:string',
            'email' => 'required|regex:string',
            'phone_number' => 'required|regex:integer',
            'company' => 'required|regex:string',
            'area' => 'required|regex:integer',
            'type_room' => 'required|regex:integer',
            'number_of_people' => 'required|regex:integer',
            'subject' => 'required|regex:string',
            'message' => 'required|regex:string'
        ]);

        if ($validate->fails()) {
            $respon = [
                'status_code' => 400,
                'status' => 'error',
                'message' => 'Validator error',
            ];
            return response()->json($respon, 400);
        }

        DB::beginTransaction();

        try {
            $data_contact_us_id = DB::table('data_contact_us')->insertGetId([
                'fullname' => $request->fullname,
                'email' => $request->email,
                'phone_number' => $request->phone_number,
                'company' => $request->company,
                'area' => $request->area,
                'type_room' => $request->type_room,
                'number_of_people' => $request->number_of_people,
                'subject' => $request->subject,
                'message' => $request->message,
                'created_date' => $date_now,
                'created_by' => $user_id,
                'updated_date' => $date_now,
                'updated_by' => $user_id,
                'is_active' => 1
            ]);

            if ($data_contact_us_id) {
                DB::commit();

                $respon = [
                    'status_code' => 200,
                    'status' => 'success',
                    'message' => 'Data Kontak dengan email (' . $request->email . ') berhasil disimpan',
                    'data' => [
                        'data_contact_us_id' => $data_contact_us_id
                    ],
                ];
                return response()->json($respon, 200);
            } else {
                DB::rollback();

                // LogError::create([
                //     'controller'        => $method_controller,
                //     // 'log_error'         => substr($e->getMessage(), 0, 1000),
                //     'log_error'         => $e->getMessage(),
                //     'created_date'      => $date_now,
                //     'created_by'        => $user_id
                // ]);

                $respon = [
                    'status_code' => 400,
                    'status' => 'error',
                    'message' => 'Error, gagal menyimpan data'
                ];
                return response()->json($respon, 400);
            }
        } catch (Exception $e) {
            DB::rollback();

            // LogError::create([
            //     'controller'        => $method_controller,
            //     // 'log_error'         => substr($e->getMessage(), 0, 1000),
            //     'log_error'         => $e->getMessage(),
            //     'created_date'      => $date_now,
            //     'created_by'        => $user_id
            // ]);

            $respon = [
                'status_code' => 400,
                'status' => 'error',
                'message' => 'Error, silahkan menghubungi Admin Sistem'
            ];
            return response()->json($respon, 400);
        }
    }
}
