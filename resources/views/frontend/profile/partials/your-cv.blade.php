@extends('frontend.profile.jobseeker-dashboard')

@section('profileSection')

<div id="yourCV" class="content-section">
  

  <div class="profile-section border">
    <div class="container d-flex justify-content-end px-4 my-3">
        <a href="{{ route('jobseeker.resume-maker') }}" class="text-decoration-none d-flex align-items-center">
          <i class="fas fa-edit text-primary me-1"></i>
          <span class="text-primary fw-bold">Edit CV</span>
        </a>
      </div>
    <div class="card-container  py-3 px-4 ">
      
      <div class="CV-card border" >

        <div class="cv-card border p-3 position-relative">
          <!-- Edit CV at Top Right -->


          <!-- CV Content -->
          <h5 class="text-start">Phil Dunphy</h5>
          <img src="{{ asset('frontend/assets/Images/cv-img.jpg') }}" alt="" />
          <br>
          <h2>Realtor</h2>

          <h1>About</h1>
          <p>It is a long established fact that a reader will be distracted by the readable content of a page when
            looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal
            distribution of letters, as opposed to using 'Content here, content here', making it look like
            readable English.</p>

          <h1>Education</h1>
          <p>California University</p>

          <h1>Projects</h1>
          <p>California University</p>

          <h1>Skills</h1>
          <ul>
            <li>California University</li>
            <li>California University</li>
            <li>California University</li>
          </ul>

          <h1>Achievement</h1>
          <ul>
            <li>California University</li>
            <li>California University</li>
          </ul>

          <h1>Experience</h1>
          <p>California University</p>

          <h1>Language</h1>
          <ul>
            <li>California University</li>
            <li>California University</li>
          </ul>
        </div>
      </div>

    </div>
  </div>

</div>

@endsection