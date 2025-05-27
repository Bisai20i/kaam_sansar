@extends('frontend.layouts.main')

@section('title', 'Podcast Details')

@section('content')

<section class="container-fluid mt-5 news">
    <div class="container-lg">
        <div class="row">
            <div class="col-lg-9 col-12 border border-1 border-dark-subtle rounded p-3 my-4">
                <a href="{{ route('frontend.podcasts') }}" class="text-decoration-none">
                    <h5 class="primary_color_text"><i class="fa-solid fa-chevron-left"></i> Back to Podcasts
                        List
                    </h5>
                </a>

                <div class="row justify-content-between">
                    <div class="col-auto mt-3">
                        <h4 class="text-black">{{ $podcast_detail->title }}</h4>
                    </div>
                    <div class="col-auto d-flex align-items-center gap-3">


                        <!-- Bookmark Button -->
                        @auth('job_seekers')
                        @php
                        $isBookmarked = in_array($podcast_detail->id, $bookmarkedPodcastIds);
                        @endphp

                        @if ($isBookmarked)
                        <!-- Remove Bookmark Form -->
                        <form action="{{ route('podcastBookmark.remove', ['podcastId' => $podcast_detail->id]) }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" style="border:none; background:none; padding:0; cursor:pointer;" title="Remove Bookmark">
                                <i class="fas fa-bookmark bookmark-icon text-primary fs-5"></i>
                            </button>
                        </form>
                        @else
                        <!-- Add Bookmark Form -->
                        <form action="{{ route('bookmark.podcast') }}" method="POST" style="display:inline;">
                            @csrf
                            <input type="hidden" name="blogs_and_podcasts_id" value="{{ $podcast_detail->id }}">
                            <input type="hidden" name="type" value="podcast">
                            <button type="submit" style="border:none; background:none; padding:0; cursor:pointer;" title="Add Bookmark">
                                <i class="far fa-bookmark bookmark-icon text-muted fs-5"></i>
                            </button>
                        </form>
                        @endif
                        @else
                        <!-- Guest: Show login modal -->
                        <button type="button" style="border:none; background:none; padding:0; cursor:pointer;" data-bs-toggle="modal" data-bs-target="#loginModal">
                            <i class="far fa-bookmark bookmark-icon text-muted fs-5"></i>
                        </button>
                        @endauth
                        <!-- Share Icon moved here -->
                        <a href="#" class="text-decoration-none text-secondary" data-bs-toggle="modal" data-bs-target="#shareModal" title="Share this blog">
                            <i class="fa fa-share-alt fs-5" aria-hidden="true"></i> </a>

                    </div>
                </div>


                <p class="mb-2" style="font-size: 18px; color: #555555;">Published on {{ \Carbon\Carbon::parse($podcast_detail->created_at)->format('F d, Y') }}</p>
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


                <!-- View and Share Count Section -->
                <div class="card-body d-flex justify-content-end gap-3">

                    <p class="m-0">
                        <span class="text-secondary d-flex align-items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                class="bi bi-eye" viewBox="0 0 16 16">
                                <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8a13.133 13.133 0 0 1-1.66 2.043C11.879 11.332 10.12 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.133 13.133 0 0 1 1.172 8z" />
                                <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM8 7a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                            </svg>
                            {{ $podcast_detail->views_count }}
                        </span>
                    </p>

                   
                </div>



            </div>

            <div class="col-lg-3 col-12 my-4 ps-lg-4">
                <h3 style="color: #212529;">Podcasts</h3>

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


<!-- Share Modal -->
<div class="modal fade" id="shareModal" tabindex="-1" aria-labelledby="shareModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered rounded-3 p-4" style="max-width: 500px;">
        <div class="modal-content">
            <div class="modal-header bg-white border-0">
                <h5 class="modal-title text-black" id="shareModalLabel" style="font-size:22px; font-weight:500;">Share this product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center pt-4">
                <div class="d-flex justify-content-center mb-4 gap-5">
                    <!-- Facebook -->
                    <div class="text-center">
                        <div class="social-icon mb-1 text-white d-flex justify-content-center align-items-center mx-auto"
                            style="background-color:#1877F2; width:60px; height:60px; border-radius:50%; cursor:pointer;"
                            onclick="window.open('https://www.facebook.com/sharer/sharer.php?u='+encodeURIComponent(window.location.href), '_blank')">
                            <i class="bi bi-facebook fs-4"></i>
                        </div>
                        <div style="font-size: 14px; font-weight: 400;">Facebook</div>
                    </div>

                    <!-- WhatsApp -->
                    <div class="text-center">
                        <div class="social-icon mb-1 text-white d-flex justify-content-center align-items-center mx-auto"
                            style="background-color:#25D366; width:60px; height:60px; border-radius:50%; cursor:pointer;"
                            onclick="window.open('https://api.whatsapp.com/send?text='+encodeURIComponent(window.location.href), '_blank')">
                            <i class="bi bi-whatsapp fs-4"></i>
                        </div>
                        <div style="font-size: 14px; font-weight: 400;">Whatsapp</div>
                    </div>

                    <!-- Telegram -->
                    <div class="text-center">
                        <div class="social-icon mb-1 text-white d-flex justify-content-center align-items-center mx-auto"
                            style="background-color:#0088CC; width:60px; height:60px; border-radius:50%; cursor:pointer;"
                            onclick="window.open('https://t.me/share/url?url='+encodeURIComponent(window.location.href), '_blank')">
                            <i class="bi bi-telegram fs-4"></i>
                        </div>
                        <div style="font-size: 14px; font-weight: 400;">Telegram</div>
                    </div>
                </div>

                <hr>
                <p class="text-start mb-2" style="font-size: 14px; color: #555555;">Copy link or refer to friend to get rewards.</p>
                <div class="input-group rounded-2 mb-3" style="border: 0.5px solid #E3E3E3;">
                    <input type="text" class="form-control" id="shareLink" value="{{ url()->current() }}" readonly>
                    <button class="btn" type="button"
                        style="background-color: #F9F9F9; border: 0.5px solid #E3E3E3;" onclick="copyModalLink()">Copy</button>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection