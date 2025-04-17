@extends('backend.layouts.main')

@section('title', isset($admin) ? 'Edit Admin User' : 'Add Admin User')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card shadow">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="container-xxl flex-grow-1 container-p-y">
                        <div class="d-flex justify-content-between align-items-center py-3 mb-4">
                            <h4 class="fw-bold m-0">
                                {{ isset($admin) ? 'Edit Admin User' : 'Add Admin User' }}
                            </h4>
                            <a href="{{ route('superadmin.details') }}" class="btn btn-primary btn-sm text-white">
                                <i class="bx bx-arrow-back" aria-hidden="true"></i> Back
                            </a>
                        </div>
                        <!-- Main Content -->
                        <div class="main-content">
                            <section class="section">
                                <form id="formAuthentication" class="mb-3" enctype="multipart/form-data"
                                    action="{{ isset($admin) ? route('admin.update', $admin->id) : route('admin.store') }}"
                                    method="POST">
                                    @csrf
                                    @if (isset($admin))
                                        @method('PUT') <!-- This is necessary for editing an existing admin -->
                                    @endif
                                    <div class="row">

                                        <div class="col-md-6">

                                            <div class="mb-3">
                                                <label for="fullName" class="form-label">Full Name<span
                                                        class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="fullName" name="fullName"
                                                    placeholder="Enter your Name"
                                                    value="{{ old('fullName', isset($admin) ? $admin->fullName : '') }}"
                                                    autofocus required />
                                            </div>
                                            <div class="mb-3">
                                                <label for="email" class="form-label">Email<span
                                                        class="text-danger">*</span></label>
                                                <input type="email" class="form-control" id="email" name="email"
                                                    placeholder="Enter your email"
                                                    value="{{ old('email', isset($admin) ? $admin->email : '') }}"
                                                    required />
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">

                                            <div class="mb-3">
                                                <label for="role" class="form-label">Role<span
                                                        class="text-danger">*</span></label>
                                                <select class="form-select" id="role" name="roleType" required>
                                                    <option value="" disabled
                                                        {{ old('roleType', isset($admin) ? $admin->roleType : '') == null ? 'selected' : '' }}>
                                                        Select role</option>
                                                    <option value="superAdmin"
                                                        {{ old('roleType', isset($admin) ? $admin->roleType : '') == 'superAdmin' ? 'selected' : '' }}>
                                                        SuperAdmin</option>
                                                    <option value="admin"
                                                        {{ old('roleType', isset($admin) ? $admin->roleType : '') == 'admin' ? 'selected' : '' }}>
                                                        Admin</option>
                                                    <option value="postAdmin"
                                                        {{ old('roleType', isset($admin) ? $admin->roleType : '') == 'postAdmin' ? 'selected' : '' }}>
                                                        Post Admin</option>
                                                    <option value="user"
                                                        {{ old('roleType', isset($admin) ? $admin->roleType : '') == 'user' ? 'selected' : '' }}>
                                                        User</option>
                                                </select>
                                            </div>

                                            <div class="mb-3">
                                                <label for="location" class="form-label">Location</label>
                                                <input type="text" class="form-control" id="location" name="location"
                                                    placeholder="Enter your Location"
                                                    value="{{ old('location', isset($admin) ? $admin->location : '') }}"
                                                    autofocus />
                                            </div>
                                        </div>

                                        <div class="col-md-6">

    
                                            <div class="mb-3">
                                                <label for="profile_image" class="form-label">Profile Image</label>
                                                <input type="file" accept="image/*" class="form-control"
                                                    id="profile_image" name="profile_image"  />
                                            
                                                <img src="{{ isset($admin) && $admin->profile_image ? asset('storage/'.$admin->profile_image) : '#' }}" id="previewImage" alt="profile_image"
                                                    class="img-fulid img {{ isset($admin) && $admin->profile_image ? '':'d-none' }} w-100 mt-2">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Fix the button text based on create or edit -->
                                    <button type="submit" class="btn btn-primary btn-sm">
                                        {{ isset($admin) ? 'Update User' : 'Add User' }}
                                    </button>

                                </form>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // $('#profile_image').on('change', function(e) {
        //     let file = e.target.files[0]; 
        //     if (file) {
        //         let imageUrl = URL.createObjectURL(file);
        //         $('#previewImage').removeClass('d-none');
        //         $('#previewImage').attr('src', imageUrl); 
        //     }
        //     else{
        //         $('#previewImage').addClass('d-none');
        //     }
        // });

        document.getElementById('profile_image').addEventListener('change', (e) => {
            let file = e.target.files[0];
            if (file) {
                let imageUrl = URL.createObjectURL(file);
                document.getElementById('previewImage').classList.remove('d-none');
                document.getElementById('previewImage').src = imageUrl;
            } else {
                document.getElementById('previewImage').classList.add('d-none');
            }
        });
    </script>
@endpush
