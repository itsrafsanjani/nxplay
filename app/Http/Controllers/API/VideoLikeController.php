<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Video;
use App\Models\VideoLike;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VideoLikeController extends Controller
{
    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function likeOrDislike(Request $request): \Illuminate\Http\JsonResponse
    {
        $rules = [
            'user_id' => 'required',
            'video_id' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()){
            return response()->json($validator->errors(), 422);
        }

        $user_id = $request->input('user_id');
        $video_id = $request->input('video_id');
        $status = $request->input('status');

        try {
            $likeIdCheck = VideoLike::where([
                'user_id' => $user_id,
                'video_id' => $video_id
            ])->first();

            if ($likeIdCheck == null) {
                VideoLike::create([
                    'user_id' =>$user_id,
                    'video_id' => $video_id,
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

            $statusUpdate['status'] = (bool)$status;
            $statusUpdate['likes'] = VideoLike::where('video_id', $video_id)->where('status', 1)->count();
            $statusUpdate['dislikes'] = VideoLike::where('video_id', $video_id)->where('status', 0)->count();

            return response()->json($statusUpdate, 200);

        } catch (\Exception $exception) {
            return response()->json($exception->getMessage(), 400);
        }
    }
}