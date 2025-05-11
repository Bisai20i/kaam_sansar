@extends('backend.layouts.main')

@section('title', 'Reward List')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="content-wrapper">
        <h4 class="fw-bold mb-4">Rewards</h4>

        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">Reward List</h5>
                        <a href="{{ route('rewards.create') }}" class="btn btn-primary btn-sm text-white">
                            <i class="bx bx-plus"></i> Add Reward
                        </a>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>SN</th>
                                        <th>Job Seeker</th>
                                        <th>Reward Points</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($rewards as $reward)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>
            @if($reward->jobSeeker)
            {{ $reward->jobSeeker ? $reward->jobSeeker->firstName . ' ' . $reward->jobSeeker->lastName : 'N/A' }}
            @else
                N/A
            @endif
        </td>
        <td>{{ $reward->reward_points }}</td>
        <td>
            <a href="{{ route('rewards.edit', $reward->id) }}" class="btn btn-sm btn-primary">Edit</a>
            <form action="{{ route('rewards.destroy', $reward->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete this reward?')">Delete</button>
            </form>
        </td>
    </tr>
@endforeach

                                </tbody>
                            </table>
                            <div class="mt-3">
                                {{ $rewards->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>  
</div>
@endsection
