@extends('backend.layouts.main')

@section('title', 'Discussion Forum')
@section('title', 'Discussion Forum')

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
            <div class="row" >
            <div class="row" >
                <div class="col-12 ">
                    <div class="card mb-4" >
                        <div class="card-header d-flex align-items-center justify-content-between gap-2 flex-wrap" >
                            <form class="input-group" style="flex: 1 1 300px;" action="{{ route('forum.index') }}" method="get">
                                <input type="text" class="form-control" id="subTask" name="searchstr" value="{{ request('searchstr') }}"
                                    placeholder="Search by User or Post" style="flex: 1;">
                                
                                <button class="btn btn-primary" type="submit"
                                    style="flex: 0 0 auto;">
                                    <i class="bx bx-search" aria-hidden="true"></i>
                                </button>
                            </form>
                            <div class="d-flex ps-0 ps-md-2 align-items-center gap-2 justify-content-center justify-content-lg-end flex-wrap" style="flex: 1 1 450px;">

                                {{-- <a href="{{ route('giftNcoupon.index') }}"
                                    class="btn btn-outline-primary btn-sm text-white">
                                    <i class="bx bx-refresh" aria-hidden="true"></i> <!-- News icon for blogs -->

                                </a> --}}
                                <a href="{{ route('forum.index')}}"
                                    class="btn btn-{{ $category == null ? 'primary' : 'info' }} btn-sm text-white">
                                    All
                                </a>
                                <a href="{{ route('forum.index', ['category' => 'education']) }}"
                                    class="btn btn-{{ $category == 'education' ? 'primary' : 'info' }} btn-sm text-white">
                                    Education
                                </a>

                                <a href="{{ route('forum.index', ['category' => 'investment']) }}"
                                    class="btn btn-{{ $category == 'investment' ? 'primary' : 'info' }} btn-sm text-white">
                                    Investment
                                </a>

                                <a href="{{ route('forum.index', ['category' => 'office']) }}"
                                    class="btn btn-{{ $category == 'office' ? 'primary' : 'info' }} btn-sm text-white">
                                    Office
                                </a>

                                <a href="{{ route('forum.index', ['category' => 'scammer']) }}"
                                    class="btn btn-{{ $category == 'scammer' ? 'primary' : 'info' }} btn-sm text-white">
                                    Scammer
                                </a>

                                <a href="{{ route('forum.index', ['category' => 'other']) }}"
                                    class="btn btn-{{ $category == 'other' ? 'primary' : 'info' }} btn-sm text-white">
                                    Others
                                </a>

                                
                            </div>

                        </div>
                        <div class="card-body">
                            <div class="table-responsive" style="max-height: 650px; overflow-y: auto;" style="min-height: 30vh;">
                            <div class="table-responsive" style="max-height: 650px; overflow-y: auto;" style="min-height: 30vh;">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>SN</th>
                                            <th>Title</th>
                                            <th>Description</th>
                                            <th>Images</th>
                                            <th>Description</th>
                                            <th>Images</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @if($forums->count() > 0)

                                            @foreach ($forums as $forum)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td class="text-capitalize">{{ $forum->topic }}</td>
                                                    <td>{{ $forum->description }}</td>
                                                    <td class="d-flex row-cols-2 justify-content-center gap-1 flex-wrap">
                                                        @if($forum->images)

                                                        @foreach ($forum->images as $image)
                                                            <img src="{{ asset('storage/'.$image) }}" alt="forum" class="img img-thumbnai img-fluid" style="max-width: 300px;">
                                                        @endforeach

                                                        @else
                                                            No Images

                                                        @endif

                                                    </td>

                                                    <td>
                                                        <div class="dropdown">
                                                            <button type="button" class="btn p-0  dropdown-toggle hide-arrow"
                                                                data-bs-toggle="dropdown">
                                                                <i class="bx bx-dots-vertical-rounded"></i>
                                                            </button>
                                                            <div class="dropdown-menu">
    
                                                                <a class="dropdown-item text-success"
                                                                    href="javascript:void(0);" data-bs-toggle="modal"
                                                                    data-bs-target="#pinUnpinModal"
                                                                    onclick="setPinUnpinRoute({{ $forum->id }})"
                                                                    >
                                                                    <i
                                                                        class="bx bx-check me-1"></i>{{$forum->pinned?"Unpin" :"Pin"}}
                                                                </a>

                                                                <a class="dropdown-item text-danger" href="javascript:void(0);"
                                                                    data-bs-toggle="modal" data-bs-target="#deleteModal"
                                                                    onclick="setDeleteFormAction({{ $forum->id }})">
                                                                    <i
                                                                        class="bx bx-trash me-1"></i> Delete
                                                                </a>
    
                                                                
                                                            </div>
                                                        </div>
                                                    </td>

                                                </tr>

                                            @endforeach

                                        @endif
                                        
                                    </tbody>
                                </table>
                            </div>
                            <div class="pagination m-3 mx-0" style="float: right;">
                                {{ $forums->links() }}
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Delete Forum Post</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this Forum Post?
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

    <div class="modal fade" id="pinUnpinModal" tabindex="-1" aria-labelledby="pinUnpinModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="pinUnpinModalLabel">
                        Change the pinned status of the current post.
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p id="modalMessage"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <a href="#" id="pinModalActionButton" class="btn btn-success">
                            <span id="loader" class="spinner-border spinner-border-sm" role="status"
                                aria-hidden="true" style="display: none;"></span>
                            <span id="buttonText">Okay</span>
                    </a>
                </div>
            </div>
        </div>
    </div>



    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function setDeleteFormAction(id) {
            // Use Laravel's resource route helper to generate the correct URL for deletion
            document.getElementById('deleteForm').action = "{{ route('forum.delete', ':id') }}".replace(':id',
                id);
        }

        function setPinUnpinRoute(id){

            document.getElementById('pinModalActionButton').href = "{{ route('discussion.pinpost', ':id') }}".replace(':id',
                id);
            
        }
    </script>
    {{-- <script>
    {{-- <script>
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
    </script> --}}
    <script>
        // URLs for publish and unpublish routes
        

        // Handle loader visibility during form submission
        document.getElementById('pinModalActionButton').addEventListener('click', function() {
            const loader = document.getElementById('loader');
            const buttonText = document.getElementById('buttonText');

            // Show loader and hide button text
            loader.style.display = 'inline-block';
            buttonText.style.display = 'none';
        });
    </script> --}}

@endsection
