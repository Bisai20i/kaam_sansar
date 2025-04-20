@extends('frontend.aboarddeals.aboard')
@section('content')
<section>
    <!-- Profile Header -->
    <div class="profile-header">
        <div class="container">
            <h5 style="font-size: 30px; font-weight: 600;">Abroad Deals</h5>
            <p>Expand Your Horizons with Abroad Deals!<br>
                Discover seamless opportunities for buying and selling goods internationally. Whether you’re looking
                to source unique products from across the globe or sell your offerings to a worldwide audience,
                we've got you covered!</p>
        </div>
    </div>

    <div class="container">
        <!-- Filter Buttons -->
        <form action="{{ route('aboard.search') }}" method="GET" class="mb-3 d-flex justify-content-between align-items-center">
            <div class="d-flex gap-2">
                <input type="hidden" name="productTitle" value="{{ request('productTitle') }}">
                <input type="hidden" name="country" value="{{ request('country') }}">
                <input type="hidden" name="location" value="{{ request('location') }}">
                <input type="hidden" name="productCategoryId" value="{{ request('productCategoryId') }}">

                <button type="submit" name="type" value="Item"
                    class="btn btn-toggle type-btn {{ request('type', 'Item') === 'Item' ? 'active-btn' : '' }}">
                    Want to Item
                </button>
                <button type="submit" name="type" value="Buy"
                    class="btn btn-toggle type-btn {{ request('type') === 'Buy' ? 'active-btn' : '' }}">
                    Want to Buy
                </button>
            </div>

            <button class="btn btn-add_post" type="button" data-bs-toggle="modal" data-bs-target="#addItemModal">
                + Add Item
            </button>
        </form>

        <!-- Search Form -->
        <form action="{{ route('aboard.search') }}" method="GET">
            <input type="hidden" name="type" value="{{ request('type', 'Item') }}">
            <div class="container">
                <h6>Find what you're looking for</h6>
                <div class="row g-2 mt-2 mb-1 align-items-center">
                    <div class="col-md-5 d-flex align-items-center">
                        <div class="input-group w-100">
                            <span class="input-group-text">
                                <i class="bi bi-search"></i>
                            </span>
                            <input type="text" name="productTitle" class="form-control"
                                placeholder="What are you looking for?" value="{{ request('productTitle') }}">
                        </div>
                    </div>
                    <div class="col-md-3 d-flex align-items-center">
                        <select class="form-select abroad-deal" name="country">
                            <option disabled {{ request('country') ? '' : 'selected' }}>Select Country</option>
                            <option value="Nepal" {{ request('country') == 'Nepal' ? 'selected' : '' }}>USA</option>
                            <option value="India" {{ request('country') == 'India' ? 'selected' : '' }}>India</option>
                            <option value="UK" {{ request('country') == 'UK' ? 'selected' : '' }}>UK</option>
                        </select>
                    </div>
                    <div class="col-md-3 d-flex align-items-center">
                        <select class="form-select abroad-deal" name="location">
                            <option disabled {{ request('location') ? '' : 'selected' }}>Select City</option>
                            <option value="New York" {{ request('location') == 'New York' ? 'selected' : '' }}>New York</option>
                            <option value="Mumbai" {{ request('location') == 'Mumbai' ? 'selected' : '' }}>Mumbai</option>
                            <option value="London" {{ request('location') == 'London' ? 'selected' : '' }}>London</option>
                        </select>
                    </div>
                    <div class="col-md-1 d-grid">
                        <button class="btn btn-search w-100" type="submit">Search</button>
                    </div>
                </div>
            </div>
        </form>

        <!-- Optional Category Filter -->
        @if (request('type') === 'Item')
            <form action="{{ route('aboard.search') }}" method="GET" class="my-3">
                <input type="hidden" name="type" value="Buy">
                <input type="hidden" name="productTitle" value="{{ request('productTitle') }}">
                <input type="hidden" name="country" value="{{ request('country') }}">
                <input type="hidden" name="location" value="{{ request('location') }}">

                <div class="d-flex flex-wrap gap-2">
                    <button type="submit" name="productCategoryId" value=""
                        class="btn btn-sm {{ request('productCategoryId') == null ? 'btn-primary' : 'btn-outline-secondary' }}">
                        All Categories
                    </button>
                    @foreach($categories as $category)
                        <button type="submit" name="productCategoryId" value="{{ $category->id }}"
                            class="btn btn-sm {{ request('productCategoryId') == $category->id ? 'btn-primary' : 'btn-outline-secondary' }}">
                            {{ $category->productCategoryTitle }}
                        </button>
                    @endforeach
                </div>
            </form>
        @endif

        <!-- Product List -->
        <div class="row g-2 mt-0" id="product-list">
            @forelse($ads as $ad)
                <div class="col-lg-3 col-md-6 col-sm-12 product">
                    <div class="card">
                        <div class="card-bdy-packages" onclick="window.location.href='{{ route('aboards.show', $ad->id) }}'"
                            style="cursor: pointer;">
                            <img src="{{ $ad->productThumbnail ? asset($ad->productThumbnail) : asset('Images/default-image.png') }}"
                                class="bdy-packages-img"
                                alt="Product Image"
                                style="width: 100%; height: 180px; object-fit: cover;">
                            <div class="card-body">
                                <p class="mt-3 mb-0">{{ $ad->productTitle }}</p>
                                <p class="price">NRs. {{ $ad->pricing }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center">
                    <p>No products found matching your criteria.</p>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="mt-4 d-flex justify-content-center">
            {{ $ads->appends(request()->query())->links() }}
        </div>
    </div>
</section>
@endsection
