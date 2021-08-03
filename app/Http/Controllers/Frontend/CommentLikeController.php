<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\CommentLike;
use Illuminate\Http\Request;

class CommentLikeController extends Controller
{
    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function commentLikeOrDislike(Comment $comment, Request $request)
    {
        $likeIdCheck = CommentLike::where([
            'user_id' => auth()->user()->id,
            'comment_id' => $comment->id
        ])->first();

        $status = $request->input('status');

        if ($likeIdCheck == null) {
            CommentLike::create([
                'user_id' => auth()->user()->id,
                'comment_id' => $comment->id,
                'status' => $status
            ]);
        }   else if ($likeIdCheck->status == $status) {
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

        return redirect()->back();
    }
}
