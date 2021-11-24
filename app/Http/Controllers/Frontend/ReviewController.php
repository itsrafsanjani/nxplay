<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReviewController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $validated = $request->validate([
            'video_id' => 'required',
            'title' => 'required|max:50',
            'body' => 'required',
            'rating' => 'required'
        ]);

        $userId = auth()->id();
        $videoId = $request->video_id;

        $review = Review::where('user_id', $userId)->where('video_id', $videoId)->first();

        try {
            if (!$review) {
                auth()->user()->reviews()->create($validated);
                session()->flash('message','Review added.');
                session()->flash('type','success');
                return back();
            }
            session()->flash('message', 'You can not review twice. Delete old review to give a new one.');
            session()->flash('type','danger');
            return back();
        } catch (\Exception $exception) {
            session()->flash('message', $exception->getMessage());
            session()->flash('type','danger');
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id): \Illuminate\Http\RedirectResponse
    {
        try {
            if(auth()->user()->id == Review::findOrFail($id)->user_id) {
                $review = Review::findOrFail($id);
                $review->delete();

                session()->flash('message','Review deleted.');
                session()->flash('type','success');
                return redirect()->back();
            }

            session()->flash('message', 'You do not have permission to delete this review.');
            session()->flash('type','danger');
            return redirect()->back();
        } catch (\Exception $exception) {
            session()->flash('message', $exception->getMessage());
            session()->flash('type','danger');
            return redirect()->back();
        }
    }
}
