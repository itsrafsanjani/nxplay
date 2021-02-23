<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\User;
use App\Models\Video;
use App\Notifications\SomeoneReplied;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request): \Illuminate\Http\JsonResponse
    {
        $video_id = $request->video_id;

        $comments = Comment::select('id', 'user_id', 'video_id', 'comment_text', 'parent_id', 'created_at')
            ->with('user:id,name,avatar',
                'commentLikes:id,comment_id,user_id,status',
                'commentDislikes:id,comment_id,user_id,status')
            ->withCount('replies', 'commentLikes', 'commentDislikes')
            ->where('video_id', '=', $video_id)
            ->whereNull('parent_id')
            ->latest()
            ->paginate(20);

        return response()->json($comments, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        try {
            $user_id = auth()->user()->id;
            $video_id = $request->input('video_id');
            $parent_id = $request->input('parent_id');
            $comment_text = $request->input('comment_text');
            $replied_to_id = $request->input('replied_to_id');

            $this->validate($request, [
                'video_id' => 'required',
                'comment_text' => 'required|max:255',
                'parent_id' => 'sometimes',
                'replied_to_id' => 'sometimes'
            ]);

            $comment = Comment::create([
                'user_id' => $user_id,
                'video_id' => $video_id,
                'comment_text' => $comment_text,
                'parent_id' => $parent_id,
                'replied_to_id' => $replied_to_id
            ]);

            if (!empty($parent_id && $replied_to_id)) {
                $user = Comment::findOrFail($replied_to_id)->user_id;
                $toUser = User::findOrFail($user);
                $fromUser = User::findOrFail($user_id);
                $video = Video::findOrFail($video_id);
                $toUser->notify(new SomeoneReplied($fromUser, $comment, $video));
                $toUser->commentPushNotification($fromUser, $comment, $video);
            }
            return response()->json($comment, 201);
        } catch (\Exception $exception) {
            return response()->json($exception->getMessage(), 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $replies = Comment::
        with('user:id,name,avatar',
            'commentLikes:id,comment_id,user_id,status',
            'commentDislikes:id,comment_id,user_id,status')
            ->where('parent_id', '=', $id)
            ->select('id', 'user_id', 'video_id', 'comment_text', 'parent_id', 'created_at')
            ->latest()
            ->paginate(20);

        return response()->json($replies, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        try {
            if (auth()->user()->id == Comment::findOrFail($id)->user_id) {
                $review = Comment::findOrFail($id);
                $review->delete();
                return response()->json(['message' => 'Comment deleted.'], 200);
            }
            return response()->json([
                'message' => 'You do not have permission to delete this comment.'
            ], 403);
        } catch (\Exception $exception) {
            return response()->json($exception->getMessage(), 500);
        }
    }
}
