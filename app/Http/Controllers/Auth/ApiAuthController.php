<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ApiAuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $user = User::create([
            "first_name" => $request->first_name,
            "last_name" => $request->last_name,
            "email" => $request->email,
            "phone" => $request->phone,
            // "address" => $request->address,
            // "city" => $request->city,
            // "parish" => $request->parish,
            "dob" => $request->dob,
            "password" => Hash::make($request->password),
            "remember_token" => Str::random(10)
        ]);

        $token = $user->createToken('Laravel Password Grant Client')->accessToken;
        $response = ['token' => $token];
        return success($response, "User Registered", 200);
    }

    public function login(LoginRequest $request)
    {
        $user = User::where('email', $request->email)->first();
        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                $token = $user->createToken('Laravel Password Grant Client')->accessToken;
                return success($token, "Logged in Successfully", 200);
            } else {
                return error([], "Invalid Credetials", 422);
            }
        } else {
            return error([], "No user found", 422);
        }
    }

    public function logout(Request $request)
    {
        $token = $request->user()->token();
        $token->revoke();
        return success([], "Logged out successfully", 200);
    }
}
