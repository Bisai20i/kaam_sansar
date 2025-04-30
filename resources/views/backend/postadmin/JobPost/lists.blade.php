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
                        <h4 class="card-title">Job Post Details</h4>
                    </div>
                    <div>
                        <a href="{{ route('jobPost.postcreate') }}" class="btn btn-primary btn-sm text-white">Create Job
                            Post</a>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th style="border-right: 1px solid #dee2e6;">S.N</th>
                                <th style="border-right: 1px solid #dee2e6;">Job Title</th>
                                <th style="border-right: 1px solid #dee2e6;">Job Location</th>
                                <th style="border-right: 1px solid #dee2e6;"> Skill</th>
                                <th style="border-right: 1px solid #dee2e6;">Job Banner</th>
                                <th style="border-right: 1px solid #dee2e6;">Job Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @foreach ($jobpost as $post)
                                <tr>
                                    <td style="border-right: 1px solid #dee2e6;">{{ $loop->iteration }}</td>
                                    <td style="border-right: 1px solid #dee2e6;">{{ $post->jobTitle }}</td>
                                    <td style="border-right: 1px solid #dee2e6;">{{ $post->jobLocation }}</td>
                                    <td style="border-right: 1px solid #dee2e6;">{{ $post->skills }}</td>
                                    <td style="border-right: 1px solid #dee2e6;">
                                        @if ($post->jobBanner)
                                            <img src="{{ asset('storage/' . $post->jobBanner) }}" alt="Job Banner"
                                                style="width: 100px; height: auto;">
                                        @else
                                            <span class="text-muted">No Image</span>
                                        @endif
                                    </td>
                                    <td style="border-right: 1px solid #dee2e6;">
                                        @if ($post->jobStatus == 'published')
                                            <span class="badge" style="background-color: #1BB189; color: white;"
                                                me-1>{{ $post->jobStatus }}</span>
                                        @elseif($post->jobStatus == 'expired')
                                            <span class="badge" style="background-color: #C22B2BFF; color: white;"
                                                me-1>{{ $post->jobStatus }}</span>
                                        @elseif($post->jobStatus == 'unpublished')
                                            <span class="badge" style="background-color: #FAAC24; color: white;"
                                                me-1>{{ $post->jobStatus }}</span>
                                        @else
                                            <span class="badge bg-label-secondary me-1">{{ $post->jobStatus }}</span>
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
                                                <a class="dropdown-item text-{{ $post->jobStatus == 'published' ? 'danger' : 'success' }}"
                                                    href="javascript:void(0);" data-bs-toggle="modal"
                                                    data-bs-target="#publishUnpublishModal"
                                                    onclick="setPublishUnpublishFormAction({{ $post->id }}, '{{ $post->jobStatus }}', '{{ $post->postName }}')">
                                                    <i
                                                        class="bx bx-{{ $post->jobStatus == 'published' ? 'x' : 'check' }} me-1"></i>
                                                    {{ $post->jobStatus == 'published' ? 'Unpublish' : 'Publish' }}
                                                </a>
                                                <a class="dropdown-item"
                                                    href="{{ route('jobPost.postcreate', $post->id) }}"><i
                                                        class="bx bx-edit-alt me-1"></i> Edit</a>
                                                {{-- <a class="dropdown-item" href="{{ route('jobPost.show', $post->id) }}"><i class="bx bx-show me-1"></i> View</a> --}}
                                                <form action="{{ route('jobPost.destroy', $post->id) }}" method="POST"
                                                    style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="dropdown-item text-danger"
                                                        data-bs-toggle="modal" data-bs-target="#deleteModal"
                                                        data-url="{{ route('jobPost.destroy', $post->id) }}">
                                                        <i class="bx bx-trash me-1"></i> Delete
                                                    </button>
                                                </form>

                                                <button class="dropdown-item" id="viewJobApplicatoins"
                                                    data-job-id="{{ $post->id }}" data-bs-toggle="modal"
                                                    data-bs-target="#jobApplicationsModal"
                                                    data-job-title="{{ $post->jobTitle }}">
                                                    <i class='bx bx-briefcase me-1'></i>Job Applications
                                                </button>


                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>


                </div>


                <div class="pagination my-3 mx-0" style="float: right;">

                    {{ $jobpost->links() }}
                </div>
            </div>



        </div>
    </div>

    <div class="modal fade" id="jobApplicationsModal" tabindex="-1" aria-labelledby="jobApplicationsModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="jobApplicationsModalLabel">
                        Job Applications for <span id="jobTitle"></span>:
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="border-right: 1px solid #dee2e6;">S.N</th>
                                    <th style="border-right: 1px solid #dee2e6;">Jobseeker Name</th>
                                    <th style="border-right: 1px solid #dee2e6;">Applied Date</th>
                                    <th style="border-right: 1px solid #dee2e6;">Email</th>
                                    <th style="border-right: 1px solid #dee2e6;">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0" id="jobApplicationsTable">
                                <tr>
                                    <td style="border-right: 1px solid #dee2e6;">1</td>
                                    <td style="border-right: 1px solid #dee2e6;">Hello something</td>
                                    <td style="border-right: 1px solid #dee2e6;">date</td>
                                    <td style="border-right: 1px solid #dee2e6;">example@emxil.com</td>

                                    <td style="border-right: 1px solid #dee2e6;">
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                data-bs-toggle="dropdown">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>

                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>


                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>



    <!-- Publish/Unpublish Modal -->
    <div class="modal fade" id="publishUnpublishModal" tabindex="-1" aria-labelledby="publishUnpublishModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="publishUnpublishModalLabel">
                        Change Job Category Publish Status to <strong id="modalTitle"></strong> Status
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
                            <span id="loader" class="spinner-border spinner-border-sm" role="status"
                                aria-hidden="true" style="display: none;"></span>
                            <span id="buttonText">Submit</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel"><strong></strong>Delete Job Post</strong></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Warning Icon -->
                    <div class="text-center">
                        <i class="fas fa-exclamation-triangle text-warning" style="font-size: 50px;"></i>
                    </div>
                    <p class="text-center bold"><strong>
                            <h4>Are you sure you want to delete this job post?</h4>
                        </strong>
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <form id="deleteForm" action="" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Add this in the <head> section for Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <script>
        // URLs for publish and unpublish routes
        const publishUrl = @json(route('job-post.publish', ['id' => '__ID__']));
        const unpublishUrl = @json(route('job-post.unpublish', ['id' => '__ID__']));

        // Function to dynamically update modal content
        function setPublishUnpublishFormAction(postId, currentStatus) {
            const modalTitle = document.getElementById('modalTitle');
            const modalMessage = document.getElementById('modalMessage');
            const actionButton = document.getElementById('modalActionButton');
            const buttonText = document.getElementById('buttonText');
            const publishUnpublishForm = document.getElementById('publishUnpublishForm');

            if (currentStatus === 'published') {
                // Set content for unpublishing
                modalTitle.textContent = 'Unpublished';
                modalMessage.textContent = 'Are you sure you want to unpublish this job post?';
                actionButton.classList.remove('btn-success');
                actionButton.classList.add('btn-warning');
                buttonText.textContent = 'Unpublish';
                publishUnpublishForm.action = unpublishUrl.replace('__ID__', postId);
            } else {
                // Set content for publishing
                modalTitle.textContent = 'Published';
                modalMessage.textContent = 'Are you sure you want to publish this job post?';
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


        document.getElementById('viewJobApplicatoins').addEventListener('click', function(e) {

            document.getElementById('jobTitle').textContent = e.target.getAttribute('data-job-title');
            loader.style.display = 'inline-block';

            let jobId = e.target.getAttribute('data-job-id');
            let jobApplicationsTable = document.getElementById('jobApplicationsTable')

            try {
                jobApplicationsTable.innerHTML = '<tr><td colspan="5" class="text-center">Loading...</td></tr>';
                const response = await fetch(getBaseUrl() + '/superadmin/job-post/applications', {
                    method: 'GET',
                    headers: {
                        'X-CSRF-TOKEN': {{ csrf_token() }},
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                });

                // Check for HTTP error response (like 401, 422, 500)
                if (!response.ok) {
                    // Try to parse JSON error response
                    const errorData = await response.json();
                    console.error('Server error:', errorData);

                    // Laravel validation errors (422 Unprocessable Entity)
                    if (response.status === 422) {
                        alert('Validation failed: ' + Object.values(errorData.errors).join('\n'));
                    } else {
                        alert('Something went wrong. Please try again.');
                    }

                    // Stop further execution
                    return;
                }

                const data = await response.json();

                if (data.status) {
                    jobApplicationsTable.innerHTML = '';

                    data.data.forEach((application, index) => {
                        let applicationRow = document.createElement('tr');
                        applicationRow.innerHTML = `
                           <td style="border-right: 1px solid #dee2e6;">${index + 1}</td>
                            <td style="border-right: 1px solid #dee2e6;"${application.job_seeker.firstName} ${application.job_seeker.lastName}</td>
                            <td style="border-right: 1px solid #dee2e6;">${application.created_at.toLocaleString()}</td>
                            <td style="border-right: 1px solid #dee2e6;">${application.job_seeker.emailAddress}</td>

                            <td style="border-right: 1px solid #dee2e6;">
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>

                                </div>
                            </td>
                        `;
                        jobApplicationsTable.appendChild(applicationRow);
                    })

                    let application = document.createElement('tr');
                    jobApplicationsTable.innerHTML = data.html;

                }

                $('#sendMessageButton').html(
                    '<i class="fas fa-paper-plane" style="color:#0064A7"></i>'
                );

                if (data.status) {
                    $('#chatBox [name="message"]').val('');
                    console.log('Message sent:', data);
                } else {
                    console.warn('Server responded with unexpected status:', data);
                }

            } catch (error) {
                // Network error or unexpected failure
                console.error('Fetch failed:', error);
                alert('Network error. Please check your connection.');
                $('#sendMessageButton').html(
                    '<i class="fas fa-paper-plane" style="color:#0064A7"></i>'
                );
            }
        });
    </script>

@endsection
