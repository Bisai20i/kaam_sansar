@extends('frontend.profile.jobseeker-dashboard')

@section('profileSection')

<div class="modal-lg modal fade" id="profileImagePreviewModal" tabindex="-1" aria-labelledby="imagePreviewModalLabel" aria-hidden="true">
    <button type="button" class="btn-close position-absolute top-0 end-0 me-5 mt-5" data-bs-dismiss="modal" aria-label="Close"></button>
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content position-relative border-0" style="background: transparent;">
            {{-- <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div> --}}
            <div class="modal-body text-center p-0" style="max-width: 100%;">
                <!-- Image will be dynamically inserted here -->
                <img id="profile-preview-image" src="" class="img-fluid " alt="Full Image" />
            </div>
        </div>
    </div>
</div>


<div id="basicInfo" class="content-section">

    <div class="card-container border py-3">
        <div class="profile-card border">
            <p class="text-start">Id No. {{ Auth::user()->id }}</p>

            <img id="jobSeekerProfile" src="{{ Auth::user()->userThumbnail ? (filter_var(Auth::user()->avatar, FILTER_VALIDATE_URL) ? Auth::user()->userThumbnail[0] : asset('storage/' . Auth::user()->userThumbnail[0])) : asset('frontend/assets/Images/aaaa.png') }}"
                alt class=" profile-img" data-bs-toggle="modal" data-bs-target="#profileImagePreviewModal"  style="cursor: pointer;" />
            <h5 class="mt-3">{{ Auth::user()->firstName }} {{ Auth::user()->lastName }}</h5>
            <div class="profile-text">
                @if (Auth::user()->profession)
                    <p>Profession: {{ Auth::user()->profession }}</p>
                @endif

                @if (Auth::user()->referralCode)
                    <p>Referral Code: {{ Auth::user()->referralCode }}</p>
                @endif

                @if (Auth::user()->permanentLocation)
                    <p>Location: {{ Auth::user()->permanentLocation }}</p>
                @endif
                <p>Referal Code: 55455</p>
            </div>

            <img src="{{ asset('frontend/assets/Images/qr.png') }}" class="qr-code" alt="QR Code" />
        </div>
    </div>
</div>



@endsection

@push('scripts')
    <script>
        let jobSeekerProfile = document.getElementById('jobSeekerProfile')
        jobSeekerProfile.addEventListener('click',()=>{
            document.getElementById('profile-preview-image').src = jobSeekerProfile.getAttribute('src');
        })

    </script>
@endpush

{{-- @push('scripts')
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
@endpush --}}


