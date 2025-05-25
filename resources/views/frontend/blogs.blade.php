@extends('frontend.layouts.main')

@section('title', 'Blogs')

@section('content')
<style>

</style>
<section class=" container-fluid mt-5 news">
    <div class="container-md border border-1 border-dark-subtle rounded p-3 my-4">
        <div class="row text-center my-2">
            <h4>Our News Articles</h4>
        </div>
        <div class="row g-3">
            @foreach ($blogs as $blog)
            <div class="col-md-6 col-lg-3 col-12 col-sm-12 job-card">
                <div class="card">
                    <a href="{{ route('frontend.news-detail', $blog->slug) }}" style="text-decoration:none;">
                        <img src="{{ $blog->imageUrl ? asset('storage/' . $blog->imageUrl) : asset('frontend/assets/Images/default.png') }}"
                            class="card-img-top rounded-1" alt="{{ $blog->title }}">
                    </a>

                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="card-title text-truncate mb-0">{{ $blog->title }}</h5>

                            @auth('job_seekers')
                            @php
                            $isBookmarked = \App\Models\BlogsAndPodcastsBookmark::where('job_seeker_id', auth()->id())
                            ->where('blogs_and_podcasts_id', $blog->id)
                            ->exists();
                            @endphp

                            @if ($isBookmarked)
                            <!-- Remove Bookmark -->
                            <form method="POST" action="{{ route('blogBookmark.remove', ['blogId' => $blog->id]) }}">
                                @csrf
                                <button type="submit" style="border:none; background:none; padding:0; cursor:pointer;">
                                    <i class="fas fa-bookmark text-primary" style="font-size:18px;"></i>
                                </button>
                            </form>
                            @else
                            <!-- Add Bookmark -->
                            <form action="{{ route('bookmark.blog') }}" method="POST" style="display:inline;">
                                @csrf
                                <input type="hidden" name="blogs_and_podcasts_id" value="{{ $blog->id }}">
                                <input type="hidden" name="type" value="blog">
                                <button type="submit" style="border:none; background:none; padding:0; cursor:pointer;">
                                    <i class="far fa-bookmark text-muted" style="font-size:18px;"></i>
                                </button>
                            </form>
                            @endif
                            @else
                            <!-- Guest Bookmark -->
                            <button type="button" style="border:none; background:none; padding:0; cursor:pointer;"
                                data-bs-toggle="modal" data-bs-target="#loginModal">
                                <i class="far fa-bookmark text-muted" style="font-size:18px;"></i>
                            </button>
                            @endauth
                        </div>

                        <p class="card-text text-muted mt-1">
                            <small>{{ \Carbon\Carbon::parse($blog->created_at)->format('Y/m/d') }}</small>
                        </p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>


        <!-- Pagination -->
        <div class="row mt-3">
            <nav>
                <ul class="pagination justify-content-end converter">
                    {{-- Previous Button --}}
                    @if ($blogs->onFirstPage())
                    <li class="page-item disabled">
                        <a class="page-link primary_color_text">&lt;</a>
                    </li>
                    @else
                    <li class="page-item">
                        <a class="page-link primary_color_text" href="{{ $blogs->previousPageUrl() }}">&lt;</a>
                    </li>
                    @endif

                    {{-- Pagination Numbers --}}
                    @php
                    $currentPage = $blogs->currentPage();
                    $lastPage = $blogs->lastPage();
                    $pageRange = 2; // Number of pages to show before/after current page
                    @endphp

                    {{-- Show First Page --}}
                    @if ($currentPage > $pageRange + 1)
                    <li class="page-item">
                        <a class="page-link primary_color_text" href="{{ $blogs->url(1) }}">1</a>
                    </li>
                    @if ($currentPage > $pageRange + 2)
                    <li class="page-item disabled"><span class="page-link">...</span></li>
                    @endif
                    @endif

                    {{-- Pages Before Current --}}
                    @for ($i = max(1, $currentPage - $pageRange); $i < $currentPage; $i++)
                        <li class="page-item">
                        <a class="page-link primary_color_text" href="{{ $blogs->url($i) }}">{{ $i }}</a>
                        </li>
                        @endfor

                        {{-- Current Page --}}
                        <li class="page-item active">
                            <span class="page-link" style="background: #196BA6;">{{ $currentPage }}</span>
                        </li>

                        {{-- Pages After Current --}}
                        @for ($i = $currentPage + 1; $i <= min($lastPage, $currentPage + $pageRange); $i++)
                            <li class="page-item">
                            <a class="page-link primary_color_text" href="{{ $blogs->url($i) }}">{{ $i }}</a>
                            </li>
                            @endfor

                            {{-- Show Last Page --}}
                            @if ($currentPage < $lastPage - $pageRange)
                                @if ($currentPage < $lastPage - $pageRange - 1)
                                <li class="page-item disabled"><span class="page-link">...</span></li>
                                @endif
                                <li class="page-item">
                                    <a class="page-link primary_color_text" href="{{ $blogs->url($lastPage) }}">{{ $lastPage }}</a>
                                </li>
                                @endif

                                {{-- Next Button --}}
                                @if ($blogs->hasMorePages())
                                <li class="page-item">
                                    <a class="page-link primary_color_text" href="{{ $blogs->nextPageUrl() }}">&gt;</a>
                                </li>
                                @else
                                <li class="page-item disabled">
                                    <a class="page-link primary_color_text">&gt;</a>
                                </li>
                                @endif
                </ul>
            </nav>
        </div>


    </div>
</section>
@endsection