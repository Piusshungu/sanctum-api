<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    public function userRegistration(Request $request)
    {
        $userDetails = $request->validate([

            'name' => 'required|string',
            'email' => 'required|string|unique:users,email,',
            'password' => 'required|string|confirmed',
            'location' => 'required',
            'phone_number' => 'required',
            'profile_picture' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048'
        ]);

        $user = User::create([

            'name' => $userDetails['name'],
            'email' => $userDetails['email'],
            'password' => bcrypt($userDetails['password'])
        ]);

        $token = $user->createToken('application_token')->plainTextToken;

        $response = [

            'user' => $user,
            'token' => $token
        ];

        return response()->json($response, 201);
    }

    public function login(Request $request)
    {
        $userDetails = $request->validate([

            'password' => 'required',

            'email' => 'required'
        ]);

        $user = User::where('email', $userDetails['email'])->first();

        if(!$user || !Hash::check($userDetails['password'], $user->password)){

            return response()->json([

                'message' => 'Incorrect Email or Password'
            ], 401);
        }

        $token = $user->createToken('access_token')->plainTextToken;

        $response = [

            'user' => $user,
            
            'token' => $token
        ];

        return response()->json($response, 201);
    }

    public function logout(Request $request)
    {
        $user = Auth::user();

        $request->user()->currentAccessToken()->delete();

        return [

            'message' => 'User logged out successfully'
        ];
    }

    
}
