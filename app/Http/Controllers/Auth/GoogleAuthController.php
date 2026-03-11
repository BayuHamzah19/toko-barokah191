<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Str;

class GoogleAuthController extends Controller
{
    public function authenticate(Request $request)
    {
        $idToken = $request->token;
        $firebaseApiKey = env('FIREBASE_API_KEY');

        // Request ke Firebase untuk validasi token
        $response = Http::post(
            "https://identitytoolkit.googleapis.com/v1/accounts:lookup?key={$firebaseApiKey}",
            ['idToken' => $idToken]
        );

        if (!$response->ok()) {
            return response()->json(['success' => false, 'message' => 'Token Google tidak valid']);
        }

        $firebaseUser = $response->json()['users'][0];

        // Data dari Firebase
        $email = $firebaseUser['email'];
        $name  = $firebaseUser['displayName'] ?? $email;
        $photo = $firebaseUser['photoUrl'] ?? null;

        // Cek apakah user sudah ada
        $user = User::where('email', $email)->first();

        if (!$user) {
            // Buat user baru
            $user = User::create([
                'name'          => $name,
                'email'         => $email,
                'password'      => bcrypt(Str::random(32)), // password acak aman
                'profile_photo' => $photo,
                'role'          => 'user', // role otomatis saat pertama login
            ]);
        } else {
            // Update foto & nama jika berubah di Google
            $user->update([
                'name'          => $name,
                'profile_photo' => $photo,
            ]);
        }

        // Login ke session Laravel
        Auth::login($user);

        return response()->json([
            'success' => true,
            'redirect_url' => $user->role === 'admin'
                ? route('admin.dashboard')
                : route('user.dashboard')
        ]);

    }
}
