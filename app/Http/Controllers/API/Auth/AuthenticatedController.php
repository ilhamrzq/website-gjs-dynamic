<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Models\oauth\OauthClient;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AuthenticatedController extends Controller
{
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'email' => 'email|required',
                'password' => 'required',
                'client_id' => 'required',
                'client_secret' => 'required'
            ]);

            if (Auth::attempt(['email' => $validatedData['email'],'password' => $validatedData['password'] ])) {
                $user = Auth::user()->only(['id','name', 'email', 'phone', 'email_verified_at']);

                $response = Http::asForm()->connectTimeout(30)->post(config('app.url') . '/oauth/token', [
                    'grant_type' => 'password',
                    'client_id' => $validatedData['client_id'],
                    'client_secret' => $validatedData['client_secret'],
                    'username' => $validatedData['email'],
                    'password' => $validatedData['password'],
                    'scope' => '',
                ]);

                if ($response->successful()) {
                    return response()->json([
                        'status' => 'success',
                        'status_code' => 200,
                        'message' => 'Generate token success',
                        'data' => [
                            'token' => $response->json(),
                            'user' => $user,
                        ]
                    ], 200);
                } else {
                    return response()->json([
                        'status' => 'failed',
                        'status_code' => 400,
                        'message' => 'Failed to generate token'
                    ], 400);
                }
            } 
            
            // Jika gagal terotentikasi
            return response()->json([
                'status' => 'failed',
                'status_code' => 401,
                'message' => 'Invalid Credentials'
            ], 401);

        } catch (\Exception $e) {
            // Log::error('Error during token reqeust: ' . $e->getMessage());
            return response()->json([
                'status' => 'failed',
                'status_code' => 400,
                'message' => 'something error : ' . $e->getMessage(), 
            ], 400);
        }
    }

    public function refreshToken(Request $request)
    {
        $validated = $request->validate([
            'client_id' => 'required',
            'client_secret' => 'required',
            'refresh_token' => 'required',
        ]);

        $response = Http::asForm()->post('http://ihub-app.test/oauth/token', [
            'grant_type' => 'refresh_token',
            'refresh_token' => $validated['refresh_token'],
            'client_id' => $validated['client_id'],
            'client_secret' => $validated['client_secret'],
            'scope' => '',
        ]);

        if ($response->successful()) {
            return response()->json([
                'status' => 'success',
                'status_code' => 200,
                'message' => 'Generate new access token success',
                'data' => [
                    'access_token' => $response->json(),
                ]
            ], 200);
        } else {
            return response()->json([
                'status' => 'failed',
                'status_code' => 400,
                'message' => 'Failed to generate new access token'
            ], 400);
        }
    }

    public function destroy(Request $request)
    {
        try {
            $request->user()->token()->revoke();
            return response()->json([
                'status' => 'success',
                'status_code' => 200,
                'message' => 'Successfully logged out'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'failed',
                'status_code' => 400,
                'message' => 'Something error : ' . $e->getMessage()
            ]);
        }
       
    }
}