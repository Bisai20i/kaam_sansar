@extends('frontend.layouts.main')

@section('title', 'Podcast List')

@section('content')
    <style>

    </style>
    <section class="container-fluid mt-5 podcastlist" style="min-height: 60vh">
        <div class="container-md border border-1 border-dark-subtle rounded p-3 my-4">
            <div class="row g-2 my-2">
                <h4>Our Podcasts</h4>
            </div>
            <div class="row ">
                @foreach ($podcasts as $item)
                    <div class="col-12  col-sm-6 col-md-4 col-lg-3">
                        <a href="{{ route('frontend.podcast-detail', ['slug' => $item->slug]) }}"
                            class="text-decoration-none p-1 card mb-2" style="min-height: 250px;">
                            <div class="pi">
                                <img src="{{ $item->imageUrl ? $item->imageUrl : asset('frontend/assets/Images/default.png') }}"
                                    class="card-img-top" alt="...">
                                <div class="pio">
                                    <h1><i class="fa-solid fa-circle-play fs-1 text-white"></i></h1>
                                </div>
                            </div>
                            <div class="card-body lh-1" style="padding: .5rem;">
                                <div class="row">
                                    <p class="card-title text-truncate mb-0">{{ $item->title }}</p>
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
                @if ($podcasts->lastPage() > 1)
                    <nav>
                        <ul class="pagination justify-content-end converter">
                            {{-- Previous Button --}}
                            @if ($podcasts->onFirstPage())
                                <li class="page-item disabled">
                                    <a class="page-link primary_color_text">&lt;</a>
                                </li>
                            @else
                                <li class="page-item">
                                    <a class="page-link primary_color_text"
                                        href="{{ $podcasts->previousPageUrl() }}">&lt;</a>
                                </li>
                            @endif

                            {{-- Pagination Numbers --}}
                            @php
                                $currentPage = $podcasts->currentPage();
                                $lastPage = $podcasts->lastPage();
                                $pageRange = 2;
                            @endphp

                            {{-- Show First Page --}}
                            @if ($currentPage > $pageRange + 1)
                                <li class="page-item">
                                    <a class="page-link primary_color_text" href="{{ $podcasts->url(1) }}">1</a>
                                </li>
                                @if ($currentPage > $pageRange + 2)
                                    <li class="page-item disabled"><span class="page-link">...</span></li>
                                @endif
                            @endif

                            {{-- Pages Before Current --}}
                            @for ($i = max(1, $currentPage - $pageRange); $i < $currentPage; $i++)
                                <li class="page-item">
                                    <a class="page-link primary_color_text"
                                        href="{{ $podcasts->url($i) }}">{{ $i }}</a>
                                </li>
                            @endfor

                            {{-- Current Page --}}
                            <li class="page-item active">
                                <span class="page-link" style="background: #196BA6;">{{ $currentPage }}</span>
                            </li>

                            {{-- Pages After Current --}}
                            @for ($i = $currentPage + 1; $i <= min($lastPage, $currentPage + $pageRange); $i++)
                                <li class="page-item">
                                    <a class="page-link primary_color_text"
                                        href="{{ $podcasts->url($i) }}">{{ $i }}</a>
                                </li>
                            @endfor

                            {{-- Show Last Page --}}
                            @if ($currentPage < $lastPage - $pageRange)
                                @if ($currentPage < $lastPage - $pageRange - 1)
                                    <li class="page-item disabled"><span class="page-link">...</span></li>
                                @endif
                                <li class="page-item">
                                    <a class="page-link primary_color_text"
                                        href="{{ $podcasts->url($lastPage) }}">{{ $lastPage }}</a>
                                </li>
                            @endif

                            {{-- Next Button --}}
                            @if ($podcasts->hasMorePages())
                                <li class="page-item">
                                    <a class="page-link primary_color_text" href="{{ $podcasts->nextPageUrl() }}">&gt;</a>
                                </li>
                            @else
                                <li class="page-item disabled">
                                    <a class="page-link primary_color_text">&gt;</a>
                                </li>
                            @endif
                        </ul>
                    </nav>
                @endif

            </div>

        </div>
    </section>
@endsection
