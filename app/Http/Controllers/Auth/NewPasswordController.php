<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use Inertia\Response;

class NewPasswordController extends Controller
{
    public function index()
    {
        return view('auth.reset-password');
    }
    
    /**
     * Display the password reset view.
     */
    public function create(Request $request): Response
    {
        return Inertia::render('Auth/ResetPassword', [
            'email' => $request->email,
            'token' => $request->route('token'),
        ]);
    }

    /**
     * Handle an incoming new password request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'token' => 'required',
            'user_id' => 'required',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        try {
        $userId = Crypt::decrypt($request->user_id);
        } catch (DecryptException $e) {
            throw ValidationException::withMessages([
                'user_id' => ['Invalid user identifier.'],
            ]);
        }

        $user = User::find($userId);

        if (!$user) {
            throw ValidationException::withMessages([
                'user_id' => ['User not found.'],
            ]);
        }

        $tokenData = DB::table('password_reset_tokens')
            ->where('email', $user->email)
            ->first();

        if (!$tokenData || !Hash::check($request->token, $tokenData->token)) {
            throw ValidationException::withMessages([
                'token' => ['This password reset token is invalid.'],
            ]);
        }

        // Here we will attempt to reset the user's password. If it is successful we
        // will update the password on an actual user model and persist it to the
        // database. Otherwise we will parse the error and return the response.
        $user->forceFill([
            'password' => Hash::make($request->password),
            'remember_token' => Str::random(60),
        ])->save();
        DB::table('password_reset_tokens')->where('email', $user->email)->delete();

        event(new PasswordReset($user));

        return redirect()->route('login')->with('status', 'Password reset successfully.');
    }

    // public function store(Request $request): RedirectResponse
    // {
    //     $request->validate([
    //         'token' => 'required',
    //         'email' => 'required|email',
    //         'password' => ['required', 'confirmed', Rules\Password::defaults()],
    //     ]);

    //     // Here we will attempt to reset the user's password. If it is successful we
    //     // will update the password on an actual user model and persist it to the
    //     // database. Otherwise we will parse the error and return the response.
    //     $status = Password::reset(
    //         $request->only('email', 'password', 'password_confirmation', 'token'),
    //         function ($user) use ($request) {
    //             $user->forceFill([
    //                 'password' => Hash::make($request->password),
    //                 'remember_token' => Str::random(60),
    //             ])->save();

    //             event(new PasswordReset($user));
    //         }
    //     );

    //     // If the password was successfully reset, we will redirect the user back to
    //     // the application's home authenticated view. If there is an error we can
    //     // redirect them back to where they came from with their error message.
    //     if ($status == Password::PASSWORD_RESET) {
    //         return redirect()->route('login')->with('status', __($status));
    //     }

    //     throw ValidationException::withMessages([
    //         'email' => [trans($status)],
    //     ]);
    // }
}
