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
            <div class="mb-4 d-flex justify-content-between align-items-center">
                <!-- Left Side Buttons -->
                <div class="d-flex gap-2">
                    <button class="btn btn-toggle btn-all-categories active"onclick="filterType('Item', this)">Item</button>
                    <button class="btn btn-toggle" onclick="filterType( 'Buy',this)">Want to buy</button>
                </div>
                <!-- Type Filter Section -->


                <!-- Right Side Add Item / Add Post Button -->
                <button class="btn btn-add_post" id="addItemBtn" data-bs-toggle="modal" data-bs-target="#addItemModal">
                    + Add Item
                </button>
            </div>
            <h6>Find what you're looking for</h6>
            <div class="container">
                <div class="row g-2 mt-2 mb-1 align-items-center">
                    <div class="col-md-5 d-flex align-items-center">
                        <div class="input-group w-100">
                            <span class="input-group-text">
                                <i class="bi bi-search"></i>
                            </span>
                            <input type="text" class="form-control" placeholder="What are you looking for?">
                        </div>
                    </div>
                    <div class="col-md-3 d-flex align-items-center">
                        <select class="form-select abroad-deal">
                            <option selected>Select Country</option>
                            <option value="1">USA</option>
                            <option value="2">India</option>
                            <option value="3">UK</option>
                        </select>
                    </div>
                    <div class="col-md-3 d-flex align-items-center">
                        <select class="form-select abroad-deal">
                            <option selected>Select City</option>
                            <option value="1">New York</option>
                            <option value="2">Mumbai</option>
                            <option value="3">London</option>
                        </select>
                    </div>
                    <div class="col-md-1 d-grid">
                        <button class="btn btn-search w-100">Search</button>
                    </div>
                </div>
            </div>
            <script>
                function toggleActive(button) {
                    // Remove 'active' class from all buttons
                    document.querySelectorAll('.btn-toggle').forEach(btn => btn.classList.remove('active'));

                    // Add 'active' class to the clicked button
                    button.classList.add('active');

                    // Get the form
                    const itemForm = document.getElementById('itemForm');

                    // Show 'itemForm' if "Item" button is clicked, otherwise hide it
                    if (button.textContent.trim() === "Item") {
                        itemForm.style.display = "block";
                    } else {
                        itemForm.style.display = "none";
                    }
                }

                // Ensure the form is visible when the page loads
                document.addEventListener("DOMContentLoaded", function() {
                    document.getElementById('itemForm').style.display = "block";
                });
            </script>
            <!-- Item Form Section -->
            <div id="itemForm" style="display: block;">
                <div class="container mb-5">
                    <section class="uploads">
                        <!-- Category Filter Section -->
                        <div class="row">
                            <div class="d-flex gap-2 p-3">
                                <button class="btn-sm btn-outline-secondary rounded-pill category-btn active-btn"
                                    onclick="filterCategory('all', this)">All Categories</button>
                                @foreach ($categories as $category)
                                    <button class="btn btn-outline-secondary btn-sm rounded-pill category-btn"
                                        onclick="filterCategory('{{ $category->id }}', this)">
                                        {{ $category->productCategoryTitle }}
                                    </button>
                                @endforeach
                            </div>
                        </div>


                        <!-- Product Listing Section -->
                        <div class="row g-2 mt-0" id="product-list">
                            @foreach ($items as $ad)
                                <div class="col-lg-3 col-md-6 col-sm-12 col-12 product"
                                    data-category="{{ $ad->productCategoryId }}" data-type="{{ $ad->type }}">
                                    <div class="card">

                                        <div class="card-bdy-packages"
                                            onclick="window.location.href='{{ route('aboards.show', $ad->id) }}'"
                                            style="cursor: pointer;">
                                            <img src="{{ $ad->productThumbnail ? asset($ad->productThumbnail) : asset('Images/default-image.png') }}"
                                                class="bdy-packages-img" alt="Product Image"
                                                style="width: 100%; height: 180px; object-fit:auto;">
                                            <div class="card-body">
                                                <p class="mt-3 mb-0">{{ $ad->productTitle }}</p>
                                                <p class="price">NRs. {{ $ad->pricing }}</p>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </section>
                </div>
            </div>


            <!-- Add Item Modal -->
            <div class="modal fade" id="addItemModal" tabindex="-1" aria-labelledby="addItemModalLabel" aria-hidden="true"
                data-bs-backdrop="static" data-bs-keyboard="false">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header bg-white justify-content-center align-items-center">
                            <h6 class="modal-title text-black d-flex justify-content-center" id="addItemModalLabel">Add Item
                            </h6>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="addItemForm" action="{{ route('abroad_deal.store') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf


                                @if ($errors->any())
                                    <div class="mb-3 input-group">
                                        <ul
                                            style="color: red; font-size: 14px; list-style: none; padding: 0; margin: 10px 0;">
                                            @foreach ($errors->all() as $error)
                                                <li>⚠️ {{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif


                                <div class="mb-3 form-floating">
                                    <select class="form-select abroad-deal-1 fw-semibold" id="countrySelect" name="country"
                                        aria-label="Country" required>
                                        <option value="" disabled selected>Choose a Country</option>
                                        <!-- Countries will be populated by JS -->
                                    </select>
                                    <label for="countrySelect">Country</label>
                                </div>

                                <!-- Category Select with Floating Label -->
                                <div class="mb-3 form-floating">
                                    <select class="form-select abroad-deal-1 fw-semibold" id="categorySelect"
                                        name="productCategoryId" aria-label="Category" required>
                                        <option value="" disabled selected>Choose a Category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->productCategoryTitle }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <label for="categorySelect">Category</label>
                                </div>
                                <input type="hidden" id="type" name ="type" value="Item">

                                <!-- Title Input with Floating Label -->
                                <div class="mb-3 form-floating abroad-deal-1 fw-semibold">
                                    <input type="text" class="form-control abroad-deal-1 fw-semibold" id="titleInput"
                                        name="productTitle" placeholder="Title" required>
                                    <label for="titleInput">Title</label>
                                </div>

                                <!-- Price Input with Floating Label -->
                                <div class="mb-3 form-floating abroad-deal-1 fw-semibold">
                                    <input type="text" class="form-control abroad-deal-1 fw-semibold" id="priceInput"
                                        name="pricing" placeholder="Enter Price" required>
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
                                    <input type="file" id="imageInput" name="productThumbnail" class="d-none"
                                        accept="image/*" />
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
                let selectedType = 'all';

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
                    updateFilters();
                }

                // Show/hide products based on selected category and type
                function updateFilters() {
                    const products = document.querySelectorAll('.product');
                    products.forEach(product => {
                        const productCategory = product.getAttribute('data-category');
                        const productType = product.getAttribute('data-type');

                        // Check category match: if 'all' is selected, it's a match; otherwise, must equal productCategory.
                        const categoryMatch = (selectedCategory === 'all' || productCategory === selectedCategory);
                        // Similarly for type
                        const typeMatch = (selectedType === 'all' || productType === selectedType);

                        // Show the product only if both match
                        if (categoryMatch && typeMatch) {
                            product.style.display = '';
                        } else {
                            product.style.display = 'none';
                        }
                    });
                }
            </script>






            <script>
                // Open file input when image button is clicked
                document.getElementById('uploadImageButton').addEventListener('click', function() {
                    document.getElementById('imageInput').click();
                });

                // Display selected image dynamically
                document.getElementById('imageInput').addEventListener('change', function(e) {
                    const file = e.target.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function(event) {
                            // Show the image preview container
                            const imagePreviewContainer = document.getElementById('imagePreviewContainer');
                            const imagePreview = document.getElementById('imagePreview');
                            imagePreview.src = event.target.result; // Set the image source
                            imagePreviewContainer.style.display = 'block'; // Make the preview container visible
                        };
                        reader.readAsDataURL(file); // Read the image file
                    }
                });
            </script>


            <!-- Add Post Modal -->
            <div class="modal fade" id="addPostModal" tabindex="-1" aria-labelledby="addPostModalLabel"
                aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header bg-white justify-content-center align-items-center border border-bottom">
                            <h6 class="modal-title text-black d-flex justify-content-center" id="addPostModalLabel"
                                style="font-size: 24px;">Create Post</h6>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="d-flex align-items-center mb-3">
                                <img src="img/Nirmal.png" width="60" height="60" class="rounded-circle me-2"
                                    alt="User">
                                <span class="ms-2 fw-semibold" style="font-size: 22px; color: #282828;">Nirmal
                                    G.C.</span>
                            </div>
                            <form id="newPostForm">
                                <div class="mb-3 form-floating">
                                    <select class="form-select abroad-deal-1 fw-semibold" id="newCountrySelect"
                                        aria-label="Country" required>
                                        <option value="" disabled selected>Choose a Country</option>
                                        <option value="usa">USA</option>
                                        <option value="canada">Canada</option>
                                        <option value="uk">UK</option>
                                    </select>
                                    <label for="newCountrySelect">Country</label>
                                </div>

                                <!-- Title Input with Floating Label -->
                                <div class="mb-3 form-floating abroad-deal-1 fw-semibold">
                                    <input type="text" class="form-control abroad-deal-1 fw-semibold"
                                        id="newTitleInput" placeholder="Title" required>
                                    <label for="newTitleInput">Title</label>
                                </div>

                                <div class="mb-3 form-floating abroad-deal-1 fw-semibold">
                                    <textarea class="form-control abroad-deal-1 fw-semibold" id="newDescriptionInput" rows="4"
                                        placeholder="Describe..." required></textarea>
                                    <label for="newDescriptionInput">Description</label>
                                </div>

                                <div class="form-floating abroad-deal-1 fw-semibold mb-3">
                                    <input type="text" class="form-control abroad-deal-1 fw-semibold"
                                        id="newFloatingURL" placeholder="Paste URL Link">
                                    <label for="newFloatingURL">Paste URL Link</label>
                                </div>

                                <div class="mb-3 input-group">
                                    <input type="text" class="form-control abroad-deal-1 fw-semibold border-0"
                                        placeholder="Add to your Post" id="newAddToPostInput">
                                    <button class="btn abroad-deal-1 fw-semibold border-0"
                                        style="border-top-right-radius: 5px; border-bottom-right-radius: 5px;"
                                        type="button" id="newUploadImageButton">
                                        <i class="fas fa-image"></i>
                                    </button>
                                    <!-- File Input (hidden) -->
                                    <input type="file" id="newImageInput" class="d-none" accept="image/*" />
                                </div>
                            </form>

                        </div>
                        <div class="modal-footer d-flex justify-content-center">
                            <button type="button" class="btn btn-search w-25" id="submitPost">Submit</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- "Want to Buy" Section to display the post -->
            <div id="wantToBuyForm" style="display: none;">
                <div class="col-md-9 mt-3">
                    <!-- New posts will be inserted here -->

                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <img src="img/Nirmal.png" class="rounded-circle me-2" alt="User"
                                    style="height:40px;width:40px;">
                                <div>
                                    <h6 class="mb-0">Nirmal G.C.</h6>
                                    <small class="text-muted"><i class="bi bi-geo-alt"></i>${country.toUpperCase()} <i
                                            class="bi bi-clock ms-2"></i> Just now</small>
                                </div>
                                <button class="btn btn-search ms-auto">Message</button>
                            </div>
                            <h5 class="mt-3">${title}</h5>
                            <p class="abroad-p">${description}</p>
                            <div class="mt-3">
                                <a href="${urlLink}" class="text-primary" target="_blank">${urlLink}</a>
                            </div>
                            <hr>
                            <div class="d-flex gap-4 ms-2">
                                <div><i class="bi bi-chat"></i> 0</div>
                                <div><i class="bi bi-share"></i> 0</div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <style>
        /* General Styles */
        .abroad-ad {
            background-image: url('img/ad.png');
            background-size: cover;
            background-position: center;
            height: 200px;
            background-color: transparent;
            margin-top: 50px;
        }

        /* Form Elements */
        .form-control,
        .form-select,
        .btn-search,
        .form-select.abroad-deal {
            height: 40px;
            font-size: 16px;
        }

        .form-control {
            padding: 10px;
        }

        .form-select.abroad-deal {
            border: 1px solid #E3E3E3 !important;
            border-radius: 5px;
            padding: 5px 10px;
            background-color: #fff;
            color: #555555 !important;
            font-size: 20px;
        }

        .form-select.abroad-deal:hover {
            border-color: #007bff;
        }

        .form-select.abroad-deal:focus {
            border-color: #0056b3;
            box-shadow: 0 0 5px rgba(0, 91, 187, 0.5);
        }

        /* Category Button */
        .category-btn {
            width: 111px;
            height: 31px;
            font-size: 14px;
            color: #676767;
            font-weight: 600;
            text-align: center;
            border: 1px solid #000000;
            border-radius: 50px;
        }

        .active-btn,
        .category-btn:hover {
            background-color: #0064A7 !important;
            color: white !important;
            border: 1px solid #0064A7 !important;
        }

        /* Add & Toggle Buttons */
        .btn-add_post,
        .btn-toggle {
            border-color: #0064A7;
            color: white;
            background-color: #0064a7;
            height: 44px;
            width: 148px;
            font-size: 18px;
            font-weight: 500;
        }

        .btn-add_post:hover {
            background-color: #0b5ed7;
        }

        .btn-toggle:not(.active) {
            background-color: white;
            color: #0064a7;
            border: 1px solid #0064a7;
        }

        .btn-toggle:hover,
        .btn-toggle.active {
            background-color: #0064a7;
            color: white;
        }

        /* Search Button */
        .btn-search {
            background-color: #0064A7;
            color: white;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-search:hover {
            background-color: white;
            color: #0064A7;
            border: 1px solid #0064A7;
        }

        .btn-search:focus {
            outline: none;
            box-shadow: 0 0 5px rgba(0, 91, 187, 0.5);
        }

        /* Category & Country Select */
        .abroad-deal-1 {
            background-color: #EEEEEE !important;
            color: #A1A1A1 !important;
            border-radius: 5px;
            font-size: 16px !important;
        }

        #countrySelect {
            background-color: #f8f9fa;
            color: #333;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        /* Modal Styling */
        .modal-header {
            background-color: #f1f1f1;
        }

        /* Image Upload Button */
        #uploadImageButton {
            border: none;
            background: none;
            color: #007bff;
            cursor: pointer;
        }

        #uploadImageButton:hover {
            color: #0056b3;
        }

        /* Responsive Styles */
        @media (max-width: 768px) {

            .form-control,
            .form-select,
            .btn-search {
                height: 36px;
            }
        }
    </style>

    <script>
        // Image Upload and Preview

        document.getElementById('uploadImageButton').addEventListener('click', function() {
            document.getElementById('imageInput').click();
        });

        document.getElementById('imageInput').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    const imagePreviewContainer = document.getElementById('imagePreviewContainer');
                    const imagePreview = document.getElementById('imagePreview');
                    imagePreview.src = event.target.result;
                    imagePreviewContainer.style.display = 'block';
                };
                reader.readAsDataURL(file);
            }
        });

        // Item Submission and Dynamic Addition to Product List

        // document.getElementById('submitItemButton').addEventListener('click', function() {
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

        // document.getElementById("submitPost").addEventListener("click", function () {
        //     const title = document.getElementById("newTitleInput").value;
        //     const description = document.getElementById("newDescriptionInput").value;
        //     const urlLink = document.getElementById("newFloatingURL").value;
        //     const country = document.getElementById("newCountrySelect").value;

        //     if (title && description && country) {
        //         const newPostHtml = `
    //         <div class="card mb-3">
    //             <div class="card-body">
    //                 <div class="d-flex align-items-center">
    //                     <img src="img/Nirmal.png" class="rounded-circle me-2" alt="User" style="height:40px;width:40px;">
    //                     <div>
    //                         <h6 class="mb-0">Nirmal G.C.</h6>
    //                         <small class="text-muted"><i class="bi bi-geo-alt"></i>${country.toUpperCase()} <i class="bi bi-clock ms-2"></i> Just now</small>
    //                     </div>
    //                     <button class="btn btn-search ms-auto">Message</button>
    //                 </div>
    //                 <h5 class="mt-3">${title}</h5>
    //                 <p class="abroad-p">${description}</p>
    //                 <div class="mt-3">
    //                     <a href="${urlLink}" class="text-primary" target="_blank">${urlLink}</a>
    //                 </div>
    //                 <hr>
    //                 <div class="d-flex gap-4 ms-2">
    //                     <div><i class="bi bi-chat"></i> 0</div>
    //                     <div><i class="bi bi-share"></i> 0</div>
    //                 </div>
    //             </div>
    //         </div>
    //         `;

        //         const wantToBuyForm = document.getElementById("wantToBuyForm");
        //         wantToBuyForm.style.display = "block";
        //         const cardContainer = wantToBuyForm.querySelector(".col-md-9");
        //         cardContainer.insertAdjacentHTML("beforeend", newPostHtml);

        //         document.getElementById("newPostForm").reset();
        //         const modal = bootstrap.Modal.getInstance(document.getElementById('addPostModal'));
        //         modal.hide();
        //     } else {
        //         alert("Please fill in all required fields.");
        //     }
        // });

        // Product Category Filtering

        function filterCategory(category, btn) {
            let products = document.querySelectorAll('.product');
            products.forEach(product => {
                product.style.display = (category === 'all' || product.getAttribute('data-category') === category) ?
                    'block' : 'none';
            });

            document.querySelectorAll('.category-btn').forEach(button => button.classList.remove('active-btn'));
            btn.classList.add('active-btn');
        }

        document.addEventListener("DOMContentLoaded", function() {
            const defaultButton = document.querySelector('.category-btn');
            if (defaultButton) {
                filterCategory('all', defaultButton);
            }
        });

        // Toggle Active State Between Forms

        function toggleActive(button) {
            document.querySelectorAll('.btn-toggle').forEach(btn => btn.classList.remove('active'));
            button.classList.add('active');

            const addItemBtn = document.getElementById('addItemBtn');
            const itemForm = document.getElementById('itemForm');
            const wantToBuyForm = document.getElementById('wantToBuyForm');

            if (!addItemBtn || !itemForm || !wantToBuyForm) {
                console.error("One or more elements are missing.");
                return;
            }

            if (button.textContent.trim() === "Want to buy") {
                itemForm.style.display = 'none';
                wantToBuyForm.style.display = 'block';
                addItemBtn.textContent = "+ Add Post";
                addItemBtn.setAttribute('data-bs-target', '#addPostModal');
            } else {
                itemForm.style.display = 'block';
                wantToBuyForm.style.display = 'none';
                addItemBtn.textContent = "+ Add Item";
                addItemBtn.setAttribute('data-bs-target', '#addItemModal');
            }
        }

        document.addEventListener("DOMContentLoaded", function() {
            const defaultButton = document.querySelector('.btn-all-categories');
            if (defaultButton) {
                toggleActive(defaultButton);
            }
        });
    </script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
@endsection
