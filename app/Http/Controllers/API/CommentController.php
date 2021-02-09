<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

        $comments = DB::table('comments')
            ->where('video_id', '=', $video_id)
            ->join('users', 'users.id', '=', 'comments.user_id')
            ->select('comments.id', 'users.name', 'users.email', 'users.avatar', 'comments.comment_text', 'comments.parent_id', 'comments.created_at', 'comments.updated_at')
            ->paginate(20);

        return response()->json($comments, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $rules = [
            'video_id' => 'required',
            'comment_text' => 'required|max:255'
        ];

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()){
            return response()->json($validator->errors(), 422);
        }

        $data = [
            'user_id' => auth()->user()->id,
            'video_id' => $request->input('video_id'),
            'comment_text' => $request->input('comment_text'),
            'parent_id' => $request->input('comment_id')
        ];

        try {
            Comment::create($data);
            return response()->json($data, 201);
        } catch (\Exception $exception) {
            return response()->json($exception->getMessage(), 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        try {
            if (auth()->user()->id == Comment::find($id)->user_id) {
                $review = Comment::find($id);
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
