<?php

namespace App\Http\Controllers\Email;

use App\Http\Controllers\Controller;
use App\Http\Requests\Email\EmailRequest;
use App\Mail\Gmail\ContactMail;
use App\Models\CMS\CompanyProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class GmailController extends Controller
{
    public function submit(EmailRequest $request)
    {
        $validatedData = $request->validated();

        // Ambil email company secara langsung sebagai string
        $companyEmail = CompanyProfile::where('id', 1)->value('company_email');

        // Fallback jika null
        if (empty($companyEmail)) {
            $companyEmail = 'admin@pbc.com';
        }

        Mail::to($companyEmail)->send(new ContactMail($validatedData));

        return response()->json([
            'message' => 'Email sent successfully!'
        ]);
    }
}
