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

                    <button id="wantToItem" class="btn-toggle type-btn rounded fs-6 active-btn">
                        Item</button>
                    <button onclick="window.location.href='{{ route('aboard.buy') }}'"
                        class="btn-toggle type-btn rounded fs-6 text-decoration-none">
                        Want to buy</button>



                </div>


                <!-- Right Side Add Item / Add Post Button -->
                @if (Auth::guard('job_seekers')->check())
                    <!-- If user is logged in, show the Post Ad button -->

                    <button class="btn  bg-primary text-white" id="addItemBtn" data-bs-toggle="modal"
                        data-bs-target="#addItemModal">
                        + Add Item
                    </button>
                @else
                    <button class="btn  bg-primary text-white" data-bs-toggle="modal" id="addItemBtn"
                        onclick="setRedirectUrl()" data-bs-target="#loginModal">
                        + Add Item
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
            <form action="{{ route('aboard.search') }}" method="get">
                <h6>Find what you're looking for ?</h6>
                <div class="container p-0">
                    <div class="row g-2 mt-2 mb-1 align-items-center">
                        <div class="col-md-5 d-flex align-items-center">
                            <div class="input-group ">
                                <span class="input-group-text bg-white border-end-0">
                                    <i class="fas fa-search text-muted"></i>
                                </span>

                                <input type="hidden" id="selectedTypeInput" name="type" value="{{ $type }}">
                                <input type="text" name="productTitle" class="form-control border-start-0 py-2"
                                    placeholder="What are you looking for?" value="{{ request('productTitle') }}">
                            </div>
                        </div>
                        <div class="col-md-3 d-flex align-items-center">
                            <select class="form-select py-2 bg-white border" id="countrySelect" name="country"
                                aria-label="">
                                <option selected disabled>Select Country</option>
                                @foreach ($uniqueAboards as $u)
                                    <option value="{{ $u->country }}"
                                        {{ $u->country == request('country') ? 'selected' : '' }}>{{ $u->country }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3 d-flex align-items-center">
                            <select class="form-select py-2 bg-white" id="locationSelect" name="location" aria-label="">
                                <option selected disabled>Select City</option>
                                @foreach ($uniqueCity as $c)
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

        <!-- Item Form Section -->
        <div id="itemForm">
            <div class="container mb-5">
                <section class="uploads">
                    <!-- Category Filter Section -->



                    <!-- Product Listing Section -->
                    <div class="row g-2 mt-0" id="product-list">
                        <div class="row">
                            <div id="categoryFilter" style="display: block;">
                                <!-- Your buttons here -->

                                <div class="d-flex gap-2 py-3">
                                    <a href="{{ route('aboarddeals') }}"
                                        class="btn btn-outline-secondary btn-sm rounded-pill category-btn active-btn"
                                        onclick="filterCategory('all', this)">All Categories </a>
                                    @foreach ($categories as $category)
                                        <button class="btn btn-outline-secondary btn-sm rounded-pill category-btn"
                                            onclick="filterCategory('{{ $category->id }}', this)">
                                            {{ $category->productCategoryTitle }}
                                        </button>
                                    @endforeach
                                </div>
                            </div>



                        </div>

                        @if ($ads->count() == 0)
                            @include('frontend.notFound')
                        @endif

                        @foreach ($ads->where('type', 'Item') as $ad)
                            <div class="col-lg-3 col-md-6 col-sm-12 col-12 product"
                                data-category="{{ $ad->productCategoryId }}" data-type="{{ $ad->type }}">
                                <div class="card p-2">
                                    <a class="card-bdy" style="width: 100%; object-fit: auto; text-decoration:none;"
                                        href="{{ route('aboards.show', $ad->id) }}" style="cursor: pointer;">
                                        <img src="{{ $ad->productThumbnail ? asset($ad->productThumbnail) : asset('frontend/assets/Images/teddy-bear.jpg') }}"
                                            class="bdy-packages-img" alt="Product Image"
                                            style="width: 100%; height: 180px; object-fit: auto;">
                                        <div class="card-body p-2">
                                            <p class="my-0 text-secondary fw-semibold text-truncate">
                                                {{ $ad->productTitle }}</p>
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
                        <form id="addItemForm" action="{{ route('aboards.store') }}" method="POST"
                            enctype="multipart/form-data">
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
                            <input type="hidden" name ="type" value="Item">

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
                            <div class="d-flex flex-column abroad-deal-1 p-2 gap-2 rounded" style="max-width: 100%;">
                                <div class="mb-1">
                                    <label for="fileInput" class="mb-2">Upload Image (Max 2MB)</label>
                                    <input class="form-control py-2" type="file" accept="image/*" accept="image/*"
                                        id="fileInput" name="productThumbnail" onchange="validateFileSize(this)">


                                </div>

                                <div id="imagePreview" class="d-flex mt-1"></div>
                            </div>

                            <div class="modal-footer d-flex justify-content-center">
                                <button type="submit" class="btn btn-search w-25">Submit</button>
                            </div>
                    </div>


                    </form>
                </div>
            </div>
        </div>

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
                            $('#newCountrySelect').append(new Option(countryName, countryName));
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

            }
        </script>

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


    </section>

@endsection
