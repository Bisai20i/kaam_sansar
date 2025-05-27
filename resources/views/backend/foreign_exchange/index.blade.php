@extends('backend.layouts.main')
@section('title', 'Manage Forex Rates')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="d-flex align-items-center justify-content-between mb-3">
            <h4 class="fw-bold">Forex Exchange Rates</h4>
            <a href="{{ route('forex.requests') }}" class="btn btn-primary position-relative">
                <span class="p-2 position-absolute top-0 start-0 translate-middle badge rounded-pill bg-danger">
                    {{ $exchange_request_count }}
                    <span class="visually-hidden">unread messages</span>
                </span>
                Exchange requests</a>
        </div>


        <!-- Form to Add Rates -->
        <div class="card mb-4">
            <div class="card-header ">
                <h5 class="mb-0">Add Forex Rate</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('forex.store') }}" id="forexForm">
                    @csrf
                    <input type="hidden" name="rates" id="ratesInput">
                    <div class="row g-2 align-items-end">
                        <div class="col">
                            <label for="rateDate" class="mb-1">Date of Validity</label>
                            <input type="date" class="form-control" id="rateDate" placeholder="Date">
                        </div>

                        <div class="col">
                            <label for="baseCurrency" class="mb-1">Base Currency <small>(1 Unit Rate)</small></label>
                            <select class="form-control" id="baseCurrency">
                                <option value="">Select Base Currency</option>
                                <option value="NPR">NPR - Nepalese Rupee </option>
                            </select>
                        </div>

                        <div class="col">
                            <label for="targetCurrency" class="mb-1">Target Currency</label>
                            <select class="form-control" id="targetCurrency">
                                <option value="">Select Target Currency</option>
                                <option value="NPR">NPR - Nepalese Rupee </option>
                            </select>
                        </div>

                        <div class="col">
                            <label for="buyingRate" class="mb-1">Buying Rate</label>
                            <input type="number" step="0.0001" min="0" class="form-control" id="buyingRate"
                                placeholder="Buying Rate">
                        </div>

                        <div class="col">
                            <label for="sellingRate" class="mb-1">Selling Rate</label>
                            <input type="number" step="0.0001" min="0" class="form-control" id="sellingRate"
                                placeholder="Selling Rate">
                        </div>

                        <div class="col">
                            <button type="button" class="btn btn-primary" onclick="addRate()">Add</button>
                        </div>
                    </div>


                    <table class="table table-bordered my-4" id="ratesTable">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Base</th>
                                <th>Target</th>
                                <th>Buying</th>
                                <th>Selling</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>

                    <button type="submit" class="btn btn-success" id="submitRatesBtn" disabled>Submit Rates</button>
                </form>
            </div>
        </div>

        <!-- Display Existing Rates -->
        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5>Forex Rates List @if (request()->has('date_of_validity') && request('date_of_validity') != '')
                        of date: {{ request('date_of_validity') }}
                    @endif
                    @if (request()->has('base_currency'))
                        (Base Currency: {{ request('base_currency') }})
                    @endif
                </h5>
                <form action="{{ route('forex.index') }}" class="d-flex gap-2">
                    <input type="date" class="form-control" name="date_of_validity" id="filterDate">
                    <select class="form-control" id="filter_baseCurrency" name="base_currency">
                        <option value="">Select Base Currency</option>
                        <option value="NPR">NPR - Nepalese Rupee </option>
                    </select>
                    <button class="btn btn-primary" type="submit">Filter</button>
                </form>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Base</th>
                            <th>Target</th>
                            <th>Buy</th>
                            <th>Sell</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($forexRates->isEmpty())
                            <tr>
                                <td colspan="6" class="text-center">No forex rates found.</td>
                            </tr>
                        @endif
                        @foreach ($forexRates as $rate)
                            <tr>
                                <td>{{ $rate->date_of_validity }}</td>
                                <td>{{ $rate->base_currency }}</td>
                                <td>{{ $rate->target_currency }}</td>
                                <td>{{ $rate->buying_rate }}</td>
                                <td>{{ $rate->selling_rate }}</td>
                                <td>
                                    <button class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#manageDetailModal"
                                        onclick="updateEditModal({{ $rate->id }},
                                        '{{ $rate->date_of_validity }}', 
                                        '{{ $rate->base_currency }}', 
                                        '{{ $rate->target_currency }}', 
                                        '{{ $rate->buying_rate }}', 
                                        '{{ $rate->selling_rate }}')">Edit</button>
                                    <button class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#deleteModal"
                                        onclick="setDeleteFormAction({{ $rate->id }})">Delete</button>
                                    {{-- <form method="POST" action="{{ route('forex.destroy', $rate->id) }}"
                                        onsubmit="return confirm('Delete this rate?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger">Delete</button>
                                    </form> --}}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-1 d-flex justify-content-end">
                    {{ $forexRates->links() }}
                </div>

            </div>
        </div>


        <!-- edit modal -->

        <div class="modal fade" id="manageDetailModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTitle">Edit Forex Rate</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="editForm" method="POST">
                        @csrf
                        @method('PUT')
                        <div id="methodField"></div> <!-- For PUT method when editing -->

                        <div class="modal-body">

                            <div class="mb-3">
                                <label class="form-label">Date of Validity</label>
                                <input type="date" class="form-control" name="date_of_validity"
                                    id="edit_date_of_validity" placeholder="Date">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Base Currency</label>
                                <select class="form-control" id="edit_baseCurrency" name="base_currency">
                                    <option value="">Select Base Currency</option>
                                    <option value="NPR">NPR - Nepalese Rupee </option>
                                </select>
                            </div>



                            <div class="mb-3">
                                <label class="form-label">Target Currency</label>
                                <select class="form-control" id="edit_targetCurrency" name="target_currency">
                                    <option value="">Select Target Currency</option>
                                    <option value="NPR">NPR - Nepalese Rupee </option>
                                </select>
                            </div>


                            <div class="mb-3">
                                <label for="description" class="form-label">Buying Rate <span
                                        class="text-danger">*</span></label>

                                <input type="number" step="0.0001" min="0" class="form-control"
                                    id="edit_buyingRate" name="buying_rate" placeholder="Buying Rate">
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label">Selling Rate <span
                                        class="text-danger">*</span></label>
                                <input type="number" step="0.0001" min="0" class="form-control"
                                    id="edit_sellingRate" name="selling_rate" placeholder="Selling Rate">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary" id="submitBtn">
                                <span id="buttonText">Submit</span>
                                <span id="buttonSpinner" class="spinner-border spinner-border-sm d-none"
                                    role="status"></span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Delete Confirmation</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="POST" id="deleteForm">
                        @csrf
                        @method('DELETE')
                        <div class="modal-body">
                            Are you sure you want to delete this Forex Record ?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-danger" id="deleteButton">
                                <span id="deleteLoader" class="spinner-border spinner-border-sm" role="status"
                                    aria-hidden="true" style="display: none;"></span>
                                Delete
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <script>
            let forexRates = [];

            function addRate() {
                const date = document.getElementById('rateDate').value;
                const base = document.getElementById('baseCurrency').value;
                const target = document.getElementById('targetCurrency').value;
                const buy = document.getElementById('buyingRate').value;
                const sell = document.getElementById('sellingRate').value;

                if (!date || !base || !target || !buy || !sell) {
                    alert('Fill all fields');
                    return;
                }

                forexRates.push({
                    date_of_validity: date,
                    base_currency: base,
                    target_currency: target,
                    buying_rate: buy,
                    selling_rate: sell
                });

                const tbody = document.querySelector("#ratesTable tbody");
                const row = document.createElement("tr");
                row.innerHTML = `<td>${date}</td><td>${base}</td><td>${target}</td><td>${buy}</td><td>${sell}</td>
            <td><button class="btn btn-sm btn-danger" onclick="removeRow(this)">Remove</button></td>`;
                tbody.appendChild(row);

                updateHiddenInput();
            }

            function removeRow(button) {
                const row = button.parentElement.parentElement;
                const index = Array.from(row.parentElement.children).indexOf(row);
                forexRates.splice(index, 1);
                row.remove();
                updateHiddenInput();
            }

            function updateHiddenInput() {
                document.getElementById('ratesInput').value = JSON.stringify(forexRates);
                document.getElementById('submitRatesBtn').disabled = forexRates.length === 0;
            }

            const today = new Date().toISOString().split('T')[0];
            date.setAttribute('min', today);
        </script>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                fetch('https://api.frankfurter.app/currencies')
                    .then(response => response.json())
                    .then(data => {
                        const baseSelect = document.getElementById('baseCurrency');
                        const targetSelect = document.getElementById('targetCurrency');
                        const editBaseSelect = document.getElementById('edit_baseCurrency');
                        const editTargetSelect = document.getElementById('edit_targetCurrency');
                        const filterBaseCurrency = document.getElementById('filter_baseCurrency');

                        Object.entries(data).forEach(([code, name]) => {
                            const option = new Option(`${code} - ${name}`, code);
                            baseSelect.add(option.cloneNode(true));

                            targetSelect.add(option);

                            editBaseSelect.add(option.cloneNode(true));
                            editTargetSelect.add(option.cloneNode(true));
                            filterBaseCurrency.add(option.cloneNode(true));
                        });
                    })
                    .catch(error => {
                        console.error('Error fetching currencies:', error);
                    });
            });
        </script>

        <script>
            function setDeleteFormAction(id) {
                // Use Laravel's resource route helper to generate the correct URL for deletion
                document.getElementById('deleteForm').action = "{{ route('forex.destroy', ':id') }}".replace(':id',
                    id);
            }

            function updateEditModal(id, date, base, target, buy, sell) {

                console.log(date, base, target, buy, sell)
                document.getElementById('edit_date_of_validity').value = date;

                let baseSelect = document.getElementById('edit_baseCurrency');
                let targetSelect = document.getElementById('edit_targetCurrency');

                Array.from(baseSelect.options).forEach(option => {
                    if (option.value === base) {
                        option.selected = true;
                    }
                });

                Array.from(targetSelect.options).forEach(option => {
                    if (option.value === target) {
                        option.selected = true;
                    }
                });
                // document.getElementById('edit_BaseCurrency').value = base;
                // document.getElementById('edit_TargetCurrency').value = target;
                document.getElementById('edit_buyingRate').value = buy;
                document.getElementById('edit_sellingRate').value = sell;

                document.getElementById('editForm').action = "{{ route('forex.update', ':id') }}".replace(':id',
                    id);
            }
        </script>

    @endsection
