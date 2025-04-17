@extends('backend.layouts.main')

@section('title', 'Ads Manager List')

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
        <h4 class="fw-bold m-4">Ads Manager List</h4>

        <div class="card shadow">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        {{-- <h4 class="card-title">Ads Manager Details</h4> --}}
                    </div>
                    <div>
                        <a href="{{ route('ads-manager.create') }}" class="btn btn-primary btn-sm text-white">Ads Manager
                            </a>
                    </div>
                </div>
            </div>
            <div class="card-body">

                <div class="container">
                    <a href="{{ route('ads-manager.create') }}" class="btn btn-primary mb-3">Add New Ad</a>


                    @if (session('success'))
                    <div class="col-md-6">
                        <div class="alert alert-success">{{ session('success') }}</div>
                    </div>
                    @endif

                    <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
                        <table class="table table-bordered">
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Link</th>
                                <th>Page</th>
                                <th>Position</th>
                                <th>Publish</th>
                                <th>Active</th>
                                <th>Image</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($ads as $ad)
                                <tr>
                                    <td>{{ $ad->id }}</td>
                                    <td>{{ $ad->title }}</td>
                                    <td><a href="{{ $ad->link }}" target="_blank">{{ $ad->link }}</a></td>
                                    <td>{{ $ad->which_page }}</td>
                                    <td>{{ ucfirst($ad->position) }}</td>
                                    <td>{{ $ad->publish_or_not ? 'Yes' : 'No' }}</td>
                                    <td>{{ $ad->active ? 'Active' : 'Inactive' }}</td>
                                    <td>
                                        @if ($ad->image)
                                            <img src="{{ asset('storage/' . $ad->image) }}" width="100">
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('ads-manager.edit', $ad->id) }}"
                                            class="btn btn-primary btn-sm">Edit</a>
                                        <form action="{{ route('ads-manager.destroy', $ad->id) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
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
