@extends('frontend.layouts.main')

@section('title', 'Blog Details')

@section('content')
<section class="container-fluid mt-5 news">
    <div class="container-lg">
        <div class="row">
            <div class="col-lg-9 col-12 border border-1 border-dark-subtle rounded p-3 my-4">
                <!-- Back to News Articles List -->
                <a href="{{ route('frontend.news-and-blogs') }}" class="text-decoration-none">
                    <h5 class="primary_color_text"><i class="fa-solid fa-chevron-left"></i> Back to Articles List</h5>
                </a>

                <!-- Blog Title and Action Buttons -->
                <div class="row justify-content-between">
                    <div class="col-auto mt-3">
                        <h4 class="text-black">{{ $news_detail->title }}</h4>
                    </div>
                    <div class="col-auto d-flex align-items-center gap-3">
                        <!-- Bookmark -->
                        @auth('job_seekers')
                        @if ($isBookmarked)
                        <form method="POST" action="{{ route('blogBookmark.remove', ['blogId' => $news_detail->id]) }}">
                            @csrf
                            <button type="submit" style="border:none; background:none; padding:0; cursor:pointer;" title="Remove Bookmark">
                                <i class="fas fa-bookmark text-primary fs-5"></i>
                            </button>
                        </form>
                        @else
                        <form action="{{ route('bookmark.blog') }}" method="POST">
                            @csrf
                            <input type="hidden" name="blogs_and_podcasts_id" value="{{ $news_detail->id }}">
                            <input type="hidden" name="type" value="blog">
                            <button type="submit" style="border:none; background:none; padding:0; cursor:pointer;" title="Add Bookmark">
                                <i class="far fa-bookmark text-muted fs-5"></i>
                            </button>
                        </form>
                        @endif
                        @else
                        <button type="button" style="border:none; background:none; padding:0; cursor:pointer;" data-bs-toggle="modal" data-bs-target="#loginModal" title="Login to bookmark">
                            <i class="far fa-bookmark text-muted fs-5"></i>
                        </button>
                        @endauth

                        <!-- Share Icon moved here -->
                        <a href="#" class="text-decoration-none text-secondary" data-bs-toggle="modal" data-bs-target="#shareModal" title="Share this blog">
                            <i class="fa fa-share-alt fs-5" aria-hidden="true"></i> </a>

                    </div>
                </div>

                <p class="mb-2" style="font-size: 18px; color: #555555;">Published on {{ \Carbon\Carbon::parse($news_detail->created_at)->format('F d, Y') }}</p>

                <img src="{{ $news_detail->imageUrl ? asset('storage/' . $news_detail->imageUrl) : asset('frontend/assets/Images/default.png') }}"
                    class="card-img-top my-3 rounded" alt="{{ $news_detail->title }}">

                <div class="card mb-3 mt-2">
                    <div class="card-body">
                        {!! $news_detail->description !!}
                    </div>
                </div>

                <!-- View and Share Count Section -->
                <div class="d-flex justify-content-end gap-3 mb-3">
                    <p class="m-0 text-secondary d-flex align-items-center gap-1">
                        <i class="bi bi-eye" style="font-size: 20px;"></i>
                        {{ $news_detail->views_count }}
                    </p>
                    <!-- 
                    <p class="m-0">
                        <a href="#" class="text-decoration-none text-secondary" data-bs-toggle="modal" data-bs-target="#shareModal">
                            <i class="bi bi-share" style="font-size: 20px;"></i> Share
                        </a>
                    </p> -->
                </div>
            </div>

            <!-- Sidebar: Related News -->
            <div class="col-lg-3 col-12 my-4 ps-lg-4">
                <h3 style="color: #212529;">News Articles</h3>
                <div class="row row-cols-lg-1 row-cols-md-3 row-cols-1 g-4">
                    @foreach ($similar_news as $item)
                    <div class="col">
                        <div class="card h-100 p-1">
                            <a href="{{ route('frontend.news-detail', $item->slug) }}" class="text-decoration-none text-black">
                                <img src="{{ $item->imageUrl ? asset('storage/' . $item->imageUrl) : asset('frontend/assets/Images/default.png') }}"
                                    class="card-img-top rounded" alt="{{ $item->title }}">
                                <div class="card-body p-1">
                                    <h6 class="card-title">{{ $item->title }}</h6>
                                    <small class="text-body-secondary">{{ \Carbon\Carbon::parse($item->created_at)->format('Y/m/d') }}</small>
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

<!-- Share Modal -->
<div class="modal fade" id="shareModal" tabindex="-1" aria-labelledby="shareModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered rounded-3 p-4" style="max-width: 500px;">
        <div class="modal-content">
            <div class="modal-header bg-white border-0">
                <h5 class="modal-title text-black" id="shareModalLabel" style="font-size:22px; font-weight:500;">Share this article</h5>
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
                    <button class="btn" type="button" style="background-color: #F9F9F9; border: 0.5px solid #E3E3E3;" onclick="copyModalLink()">Copy</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function copyModalLink() {
        const copyText = document.getElementById("shareLink");
        copyText.select();
        copyText.setSelectionRange(0, 99999);
        document.execCommand("copy");
        alert("Copied the link: " + copyText.value);
    }
</script>
@endsection