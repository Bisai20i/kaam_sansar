@extends('frontend.giftNcoupon.giftMain')

@section('giftContent')
    <section class="gifts">
        <div class="container mb-5">
            <div class="container mt" style="margin-top: 100px;">
                <div class="row">
                    <!-- Product Image -->
                    <div class="col-sm-12 col-md-3 col-lg-3 border border-1 rounded p-2 fixed-height-gifts">
                        <div class="card-gift-desc-gifts">

                            <img src="{{ $giftNcoupon->thumbnail ? asset('storage/' . $giftNcoupon->thumbnail) : asset('frontend/assets/Images/giftandcoupon.png') }}"
                                class="bdy-packages-img-gifts img-fluid">
                            <div class="card-body d-flex align-items-center justify-content-between">
                                <p class="text-truncate my-2">{{ $giftNcoupon->title }}</p>
                                <form
                                    action="{{ Auth::guard('job_seekers')->check() ? route('addtocart') : route('set.redirect') }}"
                                    class="d-inline" method="post">
                                    @csrf
                                    <input type="hidden" name="couponId" value="{{ $giftNcoupon->id }}">
                                    @if (Auth::guard('job_seekers')->check())
                                        <input type="hidden" name="jobSeekerId"
                                            value="{{ Auth::guard('job_seekers')->user()->id }}">
                                        <button type="submit" style="all: unset; cursor: pointer;">
                                            <i class="bi bi-plus-lg ms-auto gift-cart"></i>
                                        </button>
                                    @else
                                        <input type="hidden" name="redirect_url" value="{{ url()->current() }}">
                                        <button type="submit" style="all: unset; cursor: pointer;">
                                            <i class="bi bi-plus-lg ms-auto gift-cart"></i>
                                        </button>
                                    @endif

                                </form>
                            </div>
                            <div class="price-gift d-flex align-items-center mb-2 justify-content-between">
                                <p class="price-gifts m-0">NRs. {{ $giftNcoupon->price }}</p>

                                @if ($giftNcoupon->discount > 0)
                                    <span class="badge bg-danger-subtle rounded-pill text-danger">Get
                                        {{ $giftNcoupon->discount }}%
                                        OFF</span>
                                @endif
                            </div>
                            <div class="gift-info">
                                {!! $giftNcoupon->quantity > 0
                                    ? '<div class="instock-gift">Instock: ' . $giftNcoupon->quantity . '</div>'
                                    : '<div class="outstock-gift">Out of Stock</div>' !!}
                                <div class="item-code-gift ">Item Code: {{ $giftNcoupon->itemCode }}</div>
                            </div>
                            <div class="sold-by-gift my-2 px-2"> Published by:
                                <a
                                    href="{{ route('gift.seller', ['id' => $giftNcoupon->adminId]) }}"
                                    class="text-underline ps-2 sold-by-link" style="cursor: pointer;">
                                    {{ $giftNcoupon->admin->fullName }}
                                    <i class="bi bi-arrow-right ps-2"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Product Details -->
                    <div class="col-md-9 ps-md-4 mt-3 mt-md-0 border-0 fixed-height-gifts">
                        <h2 class="fw-semibold">{{ $giftNcoupon->title }}</h2>
                        <div class="step-container-gifts gap-4">

                            <button
                                class="btn step-button-gifts {{ session('cmtEnable') ? '' : 'active1-gifts' }}"
                                id="giftDescriptionBtn">
                                <span>Description</span>
                            </button>
                            <button class="btn step-button-gifts {{ session('cmtEnable') ? 'active1-gifts' : '' }}"
                                id="giftCommentBtn">
                                <span>Comment</span>
                            </button>
                        </div>

                        <!-- Description Tab -->
                        <div class="row my-3 px-2 {{ session('cmtEnable') ? 'd-none' : '' }}" id="giftDescription">
                            {!! $giftNcoupon->description !!}
                        </div>

                        <!-- Comment Tab -->
                        <div class="row mt-3 mb-3 {{ session('cmtEnable') ? '' : 'd-none' }}" id="giftComment">
                            <div class="col-12">
                                <!-- Comments Container -->
                                <div id="commentsContainer" class="d-flex flex-column overflow-auto rounded"
                                    style="max-height: auto;">
                                    <!-- Comments List -->
                                    <div id="commentsList" class="d-flex flex-column px-2">
                                        <!-- Comment 1 -->
                                        @if ($giftComments->count() > 0)
                                            @foreach ($giftComments as $cmt)
                                                {{-- {{ $cmt }} --}}
                                                <div
                                                    class="d-flex align-items-center py-1 px-2 bg-white rounded mb-2 comment-box-gifts w-100">
                                                    <img alt="Profile picture of Carrie Bradshaw"
                                                        class="rounded-circle me-3" height="50" width="50"
                                                        src="{{ $cmt->jobSeeker->userThumbnail ? $cmt->jobSeeker->userThumbnail : 'https://storage.googleapis.com/a1aa/image/ThNp8APQMIPaFZUmVLK-cOT1kYH9Ca9IxDVxpTDWa78.jpg' }}" />
                                                    <div class="comment-text-gifts">
                                                        <h6 class="fw-semibold mb-0">
                                                            {{ $cmt->jobSeeker->firstName . ' ' . $cmt->jobSeeker->lastName }}
                                                        </h6>
                                                        <p class="mb-0">{{ $cmt->comment }}</p>
                                                    </div>
                                                    @if (Auth::guard('job_seekers')->check() && Auth::guard('job_seekers')->user()->id === $cmt->jobSeekerId)
                                                        <button class="btn" data-bs-toggle="modal"
                                                            data-bs-target="#deleteModal{{ $cmt->id }}">
                                                            <i class="bi bi-trash text-danger"></i>
                                                        </button>

                                                        <!-- Bootstrap Delete Confirmation Modal -->
                                                        <div class="modal fade" id="deleteModal{{ $cmt->id }}"
                                                            tabindex="-1"
                                                            aria-labelledby="deleteModalLabel{{ $cmt->id }}"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title"
                                                                            id="deleteModalLabel{{ $cmt->id }}">Confirm
                                                                            Delete</h5>
                                                                        <button type="button" class="btn-close"
                                                                            data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        Are you sure you want to delete this comment?
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-bs-dismiss="modal">Cancel</button>
                                                                        <form action="{{ route('giftcomment.delete', ['id'=>$cmt->id]) }}"
                                                                            method="POST">
                                                                            @csrf
                                                                            @method('DELETE')
                                                                            <button type="submit"
                                                                                class="btn btn-danger">Delete</button>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif




                                                </div>
                                            @endforeach
                                        @else
                                                <small class="text-secondary">No comments Yet! <span class="text-success">Be the first one to comment.</span> </small>
                                        @endif



                                    </div>
                                </div>
                            </div>

                            <!-- Comment Input Section -->
                            @if (Auth::guard('job_seekers')->check())
                                <form action="{{ route('giftcomment.add') }}" method="post">
                                    @csrf
                                    <div
                                        class="col-12 d-flex align-items-center bg-white rounded shadow-sm position-sticky bottom-0 w-100 p-2 mt-2">

                                        <img alt="Profile picture of user" class="rounded-circle gifts-chat me-2 img-thumbnail"
                                            src="{{ Auth::guard('job_seekers')->user()->userThumbnail ? asset('storage/'.Auth::guard('job_seekers')->user()->userThumbnail[0]) : 'https://storage.googleapis.com/a1aa/image/3CpUMtugubz8I1SyWiQoLgE520O4UxkZW02TXnQ0WU4.jpg' }}" style="max-width: 60px; height:auto;" />
                                        <input class="form-control w-100 p-2" name="comment" id="commentInput"
                                            placeholder="Write a comment...." type="text"  required/>
                                        <input type="hidden" name="giftId" value="{{ $giftNcoupon->id }}">
                                        <button type="submit" class="btn btn-outline-primary border border-0 w-10 ms-2"
                                            id="sendButton">
                                            <i class="bi bi-send" style="max: max-content;"></i>
                                        </button>

                                    </div>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Similar Products Section -->
            <div class="row mt-4">
                <h3>Similar Products</h3>
                <div class="row g-2 justify-content-center row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4"
                    id="product-list">
                    @if ($similarGifts->count() > 0)
                        @foreach ($similarGifts as $gNc)
                            <div class="col" id="giftCouponItem" data-gNcId="{{ $gNc->id }}" style="cursor: pointer;">

                                <div class="card-bdy-packages-gifts">
                                    @if ($gNc->discount > 0)
                                        <div class="discount-badge">{{ $gNc->discount }}% OFF</div>
                                    @endif

                                    <img src="{{ $gNc->thumbnail ? asset('storage/' . $gNc->thumbnail) : asset('frontend/assets/Images/giftandcoupon.png') }}"
                                        class="bdy-packages-img product-image-gifts" id="product-image-gift"
                                        style="height: 200px;">
                                    <div class="card-body d-flex justify-content-between align-items-center ">
                                        <p class="text-truncate my-2">{{ $gNc->title }}</p>
                                        <form action="{{ route('addtocart') }}" class="d-inline" method="post">
                                            @csrf
                                            <input type="hidden" name="couponId" value="{{ $gNc->id }}">
                                            @if (Auth::guard('job_seekers')->check())
                                                <input type="hidden" name="jobSeekerId"
                                                    value="{{ Auth::guard('job_seekers')->user()->id }}">
                                                <button type="submit" style="all: unset; cursor: pointer;">
                                                    <i class="bi bi-plus-lg ms-auto gift-cart"></i>
                                                </button>
                                            @else
                                                <button disabled type="submit" style="all: unset; cursor: pointer;">
                                                    <i class="bi bi-plus-lg ms-auto gift-cart"></i>
                                                </button>
                                            @endif
                                        </form>

                                    </div>
                                    <div class="price-gift mb-3">
                                        @if ($gNc->discount > 0)
                                            <del>Nrs. {{ $gNc->price }}</del>
                                        @endif

                                        <p class="price">NRs.
                                            {{ number_format((100 - $gNc->discount) * $gNc->price * 0.01, 2) }}</p>
                                    </div>

                                    <div class="gift-info">
                                        {!! $gNc->quantity > 0
                                            ? '<div class="instock-gift">Instock: ' . $gNc->quantity . '</div>'
                                            : '<div class="outstock-gift">Out of Stock</div>' !!}
                                        <div class="item-code-gift ">Item Code: {{ $gNc->itemCode }}</div>
                                    </div>
                                    <div class="sold-by-gift mt-3 mb-1 px-2"> Published By:
                                        <a
                                            href="{{ route('gift.seller', ['id' => $gNc->adminId]) }}"
                                            class="text-underline ps-2 sold-by-link" style="cursor: pointer;">
                                            {{ $gNc->admin->fullName }}
                                            <i class="bi bi-arrow-right ps-2"></i></a>
                                    </div>

                                </div>

                            </div>
                        @endforeach
                    @endif

                </div>
            </div>

        </div>
    </section>
@endsection

@push('scripts')
    <script>
        let giftDescriptionBtn = document.getElementById('giftDescriptionBtn')
        let giftCommentBtn = document.getElementById('giftCommentBtn')

        giftDescriptionBtn.addEventListener('click', () => {
            giftCommentBtn.classList.remove('active1-gifts')
            giftDescriptionBtn.classList.add('active1-gifts')
            document.getElementById('giftComment').classList.add('d-none')
            document.getElementById('giftDescription').classList.remove('d-none')
        })

        giftCommentBtn.addEventListener('click', () => {
            giftDescriptionBtn.classList.remove('active1-gifts')
            giftCommentBtn.classList.add('active1-gifts')
            document.getElementById('giftDescription').classList.add('d-none')
            document.getElementById('giftComment').classList.remove('d-none')
        })
    </script>
@endpush
