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
     * @return \Illuminate\Http\JsonResponse
     */
    public function likeOrDislike(Video $video, Request $request): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            'status' => 'required|boolean'
        ]);

        $status = $request->status;

        try {
            $likeIdCheck = VideoLike::where([
                'user_id' => auth()->id(),
                'video_id' => $video->id
            ])->first();

            if ($likeIdCheck == null) {
                VideoLike::create([
                    'user_id' => auth()->id(),
                    'video_id' => $video->id,
                    'status' => $status
                ]);
            } elseif ($likeIdCheck->status == $status) {
                $newData = VideoLike::find($likeIdCheck->id);
                $newData->update([
                    'status' => null
                ]);
            } elseif ($likeIdCheck->status == !$status) {
                $newData = VideoLike::find($likeIdCheck->id);
                $newData->update([
                    'status' => $status
                ]);
            } elseif ($likeIdCheck->status == null) {
                $newData = VideoLike::find($likeIdCheck->id);
                $newData->update([
                    'status' => $status
                ]);
            }

            $statusUpdate['status'] = VideoLike::find($likeIdCheck->id)->status;
            $statusUpdate['likes'] = VideoLike::where('video_id', $video->id)->where('status', 1)->count();
            $statusUpdate['dislikes'] = VideoLike::where('video_id', $video->id)->where('status', 0)->count();

            return response()->json($statusUpdate);
        } catch (\Exception $exception) {
            return response()->json($exception->getMessage(), 500);
        }
    }
}
