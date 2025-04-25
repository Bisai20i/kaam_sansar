@extends('frontend.layouts.main')

@section('title', 'Advertisement')

@section('content')

<div class="container mb-5">

<section class="abroads">
    <div class="container mt">
        <div class="row mt">
            <div class="col-sm-12 col-md-3 col-lg-3 border border-1 rounded p-2 fixed-height">
                <!-- Responsive Image -->
                <img src="{{asset($ads->adsThumbnail)}}" class="img-fluid rounded mb-3 w-100"
                    alt="Product Thumbnail">

                <!-- Profile & Price Section -->
                <div class="profile-price d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                        <img src="{{asset($ads->jobSeeker->userThumbnail)}}"
                            class="rounded-circle abroad-chat" alt="Profile picture of Ram Baral">
                        <div class="ms-2">
                            <p class="fw-semibold mb-0">{{$ads->jobSeeker->firstName}} {{$ads->jobSeeker->lastName}}</p>
                            <p class="text-muted mb-0 mt-0">{{$ads->jobSeeker->phoneNumber}}</p>
                        </div>
                    </div>
                    <h3 class="mt-2 mt-md-0 text-end price-text">{{$ads->pricing}}</h3>
                </div>

                <div class="mt-3 mb-3 d-flex flex-wrap justify-content-center gap-2">
                    <button class="btn custom-outline-btn flex-grow-1" onclick="toggleChat()"><i
                            class="fas fa-comment-alt me-2"></i>Chat</button>
                    <button class="btn custom-outline-btn flex-grow-1"><i
                            class="fas fa-share me-2"></i>Share</button>
                </div>
            </div>

            <div class="col-md-9 ps-md-4 mt-3 mt-md-0 border-0 fixed-height">
                        <h2 class="fw-semibold">{{$ads->adsTitle}}</h2>
                        <div class="step-container d-flex justify-content-start gap-4">
                        <button class="btn step-button active1" onclick="setActive(0)">
                                <span>Description</span>
                            </button>
                            <button class="btn step-button" onclick="setActive(1)">
                                <span>Comment</span>
                            </button>
                        </div>
                <div class="row mt-3 mb-3" id="description">
                    <p>sdfghjkl</p>
                </div>

                <!-- Comment Section -->
                <div class="row mt-3 mb-3" id="comment" style="display: none;">
                    <div class="col-12">
                        <!-- Comments Container -->
                        <div id="commentsContainer" class="d-flex flex-column overflow-auto rounded"
                            style="max-height: 200px;">

                            <!-- Comments List -->
                            <div id="commentsList" class="d-flex flex-column">
                                <!-- Comment 1 -->
                                <div class="d-flex align-items-start p-1 bg-white rounded mb-2 comment-box">
                                    <img alt="Profile picture of Carrie Bradshaw" class="rounded-circle me-3"
                                        height="50" width="50"
                                        src="https://storage.googleapis.com/a1aa/image/ThNp8APQMIPaFZUmVLK-cOT1kYH9Ca9IxDVxpTDWa78.jpg" />
                                    <div class="comment-text">
                                        <h6 class="fw-semibold mb-0 mb-0">Carrie Bradshaw</h6>
                                        <p class="mb-0">How much reliable this product is??</p>
                                    </div>
                                </div>
                                <!-- Comment 2 -->
                                <div class="d-flex align-items-start p-1 bg-white rounded mb-2 comment-box">
                                    <img alt="Profile picture of Carrie Bradshaw" class="rounded-circle me-3"
                                        height="50" width="50"
                                        src="https://storage.googleapis.com/a1aa/image/ThNp8APQMIPaFZUmVLK-cOT1kYH9Ca9IxDVxpTDWa78.jpg" />
                                    <div class="comment-text">
                                        <h6 class="fw-semibold mb-0">Carrie Bradshaw</h6>
                                        <p class="mb-0">How much reliable this product is??</p>
                                    </div>
                                </div>
                                <!-- Comment 3 -->
                                <div class="d-flex align-items-start p-1 bg-white rounded mb-2 comment-box">
                                    <img alt="Profile picture of Carrie Bradshaw" class="rounded-circle me-3"
                                        height="50" width="50"
                                        src="https://storage.googleapis.com/a1aa/image/ThNp8APQMIPaFZUmVLK-cOT1kYH9Ca9IxDVxpTDWa78.jpg" />
                                    <div class="comment-text">
                                        <h6 class="fw-semibold mb-0">Carrie Bradshaw</h6>
                                        <p class="mb-0">How much reliable this product is??</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Fixed Comment Input Section -->
                    <div
                        class="col-12 d-flex align-items-center bg-white rounded shadow-sm position-sticky bottom-0 w-100 p-2">
                        <!-- Image on the left side of the input field -->
                        <img alt="Profile picture of user" class="rounded-circle abroad-chat me-2"
                            src="https://storage.googleapis.com/a1aa/image/3CpUMtugubz8I1SyWiQoLgE520O4UxkZW02TXnQ0WU4.jpg" />

                        <!-- Input Box with full width -->
                        <input class="form-control w-100 p-1" id="commentInput"
                            placeholder="Write a comment...." type="text" />

                        <!-- Send Button -->
                        <button class="btn btn-outline-primary border border-0 w-10 ms-2" id="sendButton">
                            <i class="bi bi-send"></i>
                        </button>
                    </div>
                </div>


            </div>
        </div>
    </div>

    <div class="row mt-4">
        <h3>Similar product</h3>
        <div class="row g-2 justify-content-center mt-0" id="product-list">
         @foreach($similarAds as $product )
            <div class="col-lg-3 col-md-3 col-sm-6 col-12 product" data-category="electronics">
                <div class="card-bdy-packages">
                    <img src="{{asset($product->adsThumbnail)}}" class="bdy-packages-img"
                    style="width: 100%; height: 180px; object-fit:auto;">
                    <div class="card-body">
                        <p class="mt-3 mb-0">{{$product->adsTitle }}</p>
                        <p class="price">{{$product->pricing}}</p>
                    </div>
                </div>
            </div>
            @endforeach
          
        </div>
    </div>


    <div class="chat-box rounded" id="chatBox">
        <div class="d-flex mb-3 justify-content-between align-items-center text-white p-2 rounded-top"
            style="background-color: #0064A7;">
            <span class="mt-2 mb-2 ms-2 fw-semibold">Ram Baral</span>
            <button class="btn-close btn-close-white" onclick="toggleChat()"></button>
        </div>
        <div class="chat-input gap-3 mb-3 rounded-bottom d-flex p-2">
            <input type="text" class="form-control ms-3 rounded border w-75"
                placeholder="What are your inquiries?">
            <button class="btn btn-send rounded w-auto">
                <i class="fas fa-paper-plane"></i>
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
            width: 400px;
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
            background-color: #0064A7;
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

/* Active button */
.step-button.active1 {
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

    <script>
        function toggleChat() {
            const chatBox = document.getElementById("chatBox");
            chatBox.style.display = chatBox.style.display === "block" ? "none" : "block";
        }
    </script>
<!-- ✅ Place script here, before closing body tag -->
<script>
    function setActive(tabIndex) {
        var buttons = document.querySelectorAll('.step-button');
        var descriptionSection = document.getElementById('description');
        var commentSection = document.getElementById('comment');

        if (!descriptionSection || !commentSection) {
            console.error("Sections not found!");
            return;
        }

        // Remove active class from all buttons
        buttons.forEach(button => button.classList.remove('active1'));

        // Hide all sections
        descriptionSection.style.display = 'none';
        commentSection.style.display = 'none';

        // Add active class to clicked button
        if (buttons[tabIndex]) {
            buttons[tabIndex].classList.add('active1');
        }

        // Show the selected section
        if (tabIndex === 0) {
            descriptionSection.style.display = 'block';
        } else if (tabIndex === 1) {
            commentSection.style.display = 'block';
        }
    }
    
// Initialize by showing the description section (active by default)
window.onload = function () {
    setActive(0);  // This ensures Description is displayed initially
}

// Add event listener to the send button
document.getElementById('sendButton').addEventListener('click', function () {
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
    document.addEventListener("DOMContentLoaded", function () {
        setActive(0); // Default active tab
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
@endsection