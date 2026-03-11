<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class FirestoreRest
{
    public static function addDocument($collection, $fields)
    {
        $projectId = env('FIREBASE_PROJECT_ID');
        $accessToken = FirebaseService::getAccessToken();

        $url = "https://firestore.googleapis.com/v1/projects/$projectId/databases/(default)/documents/$collection";

        return Http::withToken($accessToken)
            ->post($url, [
                'fields' => self::convertToFirestoreFields($fields)
            ])
            ->json();
    }

    private static function convertToFirestoreFields($data)
    {
        $fields = [];

        foreach ($data as $key => $value) {

            if (is_string($value)) {
                $fields[$key] = ['stringValue' => $value];
            } elseif (is_int($value)) {
                $fields[$key] = ['integerValue' => $value];
            } elseif (is_bool($value)) {
                $fields[$key] = ['booleanValue' => $value];
            } else {
                $fields[$key] = ['stringValue' => json_encode($value)];
            }
        }

        return $fields;
    }
}
