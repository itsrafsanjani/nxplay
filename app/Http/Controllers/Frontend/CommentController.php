<?php

namespace App\Http\Controllers\Frontend;

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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $rules = [
            'user_id' => 'required',
            'video_id' => 'required',
            'comment_text' => 'required|max:255'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $parent_id = $request->input('comment_id');
        $user_id = $request->input('user_id');
        $video_id = $request->input('video_id');
        $replied_to_id = $request->input('replied_to_id');

        $data = [
            'user_id' => $request->input('user_id'),
            'video_id' => $video_id,
            'comment_text' => $request->input('comment_text'),
            'parent_id' => $parent_id,
            'replied_to_id' => $replied_to_id
        ];

        try {
            $comment = Comment::create($data);

            if (!empty($parent_id && $replied_to_id)) {
                $user = Comment::findOrFail($replied_to_id)->user_id;
                $toUser = User::findOrFail($user);
                $fromUser = User::findOrFail($user_id);
                $video = Video::findOrFail($video_id);
                $toUser->notify(new SomeoneReplied($fromUser, $comment, $video));
                $toUser->commentPushNotification($fromUser, $comment, $video);
            }

            session()->flash('message', 'Comment added.');
            session()->flash('type', 'success');
            return redirect()->back();
        } catch (\Exception $exception) {
            session()->flash('message', $exception->getMessage());
            session()->flash('type', 'danger');
            return redirect()->back();
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id): \Illuminate\Http\RedirectResponse
    {
        try {
            if (auth()->user()->id == Comment::findOrFail($id)->user_id) {
                $comment = Comment::findOrFail($id);
                $comment->delete();

                session()->flash('message', 'Comment deleted.');
                session()->flash('type', 'success');
                return redirect()->back();
            }

            session()->flash('message', 'You do not have permission to delete this comment.');
            session()->flash('type', 'danger');
            return redirect()->back();
//            dd($id);
        } catch (\Exception $exception) {
            session()->flash('message', $exception->getMessage());
            session()->flash('type', 'danger');
            return redirect()->back();
        }
    }
}
