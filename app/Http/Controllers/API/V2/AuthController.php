<?php

namespace App\Http\Controllers\API\V2;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function login(Request $request): JsonResponse
    {
        $request->validate([
            'email' => ['required'],
            'password' => ['required'],
            'device_name' => ['sometimes']
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

        $token = $user->createToken($request->device_name ?? Str::random(10))->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'expires_in' => config('sanctum.expiration'),
            'data' => [
                'user' => $user
            ]
        ]);
    }

    public function register(Request $request): JsonResponse
    {
        $request->validate([
            'name' => ['required', 'regex:/(^([a-zA-z ]+)(\d+)?$)/u', 'min:5'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', Password::min(8)->letters()->numbers()],
        ]);

        $gravatarUrl = 'https://www.gravatar.com/avatar/' . md5(strtolower(trim($request->email)));

        try {
            $user = User::create([
                'name' => trim($request->name),
                'email' => strtolower(trim($request->email)),
                'password' => Hash::make($request->password),
                'avatar' => $gravatarUrl,
            ]);

            return response()->json([
                'data' => [
                    'user' => $user
                ]
            ], 201);
        } catch (\PDOException $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function me(): JsonResponse
    {
        return response()->json([
            'data' => [
                'user' => auth()->user()
            ]
        ]);
    }

    public function logout(): JsonResponse
    {
        $user = auth()->user();

        $user->tokens()->where('id', $user->currentAccessToken()->id)->delete();

        return response()->json([
            'message' => 'Successfully logged out!'
        ]);
    }

    public function github(Request $request): JsonResponse
    {
        $socialUser = Socialite::driver('github')->stateless()->userFromToken($request->access_token);

        try {
            $user = User::where('email', $socialUser->getEmail())->first();

            if (!$user) {
                $user = User::create([
                    'name' => $socialUser->getName(),
                    'email' => $socialUser->getEmail(),
                    'provider_id' => $socialUser->getId(),
                    'avatar' => $socialUser->getAvatar(),
                ]);
            } else {
                $user->update([
                    'provider_id' => (string)$socialUser->getId(),
                    'avatar' => $socialUser->getAvatar(),
                ]);
            }

            $user->update([
                'last_login_at' => now(),
                'last_login_ip' => request()->ip()
            ]);

            $token = $user->createToken($request->device_name ?? Str::random(10))->plainTextToken;

            return response()->json([
                'access_token' => $token,
                'token_type' => 'Bearer',
                'expires_in' => config('sanctum.expiration'),
                'data' => [
                    'user' => $user
                ]
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'message' => 'Not found or access token expired!',
                'errors' => $exception->getMessage()
            ], 400);
        }
    }
}
