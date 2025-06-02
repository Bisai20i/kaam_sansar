@extends('frontend.profile.jobseeker-dashboard')

@section('profileSection')
    <div id="form" class="profile-section bg-white">
        <div class="card-container-jobs border advertisement p-4">
            <h2 class="mb-3 fw-semibold fs-5" style="color: #1A1A1A;">Kundali Matching List</h2>

            @if ($kundaliMatchings->count())
                <div class="table-responsive border rounded-1 border-secondary-subtle">
                    <table class="table mb-0 text-nowrap align-middle">
                        <thead class="bg-white border-bottom border-secondary-subtle py-1">
                            <tr>
                                <th style="font-size: 18px; font-weight: 500;">Girl Name</th>
                                <th style="font-size: 18px; font-weight: 500;">Girl DOB</th>
                                <!-- <th style="font-size: 18px; font-weight: 500;">Girl Place</th> -->
                                <th style="font-size: 18px; font-weight: 500;">Girl Time</th>
                                <th style="font-size: 18px; font-weight: 500;">Boy Name</th>
                                <th style="font-size: 18px; font-weight: 500;">Boy DOB</th>
                                <!-- <th style="font-size: 18px; font-weight: 500;">Boy Place</th> -->
                                <th style="font-size: 18px; font-weight: 500;">Boy Time</th>
                                <th style="font-size: 18px; font-weight: 500;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kundaliMatchings as $item)
                                <tr class="border-bottom border-secondary-subtle py-1">
                                    <td style="font-weight: 500;">{{ $item->girlName }}</td>
                                    <td style="font-weight: 500;">{{ $item->girlDateOfBirth }}</td>
                                    <!-- <td style="font-weight: 500;">{{ $item->girlPlaceOfBirth }}</td> -->
                                    <td style="font-weight: 500;">
                                        @php
                                            $time = $item->girlTimeOfBirth;
                                            $validTime = false;
                                            if (!empty($time) && $time !== '::') {
                                                $timestamp = strtotime($time);
                                                if ($timestamp !== false && date('H:i:s', $timestamp) !== '00:00:00') {
                                                    $validTime = true;
                                                    $formattedTime = date('H:i:s', $timestamp);
                                                }
                                            }
                                        @endphp

                                        @if ($validTime)
                                            {{ $formattedTime }}
                                        @else
                                            N/A
                                        @endif
                                    </td>








                                    <td style="font-weight: 500;">{{ $item->boyName }}</td>
                                    <td style="font-weight: 500;">{{ $item->boyDateOfBirth }}</td>
                                    <!-- <td style="font-weight: 500;">{{ $item->boyPlaceOfBirth }}</td> -->
                                    <td style="font-weight: 500;">
                                        {{ $item->boyTimeOfBirth ?? 'N/A' }}
                                    </td>

                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-sm dropdown-toggle" type="button"
                                                id="actionDropdown{{ $item->id }}" data-bs-toggle="dropdown"
                                                aria-expanded="false">

                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="actionDropdown{{ $item->id }}">
                                                <li>
                                                    <a class="dropdown-item edit-btn" href="#" data-bs-toggle="modal"
                                                        data-bs-target="#editModal" data-id="{{ $item->id }}"
                                                        data-girlname="{{ $item->girlName }}"
                                                        data-girldob="{{ $item->girlDateOfBirth }}"
                                                        data-girlplace="{{ $item->girlPlaceOfBirth }}"
                                                        data-girltime="{{ $item->girlTimeOfBirth }}"
                                                        data-boyname="{{ $item->boyName }}"
                                                        data-boydob="{{ $item->boyDateOfBirth }}"
                                                        data-boyplace="{{ $item->boyPlaceOfBirth }}"
                                                        data-boytime="{{ $item->boyTimeOfBirth }}"
                                                        data-query1="{{ $item->Query1 }}"
                                                        data-query2="{{ $item->Query2 }}"
                                                        data-query3="{{ $item->Query3 }}">Edit</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item text-danger" href="#"
                                                        data-bs-toggle="modal" data-bs-target="#deleteModal"
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
                <p>No kundali matching records found.</p>
            @endif
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModallLabel" aria-hidden="true">
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
                <p class="text-secondary mb-4">Are you sure you want to delete this kundali?</p>
                <form method="POST" id="deleteForm" class="d-flex justify-content-center align-items-center"
                    style="box-sizing: border-box;">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn border-secondary col-6 me-1" data-bs-dismiss="modal">Cancel</button>

                    <button type="submit" id="deleteCommentButton" class="btn btn-danger w-100 ms-1">Delete</button>

                </form>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form method="POST" id="editForm">
                @csrf
                @method('PUT')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Edit Kundali Matching</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row g-3">
                            <h6>Girl Details</h6>
                            <div class="col-md-6">
                                <label>Girl Name</label>
                                <input type="text" name="girlName" id="editGirlName" class="form-control" required>
                            </div>

                            <!-- Split Girl Date of Birth into Day, Month, Year -->
                            <div class="row p-3">
                                <!-- Date of Birth -->
                                <div class="col-md-6">
                                    <label>Date of Birth</label>
                                    <div class="d-flex gap-2">
                                        <div style="max-width: 70px;">
                                            <input type="number" name="girlDOBDay" id="editGirlDOBDay"
                                                class="form-control" min="1" max="31" required
                                                placeholder="Day">
                                        </div>
                                        <div style="max-width: 120px;">
                                            <select name="girlDOBMonth" id="editGirlDOBMonth" class="form-select"
                                                required>
                                                <option value="">Select Month</option>
                                                @foreach (['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'] as $month)
                                                    <option value="{{ $month }}">{{ $month }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div style="max-width: 90px;">
                                            <input type="number" name="girlDOBYear" id="editGirlDOBYear"
                                                class="form-control" min="1900" max="2100" required
                                                placeholder="Year">
                                        </div>
                                    </div>
                                </div>

                                <!-- Time of Birth -->
                                <div class="col-md-6">
                                    <label>Time of Birth</label>
                                    <div class="d-flex gap-2">
                                        <div style="max-width: 70px;">
                                            <input type="number" name="girlTimeHour" id="editGirlTimeHour"
                                                class="form-control" min="0" max="23" required
                                                placeholder="Hour">
                                        </div>
                                        <div style="max-width: 70px;">
                                            <input type="number" name="girlTimeMinute" id="editGirlTimeMinute"
                                                class="form-control" min="0" max="59" required
                                                placeholder="Minute">
                                        </div>
                                        <div style="max-width: 70px;">
                                            <input type="number" name="girlTimeSecond" id="editGirlTimeSecond"
                                                class="form-control" min="0" max="59" placeholder="Second">
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="col-md-6">
                                <label> Place of Birth</label>
                                <input type="text" name="girlPlaceOfBirth" id="editGirlPlace" class="form-control"
                                    required>
                            </div>

                            <hr class="my-3" />

                            <h6>Boy Details</h6>
                            <div class="col-md-6">
                                <label>Boy Name</label>
                                <input type="text" name="boyName" id="editBoyName" class="form-control" required>
                            </div>


                            <!-- Split Boy Date of Birth into Day, Month, Year -->
                            <div class="row p-3">
                                <!-- Date of Birth -->
                                <div class="col-md-6">
                                    <label>Date of Birth</label>
                                    <div class="d-flex gap-2">
                                        <div style="max-width: 70px;">
                                            <input type="number" name="boyDOBDay" id="editBoyDOBDay"
                                                class="form-control" min="1" max="31" required
                                                placeholder="Day">
                                        </div>
                                        <div style="max-width: 120px;">
                                            <select name="boyDOBMonth" id="editBoyDOBMonth" class="form-select" required>
                                                <option value="">Select Month</option>
                                                @foreach (['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'] as $month)
                                                    <option value="{{ $month }}">{{ $month }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div style="max-width: 90px;">
                                            <input type="number" name="boyDOBYear" id="editBoyDOBYear"
                                                class="form-control" min="1900" max="2100" required
                                                placeholder="Year">
                                        </div>
                                    </div>
                                </div>

                                <!-- Time of Birth -->
                                <div class="col-md-6">
                                    <label>Time of Birth</label>
                                    <div class="d-flex gap-2">
                                        <div style="max-width: 70px;">
                                            <input type="number" name="boyTimeHour" id="editBoyTimeHour"
                                                class="form-control" min="0" max="23" required
                                                placeholder="Hour">
                                        </div>
                                        <div style="max-width: 70px;">
                                            <input type="number" name="boyTimeMinute" id="editBoyTimeMinute"
                                                class="form-control" min="0" max="59" required
                                                placeholder="Minute">
                                        </div>
                                        <div style="max-width: 70px;">
                                            <input type="number" name="boyTimeSecond" id="editBoyTimeSecond"
                                                class="form-control" min="0" max="59" placeholder="Second">
                                        </div>
                                    </div>
                                </div>
                            </div>






                            <div class="col-md-6">
                                <label> Place of Birth</label>
                                <input type="text" name="boyPlaceOfBirth" id="editBoyPlace" class="form-control"
                                    required>
                            </div>

                            <hr class="my-3" />
                            <div class="col-md-12">
                                <label>Query 1</label>
                                <textarea name="query1" id="editQuery1" class="form-control" rows="2"></textarea>
                            </div>
                            <div class="col-md-12 mt-2">
                                <label>Query 2</label>
                                <textarea name="query2" id="editQuery2" class="form-control" rows="2"></textarea>
                            </div>
                            <div class="col-md-12 mt-2">
                                <label>Query 3</label>
                                <textarea name="query3" id="editQuery3" class="form-control" rows="2"></textarea>
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
        // Edit modal - populate inputs with existing data
        // Edit modal - populate inputs with existing data
        var editModal = document.getElementById('editModal');
        editModal.addEventListener('show.bs.modal', function(event) {
            var button = event.relatedTarget;
            console.log("Edit button clicked", button.dataset); // Debugging

            // Set form action
            var id = button.getAttribute('data-id');
            var form = editModal.querySelector('#editForm');
            form.action = "{{ route('jobseeker.kundalimatching.update', '') }}/" + id;

            // Helper function to parse date
            function parseDate(dateString) {
                if (!dateString) return {
                    day: '',
                    month: '',
                    year: ''
                };

                // Try to parse as Carbon date first
                try {
                    const date = new Date(dateString);
                    if (!isNaN(date.getTime())) {
                        return {
                            day: date.getDate().toString(),
                            month: date.toLocaleString('default', {
                                month: 'long'
                            }),
                            year: date.getFullYear().toString()
                        };
                    }
                } catch (e) {
                    console.log("Couldn't parse as Date object");
                }

                // Fallback to string parsing
                if (dateString.includes(' ')) {
                    let parts = dateString.trim().split(/\s+/);
                    if (parts.length >= 3) {
                        return {
                            day: parts[0],
                            month: parts[1],
                            year: parts[2]
                        };
                    }
                }

                if (dateString.includes('-')) {
                    let parts = dateString.split('-');
                    if (parts[0].length === 4) {
                        return {
                            day: parts[2],
                            month: parseInt(parts[1]),
                            year: parts[0]
                        };
                    } else {
                        return {
                            day: parts[0],
                            month: parseInt(parts[1]),
                            year: parts[2]
                        };
                    }
                }

                return {
                    day: '',
                    month: '',
                    year: ''
                };
            }

            // Helper function to parse time
            function parseTime(timeString) {
                // Handle empty or invalid cases first
                if (!timeString || timeString === '::' || timeString.trim() === '') {
                    return {
                        hour: '00',
                        minute: '00',
                        second: '00'
                    };
                }

                // If it's already a properly formatted time string
                if (typeof timeString === 'string') {
                    // Handle cases where time might be in "H:m:s" format
                    let parts = timeString.split(':');

                    // Ensure we have at least hours and minutes
                    if (parts.length >= 2) {
                        return {
                            hour: parts[0] ? parts[0].padStart(2, '0') : '00',
                            minute: parts[1] ? parts[1].padStart(2, '0') : '00',
                            second: parts[2] ? parts[2].padStart(2, '0') : '00'
                        };
                    }
                }

                // Fallback for any other cases
                return {
                    hour: '00',
                    minute: '00',
                    second: '00'
                };
            }
            // Set Girl Details
            document.getElementById('editGirlName').value = button.getAttribute('data-girlname') || '';
            document.getElementById('editGirlPlace').value = button.getAttribute('data-girlplace') || '';

            // Parse and set Girl DOB
            let girlDOB = parseDate(button.getAttribute('data-girldob'));
            document.getElementById('editGirlDOBDay').value = girlDOB.day;
            document.getElementById('editGirlDOBYear').value = girlDOB.year;

            // Set Girl month dropdown
            if (girlDOB.month) {
                let monthSelect = document.getElementById('editGirlDOBMonth');
                let monthValue = typeof girlDOB.month === 'number' ?
                    monthSelect.options[girlDOB.month].text : girlDOB.month;

                for (let i = 0; i < monthSelect.options.length; i++) {
                    if (monthSelect.options[i].text.toLowerCase() === monthValue.toLowerCase()) {
                        monthSelect.selectedIndex = i;
                        break;
                    }
                }
            }

            // Parse and set Girl Time
            let girlTime = parseTime(button.getAttribute('data-girltime'));
            document.getElementById('editGirlTimeHour').value = girlTime.hour;
            document.getElementById('editGirlTimeMinute').value = girlTime.minute;
            document.getElementById('editGirlTimeSecond').value = girlTime.second;

            // Set Boy Details
            document.getElementById('editBoyName').value = button.getAttribute('data-boyname') || '';
            document.getElementById('editBoyPlace').value = button.getAttribute('data-boyplace') || '';

            // Parse and set Boy DOB
            let boyDOB = parseDate(button.getAttribute('data-boydob'));
            document.getElementById('editBoyDOBDay').value = boyDOB.day;
            document.getElementById('editBoyDOBYear').value = boyDOB.year;

            // Set Boy month dropdown
            if (boyDOB.month) {
                let monthSelect = document.getElementById('editBoyDOBMonth');
                let monthValue = typeof boyDOB.month === 'number' ?
                    monthSelect.options[boyDOB.month].text : boyDOB.month;

                for (let i = 0; i < monthSelect.options.length; i++) {
                    if (monthSelect.options[i].text.toLowerCase() === monthValue.toLowerCase()) {
                        monthSelect.selectedIndex = i;
                        break;
                    }
                }
            }

            // Parse and set Boy Time
            let boyTime = parseTime(button.getAttribute('data-boytime'));
            document.getElementById('editBoyTimeHour').value = boyTime.hour;
            document.getElementById('editBoyTimeMinute').value = boyTime.minute;
            document.getElementById('editBoyTimeSecond').value = boyTime.second;

            // Set Queries
            document.getElementById('editQuery1').value = button.getAttribute('data-query1') || '';
            document.getElementById('editQuery2').value = button.getAttribute('data-query2') || '';
            document.getElementById('editQuery3').value = button.getAttribute('data-query3') || '';
        });

        // Delete modal
        var deleteModal = document.getElementById('deleteModal');
        deleteModal.addEventListener('show.bs.modal', function(event) {
            var button = event.relatedTarget;
            var id = button.getAttribute('data-id');
            var form = deleteModal.querySelector('#deleteForm');
            form.action = "{{ route('jobseeker.kundalimatching.delete', '') }}/" + id;
        });
    </script>
@endpush
