<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;

class RegisteredController extends Controller
{
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => ['required', 'max:100'],
                'email' => ['required', 'email', 'unique:users'],
                'phone' => ['required', 'max:100', 'unique:'.User::class],
                'password' => ['required', 'confirmed', Password::min(8)],
                'password_confirmation' => ['required']
            ]);

            $user = User::create([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'phone' => $validatedData['phone'],
                'password' => Hash::make($validatedData['password']),
            ]);

            event(new Registered($user));
            return response()->json([
                'status' => 'success',
                'status_code' => 200,
                'message' => 'Your account has been successfully created. Please check your email to verify your account'
            ], 201);

        } catch (ValidationException $e) {
            return response()->json([
                'status' => 'failed',
                'status_code' => 400,
                'message' => 'something error : validation failed',
                'data' => [
                    'errors' => $e->errors()
                ]
            ], 400);
        }
    }
}
