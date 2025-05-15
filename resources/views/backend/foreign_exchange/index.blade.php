@extends('backend.layouts.main')
@section('title', 'Manage Forex Rates')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold mb-4">Forex Exchange Rates</h4>

    <!-- Form to Add Rates -->
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0">Add Forex Rate</h5>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('forexRates.store') }}" id="forexForm">
                @csrf
                <input type="hidden" name="rates" id="ratesInput">
                <div class="row g-3 align-items-end">
                    <div class="col-md-2">
                        <input type="date" class="form-control" id="rateDate" placeholder="Date">
                    </div>
                    <div class="col-md-2">
                        <input type="text" class="form-control" id="baseCurrency" placeholder="Base Currency (e.g. USD)">
                    </div>
                    <div class="col-md-2">
                        <input type="text" class="form-control" id="targetCurrency" placeholder="Target Currency (e.g. NPR)">
                    </div>
                    <div class="col-md-2">
                        <input type="number" class="form-control" id="buyingRate" placeholder="Buying Rate">
                    </div>
                    <div class="col-md-2">
                        <input type="number" class="form-control" id="sellingRate" placeholder="Selling Rate">
                    </div>
                    <div class="col-md-2">
                        <button type="button" class="btn btn-primary" onclick="addRate()">Add</button>
                    </div>
                </div>

                <table class="table table-bordered mt-3" id="ratesTable">
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
        <div class="card-header">
            <h5>Forex Rates List</h5>
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
                        <th>Posted By</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($forexRates as $rate)
                        <tr>
                            <td>{{ $rate->date_of_validity }}</td>
                            <td>{{ $rate->base_currency }}</td>
                            <td>{{ $rate->target_currency }}</td>
                            <td>{{ $rate->buying_rate }}</td>
                            <td>{{ $rate->selling_rate }}</td>
                            <td>{{ $rate->admin->name ?? 'N/A' }}</td>
                            <td>
                                <form method="POST" action="{{ route('forexRates.destroy', $rate->id) }}" onsubmit="return confirm('Delete this rate?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $forexRates->links() }}
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

        forexRates.push({ date_of_validity: date, base_currency: base, target_currency: target, buying_rate: buy, selling_rate: sell });

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
</script>
@endsection
