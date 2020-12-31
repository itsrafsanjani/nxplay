<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
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
        $input = $request->only('name', 'email', 'password');
        $validator = Validator::make($input, [
            'name' => 'required|min:5',
            'email' => 'required|email|min:5|unique:users',
            'password' => 'required|min:8',
        ]);

        if ($validator->fails()) {
            $response['data'] = $validator->errors();
            return response()->json($response);
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

    public function forgotPassword(Request $request): \Illuminate\Http\JsonResponse
    {
        $input = $request->only('email');
        $validator = Validator::make($input, [
            'email' => "required|email"
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors());
        }
        $response = Password::sendResetLink($input);

        $message = $response == Password::RESET_LINK_SENT ? 'Mail send successfully' : GLOBAL_SOMETHING_WANTS_TO_WRONG;

        return response()->json($message);
    }

    public function passwordReset(Request $request): \Illuminate\Http\JsonResponse
    {
        $input = $request->only('email','token', 'password', 'password_confirmation');
        $validator = Validator::make($input, [
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors());
        }
        $response = Password::reset($input, function ($user, $password) {
            $user->password = Hash::make($password);
            $user->save();
        });
        $message = $response == Password::PASSWORD_RESET ? 'Password reset successfully' : GLOBAL_SOMETHING_WANTS_TO_WRONG;
        return response()->json($message);
    }
}
