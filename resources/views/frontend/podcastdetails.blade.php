@extends('frontend.layouts.main')

@section('title', 'Podcast Details')

@section('content')

    <section class="container-fluid mt-5 news">
        <div class="container-lg">
            <div class="row">
                <div class="col-lg-9 col-12 border border-1 border-dark-subtle rounded p-3 my-4">
                    <a href="{{ route('frontend.podcasts') }}" class="text-decoration-none">
                        <h5 class="primary_color_text"><i class="fa-solid fa-chevron-left"></i> Back to Podcasts List</h5>
                    </a>

                    <div class="row justify-content-between">
                        <div class="col-auto">
                            <h4>{{ $podcast_detail->title }}</h4>
                        </div>
                        <div class="col-auto">
                            <a href="#" class="text-decoration-none text-black">
                                <i class="fa-solid fa-share-nodes"></i> Share
                            </a>
                        </div>
                    </div>

                    <small>Published on {{ \Carbon\Carbon::parse($podcast_detail->created_at)->format('F d, Y') }}</small>
                    <div id="video-container" class="relative w-auto aspect-w-16 aspect-h-9 cursor-pointer my-2"
                            onclick="loadVideo()">
                            <?php
                            // Extract the video ID from the YouTube link
                            parse_str(parse_url($podcast_detail->linkUrl, PHP_URL_QUERY), $yt_params);
                            $video_id = $yt_params['v'] ?? '';
                            ?>
                            <img id="video-thumbnail" src="{{ asset('storage/' . $podcast_detail->imageUrl) }}"
                                alt="YouTube Video Thumbnail" class="w-full h-full object-cover img-fluid">

                            <!-- Centered Play Icon -->
                            <div class="absolute inset-0 d-flex items-center justify-center bg-black bg-opacity-50">
                                <i class="fa-solid fa-circle-play fa-4x text-white m-auto"></i>
                            </div>
                        </div>
                    <div class="card mb-3 mt-2">
                        

                        <script>
                            function loadVideo() {
                                const container = document.getElementById('video-container');
                                const videoUrl = "{{ $podcast_detail->linkUrl }}";

                                if (videoUrl.includes("youtube.com") || videoUrl.includes("youtu.be")) {
                                    // Extract YouTube video ID
                                    const videoId = new URL(videoUrl).searchParams.get("v") || videoUrl.split("/").pop();
                                    container.innerHTML = `
                                        <iframe class="w-full h-full" 
                                            src="https://www.youtube.com/embed/${videoId}?autoplay=1&rel=0" 
                                            title="YouTube video player" frameborder="0" 
                                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                                            allowfullscreen></iframe>`;
                                } else if (videoUrl.includes("drive.google.com")) {
                                    // Extract Google Drive File ID
                                    const match = videoUrl.match(/\/d\/(.+?)\//);
                                    const fileId = match ? match[1] : null;

                                    if (fileId) {
                                        container.innerHTML = `
                                            <video class="w-full h-full" controls autoplay>
                                                <source src="https://drive.google.com/uc?export=download&id=${fileId}" type="video/mp4">
                                                Your browser does not support the video tag.
                                            </video>`;
                                    } else {
                                        console.error("Invalid Google Drive URL");
                                    }
                                } else {
                                    console.error("Unsupported video source");
                                }
                            }
                        </script>


                        <style>
                            .aspect-w-16 {
                                position: relative;
                                width: 100%;
                                padding-top: 56.25%;
                                /* 16:9 Aspect Ratio */
                            }

                            .aspect-w-16 iframe,
                            .aspect-w-16 img,
                            .aspect-w-16 div {
                                position: absolute;
                                top: 0;
                                left: 0;
                                width: 100%;
                                height: 100%;
                            }
                        </style>

                        <div class="card-body">
                            <p class="card-text">{{ strip_tags($podcast_detail->description) }}</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-12 my-4 ps-lg-4">
                    <h3>Podcasts</h3>

                    <div class="row row-cols-lg-1 row-cols-md-3 row-cols-1 g-4">
                        <div class="col">
                            @foreach ($similar_podcasts as $item)
                                <div class="card p-1 my-2">
                                    <a href="{{route('frontend.podcast-detail', ['slug' => $item->slug])}}" class="text-decoration-none text-black">
                                        <img src="{{$item->imageUrl? asset('storage/' . $item->imageUrl):asset('frontend/assets/Images/default.png') }}" class="card-img-top rounded"
                                            alt="...">
                                        <div class="card-body p-1">
                                            <h6 class="card-title">{{ $item->title }}</h6>
                                            <p class="card-text text-muted mb-1">
                                                @php
                                                    $podcastDuration = \Carbon\Carbon::parse($item->podcastTime);
                                                @endphp
                                                {{ $podcastDuration->hour }} hour {{ $podcastDuration->minute }} minutes
                                                {{ $podcastDuration->second }} sec
                                            </p>
                                            <p class="card-text text-muted">
                                                <small>{{ \Carbon\Carbon::parse($item->created_at)->format('Y/m/d') }}</small>
                                            </p>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>


                    </div>
                </div>
            </div>


        </div>
    </section>
@endsection
