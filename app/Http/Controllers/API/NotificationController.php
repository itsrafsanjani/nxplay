<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = auth()->user()->notifications()->paginate(20);

        return response($notifications, 200);
    }
}
