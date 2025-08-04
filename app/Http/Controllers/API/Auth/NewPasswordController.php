<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class NewPasswordController extends Controller
{
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate(['email' => 'required|email|exists:users,email',]);
            $emailParam = ['email' => $validatedData['email']];
            $status = Password::sendResetLink($emailParam);
            
            if ($status == Password::RESET_LINK_SENT) {
                return response()->json([
                    'status' => 'success',
                    'status_code' => 200,
                    'message' => 'a reset password link has been sent to ' . $validatedData['email']
                ], 200);
            } else {
                return response()->json([
                    'status' => 'failed',
                    'status_code' => 400,
                    'message' => 'failed to send the reset password link to your email. Please try again or contact us'
                ]);
            }

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'failed',
                'status_code' => 400,
                'message' => 'something error : ' . $e->getMessage(),
            ], 400);
        }
    }   
}
