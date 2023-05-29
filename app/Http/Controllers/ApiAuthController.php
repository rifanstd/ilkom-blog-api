<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\LoginResource;
use App\Http\Resources\RegisterResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ApiAuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        $credentials = $request->validated();

        // check user in database
        if (!Auth::attempt($credentials)) {
            return response()->json([
                'message' => 'Username of Password is Wrong',
            ], 401);
        }

        // get user
        $user = User::where('email', $request->email)->first();

        // delete token by user
        $user->tokens()->delete();

        $token = $user->createToken('token')->plainTextToken;

        return new LoginResource([
            'user' => $user,
            'token' => $token,
        ]);
    }

    public function register(RegisterRequest $request)
    {
        // Create User
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // create token
        $token = $user->createToken('token')->plainTextToken;

        return new RegisterResource([
            'user' => $user,
            'token' => $token,
        ]);
    }

    public function logout(Request $request)
    {
        // delete all token by user
        $request->user()->tokens()->delete();

        // return no content
        return response()->noContent();
    }
}