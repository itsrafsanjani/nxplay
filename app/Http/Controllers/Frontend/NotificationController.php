<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        $id = auth()->user()->id;
        $user = User::findOrFail($id);

        $data['user'] = $user;

        return view('frontend.notification.index', $data);
    }
}
