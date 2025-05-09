@extends('frontend.layouts.main')

@section('title', 'Aboard deals')

@section('content')


    <section>
        <!-- Profile Header -->
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
                <button id="wantToItem" class="btn btn-toggle type-btn active-btn" onclick="filterType('Item', this)"> Item</button>
                <button id="wantToBuy" class="btn btn-toggle type-btn" data-url="{{ url()->current() }}" onclick="filterType('Buy', this)">Want to buy</button>

                </div>
                    <!-- Type Filter Section -->
         

                <!-- Right Side Add Item / Add Post Button -->
                <button class="btn  bg-primary text-white" id="addItemBtn" data-bs-toggle="modal" data-bs-target="#addItemModal">
                    + Add Item
                </button>
<!-- <script>
    document.getElementById('addItemBtn').addEventListener('click', function() {
        @if (Auth::check())
            //  User is logged in: open Add Item Modal
            var addItemModal = new bootstrap.Modal(document.getElementById('addItemModal'));
            addItemModal.show();
        @else
            //  User not logged in: open Login Modal
            var loginModal = new bootstrap.Modal(document.getElementById('loginModal'));
            loginModal.show();
        @endif
    });
</script> -->

            </div>
            <form action="{{ route('aboard.search') }}"  method="get">
    <h6>Find what you're looking for ?</h6>
    <div class="container p-0">
        <div class="row g-2 mt-2 mb-1 align-items-center">
            <div class="col-md-5 d-flex align-items-center">
            <div class="input-group ">
                    <span class="input-group-text bg-white border-end-0">
                        <i class="fas fa-search text-muted"></i>
                    </span>
                 
                    <input type="hidden" id="selectedTypeInput" name="type" value="{{ $type }}">
                    <input type="text" name="productTitle" class="form-control border-start-0" placeholder="What are you looking for?">
                </div>
            </div>
            <div class="col-md-3 d-flex align-items-center">
            <select class="form-select py-2 bg-white" id="countrySelect" name="country" aria-label="">
            <option selected disabled>Select Country</option>
                    @foreach($uniqueAboards as $u)
                    <option value="{{$u->country}}">{{$u->country}}</option>
                   @endforeach
                </select>
            </div>
            <div class="col-md-3 d-flex align-items-center">
            <select class="form-select py-2 bg-white" id="locationSelect" name="location" aria-label="">
            <option selected disabled>Select City</option>
                    @foreach($uniqueCity as $c)
                    <option value="{{$c->location}}">{{$c->location}}</option>
                    @endforeach
                    
                </select>
            </div>
            <div class="col-md-1 d-grid">
                <button class="btn btn-search w-100" type="submit">Search</button>
            </div>
        </div>
    </div>
</form>

                </div>
            </div>
        
            <!-- Item Form Section -->
            <div id="itemForm" >
    <div class="container mb-5">
        <section class="uploads">
            <!-- Category Filter Section -->
          

        
            <!-- Product Listing Section -->
            <div class="row g-2 mt-0" id="product-list">
            <div class="row" >
            <div id="categoryFilter" style="display: block;">
    <!-- Your buttons here -->

    <div class="d-flex gap-2 py-3">
        <a href="{{route('aboarddeals')}}"  class="btn-sm btn-outline-secondary rounded-pill category-btn active-btn text-decoration-none d-flex justify-content-center align-items-center"
            onclick="filterCategory('all', this)">All Categories </a>
        @foreach($categories as $category)
            <button class="btn btn-outline-secondary btn-sm rounded-pill category-btn"
                onclick="filterCategory('{{ $category->id }}', this)">
                {{ $category->productCategoryTitle }}
            </button>
        @endforeach
    </div></div>

    

            </div>
        
            @foreach($ads->where('type', 'Item') as $ad)
    <div class="col-lg-3 col-md-6 col-sm-12 col-12 product" 
         data-category="{{ $ad->productCategoryId }}" 
         data-type="{{ $ad->type }}">
        <div class="card p-2">
            <a class="card-bdy" style="width: 100%; object-fit: auto; text-decoration:none;" href="{{ route('aboards.show', $ad->id) }}" style="cursor: pointer;">
                <img src="{{ $ad->productThumbnail ? asset($ad->productThumbnail) : asset('Images/default-image.png') }}" 
                     class="bdy-packages-img" 
                     alt="Product Image" 
                     style="width: 100%; height: 180px; object-fit: auto;">
                <div class="card-body p-2">
                    <p class="my-0 text-secondary fw-semibold">{{ $ad->productTitle }}</p>
                    <p class="price fs-5 fw-semibold mb-0">NRs. {{ $ad->pricing }}</p>
                </div>
</a>
        </div>
    </div>
@endforeach

            </div>
        </section>
    </div>
</div>


           <!-- Add Item Modal -->
<div class="modal fade" id="addItemModal" tabindex="-1" aria-labelledby="addItemModalLabel"
    aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-white justify-content-center align-items-center">
                <h6 class="modal-title text-black d-flex justify-content-center" id="addItemModalLabel">Add Item</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addItemForm" action="{{ route('aboards.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3 form-floating">
    <select class="form-select abroad-deal-1 fw-semibold" id="countrySelect" name="country" aria-label="Country" required>
        <option value="" disabled selected>Choose a Country</option>
        <!-- Countries will be populated by JS -->
    </select>
    <label for="countrySelect">Country</label>
</div>

                    <!-- Category Select with Floating Label -->
                    <div class="mb-3 form-floating">
                        <select class="form-select abroad-deal-1 fw-semibold" id="categorySelect" name="productCategoryId"
                            aria-label="Category" required>
                            <option value="" disabled selected>Choose a Category</option>
                            @foreach($categories as $category)

                            <option value="{{$category->id}}">{{$category->productCategoryTitle}}</option>
                            @endforeach
                        </select>
                        <label for="categorySelect">Category</label>
                    </div>
                    <input type="hidden" id="type" name ="type" value="Item">

                    <!-- Title Input with Floating Label -->
                    <div class="mb-3 form-floating abroad-deal-1 fw-semibold">
                        <input type="text" class="form-control abroad-deal-1 fw-semibold" id="titleInput" name="productTitle"
                            placeholder="Title" required>
                        <label for="titleInput">Title</label>
                    </div>

                    <!-- Price Input with Floating Label -->
                    <div class="mb-3 form-floating abroad-deal-1 fw-semibold">
                        <input type="text" class="form-control abroad-deal-1 fw-semibold" id="priceInput" name="pricing"
                            placeholder="Enter Price" required>
                        <label for="priceInput">Enter Price</label>
                    </div>

                    <!-- Description Textarea with Floating Label -->
                    <div class="mb-3 form-floating abroad-deal-1 fw-semibold">
                        <textarea class="form-control abroad-deal-1 fw-semibold" id="descriptionInput" name="productDescription"
                            rows="4" placeholder="Describe..." required></textarea>
                        <label for="descriptionInput">Description</label>
                    </div>

                    <!-- Input Group for "Add to your Post" with Image Icon -->
                    <div class="mb-3 input-group">
                        <input type="text" class="form-control abroad-deal-1 fw-semibold border-0"
                            placeholder="Add to your Post" id="addToPostInput">
                        <button class="btn abroad-deal-1 fw-semibold border-0"
                            style="border-top-right-radius: 5px; border-bottom-right-radius: 5px;"
                            type="button" id="uploadImageButton">
                            <i class="fas fa-image"></i>
                        </button>
                        <!-- File Input (hidden) -->
                        <input type="file" id="imageInput" name="productThumbnail" class="d-none" accept="image/*" />
                    </div>

                    <!-- Dynamically Display Image Here -->
                    <div id="imagePreviewContainer" class="mb-3" style="display: none;">
                        <img id="imagePreview" class="img-fluid" alt="Selected Image"
                            style="width: 120px; height: 80px;" />
                    </div>

                    <div class="modal-footer d-flex justify-content-center">
                        <button type="submit" class="btn btn-search w-25">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

            <script>
    $(document).ready(function () {
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
                    var countryCode = country.cca2;  // Optional: You can use the country code if needed
                    
                    $('#countrySelect').append(new Option(countryName, countryName));
                });
            },
            error: function(err) {
                console.error('Error fetching country data:', err);
            }
        });
    });
</script>
<script>
    // Global filter variables
    let selectedCategory = 'all';
    let selectedType = 'Item'; // ✅ default to 'Item'

    // Filter by category: update global variable and refresh filtering
    function filterCategory(category, element) {
        // Remove active class from all category buttons
        const categoryButtons = document.querySelectorAll('.category-btn');
        categoryButtons.forEach(btn => btn.classList.remove('active-btn'));

        // Mark clicked button as active
        element.classList.add('active-btn');
        selectedCategory = category;
        updateFilters();
    }

    // Filter by type: update global variable and refresh filtering

    function filterType(type, element) {
    const typeButtons = document.querySelectorAll('.type-btn');
    typeButtons.forEach(btn => btn.classList.remove('active-btn'));

    element.classList.add('active-btn');
    selectedType = type;


        // ✅ Update hidden input in the form
        const typeInput = document.getElementById('selectedTypeInput');
    if (typeInput) {
        typeInput.value = selectedType;
    }

    // Update the right-side add button
    const addBtn = document.getElementById('addItemBtn');
    if (type === 'Buy') {
        addBtn.textContent = '+ Add Post';
        addBtn.setAttribute('data-bs-target', '#addPostModal');
    } else {
        addBtn.textContent = '+ Add Item';
        addBtn.setAttribute('data-bs-target', '#addItemModal');
    }

    updateFilters(); // ✅ This keeps the category section logic working
}

    function updateFilters() {
    const products = document.querySelectorAll('.product');
    const categoryFilter = document.getElementById('categoryFilter');

    products.forEach(product => {
        const productCategory = product.getAttribute('data-category');
        const productType = product.getAttribute('data-type');

        const categoryMatch = selectedCategory === 'all' || productCategory === selectedCategory;
        const typeMatch = selectedType === 'all' || productType === selectedType;

        const shouldShow = categoryMatch && typeMatch;

        if (shouldShow) {
            product.style.display = 'block';
        } else {
            product.style.display = 'none';
        }
    });

    // Show/hide "wantToBuyForm"
    if (selectedType === 'Buy') {
        wantToBuyForm.style.display = 'block';
    } else {
        wantToBuyForm.style.display = 'none';
    }

    // ✅ Show/hide category filter ONLY when type is 'Item'
    if (categoryFilter) {
        categoryFilter.style.display = (selectedType === 'Item') ? 'block' : 'none';
    }
}



</script>






            <script>
                // Open file input when image button is clicked
                document.getElementById('uploadImageButton').addEventListener('click', function () {
                    document.getElementById('imageInput').click();
                });

                // Display selected image dynamically
                document.getElementById('imageInput').addEventListener('change', function (e) {
                    const file = e.target.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function (event) {
                            // Show the image preview container
                            const imagePreviewContainer = document.getElementById('imagePreviewContainer');
                            const imagePreview = document.getElementById('imagePreview');
                            imagePreview.src = event.target.result; // Set the image source
                            imagePreviewContainer.style.display = 'block'; // Make the preview container visible
                        };
                        reader.readAsDataURL(file); // Read the image file
                    }
                });

                // Function to handle item submission and dynamically add it to the product list
                document.getElementById('submitItemButton').addEventListener('click', function () {
                    // Get the input values
                    const category = document.getElementById('categorySelect').value;
                    const title = document.getElementById('titleInput').value;
                    const price = document.getElementById('priceInput').value;
                    const description = document.getElementById('descriptionInput').value;
                    const imageInput = document.getElementById('imageInput').files[0]; // Get the image file
                    const imageURL = imageInput ? URL.createObjectURL(imageInput) : 'Images/default-image.png'; // Default image if no file selected

         

                    // Add the new product card to the product list
                    document.getElementById('product-list').appendChild(productCard);

                    // Close the modal
                    $('#addItemModal').modal('hide');

                    // Reset form fields and image preview
                    document.getElementById('addItemForm').reset();
                    document.getElementById('imagePreviewContainer').style.display = 'none';
                });
            </script>


          <!-- Add Post Modal -->
          <div class="modal fade" id="addPostModal" tabindex="-1" aria-labelledby="addPostModalLabel"
                aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div
                            class="modal-header bg-white justify-content-center align-items-center border border-bottom">
                            <h6 class="modal-title text-black d-flex justify-content-center" id="addPostModalLabel"
                                style="font-size: 24px;">Create Post</h6>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="d-flex align-items-center mb-3">
                                <img src="img/Nirmal.png" width="60" height="60" class="rounded-circle me-2" alt="User">
                                <span class="ms-2 fw-semibold" style="font-size: 22px; color: #282828;">Nirmal
                                    G.C.</span>
                            </div>
                            <form id="newPostForm" action="{{ route('aboards.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                             
                                <div class="mb-3 form-floating">
                                <select class="form-select abroad-deal-1 fw-semibold" id="newCountrySelect"
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
                        <select class="form-select abroad-deal-1 fw-semibold" id="categorySelect" name="productCategoryId"
                            aria-label="Category" required>
                            <option value="" disabled selected>Choose a Category</option>
                            @foreach($categories as $category)

                            <option value="{{$category->id}}">{{$category->productCategoryTitle}}</option>
                            @endforeach
                        </select>
                        <label for="categorySelect">Category</label>
                    </div>
                                <input type="hidden" id="type" name ="type" value="Buy">

                                <div class="mb-3 form-floating abroad-deal-1 fw-semibold">
                                    <textarea class="form-control abroad-deal-1 fw-semibold" id="newDescriptionInput"
                                        rows="4" placeholder="Describe..." name ="productDescription" required></textarea>
                                    <label for="newDescriptionInput">Description</label>
                                </div>

                                <div class="form-floating abroad-deal-1 fw-semibold mb-3">
                                    <input type="text" class="form-control abroad-deal-1 fw-semibold"
                                        id="newFloatingURL" placeholder="Paste URL Link" name="urlLink">
                                    <label for="newFloatingURL">Paste URL Link</label>
                                </div>

                                           <!-- Input Group for "Add to your Post" with Image Icon -->
                                        <!-- Input Group for "Add to your Post" with Image Icon -->
                                        <div class="image-upload-block" data-id="post1">
    <div class="mb-3 input-group">
        <input type="text" class="form-control abroad-deal-1 fw-semibold border-0"
            placeholder="Add to your Post" id="addToPostInput-post1">
        <button class="btn abroad-deal-1 fw-semibold border-0"
            style="border-top-right-radius: 5px; border-bottom-right-radius: 5px;"
            type="button" data-upload-btn>
            <i class="fas fa-image"></i>
        </button>
        <input type="file" name="productThumbnail" class="d-none image-input" accept="image/*" />
    </div>

    <div class="mb-3 image-preview-container" style="display: none;">
        <img class="img-fluid image-preview" alt="Selected Image" style="width: 120px; height: 80px;" />
    </div>
</div>


<script>
document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll('.image-upload-block').forEach(container => {
        const uploadBtn = container.querySelector('[data-upload-btn]');
        const imageInput = container.querySelector('.image-input');
        const previewContainer = container.querySelector('.image-preview-container');
        const previewImage = container.querySelector('.image-preview');

        uploadBtn.addEventListener('click', () => {
            imageInput.click();
        });

        imageInput.addEventListener('change', function () {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (event) {
                    previewImage.src = event.target.result;
                    previewContainer.style.display = 'block';
                };
                reader.readAsDataURL(file);
            }
        });
    });
});
</script>

                    <!-- <script>
    document.addEventListener('DOMContentLoaded', function () {
        const uploadImageButton = document.getElementById('newAddToPostInput');
        const imageInput = document.getElementById('imageInput');

        uploadImageButton.addEventListener('click', function () {
            imageInput.click();
        });

        imageInput.addEventListener('change', function () {
            const file = imageInput.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    const preview = document.getElementById('imagePreview');
                    preview.src = e.target.result;
                    document.getElementById('imagePreviewContainer').style.display = 'block';
                };
                reader.readAsDataURL(file);
            }
        });
    });
</script> -->

                    <!-- Dynamically Display Image Here -->
                    <div id="imagePreviewContainer" class="mb-3" style="display: none;">
                        <img id="imagePreview" class="img-fluid" alt="Selected Image"
                            style="width: 120px; height: 80px;" />
                    </div>
                    <div class="modal-footer d-flex justify-content-center">
                            <button type="submit" class="btn btn-search w-25" id="submitPost">Submit</button>
                        </div>
                            </form>

                        </div>
                       
                    </div>
                </div>
            </div>
       
       <!-- "Want to Buy" Section to display the post -->
<div id="wantToBuyForm" style="display: none;">
 
        <div class="container mt-4">
            <div class="row">
                <!-- Left Section: Cards -->
             
                <div class="col-md-9">
                @foreach($ads->where('type', 'Buy') as $ad)

                    <div class="card border-0 mb-3">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <img src="{{ asset($ad->productThumbnail) }}" class="rounded-circle me-2" alt="User" style="height:40px;width:40px;">
                                <div>
                                    <h6 class="mb-0">{{ $ad->jobSeeker->firstName }} {{ $ad->jobSeeker->lastName }}</h6>
                                    <small class="text-muted">
                                        <i class="bi bi-geo-alt"></i> 
                                        <i class="bi bi-clock ms-2"></i> 
                                        {{ $ad->postedDuration }}
                                    </small>
                                </div>
                                <!-- <button class="btn btn-search ms-auto">Message</button> -->

                                
                @if (Auth::guard('job_seekers')->check())
    <!-- If user is logged in, open chat -->
    <button class="btn btn-search ms-auto"
            data-user-id="{{ $ad->jobSeekerId }}"
            onclick="openChat(this)"
            data-user-name="{{ $ad->jobSeeker->firstName . ' ' . $ad->jobSeeker->lastName }}">
        <!-- <i class="fas fa-comment-alt me-2"></i> -->
        <span class="d-none d-md-inline">Message</span>
    </button>
@else
    <!-- If user is not logged in, open login modal -->
    <button class="btn custom-outline-btn flex-grow-1"
            data-bs-toggle="modal"
            data-bs-target="#loginModal"
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
                body: JSON.stringify({ redirect_url: window.location.href })
            });
        }
    </script>
@endif
                            </div>

                            <h5 class="mt-3">{{ $ad->productTitle }}</h5>
                            <p class="abroad-p">{{ $ad->productDescription }}</p>

                            <div class="mt-3">
                                <a href="{{ $ad->urlLink }}" class="text-primary" target="_blank">Link</a>
                            </div>

                            @if(!empty($ad->productThumbnail))
                                <div class="mt-2 w-100" style="overflow: hidden; border-radius: 8px; height: 200px;">
                                    <img src="{{ $ad->productThumbnail }}" alt="Product Thumbnail" class="img-fluid w-100 h-100" style="object-fit: cover;">
                                </div>
                            @endif

                            <hr>
                            <div class="d-flex gap-4 ms-2">
                                <!-- <div><i class="bi bi-chat"></i>0</div> -->
<!-- Button to open modal and load comments -->
<button type="button" class="btn btn-info"
        data-bs-toggle="modal"
        data-bs-target="#commentModal"
        onclick="loadComments({{ $ad->id }})">
    <i class="bi bi-chat"></i> 0 Comments
</button>
<!-- Example: post ID = 42 -->
<div style="cursor: pointer;" id="shareIcon" data-post-id="{{ $ad->id }}">
    <i class="bi bi-share"></i> <span id="shareCount">0</span>
</div>

<!-- Flash Message -->
<div id="copyMessage" style="display: none; position: fixed; top: 20px; right: 20px; background-color: #d4edda; color: #155724; padding: 10px 20px; border-radius: 5px; box-shadow: 0 2px 6px rgba(0,0,0,0.2); z-index: 9999;">
    🔗 Link copied to clipboard!
</div>
<!-- /////////////////////////////
 




-->

<!-- Modal for Comments -->
<div class="modal fade" id="commentModal" tabindex="-1" aria-labelledby="commentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="commentModalLabel">Comments</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
            <div class="modal-body">
                <!-- Comments List (Loaded via AJAX) -->
                <div id="commentsList" style="max-height: 300px; overflow-y: auto;">
                @foreach($comments as $cmt)
    <div class="d-flex align-items-start p-1 bg-white rounded mb-2 comment-box w-100">
        <img alt="Profile picture" class="rounded-circle me-3" height="50" width="50"
             src="https://storage.googleapis.com/a1aa/image/ThNp8APQMIPaFZUmVLK-cOT1kYH9Ca9IxDVxpTDWa78.jpg" />
        <div class="comment-text">
            <h6 class="fw-semibold mb-0">
                {{ $cmt->jobSeeker->firstName }} {{ $cmt->jobSeeker->lastName }}
            </h6>
            <p class="mb-0">{{ $cmt->comment }}</p>
        </div>

        @if (Auth::guard('job_seekers')->check() && Auth::guard('job_seekers')->user()->id === $cmt->jobSeekerId)
            <button  type="submit" class="btn" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $cmt->id }}">
                <i class="bi bi-trash text-danger"></i>
            </button>

            <!-- Delete Confirmation Modal -->
            <div class="modal fade" id="deleteModal{{ $cmt->id }}" tabindex="-1"
                 aria-labelledby="deleteModalLabel{{ $cmt->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteModalLabel{{ $cmt->id }}">Confirm Delete</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Are you sure you want to delete this comment?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary"
                                    data-bs-dismiss="modal">Cancel</button>
                            <form action="{{ route('aboardcomment.destroy', $cmt->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endforeach

                <div class="">
                <!-- Form for Adding a Comment -->
                @if (Auth::guard('job_seekers')->check())
                    <form action="{{ route('aboardcomment.store') }}" method="post">
                    @csrf
                    <input type="hidden" value="{{$ad->id}}" name="productId">

                    <div
                        class="col-12 d-flex align-items-center bg-white rounded shadow-sm position-sticky bottom-0 w-100 p-2">
                        <!-- Image on the left side of the input field -->
                        <img alt="Profile picture of user" class="rounded-circle abroad-chat me-2"
                            src="https://storage.googleapis.com/a1aa/image/3CpUMtugubz8I1SyWiQoLgE520O4UxkZW02TXnQ0WU4.jpg" />

                        <!-- Input Box with full width -->
                        <input class="form-control w-100 p-1" id="commentInput"
                            placeholder="Write a comment...." name="comment" type="text" />

                        <!-- Send Button -->
                        <button class="btn btn-outline-primary border border-0 w-10 ms-2" type="submit">
                            <i class="bi bi-send"></i>
                        </button>
                    </div>
                    </form>
                    @endif
              
            </div>
          
              
            </div>
        </div>
    </div>
</div>




     <script>

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
     
     
     <!-- /////////////////////////////////////////// -->

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const shareIcon = document.getElementById("shareIcon");
        const copyMessage = document.getElementById("copyMessage");
        const shareCount = document.getElementById("shareCount");
        const postId = shareIcon.getAttribute("data-post-id");
        const storageKey = `shareCount_post_${postId}`;

        // Load count from localStorage (default 0)
        const savedCount = parseInt(localStorage.getItem(storageKey)) || 0;
        shareCount.textContent = savedCount;

        shareIcon.addEventListener("click", function () {
            const url = window.location.href;

            navigator.clipboard.writeText(url).then(() => {
                // Flash message
                copyMessage.style.display = "block";
                setTimeout(() => {
                    copyMessage.style.display = "none";
                }, 2000);

                // Increment local count
                const newCount = savedCount + 1;
                localStorage.setItem(storageKey, newCount);
                shareCount.textContent = newCount;
            });
        });
    });
</script>


                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

              
                <!-- Right Section: Ad Banner -->
                <div class="col-md-3 border d-flex align-items-center justify-content-center">
                    <div class="ad-banner">Advertisement Banner</div>
                </div>

            </div>
        </div>
       
    
</div>

                
                
                

            </div>
        </div>
    </section>

  

    <script>
        // Image Upload and Preview

        // document.getElementById('uploadImageButton').addEventListener('click', function () {
        //     document.getElementById('imageInput').click();
        // });

        // document.getElementById('imageInput').addEventListener('change', function (e) {
        //     const file = e.target.files[0];
        //     if (file) {
        //         const reader = new FileReader();
        //         reader.onload = function (event) {
        //             const imagePreviewContainer = document.getElementById('imagePreviewContainer');
        //             const imagePreview = document.getElementById('imagePreview');
        //             imagePreview.src = event.target.result;
        //             imagePreviewContainer.style.display = 'block';
        //         };
        //         reader.readAsDataURL(file);
        //     }
        // });





        // Item Submission and Dynamic Addition to Product List

        // document.getElementById('submitItemButton').addEventListener('click', function () {
        //     const category = document.getElementById('categorySelect').value;
        //     const title = document.getElementById('titleInput').value;
        //     const price = document.getElementById('priceInput').value;
        //     const description = document.getElementById('descriptionInput').value;
        //     const imageInput = document.getElementById('imageInput').files[0];
        //     const imageURL = imageInput ? URL.createObjectURL(imageInput) : 'Images/default-image.png';

        //     const productCard = document.createElement('div');
        //     productCard.classList.add('col-lg-3', 'col-md-3', 'col-sm-6', 'col-12', 'product');
        //     productCard.setAttribute('data-category', category);

        //     productCard.innerHTML = `
        //     <div class="card-bdy-packages" onclick="window.location.href='abroadchat1.html';" style="cursor: pointer;">
        //         <img src="${imageURL}" class="bdy-packages-img" alt="Product Image" style="width: 286px; height: 180px;">
        //         <div class="card-body">
        //             <p class="mt-3 mb-0">${title}</p>
        //             <p class="price">NRs. ${price}</p>
        //         </div>
        //     </div>
        //     `;

        //     document.getElementById('product-list').appendChild(productCard);
        //     $('#addItemModal').modal('hide');
        //     document.getElementById('addItemForm').reset();
        //     document.getElementById('imagePreviewContainer').style.display = 'none';
        // });






        // Post Submission for 'Want to Buy' Section


    

        // Toggle Active State Between Forms

    // function toggleActive(button) {
    //     document.querySelectorAll('.btn-toggle').forEach(btn => btn.classList.remove('active'));
    //     button.classList.add('active');

    //     const addItemBtn = document.getElementById('addItemBtn');
    //     const itemForm = document.getElementById('itemForm');
    //     const wantToBuyForm = document.getElementById('wantToBuyForm');
    //     const categorybar = document.getElementById('categoryBar'); // if used

    //     if (!addItemBtn || !itemForm || !wantToBuyForm) {
    //         console.error("One or more elements are missing.");
    //         return;
    //     }

    //     if (button.textContent.trim() === "Want to buy") { 
    //         itemForm.style.display = 'none';
    //         wantToBuyForm.style.display = 'block';
    //         addItemBtn.textContent = "+ Add Post";
    //         addItemBtn.setAttribute('data-bs-target', '#addPostModal');
    //         if (categorybar) categorybar.style.display = 'none';
    //     } else {
    //         itemForm.style.display = 'block';
    //         wantToBuyForm.style.display = 'none';
    //         addItemBtn.textContent = "+ Add Item";
    //         addItemBtn.setAttribute('data-bs-target', '#addItemModal');
    //         if (categorybar) categorybar.style.display = 'block';
    //     }
    // }

    // document.addEventListener("DOMContentLoaded", function () {
    //     const currentType = "{{ $type ?? 'Item' }}"; // Use server-side value
    //     const buttons = document.querySelectorAll('.btn-toggle');

    //     buttons.forEach(button => {
    //         const buttonText = button.textContent.trim();
    //         if ((currentType === 'Buy' && buttonText === 'Want to buy') ||
    //             (currentType === 'Item' && buttonText === 'Item')) {
    //             toggleActive(button);
    //         }
    //     });
    // });

    </script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
@endsection