<?php

namespace App\Http\Controllers\api;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Whoops\Handler\PlainTextHandler;

class AuthController
{
    /**
     * Display a listing of the resource.
     */
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














    //     $loginData = $request->validate([
    //         'email' => 'required|email',
    //         'password' => 'required'
    //     ]);


    //     $user = User::where('email', $loginData['email'])->first();

    //     if (!$user) {
    //         return response([
    //             'message' => 'User not found'
    //         ], 401);
    //     }

    //     if(!Hash::check($loginData['password'], $user->password)) {
    //         return response([
    //             'message' => 'Invalid credentials'
    //         ], 401);
    //     }

    //     $createToken = $user->createToken('auth_token')->plainTextToken;
    //     return response([
    //         'token' => $createToken
    //     ]);
    // }

}
