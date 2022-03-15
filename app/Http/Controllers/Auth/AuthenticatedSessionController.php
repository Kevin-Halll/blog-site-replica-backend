<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LoginRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();

        // dd($request);

        $user = User::where('email', $request->email)->first();
        // dd($user);
        $token = $user->createToken('api_key')->plainTextToken;

        return (['message' => 'Logged in successfuly',
                  'token' => $token]);
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return response()->noContent();
    }

    public function user(Request $request){
        $request->authenticate();
        $request->session()->regenerate();
        response()->json([
            'message' => 'User is logged in'
        ]);
    }

    public function get(){
        return (["message" => "it deh rerk"]);
    }

}
