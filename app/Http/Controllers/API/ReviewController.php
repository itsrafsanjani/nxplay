<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReviewController extends Controller
{
    public function index(Request $request): \Illuminate\Http\JsonResponse
    {
        $video_id = $request->input('video_id');

        $reviews = Review::
        with('user:id,name,avatar')
            ->where('video_id', $video_id)
            ->select('id', 'user_id', 'video_id', 'title', 'body', 'rating', 'created_at')
            ->latest()
            ->paginate(20);

        return response()->json($reviews, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $rules = [
            'video_id' => 'required',
            'title' => 'required|max:50',
            'body' => 'required',
            'rating' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $user_id = auth()->user()->id;
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
                $review = Review::create($data);
                return response()->json($review, 200);
            }
            return response()->json([
                'error' => 'You can not review twice. Delete old review to give a new one.'
            ], 403);
        } catch (\Exception $exception) {
            return response()->json($exception->getMessage(), 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id): \Illuminate\Http\JsonResponse
    {
        try {
            if (auth()->user()->id == Review::find($id)->user_id) {
                $review = Review::find($id);
                $review->delete();
                return response()->json(['message' => 'Review deleted.'], 200);
            }
            return response()->json([
                'message' => 'You do not have permission to delete this review.'
            ], 403);
        } catch (\Exception $exception) {
            return response()->json($exception->getMessage(), 500);
        }
    }
}
