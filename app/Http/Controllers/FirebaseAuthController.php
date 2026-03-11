<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Kreait\Firebase\Factory;  // <--- ini harus ditambahkan
use Firebase\Auth\Token\Exception\InvalidToken;
use Kreait\Firebase\Auth as FirebaseAuth;
use Illuminate\Support\Facades\Auth;
use Kreait\Firebase\Exception\AuthException;
use Kreait\Firebase\Exception\FirebaseException;

class FirebaseAuthController extends Controller
{
    protected FirebaseAuth $auth;

    public function __construct()
    {
        $factory = (new Factory)
            ->withServiceAccount(config('firebase.credentials.file'));

        $this->auth = $factory->createAuth();
    }

    // Login/Register via Firebase
    public function login(Request $request)
    {
        $request->validate([
            'idToken' => 'required|string',
        ]);

        $idTokenString = $request->idToken;

        try {
            // Decode token
            $verifiedIdToken = $this->firebase->verifyIdToken($idTokenString);
            $firebaseUser = $this->firebase->getUser($verifiedIdToken->claims()->get('sub'));

            // Auto-create/update user di database Laravel
            $user = User::updateOrCreate(
                ['email' => $firebaseUser->email],
                [
                    'name' => $firebaseUser->displayName ?? $firebaseUser->email,
                    'firebase_uid' => $firebaseUser->uid,
                    'password' => bcrypt(uniqid()),
                    'role' => 'user', // default role
                ]
            );

            // Cek role admin atau user
            if ($user->role === 'admin') {
                $redirect = route('admin.dashboard');
            } else {
                $redirect = route('user.dashboard');
            }

            // Login Laravel
            Auth::login($user);

            return response()->json([
                'status' => 'success',
                'user' => $user,
                'redirect' => $redirect,
                'message' => 'Login berhasil via Firebase'
            ]);
        } catch (InvalidToken $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid Firebase ID token: '.$e->getMessage()
            ], 401);
        }
    }

    // Register user via Firebase Google
    public function register(Request $request)
    {
        $request->validate(['idToken' => 'required']);

        try {
            // Verifikasi token Firebase
            $verifiedToken = $this->auth->verifyIdToken($request->idToken);
            $uid = $verifiedToken->claims()->get('sub');
            $firebaseUser = $this->auth->getUser($uid);

            // Simpan ke MySQL jika belum ada
            $user = User::firstOrCreate(
                ['firebase_uid' => $firebaseUser->uid],
                [
                    'name' => $firebaseUser->displayName ?? 'Anonymous',
                    'email' => $firebaseUser->email ?? null,
                    'password' => bcrypt(uniqid()), // password random karena login pakai Firebase
                ]
            );

            // Login user di Laravel
            auth()->login($user);

            return response()->json([
                'status' => 'success',
                'redirect' => route('dashboard')
            ]);
        } catch (AuthException | FirebaseException $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
        }
    }


    // Logout
    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
