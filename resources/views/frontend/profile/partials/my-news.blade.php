@extends('frontend.profile.jobseeker-dashboard')

@section('profileSection')
    <div class="modal fade" id="removeBookmarkModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
    <div id="podcast" class="profile-section bg-white">
        <div class="card-container-jobs border advertisement ">
            <div class="row g-4  p-3 row-cols-1 row-cols-md-2 row-cols-lg-3" id="profile-abroad-boxes">
                <!-- First Card -->
                <div class="col">
                    <div class=" profile-advertisement-box border-primary p-2" style="position: relative;">
                        <button class="rounded-circle d-flex align-items-center justify-content-center"
                            style="position: absolute; top: 18px; right: 18px; width: 28px; height: 28px; background-color: #EDEDED; border: none;">
                            <i class="fas fa-bookmark bookmark-icon text-primary d-flex"></i>
                        </button>
                        <img alt="Teddy bear in a room" src="Images/tesla.jpg" />
                        <div class="card-body p-2">
                            <h5 class="card-title">Podcast of Utsav Dhungana</h5>
                            <p class="card-text text-muted fs-6 my-2">15:30 min</p>
                            <p class="card-text text-muted" style="color: #9D9999; font-size: 16px; font-weight: 400;">
                                <small>2024/12/30</small>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class=" profile-advertisement-box border-primary p-2" style="position: relative;">
                        <button class="rounded-circle d-flex align-items-center justify-content-center"
                            style="position: absolute; top: 18px; right: 18px; width: 28px; height: 28px; background-color: #EDEDED; border: none;">
                            <i class="fas fa-bookmark bookmark-icon text-primary d-flex"></i>
                        </button>
                        <img alt="Teddy bear in a room" src="Images/tesla.jpg" />
                        <div class="card-body p-2">
                            <h5 class="card-title">Podcast of Utsav Dhungana</h5>
                            <p class="card-text text-muted fs-6 my-2">15:30 min</p>
                            <p class="card-text text-muted" style="color: #9D9999; font-size: 16px; font-weight: 400;">
                                <small>2024/12/30</small>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class=" profile-advertisement-box border-primary p-2" style="position: relative;">
                        <button class="rounded-circle d-flex align-items-center justify-content-center"
                            style="position: absolute; top: 18px; right: 18px; width: 28px; height: 28px; background-color: #EDEDED; border: none;">
                            <i class="fas fa-bookmark bookmark-icon text-primary d-flex"></i>
                        </button>
                        <img alt="Teddy bear in a room" src="Images/tesla.jpg" />
                        <div class="card-body p-2">
                            <h5 class="card-title">Podcast of Utsav Dhungana</h5>
                            <p class="card-text text-muted fs-6 my-2">15:30 min</p>
                            <p class="card-text text-muted" style="color: #9D9999; font-size: 16px; font-weight: 400;">
                                <small>2024/12/30</small>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class=" profile-advertisement-box border-primary p-2" style="position: relative;">
                        <button class="rounded-circle d-flex align-items-center justify-content-center"
                            style="position: absolute; top: 18px; right: 18px; width: 28px; height: 28px; background-color: #EDEDED; border: none;">
                            <i class="fas fa-bookmark bookmark-icon text-primary d-flex"></i>
                        </button>
                        <img alt="Teddy bear in a room" src="Images/tesla.jpg" />
                        <div class="card-body p-2">
                            <h5 class="card-title">Podcast of Utsav Dhungana</h5>
                            <p class="card-text text-muted fs-6 my-2">15:30 min</p>
                            <p class="card-text text-muted" style="color: #9D9999; font-size: 16px; font-weight: 400;">
                                <small>2024/12/30</small>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class=" profile-advertisement-box border-primary p-2" style="position: relative;">
                        <button class="rounded-circle d-flex align-items-center justify-content-center"
                            style="position: absolute; top: 18px; right: 18px; width: 28px; height: 28px; background-color: #EDEDED; border: none;">
                            <i class="fas fa-bookmark bookmark-icon text-primary d-flex"></i>
                        </button>
                        <img alt="Teddy bear in a room" src="Images/tesla.jpg" />
                        <div class="card-body p-2">
                            <h5 class="card-title">Podcast of Utsav Dhungana</h5>
                            <p class="card-text text-muted fs-6 my-2">15:30 min</p>
                            <p class="card-text text-muted" style="color: #9D9999; font-size: 16px; font-weight: 400;">
                                <small>2024/12/30</small>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class=" profile-advertisement-box border-primary p-2" style="position: relative;">
                        <button class="rounded-circle d-flex align-items-center justify-content-center"
                            style="position: absolute; top: 18px; right: 18px; width: 28px; height: 28px; background-color: #EDEDED; border: none;">
                            <i class="fas fa-bookmark bookmark-icon text-primary d-flex"></i>
                        </button>
                        <img alt="Teddy bear in a room" src="Images/tesla.jpg" />
                        <div class="card-body p-2">
                            <h5 class="card-title">Podcast of Utsav Dhungana</h5>
                            <p class="card-text text-muted fs-6 my-2">15:30 min</p>
                            <p class="card-text text-muted" style="color: #9D9999; font-size: 16px; font-weight: 400;">
                                <small>2024/12/30</small>
                            </p>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
@endsection


@push('scripts')
    {{-- <script>
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
    </script> --}}
@endpush
