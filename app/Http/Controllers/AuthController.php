<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * Register a new user and add access token to this user.
     *
     * @return \Illuminate\Http\Response
     */
    public function register(AuthRegisterRequest $request)
    {
        $validatedData = $request->validated();

        $user = User::create([
            'firstname' => $validatedData['firstname'],
            'lastname' => $validatedData['lastname'],
            'civility' => $validatedData['civility'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
        ]);

        if(!$user) {
            return response()->json(['error' => 'Une erreur est survenue lors de la création de l\'utilisateur.'], 500);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer'
        ], 201);
        
    }

    /**
     * Auth user with his token.
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        if (!Auth::attempt(['email' => $request->email, 'password' => $request->password, 'deleted_at' => null])) {
            return response()->json(['error' => 'L\'email ou le mot de passe est incorrect.'], 401);
        }

        $user = User::where('email', $request['email'])->firstOrFail();

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer'
        ]);
    }

    /**
     * Get data of auth user.
     *
     * @return \Illuminate\Http\Response
     */
    public function me()
    {
        return response()->json(Auth::user());
    }
}
