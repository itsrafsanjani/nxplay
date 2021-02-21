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
        $rules = [
            'user_id' => 'required',
            'video_id' => 'required',
            'title' => 'required|max:50',
            'body' => 'required',
            'rating' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user_id = $request->input('user_id');
        $video_id = $request->input('video_id');

        $review = Review::where('user_id', $user_id)->where('video_id', $video_id)->first();

        $data = [
            'user_id' => $user_id,
            'video_id' => $video_id,
            'title' => $request->input('title'),
            'body' => $request->input('body'),
            'rating' => $request->input('rating')
        ];

        try {
            if (!$review) {
                Review::create($data);
                session()->flash('message','Review added.');
                session()->flash('type','success');
                return redirect()->back();
            }
            session()->flash('message', 'You can not review twice. Delete old review to give a new one.');
            session()->flash('type','danger');
            return redirect()->back();
        } catch (\Exception $exception) {
            session()->flash('message', $exception->getMessage());
            session()->flash('type','danger');
            return redirect()->back();
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
