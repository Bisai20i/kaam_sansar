@extends('frontend.layouts.main')
@section('title')
    Discussion Form
@endsection
@section('content')

    <section class="main  container-fluid pt-5 pb-2" style="box-sizing: border-box;">

        <!-- Create Post Modal -->
        <div class="modal fade" id="createPost" data-bs-backdrop="static" tabindex="-1" aria-labelledby="createPostLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header d-flex bg-white border-bottom border-1">
                        <h1 class="modal-title fs-5 mx-auto flex-fill d-flex justify-content-center text-black fs-4 "
                            id="createPostLabel">
                            Create Post
                        </h1>
                        <button type="button" class="btn-close m-0" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body px-4">
                        <form action="{{ route('discussion_forum.store') }}"
                            class="d-flex flex-column justify-content-center p-0 mb-4" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="d-flex align-items-center m-0 mb-2">
                                <div class="col-auto p-0">
                                    <img src="{{ Auth::guard('job_seekers')->check() && Auth::guard('job_seekers')->user()->userThumbnail
                                        ? asset('storage/' . Auth::guard('job_seekers')->user()->userThumbnail[0])
                                        : asset('frontend/assets/Images/profile.jpg') }}"
                                        class="img-fluid rounded-circle overflow-hidden"
                                        style="aspect-ratio: 1; width: 3rem;" alt="">
                                </div>
                                <div class="col flex-fill ps-2">
                                    <a href="{{ route('jobseeker.getProfile', @Auth::guard('job_seekers')->user()->id) }}"
                                        class="text-decoration-none">
                                        <h5 class="m-0 text-black">
                                            {{ Auth::guard('job_seekers')->check()
                                                ? Auth::guard('job_seekers')->user()->firstName . ' ' . Auth::guard('job_seekers')->user()->lastName
                                                : 'User' }}
                                        </h5>
                                    </a>
                                </div>
                            </div>

                            <div class="form mt-2">

                                <select name="category" class="form-select bg-secondary-subtle text-black-50" id="cat"
                                    aria-label="">
                                    <option selected>Category</option>
                                    <option value="education">Education</option>
                                    <option value="investment">Investment</option>
                                    <option value="scammer">Scammer</option>
                                    <option value="office">Office</option>
                                    <option value="other">Other</option>

                                </select>
                            </div>
                            <div class="form-floating text-black-50 mt-3">
                                <input name="topic" type="text" class="form-control bg-secondary-subtle text-black-50"
                                    id="titleInput" placeholder="Post Title">
                                <label for="titleInput">Title</label>
                            </div>
                            <div class="form-floating text-black-50">
                                <textarea class="form-control bg-secondary-subtle text-black-50" name="description" placeholder="Post Details"
                                    id="floatingTextarea" style="height: 100px"></textarea>
                                <label for="floatingTextarea">Describe...</label>
                            </div>
                            <div class="form text-black-50 mt-2">
                                <select name="country" id="forumCountry"
                                    class="form-control bg-secondary-subtle text-black-50">
                                    <option value="" selected>Select Country</option>
                                    <!-- Country options will be dynamically populated by JavaScript -->
                                </select>

                            </div>
                            <div class="form-floating text-black-50 mt-3">
                                <input name="person_name" type="text"
                                    class="form-control bg-secondary-subtle text-black-50" id="person_name_input"
                                    placeholder="Person Name">
                                <label for="person Name">Person Name</label>
                            </div>
                            <div class="mb-1">
                                <label for="forumImages" class="mb-2">Upload Images (Max 2MB each, 5 images)</label>
                                <input id="forumImages" class="form-control py-2" type="file" multiple accept="image/*"
                                    onchange="handleFiles(this.files)" name="images[]">
                                <small>You can upload up to 5 images, each with a maximum size of 2MB.</small>

                            </div>
                            <div id="forumPreviewImages" class="row flex-wrap mt-4">

                            </div>
                            <div class="d-flex justify-content-center mt-1">
                                <button type="submit" class="btn btn-primary mx-auto"
                                    style="background-color: #0064a7;">Post</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>

        <!-- fetch country api -->

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                // Fetch country data from REST Countries API
                fetch("https://restcountries.com/v3.1/all")
                    .then((response) => response.json())
                    .then((data) => {
                        // Extract country names and their calling codes
                        const countries = data.map((country) => ({
                            name: country.name.common,
                            shortCode: country.cca2, // Short code (e.g., NP for Nepal)

                            code: country.idd.root + (country.idd.suffixes ? country.idd.suffixes[0] :
                                '')
                        }));

                        // Sort countries alphabetically by name
                        countries.sort((a, b) => a.name.localeCompare(b.name));

                        // Function to populate the country code dropdown
                        function populateCountry() {
                            const dropdown = document.getElementById('forumCountry');

                            dropdown.innerHTML =
                                `<option value="country" selected>Select Country</option>`;


                            countries.forEach((country) => {
                                const option = document.createElement("option");
                                option.value = country.name;
                                option.textContent = `${country.name}`;
                                dropdown.appendChild(option);

                            });


                            // Restore old value (if exists)
                            // const oldCountry = "{{ old('country') }}";
                            // if (oldCountry) {
                            //     dropdown.value = oldCountry;
                            // }
                        }

                        // Populate the dropdown
                        populateCountry();
                    })
                    .catch((error) => {
                        console.error("Error fetching country data:", error);
                        // Display an error message if fetching fails
                        const dropdown = document.getElementById('registerCountry');
                        dropdown.innerHTML =
                            `<option selected>Failed to load countries. Please try again later.</option>`;
                    });
            });
        </script>

        <!-- Delete Modal -->

        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModallLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content p-4 rounded-4 border-0 shadow-lg text-center">
                    <button type="button" class="btn-close ms-auto" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="mb-3">
                        <div class="mx-auto rounded-circle bg-danger bg-opacity-10 d-flex align-items-center justify-content-center"
                            style="width: 64px; height: 64px;">
                            <i class="bi bi-trash-fill text-danger fs-3"></i>
                        </div>
                    </div>
                    <h4 class="fw-bold">Are you sure?</h4>
                    <p class="text-secondary mb-4">Are you sure you want to delete this comment?</p>
                    <div class="d-flex justify-content-center align-items-center" style="box-sizing: border-box;">
                        <button type="button" class="btn border-secondary col-6 me-1"
                            data-bs-dismiss="modal">Cancel</button>

                        <button id="deleteCommentButton" data-comment-id="0" onclick="deleteComment(this)"
                            data-forum-id="0" class="btn btn-danger w-100 ms-1">Delete</button>

                    </div>
                </div>
            </div>
        </div>


        <!-- Comment Modal -->
        <div class="modal fade" id="commentModal" tabindex="-1" aria-labelledby="commentModalLabel" aria-hidden="true"
            data-forum-id="0"
            data-current-user-id="{{ Auth::guard('job_seekers')->check() ? Auth::guard('job_seekers')->user()->id : null }}">
            <div class="modal-dialog modal-lg modal-dialog-centered ">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="commentModalLabel">Comments</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">

                        <!-- Existing Comments Section -->
                        <div id="commentsList" style="max-height: 70vh; overflow-y: auto;">
                            <!-- Example of a single comment -->
                            <div class="mb-3 p-3 border rounded">
                                <strong>John Doe</strong>
                                <p class="mb-1">This is a great feature! Looking forward to seeing more.</p>
                                <small class="text-muted">Posted on April 21, 2025</small>
                            </div>
                        </div>

                        <hr>

                        <!-- Leave New Comment Form -->
                        <div
                            class="col-12 d-flex align-items-center bg-white rounded shadow-sm position-sticky bottom-0 w-100 p-2 mt-2">

                            <img alt="Profile picture of user" class="rounded-circle gifts-chat me-2 img-thumbnail"
                                src="{{ Auth::guard('job_seekers')->check() && Auth::guard('job_seekers')->user()->userThumbnail ? asset('storage/' . Auth::guard('job_seekers')->user()->userThumbnail[0]) : 'https://storage.googleapis.com/a1aa/image/3CpUMtugubz8I1SyWiQoLgE520O4UxkZW02TXnQ0WU4.jpg' }}"
                                style="width: 50px; height:50px;" />
                            <input class="form-control w-100 p-2" name="comment" id="commentInput"
                                placeholder="Write a comment...." type="text" required />
                            <button type="submit" class="border bg-white p-2 border-0 m-0" id="forumCommentButton"
                                data-forum-id="0" onclick="addComment(this)">
                                <i class="bi bi-send" style="color:#0064a7;"></i>
                            </button>

                        </div>

                    </div>
                </div>
            </div>
        </div>



        @if ($ad_banners['top'])
            <div class="container my-4">
                <a href="{{ $ad_banners['top']->link }}" target="_blank" class="d-block"
                    style="text-decoration: none; cursor: pointer; object-fit: contain;">
                    <img src="{{ $ad_banners['top']->image }}" class="w-100" style="aspect-ratio: 4/1;"
                        alt="img-fluid">
                </a>
            </div>
            {{-- <h1 class="d-flex justify-content-center mt-5 mb-5">Advertisement Banner</h1> --}}
        @endif

        <style>
            .scrolling-container {
                overflow: hidden;
                background-color: #e9f1f7;
                white-space: nowrap;
            }

            .scrolling-wrapper {
                display: flex;
                width: max-content;
                animation: scrollLeft 30s linear infinite;
            }

            @keyframes scrollLeft {
                0% {
                    transform: translateX(0%);
                }

                100% {
                    transform: translateX(-50%);
                }
            }

            .profile-item {
                display: flex;
                align-items: center;
                margin-right: 15px;
                gap: 15px;
                flex-shrink: 0;
                min-width: 200px;
                /* Make all profile items uniform */
            }
        </style>

        <div class="scrolling-container p-4 mb-4">
            <div class="scrolling-wrapper" id="profile-wrapper">
                <!-- Original profile items -->
                <div class="profile-item mx-3">
                    <img src="https://storage.googleapis.com/a1aa/image/8d0e06bf-119d-412e-c9b9-9f3de89f9bc9.jpg"
                        alt="Profile" style="width: 50px; height: 50px; object-fit: cover; border-radius: 50%;" />
                    <div>
                        <p class="m-0" style="font-size: 20px; font-weight: 500; color: #1f2937;">Bsai Raj Doe</p>
                        <p class="m-0" style="font-size: 18px; font-weight: 400; color: #1f2937;">Lawyer</p>
                    </div>
                </div>
                <div class="profile-item mx-3">
                    <img src="https://storage.googleapis.com/a1aa/image/4eec1808-d6d9-457b-1a6e-4fc46b86f8b9.jpg"
                        alt="Profile" style="width: 50px; height: 50px; object-fit: cover; border-radius: 50%;" />
                    <div>
                        <p class="m-0" style="font-size: 20px; font-weight: 500; color: #1f2937;">Kabita Subedi</p>
                        <p class="m-0" style="font-size: 18px; font-weight: 400; color: #1f2937;">Lawyer</p>
                    </div>
                </div>
                <div class="profile-item mx-3">
                    <img src="https://storage.googleapis.com/a1aa/image/8d0e06bf-119d-412e-c9b9-9f3de89f9bc9.jpg"
                        alt="Profile" style="width: 50px; height: 50px; object-fit: cover; border-radius: 50%;" />
                    <div>
                        <p class="m-0" style="font-size: 20px; font-weight: 500; color: #1f2937;">Sangam Doe</p>
                        <p class="m-0" style="font-size: 18px; font-weight: 400; color: #1f2937;">Lawyer</p>
                    </div>
                </div>
                <div class="profile-item mx-3">
                    <img src="https://storage.googleapis.com/a1aa/image/d902be3e-4448-4664-ad49-1f5da29f9e18.jpg"
                        alt="Profile" style="width: 50px; height: 50px; object-fit: cover; border-radius: 50%;" />
                    <div>
                        <p class="m-0" style="font-size: 20px; font-weight: 500; color: #1f2937;">Nirmal Roy</p>
                        <p class="m-0" style="font-size: 18px; font-weight: 400; color: #1f2937;">Lawyer</p>
                    </div>
                </div>

                <!-- Clones of the same items for seamless loop -->
                <div class="profile-item mx-3">
                    <img src="https://storage.googleapis.com/a1aa/image/8d0e06bf-119d-412e-c9b9-9f3de89f9bc9.jpg"
                        alt="Profile" style="width: 50px; height: 50px; object-fit: cover; border-radius: 50%;" />
                    <div>
                        <p class="m-0" style="font-size: 20px; font-weight: 500; color: #1f2937;">Bsai Raj Doe</p>
                        <p class="m-0" style="font-size: 18px; font-weight: 400; color: #1f2937;">Lawyer</p>
                    </div>
                </div>
                <div class="profile-item mx-3">
                    <img src="https://storage.googleapis.com/a1aa/image/4eec1808-d6d9-457b-1a6e-4fc46b86f8b9.jpg"
                        alt="Profile" style="width: 50px; height: 50px; object-fit: cover; border-radius: 50%;" />
                    <div>
                        <p class="m-0" style="font-size: 20px; font-weight: 500; color: #1f2937;">Kabita Subedi</p>
                        <p class="m-0" style="font-size: 18px; font-weight: 400; color: #1f2937;">Lawyer</p>
                    </div>
                </div>
                <div class="profile-item mx-3">
                    <img src="https://storage.googleapis.com/a1aa/image/8d0e06bf-119d-412e-c9b9-9f3de89f9bc9.jpg"
                        alt="Profile" style="width: 50px; height: 50px; object-fit: cover; border-radius: 50%;" />
                    <div>
                        <p class="m-0" style="font-size: 20px; font-weight: 500; color: #1f2937;">Sangam Doe</p>
                        <p class="m-0" style="font-size: 18px; font-weight: 400; color: #1f2937;">Lawyer</p>
                    </div>
                </div>
                <div class="profile-item mx-3">
                    <img src="https://storage.googleapis.com/a1aa/image/d902be3e-4448-4664-ad49-1f5da29f9e18.jpg"
                        alt="Profile" style="width: 50px; height: 50px; object-fit: cover; border-radius: 50%;" />
                    <div>
                        <p class="m-0" style="font-size: 20px; font-weight: 500; color: #1f2937;">Nirmal Roy</p>
                        <p class="m-0" style="font-size: 18px; font-weight: 400; color: #1f2937;">Lawyer</p>
                    </div>
                </div>
            </div>
        </div>

        <script>
            const wrapper = document.getElementById('profile-wrapper');
            let profiles = Array.from(wrapper.children); // Get all the profile items
            const container = document.querySelector('.scrolling-container');
            let profileWidth = profiles[0].offsetWidth + 15; // Profile width + margin-right
            let scrollSpeed = 2; // Adjust the speed of scroll (higher is slower)

            // Clone and append profiles to ensure infinite scrolling
            profiles.forEach(profile => {
                const clone = profile.cloneNode(true);
                wrapper.appendChild(clone);
            });

            function scroll() {
                const maxScrollWidth = wrapper.scrollWidth; // The total scrollable width of all profiles

                // Scroll the profiles by shifting them left
                wrapper.style.transform = `translateX(-${scrollSpeed}px)`;

                // If the leftmost profile is fully out of view, move it to the right end
                if (parseFloat(wrapper.style.transform.replace('translateX(', '').replace('px)', '')) <= -profileWidth) {
                    const firstItem = wrapper.firstElementChild;
                    wrapper.appendChild(firstItem); // Move the first item to the end of the list
                    wrapper.style.transform = 'translateX(0)'; // Reset the position
                }

                // Continue the scroll animation
                requestAnimationFrame(scroll);
            }

            // Start scrolling
            scroll();
        </script>

        <div class="container position-relative">
            <div class="row mb-3">
                <div class="col-lg-3 col-auto">
                    <a href="{{ route('frontend.discussion') }}" class=" text-decoration-none">
                        <h5 class="text-black">Discussion
                            Forum</h5>
                    </a>
                </div>

                <div class="col-lg-9 col-12 ps-2 lg:ps-4">
                    <div class="">
                        <form action="{{ route('frontend.discussion') }}" class="row g-2">
                            @if (Auth::guard('job_seekers')->check())
                                <div class="col-3 me-1 me-md-2 ratio ratio-1x1" style="max-width: 50px; ratio: 1/1; ">
                                    <a
                                        href="{{ route('discussion.profile', ['id' => Auth::guard('job_seekers')->user()->id]) }}">
                                        <img class="img rounded-circle img-thumbnail" style="width: 45px; height: 45px;"
                                            src="{{ Auth::guard('job_seekers')->user()->userThumbnail ? asset('storage/' . Auth::guard('job_seekers')->user()->userThumbnail[0]) : asset('frontend/assets/Images/profile.jpg') }}"
                                            alt="">
                                    </a>
                                </div>
                            @endif

                            <div
                                class="col-8 col-md-auto d-flex flex-fill border border-1 border-dark-subtle rounded-5 align-items-center ps-3 overflow-hidden gap-1">
                                <i class="fa-solid fa-magnifying-glass text-black-50"></i>
                                <input type="search" placeholder="Search" name='searchstr'
                                    value="{{ request('searchstr') }}"
                                    class="w-100 h-100 border-0 m-0 text-black-50 rounded-end-5 px-1 py-2"
                                    style="outline: none; min">
                            </div>
                            <div class="col-12 col-md-auto d-flex gap-2 justify-content-center ms-md-2">

                                <button class="btn rounded-5 px-4 text-white text-nowrap"
                                    style="background-color: #0064a7;" type="submit">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </button>

                                <div class="">
                                    @auth('job_seekers')
                                        <button class="btn rounded-5 px-4 text-white text-nowrap m-auto py-2"
                                            style="background-color: #0064a7;" data-bs-toggle="modal"
                                            data-bs-target="#createPost">+
                                            Create</button>
                                    @else
                                        <button data-bs-toggle="modal" data-bs-target="#loginModal"
                                            onclick="setRedirectUrl()"
                                            class="btn rounded-5 px-4 text-white text-nowrap m-auto"
                                            style="background-color: #0064a7;">
                                            + Create
                                        </button>
                                    @endauth
                                </div>
                            </div>
                        </form>


                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-3 d-lg-block d-none">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title mb-3">Hot Topics</h4>
                            @if ($hot_topics->count() > 0)
                                @foreach ($hot_topics as $forumPost)
                                    <div class="card mb-3">
                                        @if ($forumPost->images)
                                            <img src="{{ $forumPost->images }}" class="card-img-top" alt="...">
                                        @endif
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $forumPost->topic }}</h5>
                                            <p class="card-text">
                                                <small class="text-body-secondary">Post by:
                                                    {{ $forumPost->jobSeeker->firstName . ' ' . $forumPost->jobSeeker->lastName }}</small>
                                                <br>
                                                <small
                                                    class="text-body-secondary">{{ $forumPost->updated_at->diffForHumans() }}</small>
                                            </p>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <p class="text-center my-2 text-secondary">No Hot Topics</p>
                            @endif

                        </div>
                    </div>
                </div>

                <div class="col-lg-9 col-12 ps-2 d-flex flex-column">
                    <div class="d-flex mb-3">
                        <div class="nav nav-pills column-gap-2 row-gap-2 justify-content-start">
                            <a href=" {{ route('frontend.discussion') }}"
                                class="nav-link-ads rounded px-3 py-1 border-dark-subtle {{ request('category') == '' ? 'active' : '' }}">All</a>
                            <a href=" {{ route('frontend.discussion', ['category' => 'education']) }}"
                                class="nav-link-ads rounded px-3 py-1 border-dark-subtle {{ request('category') == 'education' ? 'active' : '' }}">Education</a>
                            <a href=" {{ route('frontend.discussion', ['category' => 'investment']) }}"
                                class="nav-link-ads rounded px-3 py-1 border-dark-subtle {{ request('category') == 'investment' ? 'active' : '' }}">Investment</a>
                            <a href=" {{ route('frontend.discussion', ['category' => 'scammer']) }}"
                                class="nav-link-ads rounded px-3 py-1 border-dark-subtle {{ request('category') == 'scammer' ? 'active' : '' }}">Scammer</a>
                            <a href=" {{ route('frontend.discussion', ['category' => 'office']) }}"
                                class="nav-link-ads rounded px-3 py-1 border-dark-subtle {{ request('category') == 'office' ? 'active' : '' }}">Office</a>
                            <a href=" {{ route('frontend.discussion', ['category' => 'other']) }}"
                                class="nav-link-ads rounded px-3 py-1 border-dark-subtle {{ request('category') == 'other' ? 'active' : '' }}">Other</a>

                        </div>
                    </div>
                    {{-- <div 
                        class="d-flex justify-content-center text-secondary gap-2 p-1  align-items-center flex-wrap fixed-top bg-danger-subtle mx-auto rounded-5" style="margin-top: 100px; width: fit-content">
                        <a href=" {{ route('frontend.discussion') }}"><i class="fa-solid fa-arrow-rotate-right p-2"
                                style="font-size: 1.5rem;"></i></a>
                        <strong class="pe-2"><span id="newPostsCount">0</span> New Posts Available</strong>
                    </div> --}}
                    <div id="newPostsAlert"
                        class="d-none justify-content-center text-secondary gap-2 p-1 px-2 border border-secondary-subtle  align-items-center flex-wrap fixed-top bg-white shadow-sm mx-auto rounded-5"
                        style="margin-top: 100px; width: fit-content">
                        <a class="text-decoration-none d-flex align-items-center"
                            href=" {{ route('frontend.discussion') }}" style="color: #0064a7;"><i
                                class="fa-solid fa-arrow-rotate-right p-2" style="font-size: 1.5rem;"></i> <strong
                                class="pe-2"><span id="newPostsCount">0</span> New Posts Available</strong></a>

                    </div>
                    <div id="forumPosts">

                        @if ($forumPosts->count() > 0)
                            @foreach ($forumPosts as $forumPost)
                                <div
                                    class="row flex-wrap align-items-center gap-2 p-2 d-flex justify-content-between mt-2">
                                    <div class="d-flex justify-content-between">
                                        <div class="d-flex align-items-center">
                                            <div class="col-auto p-0 order-0">
                                                <img src="{{ $forumPost->jobSeeker->userThumbnail ? $forumPost->jobSeeker->userThumbnail : asset('frontend/assets/Images/profile.jpg') }}"
                                                    class="img-fluid rounded-circle overflow-hidden"
                                                    style="aspect-ratio: 1; width: 3rem;" alt="">
                                            </div>
                                            <div class="col-auto flex-fill ps-2 order-md-1 order-2">
                                                <a href="{{ route('discussion.profile', ['id' => $forumPost->jobSeeker->id]) }}"
                                                    class="text-decoration-none">
                                                    <h5 class="m-0 text-black">
                                                        {{ ucfirst($forumPost->jobSeeker->firstName) . ' ' . $forumPost->jobSeeker->lastName }}
                                                    </h5>
                                                </a>
                                                <div class="d-inline-flex gap-4">
                                                    <small class="text-black-50 d-flex flex-wrap align-items-center gap-2">
                                                        @if ($forumPost->jobSeeker->temporaryLocation)
                                                            <span class='text-no-wrap'>
                                                                <svg width="14" height="18" viewBox="0 0 14 18"
                                                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path
                                                                        d="M6.8 9.725C8.00122 9.725 8.975 8.75122 8.975 7.55C8.975 6.34878 8.00122 5.375 6.8 5.375C5.59878 5.375 4.625 6.34878 4.625 7.55C4.625 8.75122 5.59878 9.725 6.8 9.725Z"
                                                                        stroke="#9D9999" stroke-width="2"
                                                                        stroke-linecap="round" stroke-linejoin="round" />
                                                                    <path
                                                                        d="M6.8 1.75C5.26174 1.75 3.78649 2.36107 2.69878 3.44878C1.61107 4.53649 1 6.01174 1 7.55C1 8.9217 1.29145 9.81925 2.0875 10.8125L6.8 16.25L11.5125 10.8125C12.3086 9.81925 12.6 8.9217 12.6 7.55C12.6 6.01174 11.9889 4.53649 10.9012 3.44878C9.81351 2.36107 8.33826 1.75 6.8 1.75Z"
                                                                        stroke="#9D9999" stroke-width="2"
                                                                        stroke-linecap="round" stroke-linejoin="round" />
                                                                </svg> {{ $forumPost->jobSeeker->temporaryLocation }}
                                                            </span>
                                                        @endif

                                                        <span class='text-no-wrap'>
                                                            <svg width="19" height="18" viewBox="0 0 19 18"
                                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path
                                                                    d="M9.59961 15C11.1909 15 12.717 14.3679 13.8423 13.2426C14.9675 12.1174 15.5996 10.5913 15.5996 9C15.5996 7.4087 14.9675 5.88258 13.8423 4.75736C12.717 3.63214 11.1909 3 9.59961 3C8.00831 3 6.48219 3.63214 5.35697 4.75736C4.23175 5.88258 3.59961 7.4087 3.59961 9C3.59961 10.5913 4.23175 12.1174 5.35697 13.2426C6.48219 14.3679 8.00831 15 9.59961 15ZM9.59961 1.5C10.5845 1.5 11.5598 1.69399 12.4697 2.0709C13.3797 2.44781 14.2065 3.00026 14.9029 3.6967C15.5993 4.39314 16.1518 5.21993 16.5287 6.12987C16.9056 7.03982 17.0996 8.01509 17.0996 9C17.0996 10.9891 16.3094 12.8968 14.9029 14.3033C13.4964 15.7098 11.5887 16.5 9.59961 16.5C5.45211 16.5 2.09961 13.125 2.09961 9C2.09961 7.01088 2.88979 5.10322 4.29631 3.6967C5.70283 2.29018 7.61049 1.5 9.59961 1.5ZM9.97461 5.25V9.1875L13.3496 11.19L12.7871 12.1125L8.84961 9.75V5.25H9.97461Z"
                                                                    fill="#9D9999" />
                                                            </svg>
                                                            {{ $forumPost->updated_at->diffForHumans() }}
                                                        </span>
                                                    </small>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="d-flex flex-wrap align-items-center justify-content-center gap-2">
                                            @auth('job_seekers')
                                                @if (Auth::guard('job_seekers')->user()->id !== $forumPost->jobSeeker->id)
                                                    <button
                                                        class="{{ 'buttons' . $forumPost->jobSeeker->id }} btn rounded-5 px-4 text-white text-nowrap"
                                                        style="background-color: #0064a7;"
                                                        data-user-id="{{ $forumPost->jobSeeker->id }}"
                                                        onclick="follow(this)">
                                                        {!! $forumPost->followed
                                                            ? '<span class="d-none d-md-inline">Unfollow</span>'
                                                            : '+ <span class="d-none d-md-inline">Follow</span>' !!}

                                                    </button>
                                                @endif

                                                <button class="btn rounded-5 px-4 text-white text-nowrap"
                                                    style="background-color: #0064a7;"
                                                    data-user-id="{{ $forumPost->jobSeeker->id }}" onclick="openChat(this)"
                                                    data-user-name="{{ $forumPost->jobSeeker->firstName . ' ' . $forumPost->jobSeeker->lastName }}">
                                                    <i class="bi bi-chat-left-text me-1 align-content-center"></i>
                                                    <span class="d-none d-md-inline">Chat</span>
                                                </button>
                                            @else
                                                {{-- <form id="redirectForm" action="{{ route('set.redirect') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="redirect_url"
                                                        value="{{ url()->current() }}">
                                                </form> --}}

                                                <button class="btn rounded-5 px-4 text-white text-nowrap"
                                                    style="background-color: #0064a7;" data-bs-toggle="modal"
                                                    data-bs-target="#loginModal" onclick="setRedirectUrl()">+
                                                    <span class="d-none d-md-inline">Follow</span></button>
                                                <button class="btn rounded-5 px-4 text-white text-nowrap"
                                                    style="background-color: #0064a7;" data-bs-toggle="modal"
                                                    data-bs-target="#loginModal" onclick="setRedirectUrl()">
                                                    <i class="bi bi-chat-left-text me-1 align-content-center"></i>
                                                    <span class="d-none d-md-inline">Chat</span>
                                                </button>
                                            @endauth

                                        </div>
                                    </div>
                                </div>

                                <div class="d-block me-0 p-0 mt-2">
                                    <h4>{{ $forumPost->topic }}</h4>
                                    <small>{{ $forumPost->description }}</small>
                                </div>

                                @if (count($forumPost->images) > 0)
                                    <div
                                        class="mt-2 row {{ count($forumPost->images) === 1 ? 'row-cols-1' : 'row-cols-md-2 row-cols-1' }}">
                                        @foreach ($forumPost->images as $image)
                                            <div class="col p-2">
                                                <img src="{{ $image }}" class="img-fluid w-100"
                                                    style="max-width:600px;" alt="Post Image">
                                            </div>
                                        @endforeach

                                    </div>
                                @endif


                                <div
                                    class="d-flex border border-2 border-start-0 border-end-0 px-0 py-1 mt-2 gap-3 align-items-center">

                                    <button style="all:unset; cursor: pointer;" onclick="interact(this)"
                                        class="text-decoration-none text-black d-flex align-items-center gap-1"
                                        data-type='like' data-forum-id = "{{ $forumPost->id }}">

                                        <i class="fa-{{ $forumPost->interaction ? ($forumPost->interaction->type == 'like' ? 'solid' : 'regular') : 'regular' }} fa-thumbs-up fs-5"
                                            style="color: #0064a7;"></i>

                                        <span>
                                            {{ $forumPost->likes > 999 ? round($forumPost->likes / 1000, 1) . ' K' : $forumPost->likes }}
                                        </span>
                                    </button>

                                    <button style="all:unset; cursor: pointer;" onclick="interact(this)"
                                        class="text-decoration-none text-black d-flex align-items-center gap-1"
                                        data-type='dislike' data-forum-id="{{ $forumPost->id }}">

                                        <i class="fa-{{ $forumPost->interaction ? ($forumPost->interaction->type == 'dislike' ? 'solid' : 'regular') : 'regular' }} fa-thumbs-down fs-5"
                                            style="color: #0064a7;"></i>

                                        <span>
                                            {{ $forumPost->dislikes > 999 ? round($forumPost->dislikes / 1000, 1) . ' K' : $forumPost->dislikes }}</span>
                                    </button>

                                    <span class="text-decoration-none text-black d-flex align-items-center gap-1"
                                        style = "cursor: pointer;" data-bs-toggle="modal" data-bs-target="#commentModal"
                                        data-forum-id="{{ $forumPost->id }}"
                                        data-current-user-id="{{ Auth::guard('job_seekers')->check() ? Auth::guard('job_seekers')->user()->id : null }}"
                                        onclick="loadComments(this)" style="cursor: pointer;">
                                        <i class="fa-regular fa-comment fs-5" style="color: #0064a7;"></i>
                                        <span id="commentCount_{{ $forumPost->id }}">

                                            {{ $forumPost->comments > 999 ? round($forumPost->comments / 1000, 1) . ' K' : $forumPost->comments }}
                                        </span>
                                    </span>

                                    {{-- <span class="text-decoration-none text-black d-flex align-items-center gap-1"
                                        data-forum-id="{{ $forumPost->id }}"
                                        data-current-user-id="{{ Auth::guard('job_seekers')->check() ? Auth::guard('job_seekers')->user()->id : null }}"
                                        style="cursor: pointer;">
                                        <i class="fa fa-share fs-5" style="color: #0064a7;"></i>
                                        <span class="d-flex align-items-center gap-1">
                                            1
                                        </span>
                                    </span> --}}
                                </div>
                            @endforeach
                        @else
                            @include('frontend.notFound')
                        @endif


                    </div>


                </div>
            </div>



        </div>
        <div class="chat-box rounded shadow-lg" id="chatBox"
            style="max-width: 400px; width: 90vw; max-height:auto; height:auto; position: fixed; bottom: 10px; right: 10px; background: white; z-index: 1000;">

            <!-- Chat Header -->
            <div class="d-flex justify-content-between align-items-center text-white p-2 rounded-top"
                style="background-color: #0064A7;" id=chatHeader>
                <span class="fw-semibold" name="receiver_name"></span>
                <button class="btn-close btn-close-white" onclick="toggleChat()"></button>
            </div>

            <div id="messageContainer" class="p-2 mb-5 overflow-auto" style="max-height:400px; overflow: hidden;">
                <p class="text-center text-secondary my-2 "><small>Conversation Not Stated Yet!</small></p>
                <div class="d-flex my-2 w-100 justify-content-end">
                    <span style="background-color: #0064A7; max-width: 90%;"
                        class="py-1 rounded-start-3 rounded-top-3  px-2 text-white">Hello, how are you</span>
                </div>
                <div class="d-flex my-2 w-100 justify-content-start">
                    <span class="py-1 rounded-end-3 rounded-top-3 bg-secondary-subtle px-2" style="max-width: 90%;">Lorem
                        ipsum dolor, sit amet consectetur adipisicing elit. Recusandae nemo beatae vero eius. Perferendis
                        ipsum rem repudiandae exercitationem, corporis officia.</span>
                </div>
                <div class="d-flex my-2 w-100 justify-content-end">
                    <span style="background-color: #0064A7; max-width: 90%;"
                        class="py-1 rounded-start-3 rounded-top-3  px-2 text-white">Hello, how are you</span>
                </div>
                <div class="d-flex my-2 w-100 justify-content-start">
                    <span class="py-1 rounded-end-3 rounded-top-3 bg-secondary-subtle px-2" style="max-width: 90%;">Lorem
                        ipsum dolor, sit amet consectetur adipisicing elit. Recusandae nemo beatae vero eius. Perferendis
                        ipsum rem repudiandae exercitationem, corporis officia.</span>
                </div>





            </div>

            <!-- Chat Input -->

            <div class="chat-input gap-1 d-flex p-2">

                <input type="hidden" name="receiver_id" value="">
                <input type="text" class="form-control rounded border flex-grow-1"
                    placeholder="Type your message here..." name="message">
                <button class="btn btn-send rounded mb-0" id="sendMessageButton" onclick="sendMessage()">
                    <i class="fas fa-paper-plane" style="color:#0064A7"></i>
                </button>
            </div>

        </div>

    </section>
@endsection


@push('scripts')
    <script src="https://js.pusher.com/8.4.0/pusher.min.js"></script>
    <script>
        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;

        var pusher = new Pusher('b08e227bde29e3142eb1', {
            cluster: 'ap2'
        });

        var channel = pusher.subscribe('forum-post');

        channel.bind('forum-posted', function(data) {

            // console.log(data)
            let broadcastForum = data.message

            console.log(broadcastForum)
            let newPost = document.createElement('div');

            newPost.innerHTML = `

                                <div class="row flex-wrap align-items-center gap-2 p-2 d-flex justify-content-between mt-2">
                                    <div class="d-flex justify-content-between">
                                        <div class="d-flex align-items-center">
                                            <div class="col-auto p-0 order-0" >
                                                <img src="${broadcastForum.job_seeker.userThumbnail}"
                                                    class="img-fluid rounded-circle overflow-hidden"
                                                    style="aspect-ratio: 1; width: 3rem;" alt="">
                                            </div>
                                            <div class="col-auto flex-fill ps-2 order-md-1 order-2">
                                                <a href="${getBaseUrl()}/jobseeker/getProfile/${broadcastForum.job_seeker.id}"
                                                    class="text-decoration-none">
                                                    <h5 class="m-0 text-black">
                                                        ${broadcastForum.job_seeker.firstName} ${broadcastForum.job_seeker.lastName}
                                                    </h5>
                                                </a>
                                                <div class="d-inline-flex gap-4">
                                                    <small class="text-black-50 d-flex flex-wrap">
                                                        <span class='text-no-wrap'>
                                                            <svg width="14" height="18" viewBox="0 0 14 18"
                                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path
                                                                    d="M6.8 9.725C8.00122 9.725 8.975 8.75122 8.975 7.55C8.975 6.34878 8.00122 5.375 6.8 5.375C5.59878 5.375 4.625 6.34878 4.625 7.55C4.625 8.75122 5.59878 9.725 6.8 9.725Z"
                                                                    stroke="#9D9999" stroke-width="2"
                                                                    stroke-linecap="round" stroke-linejoin="round" />
                                                                <path
                                                                    d="M6.8 1.75C5.26174 1.75 3.78649 2.36107 2.69878 3.44878C1.61107 4.53649 1 6.01174 1 7.55C1 8.9217 1.29145 9.81925 2.0875 10.8125L6.8 16.25L11.5125 10.8125C12.3086 9.81925 12.6 8.9217 12.6 7.55C12.6 6.01174 11.9889 4.53649 10.9012 3.44878C9.81351 2.36107 8.33826 1.75 6.8 1.75Z"
                                                                    stroke="#9D9999" stroke-width="2"
                                                                    stroke-linecap="round" stroke-linejoin="round" />
                                                            </svg> ${broadcastForum.job_seeker.temporaryLocation}
                                                        </span>
                                                        <span class='text-no-wrap'>
                                                            <svg width="19" height="18" viewBox="0 0 19 18"
                                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path
                                                                    d="M9.59961 15C11.1909 15 12.717 14.3679 13.8423 13.2426C14.9675 12.1174 15.5996 10.5913 15.5996 9C15.5996 7.4087 14.9675 5.88258 13.8423 4.75736C12.717 3.63214 11.1909 3 9.59961 3C8.00831 3 6.48219 3.63214 5.35697 4.75736C4.23175 5.88258 3.59961 7.4087 3.59961 9C3.59961 10.5913 4.23175 12.1174 5.35697 13.2426C6.48219 14.3679 8.00831 15 9.59961 15ZM9.59961 1.5C10.5845 1.5 11.5598 1.69399 12.4697 2.0709C13.3797 2.44781 14.2065 3.00026 14.9029 3.6967C15.5993 4.39314 16.1518 5.21993 16.5287 6.12987C16.9056 7.03982 17.0996 8.01509 17.0996 9C17.0996 10.9891 16.3094 12.8968 14.9029 14.3033C13.4964 15.7098 11.5887 16.5 9.59961 16.5C5.45211 16.5 2.09961 13.125 2.09961 9C2.09961 7.01088 2.88979 5.10322 4.29631 3.6967C5.70283 2.29018 7.61049 1.5 9.59961 1.5ZM9.97461 5.25V9.1875L13.3496 11.19L12.7871 12.1125L8.84961 9.75V5.25H9.97461Z"
                                                                    fill="#9D9999" />
                                                            </svg>
                                                            Just Now
                                                        </span>
                                                    </small>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="d-flex flex-wrap align-items-center justify-content-center gap-2">

                                                <button class="buttons${broadcastForum.job_seeker.id} btn rounded-5 px-4 text-white text-nowrap"
                                                    style="background-color: #0064a7;"
                                                    
                                                    data-user-id="${broadcastForum.job_seeker.id}" onclick="follow(this)">
                                                    + <span class="d-none d-md-inline">${broadcastForum.followed}</span>
                                                   

                                                </button>
                                                <button class="btn rounded-5 px-4 text-white text-nowrap"
                                                    style="background-color: #0064a7;"
                                                    data-user-id="${broadcastForum.job_seeker.id}" onclick="openChat(this)"
                                                    data-user-name="${broadcastForum.job_seeker.firstName} ${broadcastForum.job_seeker.lastName}">
                                                    <i class="bi bi-chat-left-text me-1 align-content-center"></i>
                                                    <span class="d-none d-md-inline">Chat</span>
                                                </button>


                                        </div>
                                    </div>
                                </div>

                                <div class="d-block me-0 p-0 mt-2" id="broadCastForumPost${broadcastForum.id}">
                                    <h4>${broadcastForum.topic}</h4>
                                    <small>${broadcastForum.description}</small>
                                </div>


                                <div class="d-flex border border-2 border-start-0 border-end-0 px-0 py-1 mt-2 gap-3">

                                    <button style="all:unset; cursor: pointer;" onclick="interact(this)"
                                        class="text-decoration-none text-black d-flex align-items-center gap-1"
                                        data-type='like' data-forum-id = "${broadcastForum.id}">

                                        <i class="fa-regular fa-thumbs-up fs-5"
                                            style="color: #0064a7;"></i>

                                        <span>
                                            ${broadcastForum.likes}
                                        </span>
                                    </button>

                                    <button style="all:unset; cursor: pointer;" onclick="interact(this)"
                                        class="text-decoration-none text-black d-flex align-items-center gap-1"
                                        data-type='dislike' data-forum-id="${broadcastForum.id}">

                                        <i class="fa-regular fa-thumbs-down fs-5"
                                            style="color: #0064a7;"></i>

                                        <span>
                                            ${broadcastForum.dislikes}
                                    </button>

                                    <span class="text-decoration-none text-black" data-bs-toggle="modal"
                                        data-bs-target="#commentModal" data-forum-id=${broadcastForum.id}"
                                        data-current-user-id="{{ Auth::guard('job_seekers')->check() ? Auth::guard('job_seekers')->user()->id : null }}"
                                        onclick="loadComments(this)">
                                        <span class="d-flex align-items-center gap-1" style="cursor: pointer;">
                                            <i class="fa-solid fa-comment fs-5" style="color: #0064a7;"></i>
                                            0
                                        </span>
                                    </span>
                                </div>
            
            
            `

            document.getElementById('forumPosts').prepend(newPost);
            if (broadcastForum.images.length > 0) {
                let broadcastImages = document.createElement('div');
                broadcastImages.classList.add('mt-2', 'text-center', 'row');

                if (broadcastForum.images.length == 1) {
                    broadcastImages.classList.add('row-cols-1');
                } else {
                    broadcastImages.classList.add('row-cols-2');
                }

                broadcastForum.images.forEach(image => {
                    let img = document.createElement('div');
                    img.innerHTML = `
                         <div class="col p-2">
                            <img src="${image}" class="img-fluid w-100"
                            style="max-width:500px;" alt="Post Image">
                            </div>
                    `

                    broadcastImages.appendChild(img);

                })

                newPost.insertBefore(broadcastImages, document.getElementById('broadCastForumPost' + broadcastForum
                    .id).nextSibling)

                // broadImages.innerHTML= `

            //             child.parentNode.insertBefore(newElement, child.nextSibling);

            // `
            }

            let count = parseInt(document.getElementById('newPostsCount').textContent) + 1
            document.getElementById('newPostsCount').textContent = count
            document.getElementById('newPostsAlert').classList.remove('d-none');


            // alert(JSON.stringify(data));
        });

        var chatchannel = pusher.subscribe('chat.' + "{{ Auth::guard('job_seekers')->id() }}");
        chatchannel.bind('new-message', function(data) {
            let message = data.message

            if ($('#chatBox [name="receiver_id"]').val() == message.receiver_id) {
                return;
            }
            if ($('#chatBox [name="receiver_id"]').val() == message.sender_id) {
                $('#messageContainer').append(`
                    <div class="d-flex my-2 w-100 justify-content-start">
                        <span class="py-1 rounded-end-3 rounded-top-3 bg-secondary-subtle px-2" style="max-width: 90%;">
                            ${message.message}
                        </span>
                    </div>
                `)
                $('#messageContainer').animate({
                    scrollTop: $('#messageContainer')[0].scrollHeight
                }, 500)

            }

            // document.querySelectorAll('.list-group .list-group-item').forEach(item => {
            //     if (item.getAttribute('data-receiver-id') == message.sender_id) {
            //         item.style.background = 'rgba(0, 100, 167, 0.1)'
            //         item.querySelector('.message-content').innerHTML = message.message
            //     }
            // })

            //     // $('.list-group-item').each(function() {
            //     //     let userId = $(this).data('user-id'); // safer than attr()
            //     //     if (userId == message.sender_id) {
            //     //         console.log($(this))
            //     //         $(this).css('background', 'rgba(0, 100, 167, 0.1)');
            //     //     }
            //     // });

            // }
            // else {

            //     // $('.list-group-item').each(function() {
            //     //     let userId = $(this).data('user-id'); // safer than attr()
            //     //     if (userId == message.sender_id) {
            //     //         console.log($(this))
            //     //         $(this).css('background', 'rgba(0, 100, 167, 0.1)');
            //     //     }
            //     // });

            // }
            console.log(message);
            // alert(JSON.stringify(data));
        });
    </script>
    <script>
        // document.querySelectorAll('.list-group .list-group-item').forEach(item => {
        //     console.log(item.getAttribute('data-receiver-id'))
        // })
        async function openChat(e) {
            const chatBox = document.getElementById("chatBox");
            chatBox.querySelector('input[name="receiver_id"]').value = e.getAttribute('data-user-id')
            chatBox.querySelector('[name="receiver_name"]').innerHTML = e.getAttribute('data-user-name')
            e.parentElement.parentElement.parentElement.style.background = 'transparent'

            // console.log(e.parentElement.parentElement.parentElement)
            // alert(e.getAttribute('data-user-id'))

            chatBox.style.display = "block";
            // alert(chatBox.querySelector('input[name="receiver_id"]').value)
            $('#sendMessageButton').html(
                '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>'
            );


            try {
                $('#messageContainer').html(
                    '<p class="text-center text-secondary my-2 "><small>Loading Messages ....</small></p>')
                const response = await fetch(getBaseUrl() + '/jobseeker/sender-messages', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify({
                        sender_id: $('#chatBox [name="receiver_id"]').val(),
                    })
                });

                // Check for HTTP error response (like 401, 422, 500)
                if (!response.ok) {
                    // Try to parse JSON error response
                    const errorData = await response.json();
                    console.error('Server error:', errorData);

                    // Laravel validation errors (422 Unprocessable Entity)
                    if (response.status === 422) {
                        alert('Validation failed: ' + Object.values(errorData.errors).join('\n'));
                    }
                    // Laravel unauthenticated (401)
                    else if (response.status === 401) {
                        window.location.href = getBaseUrl() + '/login';
                    } else {
                        alert('Something went wrong. Please try again.');
                    }

                    // Stop further execution
                    return;
                }

                const data = await response.json();

                $('#sendMessageButton').html(
                    '<i class="fas fa-paper-plane" style="color:#0064A7"></i>'
                );

                if (data.status) {

                    //update response in the message box
                    if (!data.messages.length > 0) {
                        $('#messageContainer').html(
                            '<p class="text-center text-secondary my-2 "><small>Conversation Not Stated Yet!</small></p>'
                        )
                    } else {
                        $('#messageContainer').html('')
                    }





                    data.messages.forEach(message => {

                        if (message.receiver_id == e.getAttribute('data-user-id')) {


                            $('#messageContainer').append(`
                                <div class="d-flex my-2 w-100 justify-content-end">
                                    <span style="background-color: #0064A7; max-width: 90%;"
                                        class="py-1 rounded-start-3 rounded-top-3  px-2 text-white">${message.message}</span>
                                </div>
                            `)

                        } else {

                            $('#messageContainer').append(`
                                <div class="d-flex my-2 w-100 justify-content-start">
                                    <span class="py-1 rounded-end-3 rounded-top-3 bg-secondary-subtle px-2" style="max-width: 90%;">
                                        ${message.message}
                                    </span>
                                </div>
                            `)

                        }

                    })
                    $('#messageContainer').animate({
                        scrollTop: $('#messageContainer')[0].scrollHeight
                    }, 500)
                } else {
                    console.warn('Server responded with unexpected status:', data);
                }

            } catch (error) {
                // Network error or unexpected failure
                console.error('Fetch failed:', error);
                alert('Network error. Please check your connection.');
                $('#sendMessageButton').html(
                    '<i class="fas fa-paper-plane" style="color:#0064A7"></i>'
                );
            }

        }

        function toggleChat() {
            const chatBox = document.getElementById("chatBox");
            chatBox.style.display = chatBox.style.display === "block" ? "none" : "block";
        }
    </script>


    <script>
        let forumPostImages = [];

        function handleFiles(files) {
            for (let i = 0; i < files.length; i++) {
                if (forumPostImages.length >= 5)
                    break; // Limit to 5 images
                forumPostImages.push(files[i]);
            }
            updatePhotoDisplay();
        }

        function updatePhotoDisplay() {

            const forumPreviewImages = document.getElementById('forumPreviewImages');
            forumPreviewImages.innerHTML = '';

            if (forumPostImages.length > 0) {


                for (let i = 0; i < forumPostImages.length; i++) {
                    const container = document.createElement("div");
                    container.classList.add("uploaded-photo-container", "col-6", "col-md-4", "col-lg-4",
                        "position-relative", "mb-2");

                    const img = document.createElement('img');
                    img.className = 'profile-photo w-100 h-auto ';
                    img.src = URL.createObjectURL(forumPostImages[i]);
                    img.alt = `Additional photo ${i}`;

                    const options = document.createElement("div");
                    options.classList.add("photo-options");


                    const deleteBtn = document.createElement("button");
                    deleteBtn.classList.add("btn", "btn-delete", "position-absolute", "top-0", "text-danger");
                    deleteBtn.innerHTML = '<i class="bi bi-trash"></i>';
                    deleteBtn.onclick = () => deletePhoto(i);



                    // options.appendChild(selectBtn);
                    options.appendChild(deleteBtn);
                    container.appendChild(img);
                    container.appendChild(options);
                    forumPreviewImages.appendChild(container);
                }

                forumPreviewImages.classList.toggle('hidden', forumPostImages.length <= 0);
            } else {
                // primaryPhoto.src = 'https://placehold.co/100x100';
                forumPreviewImages.classList.add('hidden');
            }
        }

        function deletePhoto(index) {
            forumPostImages.splice(index, 1);
            updatePhotoDisplay();
        }
    </script>



    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // function setRedirectUrl() {
        //     fetch('/set-redirect', {
        //         method: 'POST',
        //         headers: {
        //             'Content-Type': 'application/json',
        //             'X-CSRF-TOKEN': '{{ csrf_token() }}'
        //         },
        //         body: JSON.stringify({
        //             redirect_url: window.location.href
        //         })
        //     });
        // }
        // Function to get the base URL of your application
        function getBaseUrl() {
            return window.location.protocol + "//" + window.location.host;
        }


        async function sendMessage() {

            let receiverId = $('#chatBox [name="receiver_id"]').val()
            let message = $('#chatBox [name="message"]').val()
            if (!message.trim()) {
                alert('Message cannot be empty');
                return;
            }
            // console.log('Sending Message', message);
            // console.log('Receiver ID', receiverId);
            $('#sendMessageButton').html(
                '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>'
            );

            try {
                const response = await fetch(getBaseUrl() + '/jobseeker/send-message', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify({
                        receiver_id: receiverId,
                        message: message
                    })
                });

                // Check for HTTP error response (like 401, 422, 500)
                if (!response.ok) {
                    // Try to parse JSON error response
                    const errorData = await response.json();
                    console.error('Server error:', errorData);

                    // Laravel validation errors (422 Unprocessable Entity)
                    if (response.status === 422) {
                        alert('Validation failed: ' + Object.values(errorData.errors).join('\n'));
                    }
                    // Laravel unauthenticated (401)
                    else if (response.status === 401) {
                        window.location.href = getBaseUrl() + '/login';
                    } else {
                        alert('Something went wrong. Please try again.');
                    }

                    // Stop further execution
                    return;
                }

                const data = await response.json();

                $('#sendMessageButton').html(
                    '<i class="fas fa-paper-plane" style="color:#0064A7"></i>'
                );

                if (data.status) {
                    $('#chatBox [name="message"]').val('');

                    $('#messageContainer').append(`
                                <div class="d-flex my-2 w-100 justify-content-end">
                                    <span style="background-color: #0064A7; max-width: 90%;"
                                        class="py-1 rounded-start-3 rounded-top-3  px-2 text-white">${message}</span>
                                </div>
                            `)

                    $('#messageContainer').animate({
                        scrollTop: $('#messageContainer')[0].scrollHeight
                    }, 500)
                    console.log('Message sent:', data);
                } else {
                    console.warn('Server responded with unexpected status:', data);
                }

            } catch (error) {
                // Network error or unexpected failure
                console.error('Fetch failed:', error);
                alert('Network error. Please check your connection.');
                $('#sendMessageButton').html(
                    '<i class="fas fa-paper-plane" style="color:#0064A7"></i>'
                );
            }

        }
    </script>

    <script>
        function formatDateWithComma(timestamp) {
            const date = new Date(timestamp);
            const day = date.getDate();
            const month = date.toLocaleString('en-US', {
                month: 'long'
            });
            const year = date.getFullYear();
            return `${day} ${month}, ${year}`;
        }
        // script to handle follow and unfollow

        function follow(e) {
            let userId = e.getAttribute('data-user-id')
            let currentStatus = e.querySelector('span').textContent
            // console.log(currentStatus)
            // console.log(userId)
            $.ajax({
                url: getBaseUrl() + '/discussion/follow-user',
                method: 'POST',
                data: {
                    follow_to: userId
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'), //  CSRF for Laravel
                    'X-Requested-With': 'XMLHttpRequest' //  Tell Laravel it's AJAX
                },
                beforeSend: function() {
                    e.innerHTML =
                        '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>'
                },
                success: function(response) {
                    // ✅ What to do on success
                    console.log(e.querySelector('span'))

                    // "buttons".$forumPost->jobSeeker->id


                    if (response.status) {

                        let buttons = document.querySelectorAll(".buttons" + userId)

                        console.log(buttons)

                        buttons.forEach(btn => {
                            console.log(btn)
                            if (currentStatus == 'Unfollow') {
                                btn.innerHTML =
                                    '+ <span class="d-none d-md-inline">Follow</span>'

                            } else {
                                btn.innerHTML =
                                    '<span class="d-none d-md-inline">Unfollow</span>'
                            }
                        })

                        // buttonDivs.forEach(btns => {

                        //     

                        // });
                        // if (currentStatus == 'Unfollow') {
                        //     e.innerHTML = `+ <span class="d-none d-md-inline">Follow</span>`
                        // } else {
                        //     e.innerHTML = `<span class="d-none d-md-inline">Unfollow</span>`
                        // }

                    } else {
                        alert('Something went wrong!')
                    }

                    console.log('Success:', response);
                },
                error: function(xhr, status, error) {
                    // ❌ Handle errors
                    e.innerHTML = `+ <span class="d-none d-md-inline">Follow</span>`
                    console.error('Error:', error);
                    if (xhr.status === 401) {
                        window.location.href = '/login';
                    }
                }

            });
        }

        //handle delete comment for forum post

        function handleDelete(e) {

            $('#deleteCommentButton').attr('data-comment-id', e.getAttribute('data-comment-id'))
            $('#deleteCommentButton').attr('data-forum-id', e.getAttribute('data-forum-id'))


        }


        function deleteComment(e) {


            $.ajax({
                url: getBaseUrl() + '/discussion/delete-comment/' + e.getAttribute('data-comment-id'),
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'), //  CSRF for Laravel
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-HTTP-Method-Override': 'DELETE'
                },
                success: function(response) {
                    // ✅ What to do on success
                    console.log('Success:', response);
                    if (response.status) {
                        $('#deleteModal').modal('hide');
                        $('#commentModal').modal('show');
                        loadComments(document.getElementById('commentModal'))
                        console.log('commentCount_' + e.getAttribute('data-forum-id'))
                        document.getElementById('commentCount_' + e.getAttribute('data-forum-id')).textContent =
                            parseInt(document.getElementById('commentCount_' + e.getAttribute('data-forum-id'))
                                .textContent) - 1
                    } else {
                        alert('Something went wrong!')
                    }

                },
                error: function(xhr, status, error) {
                    // ❌ Handle errors
                    console.error('Error:', error);
                    if (xhr.status === 401) {
                        window.location.href = '/login';
                    }
                }
            })
        }

        //load comment of specific forum post

        function loadComments(e) {
            let postId = e.getAttribute('data-forum-id')
            console.log(e)

            $('#commentModal').attr('data-forum-id', postId);

            $('#forumCommentButton').attr('data-forum-id', postId)
            console.log(postId)

            $.ajax({
                url: getBaseUrl() + '/discussion/comments/' + postId,
                method: 'GET',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest' //  Tell Laravel it's AJAX
                },
                beforeSend: function() {
                    $('#commentsList').html(
                        '<p class="text-center my-2"><span class="spinner-border spinner-border-sm mx-2" role="status" aria-hidden="true"></span>Loading...</p>'
                    )
                },
                success: function(response) {
                    $('#commentsList').html('')
                    console.log(response.data)
                    // ✅ What to do on success
                    if (response.status == false) {
                        $('#commentsList').html(
                            '<p class="text-center my-2 text-secondary">No Comments yet !</p>')
                        console.log(response)
                        return
                    }
                    if (response.data.length > 0) {

                        response.data.map((comment) => {

                            if (e.getAttribute('data-current-user-id') == comment.job_seeker.id) {
                                $('#commentsList').append(`
                                    <div class="mb-3 p-3 border rounded d-flex justify-content-between align-items-center">
                                        <div>
                                        <strong> <img class="rounded-circle me-1" src="${comment.job_seeker.userThumbnail}" width="30" height="30"/> ${comment.job_seeker.firstName + ' ' + comment.job_seeker.lastName}</strong>
                                        <p class="mb-1">${comment.comment}</p>
                                        <small class="text-muted">${formatDateWithComma(comment.created_at)}</small>
                                        </div>
                                        <button class="btn btn-danger rounded-circle" data-bs-toggle="modal" data-comment-id="${comment.id}" data-forum-id="${comment.forum_id}"
                                            data-bs-target="#deleteModal" onclick="handleDelete(this)">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                `)
                            } else {
                                $('#commentsList').append(`
                                <div class="mb-3 p-3 border rounded">
                                    <div>
                                    <strong><img class="rounded-circle me-1" src="${comment.job_seeker.userThumbnail}" width="30" height="30"/> ${comment.job_seeker.firstName + ' ' + comment.job_seeker.lastName}</strong>
                                    <p class="mb-1">${comment.comment}</p>
                                    <small class="text-muted">${formatDateWithComma(comment.created_at)}</small>
                                    </div>

                                </div>
                            `)
                            }

                        })

                        $('#commentsList').animate({
                            scrollTop: $('#commentsList')[0].scrollHeight
                        }, 500)
                    } else {
                        $('#commentsList').html(
                            '<p class="text-center my-2 text-secondary">No Comments yet !</p>')
                    }
                    console.log('Success:', response);

                },
                error: function(xhr, status, error) {
                    // ❌ Handle errors
                    $('#commentsList').html('')
                    console.error('Error:', error);
                    if (xhr.status === 401) {
                        window.location.href = '/login';
                    }
                }
            });
        }


        function addComment(e) {
            let postId = e.getAttribute('data-forum-id')
            let comment = $('#commentInput').val()
            if (!comment.trim()) {
                return;
            }
            console.log(postId, comment)
            $.ajax({
                url: getBaseUrl() + '/discussion/add-comment',
                method: 'POST',
                data: {
                    forum_id: postId,
                    comment: comment
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'), //  CSRF for Laravel
                    'X-Requested-With': 'XMLHttpRequest' //  Tell Laravel it's AJAX
                },
                beforeSend: function() {
                    e.innerHtml =
                        '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>'

                },
                success: function(response) {
                    // ✅ What to do on success
                    if (response.status) {
                        $('#commentInput').val('')
                        if ($('#commentsList').html() ==
                            '<p class="text-center my-2 text-secondary">No Comments yet !</p>') {
                            $('#commentsList').html('')
                        }
                        $('#commentsList').append(`
                            <div class="mb-3 p-3 border rounded d-flex justify-content-between align-items-center">
                                <div>
                                <strong> {!! Auth::guard('job_seekers')->check() && Auth::guard('job_seekers')->user()->userThumbnail
                                    ? '<img class="rounded-circle me-1" src="' .
                                        asset('storage/' . Auth::guard('job_seekers')->user()->userThumbnail[0]) .
                                        '" width="30" height="30"/>'
                                    : '' !!} {{ Auth::guard('job_seekers')->check() ? Auth::guard('job_seekers')->user()->firstName . ' ' . Auth::guard('job_seekers')->user()->lastName : '' }}</strong>
                                <p class="mb-1">${response.data.comment}</p>
                                <small class="text-muted">${formatDateWithComma(response.data.created_at)}</small>
                                </div>
                                <button class="btn btn-danger rounded-circle" data-bs-toggle="modal" data-comment-id="${response.data.id}" data-forum-id="${response.data.forum_id}"
                                    data-bs-target="#deleteModal" onclick="handleDelete(this)">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                        `)
                        $('#commentsList').animate({
                            scrollTop: $('#commentsList')[0].scrollHeight
                        }, 500)
                        document.getElementById('commentCount_' + postId).textContent = parseInt(document
                            .getElementById('commentCount_' + postId).textContent) + 1

                    } else {
                        alert('Something went wrong!')
                    }

                    console.log('Success:', response);
                },
                error: function(xhr, status, error) {
                    // ❌ Handle errors
                    console.error('Error:', error);
                    if (xhr.status === 401) {
                        window.location.href = '/login';
                    }
                }
            });
        }
    </script>


    <script>
        async function interact(e) {
            let type = e.getAttribute('data-type')
            let postId = e.getAttribute('data-forum-id')
            console.log(type, postId)

            try {
                const response = await fetch(getBaseUrl() + '/discussion/interact', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify({
                        type: type,
                        post_id: postId
                    })
                });

                // Check for HTTP error response (like 401, 422, 500)
                if (!response.ok) {
                    // Try to parse JSON error response
                    const errorData = await response.json();
                    console.error('Server error:', errorData);

                    // Laravel validation errors (422 Unprocessable Entity)
                    if (response.status === 422) {
                        alert('Validation failed: ' + Object.values(errorData.errors).join('\n'));
                    }
                    // Laravel unauthenticated (401)
                    else if (response.status === 401) {
                        window.location.href = getBaseUrl() + '/login';
                    } else {
                        alert('Something went wrong. Please try again.');
                    }

                    return;
                }

                const data = await response.json();
                e.style.transform = 'scale(1)';

                if (data.status) {

                    switch (data.action) {
                        case 'add':
                            e.querySelector('span').textContent = parseInt(e.querySelector('span').textContent.trim()) +
                                1
                            toggleInteraction(e)
                            break;
                        case 'remove':
                            e.querySelector('span').textContent = parseInt(e.querySelector('span').textContent.trim()) -
                                1
                            toggleInteraction(e)
                            break;
                        case 'toggle':
                            let parent = e.parentElement
                            buttons = parent.querySelectorAll('button')
                            buttons.forEach(button => {
                                if (button.getAttribute('data-type') == e.getAttribute('data-type')) {
                                    button.querySelector('span').textContent = parseInt(button.querySelector(
                                        'span').textContent.trim()) + 1
                                    toggleInteraction(button)
                                } else {
                                    button.querySelector('span').textContent = parseInt(button.querySelector(
                                        'span').textContent.trim()) - 1
                                    toggleInteraction(button)
                                }
                            })
                            break;
                    }

                }

                console.log('Success:', data);

            } catch (error) {
                // Network error or unexpected failure
                console.error(error);
                e.style.transform = 'scale(1)';
                alert('Network error. Please check your connection.');
            }

        }

        function toggleInteraction(e) {
            e.querySelector('i').classList.toggle('fa-solid');
            e.querySelector('i').classList.toggle('fa-regular');
        }
    </script>
@endpush
