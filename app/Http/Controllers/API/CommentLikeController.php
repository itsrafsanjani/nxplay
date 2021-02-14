<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\CommentLike;
use App\Models\VideoLike;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CommentLikeController extends Controller
{
    public function commentLikeOrDislike(Request $request)
    {
        $rules = [
            'comment_id' => 'required',
            'status' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $comment_id = $request->input('comment_id');
        $status = $request->input('status');

        $likeIdCheck = CommentLike::where([
            'user_id' => auth()->user()->id,
            'comment_id' => $comment_id
        ])->first();


        if ($likeIdCheck == null) {
            CommentLike::create([
                'user_id' => auth()->user()->id,
                'comment_id' => $comment_id,
                'status' => $status
            ]);
        } else if ($likeIdCheck->status == $status) {
            $newData = CommentLike::find($likeIdCheck->id);
            $newData->update([
                'status' => null
            ]);
        } else if ($likeIdCheck->status == !$status) {
            $newData = CommentLike::find($likeIdCheck->id);
            $newData->update([
                'status' => $status
            ]);
        } else if ($likeIdCheck->status == null) {
            $newData = CommentLike::find($likeIdCheck->id);
            $newData->update([
                'status' => $status
            ]);
        }
        try {
            $statusUpdate['status'] = CommentLike::find($likeIdCheck->id)->status;
            $statusUpdate['likes'] = CommentLike::where('comment_id', $comment_id)->where('status', 1)->count();
            $statusUpdate['dislikes'] = CommentLike::where('comment_id', $comment_id)->where('status', 0)->count();

            return response()->json($statusUpdate, 200);
        } catch (\Exception $exception) {
            return response()->json($exception->getMessage(), 500);
        }
    }
}
