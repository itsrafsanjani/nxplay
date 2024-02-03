<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreVideoRequest;
use App\Http\Requests\UpdateVideoRequest;
use App\Models\Video;
use App\Services\TmdbService;
use App\Services\VideoService;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Pion\Laravel\ChunkUpload\Exceptions\UploadFailedException;
use Pion\Laravel\ChunkUpload\Handler\HandlerFactory;
use Pion\Laravel\ChunkUpload\Receiver\FileReceiver;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $videos = Video::with('user')
            ->latest()
            ->paginate();

        return view('backend.video.index', compact('videos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('backend.video.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreVideoRequest $request
     * @param TmdbService $tmdbService
     * @param VideoService $videoService
     * @return RedirectResponse
     */
    public function store(StoreVideoRequest $request, TmdbService $tmdbService, VideoService $videoService)
    {
        try {
            $movie = $tmdbService->getMovie($request->validated('tmdb_id'));
            $images = $tmdbService->getMovieImages($request->validated('tmdb_id'));

            $video = $videoService->store($movie, $images, $request->validated());

            session()->flash('message', 'New ' . $video->type . ' ' . $video->title . ' uploaded successfully!');
            session()->flash('type', 'success');
            return redirect()->back();
        } catch (Exception $e) {
            session()->flash('message', $e->getMessage());
            session()->flash('type', 'danger');
            return back()->withErrors([
                'video' => $request->input('video'),
            ])->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param Video $video
     * @return Response
     */
    public function show(Video $video)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Video $video
     * @return Application|Factory|View
     */
    public function edit(Video $video)
    {
        return view('backend.video.edit', compact('video'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateVideoRequest $request
     * @param Video $video
     * @return RedirectResponse
     */
    public function update(UpdateVideoRequest $request, Video $video)
    {
        $video->update($request->validated());

        // redirect
        session()->flash('message', 'VideoRule updated');
        session()->flash('type', 'success');
        return redirect()->route('videos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Video $video
     * @return RedirectResponse
     */
    public function destroy(Video $video)
    {
        Storage::delete($video->video);

        $video->delete();
        session()->flash('message', 'VideoRule deleted');
        session()->flash('type', 'success');
        return redirect()->back();
    }

    /**
     * @throws UploadFailedException
     */
    public function uploadVideo(Request $request)
    {
        $receiver = new FileReceiver('file', $request, HandlerFactory::classFromRequest($request));

        if (!$receiver->isUploaded()) {
            // file not uploaded
        }

        $fileReceived = $receiver->receive(); // receive file
        if ($fileReceived->isFinished()) { // file uploading is complete / all chunks are uploaded
            $file = $fileReceived->getFile(); // get file
            $fileName = Str::uuid() . '.' . $file->getClientOriginalExtension(); // a unique file name

            $path = Storage::disk('local')->putFileAs('videos', $file, $fileName);

            // delete chunked file
            unlink($file->getPathname());
            return [
                'path' => $path,
                // 'url' => Storage::url($path),
            ];
        }

        // otherwise return percentage information
        $handler = $fileReceived->handler();
        return [
            'done' => $handler->getPercentageDone(),
            'status' => true
        ];
    }
}
