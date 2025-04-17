@extends('backend.layouts.main')

@section('title', 'Dashboard')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="content-wrapper">
            <h4 class="fw-bold mb-4"><span class="text-muted fw-light"> </span> Advertisement Category</h4>

            <div class="row">
                <!-- Form to Add/Edit Advertisement Category -->
                <div class="col-6">
                    <div class="card mb-4">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h5 class="mb-0">
                                {{ isset($editCategory) ? 'Edit' : 'Add' }} Advertisement Category
                            </h5>
                        </div>
                        <div class="card-body">
                            <form method="POST"
                                  action="{{ isset($editCategory) ? route('advertisementcategory.update', $editCategory->id) : route('advertisementcategory.store') }}"
                                  id="adsForm">
                                @csrf
                                @if(isset($editCategory))
                                    @method('PUT')
                                    <input type="hidden" name="id" value="{{ $editCategory->id }}">
                                @endif

                                <div class="mb-3">
                                    <label for="ads_name" class="form-label">Ads Name</label>
                                    <input type="text"
                                           class="form-control {{ $errors->has('advertisementCategoryTitle') ? 'is-invalid' : '' }}"
                                           id="ads_name" name="advertisementCategoryTitle"
                                           placeholder="Enter ads Name"
                                           value="{{ isset($editCategory) ? $editCategory->adsCategoryTitle : '' }}"
                                           required>
                                    @if ($errors->has('advertisementCategoryTitle'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('advertisementCategoryTitle') }}
                                        </div>
                                    @endif
                                </div>

                                <div class="d-flex align-items-center">
                                    <button type="submit" class="btn btn-primary btn-sm d-flex align-items-center"
                                            id="submitButton">
                                        <span id="buttonText">
                                            {{ isset($editCategory) ? 'Update' : 'Submit' }}
                                        </span>
                                        <div id="loaderSpinner" class="spinner-border spinner-border-sm d-none"
                                             role="status">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                    </button>
                                </div>

                                <script>
                                    const form = document.getElementById('adsForm');
                                    const submitButton = document.getElementById('submitButton');
                                    const buttonText = document.getElementById('buttonText');
                                    const loaderSpinner = document.getElementById('loaderSpinner');

                                    form.addEventListener('submit', function () {
                                        submitButton.disabled = true;
                                        loaderSpinner.classList.remove('d-none');
                                        buttonText.style.display = 'none';
                                    });
                                </script>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- List of ads Categories -->
                <div class="col-6">
                    <div class="card mb-4">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h5 class="mb-0">Ads Categories</h5>
                            <small class="text-muted float-end">List of Ads Categories</small>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($advertisementCategory as $ads)
                                            <tr>
                                                <td>{{ $ads->adsCategoryTitle }}</td>
                                                <td>
                                                    <div class="dropdown">
                                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                                data-bs-toggle="dropdown">
                                                            <i class="bx bx-dots-vertical-rounded"></i>
                                                        </button>
                                                        <div class="dropdown-menu">
                                                            <!-- Edit Trigger -->
                                                            <a class="dropdown-item text-primary"
                                                               href="{{ route('advertisementcategory.edit', $ads->id) }}">
                                                                <i class="bx bx-edit me-1"></i> Edit
                                                            </a>
                                                            <!-- Delete Trigger -->
                                                            <a class="dropdown-item text-danger"
                                                               href="javascript:void(0);"
                                                               data-bs-toggle="modal"
                                                               data-bs-target="#deleteModal{{ $ads->id }}">
                                                                <i class="bx bx-trash me-1"></i> Delete
                                                            </a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>

                                            <!-- Delete Modal -->
                                            <div class="modal fade" id="deleteModal{{ $ads->id }}" tabindex="-1"
                                                 aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Delete Confirmation</h5>
                                                            <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal"
                                                                    aria-label="Close"></button>
                                                        </div>
                                                        <form method="POST"
                                                              action="{{ route('advertisementcategory.destroy', $ads->id) }}">
                                                            @csrf
                                                            @method('DELETE')
                                                            <div class="modal-body">
                                                                Are you sure you want to delete this category?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                        data-bs-dismiss="modal">Cancel</button>
                                                                <button type="submit"
                                                                        class="btn btn-danger">Delete</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div class="pagination m-3 mx-0" style="float: right;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
