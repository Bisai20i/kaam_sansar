@extends('frontend.profile.jobseeker-dashboard')

@section('profileSection')

<!-- Bookmarked Podcasts Section -->
<div class="page-border-container p-3 rounded" style="border: 1px solid #B8B8B8;">

    <div id="myPodcasts" class="content-section">
        <div class="row px-3 my-2">
            <h4>My Bookmarked Podcasts</h4>
        </div>

        @if ($podcasts->isEmpty())
        <div class="row px-3 my-4">
            <p>No bookmarked podcasts found.</p>
        </div>
        @else
        <div class="row gx-3 gy-4 px-3">
            @foreach ($podcasts as $podcast)
            <div class="col-4">
                <div class="card p-1" style="border: 1px solid #3b82f6; height:280px;">
                    <a href="{{ route('frontend.podcast-detail', ['slug' => $podcast->slug]) }}" class="text-decoration-none text-reset d-block">
                        <div class="pi position-relative">
                            <img src="{{ $podcast->imageUrl ? asset('storage/' . $podcast->imageUrl) : asset('frontend/assets/Images/default.png') }}"
                                class="card-img-top" alt="Podcast Image">
                            <div class="pio position-absolute top-50 start-50 translate-middle">
                                <h1><i class="fa-solid fa-circle-play fs-1 text-white"></i></h1>
                            </div>
                        </div>

                        <div class="card-body lh-1" style="padding: .5rem;">
                            <div class="d-flex align-items-center justify-content-between">
                                <p class="card-title fw-bold text-black mb-0">{{ $podcast->title }}</p>

                                <form method="POST" action="{{ route('podcastBookmark.remove', ['podcastId' => $podcast->id]) }}">
                                    @csrf
                                    <button type="submit" class="btn btn-link p-0 text-primary" title="Remove Bookmark" style="text-decoration: none;">
                                        <i class="fa-solid fa-bookmark fa-lg"></i>
                                    </button>
                                </form>
                            </div>

                            <p class="card-text mb-1">
                                <small class="text-body-secondary fw-bold">
                                    @php
                                    $podcastDuration = \Carbon\Carbon::parse($podcast->podcastTime);
                                    @endphp
                                    {{ $podcastDuration->hour }} hour {{ $podcastDuration->minute }} minutes {{ $podcastDuration->second }} sec
                                </small>
                            </p>
                            <p class="card-text">
                                <small>{{ \Carbon\Carbon::parse($podcast->created_at)->format('Y/m/d') }}</small>
                            </p>
                        </div>
                    </a>
                </div>
            </div>
            @endforeach

        </div>
        @endif
    </div>

</div>

@endsection