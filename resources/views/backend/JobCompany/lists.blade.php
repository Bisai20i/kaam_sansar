@extends('backend.layouts.main')

@section('title', 'Dashboard')

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
            <h4 class="fw-bold mb-4"><span class="text-muted fw-light"> </span> Job Company</h4>


            <!-- Main Content -->
            <div class="row">
                <div class="col-12 ">
                    <div class="card mb-4">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h5 class="mb-0">{{ isset($jobCompany) ? 'Edit' : 'Add' }} Job Company</h5>
                            <a href="{{ route('jobCompany.create') }}" class="btn btn-primary btn-sm  text-white"><i
                                    class="bx bx-plus" aria-hidden="true"></i> Add Company</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>SN</th>
                                            <th>Company Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Industry</th>
                                            <th>Image</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($jobCompanies as $Jobcategory)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $Jobcategory->companyName }}</td>
                                                <td>{{ $Jobcategory->email }}</td>
                                                <td>{{ $Jobcategory->phoneNumber }}</td>
                                                <td>{{ $Jobcategory->industryCategory->industryName }}</td>
                                                <td>
                                                    @if ($Jobcategory->companyProfileImg)
                                                        <img src="{{ asset('storage/' . $Jobcategory->companyProfileImg) }}"
                                                            width="100" height="auto" alt="Company Image">
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
                                                            {{-- view  --}}
                                                            <a class="dropdown-item text-primary" href="#"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#viewJobCategoryModal{{ $Jobcategory->id }}">
                                                                <i class="bx bx-show me-1"></i> View
                                                            </a>
                                                            <!-- Edit Trigger -->
                                                            <a class="dropdown-item text-primary"
                                                                href="{{ route('jobCompany.edit', ['jobCompany' => $Jobcategory->id]) }}">
                                                                <i class="bx bx-edit me-1"></i> Edit
                                                            </a>
                                                            <!-- Delete Trigger -->
                                                            <a class="dropdown-item text-danger" href="javascript:void(0);"
                                                                data-bs-toggle="modal" data-bs-target="#deleteModal"
                                                                onclick="setDeleteFormAction({{ $Jobcategory->id }})">
                                                                <i class="bx bx-trash me-1"></i> Delete
                                                            </a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <div class="modal fade" id="viewJobCategoryModal{{ $Jobcategory->id }}"
                                                tabindex="-1" aria-labelledby="viewJobCategoryModalLabel"
                                                aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="viewJobCategoryModalLabel">View Job
                                                                Company</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">

                                                            <div class="mb-3">
                                                                <label class="form-label">Company Description</label>
                                                                <textarea name="" class="form-control" id="companyDescription{{ $Jobcategory->id }}" cols="30"
                                                                    rows="10">{{ $Jobcategory->companyDescription }}</textarea>



                                                            </div>

                                                            <!-- Links Section -->
                                                            <div class="mb-3">
                                                                <label class="form-label">Links</label>
                                                                <ul>
                                                                    @if ($Jobcategory->link1)
                                                                        <li class="mb-1"><a
                                                                                href="{{ $Jobcategory->link1 }}"
                                                                                target="_blank"
                                                                                rel="noopener noreferrer">{{ $Jobcategory->link1 }}</a>
                                                                        </li>
                                                                    @endif
                                                                    @if ($Jobcategory->link2)
                                                                        <li class="mb-1"><a
                                                                                href="{{ $Jobcategory->link2 }}"
                                                                                target="_blank"
                                                                                rel="noopener noreferrer">{{ $Jobcategory->link2 }}</a>
                                                                        </li>
                                                                    @endif
                                                                    @if ($Jobcategory->link3)
                                                                        <li class="mb-1"><a
                                                                                href="{{ $Jobcategory->link3 }}"
                                                                                target="_blank"
                                                                                rel="noopener noreferrer">{{ $Jobcategory->link3 }}</a>
                                                                        </li>
                                                                    @endif
                                                                </ul>
                                                            </div>


                                                            {{-- <div class="mb-3 col-md-6">
                                                                <label for="rating" class="form-label">Rating <span
                                                                        class="text-danger">*</span></label>
                                                                <select id="rating" name="rating" class="form-select  hide-arrow">
                                                                    <option value="" disabled
                                                                        {{ $Jobcategory->reviewStatus == '' ? 'selected' : '' }}>
                                                                        
                                                                    </option>
                                                                    <option value="1"
                                                                        {{ $Jobcategory->reviewStatus == '1' ? 'selected' : '' }}>
                                                                        ⭐</option>
                                                                    <option value="2"
                                                                        {{ $Jobcategory->reviewStatus == '2' ? 'selected' : '' }}>
                                                                        ⭐⭐</option>
                                                                    <option value="3"
                                                                        {{ $Jobcategory->reviewStatus == '3' ? 'selected' : '' }}>
                                                                        ⭐⭐⭐</option>
                                                                    <option value="4"
                                                                        {{ $Jobcategory->reviewStatus == '4' ? 'selected' : '' }}>
                                                                        ⭐⭐⭐⭐</option>
                                                                    <option value="5"
                                                                        {{ $Jobcategory->reviewStatus == '5' ? 'selected' : '' }}>
                                                                        ⭐⭐⭐⭐⭐</option>
                                                                </select>
                                                            </div> --}}
                                                            <div class="mb-3 col-md-6">
                                                                <label for="rating" class="form-label">Rating</label>
                                                                <div id="ratingDisplay">
                                                                    @for ($i = 1; $i <= 5; $i++)
                                                                        <i
                                                                            class="bx bx-star {{ $i <= $Jobcategory->reviewStatus ? 'text-warning' : 'text-muted' }}"></i>
                                                                    @endfor
                                                                    {{-- @for ($i = 1; $i <= 5; $i++)
                                                                        <span class="star {{ $Jobcategory->reviewStatus >= $i ? 'filled' : '' }}">⭐</span>
                                                                    @endfor --}}
                                                                </div>
                                                            </div>
                                                            <style>
                                                                .form-select {
                                                                    border: none;
                                                                    background: none;
                                                                    padding: 0;
                                                                    appearance: none;
                                                                }

                                                                .form-select:focus {
                                                                    box-shadow: none;
                                                                }
                                                            </style>
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
                    <h5 class="modal-title" id="deleteModalLabel">Delete Job Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this job category?
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


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function setDeleteFormAction(id) {
            // Use Laravel's resource route helper to generate the correct URL for deletion
            document.getElementById('deleteForm').action = "{{ route('jobCompany.destroy', ':id') }}".replace(':id', id);
        }
    </script>

    <script>
        $(document).ready(function() {
            @foreach ($jobCompanies as $Jobcategory)
                $('#companyDescription{{ $Jobcategory->id }}').summernote({
                    placeholder: 'Enter Company Description',
                    height: 200,
                    toolbar: [
                        ['style', ['bold', 'italic', 'underline', 'clear']]
                    ]
                });

                // Disable Summernote for the current Jobcategory
                $('#companyDescription{{ $Jobcategory->id }}').summernote('disable');
            @endforeach
        });
    </script>

@endsection
