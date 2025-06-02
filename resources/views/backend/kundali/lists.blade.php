@extends('backend.layouts.main')

@section('title', '')

@section('content')

    <div class="container py-5">
        <!-- Content -->
        <h4 class="fw-bold mb-4"><span class="text-muted fw-light"></span></h4>

        <!-- Basic Bootstrap Table -->
        <div class="card shadow">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="card-title">kundali Details</h4>
                    </div>
                    <!-- <div>
                            <a href="" class="btn btn-primary btn-sm text-white">Create Kundali</a>
                        </div> -->
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th style="border-right: 1px solid #dee2e6;">S.N</th>
                                <th style="border-right: 1px solid #dee2e6;">PhoneNumber</th>
                                <th style="border-right: 1px solid #dee2e6;">Email</th>
                                <th style="border-right: 1px solid #dee2e6;">PersonName</th>
                                <th style="border-right: 1px solid #dee2e6;"> PersonDateOfBirth</th>
                                <th style="border-right: 1px solid #dee2e6;">PersonPlaceOfBirth</th>
                                <th style="border-right: 1px solid #dee2e6;">PersonTimeOfBirth</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @foreach ($kundali as $post)
                                <tr>
                                    <td style="border-right: 1px solid #dee2e6;">{{ $loop->iteration }}</td>
                                    <td style="border-right: 1px solid #dee2e6;">{{ $post->phoneNumber }}</td>
                                    <td style="border-right: 1px solid #dee2e6;">{{ $post->emailAddress }}</td>
                                    <td style="border-right: 1px solid #dee2e6;">{{ $post->personName }}</td>
                                    <td style="border-right: 1px solid #dee2e6;">{{ $post->personDateOfBirth }}</td>
                                    <td style="border-right: 1px solid #dee2e6;">{{ $post->personPlaceOfBirth }}</td>
                                    <td style="border-right: 1px solid #dee2e6;">{{ $post->personTimeOfBirth }}</td>


                                    <td style="border-right: 1px solid #dee2e6;">
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                data-bs-toggle="dropdown">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu">

                                                <a class="dropdown-item" href="{{ route('astrologer.show', $post->id) }}">
                                                    <i class="bx bx-reply me-1"></i> Reply
                                                </a>
                                                <!-- <a class="dropdown-item" href="{{ route('kundalidetail.edit', $post->id) }}">
                                                        <i class="bx bx-edit-alt me-1"></i> Edit
                                                    </a> -->

                                                <a class="dropdown-item text-danger" href="javascript:void(0);"
                                                    data-bs-toggle="modal" data-bs-target="#deleteModal{{ $post->id }}">
                                                    <i class="bx bx-trash me-1"></i> Delete
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <!-- Delete Modal -->
                                <div class="modal fade" id="deleteModal{{ $post->id }}" tabindex="-1"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Delete Confirmation</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form method="POST" action="{{ route('kundalidetail.destroy', $post->id) }}">
                                                @csrf
                                                @method('DELETE')
                                                <div class="modal-body">
                                                    Are you sure you want to delete this kundali ?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </div>
                                            </form>
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




@endsection
