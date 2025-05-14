@extends('backend.layouts.main')

@section('title', 'Passport Renewals')

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
            <h4 class="fw-bold mb-4"><span class="text-muted fw-light"> </span> Passport Renewals Request</h4>


            <!-- Main Content -->
            <div class="row">
                <div class="col-12 ">
                    <div class="card mb-4">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h5 class="mb-0">Passport Renewals</h5>
                            <a href="{{ route('passportCountryList.index') }}" class="btn btn-primary btn-sm  text-white"><i
                                class="bx bx-plus" aria-hidden="true"></i>Manage Renewal Country</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>SN</th>
                                            <th>Full Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if($passportRenewals->isEmpty())
                                            <tr>
                                                <td colspan="6" class="text-center">No Data Found</td>
                                            </tr>

                                        @endif
                                        @foreach ($passportRenewals as $renewal)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $renewal->first_name. ' '.$renewal->last_name }}</td>
                                                <td>{{ $renewal->email }}</td>
                                                <td>{{ $renewal->phone}}</td>
                                                <td> <span class="badge bg-{{ $renewal->status == 'pending' ? 'warning' :  ($renewal->status == 'rejected' ? 'danger' : 'success') }}">{{ ucfirst($renewal->status) }}</span></td>
                                                
                                                <td>
                                                    <div class="dropdown">
                                                        <button type="button" class="btn p-0  dropdown-toggle hide-arrow"
                                                            data-bs-toggle="dropdown">
                                                            <i class="bx bx-dots-vertical-rounded"></i>
                                                        </button>
                                                        <div class="dropdown-menu">
                                                            {{-- view  --}}
                                                            <a class="dropdown-item text-primary" href="{{ route('passport.renewal.show', $renewal->id) }}">
                                                                <i class="bx bx-show me-1"></i> View
                                                            </a>
                                                            <a class="dropdown-item text-danger" href="javascript:void(0);"
                                                                data-bs-toggle="modal" data-bs-target="#deleteModal"
                                                                onclick="setDeleteFormAction({{ $renewal->id }})">
                                                                <i class="bx bx-trash me-1"></i> Delete
                                                            </a>
                                                            
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
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
                    <h5 class="modal-title" id="deleteModalLabel">Delete Passport Renewal</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this Passport Renewal?
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
            document.getElementById('deleteForm').action = "{{ route('passport.renewal.destroy', ':id') }}".replace(':id', id);
        }
    </script>

    {{-- <script>
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
    </script> --}}

@endsection
