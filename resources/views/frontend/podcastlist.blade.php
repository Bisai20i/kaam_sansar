@extends('frontend.layouts.main')

@section('title', 'Podcast List')

@section('content')
    <style>

    </style>
    <section class="container-fluid mt-5 podcastlist">
        <div class="container-md border border-1 border-dark-subtle rounded p-3 my-4">
            <div class="row px-3 my-2">
                <h4>Our Podcasts</h4>
            </div>
            <div class="row px-3 gap-2">
                    @foreach ($podcasts as $item)
                        <div class="card col col-md-6 col-lg-3 flex-grow-1 p-1">
                            <a href="{{ route('frontend.podcast-detail', ['slug' => $item->slug]) }}"
                                class="text-decoration-none">
                                <div class="pi">
                                    <img src="{{ $item->imageUrl ? $item->imageUrl : asset('frontend/assets/Images/default.png') }}" class="card-img-top" alt="...">
                                    <div class="pio">
                                        <h1><i class="fa-solid fa-circle-play fs-1 text-white"></i></h1>
                                    </div>
                                </div>
                                <div class="card-body lh-1" style="padding: .5rem;">
                                    <div class="row">
                                        <p class="card-title fw-bold text-black">{{ $item->title }}</p>
                                    </div>
                                    <p class="card-text"> <small class="text-body-secondary fw-bold">
                                            @php
                                                $podcastDuration = \Carbon\Carbon::parse($item->podcastTime);
                                            @endphp
                                            {{ $podcastDuration->hour }} hour {{ $podcastDuration->minute }} minutes
                                            {{ $podcastDuration->second }} sec
                                        </small></p>

                                    <p class="card-text">
                                        <small>{{ \Carbon\Carbon::parse($item->created_at)->format('Y/m/d') }}</small>
                                    </p>
                                </div>
                            </a>
                        </div>
                    @endforeach




            </div>
            <div class="row mt-3">
                <nav>
                    <ul class="pagination justify-content-end converter">
                        @if ($podcasts->onFirstPage())
                            <li class="page-item disabled d-none">
                                <a class="page-link primary_color_text">Previous</a>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link primary_color_text"
                                    href="{{ $podcasts->previousPageUrl() }}">Previous</a>
                            </li>
                        @endif

                        @foreach ($podcasts->getUrlRange(1, $podcasts->lastPage()) as $page => $url)
                            @if ($page == $podcasts->currentPage())
                                <li class="page-item page-item active"><a class="page-link primary_color_text"
                                        href="#">{{ $page }}</a></li>
                            @else
                                <li class="page-item"><a class="page-link primary_color_text"
                                        href="{{ $url }}">{{ $page }}</a></li>
                            @endif
                        @endforeach

                        @if ($podcasts->currentPage() < $podcasts->lastPage() - 2)
                            <li class="page-item"><a class="page-link primary_color_text">...</a></li>
                            <li class="page-item"><a class="page-link primary_color_text"
                                    href="{{ $podcasts->url($podcasts->lastPage()) }}">{{ $podcasts->lastPage() }}</a>
                            </li>
                        @endif

                        @if ($podcasts->hasMorePages())
                            <li class="page-item">
                                <a class="page-link primary_color_text" href="{{ $podcasts->nextPageUrl() }}">Next</a>
                            </li>
                        @else
                            <li class="page-item disabled">
                                <a class="page-link primary_color_text">Next</a>
                            </li>
                        @endif
                    </ul>
                </nav>
            </div>
        </div>
    </section>
@endsection
