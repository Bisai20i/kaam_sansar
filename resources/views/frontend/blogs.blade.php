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
            <div class="row row-cols-1 row-cols-md-3 row-cols-sm-2 row-cols-lg-4 g-4">
                @foreach ($blogs as $blog)
                    <div class="col">
                        <div class="card h-100 p-1">
                            <a href="{{ route('frontend.news-detail', $blog->slug) }}"
                                class="text-decoration-none text-black">
                                <img src="{{$blog->imageUrl? asset('storage/' . $blog->imageUrl): asset('frontend/assets/Images/default.png') }}" class="card-img-top rounded"
                                    alt="{{ $blog->title }}">
                                <div class="card-body p-1 mt-1">
                                    <h6 class="card-title">{{ $blog->title }}</h6>
                                    <small class="text-body-secondary">
                                        {{ \Carbon\Carbon::parse($blog->created_at)->format('Y/m/d') }}
                                    </small>
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="row mt-3">
                <nav>
                    <ul class="pagination justify-content-end converter">
                        @if ($blogs->onFirstPage())
                            <li class="page-item disabled d-none">
                                <a class="page-link primary_color_text">Previous</a>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link primary_color_text" href="{{ $blogs->previousPageUrl() }}">Previous</a>
                            </li>
                        @endif

                        @foreach ($blogs->getUrlRange(1, $blogs->lastPage()) as $page => $url)
                            @if ($page == $blogs->currentPage())
                                <li class="page-item page-item active"><a class="page-link primary_color_text"
                                        href="#">{{ $page }}</a></li>
                            @else
                                <li class="page-item"><a class="page-link primary_color_text"
                                        href="{{ $url }}">{{ $page }}</a></li>
                            @endif
                        @endforeach

                        @if ($blogs->currentPage() < $blogs->lastPage() - 2)
                            <li class="page-item"><a class="page-link primary_color_text">...</a></li>
                            <li class="page-item"><a class="page-link primary_color_text"
                                    href="{{ $blogs->url($blogs->lastPage()) }}">{{ $blogs->lastPage() }}</a></li>
                        @endif

                        @if ($blogs->hasMorePages())
                            <li class="page-item">
                                <a class="page-link primary_color_text" href="{{ $blogs->nextPageUrl() }}">Next</a>
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
