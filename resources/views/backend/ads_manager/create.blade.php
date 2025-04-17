@extends('backend.layouts.main')

@section('title', isset($adsManager) ? 'Edit Ads Manager' : 'Create Ads Manager')

@section('content')
    <div class="container py-4">
        <h4 class="fw-bold m-4">{{ isset($adsManager) ? 'Edit Ads Manager' : 'Create Ads Manager' }}</h4>

        <div class="card shadow">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="card-title">{{ isset($adsManager) ? 'Edit Ads Manager' : 'Add New Ads Manager' }}</h4>
                    <a href="{{ route('ads-manager.index') }}" class="btn btn-secondary btn-sm text-white">Back</a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('ads-manager.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Error Messages -->
                    @if ($errors->any())
                        <div class="mb-3 col-md-6">
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif

                    <!-- Title -->
                    <div class="mb-3 col-md-6">
                        <label class="form-label">Title <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="title" placeholder="Title">
                    </div>

                    <!-- Link -->
                    <div class="mb-3 col-md-6">
                        <label class="form-label">Ad Link <span class="text-danger">*</span></label>
                        <input type="url" class="form-control" name="link" placeholder="Ad URL">
                    </div>

                    <!-- Which Page -->
                    <div class="mb-3 col-md-6">
                        <label class="form-label">Which Page <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="which_page" placeholder="Page Name">
                    </div>

                    <!-- Position -->
                    <div class="mb-3 col-md-6">
                        <label class="form-label">Position <span class="text-danger">*</span></label>
                        <select class="form-control" name="position">
                            <option value="left">Left</option>
                            <option value="right">Right</option>
                            <option value="top">Top</option>
                            <option value="bottom">Bottom</option>
                            <option value="middle">Middle</option>
                        </select>
                    </div>

                    <!-- Publish or Not -->
                    <div class="mb-3 col-md-6">
                        <label class="form-label">Publish Status <span class="text-danger">*</span></label>
                        <select class="form-control" name="publish_or_not">
                            <option value="1">Publish</option>
                            <option value="0">Unpublish</option>
                        </select>
                    </div>

                    <!-- Active Status -->
                    <div class="mb-3 col-md-6">
                        <label class="form-label">Active Status <span class="text-danger">*</span></label>
                        <select class="form-control" name="active">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>

                    <!-- Image -->
                    <div class="mb-3 col-md-6">
                        <label class="form-label">Ad Image</label>
                        <input type="file" class="form-control" name="image">
                    </div>

                    <button type="submit" class="btn btn-success">Save</button>
                </form>

            </div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote.min.js"></script>


@endsection
