@extends('frontend.layouts.main')

@section('title', 'Want to buy')

@section('content')


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
                    <button type="button" class="btn border-secondary col-6 me-1" data-bs-dismiss="modal">Cancel</button>

                    <button id="deleteCommentButton" data-comment-id="0" onclick="deleteComment(this)" data-product-id="0"
                        class="btn btn-danger w-100 ms-1">Delete</button>

                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addPostModal" tabindex="-1" aria-labelledby="addPostModalLabel" aria-hidden="true"
        data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-white justify-content-center align-items-center border border-bottom">
                    <h6 class="modal-title text-black d-flex justify-content-center" id="addPostModalLabel"
                        style="font-size: 24px;">Create Post</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <form id="newPostForm" action="{{ route('aboards.store') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3 form-floating">
                            <select class="form-select abroad-deal-1 fw-semibold" id="newCountrySelectWant"
                                aria-label="Country" name="country" required>

                                <option value="" disabled selected>Choose a Country</option>
                                <option value="usa">USA</option>
                                <option value="canada">Canada</option>
                                <option value="uk">UK</option>
                            </select>
                            <label for="newCountrySelect">Country</label>
                        </div>

                        <!-- Title Input with Floating Label -->
                        <div class="mb-3 form-floating abroad-deal-1 fw-semibold">
                            <input type="text" class="form-control abroad-deal-1 fw-semibold" id="newTitleInput"
                                placeholder="Title" name="productTitle" required>
                            <label for="newTitleInput">Title</label>
                        </div>
                        <!-- Category Select with Floating Label -->
                        <div class="mb-3 form-floating">
                            <select class="form-select abroad-deal-1 fw-semibold" name="productCategoryId"
                                aria-label="Category" required>
                                <option value="" disabled selected>Choose a Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->productCategoryTitle }}
                                    </option>
                                @endforeach
                            </select>
                            <label for="categorySelect">Category</label>
                        </div>
                        <input type="hidden" name ="type" value="Buy">

                        <div class="mb-3 form-floating abroad-deal-1 fw-semibold">
                            <textarea class="form-control abroad-deal-1 fw-semibold" id="newDescriptionInput" rows="4"
                                placeholder="Describe..." name ="productDescription" required></textarea>
                            <label for="newDescriptionInput">Description</label>
                        </div>

                        <div class="form-floating abroad-deal-1 fw-semibold mb-3">
                            <input type="text" class="form-control abroad-deal-1 fw-semibold" id="newFloatingURL"
                                placeholder="Paste URL Link" name="urlLink">
                            <label for="newFloatingURL">Paste URL Link</label>
                        </div>

                        <div class="d-flex flex-column abroad-deal-1 p-2 gap-2 rounded" style="max-width: 100%;">
                            <div class="mb-1">
                                <label for="fileInput" class="mb-2">Upload Image (Max 2MB)</label>
                                <input class="form-control py-2" type="file" accept="image/*" accept="image/*"
                                    id="fileInput" name="productThumbnail" onchange="validateFileSize(this)">


                            </div>

                            <div id="imagePreview" class="d-flex mt-1"></div>
                        </div>

                </div>

                <!-- Input Group for "Add to your Post" with Image Icon -->
                <!-- Input Group for "Add to your Post" with Image Icon -->
                {{-- <div class="image-upload-block" data-id="post1">
                            <div class="mb-3 input-group">
                                <input type="text" class="form-control abroad-deal-1 fw-semibold border-0"
                                    placeholder="Add to your Post" id="addToPostInput-post1">
                                <button class="btn abroad-deal-1 fw-semibold border-0"
                                    style="border-top-right-radius: 5px; border-bottom-right-radius: 5px;" type="button"
                                    data-upload-btn>
                                    <i class="fas fa-image"></i>
                                </button>
                                <input type="file" name="productThumbnail" class="d-none image-input" accept="image/*" />
                            </div>

                            
                        </div> --}}


                <script>
                    function validateFileSize(input) {
                        const file = input.files[0];
                        const maxSize = 2 * 1024 * 1024;
                        const parent = input.parentNode;

                        const existingAlert = parent.querySelector('.file-size-error');
                        if (existingAlert) {
                            existingAlert.remove();
                        }

                        if (file && file.size > maxSize) {
                            input.value = '';
                            input.classList.add('is-invalid');
                            document.getElementById('imagePreview').classList.add('d-none');
                            const errorDiv = document.createElement('div');
                            errorDiv.className = 'text-danger mt-2 file-size-error';
                            errorDiv.textContent = 'File size must be less than 2 MB.';

                            parent.appendChild(errorDiv);
                        } else {
                            input.classList.remove('is-invalid');
                            const file = input.files[0];
                            if (file && file.type.startsWith('image/')) {
                                const reader = new FileReader();
                                reader.onload = function(e) {
                                    document.getElementById('imagePreview').classList.remove('d-none');
                                    document.getElementById('imagePreview').innerHTML = `
                                        <img src="${e.target.result}" alt="Preview" style="height: 60px; width:30%; border-radius: 6px; object-fit: cover;">
                                        `;
                                };
                                reader.readAsDataURL(file);
                            } else {
                                document.getElementById('imagePreview').innerHTML = '';
                            }
                        }

                    }
                </script>



                <!-- Dynamically Display Image Here -->
                <div id="imagePreviewContainer" class="mb-3" style="display: none;">
                    <img id="imagePreview" class="img-fluid" alt="Selected Image" style="width: 120px; height: 80px;" />
                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <button type="submit" class="btn btn-search w-25" id="submitPost">Submit</button>
                </div>
                </form>

            </div>

        </div>
    </div>

    <div class="modal fade" id="commentModal" tabindex="-1" aria-labelledby="commentModalLabel" aria-hidden="true"
        data-product-id="0"
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

                    <!-- Leave New Comment Form -->

                    @auth('job_seekers')
                        <hr>
                        <div
                            class="col-12 d-flex align-items-center bg-white rounded shadow-sm position-sticky bottom-0 w-100 p-2 mt-2">

                            <img alt="Profile picture of user" class="rounded-circle gifts-chat me-2 img-thumbnail"
                                src="{{ @Auth::guard('job_seekers')->user()->userThumbnail ? asset('storage/' . @Auth::guard('job_seekers')->user()->userThumbnail[0]) : asset('frontend/assets/Images/profile.jpg') }}"
                                style="width: 50px; height:50px;" />
                            <input class="form-control w-100 p-2" name="comment" id="commentInput"
                                placeholder="Write a comment...." type="text" required />
                            <button type="submit" class="border bg-white p-2 border-0 m-0" id="forumCommentButton"
                                data-product-id="0" onclick="addComment(this)">
                                <i class="bi bi-send" style="color:#0064a7;"></i>
                            </button>

                        </div>
                    @endauth

                </div>
            </div>
        </div>
    </div>

    <div id="wantToBuyForm">
        <div class="profile-header">
            <div class="container">
                <h5 style="font-size: 30px;font-weight: 600;">Abroad Deals</h5>
                <p>Expand Your Horizons with Abroad Deals!<br>
                    Discover seamless opportunities for buying and selling goods internationally. Whether you’re looking
                    to source unique products from across the globe or sell your offerings to a worldwide audience,
                    we've got you covered! Abroad Deals simplifies the process. With secure transactions, reliable
                    shipping, and expert support, we make it easier than ever to connect buyers and sellers across
                    borders. Start exploring endless opportunities and take your trade global today!</p>
            </div>
        </div>

        <div class="container">
            <div class="mb-4 d-flex justify-content-between align-items-center ">
                <!-- Left Side Buttons -->
                <div class="d-flex gap-2">

                    <button onclick="window.location.href='{{ route('aboarddeals') }}'" id="wantToItem"
                        class="btn-toggle type-btn rounded fs-6 text-decoration-none">
                        Item</button>
                    <button id="wantToBuy" class="btn-toggle type-btn rounded fs-6 active-btn">Want to buy</button>


                </div>

                <!-- Right Side Add Item / Add Post Button -->
                @if (Auth::guard('job_seekers')->check())
                    <!-- If user is logged in, show the Post Ad button -->

                    <button class="btn  bg-primary text-white" id="addItemBtn" data-bs-toggle="modal"
                        data-bs-target="#addPostModal">
                        + Add Post
                    </button>
                @else
                    <button class="btn  bg-primary text-white" data-bs-toggle="modal" id="addItemBtn"
                        onclick="setRedirectUrl()" data-bs-target="#loginModal">
                        + Add Post
                    </button>


                    <script>
                        // Function to store the current URL before showing the login modal
                        function setRedirectUrl() {
                            fetch('/set-redirect', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },
                                body: JSON.stringify({
                                    redirect_url: window.location.href
                                })
                            });
                        }
                    </script>
                @endif

            </div>
            <form action="{{ route('aboard.buy') }}" method="get">
                <h6>Find what you're looking for ?</h6>
                <div class="container p-0">
                    <div class="row g-2 mt-2 mb-1 align-items-center">
                        <div class="col-md-5 d-flex align-items-center">
                            <div class="input-group ">
                                <span class="input-group-text bg-white border-end-0">
                                    <i class="fas fa-search text-muted"></i>
                                </span>
                                <input type="text" name="productTitle" class="form-control border-start-0 py-2"
                                    placeholder="What are you looking for?" value="{{ request('productTitle') }}">
                            </div>
                        </div>
                        <div class="col-md-3 d-flex align-items-center">
                            <select class="form-select py-2 bg-white border" id="countrySelect" name="country"
                                aria-label="">
                                <option selected disabled>Select Country</option>
                                @foreach ($countries as $u)
                                    <option value="{{ $u->country }}"
                                        {{ $u->country == request('country') ? 'selected' : '' }}>{{ $u->country }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3 d-flex align-items-center">
                            <select class="form-select py-2 bg-white" id="locationSelect" name="location"
                                aria-label="">
                                <option selected disabled>Select City</option>
                                @foreach ($cities as $c)
                                    <option value="{{ $c->location }}"
                                        {{ $c->location == request('location') ? 'selected' : '' }}>{{ $c->location }}
                                    </option>
                                @endforeach

                            </select>
                        </div>
                        <div class="col-md-1 d-grid">
                            <button class="btn btn-search w-100 py-2" type="submit">Search</button>
                        </div>
                    </div>
                </div>
            </form>

        </div>
        <div class="container mt-3">

            <div id="categoryFilter" style="display: block;">
                <!-- Your buttons here -->

                <div class="d-flex gap-2 py-3">
                    <a href="{{ route('aboard.buy') }}"
                        class="btn btn-outline-secondary btn-sm rounded-pill category-btn {{ request('categoryId') == '' ? 'active-btn' : '' }}">
                        All Categories
                    </a>
                    @foreach ($categories as $category)
                        <a href="{{ route('aboard.buy') }}?{{ http_build_query(array_merge(request()->query(), ['categoryId' => $category->id])) }}"
                            class="btn btn-outline-secondary btn-sm rounded-pill category-btn {{ request('categoryId') == $category->id ? 'active-btn' : '' }}">
                            {{ $category->productCategoryTitle }}
                        </a>
                    @endforeach
                </div>
            </div>

            <div class="row">
                <!-- Left Section: Cards -->

                <div class="col-md-9 flex-grow-1">
                    @foreach ($ads as $ad)
                        <div class="card border-0 mb-3">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <img src="{{ Auth::guard('job_seekers')->check() && Auth::guard('job_seekers')->user()->userThumbnail ? asset('storage/' . Auth::guard('job_seekers')->user()->userThumbnail[0]) : asset('frontend/assets/Images/profile.jpg') }}"
                                        class="rounded-circle me-2" alt="User" style="height:40px;width:40px;">
                                    <div>
                                        <h6 class="mb-0">{{ $ad->jobSeeker->firstName }}
                                            {{ $ad->jobSeeker->lastName }}</h6>
                                        <small class="text-muted">
                                            <i class="bi bi-geo-alt"></i> {{ $ad->country }}
                                            <i class="bi bi-clock ms-2"></i>
                                            {{ $ad->postedDuration }}
                                        </small>
                                    </div>
                                    <!-- <button class="btn btn-search ms-auto">Message</button> -->


                                    @if (Auth::guard('job_seekers')->check())
                                        <!-- If user is logged in, open chat -->
                                        <button class="btn custom-outline-btn ms-auto" style="color: #0064A7"
                                            data-user-id="{{ $ad->jobSeekerId }}" onclick="openChat(this)"
                                            data-user-name="{{ $ad->jobSeeker->firstName . ' ' . $ad->jobSeeker->lastName }}">
                                            <!-- <i class="fas fa-comment-alt me-2"></i> -->
                                            <!-- <span class="d-none d-md-inline"></span> -->
                                            Message
                                        </button>
                                    @else
                                        <!-- If user is not logged in, open login modal -->
                                        <button class="btn custom-outline-btn  ms-auto" data-bs-toggle="modal"
                                            style="color: #0064A7" data-bs-target="#loginModal"
                                            onclick="setRedirectUrl()">
                                            <span class="d-none d-md-inline">Chat</span>
                                        </button>

                                        <script>
                                            function setRedirectUrl() {
                                                fetch('/set-redirect', {
                                                    method: 'POST',
                                                    headers: {
                                                        'Content-Type': 'application/json',
                                                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                                    },
                                                    body: JSON.stringify({
                                                        redirect_url: window.location.href
                                                    })
                                                });
                                            }
                                        </script>
                                    @endif
                                </div>

                                <h5 class="mt-3">{{ $ad->productTitle }}</h5>
                                <p class="abroad-p">{{ $ad->productDescription }}</p>

                                <div class="mt-3">
                                    <a href="{{ $ad->urlLink }}" class="text-primary"
                                        target="_blank">{{ $ad->urlLink }}</a>
                                </div>

                                @if (!empty($ad->productThumbnail))
                                    <div class="mt-2 w-100" style="overflow: hidden; border-radius: 8px; height: 200px;">
                                        <img src="{{ $ad->productThumbnail }}" alt="Product Thumbnail"
                                            class="img-fluid w-100 h-100" style="object-fit: cover;">
                                    </div>
                                @endif

                                <hr class="mb-1">
                                <div class="d-flex gap-2 ms-2 align-items-center">
                                    <!-- <div><i class="bi bi-chat"></i>0</div> -->
                                    <!-- Button to open modal and load comments -->
                                    <button type="button" class="btn text-primary" data-bs-toggle="modal"
                                        data-bs-target="#commentModal" data-product-id="{{ $ad->id }}"
                                        data-current-user-id="{{ Auth::guard('job_seekers')->user()->id }}"
                                        onclick="loadComments(this)">
                                        <i class="bi bi-chat"></i>
                                        <span id="commentCount_{{ $ad->id }}"
                                            class="mx-1">{{ $ad->comment_count }}</span>
                                    </button>
                                    <!-- Example: post ID = 42 -->
                                    <button class="btn text-primary" style="cursor: pointer;" id="shareIcon"
                                        data-post-id="{{ $ad->id }}">
                                        <i class="bi bi-share"></i> <span class="mx-1">0</span>
                                    </button>

                                    <!-- Flash Message -->
                                    <div id="copyMessage"
                                        style="display: none; position: fixed; top: 20px; right: 20px; background-color: #d4edda; color: #155724; padding: 10px 20px; border-radius: 5px; box-shadow: 0 2px 6px rgba(0,0,0,0.2); z-index: 9999;">
                                        🔗 Link copied to clipboard!
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Right Section: Ad Banner -->
                @isset($ad_banners['right'])
                    <div class="col-md-3 p-0" style="max-height: 100vh;">
                        <img src="{{ asset($ad_banners['right']->image) }}" alt="ad_banner" class="img-fluid img p-0 w-100">
                    </div>
                @endisset


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
            <input type="text" class="form-control rounded border flex-grow-1" placeholder="Type your message here..."
                name="message">
            <button class="btn btn-send rounded mb-0" id="sendMessageButton" onclick="sendMessage()">
                <i class="fas fa-paper-plane" style="color:#0064A7"></i>
            </button>
        </div>

    </div>



    <style>
        .chat-box {
            position: fixed;
            bottom: 20px;
            right: 20px;
            height: 450px;
            border: 1px solid #ccc;
            background: white;
            border-radius: 8px;
            display: none;
        }

        .chat-input {
            position: absolute;
            bottom: 0;
            width: 100%;
            background: white;
            padding: 10px;
        }

        .btn-send {
            color: white;
            border-color: #0064A7;
        }

        .btn-send:hover {
            background-color: white;
            color: #0064A7;
            border-color: #0064A7;
        }

        .custom-outline-btn {
            border: 1px solid #0064a7 !important;
            color: black;
            font-size: 16px;
            font-weight: 600;
            background-color: transparent;
            transition: all 0.3s ease-in-out;
        }

        .custom-outline-btn:hover {
            background-color: #0064A7 !important;
            color: #fff !important;
        }

        .custom-outline-btn i {
            color: #0064A7;
        }

        .custom-outline-btn:hover i {
            color: #ffffff;
        }

        .step-container {
            justify-content: flex-start !important;
            border-bottom: 2px solid gray;
        }

        .step-button {
            background: none;
            border: none;
            cursor: pointer;
            transition: color 0.3s ease-in-out;
            color: #A4A4A4;
            white-space: nowrap;
            position: relative;
        }

        .step-button span {
            font-size: 20px;
            font-weight: 500;
            display: inline-block;
        }

        /* Style for the active button */
        .step-button-gifts.active1 {
            text-decoration: underline;
            color: #0064A7;

        }

        /* Active border directly under text */
        .step-button.active1 span::after {
            content: "";
            position: absolute;
            left: 0;
            bottom: -2px;
            width: 100%;
            height: 3px;
            background-color: #0064A7;
            z-index: 2;
        }
    </style>

@endsection


@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    <script src="https://js.pusher.com/8.4.0/pusher.min.js"></script>
    <script>
        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;

        var pusher = new Pusher('b08e227bde29e3142eb1', {
            cluster: 'ap2'
        });

        var chatchannel = pusher.subscribe('chat.' +
            "{{ Auth::guard('job_seekers')->check() && Auth::guard('job_seekers')->id() }}");
        chatchannel.bind('new-message', function(data) {
            let message = data.message
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

            console.log(message);
            // alert(JSON.stringify(data));
        });
    </script>
    <script>
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


        $(document).ready(function() {
            // Fetch country list from API
            $.ajax({
                url: 'https://restcountries.com/v3.1/all', // API URL for countries
                method: 'GET',
                success: function(data) {
                    // Sort the countries alphabetically by the 'common' name
                    data.sort(function(a, b) {
                        var nameA = a.name.common.toUpperCase(); // Ignore case while comparing
                        var nameB = b.name.common.toUpperCase(); // Ignore case while comparing
                        if (nameA < nameB) {
                            return -1; // Sort a before b
                        }
                        if (nameA > nameB) {
                            return 1; // Sort b before a
                        }
                        return 0; // If they are equal
                    });
                    // Loop through the API response and append country options to the dropdown
                    data.forEach(function(country) {
                        var countryName = country.name.common;
                        var countryCode = country
                            .cca2; // Optional: You can use the country code if needed
                        $('#newCountrySelectWant').append(new Option(countryName, countryName));
                    });
                },
                error: function(err) {
                    console.error('Error fetching country data:', err);
                }
            });
        });
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

        function loadComments(e) {
            let postId = e.getAttribute('data-product-id')
            console.log(e)

            $('#commentModal').attr('data-product-id', postId);

            $('#forumCommentButton').attr('data-product-id', postId)
            console.log(postId)

            $.ajax({
                url: getBaseUrl() + '/aboardcomment/' + postId,
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
                    // ✅ What to do on success
                    if (response.status == false) {
                        $('#commentsList').html(
                            '<p class="text-center my-2 text-secondary">No Comments yet !</p>')
                        return
                    }
                    if (response.data.length > 0) {

                        response.data.map((comment) => {

                            if (e.getAttribute('data-current-user-id') == comment.jobSeekerId) {
                                $('#commentsList').append(`
                                    <div class="mb-3 p-3 border rounded d-flex justify-content-between align-items-center">
                                        <div>
                                        <strong> <img class="rounded-circle me-1" src="${comment.job_seeker.userThumbnail}" width="30" height="30"/> ${comment.job_seeker.firstName + ' ' + comment.job_seeker.lastName}</strong>
                                        <p class="mb-1">${comment.comment}</p>
                                        <small class="text-muted">${formatDateWithComma(comment.created_at)}</small>
                                        </div>
                                        <button class="btn btn-danger rounded-circle" data-bs-toggle="modal" data-comment-id="${comment.id}" data-product-id="${comment.productId}"
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
                    // console.log('Success:', response);

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
            let postId = e.getAttribute('data-product-id')
            let comment = $('#commentInput').val()
            if (!comment.trim()) {
                return;
            }
            // console.log(postId, comment)
            $.ajax({
                url: "{{ route('aboardcomment.store') }}",
                method: 'POST',
                data: {
                    productId: postId,
                    comment: comment
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'), //  CSRF for Laravel
                    'X-Requested-With': 'XMLHttpRequest' //  Tell Laravel it's AJAX
                },
                beforeSend: function() {
                    console.log('hello')
                    e.innerHTML =
                        '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>'
                    e.disabled = true

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
                                <button class="btn btn-danger rounded-circle" data-bs-toggle="modal" data-comment-id="${response.data.id}" data-product-id="${response.data.productId}"
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
                        console.error('Something went wrong!')
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
            e.innerHTML = '<i class="bi bi-send" style="color:#0064a7;"></i>'
            e.disabled = false
        }


        function handleDelete(e) {

            $('#deleteCommentButton').attr('data-comment-id', e.getAttribute('data-comment-id'))
            $('#deleteCommentButton').attr('data-product-id', e.getAttribute('data-product-id'))


        }


        function deleteComment(e) {


            $.ajax({
                url: getBaseUrl() + '/aboardcomment/' + e.getAttribute('data-comment-id'),
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
                        console.log('commentCount_' + e.getAttribute('data-product-id'))
                        document.getElementById('commentCount_' + e.getAttribute('data-product-id'))
                            .textContent =
                            parseInt(document.getElementById('commentCount_' + e.getAttribute(
                                    'data-product-id'))
                                .textContent) - 1
                    } else {
                        console.error('Something went wrong!')
                    }

                },
                error: function(xhr, status, error) {
                    // ❌ Handle errors
                    console.error('Error:', error);
                    if (xhr.status === 401) {
                        console.error('Unauthorized');
                    }
                }
            })
        }
    </script>
@endpush
