@extends('frontend.profile.jobseeker-dashboard')

@section('profileSection')
<div id="form" class="profile-section bg-white">
    <div class="card-container-jobs border advertisement p-4">
        <h2 class="mb-3 fw-semibold fs-5" style="color: #1A1A1A;">Kundali List</h2>



        @if($kundali->count())
        <div class="table-responsive border rounded-1 border-secondary-subtle">
            <table class="table mb-0 text-nowrap align-middle">
                <thead class="bg-white border-bottom border-secondary-subtle py-1">
                    <tr>
                        <th style="font-size: 18px; font-weight: 500;">Name</th>
                        <th style="font-size: 18px; font-weight: 500;">DOB</th>
                        <th style="font-size: 18px; font-weight: 500;">Place</th>
                        <th style="font-size: 18px; font-weight: 500;">Time</th>
                        <th style="font-size: 18px; font-weight: 500;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($kundali as $item)
                    <tr class="border-bottom border-secondary-subtle py-1">
                        <td style="font-weight: 500;">{{ $item->personName }}</td>
                        <td style="font-weight: 500;">{{ $item->personDateOfBirth }}</td>
                        <td style="font-weight: 500;">{{ $item->personPlaceOfBirth }}</td>
                        <td style="font-weight: 500;">{{ $item->personTimeOfBirth }}</td>
                        <td>
                            <div class="dropdown">
                                <button class="btn  btn-sm dropdown-toggle" type="button" id="actionDropdown{{ $item->id }}" data-bs-toggle="dropdown" aria-expanded="false">

                                </button>
                                <ul class="dropdown-menu" aria-labelledby="actionDropdown{{ $item->id }}">
                                    <li>
                                        <a class="dropdown-item edit-btn " href="#"

                                            data-bs-toggle="modal"
                                            data-bs-target="#editModal"
                                            data-id="{{ $item->id }}"
                                            data-name="{{ $item->personName }}"
                                            data-dob="{{ $item->personDateOfBirth }}"
                                            data-place="{{ $item->personPlaceOfBirth }}"
                                            data-time="{{ $item->personTimeOfBirth }}"
                                            data-query1="{{ $item->Query1 }}"
                                            data-query2="{{ $item->Query2 }}"
                                            data-query3="{{ $item->Query3 }}">Edit</a>

                                    </li>
                                    <li>
                                        <a
                                            class="dropdown-item text-danger"
                                            href="#"
                                            data-bs-toggle="modal"
                                            data-bs-target="#deleteModal"
                                            data-id="{{ $item->id }}">Delete</a>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <p>No kundali records found.</p>
        @endif
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form method="POST" id="deleteForm">
            @csrf
            @method('DELETE')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Delete Kundali</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">Are you sure you want to delete this kundali?</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Yes, Delete</button>
                </div>
            </div>
        </form>
    </div>
</div>


@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif


<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form method="POST" id="editForm">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Kundali</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-2">
                        <div class="col-md-4">
                            <label>Name</label>
                            <input type="text" name="personName" id="editName" class="form-control" required>
                        </div>

                        <div class="col-md-12">
                            <label>Date of Birth<span class="text-danger">*</span></label>
                            <div class="d-flex gap-2">
                                <input type="text" name="day" id="editDay" class="form-control" placeholder="Day" required maxlength="2" style="max-width: 70px;">
                                <input type="text" name="month" id="editMonth" class="form-control" placeholder="Month" required maxlength="10" style="max-width: 120px;">
                                <input type="text" name="year" id="editYear" class="form-control" placeholder="Year" required maxlength="4" style="max-width: 90px;">
                            </div>
                        </div>

                        <div class="col-md-4 mt-3">
                            <label>Place of Birth</label>
                            <input type="text" name="personPlaceOfBirth" id="editPlace" class="form-control" required>
                        </div>

                        <div class="col-md-12 mt-3">
                            <label>Time of Birth<span class="text-danger">*</span></label>
                            <div class="d-flex gap-2">
                                <input type="text" name="hour" id="editHour" class="form-control" placeholder="Hour" required maxlength="2" style="max-width: 70px;">
                                <input type="text" name="minute" id="editMinute" class="form-control" placeholder="Minute" required maxlength="2" style="max-width: 70px;">
                                <input type="text" name="second" id="editSecond" class="form-control" placeholder="Second" maxlength="2" style="max-width: 70px;">
                            </div>
                        </div>

                        <div class="col-md-12 mt-3">
                            <label>Query 1</label>
                            <input type="text" name="query1" id="editQuery1" class="form-control">
                        </div>
                        <div class="col-md-12 mt-3">
                            <label>Query 2</label>
                            <input type="text" name="query2" id="editQuery2" class="form-control">
                        </div>
                        <div class="col-md-12 mt-3">
                            <label>Query 3</label>
                            <input type="text" name="query3" id="editQuery3" class="form-control">
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</a>
                    <button type="submit" class="btn btn-success">Save Changes</button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection
@push('scripts')


<script>
    // Auto-hide alerts after 10 seconds
    setTimeout(function() {
        $(".alert").fadeOut("slow");
    }, 20000); // 10000 ms = 10 seconds
</script>


<script>
    var editModal = document.getElementById('editModal');

    editModal.addEventListener('show.bs.modal', function(event) {
        var button = event.relatedTarget; // Button that triggered the modal
        var id = button.getAttribute('data-id');
        var form = editModal.querySelector('#editForm');

        // Set form action URL dynamically
        form.action = "{{ url('/jobseeker/profile/kundali/update') }}/" + id;

        // Set name and place directly
        document.getElementById('editName').value = button.getAttribute('data-name') || '';
        document.getElementById('editPlace').value = button.getAttribute('data-place') || '';

        // Parse DOB into day, month, year
        var dob = button.getAttribute('data-dob') || '';
        var day = '',
            month = '',
            year = '';
        if (dob) {
            dob = dob.trim();
            if (dob.includes(' ')) {
                // Format like "23 March 1990"
                var parts = dob.split(' ').filter(Boolean);
                day = parts[0] || '';
                month = parts[1] || '';
                year = parts[2] || '';
            } else if (dob.includes('-')) {
                // Format "1990-03-23" or "23-03-1990"
                var parts = dob.split('-').filter(Boolean);
                if (parts[0].length === 4) {
                    year = parts[0];
                    month = parts[1];
                    day = parts[2];
                } else {
                    day = parts[0];
                    month = parts[1];
                    year = parts[2];
                }
            }
        }
        document.getElementById('editDay').value = day;
        document.getElementById('editMonth').value = month;
        document.getElementById('editYear').value = year;

        // Parse time into hour, minute, second (default 00)
        var time = button.getAttribute('data-time') || '';
        var hour = '00',
            minute = '00',
            second = '00';
        if (time) {
            var parts = time.split(':');
            hour = parts[0] || '00';
            minute = parts[1] || '00';
            second = parts[2] || '00';
        }
        document.getElementById('editHour').value = hour;
        document.getElementById('editMinute').value = minute;
        document.getElementById('editSecond').value = second;

        // Queries
        document.getElementById('editQuery1').value = button.getAttribute('data-query1') || '';
        document.getElementById('editQuery2').value = button.getAttribute('data-query2') || '';
        document.getElementById('editQuery3').value = button.getAttribute('data-query3') || '';
    });

    // Delete modal action
    var deleteModal = document.getElementById('deleteModal');
    deleteModal.addEventListener('show.bs.modal', function(event) {
        var button = event.relatedTarget;
        var id = button.getAttribute('data-id');
        var form = deleteModal.querySelector('#deleteForm');
        form.action = "{{ route('jobseeker.kundali.delete', '') }}/" + id;
    });
</script>





@endpush