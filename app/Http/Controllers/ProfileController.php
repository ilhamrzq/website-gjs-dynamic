<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function index()
    {
        return view('profiles.index');
    }

    public function edit()
    {
        return view('profiles.edit',[
            'action_back' => route('profiles.index'),
        ]);
    }

    public function update(ProfileUpdateRequest $request)
    {
        $user = $request->user();

        $validated = $request->validated();

        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->phone = $validated['phone'];

        if (!empty($validated['password'])) {
            $user->password = bcrypt($validated['password']);
        }

        $user->save();

        return Redirect::route('profiles.index')
            ->with('success', 'Profile updated successfully.');
    }
}
