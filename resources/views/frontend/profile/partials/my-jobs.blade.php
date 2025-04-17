@extends('frontend.profile.jobseeker-dashboard')

@section('profileSection')
<div class="modal fade" id="removeBookmarkModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropLabel">Confirm</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            Do you want to remove the favourite job?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <a href="#" class="btn btn-outline-danger" id="confirmFavouriteDeleteBtn">Confirm</a>
        </div>
      </div>
    </div>
  </div>
<div id="myJobs" class="content-section">
    <!-- My Jobs Content -->

    <div class="card-container border p-3">




        <div class="jobs-card jobs-job px-2">


            @if(!empty($jobs))
                @foreach($jobs as $job)
                <div class="position-relative">
                    <button type="button" class="delete-favourite-btn border-0 bg-white cursor-pointer p-2 position-absolute text-danger top-0 end-0 me-3 mt-2" data-bs-toggle="modal" data-bs-target="#removeBookmarkModal" data-delete-url="{{ route('jobBookmark.remove', ['jobId'=>$job->id]) }}" style="z-index: 99;">
                        <i class="fa-solid fa-trash"></i>
                      </button>
                <a href="{{ route('frontend.job-details', ['slug' => $job->jobSlug]) }}" class="text-dark d-block text-decoration-none mb-2">

                    <div class="jobs-card ">
                        <div class="job-card-profile">
                            <img src="{{ $job->jobBanner ? asset('storage/'.$job->jobBanner) : asset('frontend/assets/Images/jobdefault.png') }}" alt="Company Image" />
                          <div class="job-card-profile-body">
                            <h5 class="card-title">{{$job->jobTitle}}</h5>
                            <p>Company Name: {{$job->jobCompany->companyName}}</p>
                            <p>Location: {{$job->jobLocation}}</p>
                            <p>Experience: {{$job->experience}} Years</p>
                            <p class="d-flex">Source:
                                <a href="{{ $job->jobCompany->link1 }}"
                                    target="_blank">{{ $job->jobCompany->link1 }}</a> &nbsp;
                                    <a href="{{ $job->jobCompany->link2 }}"
                                    target="_blank">{{ $job->jobCompany->link2 }}</a>
                                &nbsp;<a href="{{ $job->jobCompany->link3 }}"
                                    target="_blank">{{ $job->jobCompany->link3 }}</a>
                            </p>
                          </div>
                          <div class="full-width-border"></div>
                        <div class="job-card-footer">
                            <small>Apply before: {{$job->jobDeadline}}</small>
                            <small>Views: {{$job->jobViewerCount}}</small>
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
