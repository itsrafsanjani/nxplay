<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $data['videos'] = Video::with('user')->select('id', 'title', 'imdb_rating', 'type', 'views', 'status', 'user_id', 'created_at', 'updated_at')->orderBy('id', 'desc')->paginate(20);
        return view('backend.video.index', $data);
//        return $data;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.video.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $rules = [
            'user_id' => 'required',
            'title' => 'required|min:5',
            'description' => 'required|min:5',
            'runtime' => 'required',
            'year' => 'required',
            'imdb_id' => 'required',
            'imdb_rating' => 'required',
            'genres' => 'required',
            'country' => 'required',
            'poster' => 'required',
            'type' => 'required',
            'video' => 'required',
            'status' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $poster = $request->file('poster');
        $imageFile = $poster->getClientOriginalName();
        $imageFileName = pathinfo($imageFile, PATHINFO_FILENAME);
        $extension = pathinfo($imageFile, PATHINFO_EXTENSION);
        $imageName = Str::slug($imageFileName).'-'.Str::orderedUuid().'.'.$extension;

        $video = $request->file('video');
        $videoFile = $video->getClientOriginalName();
        $videoFileName = pathinfo($videoFile, PATHINFO_FILENAME);
        $extension = pathinfo($videoFile, PATHINFO_EXTENSION);
        $videoName = Str::slug($videoFileName).'-'.Str::orderedUuid().'.'.$extension;

        $data = [
            'user_id' => $request->input('user_id'),
            'title' => trim($request->input('title')),
            'description' => $request->input('description'),
            'runtime' => $request->input('runtime'),
            'year' => $request->input('year'),
            'imdb_id' => $request->input('imdb_id'),
            'imdb_rating' => $request->input('imdb_rating'),
            'genres' => json_encode($request->input('genres')),
            'country' => $request->input('country'),
            'poster' => $imageName,
            'type' => $request->input('type'),
            'video' => $videoName,
            'status' => $request->input('status'),
        ];
        try {
            Video::create($data);

            if($poster->isValid() && $video->isValid()){
                $poster->storeAs('images', $imageName);
                $video->storeAs('videos', $videoName);
            }

            session()->flash('message','Video upload successful');
            session()->flash('type','success');
            return redirect()->back();
        } catch (Exception $e) {
            session()->flash('message', $e->getMessage());
            session()->flash('type','danger');
            return redirect()->back();
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['video'] = Video::select('id', 'title', 'description', 'year', 'runtime', 'country', 'genres', 'imdb_id', 'imdb_rating', 'type', 'status')->find($id);
        return view('backend.video.edit', $data);
//        return $data;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
                'title' => 'required|min:5',
                'description' => 'required|min:5',
                'runtime' => 'required',
                'year' => 'required',
                'imdb_id' => 'required',
                'imdb_rating' => 'required',
                'genres' => 'required',
                'country' => 'required',
                'type' => 'required',
                'status' => 'required',
        ]);

        // database update
        $video = Video::find($id);
        $video->update($request->all());

        // redirect
        session()->flash('message', 'Video updated');
        session()->flash('type', 'success');
        return redirect()->route('videos.index');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $video = Video::find($id);
        $videoPoster = $video->poster;
        $videoVideo = $video->video;

        if(file_exists($videoPoster)){
            @unlink($videoPoster);
        }
        if(file_exists($videoVideo)){
            @unlink($videoVideo);
        }

        $video->delete();
        session()->flash('message', 'Video deleted');
        session()->flash('type', 'success');
        return redirect()->back();
    }
}
