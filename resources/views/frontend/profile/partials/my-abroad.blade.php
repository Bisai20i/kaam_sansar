@extends('frontend.profile.jobseeker-dashboard')

@section('profileSection')

    <div id="abroadDeals" class="profile-section">
        <div class="card-container-jobs border advertisement ">
            <div class="row g-4 p-3 row-cols-1 row-cols-md-2 row-cols-lg-3" id="profile-aboard-boxes">

                @if (count($aboards) > 0)
                    @foreach ($aboards as $aboard)
                        <div class="col" id="aboard-{{ $aboard->id }}">
                            <div class="profile-advertisement-box p-2">
                                <img alt="Product Photo" src="{{ $aboard->productThumbnail }}" />
                                <h4 class="pt-2">{{ $aboard->productTitle }}</h4>
                                <div class="flex">
                                    <h2 class=""> Nrs.{{ $aboard->pricing }}</h2>
                                    <div class="d-flex gap-1">
                                        <button class="edit mb-2 p-1 px-2" data-productTitle="{{ $aboard->productTitle }}"
                                            data-pricing=" {{ $aboard->pricing }} "
                                            data-description=" {{ $aboard->productDescription }} "
                                            data-category="{{ $aboard->category }}" data-country="{{ $aboard->country }}"
                                            data-url="{{ route('aboards.update', $aboard->id) }}"
                                            data-img="{{ $aboard->productThumbnail }}"
                                            onclick="openUpdateForm(this)">Edit</button>

                                        <!-- Delete Button -->
                                        <form action="{{ route('aboards.destroy', $aboard->id) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="delete mb-2 p-1 px-2"
                                                onclick="return confirm('Are you sure you want to delete this product?')">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <p class="p-2 text-center text-secondary"><small>No Post Found.</small></p>
                @endif

            </div>
            <!-- Edit Form -->
            <div class="container-box-edit-advertisement p-3" id="edit-aboardDeals" style="display: none;">
                <h2 class="my-2">Edit Abroad Deals</h2>
                <form id="editItemForm" action="#" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT') <!-- This will specify that it's an update request -->

                    <!-- Country Select -->
                    @isset($aboard)
                        <div class="mb-3 form-floating">
                            <select class="form-select abroad-deal-1 fw-semibold" id="newCountrySelect" name="country" required>
                                <option value="" disabled {{ $aboard->country ? '' : 'selected' }}>Choose a Country
                                </option>
                                <option value="usa" {{ $aboard->country == 'usa' ? 'selected' : '' }}>USA</option>
                                <option value="canada" {{ $aboard->country == 'canada' ? 'selected' : '' }}>Canada</option>
                                <option value="uk" {{ $aboard->country == 'uk' ? 'selected' : '' }}>UK</option>
                            </select>
                            <label for="newCountrySelect">Country</label>
                        </div>

                        <!-- Category Select -->
                        <div class="mb-3 form-floating">
                            <select class="form-select abroad-deal-1 fw-semibold" id="categorySelect" name="productCategoryId"
                                required>
                                <option value="" disabled selected>Choose a Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ $aboard->productCategoryId == $category->id ? 'selected' : '' }}>
                                        {{ $category->productCategoryTitle }}
                                    </option>
                                @endforeach
                            </select>
                            <label for="categorySelect">Category</label>
                        </div>


                        <!-- Title Input -->
                        <div class="mb-3 form-floating abroad-deal-1 fw-semibold">
                            <input type="text" class="form-control abroad-deal-1 fw-semibold" id="titleInput"
                                name="productTitle" placeholder="Title"
                                value="{{ old('productTitle', $aboard->productTitle) }}" required>
                            <label for="titleInput">Title</label>
                        </div>

                        <!-- Price Input -->
                        <div class="mb-3 form-floating abroad-deal-1 fw-semibold">
                            <input type="text" class="form-control abroad-deal-1 fw-semibold" id="priceInput" name="pricing"
                                placeholder="Enter Price" value="{{ old('pricing', $aboard->pricing) }}" required>
                            <label for="priceInput">Enter Price</label>
                        </div>

                        <!-- Description Textarea -->
                        <div class="mb-3 form-floating abroad-deal-1 fw-semibold">
                            <textarea class="form-control abroad-deal-1 fw-semibold" id="descriptionInput" name="productDescription" rows="4"
                                placeholder="Describe..." required>{{ old('productDescription', $aboard->productDescription) }}</textarea>
                            <label for="descriptionInput">Description</label>
                        </div>

                        <!-- Existing Image Display -->

                        <div class="mb-3 d-none" id="abroadPreviewImage">
                            <label>Current Image:</label>
                            <div>
                                <img src="#" alt="Current Image" class="img-fluid" style="width: 120px; height: 80px;">
                            </div>
                        </div>



                        <!-- Thumbnail Input -->
                        <div class="mb-3 input-group">
                            <input type="text" class="form-control abroad-deal-1 fw-semibold border-0"
                                placeholder="Add to your Post" id="addToPostInput">
                            <button class="btn abroad-deal-1 fw-semibold border-0"
                                style="border-top-right-radius: 5px; border-bottom-right-radius: 5px;" type="button"
                                id="uploadImageButton">
                                <i class="fas fa-image"></i>
                            </button>
                            <input type="file" id="imageInput" name="productThumbnail" class="d-none" accept="image/*" />
                        </div>

                        <!-- Image Preview -->
                        <div id="imagePreviewContainer" class="mb-3" style="display: none;">
                            <img id="imagePreview" class="img-fluid" alt="Selected Image"
                                style="width: 120px; height: 80px;" />
                        </div>
                    @endisset





                    <!-- Submit Button -->
                    <div class="modal-footer d-flex justify-content-between">
                        <button type="button" onclick="goBack()" class="btn btn-search w-25">Back</button>
                        <button type="submit" class="btn btn-search w-25">Save Changes</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

@endsection
@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        let updateForm = document.getElementById('editItemForm')

        const openUpdateForm = (e) => {

            console.log("updating content")

            updateForm.querySelector('[name="country"]').value = e.getAttribute('data-country')
            updateForm.querySelector('[name="productTitle"]').value = e.getAttribute('data-productTitle')
            updateForm.querySelector('[name="pricing"]').value = e.getAttribute('data-pricing')
            updateForm.querySelector('[name="productDescription"]').innerHTML = e.getAttribute(
                'data-productDescription')
            // updateForm.querySelector('[name="productDescription"]').value = e.getAttribute('data-productDescription')
            if (e.getAttribute('data-img')) {
                document.getElementById('imagePreviewContainer').style.display = 'block'
                document.getElementById('imagePreview').src = e.getAttribute('data-img')
            }

            updateForm.action = e.getAttribute('data-url')

            $('#edit-aboardDeals').show();
            $('#profile-aboard-boxes').hide();

        }
    </script>
    <script>
        // Get CSRF token from the page's meta tag
        var csrfToken = $('meta[name="csrf-token"]').attr('content');

        // Declare aboardId as a global variable to be used in the submit function
        var aboardId = null;

        // Attach event listeners to the edit buttons
        $(document).on('click', '.edit', function() {
            aboardId = $(this).data('id'); // Store the aboardId in the global variable
            editAboardDeal(aboardId);
        });

        // Fetch data for the edit form
        // function editAboardDeal(id) {
        //     // Fetch abroad deals if needed before displaying the edit form
        //     $.ajax({
        //         url: '/jobseeker/getAbroadDeals', // This will fetch the abroad deals
        //         method: 'GET',
        //         data: {
        //             request_type: 'mobile'
        //         },
        //         success: function(data) {
        //             // Here you can handle the abroad deals if necessary
        //             if (data.status) {
        //                 // You can access abroad deals here, if needed for further logic
        //                 console.log(data);
        //             }
        //         },
        //         error: function(err) {
        //             console.error('Error fetching abroad deals:', err);
        //         }
        //     });

        //     // Fetch the edit details for the specific abroad deal
        //     $.ajax({
        //         url: `/aboards/${id}/edit`, // Ensure this is your correct edit route
        //         method: 'GET',
        //         data: {
        //             request_type: 'mobile'
        //         },
        //         success: function(data) {
        //             if (data.status) {
        //                 const aboard = data.data.aboard;
        //                 const categories = data.data.categories;

        //                 // Populate the form fields with existing data
        //                 $('#category').val(aboard.productCategoryId);
        //                 $('#title').val(aboard.productTitle);
        //                 $('#price').val(aboard.pricing);
        //                 $('#description').html(`${aboard.productDescription}`);
        //                 $('#location').val(aboard.location);
        //                 $('#country').val(aboard.country);
        //                 $('#contactNumber').val(aboard.contactNumber);

        //                 // Populate categories in the select dropdown
        //                 $('#categorySelect').empty();
        //                 categories.forEach(function(category) {
        //                     $('#categorySelect').append(new Option(category.name, category.id));
        //                 });

        //                 // Display the product thumbnail if available
        //                 if (aboard.productThumbnail) {
        //                     $('#photo-container').html(`<img src="${aboard.productThumbnail}" alt="Product Photo" class="img-thumbnail" />`);
        //                 }

        //                 // Show the edit form and hide the profile view

        //             }
        //         },
        //         error: function(err) {
        //             console.error('Error fetching abroad deal data:', err);
        //         }
        //     });
        // }

        // Cancel button functionality

        const goBack = () => {
            console.log("Hello")
            // Hide the edit form and show the profile view again
            $('#edit-aboardDeals').hide();
            $('#profile-aboard-boxes').show();
        }
        // $('#cancel-button').click(function() {

        //     console.log("Hello")
        //     // Hide the edit form and show the profile view again
        //     $('#edit-aboardDeals').hide();
        //     $('#profile-aboard-boxes').show();
        // });

        // Submit the form and update the database as well as the UI
        // $('#edit-form').on('submit', function(e) {
        //     e.preventDefault(); // Prevent default form submission

        //     var formData = new FormData(this); // Form data including file

        //     $.ajax({
        //         url: `/aboards/${aboardId}`, // Use the global aboardId here
        //         method: 'PUT', // Use PUT for updating data
        //         data: formData,
        //         headers: {
        //             'X-CSRF-TOKEN': csrfToken // Add CSRF token to the request headers
        //         },
        //         processData: false,
        //         contentType: false,
        //         success: function(response) {
        //             if (response.status) {
        //                 // Update the UI with the new data
        //                 var aboard = response.data.aboard;
        //                 $('#aboard-' + aboard.id + ' .profile-advertisement-box img').attr('src', aboard.productThumbnail);
        //                 $('#aboard-' + aboard.id + ' h4').text(aboard.productTitle);
        //                 $('#aboard-' + aboard.id + ' .flex h2').text('Nrs.' + aboard.pricing);

        //                 // Hide the edit form and show the profile view again
        //                 $('#edit-aboardDeals').hide();
        //                 $('#profile-aboard-boxes').show();
        //             }
        //         },
        //         error: function(err) {
        //             console.error('Error updating abroad deal:', err);
        //         }
        //     });
        // });
    </script>
@endpush
