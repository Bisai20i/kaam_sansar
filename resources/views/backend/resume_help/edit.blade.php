@extends('backend.layouts.main')

@section('title', 'Edit Resume Help' )

@section('content')
    <div class="container py-4">
        <h4 class="fw-bold m-4">Edit Resume Help</h4>

        <div class="card shadow">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="card-title">Edit Resume Help</h4>
                    <a href="{{ route('resume-help.index') }}" class="btn btn-secondary btn-sm text-white">Back</a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('resume-help.update', $resumeHelp->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
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


                    <div class="d-flex flex-wrap mb-2">
                        <div class="col-md-6 col-12 px-2">
                            <label class="form-label">Title <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="title" placeholder="Title" value="{{ old('title', $resumeHelp->title) }}">
                        </div>
                        <div class="col-md-6 col-12 px-2">
                            <label class="form-label">Type <span class="text-danger">*</span></label>
                            <select class="form-control" name="type" >
                                <option value="0" {{ old('type', $resumeHelp->type) == 0 ? 'selected' : '' }}>Free</option>
                                <option value="1" {{ old('type', $resumeHelp->type) == 1 ? 'selected' : '' }}>Premium</option>
                            </select>
                        </div>

                    </div>

                    <div class="d-flex flex-wrap mb-2">

                        
                        <div class="col-md-6 col-12 px-2">
                            <label class="form-label">Image</label>
                            <input type="file" class="form-control" name="image_preview" accept="image/*">

                            <img src="{{ asset('storage/' . $resumeHelp->image_preview) }}" class="img img-fluid mt-2" style="max-width:200px;"/>
                        </div>

                        <div class="col-md-6 col-12 px-2">
                            <label class="form-label">Sell Price <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" name="sell_price" value = "{{ old('sell_price', $resumeHelp->sell_price) }}">
                        </div>

                    </div>
                    
                    <div class="d-flex flex-wrap mb-2">

                        <div class="col-md-6 col-12 px-2">
                            <label class="form-label">Normal Price <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" name="normal_price" value = "{{ old('normal_price', $resumeHelp->normal_price) }}">
                        </div>
                        
                        <div class="col-md-6 col-12 px-2">
                            <label class="form-label">Type <span class="text-danger">*</span></label>
                            <select class="form-control" name="publish_not_publish">
                                <option value="1" {{ old('publish_not_publish', $resumeHelp->publish_not_publish) == 1 ? 'selected' : '' }}>Publish</option>
                                <option value="0" {{ old('publish_not_publish', $resumeHelp->publish_not_publish) == 0 ? 'selected' : '' }}>Unpublish</option>
                            </select>
                        </div>

                    </div>

                    <div class="col-md-6 col-12 px-2 mb-3">
                        <label class="form-label">Short Description <span class="text-danger">*</span></label>
                        <textarea class="form-control" name="short_desc">{{ old('short_desc', $resumeHelp->short_desc) }}</textarea>
                    </div>

            
                    <button type="submit" class="btn btn-primary mx-2">Update</button>
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
