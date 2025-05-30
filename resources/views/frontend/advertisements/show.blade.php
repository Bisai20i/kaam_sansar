@extends('frontend.layouts.main')

@section('title', 'Advertisement')

@section('content')

    <div class="container mb-5">

        <section class="abroads">
            <div class="container mt">
                <div class="row mt">
                    <div class="col-sm-12 col-md-3 col-lg-3 border border-1 rounded p-2 fixed-height">
                        <!-- Responsive Image -->
                        <img src="{{ $ads->adsThumbnail ? asset($ads->adsThumbnail) : asset('frontend/assets/Images/teddy-bear.jpg') }}"
                            class="img-fluid rounded mb-3 w-100" alt="Product Thumbnail">

                        <!-- Profile & Price Section -->
                        <div class="profile-price d-flex align-items-center justify-content-between">
                            <div
                                class="d-flex justify-content-start align-items-center px-0 w-100 flex-grow-1" style="width: min-content;">
                                @if (!empty($ads->jobSeeker->userThumbnail) && is_array($ads->jobSeeker->userThumbnail))
                                    <img src="{{ asset('storage/' . $ads->jobSeeker->userThumbnail[0]) }}"
                                        class="rounded-circle abroad-chat" alt="Profile picture">
                                @else
                                    <img src="{{ asset('frontend/assets/Images/profile.jpg') }}"
                                        class="rounded-circle abroad-chat" alt="Default Profile">
                                @endif
                                <div class="ms-2 text-start">
                                    <p class="fw-semibold mb-0 ">{{ $ads->jobSeeker->firstName }}
                                        {{ $ads->jobSeeker->lastName }}</p>
                                    <p class="text-muted mb-0 mt-0">{{ $ads->contactNumber }}</p>
                                </div>
                            </div>
                            <h3 class="mt-2 mt-md-0 text-end price-text text-nowrap" style="width: min-content;">Rs. {{ $ads->pricing }}</h3>
                        </div>

                        <div class="mt-3 mb-3 d-flex flex-wrap justify-content-center gap-2">
                            <!-- <button class="btn custom-outline-btn flex-grow-1" onclick="toggleChat()"><i
                                        class="fas fa-comment-alt me-2"></i>Chat</button> -->


                            @if (Auth::guard('job_seekers')->check())
                                <!-- If user is logged in, open chat -->
                                @if (Auth::guard('job_seekers')->user()->id !== $ads->jobSeekerId)
                                    <button class="btn custom-outline-btn flex-grow-1"
                                        data-user-id="{{ $ads->jobSeekerId }}" onclick="openChat(this)"
                                        data-user-name="{{ $ads->jobSeeker->firstName . ' ' . $ads->jobSeeker->lastName }}">
                                        <i class="fas fa-comment-alt me-2"></i>
                                        <span class="d-none d-md-inline">Chat</span>
                                    </button>
                                @endif
                            @else
                                <!-- If user is not logged in, open login modal -->
                                <button class="btn custom-outline-btn flex-grow-1" data-bs-toggle="modal"
                                    data-bs-target="#loginModal" onclick="setRedirectUrl()">
                                    <i class="fas fa-comment-alt me-2"></i>
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

                            <!-- Share Button -->
                            <button class="btn custom-outline-btn flex-grow-1" id="shareButton"
                                data-url="{{ url()->current() }}">
                                <i class="fas fa-share me-2"></i>Share
                            </button>
                        </div>

                        <!-- Success Message -->
                        <!-- Flash-style alert message -->
                        <div id="copyMessage" class="alert alert-success alert-dismissible fade show" role="alert"
                            style="display: none;">
                            🔗 Link copied to clipboard!
                        </div>


                        <!-- Copy to Clipboard Script -->
                        <script>
                            document.addEventListener("DOMContentLoaded", function() {
                                const shareButton = document.getElementById("shareButton");
                                const copyMessage = document.getElementById("copyMessage");

                                shareButton.addEventListener("click", function() {
                                    const url = shareButton.getAttribute("data-url");

                                    // Create a temporary input to copy the URL
                                    const tempInput = document.createElement("input");
                                    tempInput.value = url;
                                    document.body.appendChild(tempInput);
                                    tempInput.select();
                                    document.execCommand("copy");
                                    document.body.removeChild(tempInput);

                                    // Show confirmation message
                                    copyMessage.style.display = "block";
                                    setTimeout(() => {
                                        copyMessage.style.display = "none";
                                    }, 2000);
                                });
                            });
                        </script>

                    </div>

                    <div class="col-md-9 ps-md-4 mt-3 mt-md-0 border-0 fixed-height">
                        <h2 class="fw-semibold">{{ ucfirst($ads->adsTitle) }}</h2>
                        <div class="step-container-gifts gap-4">

                            <button class="btn step-button-gifts active1-gifts" onclick="setActive(0)">
                                <span>Description</span>
                            </button>
                            <button class="btn step-button-gifts" onclick="setActive(1)">

                                <span>Comment</span>
                            </button>

                        </div>
                        <div class="row mt-3 mb-3" id="description">
                            <p>{{ $ads->adsDescription }}</p>
                        </div>

                        <!-- Comment Section -->
                        <div class="row mt-3 mb-3" id="comment" style="display: none;">
                            <div class="col-12">
                                <!-- Comments Container -->
                                <div id="commentsContainer" class="d-flex flex-column overflow-auto rounded"
                                    style="max-height: 200px;">

                                    <!-- Comments List -->
                                    <div id="commentsList me-4" class="d-flex flex-column">
                                        <!-- Comment 1 -->
                                        @foreach ($comments as $cmt)
                                            <div
                                                class="d-flex align-items-start p-1 bg-white rounded mb-2 comment-box w-100">
                                                <img alt="Profile picture of Carrie Bradshaw" class="rounded-circle me-3"
                                                    height="50" width="50"
                                                    src="{{ $cmt->jobSeeker->userThumbnail ? asset('storage/' . $cmt->jobSeeker->userThumbnail[0]) : asset('frontend/assets/Images/profile.jpg') }}" />
                                                <div class="comment-text">
                                                    <h6 class="fw-semibold mb-0 mb-0">
                                                        {{ $cmt->jobSeeker->firstName }} {{ $cmt->jobSeeker->lastName }}
                                                    </h6>
                                                    <p class="mb-0">{{ $cmt->comment }}</p>
                                                </div>
                                                @if (Auth::guard('job_seekers')->check() && Auth::guard('job_seekers')->user()->id === $cmt->jobSeekerId)
                                                    <button class="btn" data-bs-toggle="modal"
                                                        data-bs-target="#deleteModal{{ $cmt->id }}">
                                                        <i class="bi bi-trash text-danger"></i>
                                                    </button>
                                                    <!-- Bootstrap Delete Confirmation Modal -->
                                                    <div class="modal fade" id="deleteModal{{ $cmt->id }}" tabindex="-1"
                                                        aria-labelledby="deleteModalLabel{{ $cmt->id }}" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered">
                                                            <div
                                                                class="modal-content p-4 rounded-4 border-0 shadow-lg text-center">
                                                                <button type="button" class="btn-close ms-auto"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                                <div class="mb-3">
                                                                    <div class="mx-auto rounded-circle bg-danger bg-opacity-10 d-flex align-items-center justify-content-center"
                                                                        style="width: 64px; height: 64px;">
                                                                        <i class="bi bi-trash-fill text-danger fs-3"></i>
                                                                    </div>
                                                                </div>
                                                                <h4 class="fw-bold text-dark">Are you sure?</h4>
                                                                <p class="text-secondary mb-4">Are you sure you want to
                                                                    delete this comment?</p>
                                                                <div class="d-flex justify-content-center align-items-center"
                                                                    style="box-sizing: border-box;">
                                                                    <button type="button"
                                                                        class="btn border-secondary col-6 me-1"
                                                                        data-bs-dismiss="modal">Cancel</button>

                                                                    {{-- <button id="deleteCommentButton" data-comment-id="0"
                                                                        onclick="deleteComment(this)" data-forum-id="0"
                                                                        class="btn btn-danger w-100 ms-1">Delete</button> --}}
                                                                    
                                                                    <form class="w-100"
                                                                        action="{{ route('adscomment.destroy', $cmt->id) }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="submit"
                                                                            class="btn btn-danger w-100 ms-1">Delete</button>
                                                                    </form>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                       
                                                @endif




                                            </div>
                                        @endforeach


                                    </div>
                                </div>
                            </div>

                            <!-- Fixed Comment Input Section -->
                            @if (Auth::guard('job_seekers')->check())
                                <form action="{{ route('adscomment.store') }}" method="post">
                                    @csrf
                                    <input type="hidden" value="{{ $ads->id }}" name="adsId">

                                    <div
                                        class="col-12 d-flex align-items-center bg-white rounded shadow-sm position-sticky bottom-0 w-100 p-2">
                                        <!-- Image on the left side of the input field -->
                                        <img alt="Profile picture of user" class="rounded-circle abroad-chat me-2"
                                            src="{{ @Auth::guard('job_seekers')->user()->userThumbnail ? asset('storage/' . @Auth::guard('job_seekers')->user()->userThumbnail[0]) : asset('frontend/assets/Images/profile.jpg') }}" />

                                        <!-- Input Box with full width -->
                                        <input class="form-control w-100 p-2" id="commentInput"
                                            placeholder="Write a comment...." name="comment" type="text" />

                                        <!-- Send Button -->
                                        <button type="submit" class="btn w-10 ms-2 comment-button"
                                            style="background-color: #0064a7; color: #fff;" onclick="sendCommet(this)">
                                            <i class="bi bi-send" style="max: max-content;"></i>
                                        </button>

                                        <script>
                                            const sendCommet = (btn) => {
                                                if (document.getElementById('commentInput').value.trim() == '') return
                                                btn.innerHTML = `<span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span>`
                                                this.submit()
                                                btn.disabled = true

                                            }
                                        </script>

                                    </div>
                                </form>
                            @else
                                <p class="text-center text-secondary">Login first to comment!</p>
                            @endif

                        </div>


                    </div>
                </div>
            </div>

            <div class="row mt-4">
                <h3>Similar product</h3>
                <div class="row g-2 mt-0" id="product-list">

                    @if ($similarAds->isEmpty())
                        <p class="text-center text-secondary">No similar ads found.</p>
                    @endif

                    @foreach ($similarAds as $product)
                        <div class="col-lg-3 col-md-3 col-sm-6 col-12 product" data-category="electronics">
                            <div class="card-bdy-packages">
                                <a href="{{ route('ads.show', $product->id) }}" class="text-decoration-none text-black">
                                    <img src="{{ $product->adsThumbnail ? asset($product->adsThumbnail) : asset('frontend/assets/Images/teddy-bear.jpg') }}"
                                        class="bdy-packages-img mb-2"
                                        style="width: 100%; height: 180px; object-fit:auto;">
                                    <div class="card-body">
                                        <h6 class="card-title text-black mb-0">{{ $product->adsTitle }}</h6>
                                        <p class="card-text text-muted mb-0">{{ $product->location }}</p>
                                        <p class="card-text text-muted">{{ $product->postedDuration }}</p>

                                    </div>
                                </a>
                            </div>
                        </div>
                    @endforeach

                    @if ($similarAds->hasMorePages() || $similarAds->currentPage() != 1)

                        <div class="row mt-3">
                            <nav>
                                <ul class="pagination justify-content-end converter">
                                    {{-- Previous Button --}}
                                    @if ($similarAds->onFirstPage())
                                        <li class="page-item disabled">
                                            <a class="page-link primary_color_text">&lt;</a>
                                        </li>
                                    @else
                                        <li class="page-item">
                                            <a class="page-link primary_color_text"
                                                href="{{ $similarAds->previousPageUrl() }}">&lt;</a>
                                        </li>
                                    @endif

                                    {{-- Pagination Numbers --}}
                                    @php
                                        $currentPage = $similarAds->currentPage();
                                        $lastPage = $similarAds->lastPage();
                                        $pageRange = 2; // Number of pages to display before and after the current page
                                    @endphp

                                    {{-- Show First Page --}}
                                    @if ($currentPage > $pageRange + 1)
                                        <li class="page-item">
                                            <a class="page-link primary_color_text"
                                                href="{{ $similarAds->url(1) }}">1</a>
                                        </li>
                                        @if ($currentPage > $pageRange + 2)
                                            <li class="page-item disabled"><span class="page-link">...</span></li>
                                        @endif
                                    @endif

                                    {{-- Show Pages Before Current Page --}}
                                    @for ($i = max(1, $currentPage - $pageRange); $i < $currentPage; $i++)
                                        <li class="page-item">
                                            <a class="page-link primary_color_text"
                                                href="{{ $similarAds->url($i) }}">{{ $i }}</a>
                                        </li>
                                    @endfor

                                    {{-- Current Page --}}
                                    <li class="page-item active">
                                        <span class="page-link" style="background: #196BA6;">{{ $currentPage }}</span>
                                    </li>

                                    {{-- Show Pages After Current Page --}}
                                    @for ($i = $currentPage + 1; $i <= min($lastPage, $currentPage + $pageRange); $i++)
                                        <li class="page-item">
                                            <a class="page-link primary_color_text"
                                                href="{{ $similarAds->url($i) }}">{{ $i }}</a>
                                        </li>
                                    @endfor

                                    {{-- Show Last Page --}}
                                    @if ($currentPage < $lastPage - $pageRange)
                                        @if ($currentPage < $lastPage - $pageRange - 1)
                                            <li class="page-item disabled"><span class="page-link">...</span></li>
                                        @endif
                                        <li class="page-item">
                                            <a class="page-link primary_color_text"
                                                href="{{ $similarAds->url($lastPage) }}">{{ $lastPage }}</a>
                                        </li>
                                    @endif

                                    {{-- Next Button --}}
                                    @if ($similarAds->hasMorePages())
                                        <li class="page-item">
                                            <a class="page-link primary_color_text"
                                                href="{{ $similarAds->nextPageUrl() }}">&gt;</a>
                                        </li>
                                    @else
                                        <li class="page-item disabled">
                                            <a class="page-link primary_color_text">&gt;</a>
                                        </li>
                                    @endif
                                </ul>
                            </nav>
                        </div>
                    @endif

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
                        <span class="py-1 rounded-end-3 rounded-top-3 bg-secondary-subtle px-2"
                            style="max-width: 90%;">Lorem
                            ipsum dolor, sit amet consectetur adipisicing elit. Recusandae nemo beatae vero eius.
                            Perferendis
                            ipsum rem repudiandae exercitationem, corporis officia.</span>
                    </div>
                    <div class="d-flex my-2 w-100 justify-content-end">
                        <span style="background-color: #0064A7; max-width: 90%;"
                            class="py-1 rounded-start-3 rounded-top-3  px-2 text-white">Hello, how are you</span>
                    </div>
                    <div class="d-flex my-2 w-100 justify-content-start">
                        <span class="py-1 rounded-end-3 rounded-top-3 bg-secondary-subtle px-2"
                            style="max-width: 90%;">Lorem
                            ipsum dolor, sit amet consectetur adipisicing elit. Recusandae nemo beatae vero eius.
                            Perferendis
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

    <style>
        .comment-button:hover {
            outline: 1px solid #0064a7;
            background: white !important;
            color: #0064a7 !important;
        }
    </style>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    <script src="https://js.pusher.com/8.4.0/pusher.min.js"></script>
    <script>
        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;

        var pusher = new Pusher('b08e227bde29e3142eb1', {
            cluster: 'ap2'
        });

        var chatchannel = pusher.subscribe('chat.' + "{{ Auth::guard('job_seekers')->id() }}");
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
                        message: message,
                        reference_id: {
                            {
                                $ads - > id
                            }
                        }

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

    <!-- ✅ Place script here, before closing body tag -->
    <script>
        function setActive(tabIndex) {
            var buttons = document.querySelectorAll('.step-button-gifts');
            var descriptionSection = document.getElementById('description');
            var commentSection = document.getElementById('comment');

            if (!descriptionSection || !commentSection) {
                console.error("Sections not found!");
                return;
            }

            // Remove active class from all buttons
            buttons.forEach(button => button.classList.remove('active1-gifts'));

            // Hide all sections
            descriptionSection.style.display = 'none';
            commentSection.style.display = 'none';

            // Add active class to clicked button
            if (buttons[tabIndex]) {
                buttons[tabIndex].classList.add('active1-gifts');
            }

            // Show the selected section
            if (tabIndex === 0) {
                descriptionSection.style.display = 'block';
            } else if (tabIndex === 1) {
                commentSection.style.display = 'block';
            }
        }

        // Initialize by showing the description section (active by default)
        document.addEventListener("DOMContentLoaded", function() {
            @if (session('open_tab') == 'comment')
                setActive(1);
            @else
                setActive(0);
            @endif
        });

        // Add event listener to the send button
        document.getElementById('sendButton').addEventListener('click', function() {
            var commentInput = document.getElementById('commentInput');
            var commentText = commentInput.value.trim();

            // Only add a comment if the input is not empty
            if (commentText !== '') {
                var commentsList = document.getElementById('commentsList');
                var newComment = document.createElement('div');

                // Set comment box class and add HTML content
                newComment.className = 'd-flex align-items-start p-1 bg-white rounded shadow-sm mb-2 comment-box';
                newComment.innerHTML = `
                    <img alt="Profile picture of user" class="rounded-circle me-3" src="https://storage.googleapis.com/a1aa/image/3CpUMtugubz8I1SyWiQoLgE520O4UxkZW02TXnQ0WU4.jpg"/>
                    <div class="comment-text">
                        <h6 class="fw-semibold mb-0 mb-0"></h6>
                        <p class="mb-0">${commentText}</p>
                    </div>
                `;

                // Insert the new comment at the top of the list
                commentsList.insertBefore(newComment, commentsList.firstChild);

                // Clear the comment input field
                commentInput.value = '';
            }
        });

        // ✅ Ensure script runs when page loads
        document.addEventListener("DOMContentLoaded", function() {
            setActive(0); // Default active tab
        });
    </script>

@endsection
