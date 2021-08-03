<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Video;
use App\Models\VideoLike;
use Illuminate\Http\Request;

class VideoLikeController extends Controller
{
    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function likeOrDislike(Video $video, Request $request): \Illuminate\Http\RedirectResponse
    {
        $likeIdCheck = VideoLike::where([
            'user_id' => auth()->user()->id,
            'video_id' => $video->id
        ])->first();

        $status = $request->input('status');

        if ($likeIdCheck == null) {
            VideoLike::create([
                'user_id' => auth()->user()->id,
                'video_id' => $video->id,
                'status' => $status
            ]);
        } else if ($likeIdCheck->status == $status) {
            $newData = VideoLike::find($likeIdCheck->id);
            $newData->update([
                'status' => null
            ]);
        } else if ($likeIdCheck->status == !$status) {
            $newData = VideoLike::find($likeIdCheck->id);
            $newData->update([
                'status' => $status
            ]);
        } else if ($likeIdCheck->status == null) {
            $newData = VideoLike::find($likeIdCheck->id);
            $newData->update([
                'status' => $status
            ]);
        }

//        return response()->json($likeIdCheck);
        return redirect()->back();
    }
}
