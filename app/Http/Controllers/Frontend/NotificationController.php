<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

class NotificationController extends Controller
{
    public function index()
    {
        $data['notifications'] = auth()->user()->notifications()->paginate(20);

        return view('frontend.notification.index', $data);
    }
}
