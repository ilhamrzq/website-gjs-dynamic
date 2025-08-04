<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Http;

class Recaptcha implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $g_response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => config('services.recaptcha.secret_key'),
            'response' => $value,
            'remoteip' => \request()->ip(),
        ]);

        $responseData = $g_response->json();
        
        if (!$responseData['success'] || (isset($responseData['score']) && $responseData['score'] < 0.5)) {
            $fail("Validasi reCAPTCHA gagal. Mohon ikuti langkah berikut agar berhasil:
            1) Pastikan koneksi internet stabil.
            2) Jangan menggunakan VPN jika tidak perlu.
            3) Refresh halaman dan coba kembali login.
            4) Jika masih gagal, hubungi admin untuk bantuan.");
        }
    }
}
