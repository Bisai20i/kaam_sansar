 <main class="d-flex flex-column flex-grow-1 justify-content-center align-items-center bg-white text-center py-5">
  <div class="text-primary display-3 mb-4 mt-5">
    <i class="fas fa-exclamation-triangle"></i>
  </div>

  <h1 class="fs-2 fw-semibold mb-3">Result Not Found</h1>
  <p class="text-secondary">We couldn’t find the result you are searching.</p>
  <p class="text-secondary mb-4">Please try navigating using the options below.</p>

  <div class="container">
    <div class="row justify-content-center gx-3">
      <div class="col-lg-2 col-sm-3 col-md-4">
        <button class="btn-create w-100 d-flex align-items-center justify-content-center gap-3">
          <i class="fas fa-arrow-left ms-2"></i>
          <a href="{{ url()->previous() }}" class="me-1 fw-semibold text-decoration-none text-white">Go Back</a>
        </button>
      </div>
      <div class="col-lg-2 col-sm-3 col-md-4">
        <button class="btn-create w-100 d-flex align-items-center justify-content-center gap-2">
          <i class="fas fa-home ms-2"></i>
          <a href="{{ route('index') }}" class="me-1 fw-semibold text-decoration-none text-white">Homepage</a>
        </button>
      </div>
    </div>
  </div>
</main>