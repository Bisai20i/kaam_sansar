@extends('backend.layouts.main')

@section('title', 'Resume Helps List')

@section('content')

    <style>
        .btn-sm.active {
            border-color: rgb(43, 167, 132);
            background-color: rgb(66, 73, 107);
            color: white;
            border-width: 4px;
            /* Thicker border */

        }
    </style>

    <div class="container py-4">
        <h4 class="fw-bold m-4">Resume Helps List</h4>

        <div class="card shadow">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="card-title">Resume Help Details</h4>
                    </div>
                    <div>
                        <a href="{{ route('resume-help.create') }}" class="btn btn-primary btn-sm text-white">Add Resume
                            Help</a>
                    </div>
                </div>
            </div>
            <div class="card-body">

                <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">

                    <a href="{{ route('resume-help.create') }}" class="btn btn-primary mb-3">Add Resume</a>
                    <table class="table table-bordered">
                        <thead>
                            <tr style="color:rgb(244, 254, 242)">
                                <th>Title</th>
                                <th>Short Description</th>
                                <th>Price</th>
                                <th>Sell Price</th>
                                <th>Type</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($resumeHelps as $resume)
                                <tr style="background: {{ $resume->publish_not_publish ?'rgb(244, 254, 242)' :' rgb(254, 242, 242)' }};">
                                    <td>{{ $resume->title }}</td>
                                    <td>{{ $resume->short_desc }}</td>
                                    <td>${{ $resume->normal_price }}</td>
                                    <td>${{ $resume->sell_price }}</td>
                                    <td>{{ $resume->type ? 'Premium' : 'Free' }}</td>
                                    <td>
                                        <a href="{{ route('resume-help.edit', $resume->id) }}"
                                            class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('resume-help.destroy', $resume->id) }}" method="POST"
                                            style="display:inline;">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Are you sure?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
@endsection
