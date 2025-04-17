@extends('backend.layouts.main')

@section('title', isset($ResumeHelp) ? 'Edit Resume Help' : 'Create Resume Help')

@section('content')
    <div class="container py-4">
        <h4 class="fw-bold m-4">{{ isset($ResumeHelp) ? 'Edit Resume Help' : 'Create Resume Help' }}</h4>

        <div class="card shadow">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="card-title">{{ isset($ResumeHelp) ? 'Edit Resume Help' : 'Add New Resume Help' }}</h4>
                    <a href="{{ route('resume-help.index') }}" class="btn btn-secondary btn-sm text-white">Back</a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('resume-help.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3 col-md-6">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label">Title <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="title" placeholder="Title">
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label">Type <span class="text-danger">*</span></label>
                        <select class="form-control" name="type">
                            <option value="0">Free</option>
                            <option value="1">Premium</option>
                        </select>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label">Short Description <span class="text-danger">*</span></label>
                        <textarea class="form-control" name="short_desc"></textarea>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label">Image</label>
                        <input type="file" class="form-control" name="image_preview">
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label">Normal Price <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" name="normal_price">
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label">Sell Price <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" name="sell_price">
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
