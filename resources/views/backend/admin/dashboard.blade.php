@extends('backend.layouts.main')

@section('title', 'Dashboard')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    @if(Auth::guard('admin')->check() && Auth::guard('admin')->user()->hasRole('admin'))
        <h1>Welcome,  Admin!</h1>
        <p>This is the  Admin Dashboard.</p>

        
    @else
        <h1>Unauthorized Access</h1>
        <p>You do not have the necessary permissions to access this page.</p>
    @endif
</div>
@endsection
