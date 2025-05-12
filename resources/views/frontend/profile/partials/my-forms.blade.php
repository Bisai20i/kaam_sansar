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

    <div id="form" class="profile-section bg-white">
        <div class="card-container-jobs border advertisement p-4">
            <h2 class="mb-3 fw-semibold fs-5" style="color: #1A1A1A;">Form Submissions</h2>
            <div class="table-responsive border rounded-1 border-secondary-subtle">
                <table class="table mb-0 text-nowrap align-middle">
                    <thead class="bg-white border-bottom border-secondary-subtle py-1">
                        <tr>
                            <th scope="col" class="ps-2" style="font-size: 18px; font-weight: 500;">S.N</th>
                            <th scope="col" class="" style="font-size: 18px; font-weight: 500;">Form Title</th>
                            <th scope="col" class="" style="font-size: 18px; font-weight: 500;">Submitted Date</th>
                            <th scope="col" class="" style="font-size: 18px; font-weight: 500;">Status</th>
                            <th scope="col" class="" style="font-size: 18px; font-weight: 500;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-bottom border-secondary-subtle py-1">
                            <td class="ps-3" style="font-weight: 500;">1</td>
                            <td class="" style="font-weight: 500;">Work Permit</td>
                            <td class="" style="font-weight: 500;">05/11/2025</td>
                            <td>
                                <span class="badge rounded-1 px-3 py-2 fw-semibold"
                                    style="font-size: 14px; background-color: #1AB189;">Completed</span>
                            </td>
                            <td>
                                <span class="badge rounded-1 px-3 py-2 bg-primary fw-semibold" style="font-size: 14px;">Fill
                                    More<i class="bi bi-arrow-right ps-2" style="font-weight: 700;"></i></span>
                            </td>
                        </tr>
                        <tr class="border-bottom border-secondary-subtle py-1">
                            <td class="ps-3" style="font-weight: 500;">2</td>
                            <td class="" style="font-weight: 500;">Bank Account</td>
                            <td class="" style="font-weight: 500;">05/11/2025</td>
                            <td>
                                <span class="badge rounded-1 px-3 py-2 fw-semibold"
                                    style="font-size: 14px; background-color: #0D99FF;">InProgress</span>
                            </td>
                            <td>
                                <span class="badge rounded-1 px-3 py-2 bg-primary fw-semibold" style="font-size: 14px;">Fill
                                    More<i class="bi bi-arrow-right ps-2" style="font-weight: 700;"></i></span>
                            </td>
                        </tr>
                        <tr class="border-bottom border-secondary-subtle py-1">
                            <td class="ps-3" style="font-weight: 500;">3</td>
                            <td class="" style="font-weight: 500;">Broker Account</td>
                            <td class="" style="font-weight: 500;">05/11/2025</td>
                            <td>
                                <span class="badge rounded-1 px-3 py-2 fw-semibold"
                                    style="font-size: 14px; background-color: #FEC53D;">Pending</span>
                            </td>
                            <td>
                                <span class="badge rounded-1 px-3 py-2 bg-primary fw-semibold" style="font-size: 14px;">Fill
                                    More<i class="bi bi-arrow-right ps-2" style="font-weight: 700;"></i></span>
                            </td>
                        </tr>
                        <tr class="border-bottom border-secondary-subtle py-1">
                            <td class="ps-3" style="font-weight: 500;">4</td>
                            <td class="" style="font-weight: 500;">Renew Password </td>
                            <td class="" style="font-weight: 500;">05/11/2025</td>
                            <td>
                                <span class="badge rounded-1 px-3 py-2 fw-semibold"
                                    style="font-size: 14px; background-color: #EE2F2F;">Cancelled</span>
                            </td>
                            <td>
                                <span class="badge rounded-1 px-3 py-2 bg-primary fw-semibold" style="font-size: 14px;">Fill
                                    More<i class="bi bi-arrow-right ps-2" style="font-weight: 700;"></i></span>
                            </td>
                        </tr>

                    </tbody>
                </table>
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
