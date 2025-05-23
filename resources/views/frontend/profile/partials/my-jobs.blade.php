@extends('frontend.profile.jobseeker-dashboard')

@section('profileSection')

    <div class="modal fade" id="removeBookmarkModal" tabindex="-1" aria-labelledby="removeBookmarkModallLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content p-4 rounded-4 border-0 shadow-lg text-center">
                <button type="button" class="btn-close ms-auto" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="mb-3">
                    <div class="mx-auto rounded-circle bg-danger bg-opacity-10 d-flex align-items-center justify-content-center"
                        style="width: 64px; height: 64px;">
                        <i class="bi bi-trash-fill text-danger fs-3"></i>
                    </div>
                </div>
                <h4 class="fw-bold">Are you sure?</h4>
                <p class="text-secondary mb-4">Do you want to remove the favourite job?</p>
                <div class="d-flex justify-content-center align-items-center" style="box-sizing: border-box;">
                    <button type="button" class="btn border-secondary col-6 me-1" data-bs-dismiss="modal">Cancel</button>
                    <a href="#" class="btn btn-danger w-100 ms-1 " id="confirmFavouriteDeleteBtn">Confirm</a>
                    

                </div>
            </div>
        </div>
    </div>


    <div id="myJobs" class="content-section">
        <!-- My Jobs Content -->

        <div class="card-container border p-3">




            <div class="jobs-card jobs-job px-2 px-lg-5 w-100">


                @if (!empty($jobs))
                    @foreach ($jobs as $job)
                        <div class="position-relative w-100">
                            <button type="button"
                                class="delete-favourite-btn border-0 bg-white cursor-pointer p-2 position-absolute text-danger top-0 end-0 me-3 mt-2"
                                data-bs-toggle="modal" data-bs-target="#removeBookmarkModal"
                                data-delete-url="{{ route('jobBookmark.remove', ['jobId' => $job->id]) }}"
                                style="z-index: 99;">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                            <a href="{{ route('frontend.job-details', ['slug' => $job->jobSlug]) }}"
                                class="text-dark d-block text-decoration-none mb-2">

                                <div class="jobs-card w-100" >
                                    <div class="job-card-profile p-0" style="max-width:none !important;">
                                        <img src="{{ $job->jobBanner ? asset('storage/' . $job->jobBanner) : asset('frontend/assets/Images/jobdefault.png') }}"
                                            alt="Company Image"  class="p-2 p-md-3"/>
                                        <div class="job-card-profile-body ms-2">
                                            <h5 class="card-title m-1 pt-1 pt-md-2">{{ $job->jobTitle }}</h5>
                                            <p>Company Name: {{ $job->jobCompany->companyName }}</p>
                                            <p>Location: {{ $job->jobLocation }}</p>
                                            <p>Experience: {{ $job->experience }} Years</p>
                                            <p class="d-flex mb-0">Source:
                                                <a href="{{ $job->jobCompany->link1 }}"
                                                    target="_blank">{{ $job->jobCompany->link1 }}</a> &nbsp;
                                                <a href="{{ $job->jobCompany->link2 }}"
                                                    target="_blank">{{ $job->jobCompany->link2 }}</a>
                                                &nbsp;<a href="{{ $job->jobCompany->link3 }}"
                                                    target="_blank">{{ $job->jobCompany->link3 }}</a>
                                            </p>
                                        </div>
                                        <div class="full-width-border border "></div>
                                        <div class="job-card-footer mt-0 p-2 p-md-3">
                                            <small>Apply before: {{ $job->jobDeadline }}</small>
                                            <small>Views: {{ $job->jobViewerCount }}</small>
                                        </div>
                                    </div>
                                </div>

                                {{-- <div class="job-card-1 my-4">
                        <img src="{{ $job->jobBanner ? asset('storage/'.$job->jobBanner) : asset('frontend/assets/Images/jobdefault.png') }}" alt="Company Image" />
                        <div class="job-card-body text-start">
                            <h5 class="card-title">{{$job->jobTitle}}</h5>
                            <p>Company Name: {{$job->jobCompany->companyName}}</p>
                            <p>Location: {{$job->jobLocation}}</p>
                            <p>Experience: {{$job->experience}} Years</p>
                            <p class="d-flex">Source: <a href="{{ $job->jobCompany->link1 }}"
                                    target="_blank">{{ $job->jobCompany->link1 }}</a>, &nbsp; <a
                                    href="{{ $job->jobCompany->link2 }}"
                                    target="_blank">{{ $job->jobCompany->link2 }}</a>,
                                &nbsp;<a href="{{ $job->jobCompany->link3 }}"
                                    target="_blank">{{ $job->jobCompany->link3 }}</a>
                            </p>
                        </div>
                        <div class="full-width-border"></div>
                        <div class="job-card-footer">
                            <small>Apply before: {{$job->jobDeadline}}</small>
                            <small>Views: {{$job->jobViewerCount}}</small>
                        </div>
                    </div> --}}
                            </a>
                        </div>
                    @endforeach
                @endif

            </div>
        </div>
    </div>


@endsection


@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let deleteButtons = document.querySelectorAll(".delete-favourite-btn");
            let confirmDeleteBtn = document.getElementById("confirmFavouriteDeleteBtn");

            deleteButtons.forEach(button => {
                button.addEventListener("click", function() {
                    let deleteUrl = this.getAttribute("data-delete-url");
                    confirmDeleteBtn.setAttribute("href", deleteUrl);
                });
            });
        });
    </script>
@endpush
