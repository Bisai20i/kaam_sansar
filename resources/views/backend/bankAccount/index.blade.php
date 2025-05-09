@extends('backend.layouts.main')

@section('title', 'Bank Account banklications')

@section('content')
<div class="container">
<h4 class="fw-bold mb-4"><span class="text-muted fw-light"></span></h4>
    <div class="card shadow">
        <div>
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h4 class="card-title">Bank Account List</h4>
                </div>
            </div>
        </div>


        <div class="card-body">
            <div class="table-responsive" style="max-height: 500px; overflow-y: auto;">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>S.N</th>
                            <th>Applicant Name</th>
                            <th>Mobile</th>
                            <th>Email</th>
                            <th>Citizenship</th>
                            <th>Bank</th>
                            <th>Branch</th>
                            <th>Apply From</th>
                            <th>Purpose</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bankAccount as $bank)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $bank->firstName }} {{ $bank->middleName }} {{ $bank->lastName }}</td>
                            <td>{{ $bank->mobileNumber }}</td>
                            <td>{{ $bank->email ?? '-' }}</td>
                            <td>{{ $bank->nepaleseCitizen ? 'Nepalese' : 'Other' }}</td>
                            <td>{{ $bank->preferredBank }}</td>
                            <td>{{ $bank->branch }}</td>
                            <td>{{ $bank->applyFromCountry ?? 'Nepal' }}</td>
                            <td>{{ $bank->applicantPurpose }}</td>
                            <td> <a href="{{ route('bankAccounts.show', $bank->id) }}" class="btn btn-sm btn-success">
                                    <i class="fas fa-download"></i> Download
                                </a></td>
                        </tr>
                        @endforeach
                        @if ($bankAccount->isEmpty())
                        <tr>
                            <td colspan="10" class="text-center">No Bank account found.</td>
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