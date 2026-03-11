<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class FirebaseController extends Controller
{
    public function loginWithGoogle(Request $request)
    {
        $idToken = $request->input('idToken');

        if (!$idToken) {
            return response()->json(['error' => 'ID Token tidak ditemukan'], 400);
        }

        $apiKey = env('FIREBASE_API_KEY');
        $url = "https://identitytoolkit.googleapis.com/v1/accounts:signInWithIdp?key={$apiKey}";

        $payload = [
            'postBody' => "id_token={$idToken}&providerId=google.com",
            'requestUri' => 'http://localhost',
            'returnIdpCredential' => true,
            'returnSecureToken' => true,
        ];

        $response = Http::post($url, $payload);
        $data = $response->json();

        if (!$response->ok()) {
            return response()->json([
                'error' => 'Autentikasi gagal',
                'firebase_response' => $data
            ], 401);
        }

        // Data user dari Firebase
        $firebaseUser = [
            'name' => $data['displayName'] ?? '',
            'email' => $data['email'] ?? '',
            'photo' => $data['photoUrl'] ?? '',
            'uid' => $data['localId'] ?? '',
        ];

        // Simpan user ke session (atau DB jika ingin)
        session(['user' => $firebaseUser]);

        return response()->json([
            'message' => 'Login berhasil',
            'user' => $firebaseUser
        ]);
    }
}
