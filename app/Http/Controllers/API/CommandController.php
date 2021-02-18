<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class CommandController extends Controller
{
    public function clearCache(Request $request): \Illuminate\Http\JsonResponse
    {
        $username = $request->username;
        $password = $request->password;

        if($username == "nxplay" && $password == "AreyHogaMarseRe!"){
            Artisan::call('optimize:clear');

            return response()->json(['message' => 'Command executed successfully!']);
        }

        return response()->json(['message' => 'username, password mone nai abar command maraite aicho!']);
    }

    public function refreshSeed(Request $request): \Illuminate\Http\JsonResponse
    {
        $username = $request->username;
        $password = $request->password;

        if($username == "nxplay" && $password == "AreyHogaMarseRe!"){
            Artisan::call('migrate:refresh --seed');
            return response()->json(['message' => 'migrate:refresh --seed command executed successfully!']);
        }

        return response()->json(['message' => 'username, password mone nai abar command maraite aicho!']);
    }
}
