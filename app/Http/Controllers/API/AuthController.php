<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Google_Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;

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
            return response()->json($validator->errors(), 400);
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
            ], 500);
        }
    }

    public function me(): \Illuminate\Http\JsonResponse
    {
        return response()->json(auth('api')->user(), 200);
    }

    public function logout(): \Illuminate\Http\JsonResponse
    {
        auth('api')->logout();

        return response()->json(['message' => 'Successfully logged out'], 200);
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
        ], 200);
    }

    public function forgotPassword(Request $request): \Illuminate\Http\JsonResponse
    {
        $input = $request->only('email');
        $validator = Validator::make($input, [
            'email' => "required|email"
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $response = Password::sendResetLink($input);

        $message = $response == Password::RESET_LINK_SENT ? 'Mail send successfully' : GLOBAL_SOMETHING_WANTS_TO_WRONG;

        return response()->json($message, 200);
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
            return response()->json($validator->errors(), 400);
        }
        $response = Password::reset($input, function ($user, $password) {
            $user->password = Hash::make($password);
            $user->save();
        });
        $message = $response == Password::PASSWORD_RESET ? 'Password reset successfully' : GLOBAL_SOMETHING_WANTS_TO_WRONG;
        return response()->json($message, 200);
    }

    public function google(Request $request)
    {
        // Get $id_token via HTTPS POST.

        $url_endpoint = "https://oauth2.googleapis.com/tokeninfo?id_token=";

        $client = new Google_Client(['client_id' => env('IMAMS_GOOGLE_CLIENT_ID')]);
        // Specify the CLIENT_ID of the app that accesses the backend

        $id_token = $request->only('id_token');

        $validator = Validator::make($id_token, [
            'id_token' => "required"
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $data = $client->verifyIdToken($id_token);
        if ($data) {
            $user = User::where('email', '=', $data->email)->first();

            if (!$user) {
                $user = new User();
                $user->name = $data->name;
                $user->email = $data->email;
                $user->provider_id = $data->sub;
                $user->avatar = $data->picture;
                $user->save();
            }

            if($user){
                $user->provider_id = $data->sub;
                $user->avatar = $data->picture;
                $user->save();
            }
            return $this->respondWithToken($id_token);
            // If request specified a G Suite domain:
            //$domain = $payload['hd'];
        } else {
            return response()->json(["message"=> "Not found or id_token expired!"], 400);
        }
    }

    public function github(Request $request)
    {
        $id_token = $request->only('id_token');

        $validator = Validator::make($id_token, [
            'id_token' => "required"
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $response = Http::withHeaders([
            'Authorization' => 'token '.$request->id_token
        ])->get('https://api.github.com/user');

        $data = $response->json();

        if ($data) {
            $user = User::where('email', '=', $data->email)->first();

            if (!$user) {
                $user = new User();
                $user->name = $data->name;
                $user->email = $data->email;
                $user->provider_id = $data->id;
                $user->avatar = $data->avatar_url;
                $user->save();
            }

            if($user){
                $user->provider_id = $data->id;
                $user->avatar = $data->avatar_url;
                $user->save();
            }
            return $this->respondWithToken($id_token);
        } else {
            return response()->json(["message"=> "Not found or id_token expired!"], 400);
        }
    }
}
