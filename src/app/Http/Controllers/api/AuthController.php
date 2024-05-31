<?php

namespace App\Http\Controllers\api;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Whoops\Handler\PlainTextHandler;

class AuthController
{

    public function login(Request $request)
    {
        $loginData = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $loginData['email'])->first();

        if (!$user) {
            return response([
                "message" => 'invalidate credential', 401
            ]);
        }

        if (!Hash::check($loginData['password'], $user->password)) {
            # code...
            return response([
                "message" => 'invalidate credential', 401
            ]);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response([
            'user' => $user, 'token' => $token
        ]);

    }

    public function logout(Request $request) {
        $delete  = $request->user()->currentAccessToken()->delete();
        return response([
            'message' => `Logout success, $delete`, 200
        ]);
    }

        //update image profile & face_embedding
    public function updateProfile(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'face_embedding' => 'required',
        ]);

        $user = $request->user();
        $image = $request->file('image');
        $face_embedding = $request->face_embedding;

        // //save image
        $image->storeAs('public/images', $image->hashName());
        $user->img_url = $image->hashName();
        $user->face_embedding = $face_embedding;
        $user->save();

        return response([
            'message' => 'Profile updated',
            'user' => $user,
        ], 200);
    }

    //update fcm token
    public function updateFcmToken(Request $request)
    {
        $request->validate([
            'fcm_token' => 'required',
        ]);

        $user = $request->user();
        $user->fcm_token = $request->fcm_token;
        $user->save();

        return response([
            'message' => 'FCM token updated',
        ], 200);
    }
}








