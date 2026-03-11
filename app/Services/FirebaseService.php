<?php

namespace App\Services;

use Google\Auth\Credentials\ServiceAccountCredentials;

class FirebaseService
{
    public static function getAccessToken()
    {
        $path = storage_path('firebase/serviceAccountKey.json');

        $credentials = new ServiceAccountCredentials(
            'https://www.googleapis.com/auth/datastore',
            $path
        );

        $token = $credentials->fetchAuthToken();

        return $token['access_token'];
    }
}
