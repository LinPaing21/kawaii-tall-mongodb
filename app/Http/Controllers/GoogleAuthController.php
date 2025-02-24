<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
use Laravel\Socialite\Facades\Socialite;

class GoogleAuthController extends Controller
{
    /**
     * Redirect the user to Google’s OAuth page.
     */
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Handle the callback from Google.
     */
    public function callback()
    {
        try {
            // Get the user information from Google
            $user = Socialite::driver('google')->user();
        } catch (\Throwable $e) {
            return redirect('/login')->with('error', 'Google authentication failed.');
        }

        // Check if the user already exists in the database
        $existingUser = User::where('email', $user->email)->first();

        if ($existingUser) {
            // Log the user in if they already exist
            if($existingUser->email_verified_at == null) {
                $existingUser->email_verified_at = now();
                $existingUser->save();
            }

            Auth::login($existingUser);
        } else {
            // Otherwise, create a new user and log them in
            $newUser = User::create([
                'email' => $user->email,
                'name' => $user->name,
                'password' => bcrypt(\Str::random(16)), // Set a random password
                'email_verified_at' => now(),
                'role' => 'user'
            ]);

            event(new Registered($newUser));

            Auth::login($newUser);
        }

        // Redirect the user to the dashboard or any other secure page
        return redirect('/');
    }
}
