@extends('frontend.profile.jobseeker-dashboard')

@section('profileSection')

<!-- Bookmarked Blogs Section -->
<div class="page-border-container p-3 rounded" style="border: 1px solid #B8B8B8;">

    <div id="myArticles" class="content-section">
        <!-- <div class="container-md border border-1 rounded p-3 my-4" style="border-color: #B8B8B8;"> -->
        <div class="row px-3 my-2">
            <h4>My Bookmarked Articles</h4>
        </div>

        @if ($blogs->isEmpty())
        <div class="row px-3 my-4">
            <p>No bookmarked articles found.</p>
        </div>
        @else
        <div class="row gx-3 gy-4 px-3">
            @foreach ($blogs as $item)
            <div class="col-4">
                <div class="card p-1" style="border: 1px solid #3b82f6; height:250px;">
                    <a href="{{ route('frontend.news-detail', ['slug' => $item->slug]) }}" class="text-decoration-none text-reset d-block">
                        <div class="pi">
                            <img src="{{ $item->imageUrl ? asset('storage/' . $item->imageUrl) : asset('frontend/assets/Images/default.png') }}"
                                class="card-img-top" alt="Blog Image">
                        </div>

                        <div class="card-body lh-1" style="padding: .5rem;">
                            <div class="d-flex align-items-center justify-content-between">
                                <p class="card-title fw-bold text-black mb-1">{{ $item->title }}</p>

                                @php
                                $isBookmarked = \App\Models\BlogsAndPodcastsBookmark::where('job_seeker_id', auth()->id())
                                ->where('blogs_and_podcasts_id', $item->id)
                                ->where('type', 'article') // Make sure you check type here as well

                                ->exists();
                                @endphp

                                @if ($isBookmarked)
                                {{-- Remove Bookmark --}}
                                <form method="POST" action="{{ route('blogBookmark.remove', ['blogId' => $item->id]) }}">
                                    @csrf
                                    <button type="submit" class="btn btn-link p-0 text-primary" title="Remove Bookmark" style="text-decoration: none;">
                                        <i class="fa-solid fa-bookmark fa-lg"></i>
                                    </button>
                                </form>
                                @else
                                {{-- Add Bookmark --}}
                                <form method="POST" action="{{ route('bookmark.blog') }}">
                                    @csrf
                                    <input type="hidden" name="blogs_and_podcasts_id" value="{{ $item->id }}">
                                    <button type="submit" class="btn btn-link p-0 text-secondary" title="Add Bookmark" style="text-decoration: none;">
                                        <i class="fa-regular fa-bookmark fa-lg"></i>
                                    </button>
                                </form>
                                @endif
                            </div>

                            <p class="card-text">
                                <small>{{ \Carbon\Carbon::parse($item->created_at)->format('Y/m/d') }}</small>
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
</div>

@endsection