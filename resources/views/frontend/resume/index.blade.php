@extends('frontend.layouts.main')
@section('title')
    Resume Help
@endsection
@section('content')
    <div class="container-fluid text-white mt-5" style="background-color: #0064A7">
        <div class="container py-4">
            <h3>"Land Your Dream Job with a Standout Resume!"</h3>
            <p>"Your resume is your first impression—make it count! Discover expert tips, customizable templates,
                and career-boosting advice to create a standout resume tailored to your goals. Whether you're just
                starting out or advancing your career, we've got you covered. Let’s turn your dream job into
                reality. Get started today!"</p>
        </div>
    </div>
    <section class="resume-Subscribe mb-4" id="resume-Subscribe" style="display: none;">

        <div class="container">
            <h2 class="my-4 "><i class="bi bi-chevron-left p-2" onclick="toggleContent(0)" style="cursor: pointer;"></i> Subscribe Plan</h2>
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-3">
                <div class="col">
                    <div class=" border border-1 border-dark rounded-3 px-3 py-4 text-center">
                        <h3>Basic</h3>
                        <p>1 Month - 5 Template Access</p>
                        <h2 style="color: #0064A7;">Rs 299</h2>

                        <ul class="text-start my-4">
                            <li>5 Premium Resume Templates</li>
                            <li>PDF Download Option</li>
                            <li>PDF Download Option</li>
                            <li>PDF Download Option</li>
                            <li>PDF Download Option</li>
                        </ul>
                        <button class="btn btn-primary w-100" style="background-color: #0064A7;">Subscribe</button>
                    </div>
                </div>
                <div class="col">
                    <div class=" border border-1 border-dark rounded-3 px-3 py-4 text-center">
                        <h3>Basic</h3>
                        <p>1 Month - 5 Template Access</p>
                        <h2 style="color: #0064A7;">Rs 299</h2>
                        <ul class="text-start my-4">
                            <li>5 Premium Resume Templates</li>
                            <li>PDF Download Option</li>
                            <li>PDF Download Option</li>
                            <li>PDF Download Option</li>
                            <li>PDF Download Option</li>
                        </ul>
                        <button class="btn btn-primary w-100" style="background-color: #0064A7;">Subscribe</button>
                    </div>
                </div>
                <div class="col">
                    <div class=" border border-1 border-dark rounded-3 px-3 py-4 text-center">
                        <h3>Basic</h3>
                        <p>1 Month - 5 Template Access</p>
                        <h2 style="color: #0064A7;">Rs 299</h2>
                        <ul class="text-start my-4">
                            <li>5 Premium Resume Templates</li>
                            <li>PDF Download Option</li>
                            <li>PDF Download Option</li>
                            <li>PDF Download Option</li>
                            <li>PDF Download Option</li>
                        </ul>
                        <button class="btn btn-primary w-100" style="background-color: #0064A7;">Subscribe</button>
                    </div>
                </div>
                <div class="col">
                    <div class=" border border-1 border-dark rounded-3 px-3 py-4 text-center">
                        <h3>Basic</h3>
                        <p>1 Month - 5 Template Access</p>
                        <h2 style="color: #0064A7;">Rs 299</h2>
                        <ul class="text-start my-4 ">
                            <li>5 Premium Resume Templates</li>
                            <li>PDF Download Option</li>
                            <li>PDF Download Option</li>
                            <li>PDF Download Option</li>
                            <li>PDF Download Option</li>
                        </ul>
                        <button class="btn btn-primary w-100" style="background-color: #0064A7;">Subscribe</button>
                    </div>
                </div>
            </div>
        </div>

    </section>


    <section class="resume-main" id="resume-main">


        <div class="container d-flex align-items-center justify-content-between mt-4">
            <h4 class="me-3">Resume help</h4>
            <button onclick="toggleContent(1)" class="btn-create fw-semibold d-inline-block text-center px-4 py-2"
                style="width: 200px; height: 40px; text-decoration: none;">
                Subscribe Plans
            </button>
        </div>

        <div class="container mt-3">
            <h4>Free Template</h4>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card p-2 position-relative text-dark rounded-2 p-3 overflow-hidden resume-card shadow-sm">
                        <p class="fw-bold fs-5 mb-1 text-dark">Title</p>
                        <p>Sint illum quibusdam est. Ducimus incidunt praesentium natus autem ad veniam.</p>
                        <img src="{{ asset('frontend/assets/Images/img' . '/cv-1.png') }}" class="img-fluid rounded mb-4"
                            alt="Free Template 1">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card p-2 position-relative text-dark rounded-2 p-3 overflow-hidden resume-card shadow-sm">
                        <p class="fw-bold fs-5 mb-1 text-dark">Title</p>
                        <p>Sint illum quibusdam est. Ducimus incidunt praesentium natus autem ad veniam.</p>
                        <img src="{{ asset('frontend/assets/Images/img' . '/cv-2.png') }}" class="img-fluid rounded mb-4"
                            alt="Free Template 2">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card p-2 position-relative text-dark rounded-2 p-3 overflow-hidden resume-card shadow-sm">
                        <p class="fw-bold fs-5 mb-1 text-dark">Title</p>
                        <p>Sint illum quibusdam est. Ducimus incidunt praesentium natus autem ad veniam.</p>
                        <img src="{{ asset('frontend/assets/Images/img' . '/cv-3.png') }}" class="img-fluid rounded mb-4"
                            alt="Free Template 3">
                    </div>
                </div>
            </div>

            <style>
                .resume-card {
                    background: #87CEEB;
                    transition: transform 0.3s ease;
                    overflow: hidden;
                }

                .cv-overlay {
                    position: absolute;
                    width: 70%;
                    height: 50%;
                    top: 50%;
                    left: 50%;
                    transform: translate(-50%, -50%);
                    background: rgba(255, 255, 255, 0.9);
                    display: flex;
                    justify-content: center;
                    flex-direction: column;
                    opacity: 0;
                    border-radius: 10px;
                    transition: opacity 0.3s ease;
                }

                .resume-card:hover .cv-overlay {
                    opacity: 1;
                }

                .cv-overlay h3 {
                    color: #0064A7;
                    font-weight: bold;
                }

                .cv-overlay p {
                    font-size: 14px;
                    margin-bottom: 5px;
                    align-items: start !important;
                }

                .cv-overlay .lock-icon {
                    color: #0064A7;
                }

                .btn-create {
                    height: 50px;
                    width: 100%;
                    background-color: #0064A7;
                    color: white;
                    font-size: 1rem;
                    border-radius: 8px;
                    border: none;
                    margin-top: 15px;
                }

                .btn-create:hover {
                    background-color: #005283;
                }
            </style>
            <div class="container mt-5">
                <h4 class="mt-5">Premium Template</h4>
                <div class="row g-4">
                    <div class="col-md-4">
                        <div
                            class="card position-relative text-dark rounded-2 p-3 overflow-hidden position-relative text-dark rounded-2 p-3 overflow-hidden resume-card shadow-sm">
                            <p class="fw-bold fs-5 mb-1 text-dark">Title </p>
                            <p>Sint illum quibusdam est. Ducimus incidunt praesentium natus autem ad veniam.</p>
                            <img src="{{ asset('frontend/assets/Images/img' . '/cv-p.png') }}" class="img-fluid rounded mb-4"
                                alt="Premium Template 1">
                            <div class="cv-overlay">
                                <div class="lock-icon d-flex justify-content-center mb-3">
                                    <i class="fas fa-lock fa-2x"></i>
                                </div>
                                <div class="text-center">
                                    <h3>Rs 999</h3>
                                    <p>One-time purchase</p>
                                </div>
                                <p class="d-flex align-items-center ms-4">
                                    <i class="bi bi-check-circle text-success me-2"></i> Instant Download
                                </p>
                                <p class="d-flex align-items-center ms-4">
                                    <i class="bi bi-check-circle text-success me-2"></i> ATS-Friendly Format
                                </p>
                                <p class="d-flex align-items-center ms-4">
                                    <i class="bi bi-check-circle text-success me-2"></i> Easy to Customize
                                </p>
                                <div class="d-flex justify-content-center">
                                    <button class="btn-create px-4 py-2 w-auto h-auto">Purchase
                                        Template</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card position-relative text-dark rounded-2 p-3 overflow-hidden resume-card shadow-sm">
                            <p class="fw-bold fs-5 mb-1 text-dark">Title</p>
                            <p>Sint illum quibusdam est. Ducimus incidunt praesentium natus autem ad veniam.</p>
                            <img src="{{ asset('frontend/assets/Images/img' . '/cv-p.png') }}" class="img-fluid rounded mb-4"
                                alt="Premium Template 2">
                            <div class="cv-overlay">
                                <div class="lock-icon d-flex justify-content-center mb-3">
                                    <i class="fas fa-lock fa-2x"></i>
                                </div>
                                <div class="text-center">
                                    <h3>Rs 999</h3>
                                    <p>One-time purchase</p>
                                </div>
                                <p class="d-flex align-items-center ms-4">
                                    <i class="bi bi-check-circle text-success me-2"></i> Instant Download
                                </p>
                                <p class="d-flex align-items-center ms-4">
                                    <i class="bi bi-check-circle text-success me-2"></i> ATS-Friendly Format
                                </p>
                                <p class="d-flex align-items-center ms-4">
                                    <i class="bi bi-check-circle text-success me-2"></i> Easy to Customize
                                </p>
                                <div class="d-flex justify-content-center">
                                    <button class="btn-create px-4 py-2 w-auto h-auto">Purchase
                                        Template</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card position-relative text-dark rounded-2 p-3 overflow-hidden resume-card shadow-sm">
                            <p class="fw-bold fs-5 mb-1 text-dark">Title</p>
                            <p>Sint illum quibusdam est. Ducimus incidunt praesentium natus autem ad veniam.</p>
                            <img src="{{ asset('frontend/assets/Images/img' . '/cv-p.png') }}"
                                class="img-fluid rounded mb-4" alt="Premium Template 3">
                            <div class="cv-overlay">
                                <div class="lock-icon d-flex justify-content-center mb-3">
                                    <i class="fas fa-lock fa-2x"></i>
                                </div>
                                <div class="text-center">
                                    <h3>Rs 999</h3>
                                    <p>One-time purchase</p>
                                </div>
                                <p class="d-flex align-items-center ms-4">
                                    <i class="bi bi-check-circle text-success me-2"></i> Instant Download
                                </p>
                                <p class="d-flex align-items-center ms-4">
                                    <i class="bi bi-check-circle text-success me-2"></i> ATS-Friendly Format
                                </p>
                                <p class="d-flex align-items-center ms-4">
                                    <i class="bi bi-check-circle text-success me-2"></i> Easy to Customize
                                </p>
                                <div class="d-flex justify-content-center">
                                    <button class="btn-create px-4 py-2 w-auto h-auto">Purchase
                                        Template</button>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-4">
                        <div class="card position-relative text-dark rounded-2 p-3 overflow-hidden resume-card shadow-sm">
                            <p class="fw-bold fs-5 mb-1 text-dark">Title</p>
                            <p>Sint illum quibusdam est. Ducimus incidunt praesentium natus autem ad veniam.</p>
                            <img src="{{ asset('frontend/assets/Images/img' . '/cv-p.png') }}"
                                class="img-fluid rounded mb-4" alt="Premium Template 1">
                            <div class="cv-overlay">
                                <div class="lock-icon d-flex justify-content-center mb-3">
                                    <i class="fas fa-lock fa-2x"></i>
                                </div>
                                <div class="text-center">
                                    <h3>Rs 999</h3>
                                    <p>One-time purchase</p>
                                </div>
                                <p class="d-flex align-items-center ms-4">
                                    <i class="bi bi-check-circle text-success me-2"></i> Instant Download
                                </p>
                                <p class="d-flex align-items-center ms-4">
                                    <i class="bi bi-check-circle text-success me-2"></i> ATS-Friendly Format
                                </p>
                                <p class="d-flex align-items-center ms-4">
                                    <i class="bi bi-check-circle text-success me-2"></i> Easy to Customize
                                </p>
                                <div class="d-flex justify-content-center">
                                    <button class="btn-create px-4 py-2 w-auto h-auto">Purchase
                                        Template</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card position-relative text-dark rounded-2 p-3 overflow-hidden resume-card shadow-sm">
                            <p class="fw-bold fs-5 mb-1 text-dark">Title</p>
                            <p>Sint illum quibusdam est. Ducimus incidunt praesentium natus autem ad veniam.</p>
                            <img src="{{ asset('frontend/assets/Images/img' . '/cv-p.png') }}"
                                class="img-fluid rounded mb-4" alt="Premium Template 1">
                            <div class="cv-overlay">
                                <div class="lock-icon d-flex justify-content-center mb-3">
                                    <i class="fas fa-lock fa-2x"></i>
                                </div>
                                <div class="text-center">
                                    <h3>Rs 999</h3>
                                    <p>One-time purchase</p>
                                </div>
                                <p class="d-flex align-items-center ms-4">
                                    <i class="bi bi-check-circle text-success me-2"></i> Instant Download
                                </p>
                                <p class="d-flex align-items-center ms-4">
                                    <i class="bi bi-check-circle text-success me-2"></i> ATS-Friendly Format
                                </p>
                                <p class="d-flex align-items-center ms-4">
                                    <i class="bi bi-check-circle text-success me-2"></i> Easy to Customize
                                </p>
                                <div class="d-flex justify-content-center">
                                    <button class="btn-create px-4 py-2 w-auto h-auto">Purchase
                                        Template</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card position-relative text-dark rounded-2 p-3 overflow-hidden resume-card shadow-sm">
                            <p class="fw-bold fs-5 mb-1 text-dark">Title</p>
                            <p>Sint illum quibusdam est. Ducimus incidunt praesentium natus autem ad veniam.</p>
                            <img src="{{ asset('frontend/assets/Images/img' . '/cv-p.png') }}"
                                class="img-fluid rounded mb-4" alt="Premium Template 1">
                            <div class="cv-overlay">
                                <div class="lock-icon d-flex justify-content-center mb-3">
                                    <i class="fas fa-lock fa-2x"></i>
                                </div>
                                <div class="text-center">
                                    <h3>Rs 999</h3>
                                    <p>One-time purchase</p>
                                </div>
                                <p class="d-flex align-items-center ms-4">
                                    <i class="bi bi-check-circle text-success me-2"></i> Instant Download
                                </p>
                                <p class="d-flex align-items-center ms-4">
                                    <i class="bi bi-check-circle text-success me-2"></i> ATS-Friendly Format
                                </p>
                                <p class="d-flex align-items-center ms-4">
                                    <i class="bi bi-check-circle text-success me-2"></i> Easy to Customize
                                </p>
                                <div class="d-flex justify-content-center">
                                    <button class="btn-create px-4 py-2 w-auto h-auto">Purchase
                                        Template</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection


@push('scripts')
    <script>
        let resumeMain = document.getElementById('resume-main')
        let resumeSubscription = document.getElementById('resume-Subscribe')


        const toggleContent = (i) => {
            console.log(i)
            if (i == 1) {
                resumeMain.style.display = 'none';
                resumeSubscription.style.display = 'block';
            } else {
                resumeMain.style.display = 'block';
                resumeSubscription.style.display = 'none';
            }
        }
    </script>
@endpush
