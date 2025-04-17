@extends('backend.layouts.main')

@section('title', 'Dashboard')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">

        {{ Auth::guard('admin')->user() }}
    </div>
@endsection
