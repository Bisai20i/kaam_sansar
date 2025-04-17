@extends('backend.layouts.main')

@section('title', '')

@section('content')

    <div class="container">
        <!-- Content -->
        <h4 class="fw-bold mb-4"><span class="text-muted fw-light"></span></h4>

        <!-- Basic Bootstrap Table -->
        <div class="card shadow">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="card-title">Advertisement</h4>
                    </div>
                    <div>
                        <a href="{{route('ads.create')}}" class="btn btn-primary btn-sm text-white">Create Ads</a>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th style="border-right: 1px solid #dee2e6;">S.N</th>
                                <th style="border-right: 1px solid #dee2e6;">Ads Title</th>
                                <!-- <th style="border-right: 1px solid #dee2e6;">Ads Location</th> -->
                                <th style="border-right: 1px solid #dee2e6;"> Ads Category Title</th>
                                <th style="border-right: 1px solid #dee2e6;">Ads Thumbnail</th>
                                <th style="border-right: 1px solid #dee2e6;">Ads Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @foreach ($ads as $post)
                                <tr>
                                    <td style="border-right: 1px solid #dee2e6;">{{ $loop->iteration }}</td>
                                    <td style="border-right: 1px solid #dee2e6;">{{ $post->adsTitle }}</td>
                                    <!-- <td style="border-right: 1px solid #dee2e6;">{{ $post->location }}</td> -->
                                    <td style="border-right: 1px solid #dee2e6;">{{ $post->adsCategory->adsCategoryTitle}}</td>
                                    <td style="border-right: 1px solid #dee2e6;">
                                        @if ($post->adsThumbnail)
                                        <img src="{{ asset($post->adsThumbnail) }}" alt="Ads Banner" style="width: 100px; height: auto;">


                                        @else
                                            <span class="text-muted">No Image</span>
                                        @endif
                                    </td>
                                    <td style="border-right: 1px solid #dee2e6;">
                                        @if ($post->publishStatus == 'publish')
                                            <span class="badge" style="background-color: #1BB189; color: white;"
                                                me-1>{{ $post->publishStatus }}</span>
                                        @elseif($post->publishStatus == 'expired')
                                            <span class="badge" style="background-color: #C22B2BFF; color: white;"
                                                me-1>{{ $post->publishStatus }}</span>
                                        @elseif($post->publishStatus == 'unpublish')
                                            <span class="badge" style="background-color: #FAAC24; color: white;"
                                                me-1>{{ $post->publishStatus }}</span>
                                        @else
                                            <span class="badge bg-label-secondary me-1">{{ $post->publishStatus }}</span>
                                            <!-- For any other status -->
                                        @endif
                                    </td>
                                    <td style="border-right: 1px solid #dee2e6;">
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                data-bs-toggle="dropdown">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item text-{{ $post->publishStatus == 'publish' ? 'danger' : 'success' }}"
                                                    href="javascript:void(0);" data-bs-toggle="modal"
                                                    data-bs-target="#publishUnpublishModal"
                                                    onclick="setPublishUnpublishFormAction({{ $post->id }}, '{{ $post->publishStatus }}', '{{ $post->postName }}')">
                                                    <i
                                                        class="bx bx-{{ $post->publishStatus == 'publish' ? 'x' : 'check' }} me-1"></i>
                                                    {{ $post->publishStatus == 'publish' ? 'Unpublish' : 'Publish' }}
                                                </a>
                                                <a class="dropdown-item"
                                                    href="{{ route('ads.edit', $post->id) }}"><i
                                                        class="bx bx-edit-alt me-1"></i> Edit</a>
                                        <!-- Delete Trigger -->
                        <a class="dropdown-item text-danger" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $post->id }}">
                            <i class="bx bx-trash me-1"></i> Delete
                        </a>
                    </div>
                </div>
            </td>
        </tr>

        <!-- Delete Confirmation Modal (Inside Loop) -->
        <div class="modal fade" id="deleteModal{{ $post->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Delete Confirmation</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="POST" action="{{ route('ads.destroy', $post->id) }}">
                        @csrf
                        @method('DELETE')
                        <div class="modal-body">
                            Are you sure you want to delete this advertisement?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
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
            {{ $ads->links() }}
        </div>
    </div>
    <!-- Publish/Unpublish Modal -->
    <div class="modal fade" id="publishUnpublishModal" tabindex="-1" aria-labelledby="publishUnpublishModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="publishUnpublishModalLabel">
                        Change ads Category Publish Status to <strong id="modalTitle"></strong> Status
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p id="modalMessage"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <form id="publishUnpublishForm" method="POST">
                        @csrf
                        @method('PUT')
                        <button type="submit" id="modalActionButton" class="btn">
                            <span id="loader" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"
                                style="display: none;"></span>
                            <span id="buttonText">Submit</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- Add this in the <head> section for Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <script>
        // URLs for publish and unpublish routes
        const publishUrl = @json(route('ads.publish', ['id' => '__ID__']));
        const unpublishUrl = @json(route('ads.unpublish', ['id' => '__ID__']));

        // Function to dynamically update modal content
        function setPublishUnpublishFormAction(postId, currentStatus) {
            const modalTitle = document.getElementById('modalTitle');
            const modalMessage = document.getElementById('modalMessage');
            const actionButton = document.getElementById('modalActionButton');
            const buttonText = document.getElementById('buttonText');
            const publishUnpublishForm = document.getElementById('publishUnpublishForm');

            if (currentStatus === 'publish') {
                // Set content for unpublishing
                modalTitle.textContent = 'Unpublish';
                modalMessage.textContent = 'Are you sure you want to unpublish this ads post?';
                actionButton.classList.remove('btn-success');
                actionButton.classList.add('btn-warning');
                buttonText.textContent = 'Unpublish';
                publishUnpublishForm.action = unpublishUrl.replace('__ID__', postId);
            } else {
                // Set content for publishing
                modalTitle.textContent = 'Publish';
                modalMessage.textContent = 'Are you sure you want to publish this ads post?';
                actionButton.classList.remove('btn-warning');
                actionButton.classList.add('btn-success');
                buttonText.textContent = 'Publish';
                publishUnpublishForm.action = publishUrl.replace('__ID__', postId);
            }
        }

        // Handle loader visibility during form submission
        document.getElementById('publishUnpublishForm').addEventListener('submit', function() {
            const loader = document.getElementById('loader');
            const buttonText = document.getElementById('buttonText');

            // Show loader and hide button text
            loader.style.display = 'inline-block';
            buttonText.style.display = 'none';
        });
    </script>



@endsection
