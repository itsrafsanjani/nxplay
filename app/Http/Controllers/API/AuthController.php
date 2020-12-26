<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    public function login(): \Illuminate\Http\JsonResponse
    {
        $credentials = request(['email', 'password']);

        if (! $token = auth('api')->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    public function register(Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            $this->validate($request, [
                'name' => 'required|min:5',
                'email' => 'required|email|min:5|unique:users',
                'password' => 'required|min:8',
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'data' => $e->getMessage()
            ], 422);
        }

        try {
            $user = User::create([
                'name' => trim($request->input('name')),
                'email' => strtolower(trim($request->input('email'))),
                'password' => Hash::make($request->input('password')),
            ]);

            return response()->json([
                'data' => $user
            ], 201);

        } catch (\PDOException $e) {
            return response()->json([
                'data' => $e->getMessage()
            ], 400);
        }
    }

    public function me(): \Illuminate\Http\JsonResponse
    {
        return response()->json(auth('api')->user());
    }

    public function logout(): \Illuminate\Http\JsonResponse
    {
        auth('api')->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    public function refresh(): \Illuminate\Http\JsonResponse
    {
        return $this->respondWithToken(auth('api')->refresh());
    }

    protected function respondWithToken($token): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ]);
    }
}
