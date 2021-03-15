<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Video;
use App\Notifications\NewVideoReleased;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Http;
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $rules = [
            'user_id' => 'required',
            'imdb_id' => 'required|unique:videos',
            'video' => 'required|mimes:mp4|max:102400', // Max 100 MB File
            'status' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $response = Http::get('http://www.omdbapi.com/?apikey=' . config('services.omdb.secret') . '&i=' . $request->imdb_id);

        $poster = Http::get('https://imdb-api.com/en/API/Posters/' . config('services.imdb.secret') . '/' . $request->imdb_id);

        $photo = Http::get('https://imdb-api.com/en/API/Images/' . config('services.imdb.secret') . '/' . $request->imdb_id . '/Short');


        if ($response) {
            $videoInfo = json_decode($response->body());

            $posters = json_decode($poster->body());

            $firstPoster = $posters->posters[0]->id;

            $photos = json_decode($photo->body());

            $allPhotos = [];

            foreach ($photos->items as $photo) {
                $allPhotos[] = str_replace('https://imdb-api.com/images/original/', '', $photo->image);
            }

            $video = $request->file('video');
            $videoFile = $video->getClientOriginalName();
            $videoFileName = pathinfo($videoFile, PATHINFO_FILENAME);
            $extension = pathinfo($videoFile, PATHINFO_EXTENSION);
            $videoName = Str::slug($videoFileName) . '-' . Str::orderedUuid() . '.' . $extension;
            $video->storeAs('videos', $videoName);

            $data = [
                'user_id' => $request->input('user_id'),
                'title' => $videoInfo->Title,
                'description' => $videoInfo->Plot,
                'runtime' => $videoInfo->Runtime,
                'year' => $videoInfo->Year,
                'imdb_id' => $request->input('imdb_id'),
                'imdb_rating' => $videoInfo->imdbRating,
                'genres' => json_encode(explode(',', $videoInfo->Genre)),
                'country' => json_encode(explode(',', $videoInfo->Country)),
                'directors' => json_encode(explode(',', $videoInfo->Director)),
                'actors' => json_encode(explode(',', $videoInfo->Actors)),
                'box_office' => isset($videoInfo->BoxOffice) ? $videoInfo->BoxOffice : null,
                'poster' => $firstPoster,
                'type' => $videoInfo->Type,
                'video' => '/storage/videos/' . $videoName,
                'photos' => json_encode($allPhotos),
                'age_rating' => $videoInfo->Rated,
                'status' => $request->input('status'),
            ];
        }

        try {
            $video = Video::create($data);

            /**
             * New Video Released Mail to All User
             */
            $users = User::all();
            Notification::send($users, new NewVideoReleased($video));

            /**
             * FCM Push Notification using Firebase
             * For mobile users
             */
            $user = User::findOrFail($video->user_id);
            $user->topicPushNotification('nxPlay', 'New ' . $video->type . ' "' . $video->title . '" released', 'Watch it here now!', $video->id, 'https://image.tmdb.org/t/p/w45/' . $video->poster);

            session()->flash('message', 'New ' . $video->type . ' ' . $video->title . ' uploaded successfully!');
            session()->flash('type', 'success');
            return redirect()->back();
        } catch (\Exception $e) {
            session()->flash('message', $e->getMessage());
            session()->flash('type', 'danger');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['video'] = Video::select('id', 'title', 'description', 'year', 'runtime', 'country', 'genres', 'imdb_id', 'imdb_rating', 'type', 'status')->findOrFail($id);
        return view('backend.video.edit', $data);
//        return $data;
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
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required|min:5',
            'runtime' => 'required',
            'year' => 'required',
            'imdb_rating' => 'required',
            'type' => 'required',
            'status' => 'required',
        ]);

        // database update
        $video = Video::findOrFail($id);
        $video->update($request->only('user_id', 'title', 'description', 'runtime', 'year', 'imdb_rating', 'type', 'status'));

        // redirect
        session()->flash('message', 'Video updated');
        session()->flash('type', 'success');
        return redirect()->route('videos.index');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $video = Video::findOrFail($id);
        $videoVideo = public_path() . 'storage/videos' . $video->video;

        if (file_exists($videoVideo)) {
            @unlink($videoVideo);
        }

        $video->delete();
        session()->flash('message', 'Video deleted');
        session()->flash('type', 'success');
        return redirect()->back();
    }
}
