@extends('backend.layouts.main')
@section('title', 'Forex Exchange Requests')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="d-flex align-items-center justify-content-between mb-3">
            <h4 class="fw-bold">Forex Exchange Requests</h4>
            <a href="{{ route('forex.index') }}" class="btn btn-primary">Back to Forex Rates</a>
        </div>
        <!-- Display Exchange Requests -->
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Exchange Requests List</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Customer</th>
                                <th>Transfer Amount</th>
                                <th>Receiver Amount</th>
                                <th>Info</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($requests->isEmpty())
                                <tr>
                                    <td colspan="9" class="text-center">No exchange requests found.</td>
                                </tr>
                            @endif
                            @foreach ($requests as $request)
                                <tr>
                                    {{-- <td>{{ \Carbon\Carbon::parse($request->created_at)->format('Y-m-d') }}</td> --}}
                                    <td>
                                        {{ ucfirst($request->jobseeker->firstName) }} {{ $request->jobseeker->lastName }}
                                    </td>
                                    {{-- <td>
                                        <span class="badge bg-{{ $request->buy_or_sell == 'buy' ? 'success' : 'info' }}">
                                            {{ ucfirst($request->buy_or_sell) }}
                                        </span>
                                    </td> --}}
                                    <td>
                                        {{ number_format($request->transfer_amount, 3) }} {{ $request->base_currency }}
                                    </td>
                                    <td>
                                        {{ number_format($request->receiver_amount, 3) }}
                                        {{ $request->base_currency == $request->forex_calculator->base_currency ? $request->forex_calculator->target_currency : $request->forex_calculator->base_currency }}
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-info" data-bs-toggle="modal"
                                            data-bs-target="#viewDetailsModal_{{ $request->id }}">View</button>
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#deleteModal"
                                            onclick="setDeleteRequestForm({{ $request->id }})">Delete</button>
                                    </td>
                                </tr>
                                <div class="modal fade" id="viewDetailsModal_{{ $request->id }}" tabindex="-1"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Exchange Request Details</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-6 mb-3">
                                                        <h6 class="text-muted">Customer Information</h6>
                                                        <div class="border-start ps-3 mb-3">
                                                            <p class="mb-1"><strong>Name:</strong> <span
                                                                    id="customerName">{{ ucfirst($request->jobseeker->firstName) }}
                                                                    {{ $request->jobseeker->lastName }}</span></p>
                                                            <p class="mb-1"><strong>Email:</strong> <span
                                                                    id="customerEmail">
                                                                    {{ $request->jobseeker->emailAddress }} </span></p>
                                                            <p class="mb-1"><strong>Phone:</strong> <span
                                                                    id="customerPhone">
                                                                    {{ $request->jobseeker->phoneNumber }}</span></p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <h6 class="text-muted">Exchange Details</h6>
                                                        <div class="border-start ps-3 mb-3">
                                                            <p class="mb-1"><strong>Transaction Type:</strong> <span
                                                                    id="exchangeType">
                                                                    {{ ucfirst($request->buy_or_sell) }}</span></p>
                                                            <p class="mb-1"><strong>Transaction Date:</strong> <span
                                                                    id="exchangeDate">
                                                                    {{ \Carbon\Carbon::parse($request->created_at)->format('Y-m-d') }}</span>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6 mb-3">
                                                        <h6 class="text-muted">Sender Details</h6>
                                                        <div class="border-start ps-3 mb-3">
                                                            <p class="mb-1"><strong>Bank Name:</strong> <span
                                                                    id="senderBank">{{ $request->sender_bank_name }}</span>
                                                            </p>
                                                            <p class="mb-1"><strong>Account Number:</strong> <span
                                                                    id="senderAccount">{{ $request->sender_account_number }}</span>
                                                            </p>
                                                            <p class="mb-1"><strong>Amount:</strong> <span
                                                                    id="senderAmount">{{ $request->transfer_amount }}</span>
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <h6 class="text-muted">Receiver Details</h6>
                                                        <div class="border-start ps-3 mb-3">
                                                            <p class="mb-1"><strong>Bank Name:</strong> <span
                                                                    id="receiverBank"> {{ $request->receiver_bank_name }}
                                                                </span></p>
                                                            <p class="mb-1"><strong>Account Number:</strong> <span
                                                                    id="receiverAccount">
                                                                    {{ $request->receiver_account_number }} </span></p>
                                                            <p class="mb-1"><strong>Amount:</strong> <span
                                                                    id="receiverAmount">
                                                                    {{ $request->transfer_amount }}</span></p>
                                                        </div>
                                                    </div>
                                                </div>

                                                <h6 class="text-muted">Forex Calculator Details</h6>
                                                <div class="border-start ps-3 mb-3">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <p class="mb-1"><strong>Date of Validity:</strong> <span
                                                                    id="validityDate">
                                                                    {{ \Carbon\Carbon::parse($request->forex_calculator->date_of_validity)->format('Y-m-d') }}
                                                                </span></p>
                                                            <p class="mb-1"><strong>Base Currency:</strong> <span
                                                                    id="baseCurrency">
                                                                    {{ $request->forex_calculator->base_currency }} </span>
                                                            </p>
                                                            <p class="mb-1"><strong>Target Currency:</strong> <span
                                                                    id="targetCurrency">
                                                                    {{ $request->forex_calculator->target_currency }}
                                                                </span></p>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <p class="mb-1"><strong>Buying Rate:</strong> <span
                                                                    id="buyingRate">
                                                                    {{ $request->forex_calculator->buying_rate }} </span>
                                                            </p>
                                                            <p class="mb-1"><strong>Selling Rate:</strong> <span
                                                                    id="sellingRate">
                                                                    {{ $request->forex_calculator->selling_rate }} </span>
                                                            </p>
                                                            <p class="mb-1"><strong>Applied Rate:</strong> <span
                                                                    id="appliedRate" class="fw-bold"> <span
                                                                        class="badge bg-{{ $request->buy_or_sell == 'buy' ? 'success' : 'info' }}">
                                                                        {{ ucfirst($request->buy_or_sell) }}
                                                                    </span></span></p>
                                                        </div>
                                                    </div>
                                                </div>

                                                <h6 class="text-muted">Remarks</h6>
                                                <div class="border-start ps-3">
                                                    <p id="requestRemarks"> {{ $request->remarks }} </p>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="mt-3 d-flex justify-content-end">
                    {{ $requests->links() }}
                </div>
            </div>
        </div>

        <!-- Delete Modal -->
        <div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Delete Confirmation</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="POST" id="deleteRequestForm">
                        @csrf
                        @method('DELETE')
                        <div class="modal-body">
                            Are you sure you want to delete this exchange request?
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
            function setDeleteRequestForm(id) {
                document.getElementById('deleteRequestForm').action = "{{ route('forex.request.destroy', ':id') }}".replace(
                    ':id', id);
            }

            document.addEventListener('DOMContentLoaded', function() {
                // Add loading indicators for delete form
                document.getElementById('deleteRequestForm').addEventListener('submit', function() {
                    document.getElementById('deleteButton').disabled = true;
                    document.getElementById('deleteLoader').style.display = 'inline-block';
                });
            });
        </script>
    </div>
@endsection
