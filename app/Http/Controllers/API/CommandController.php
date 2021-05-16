<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class CommandController extends Controller
{
    public function checkAccess($request): bool
    {
        $username = $request->username;
        $password = $request->password;

        if ($username == config('api_command.username') && $password == config('api_command.password')) {
            return true;
        }

        return false;
    }

    public function clearCache(Request $request): \Illuminate\Http\JsonResponse
    {
        if ($this->checkAccess($request)) {
            Artisan::call('optimize:clear');

            return response()->json([
                'success' => true,
                'status_code' => 200,
                'message' => 'Command executed successfully!'
            ]);
        }

        return response()->json([
            'success' => false,
            'status_code' => 403,
            'message' => 'username, password does not match!'
        ], 401);
    }

    public function refreshSeed(Request $request): \Illuminate\Http\JsonResponse
    {
        if ($this->checkAccess($request)) {
            Artisan::call('migrate:refresh --seed');
            return response()->json([
                'success' => true,
                'status_code' => 200,
                'message' => 'migrate:refresh --seed command executed successfully!'
            ]);
        }

        return response()->json([
            'success' => false,
            'status_code' => 403,
            'message' => 'username, password does not match!'
        ], 401);
    }
}
