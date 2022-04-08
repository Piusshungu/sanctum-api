<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function userRegistration(Request $request)
    {
        $userDetails = $request->validate([

            'name' => 'required',
            'email' => 'required|unique:users,email,',
            'password' => 'required|confirmed'
        ]);

        $user = User::create($userDetails);

        $token = $user->createToken('application_token')->plainTextToken;

        $response = [

            'user' => $user,
            'token' => $token
        ];

        return response($response, 200);
    }

    
}
