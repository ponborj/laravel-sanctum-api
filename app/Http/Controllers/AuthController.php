<?php

namespace App\Http\Controllers;

use App\Services\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // validade request
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // login attempt
        $email = $credentials['email'];
        $password = $credentials['password'];

        $attempt = Auth::attempt(
            [
                'email' => $email,
                'password' => $password
            ]
        );

        if (!$attempt) {
            return ApiResponse::unauthorized();
        }

        // authenticated user 
        $user = auth()->user();

        // generate token
        // $token = $user->createToken($user->name)->plainTextToken;

        // definindo tempo de expiração para o token de 1 hora
        $token = $user->createToken($user->name, ['*'], now()->addHour())->plainTextToken;

        // return token for api access
        return ApiResponse::success(
            [
                'user' => $user->name,
                'email' => $user->email,
                'token' => $token
            ]
        );
    }

    public function logout(Request $request)
    {
        // remove all tokens
        $user = $request->user();
        $user->tokens()->delete();

        return ApiResponse::success(
            [
                'message' => 'Logged out successfully'
            ]
        );
    }
}
