@extends('frontend.insurance.index')

@section('insurance_content')

<!-- Insurance Body -->
<section class="insurance">
    <div class="container">
      <h2 class="text-center my-4">Choose a Company You Trust</h2>
      <div class="row gap-4 justify-content-center pb-5">

        @if($companies->count() > 0)

        @foreach($companies as $company)

            <div class=" col-lg-4 col-md-5 col-sm-4 col-12 insurance-box " style=" background:
            linear-gradient(rgba(0, 100, 167, 0) 0%, rgba(0, 100, 167, 1) 150%),
            url({{ $company->thumbnail? $company->thumbnail : asset('frontend/assets/Images/image1.jpg') }});">
            <a href="{{ route('insurance.categories', ['id' => $company->id]) }}" class="insurance-link">{{ $company->name }}</a>
            </div>


        @endforeach

        @else

        <p class="w-100 text-center text-muted my-4">Insurance Companies Not Found</p>

        @endif
        
      </div>
    </div>
  </section>

@endsection