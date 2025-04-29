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
@php
    $type = isset($type) ? $type : '';
@endphp

    <div class="d-flex justify-content-center justify-content-md-between flex-wrap-reverse row-gap-3 ">
        <div class="btn-group mb-3 gap-lg-1 ads_type" role="group" aria-label="Basic radio toggle button group">
        <a href="{{ route('ads.index')}}"
           class="btn btn-outline-custom rounded-2 mx-1 px-4 border border-2">
            All
        </a>

        <a href="{{ route('Ads.showByTypeCategory', ['type' => 'Buy']) }}"
   class="btn btn-outline-custom {{ $type == 'Buy' ? 'active' : '' }} rounded-2 mx-1 px-4 border border-2">
            Buy
        </a>

        <a href="{{ route('Ads.showByTypeCategory', ['type' => 'Sell']) }}"
   class="btn btn-outline-custom {{ $type == 'Sell' ? 'active' : '' }} rounded-2 mx-1 px-4 border border-2">
            Sell
        </a>

        <a href="{{ route('Ads.showByTypeCategory', ['type' => 'Rent']) }}"
   class="btn btn-outline-custom {{ $type == 'Rent' ? 'active' : '' }} rounded-2 mx-1 px-4 border border-2">
            Rent
        </a>
        </div>
        <div>
            <button type="button" class="btn post-ad-btn text-white py-2 px-4 fs-5" style="background-color: #0064a7;" data-bs-toggle="modal"  data-bs-target="#postAdModal">
                <i class="fas fa-plus me-2" ></i>Add Post
            </button>
        </div>
    </div>
    <!-- <script>
    document.getElementById('postAdModal').addEventListener('click', function() {
        @if (Auth::check())
            // User is logged in: open Add Item Modal
            var addItemModal = new bootstrap.Modal(document.getElementById('#postAdModal'));
            postAdModal.show();
        @else
            //  User not logged in: open Login Modal
            var loginModal = new bootstrap.Modal(document.getElementById('loginModal'));
            loginModal.show();
        @endif
    });
</script> -->

    <div>
        <h5>Find what you are looking for ?</h5>
        <div class="row g-3 mb-3">
        <form action="{{ route('ads.search') }}" method="POST" class="row mt-4 align-items-center">
            @csrf
            <!-- Search Input -->
            <div class="col-lg">
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0" style="height: 42px;">
                        <i class="fas fa-search text-muted"></i>
                    </span>
                    <input type="text" class="form-control border-start-0 ps-0 py-2" style="height: 42px;"
                       name="adsTitle"  placeholder="What are you looking for..." aria-label="Search">
                </div>
            </div>

            <!-- Country Select -->
            <div class="col-md-6 col-lg-3">
                <select class="form-select py-2 bg-white text-secondary" id="countrySelect" name="country" aria-label="">
                    <option selected>Select Country</option>
                    @foreach($ads as $a)
                    <option value="{{$a->country}}">{{$a->country}}</option>
                    @endforeach

                </select>
            </div>

            <!-- City Select -->
            <div class="col-md-6 col-lg-3">
                <select  class="form-select py-2 bg-white text-secondary" id="citySelect" name="location" aria-label="">
                    <option selected>Select City</option>
                    @foreach($ads as $a)

                    <option value="{{$a->location}}">{{$a->location}}</option>
                    @endforeach
                </select>
            </div>

            <!-- Search Button -->
            <div class="col-4 col-lg-1 mx-auto">
                <button class="btn text-white w-100 py-2" type="submit" style="background-color: #0064a7;">
                    Search
                </button>
            </div>
</form>
        </div>
    </div>
    <div class="nav nav-pills gap-3 justify-content-center justify-content-md-start">
    {{-- Show All --}}
<a class="nav-link-ads active rounded-pill px-3 d-flex align-items-center" 
   href="{{ route('ads.index') }}"
   >All</a>

   @foreach($categories as $categoryItem)
    @if($type)
        <a href="{{ route('Ads.showByTypeCategory', ['type' => $type, 'categoryId' => $categoryItem->id]) }}"
           class="btn btn-outline-custom {{ isset($selectedCategory) && $selectedCategory->id == $categoryItem->id ? 'active' : '' }} rounded-pill mx-1 px-4 border border-2">
            {{ $categoryItem->adsCategoryTitle }}
        </a>
    @else
        <a href="{{ route('Ads.showByCategory', ['categoryId' => $categoryItem->id]) }}"
           class="btn btn-outline-custom rounded-pill mx-1 px-4 border border-2">
            {{ $categoryItem->adsCategoryTitle }}
        </a>
    @endif
@endforeach



</div>

        
    <div class="row row-cols-lg-4 row-cols-md-3 row-cols-1 g-4 mt-1 ">
        @foreach($ads as $ads)
        <div class="col">
            <div class="card p-0 "><a href="{{route('ads.show',$ads->id)}}" class="text-decoration-none text-black">
            <img src="{{asset($ads->adsThumbnail)}}" class="card-img-top" alt="Ad Image"
     style="height: 200px; width: 100%; object-fit:cover; border-radius: 8px;">
                    <div class="card-body p-2">
                        <h6 class="card-title mb-0">{{$ads->adsTitle}}</h6>
                        <p class="card-text mb-0">{{$ads->location}}</p>
                        <p class="card-text"><small class="text-body-secondary">{{$ads->postedDuration}}</small></p>
                    </div>
                </a>
            </div>
        </div>
        @endforeach
    
    </div>

    <div class="row justify-content-center m-3">
        <button class="btn view-more">View More</button>
    </div>
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
            <form id="addItemForm" action="{{route('ads.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
            <!-- Type Dropdown -->
                    <div class="">
                        <select class="form-select bg-dark-subtle text-black-50 py-3" id="type" name="type" aria-label="">
                            <option selected>Type</option>
                            
                            <option value="Buy">Buy</option>
                            <option value="Sell">Sell</option>
                            <option value="Rent">Rent</option>
                        </select>
                    </div>
                    <div class="mt-3">
                        <select class="form-select bg-dark-subtle text-black-50 py-3" id="cat" name="adsCategoryId" aria-label="">
                            
                            <option selected> Select Category</option>
                            @foreach($all as $al)
                            <option value="{{$al->id}}">{{$al->adsCategoryTitle}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-floating text-black-50 mt-3">
                        <input type="text" class="form-control bg-dark-subtle text-black-50" name="country" id="countryInput"
                            placeholder="Country">
                        <label for="countryInput">Country</label>
                    </div>
                    <div class="form-floating text-black-50 mt-3">
                        <input type="text" class="form-control bg-dark-subtle text-black-50" name="location" id="cityInput"
                            placeholder="City">
                        <label for="cityInput">City</label>
                    </div>

                    
                    <div class="form-floating text-black-50 mt-3">
                        <input type="text" class="form-control bg-dark-subtle text-black-50"  name ="adsTitle" id="titleInput"
                            placeholder="Title">
                        <label for="titleInput">Title</label>
                    </div>
                    <!-- Price Input -->
                    <div class="form-floating text-black-50 mb-3">

                        <input type="text" class="form-control bg-dark-subtle text-black-50" id="price"
                             name ="pricing"placeholder="Enter price" required>
                        <label for="price">Price</label>

                    </div>
                    <div class="form-floating text-black-50 mb-3">

                        <input type="tel" class="form-control bg-dark-subtle text-black-50" id="contact"
                             name ="contactNumber"placeholder="Enter Contact Number" required>
                        <label for="contact">Contact No</label>

                    </div>
                    <div class="form-floating text-black-50">
                        <textarea class="form-control bg-dark-subtle text-black-50" name="adsDescription" placeholder="Post Details"
                            id="floatingTextarea" style="height: 100px"></textarea>
                        <label for="floatingTextarea">Describe...</label>
                    </div>
                    <div class="d-flex flex-column bg-dark-subtle p-2 gap-2 rounded" style="max-width: 100%;">
  <!-- Top row -->
  <div class="d-flex align-items-center gap-3">
    <p class="flex-grow-1 my-auto text-black-5 mb-0" style="font-size: 0.9rem;">Add to your post</p>

    <!-- Image upload trigger -->
    <div class="d-flex align-items-center gap-2">
      <label for="fileInput" class="primary_color_text m-0" style="cursor: pointer;">
        <i class="fa-solid fa-image fa-lg"></i>
      </label>
      <input type="file" id="fileInput" name="adsThumbnail" accept="image/*" class="d-none">
    </div>
  </div>

  <!-- Image Preview (small) -->
  <div id="imagePreview" class="d-flex mt-1" style="height: 60px;"></div>
</div>

<script>
  const fileInput = document.getElementById('fileInput');
  const imagePreview = document.getElementById('imagePreview');

  fileInput.addEventListener('change', (event) => {
    const file = event.target.files[0];
    if (file && file.type.startsWith('image/')) {
      const reader = new FileReader();
      reader.onload = function(e) {
        imagePreview.innerHTML = `
          <img src="${e.target.result}" alt="Preview" style="height: 100%; width:30%; border-radius: 6px; object-fit: cover;">
        `;
      };
      reader.readAsDataURL(file);
    } else {
      imagePreview.innerHTML = '';
    }
  });
</script>

                    </div>
                    <div class="d-flex justify-content-center mt-3">
                        <button type="submit" class="btn btn-primary "
                            style="background-color: #0064a7;">Submit</button>
                    </div>
                </form>
                <script>
  const postAdModal = document.getElementById('postAdModal');
  postAdModal.addEventListener('hidden.bs.modal', () => {
    if (document.activeElement) {
      document.activeElement.blur();
    }
  });
</script>

            </div>
        </div>
    </div>
</div>


@endsection

