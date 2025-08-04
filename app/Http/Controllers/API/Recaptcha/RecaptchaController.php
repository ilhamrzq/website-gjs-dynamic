<?php

namespace App\Http\Controllers\API\Recaptcha;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class RecaptchaController extends Controller
{

    public function verify(Request $request)
    {
        try {
            // Verify the reCAPTCHA token with Google
            $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
                'secret' => env('RECAPTCHA_SECRET_KEY'),
                'response' => $request->recaptcha_token,
                'remoteip' => $request->ip(),
            ]);

            // Log the full response
            $recaptchaData = $response->json();
            Log::info('Google reCAPTCHA response:', $recaptchaData);

            // Check for success and acceptable score
            if (!$recaptchaData['success'] || $recaptchaData['score'] < 0.5) {
                return response()->json(['message' => 'reCAPTCHA validation failed.'], 422);
            }

            return response()->json([
                'message' => 'reCAPTCHA validation passed.',
                'reCAPTCHA Response' => $recaptchaData
            ]);
        } catch (\Exception $e) {
            // Log the exception for detailed debugging
            Log::error('Error during reCAPTCHA verification: ' . $e->getMessage());
            return response()->json(['message' => 'Error during reCAPTCHA verification.'], 500);
        }
    }
}
