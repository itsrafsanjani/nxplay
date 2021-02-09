<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class CommandController extends Controller
{
    public function execute(Request $request): \Illuminate\Http\JsonResponse
    {
        $username = $request->username;
        $password = $request->password;

        if($username == "nxplay" && $password == "AreyHogaMarseRe!"){
            Artisan::call('cache:clear');
            Artisan::call('route:clear');
            Artisan::call('config:clear');
            Artisan::call('view:clear');

            return response()->json(['message' => 'All command executed successfully!']);
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
