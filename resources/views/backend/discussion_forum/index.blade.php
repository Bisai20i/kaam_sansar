@extends('backend.layouts.main')

@section('title', 'Gift and Coupon')

@section('content')
    <style>
        #industry-results {
            z-index: 1000;
            max-height: 200px;
            overflow-y: auto;
            background-color: #fff;
            display: none;
            max-width: 400px;
            display: flex;
            align-items: center;
            position: relative;
        }

        #industry-results .list-group-item {
            cursor: pointer;
            padding: 10px;
            border-bottom: 1px solid #eee;
        }

        #industry-results .list-group-item:hover {
            background-color: #f8f9fa;
        }

        #industry-wrapper {
            position: relative;
        }

        .remove-selected-industry {

            position: absolute;
            top: 33%;
            right: 3%;
            cursor: pointer;
            color: #dc3545;
            font-size: 20px;
        }

        .remove-selected-industry:hover {
            color: #bd2130;
        }
    </style>
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="content-wrapper">
            <h4 class="fw-bold mb-4"><span class="text-muted fw-light"> </span> Discussion Forum</h4>


            <!-- Main Content -->
            <div class="row">
                <div class="col-12 ">
                    <div class="card mb-4">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h5 class="mb-0 text-capitalize">List of Forum Posts </h5>
                            <div class="d-flex align-items-center gap-2">

                                {{-- <a href="{{ route('giftNcoupon.index') }}"
                                    class="btn btn-outline-primary btn-sm text-white">
                                    <i class="bx bx-refresh" aria-hidden="true"></i> <!-- News icon for blogs -->

                                </a> --}}

                                <a href="{{ route('giftNcoupon.index', ['type' => '0']) }}"
                                    class="btn btn-info btn-sm text-white">
                                    <i class="bx bx-news" aria-hidden="true"></i> <!-- News icon for blogs -->
                                    Education
                                </a>

                                <a href="{{ route('giftNcoupon.index', ['type' => '0']) }}"
                                    class="btn btn-info btn-sm text-white">
                                    <i class="bx bx-news" aria-hidden="true"></i> <!-- News icon for blogs -->
                                    Education
                                </a>
                                
                                <a href="{{ route('giftNcoupon.index', ['type' => '1']) }}"
                                    class="btn btn-warning btn-sm text-white">
                                    <i class="bx bx-microphone" aria-hidden="true"></i>
                                    <!-- Microphone icon for podcasts -->
                                    Scammer
                                </a>

                                
                            </div>

                        </div>
                        <div class="card-body">
                            <div class="table-responsive" style="max-height: 650px; overflow-y: auto;">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>SN</th>
                                            <th>Gift or Coupon</th>
                                            <th>Title</th>
                                            <th>Image</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($giftNcoupons as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td class="text-capitalize">{{ $item->type == '1'?'Coupon':'Gift' }}</td>
                                                <td>{{ $item->title }}</td>

                                                <td>
                                                    @if ($item->thumbnail)
                                                        <img src="{{ asset('storage/' . $item->thumbnail) }}" width="100"
                                                            height="auto" alt="GiftCoupon Image">
                                                    @else
                                                        No image
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="dropdown">
                                                        <button type="button" class="btn p-0  dropdown-toggle hide-arrow"
                                                            data-bs-toggle="dropdown">
                                                            <i class="bx bx-dots-vertical-rounded"></i>
                                                        </button>
                                                        <div class="dropdown-menu">

                                                            <a class="dropdown-item text-{{ $item->publishStatus == '1' ? 'danger' : 'success' }}"
                                                                href="javascript:void(0);" data-bs-toggle="modal"
                                                                data-bs-target="#publishUnpublishModal"
                                                                onclick="setPublishUnpublishFormAction({{ $item->id }}, '{{ $item->publishStatus }}', '{{ $item->itemName }}')">
                                                                <i
                                                                    class="bx bx-{{ $item->publishStatus == '1' ? 'x' : 'check' }} me-1"></i>
                                                                {{ $item->publishStatus == '1' ? 'Unpublish' : 'Publish' }}
                                                            </a>
                                                            
                                                            <a class="dropdown-item text-primary" href="#"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#viewJobCategoryModal{{ $item->id }}">
                                                                <i class="bx bx-show me-1"></i> View
                                                            </a>
                                                            <!-- Edit Trigger -->
                                                            <a class="dropdown-item text-primary"
                                                                href="{{ route('giftNcoupon.edit',  $item->id) }}">
                                                                <i class="bx bx-edit me-1"></i> Edit
                                                            </a>
                                                            <!-- Delete Trigger -->
                                                            <a class="dropdown-item text-danger" href="javascript:void(0);"
                                                                data-bs-toggle="modal" data-bs-target="#deleteModal"
                                                                onclick="setDeleteFormAction({{ $item->id }})">
                                                                <i class="bx bx-trash me-1"></i> Delete
                                                            </a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <div class="modal fade" id="viewJobCategoryModal{{ $item->id }}"
                                                tabindex="-1" aria-labelledby="viewJobCategoryModalLabel"
                                                aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="viewJobCategoryModalLabel">View Gift and Coupon</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">

                                                            <div class="mb-3">
                                                                <label class="form-label">
                                                                    {{ $item->type == '0' ? 'Gift' : 'Coupon' }} Description
                                                                    
                                                                </label>
                                                                <textarea name="" class="form-control" id="companyDescription{{ $item->id }}" cols="30" rows="10">{{ $item->description }}</textarea>
                                                            </div>
                                                            
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-primary"
                                                                data-bs-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="pagination m-3 mx-0" style="float: right;">
                                @if ($type === '0')
                                    {{ $giftNcoupons->appends(['type' => '0'])->links() }}
                                @elseif($type === '1')
                                    {{ $giftNcoupons->appends(['type' => '1'])->links() }}
                                @else
                                    {{ $giftNcoupons->links() }}
                                @endif
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Delete Gift or Coupon</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this Gift or Coupon?
                </div>
                <div class="modal-footer">
                    <!-- Form to handle deletion -->
                    <form id="deleteForm" method="POST" action="" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="publishUnpublishModal" tabindex="-1" aria-labelledby="publishUnpublishModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="publishUnpublishModalLabel">
                        Change Gift and Coupon Category Publish Status to <strong id="modalTitle"></strong> Status
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p id="modalMessage"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <form id="publishUnpublishForm" method="POST">
                        @csrf
                        @method('PUT')
                        <button type="submit" id="modalActionButton" class="btn">
                            <span id="loader" class="spinner-border spinner-border-sm" role="status"
                                aria-hidden="true" style="display: none;"></span>
                            <span id="buttonText">Submit</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function setDeleteFormAction(id) {
            // Use Laravel's resource route helper to generate the correct URL for deletion
            document.getElementById('deleteForm').action = "{{ route('giftNcoupon.destroy', ':id') }}".replace(':id',
                id);
        }
    </script>
    <script>
        $(document).ready(function() {
            @foreach ($giftNcoupons as $item)
                $('#companyDescription{{ $item->id }}').summernote({
                    placeholder: 'Enter Company Description',
                    height: 200,
                    toolbar: [
                        ['style', ['bold', 'italic', 'underline', 'clear']]
                    ]
                });
                // Disable Summernote for the current Jobcategory
                $('#companyDescription{{ $item->id }}').summernote('disable');
            @endforeach
        });
    </script>
    <script>
        // URLs for publish and unpublish routes
        const publishUrl = @json(route('giftNcoupon.publish', ['id' => '__ID__']));
        const unpublishUrl = @json(route('giftNcoupon.unpublish', ['id' => '__ID__']));

        // Function to dynamically update modal content
        function setPublishUnpublishFormAction(giftNcouponId, currentStatus) {
            const modalTitle = document.getElementById('modalTitle');
            const modalMessage = document.getElementById('modalMessage');
            const actionButton = document.getElementById('modalActionButton');
            const buttonText = document.getElementById('buttonText');
            const publishUnpublishForm = document.getElementById('publishUnpublishForm');

            if (currentStatus === '1') {
                // Set content for unpublishing
                modalTitle.textContent = 'Unpublished';
                modalMessage.textContent = 'Are you sure you want to unpublish this blogs or podcast?';
                actionButton.classList.remove('btn-success');
                actionButton.classList.add('btn-warning');
                buttonText.textContent = 'Unpublish';
                publishUnpublishForm.action = unpublishUrl.replace('__ID__', giftNcouponId);
            } else {
                // Set content for publishing
                modalTitle.textContent = 'Published';
                modalMessage.textContent = 'Are you sure you want to publish this blogs or podcast?';
                actionButton.classList.remove('btn-warning');
                actionButton.classList.add('btn-success');
                buttonText.textContent = 'Publish';
                publishUnpublishForm.action = publishUrl.replace('__ID__', giftNcouponId);
            }
        }

        // Handle loader visibility during form submission
        document.getElementById('publishUnpublishForm').addEventListener('submit', function() {
            const loader = document.getElementById('loader');
            const buttonText = document.getElementById('buttonText');

            // Show loader and hide button text
            loader.style.display = 'inline-block';
            buttonText.style.display = 'none';
        });
    </script>

@endsection
