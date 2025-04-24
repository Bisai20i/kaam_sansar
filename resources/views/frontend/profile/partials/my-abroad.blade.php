@extends('frontend.profile.jobseeker-dashboard')

@section('profileSection')

    <div id="abroadDeals" class="profile-section">
        <div class="card-container-jobs border advertisement ">
            <div class="row g-4 p-3 row-cols-1 row-cols-md-2 row-cols-lg-3" id="profile-abroad-boxes">


                @if (count($aboards) > 0)
                    @foreach ($aboards as $abroad)
                        <div class="col">
                            <div class=" profile-advertisement-box p-2">
                                <img alt="Teddy bear in a room" src="{{ $abroad->productThumbnail }}" />
                                <h4 class="pt-2">{{ $abroad->productTitle }}</h4>
                                <div class="flex">
                                    <h2 class=""> Nrs.{{ $abroad->pricing }}</h2>
                                    <div class="d-flex gap-1">
                                        <button class="edit mb-2 p-1 px-2"
                                            onclick="document.getElementById('edit-abroadDeals').style.display = 'block'; document.getElementById('profile-abroad-boxes').style.display = 'none';">Edit</button>
                                        <button class="delete mb-2 p-1 px-2">Delete</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <p class="p-2 text-center text-secondary"><small>No Post Found.</small></p>
                @endif

            </div>
            <div class="container-box-edit-advertisement p-3" id="edit-abroadDeals" style="display: none;">
                <h2 class="my-2">Edit Abroad Deals</h2>
                <form>
                    <div class="form-group">
                        <label for="category">Category</label>
                        <select class="form-control my-2" id="category">

                            <option value="">Select Category</option>

                            @if ($categories)
                                @foreach ($categories as $category)
                                    <option value="{{ $category->productCategorySlug }}">
                                        {{ $category->productCategoryTitle }}</option>
                                @endforeach
                            @else
                            @endif

                        </select>
                    </div>
                    <div class="form-group">
                        <label for="country">Country</label>
                        <select class="form-control my-2" id="countrySelect">
                            <option>Nepal</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control my-2" id="title" value="Room For Rent in Kathmandu">
                    </div>
                    <div class="form-group">
                        <label for="price">Price</label>
                        <input type="text" class="form-control my-2" id="price" value="Rs 8,000/month">
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control my-2" id="description" rows="4">Culpa odio dolor quam qui ad culpa eos dolorem...</textarea>
                    </div>
                    <div class="form-group">
                        <label for="country">Location</label>
                        <select class="form-control my-2" id="country">
                            <option>Nepal</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="photo">Photo</label>
                        <p class="text-muted my-2">Upload up to 5 photos.</p>
                        <div class="d-flex flex-wrap" id="photo-container">

                            <div class="photo-upload-box" id="add-photo">
                                <i class="fas fa-plus"></i>
                                <input type="file" id="photo-input" class="d-none" accept="image/*">
                            </div>
                        </div>
                    </div>
                    <div class="btn-cancel-save d-flex justify-content-end gap-2">
                        <button type="button" class="btn btn-cancel-advertisement">Cancel</button>
                        <button type="submit" class="btn btn-save-changes-advertisement">Save Changes</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
    </div>


@endsection

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
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
                console.log($('#countrySelect'))
                data.forEach(function(country) {
                    var countryName = country.name.common;
                    var countryCode = country
                        .cca2; // Optional: You can use the country code if needed

                    console.log(countryName)
                    // console.log()
                    $('#countrySelect').append(new Option(countryName, countryName));
                });


            },
            error: function(err) {
                console.error('Error fetching country data:', err);
            }
        });
    </script>

    <script>

      

    </script>
@endpush
