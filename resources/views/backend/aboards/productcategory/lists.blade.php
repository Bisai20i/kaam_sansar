@extends('backend.layouts.main')

@section('title', 'Product Category')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="content-wrapper">
            <h4 class="fw-bold mb-4"><span class="text-muted fw-light"> </span> Product Category</h4>

            <div class="row">
                <!-- Form to Add/Edit Product Category -->
                <div class="col-6">
                    <div class="card mb-4">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h5 class="mb-0">
                                {{ isset($editCategory) ? 'Edit' : 'Add' }} Product Category
                            </h5>
                        </div>
                        <div class="card-body">
                            <form method="POST"
                                  action="{{ isset($editCategory) ? route('productcategory.update', $editCategory->id) : route('productcategory.store') }}"
                                  id="productCategoryForm">
                                @csrf
                                @if(isset($editCategory))
                                    @method('PUT')
                                    <input type="hidden" name="id" value="{{ $editCategory->id }}">
                                @endif

                                <div class="mb-3">
                                    <label for="category_name" class="form-label">Category Name</label>
                                    <input type="text"
                                           class="form-control {{ $errors->has('productCategoryTitle') ? 'is-invalid' : '' }}"
                                           id="category_name" name="productCategoryTitle"
                                           placeholder="Enter category name"
                                           value="{{ isset($editCategory) ? $editCategory->productCategoryTitle : '' }}"
                                           required>
                                    @if ($errors->has('productCategoryTitle'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('productCategoryTitle') }}
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
                                    const form = document.getElementById('productCategoryForm');
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

                <!-- List of Product Categories -->
                <div class="col-6">
                    <div class="card mb-4">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h5 class="mb-0">Product Categories</h5>
                            <small class="text-muted float-end">List of Product Categories</small>
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
                                        @foreach($productCategories as $category)
                                            <tr>
                                                <td>{{ $category->productCategoryTitle }}</td>
                                                <td>
                                                    <div class="dropdown">
                                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                                data-bs-toggle="dropdown">
                                                            <i class="bx bx-dots-vertical-rounded"></i>
                                                        </button>
                                                        <div class="dropdown-menu">
                                                            <!-- Edit Trigger -->
                                                            <a class="dropdown-item text-primary"
                                                               href="{{ route('productcategory.edit', $category->id) }}">
                                                                <i class="bx bx-edit me-1"></i> Edit
                                                            </a>
                                                            <!-- Delete Trigger -->
                                                            <a class="dropdown-item text-danger"
                                                               href="javascript:void(0);"
                                                               data-bs-toggle="modal"
                                                               data-bs-target="#deleteModal{{ $category->id }}">
                                                                <i class="bx bx-trash me-1"></i> Delete
                                                            </a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>

                                            <!-- Delete Modal -->
                                            <div class="modal fade" id="deleteModal{{ $category->id }}" tabindex="-1"
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
                                                              action="{{ route('productcategory.destroy', $category->id) }}">
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
