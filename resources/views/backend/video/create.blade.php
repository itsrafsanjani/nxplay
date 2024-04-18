@extends('backend.layouts.app')

@push('styles')
    <style>
        /* Custom progress bar styles */
        .progress, video {
            display: none; /* Hidden by default */
        }

        .progress {
            height: 25px;
            background-color: #f0f0f0; /* Background color for the progress container */
            border-radius: 5px;
            overflow: hidden;
        }

        .progress-bar {
            height: 100%;
            background-color: #007bff; /* Progress bar color (blue) */
            color: white;
            text-align: center;
            line-height: 25px;
            font-weight: bold;
        }

        /* Animation styles (optional) */
        .progress-bar.progress-bar-striped {
            background: repeating-linear-gradient(
                45deg,
                #007bff,
                #007bff 10px,
                #0056b3 10px,
                #0056b3 20px
            );
            background-size: 200% 100%;
            animation: move 2s linear infinite;
        }

        @keyframes move {
            0% {
                background-position: 200% 0;
            }
            100% {
                background-position: -200% 0;
            }
        }
    </style>
@endpush

@section('content')
    <div class="container-fluid">
        <div class="row">
            <!-- main title -->
            <div class="col-12">
                <div class="main__title">
                    <h2>Add new item</h2>
                </div>
            </div>
            <!-- end main title -->

            @if ($errors->any())
                <div class="col-12">
                    <div class="alert alert-danger">
                        @if($errors->count() === 1)
                            <li>{{ $errors->first() }}</li>
                        @else
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>
            @endif

            @if(session()->has('message'))
                <div class="col-12">
                    <div class="alert alert-{{ session('type')}}">
                        {{ session('message') }}
                    </div>
                </div>
            @endif

            <!-- form -->
            <div class="col-12">
                <form action="{{ route('videos.store') }}" class="form" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="video" id="video" value="{{ old('video') }}">

                    @csrf
                    <div class="row">
                        <div class="col-12 col-md-7 form__content">
                            <div class="row">
                                <div class="col-12 col-sm-6">
                                    <input type="text" name="tmdb_id" class="form__input" placeholder="TMDb Id"
                                           value="{{ old('tmdb_id') }}">
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="row">
                                <div class="col-lg-6">
                                    <ul class="form__radio">
                                        <li>
                                            <span>Status:</span>
                                        </li>
                                        <li>
                                            <input id="type3" type="radio" name="status" value="1" checked>
                                            <label for="type3">Published</label>
                                        </li>
                                        <li>
                                            <input id="type4" type="radio" name="status" value="0">
                                            <label for="type4">Unpublished</label>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="row">
                                <div class="col-12 col-md-6 mb-2">
                                        <input type="button" id="browseFile" data-name="#movie1"
                                               class="btn btn-primary btn-block" value="Browse File">
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="progress mt-3 mb-3" style="height: 25px">
                                <div class="progress-bar progress-bar-striped progress-bar-animated"
                                     role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"
                                     style="width: 0; height: 100%">0%
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <video id="videoPreview" src="" controls style="width: 100%; height: auto"></video>
                        </div>

                        <div class="col-12">
                            <button type="submit" class="form__btn">publish</button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- end form -->
        </div>
    </div>
@endsection

@push('javascripts')
    <!-- Resumable JS -->
    <script src="https://cdn.jsdelivr.net/npm/resumablejs@1.1.0/resumable.min.js"></script>

    <script type="text/javascript">
        let browseFile = $('#browseFile');
        let resumable = new Resumable({
            target: '{{ route('videos.upload') }}',
            query: {
                _token: '{{ csrf_token() }}'
            },
            fileType: ['mp4'],
            headers: {
                'Accept': 'application/json'
            },
            testChunks: false,
            throttleProgressCallbacks: 1,
            chunkSize: 1 * 1024 * 1024,
        });

        resumable.assignBrowse(browseFile[0]);

        resumable.on('fileAdded', function (file) { // trigger when file picked
            showProgress();
            resumable.upload() // to actually start uploading.
        });

        resumable.on('fileProgress', function (file) { // trigger when file progress update
            updateProgress(Math.floor(file.progress() * 100));
        });

        resumable.on('fileSuccess', function (file, response) { // trigger when file upload complete
            response = JSON.parse(response)
            // $('#videoPreview').attr('src', response.url);
            $('#video').attr('value', response.path);
            $('.progress').hide();
            // $('video').show();
        });

        resumable.on('fileError', function (file, response) { // trigger when there is any error
            alert('file uploading error.')
        });


        let progress = $('.progress');

        function showProgress() {
            progress.find('.progress-bar').css('width', '0%');
            progress.find('.progress-bar').html('0%');
            progress.find('.progress-bar').removeClass('bg-success');
            progress.show();
        }

        function updateProgress(value) {
            progress.find('.progress-bar').css('width', `${value}%`)
            progress.find('.progress-bar').html(`${value}%`)
        }

        function hideProgress() {
            progress.hide();
        }
    </script>
@endpush
