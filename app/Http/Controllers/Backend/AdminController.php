<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Review;
use App\Models\User;
use App\Models\Video;

class AdminController extends Controller
{
    public function index()
    {

        // views count
        $views = Video::select('views')
            ->take(5)
            ->get();

        $viewsThisMonth = 0;

        foreach ($views as $view) {
            $viewsThisMonth += $view->views;
        }

        // items added this month
        $itemsAddedThisMonth = Video::where('created_at', '<', now()->addMonth())
            ->count('id');

        // new comments this week
        $newComments = Comment::where('created_at', '<', now()->addWeek())
            ->count('id');

        // new reviews this week
        $newReviews = Review::where('created_at', '<', now()->addWeek())
            ->count('id');

        // top videos
        $topVideos = Video::select('id', 'slug', 'title', 'type', 'imdb_rating')
            ->latest('views')
            ->take(5)
            ->get();

        // latest videos
        $latestVideos = Video::select('id', 'slug', 'title', 'type', 'imdb_rating', 'status')
            ->latest()
            ->take(5)
            ->get();

        // latest users
        $latestUsers = User::select('id', 'name', 'email', 'last_login_at')
            ->latest()
            ->take(5)
            ->get();

        // latest reviews
        $latestReviews = Review::with('user:id,name,avatar')
            ->select('id', 'user_id', 'title', 'rating')
            ->latest()
            ->take(5)
            ->get();


        return view('backend.admin', compact('viewsThisMonth', 'itemsAddedThisMonth', 'newComments', 'newReviews', 'topVideos', 'latestVideos', 'latestUsers', 'latestReviews'));
    }
}
