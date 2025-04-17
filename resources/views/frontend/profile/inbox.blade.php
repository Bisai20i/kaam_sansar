@extends('frontend.layouts.main')
@section('title', 'My Profile')
@section('content')
    <div class="container mt-4 mb-4 pt-5">
        <div class="d-flex justify-content-between py-3 px-4 border align-items-center border-bottom-0">
            <h5 class="fw-bold mb-0">My Inbox</h5>
            <div class="input-group w-50 position-relative">
                <span class="input-group-text border border-end-0 bg-transparent">
                    <i class="fas fa-search"></i>
                </span>
                <input type="search" name="searchQuery" oninput="handleSearch(this.value)" class="form-control border-start-0"
                    placeholder="Search">
                <div id='searchReasults' class="d-none position-absolute top-100 start-0 w-100 rounded bg-white border p-2"
                    style="z-index: 100;">

                </div>
            </div>
        </div>

        <div class="border">

            <ul class="list-group px-2 px-md-3 py-3 ">

                @if ($uniqueConversations->count() > 0)
                    @foreach ($uniqueConversations as $conversation)
                        <li class="list-group-item list-group-item-action d-flex align-items-center border rounded mb-3 px-2 position-relative"
                            data-receiver-id="{{ $conversation->otherUser->id }}"
                            style="background-color:{{ $conversation->is_read || $conversation->sender_id === $conversation->receiver_id || $conversation->sender_id === auth()->user()->id ? 'transparent' : 'rgba(0, 100, 167, 0.1)' }};">

                            <div class="d-flex w-100 align-items-center gap-md-2">
                                <i class="bi bi-circle-fill pe-2 pe-md-0"
                                    style="color: {{ $conversation->otherUser->status == 'active' ? '#0064A7' : '#9D9999' }};"></i>
                                <img src="{{ $conversation->otherUser->userThumbnail ? $conversation->otherUser->userThumbnail : asset('frontend/assets/Images/profile.jpg') }}"
                                    class="rounded-circle me-3" alt="User" style="width: 80px; height: 80px;">
                                <div class="flex-grow-1">
                                    <h6 class="mb-0">
                                        {{ $conversation->otherUser->id === Auth::guard('job_seekers')->id() ? 'You' : $conversation->otherUser->firstName . ' ' . $conversation->otherUser->lastName }}
                                    </h6>
                                    <p class="text-muted mb-0 text-truncate message-content">{{ $conversation->message }}
                                    </p>
                                </div>
                                <div class="d-flex flex-column text-end ps-2">
                                    <small
                                        class="text-muted mb-1 text-nowrap pe-md-1">{{ $conversation->created_at->format('h:i A') }}</small>
                                    <button class="btn w-100 h-100 py-md-2 px-md-5"
                                        data-user-id="{{ $conversation->otherUser->id }}"
                                        data-user-name="{{ $conversation->otherUser->firstName . ' ' . $conversation->otherUser->lastName }}"
                                        style="background-color: #0064A7;color: white;" onclick="openChat(this)"><i
                                            class="bi bi-reply-fill"></i>
                                        <span class="d-none d-md-inline">Reply</span></button>
                                </div>
                            </div>
                        </li>
                    @endforeach
                @else
                    <p class="text-center text-danger">No Messages</p>
                @endif


            </ul>
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
    </div>

@endsection


@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://js.pusher.com/8.4.0/pusher.min.js"></script>
    <script>
        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;

        console.log(document.querySelector('meta[name="csrf-token"]').getAttribute('content'))

        var pusher = new Pusher('b08e227bde29e3142eb1', {
            cluster: 'ap2',
        });
        // var pusher = new Pusher('b08e227bde29e3142eb1', {
        //     cluster: 'ap2',
        //     authEndpoint: '/broadcasting/auth', // Laravel's default auth route
        //     auth: {
        //         headers: {
        //             'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        //         }
        //     }
        // });

        var channel = pusher.subscribe('chat.' + "{{ Auth::guard('job_seekers')->id() }}");
        channel.bind('new-message', function(data) {
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

            document.querySelectorAll('.list-group .list-group-item').forEach(item => {
                if (item.getAttribute('data-receiver-id') == message.sender_id) {
                    item.style.background = 'rgba(0, 100, 167, 0.1)'
                    item.querySelector('.message-content').innerHTML = message.message
                }
            })

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
                    if (data.messages.length > 0) {
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
    </script>



    {{-- // script to handle debounce --}}
    <script>

        // document.querySelector('[name="searchQuery"]').addEventListener('change', function(e){
        //     console.log('hello')
        //     if(e.target.value === ''){
        //         console.log("is empty")
        //         $('#searchReasults').addClass('d-none');
        //     }else{
        //         console.log("is not empty")
        //         $('#searchReasults').removeClass('d-none');
        //     }
                
            
        // });

        function debounce(func, delay) {
            let timer;
            return function(...args) {
                clearTimeout(timer);
                timer = setTimeout(() => {
                    func.apply(this, args);
                }, delay);
            };
        }

        // Your actual search logic
        function performSearch(query) {

            if(query === '') {
                $('#searchReasults').html('')
                $('#searchReasults').addClass('d-none');
                return false;
            }
            console.log("Searching for:", query);
            $('#searchReasults').removeClass('d-none');
            fetch(getBaseUrl() + '/jobseeker/search-user?searchstr=' + query, {
                    method: 'GET',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(res => res.json())
                .then(data => {
                    let users = data.users
                    $('#searchReasults').html(`
                    <ul class="list-group">
                        ${users.map(user => `<li class="list-group-item d-flex align-items-center">
                                <img src="${user.userThumbnail}" alt="Avatar" class="img img-fluid rounded-circle me-2" style="height: 40px; width:40px; curser: pointer;">
                                ${user.firstName} ${user.lastName}
                                </li>`).join('')}
                    </ul>
                `);
                    console.log("Results:", data.users);
                    // handle results
                });
        }

        const handleSearch = debounce(performSearch, 1500);
    </script>
@endpush
