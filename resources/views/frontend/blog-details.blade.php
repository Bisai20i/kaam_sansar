@extends('frontend.layouts.main')
@section('title', 'Blog Details')
@section('content')


    <section class="container-fluid mt-5 news">
        <div class="container-lg">
            <div class="row">
                <div class="col-lg-9 col-12 border border-1 border-dark-subtle rounded p-3 my-4">
                    <!-- Back to News Articles List -->
                    <a href="{{ route('frontend.news-and-blogs') }}" class="text-decoration-none">
                        <h5 class="primary_color_text">
                            <i class="fa-solid fa-chevron-left"></i> Back to News Articles List
                        </h5>
                    </a>
                    <div class="row justify-content-between align-items-center">
                        <div class="col-auto">
                            <h4>{{ $news_detail->title }}</h4>
                        </div>
                        <div class="col-auto">
                            <!-- Share Button -->
                            <a href="javascript:void(0);" class="text-decoration-none text-black"
                                onclick="copyToClipboard()">
                                <i class="fa-solid fa-share-nodes"></i> Share
                            </a>
                        </div>
                    </div>

                    <small>Published on {{ \Carbon\Carbon::parse($news_detail->created_at)->format('F d, Y') }}</small>
                    <img src="{{ $news_detail->imageUrl ? asset('storage/' . $news_detail->imageUrl): asset('frontend/assets/Images/default.png') }}" class="card-img-top my-2"
                    alt="{{ $news_detail->title }}">
                    <div class="card mb-3 mt-2">
                       
                        <div class="card-body">
                            {!! $news_detail->description !!}
                        </div>
                    </div>
                </div>

                <!-- Copy to Clipboard Script -->
                <script>
                    function copyToClipboard() {
                        let url = window.location.href; // Get the current page URL
                        navigator.clipboard.writeText(url).then(() => {
                            alert("Link copied to clipboard!"); // Success message
                        }).catch(err => {
                            console.error("Error copying link: ", err);
                        });
                    }
                </script>

                <div class="col-lg-3 col-12 my-4 ps-lg-4">
                    <h3>News Articles</h3>

                    <div class="row row-cols-lg-1 row-cols-md-3 row-cols-1 g-4">
                        @foreach ($similar_news as $item)
                            <div class="col">
                                <div class="card h-100 p-1">
                                    <a href="{{ route('frontend.news-detail', $item->slug) }}"
                                        class="text-decoration-none text-black">
                                        <img src="{{ $item->imageUrl ? asset('storage/' . $item->imageUrl) : asset('frontend/assets/Images/default.png') }}" class="card-img-top rounded"
                                            alt="...">
                                        <div class="card-body p-1">
                                            <h6 class="card-title">{{ $item->title }}</h6>
                                            <small
                                                class="text-body-secondary">{{ \Carbon\Carbon::parse($item->created_at)->format('Y/m/d') }}</small>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection