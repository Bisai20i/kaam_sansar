@extends('frontend.layouts.main')
@section('title')
    Discussion Form
@endsection
@section('content')
    <section class="main  container-fluid pt-5 pb-2">
        <div class="container">
            <div class="row mb-3">
                <div class="col-lg-3 col-12">
                    <a href="forumprofile.html" class=" text-decoration-none">
                        <h5 class="text-black">Discussion
                            Forum</h5>
                    </a>
                </div>

                <div class="col-lg-9 col-12 ps-4">
                    <div class="d-flex gap-2">
                        <form action="{{ route('frontend.discussion') }}" class="d-flex gap-2 flex-grow-1">
                            <div
                                class="col-auto d-flex flex-fill border border-1 border-dark-subtle rounded-5 align-items-center ps-3 overflow-hidden gap-1">
                                <i class="fa-solid fa-magnifying-glass text-black-50"></i>
                                <input type="search" placeholder="Search" name='searchstr'
                                    value="{{ request('searchstr') }}"
                                    class="w-100 h-100 border-0 m-0 text-black-50 rounded-end-5 px-1"
                                    style="outline: none;">
                            </div>
                            <div><button class="btn rounded-5 px-4 text-white text-nowrap m-auto"
                                    style="background-color: #0064a7;" type="submit">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </button>
                            </div>
                        </form>

                        <div class="col-auto">

                            <button class="btn rounded-5 px-4 text-white text-nowrap m-auto"
                                {{ Auth::guard('job_seekers')->check() ? '' : 'disabled' }}
                                style="background-color: #0064a7;" data-bs-toggle="modal" data-bs-target="#createPost">+
                                Create</button>


                            <!-- Modal -->
                            <div class="modal fade" id="createPost" tabindex="-1" aria-labelledby="createPostLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header d-flex">
                                            <h1 class="modal-title fs-5 mx-auto flex-fill" id="createPostLabel">Create
                                                Post
                                            </h1>
                                            <button type="button" class="btn-close m-0" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
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

                                                    <select name="category" class="form-select bg-dark-subtle text-black-50"
                                                        id="cat" aria-label="">
                                                        <option selected>Category</option>
                                                        <option value="education">Education</option>
                                                        <option value="investment">Investment</option>
                                                        <option value="scammer">Scammer</option>
                                                        <option value="office">Office</option>
                                                        <option value="other">Other</option>

                                                    </select>
                                                </div>
                                                <div class="form-floating text-black-50 mt-3">
                                                    <input name="topic" type="text"
                                                        class="form-control bg-dark-subtle text-black-50" id="titleInput"
                                                        placeholder="Post Title">
                                                    <label for="titleInput">Title</label>
                                                </div>
                                                <div class="form-floating text-black-50">
                                                    <textarea class="form-control bg-dark-subtle text-black-50" name="description" placeholder="Post Details"
                                                        id="floatingTextarea" style="height: 100px"></textarea>
                                                    <label for="floatingTextarea">Describe...</label>
                                                </div>
                                                <div class="d-flex bg-dark-subtle p-2 gap-3 align-items-center rounded">
                                                    <p class="flex-grow-1 my-auto text-black-50">Add to your post</p>
                                                    <div class="d-flex gap-3 align-items-center">
                                                        <a href="#" class="primary_color_text">
                                                            <i class="fa-solid fa-location-dot"></i></a>
                                                        <a href="#" class="primary_color_text"
                                                            onclick=" document.getElementById('forumImages').click()">
                                                            <i class="fa-solid fa-image"></i></a>
                                                        <input id="forumImages" class="d-none" type="file" multiple
                                                            accept="image/*" onchange="handleFiles(this.files)"
                                                            name="images[]">
                                                    </div>

                                                </div>
                                                <div id="forumPreviewImages" class="row flex-wrap mt-4">

                                                </div>
                                                <div class="d-flex justify-content-center mt-3">
                                                    <button type="submit" class="btn btn-primary mx-auto"
                                                        style="background-color: #0064a7;">Post</button>
                                                </div>

                                            </form>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-3 d-lg-block d-none">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-3">Hot Topics</h4>
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h5 class="card-title">News title Lorem ipsum dolor sit amet.</h5>
                                    <p class="card-text">
                                        <small class="text-body-secondary">Post by: Sangam Giri</small>
                                        <small class="text-body-secondary">Last updated 3 mins
                                            ago</small>
                                    </p>
                                </div>
                            </div>
                            <div class="card mb-3">
                                <img src="Images/image2.jpg" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">News title Lorem ipsum dolor sit amet.</h5>
                                    <p class="card-text">
                                        <small class="text-body-secondary">Post by: Sangam Giri</small>
                                        <small class="text-body-secondary">Last updated 3 mins
                                            ago</small>
                                    </p>
                                </div>
                            </div>
                            <div class="card mb-3">
                                <img src="Images/image1.jpg" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">News title Lorem ipsum dolor sit amet.</h5>
                                    <p class="card-text">
                                        <small class="text-body-secondary">Post by: Sangam Giri</small>
                                        <small class="text-body-secondary">Last updated 3 mins
                                            ago</small>
                                    </p>
                                </div>
                            </div>
                            <div class="card mb-3">
                                <img src="Images/ads1.jpg" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">News title Lorem ipsum dolor sit amet.</h5>
                                    <p class="card-text">
                                        <small class="text-body-secondary">Post by: Sangam Giri</small>
                                        <small class="text-body-secondary">Last updated 3 mins
                                            ago</small>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-9 col-12 ps-5">
                    <div class="row mb-3">
                        <div class="nav nav-pills column-gap-4 row-gap-2 justify-content-md-start justify-content-evenly">
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
                    <div id="newPostsAlert"
                        class="d-flex justify-content-center text-secondary d-none gap-2 p-2 align-items-center w-100 flex-wrap">
                        <a href=" {{ route('frontend.discussion') }}"><i class="fa-solid fa-arrow-rotate-right p-2"
                                style="font-size: 1.5rem;"></i></a>
                        <strong><span id="newPostsCount">0</span> New Posts Available</strong>
                    </div>
                    <div class="row">

                        @if (count($forumPosts) > 0)
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
                                                <a href="forumprofile.html" class="text-decoration-none">
                                                    <h5 class="m-0 text-black">
                                                        {{ $forumPost->jobSeeker->firstName . ' ' . $forumPost->jobSeeker->lastName }}
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
                                                            </svg> {{ $forumPost->jobSeeker->temporaryLocation }}
                                                        </span>
                                                        <span class='text-no-wrap'>
                                                            <svg width="19" height="18" viewBox="0 0 19 18"
                                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path
                                                                    d="M9.59961 15C11.1909 15 12.717 14.3679 13.8423 13.2426C14.9675 12.1174 15.5996 10.5913 15.5996 9C15.5996 7.4087 14.9675 5.88258 13.8423 4.75736C12.717 3.63214 11.1909 3 9.59961 3C8.00831 3 6.48219 3.63214 5.35697 4.75736C4.23175 5.88258 3.59961 7.4087 3.59961 9C3.59961 10.5913 4.23175 12.1174 5.35697 13.2426C6.48219 14.3679 8.00831 15 9.59961 15ZM9.59961 1.5C10.5845 1.5 11.5598 1.69399 12.4697 2.0709C13.3797 2.44781 14.2065 3.00026 14.9029 3.6967C15.5993 4.39314 16.1518 5.21993 16.5287 6.12987C16.9056 7.03982 17.0996 8.01509 17.0996 9C17.0996 10.9891 16.3094 12.8968 14.9029 14.3033C13.4964 15.7098 11.5887 16.5 9.59961 16.5C5.45211 16.5 2.09961 13.125 2.09961 9C2.09961 7.01088 2.88979 5.10322 4.29631 3.6967C5.70283 2.29018 7.61049 1.5 9.59961 1.5ZM9.97461 5.25V9.1875L13.3496 11.19L12.7871 12.1125L8.84961 9.75V5.25H9.97461Z"
                                                                    fill="#9D9999" />
                                                            </svg>
                                                            {{ $forumPost->created_at->diffForHumans() }}
                                                        </span>
                                                    </small>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="d-flex align-items-center">
                                            <button class="btn rounded-5 px-4 text-white text-nowrap m-auto me-2"
                                                style="background-color: #0064a7;"
                                                data-user-id="{{ $forumPost->jobSeeker->id }}" onclick="openChat(this)">+
                                                <span class="d-none d-md-inline">Follow</span></button>
                                            <button class="btn rounded-5 px-4 text-white text-nowrap m-auto"
                                                style="background-color: #0064a7;"
                                                data-user-id="{{ $forumPost->jobSeeker->id }}" onclick="openChat(this)"
                                                data-user-name="{{ $forumPost->jobSeeker->firstName . ' ' . $forumPost->jobSeeker->lastName }}">
                                                <i class="bi bi-chat-left-text me-1 align-content-center"></i>
                                                <span class="d-none d-md-inline">Chat</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-block me-0 p-0 mt-2">
                                    <h4>{{ $forumPost->topic }}</h4>
                                    <small>{{ $forumPost->description }}</small>
                                </div>

                                @if (count($forumPost->images) > 0)
                                    <div
                                        class="mt-2 text-center row {{ count($forumPost->images) === 1 ? 'row-cols-1' : 'row-cols-md-2 row-cols-1' }}">
                                        @foreach ($forumPost->images as $image)
                                            <div class="col p-2">
                                                <img src="{{ $image }}" class="img-fluid w-100"
                                                    style="max-width:500px;" alt="Post Image">
                                            </div>
                                        @endforeach


                                    </div>
                                @endif


                                <div
                                    class="d-inline-flex border border-2 border-start-0 border-end-0 px-0 py-1 mt-2 gap-3">
                                    <a href="#" class="text-decoration-none text-black">
                                        <span>
                                            <svg width="24" height="25" viewBox="0 0 24 25" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M23 10.5C23 9.96957 22.7893 9.46086 22.4142 9.08579C22.0391 8.71071 21.5304 8.5 21 8.5H14.68L15.64 3.93C15.66 3.83 15.67 3.72 15.67 3.61C15.67 3.2 15.5 2.82 15.23 2.55L14.17 1.5L7.59 8.08C7.22 8.45 7 8.95 7 9.5V19.5C7 20.0304 7.21071 20.5391 7.58579 20.9142C7.96086 21.2893 8.46957 21.5 9 21.5H18C18.83 21.5 19.54 21 19.84 20.28L22.86 13.23C22.95 13 23 12.76 23 12.5V10.5ZM1 21.5H5V9.5H1V21.5Z"
                                                    fill="#196BA6" />
                                            </svg>
                                            {{ $forumPost->likes }}</span>
                                    </a>
                                    <a href="#" class="text-decoration-none text-black">
                                        <span>
                                            <svg width="24" height="25" viewBox="0 0 24 25" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M19 15.5V3.5H23V15.5H19ZM15 3.5C15.5304 3.5 16.0391 3.71071 16.4142 4.08579C16.7893 4.46086 17 4.96957 17 5.5V15.5C17 16.05 16.78 16.55 16.41 16.91L9.83 23.5L8.77 22.44C8.5 22.17 8.33 21.8 8.33 21.38L8.36 21.07L9.31 16.5H3C2.46957 16.5 1.96086 16.2893 1.58579 15.9142C1.21071 15.5391 1 15.0304 1 14.5V12.5C1 12.24 1.05 12 1.14 11.77L4.16 4.72C4.46 4 5.17 3.5 6 3.5H15ZM15 5.5H5.97L3 12.5V14.5H11.78L10.65 19.82L15 15.47V5.5Z"
                                                    fill="#196BA6" />
                                            </svg>
                                            {{ $forumPost->dislikes }}</span></a>
                                    <a href="#" class="text-decoration-none text-black">
                                        <span>
                                            <svg width="24" height="25" viewBox="0 0 24 25" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M12 21.5C13.78 21.5 15.5201 20.9722 17.0001 19.9832C18.4802 18.9943 19.6337 17.5887 20.3149 15.9442C20.9961 14.2996 21.1743 12.49 20.8271 10.7442C20.4798 8.99836 19.6226 7.39472 18.364 6.13604C17.1053 4.87737 15.5016 4.0202 13.7558 3.67294C12.01 3.32567 10.2004 3.5039 8.55585 4.18509C6.91131 4.86628 5.50571 6.01983 4.51677 7.49987C3.52784 8.97991 3 10.72 3 12.5C3 13.988 3.36 15.391 4 16.627L3 21.5L7.873 20.5C9.109 21.14 10.513 21.5 12 21.5Z"
                                                    stroke="#196BA6" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                            </svg>
                                            0</span></a>
                                </div>
                            @endforeach
                        @else
                            <h4 class="text-center mt-4 text-danger">No Post Found</h4>
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
            let count = parseInt(document.getElementById('newPostsCount').textContent) + 1
            document.getElementById('newPostsCount').textContent = count
            document.getElementById('newPostsAlert').classList.remove('d-none');
            // alert(JSON.stringify(data));
        });
    </script>
    <script>
        function openChat(e) {
            const chatBox = document.getElementById("chatBox");
            chatBox.querySelector('input[name="receiver_id"]').value = e.getAttribute('data-user-id')
            chatBox.querySelector('[name="receiver_name"]').innerHTML = e.getAttribute('data-user-name')
            // alert(e.getAttribute('data-user-id'))

            chatBox.style.display = "block";
            // alert(chatBox.querySelector('input[name="receiver_id"]').value)
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


            // $.ajax({
            //     url: getBaseUrl() + '/send-message',
            //     method: 'POST', 

            //     headers: {
            //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'), //  CSRF for Laravel
            //         'X-Requested-With': 'XMLHttpRequest' //  Tell Laravel it's AJAX
            //     },
            //     beforeSend: function() {
            //         $('#sendMessageButton').html(
            //             '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>'
            //         );
            //     },
            //     success: function(response) {
            //         // ✅ What to do on success
            //         console.log('Success:', response);
            //     },
            //     error: function(xhr, status, error) {
            //         // ❌ Handle errors
            //         console.error('Error:', error);
            //         if (xhr.status === 401) {
            //             window.location.href = '/login'; 
            //         }
            //     }
            // });

        }
    </script>
@endpush
