<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $data['comments'] = Comment::
        with('user:id,name,avatar', 'video:id,title,slug')
            ->select('id', 'user_id', 'video_id', 'comment_text', 'parent_id', 'created_at')
            ->latest()
            ->paginate();

        return view('backend.comment.index', $data);
//        return $data;
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
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['comment'] = Comment::findOrFail($id);

        return view('backend.comment.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['comment'] = Comment::findOrFail($id);

        return view('backend.comment.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'comment_text' => 'required|max:255'
        ]);

        $comment = Comment::findOrFail($id);

        $comment->update([
            'comment_text' => $request->comment_text
        ]);

        session()->flash('message', 'Comment updated');
        session()->flash('type', 'success');
        return redirect()->route('comments.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);

        $comment->delete();
        session()->flash('message', 'Comment deleted');
        session()->flash('type', 'success');
        return back();
    }
}
