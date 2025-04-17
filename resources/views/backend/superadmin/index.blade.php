@extends('backend.layouts.main')

@section('title', 'Dashboard')

@section('content')
    <div class="container ">

        <!-- Content -->

        <h4 class="fw-bold  mb-4"><span class="text-muted fw-light"></span> </h4>

        <!-- Basic Bootstrap Table -->
        <div class="card shadow">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="card-title">Admin detail</h4>
                    </div>
                    <div class="">
                        <a  href="{{ route('admin.create') }}" class="btn btn-primary btn-sm  text-white"> Add admin</a>

                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>S.N</th>
                                <th>Full Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @foreach ($admins as $admin)
                                <tr>

                                    <td><i class="fab fa-angular fa-lg  me-3"></i>{{ $loop->iteration }} </td>
                                    <td><i class="fab fa-angular fa-lg  me-3"></i>{{ $admin->fullName }} </td>
                                    <td><i class="fab fa-angular fa-lg  me-3"></i>{{ $admin->email }} </td>
                                    <td style="border-right: 1px solid #dee2e6;">
                                        @if($admin->roleType == 'superAdmin')
                                            <span class="badge" style="background-color: #1bb11b; color: white;" me-1>{{ $admin->roleType }}</span>
                                        @elseif($admin->roleType == 'admin')
                                            <span class="badge" style="background-color: #0069D9; color: white;" me-1>{{ $admin->roleType }}</span>
                                        @elseif($admin->roleType == 'postAdmin')
                                            <span class="badge" style="background-color: #FAAC24; color: white;" me-1>{{ $admin->roleType }}</span>
                                        @elseif($admin->roleType == 'user')
                                            <span class="badge" style="background-color: rgb(131, 212, 232); color: white;" me-1>{{ $admin->roleType }}</span>
                                        @else
                                            <span class="badge bg-label-secondary me-1">{{ $admin->roleType }}</span> <!-- For any other roleType -->
                                        @endif
                                    </td>
                                    
                                    <td style="border-right: 1px solid #dee2e6;">
                                        @if($admin->status == 'active')
                                            <span class="badge" style="background-color: #f1d015; color: white;">{{ ucfirst($admin->status) }}</span>
                                        @elseif($admin->status == 'inactive')
                                            <span class="badge" style="background-color: #C22B2BFF; color: white;">{{ ucfirst($admin->status) }}</span>
                                        @else
                                            <span class="badge bg-label-secondary">{{ ucfirst($admin->status) }}</span>
                                        @endif
                                    </td>
                                                                        <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                data-bs-toggle="dropdown">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="{{ route('admin.edit', $admin->id) }}"><i
                                                        class="bx bx-edit-alt me-1"></i> Edit</a>
                                                <a class="dropdown-item">
                                                    <button type="button" class="btn p-0 text-danger" data-bs-toggle="modal" data-bs-target="#deleteModal" onclick="setDeleteUrl('{{ route('admin.destroy', $admin->id) }}')">
                                                        <i class="bx bx-trash me-1"></i> Delete
                                                     </button>
                                                
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

    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="deleteModalLabel"><strong></strong>Confirm Deletion</strong></h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <!-- Warning Icon -->
              <div class="text-center">
                  <i class="fas fa-exclamation-triangle text-warning" style="font-size: 50px;"></i>
              </div>
              <p class="text-center bold"><strong><h4>Are you sure you want to delete this Admin User?</h4></strong>
                </p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
              <form id="deleteAdminForm" action="#" method="POST" style="display: inline;">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger">Delete</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    
@endsection

@push('scripts')
    <script>
        function setDeleteUrl(url){
            console.log(url)
            document.getElementById('deleteAdminForm').action = url
        }

    </script>
@endpush
