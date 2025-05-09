@extends('backend.layouts.main')

@section('title', 'Broker Applications')

@section('content')
<div class="container">
    <h4 class="fw-bold mb-4"><span class="text-muted fw-light">Broker Applications</span></h4>
    <div class="card shadow">
        <div>
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h4 class="card-title">Broker Account List</h4>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive" style="max-height: 500px; overflow-y: auto;">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>S.N</th>
                            <th>BOID</th>
                            <th>Client Type</th>
                            <th>Mobile</th>
                            <th>Email</th>
                            <th>Bank</th>
                            <th>Branch</th>
                            <th>Account Number</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($brokerAccounts as $broker)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $broker->boid }}</td>
                            <td>{{ ucfirst($broker->clientType) }}</td>
                            <td>{{ $broker->mobileNumber }}</td>
                            <td>{{ $broker->emailAddress }}</td>
                            <td>{{ $broker->bankName }}</td>
                            <td>{{ $broker->bankBranch }}</td>
                            <td>{{ $broker->accountNumber }}</td>
                            <td>
                                <span class="badge 
                                    @if($broker->status == 'approved') bg-success 
                                    @elseif($broker->status == 'rejected') bg-danger 
                                    @else bg-warning text-dark 
                                    @endif">
                                    {{ ucfirst($broker->status) }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('brokerAccounts.show', $broker->id) }}" class="btn btn-sm btn-success">
                                    <i class="fas fa-download"></i> Download
                                </a>
                            </td>
                        </tr>
                        @endforeach
                        @if ($brokerAccounts->isEmpty())
                        <tr>
                            <td colspan="10" class="text-center">No broker accounts found.</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Font Awesome for icons -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
@endsection
