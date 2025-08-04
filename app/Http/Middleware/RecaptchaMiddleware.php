<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Http;

class RecaptchaMiddleware
{
    /**
     * Handle an incoming request.
     *  
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        $recaptchaToken = $request->input('recaptcha_token');
        $response = Http::post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => env('RECAPTCHA_SECRET_KEY'),
            'response' => $recaptchaToken,
        ]);

        if ($response->json()['success']) {
            return $next($request);
        }

        return redirect()->back()->withErrors(['recaptcha' => 'ReCAPTCHA validation failed.']);
    }
}
