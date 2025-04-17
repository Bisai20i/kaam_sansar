@extends('frontend.layouts.main')
@section('title')
    Advertisements
@endsection
@section('content')
<section class="ads_title container-fluid border border-2 border-dark-subtle mt-5 p-5">
    <div class="container text-center">
        <h3>Ad banner</h3>
    </div>
</section>

<div class="container">
    <div class="row">
        <h3 class="primary_color_text py-2">Advertisement</h3>
    </div>

    <div class="d-flex justify-content-center justify-content-md-between flex-wrap-reverse row-gap-3 ">
        <div class="btn-group mb-3 gap-lg-4 ads_type" role="group" aria-label="Basic radio toggle button group">
            <input type="radio" class="btn-check" name="propertyOptions" id="all" autocomplete="off" checked>
            <label class="btn btn-outline-custom rounded-2 mx-1 px-4 border border-2" for="all">All</label>

            <input type="radio" class="btn-check" name="propertyOptions" id="buy" autocomplete="off">
            <label class="btn btn-outline-custom rounded-2 mx-1 px-4 border border-2" for="buy">Buy</label>

            <input type="radio" class="btn-check" name="propertyOptions" id="sell" autocomplete="off">
            <label class="btn btn-outline-custom rounded-2 mx-1 px-4 border border-2" for="sell">Sell</label>

            <input type="radio" class="btn-check" name="propertyOptions" id="rent" autocomplete="off">
            <label class="btn btn-outline-custom rounded-2 mx-1 px-4 border border-2" for="rent">Rent</label>
        </div>
        <div>
            <button type="button" class="btn post-ad-btn" data-bs-toggle="modal" data-bs-target="#postAdModal">
                <i class="fas fa-plus me-2"></i>Add Post
            </button>
        </div>
    </div>

    <div>
        <h5>Find what you are looking for</h5>
        <div class="row g-3 mb-3">
            <!-- Search Input -->
            <div class="col-lg">
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0" style="height: 42px;">
                        <i class="fas fa-search text-muted"></i>
                    </span>
                    <input type="text" class="form-control border-start-0 ps-0 py-2" style="height: 42px;"
                        placeholder="What are you looking for..." aria-label="Search">
                </div>
            </div>

            <!-- Country Select -->
            <div class="col-md-6 col-lg-3">
                <select class="form-select py-2" id="countrySelect" aria-label="">
                    <option selected>Select Country</option>
                    <option value="1">Nepal</option>
                    <option value="2">USA</option>
                    <option value="3">Other</option>
                </select>
            </div>

            <!-- City Select -->
            <div class="col-md-6 col-lg-3">
                <select class="form-select py-2" id="citySelect" aria-label="">
                    <option selected>Select City</option>
                    <option value="1">Pokhara</option>
                    <option value="2">Kathmandu</option>
                    <option value="3">Other</option>
                </select>
            </div>

            <!-- Search Button -->
            <div class="col-4 col-lg-1 mx-auto">
                <button class="btn text-white w-100 py-2" type="button" style="background-color: #0064a7;">
                    Search
                </button>
            </div>
        </div>
    </div>

    <div class="nav nav-pills gap-3 justify-content-center justify-content-md-start">
        <a class="nav-link-ads active rounded-5 px-3 " href="#tab1" data-bs-toggle="pill">All</a>
        <a class="nav-link-ads rounded-5" href="#tab2" data-bs-toggle="pill">House</a>
        <a class="nav-link-ads rounded-5" href="#tab3" data-bs-toggle="pill">Apartments</a>
        <a class="nav-link-ads rounded-5" href="#tab4" data-bs-toggle="pill">Land</a>
        <a class="nav-link-ads rounded-5" href="#tab5" data-bs-toggle="pill">Office</a>
    </div>
    <div class="row row-cols-lg-4 row-cols-md-3 row-cols-1 g-4 mt-1">
        <div class="col">
            <div class="card p-0 "><a href="adsdetails.html" class="text-decoration-none text-black">
                    <img src="Images/image.png" class="card-img-top" alt="...">
                    <div class="card-body p-2">
                        <h6 class="card-title mb-0">Room For Rent</h6>
                        <p class="card-text mb-0">Kathmandu</p>
                        <p class="card-text"><small class="text-body-secondary">3 mins ago</small></p>
                    </div>
                </a>
            </div>
        </div>
        <div class="col">
            <div class="card p-0 "><a href="adsdetails.html" class="text-decoration-none text-black">
                    <img src="Images/image.png" class="card-img-top" alt="...">
                    <div class="card-body p-2">
                        <h6 class="card-title mb-0">Room For Rent</h6>
                        <p class="card-text mb-0">Kathmandu</p>
                        <p class="card-text"><small class="text-body-secondary">3 mins ago</small></p>
                    </div>
                </a>
            </div>
        </div>
        <div class="col">
            <div class="card p-0 "><a href="adsdetails.html" class="text-decoration-none text-black">
                    <img src="Images/image.png" class="card-img-top" alt="...">
                    <div class="card-body p-2">
                        <h6 class="card-title mb-0">Room For Rent</h6>
                        <p class="card-text mb-0">Kathmandu</p>
                        <p class="card-text"><small class="text-body-secondary">3 mins ago</small></p>
                    </div>
                </a>
            </div>
        </div>
        <div class="col">
            <div class="card p-0 "><a href="adsdetails.html" class="text-decoration-none text-black">
                    <img src="Images/image.png" class="card-img-top" alt="...">
                    <div class="card-body p-2">
                        <h6 class="card-title mb-0">Room For Rent</h6>
                        <p class="card-text mb-0">Kathmandu</p>
                        <p class="card-text"><small class="text-body-secondary">3 mins ago</small></p>
                    </div>
                </a>
            </div>
        </div>
        <div class="col">
            <div class="card p-0 "><a href="adsdetails.html" class="text-decoration-none text-black">
                    <img src="Images/image.png" class="card-img-top" alt="...">
                    <div class="card-body p-2">
                        <h6 class="card-title mb-0">Room For Rent</h6>
                        <p class="card-text mb-0">Kathmandu</p>
                        <p class="card-text"><small class="text-body-secondary">3 mins ago</small></p>
                    </div>
                </a>
            </div>
        </div>
        <div class="col">
            <div class="card p-0 "><a href="adsdetails.html" class="text-decoration-none text-black">
                    <img src="Images/image.png" class="card-img-top" alt="...">
                    <div class="card-body p-2">
                        <h6 class="card-title mb-0">Room For Rent</h6>
                        <p class="card-text mb-0">Kathmandu</p>
                        <p class="card-text"><small class="text-body-secondary">3 mins ago</small></p>
                    </div>
                </a>
            </div>
        </div>
        <div class="col">
            <div class="card p-0 "><a href="adsdetails.html" class="text-decoration-none text-black">
                    <img src="Images/image.png" class="card-img-top" alt="...">
                    <div class="card-body p-2">
                        <h6 class="card-title mb-0">Room For Rent</h6>
                        <p class="card-text mb-0">Kathmandu</p>
                        <p class="card-text"><small class="text-body-secondary">3 mins ago</small></p>
                    </div>
                </a>
            </div>
        </div>
        <div class="col">
            <div class="card p-0 "><a href="adsdetails.html" class="text-decoration-none text-black">
                    <img src="Images/image.png" class="card-img-top" alt="...">
                    <div class="card-body p-2">
                        <h6 class="card-title mb-0">Room For Rent</h6>
                        <p class="card-text mb-0">Kathmandu</p>
                        <p class="card-text"><small class="text-body-secondary">3 mins ago</small></p>
                    </div>
                </a>
            </div>
        </div>
        <div class="col">
            <div class="card p-0 "><a href="adsdetails.html" class="text-decoration-none text-black">
                    <img src="Images/image.png" class="card-img-top" alt="...">
                    <div class="card-body p-2">
                        <h6 class="card-title mb-0">Room For Rent</h6>
                        <p class="card-text mb-0">Kathmandu</p>
                        <p class="card-text"><small class="text-body-secondary">3 mins ago</small></p>
                    </div>
                </a>
            </div>
        </div>
        <div class="col">
            <div class="card p-0 "><a href="adsdetails.html" class="text-decoration-none text-black">
                    <img src="Images/image.png" class="card-img-top" alt="...">
                    <div class="card-body p-2">
                        <h6 class="card-title mb-0">Room For Rent</h6>
                        <p class="card-text mb-0">Kathmandu</p>
                        <p class="card-text"><small class="text-body-secondary">3 mins ago</small></p>
                    </div>
                </a>
            </div>
        </div>
        <div class="col">
            <div class="card p-0 "><a href="adsdetails.html" class="text-decoration-none text-black">
                    <img src="Images/image.png" class="card-img-top" alt="...">
                    <div class="card-body p-2">
                        <h6 class="card-title mb-0">Room For Rent</h6>
                        <p class="card-text mb-0">Kathmandu</p>
                        <p class="card-text"><small class="text-body-secondary">3 mins ago</small></p>
                    </div>
                </a>
            </div>
        </div>
        <div class="col">
            <div class="card p-0 "><a href="adsdetails.html" class="text-decoration-none text-black">
                    <img src="Images/image.png" class="card-img-top" alt="...">
                    <div class="card-body p-2">
                        <h6 class="card-title mb-0">Room For Rent</h6>
                        <p class="card-text mb-0">Kathmandu</p>
                        <p class="card-text"><small class="text-body-secondary">3 mins ago</small></p>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <div class="row justify-content-center m-3">
        <button class="btn view-more">View More</button>
    </div>

</div>

<!-- Post Ad Modal -->
<div class="modal fade" id="postAdModal" tabindex="-1" aria-labelledby="postAdModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="postAdModalLabel">Create Post</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <!-- Type Dropdown -->
                    <div class="">
                        <select class="form-select bg-dark-subtle text-black-50 py-3" id="type" aria-label="">
                            <option selected>Type</option>
                            <option value="1">Buy</option>
                            <option value="2">Sell</option>
                            <option value="3">Rent</option>
                        </select>
                    </div>
                    <div class="mt-3">
                        <select class="form-select bg-dark-subtle text-black-50 py-3" id="cat" aria-label="">
                            <option selected>Category</option>
                            <option value="1">All</option>
                            <option value="2">House</option>
                            <option value="3">Land</option>
                        </select>
                    </div>

                    <div class="mt-3">
                        <select class="form-select bg-dark-subtle text-black-50 py-3" id="country" aria-label="">
                            <option selected>Country</option>
                            <option value="1">Nepal</option>
                            <option value="2">USA</option>
                            <option value="3">Other</option>
                        </select>
                    </div>
                    <div class="form-floating text-black-50 mt-3">
                        <input type="text" class="form-control bg-dark-subtle text-black-50" id="titleInput"
                            placeholder="Title">
                        <label for="titleInput">Title</label>
                    </div>
                    <!-- Price Input -->
                    <div class="form-floating text-black-50 mb-3">

                        <input type="text" class="form-control bg-dark-subtle text-black-50" id="price"
                            placeholder="Enter price" required>
                        <label for="price">Price</label>

                    </div>
                    <div class="form-floating text-black-50">
                        <textarea class="form-control bg-dark-subtle text-black-50" placeholder="Post Details"
                            id="floatingTextarea" style="height: 100px"></textarea>
                        <label for="floatingTextarea">Describe...</label>
                    </div>
                    <div class="d-flex bg-dark-subtle p-2 gap-3 align-items-center rounded">
                        <p class="flex-grow-1 my-auto text-black-50">Add to your post</p>
                        <div class="d-flex gap-3 align-items-center">
                            <a href="#" class="primary_color_text">
                                <i class="fa-solid fa-location-dot"></i></a>
                            <a href="#" class="primary_color_text">
                                <i class="fa-solid fa-image"></i></a>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center mt-3">
                        <button type="button" class="btn btn-primary mx-auto"
                            style="background-color: #0064a7;">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection

