<?php

namespace App\Http\Controllers\API\V2;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    public function login(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
            'device_name' => 'sometimes'
        ]);

        $credentials = $request->only(['email', 'password']);

        if (!auth()->attempt($credentials)) {
            return response()->json([
                'error' => 'These credentials do not match our records.'
            ], 401);
        }

        $user = auth()->user();

        $user->update([
            'last_login_at' => now(),
            'last_login_ip' => request()->ip()
        ]);

        $token = $user->createToken($request->device_name ?? 'NXPlay Mobile')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => config('sanctum.expiration'),
            'data' => $user
        ], 200);
    }

    public function register(Request $request): \Illuminate\Http\JsonResponse
    {
        $input = $request->only('name', 'email', 'password');
        $validator = Validator::make($input, [
            'name' => ['required', 'regex:/(^([a-zA-z ]+)(\d+)?$)/u', 'min:5'],
            'email' => 'required|email|min:5|unique:users',
            'password' => ['required', Password::min(8)->letters()->numbers()],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $grav_url = 'https://www.gravatar.com/avatar/' . md5(strtolower(trim($request->email)));

        try {
            $user = User::create([
                'name' => trim($request->input('name')),
                'email' => strtolower(trim($request->input('email'))),
                'password' => Hash::make($request->input('password')),
                'avatar' => $grav_url,
            ]);

            return response()->json([
                'data' => [
                    'user' => $user
                ],
            ], 201);
        } catch (\PDOException $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function me(): \Illuminate\Http\JsonResponse
    {
        return response()->json(auth()->user(), 200);
    }

    public function logout(): \Illuminate\Http\JsonResponse
    {
        $user = auth()->user();

        $user->tokens()->where('id', $user->currentAccessToken()->id)->delete();

        return response()->json(['message' => 'Successfully logged out!'], 200);
    }
}
