@extends('frontend.layouts.main')

@section('title', 'Horoscope')

@section('content')


    <section>
        <!-- Profile Header -->
        <div class="profile-header">
            <div class="container">
                <h5 style="font-size: 30px;font-weight: 600;">२५ पुष २०८१, विहिबार</h5>
                <p>पुष शुक्ल दशमी<br>पक्ष्य: साध्य गर भरणी</p>
                <p class="mt-2">9th Jan, 2025<br>Evening 05:15</p>
            </div>
        </div>

        <div class="container bg-white mt-3">
            <div class="horoscope-header d-flex justify-content-between align-items-center">
                <h2 class="horoscope-title">Here's the horoscope for today</h2>
                <div class="button-container-horoscope mb-2">
                    <button class="btn btn-outline-primary active" id="dailyBtn">Daily</button>
                    <button class="btn btn-outline-primary" id="weeklyBtn">Weekly</button>
                    <button class="btn btn-outline-primary" id="monthlyBtn">Monthly</button>
                    <button class="btn btn-outline-primary" id="yearlyBtn">Yearly</button>
                </div>
            </div>

            <!-- Horoscope Grid -->
            <div id="daily" class="horoscope-section">
                <!-- English -->
                <div class="row g-3 mt-3">
                    <!-- Horoscope Items (6 per row on large screens) -->
                    <div class="col-lg-1 col-md-2 col-sm-2 col-4">
                        <div class="horoscope-card-wrapper text-center" data-bs-toggle="modal"
                            data-bs-target="#horoscopeModal">
                            <div class="horoscope-card">
                                <img src="img/pic1.png" alt="Taurus" class="img-fluid">
                            </div>
                            <h1>Aries</h1>
                            <p>Mar 19 - Sep 12</p>
                        </div>
                    </div>

                    <div class="col-lg-1 col-md-2 col-sm-2 col-4">
                        <div class="horoscope-card-wrapper text-center" data-bs-toggle="modal"
                            data-bs-target="#horoscopeModal">
                            <div class="horoscope-card">
                                <img src="img/pic2.png" alt="Aries" class="img-fluid">
                            </div>
                            <h1>Aries</h1>
                            <p>Mar 19 - Sep 12</p>
                        </div>
                    </div>

                    <div class="col-lg-1 col-md-2 col-sm-2 col-4">
                        <div class="horoscope-card-wrapper text-center" data-bs-toggle="modal"
                            data-bs-target="#horoscopeModal">
                            <div class="horoscope-card">
                                <img src="img/pic3.png" alt="Gemini" class="img-fluid">
                            </div>
                            <h1>Aries</h1>
                            <p>Mar 19 - Sep 12</p>
                        </div>
                    </div>

                    <div class="col-lg-1 col-md-2 col-sm-2 col-4">
                        <div class="horoscope-card-wrapper text-center" data-bs-toggle="modal"
                            data-bs-target="#horoscopeModal">
                            <div class="horoscope-card">
                                <img src="img/pic4.png" alt="Cancer" class="img-fluid">
                            </div>
                            <h1>Aries</h1>
                            <p>Mar 19 - Sep 12</p>
                        </div>
                    </div>

                    <div class="col-lg-1 col-md-2 col-sm-2 col-4">
                        <div class="horoscope-card-wrapper text-center" data-bs-toggle="modal"
                            data-bs-target="#horoscopeModal">
                            <div class="horoscope-card">
                                <img src="img/pic5.png" alt="Leo" class="img-fluid">
                            </div>
                            <h1>Aries</h1>
                            <p>Mar 19 - Sep 12</p>
                        </div>
                    </div>

                    <div class="col-lg-1 col-md-2 col-sm-2 col-4">
                        <div class="horoscope-card-wrapper text-center" data-bs-toggle="modal"
                            data-bs-target="#horoscopeModal">
                            <div class="horoscope-card">
                                <img src="img/pic6.png" alt="Virgo" class="img-fluid">
                            </div>
                            <h1>Aries</h1>
                            <p>Mar 19 - Sep 12</p>
                        </div>
                    </div>
                    <div class="col-lg-1 col-md-2 col-sm-2 col-4">
                        <div class="horoscope-card-wrapper text-center" data-bs-toggle="modal"
                            data-bs-target="#horoscopeModal">
                            <div class="horoscope-card">
                                <img src="img/pic7.png" alt="Taurus" class="img-fluid">
                            </div>
                            <h1>Aries</h1>
                            <p>Mar 19 - Sep 12</p>
                        </div>
                    </div>

                    <div class="col-lg-1 col-md-2 col-sm-2 col-4">
                        <div class="horoscope-card-wrapper text-center" data-bs-toggle="modal"
                            data-bs-target="#horoscopeModal">
                            <div class="horoscope-card">
                                <img src="img/pic8.png" alt="Aries" class="img-fluid">
                            </div>
                            <h1>Aries</h1>
                            <p>Mar 19 - Sep 12</p>
                        </div>
                    </div>

                    <div class="col-lg-1 col-md-2 col-sm-2 col-4">
                        <div class="horoscope-card-wrapper text-center" data-bs-toggle="modal"
                            data-bs-target="#horoscopeModal">
                            <div class="horoscope-card">
                                <img src="img/pic9.png" alt="Gemini" class="img-fluid">
                            </div>
                            <h1>Aries</h1>
                            <p>Mar 19 - Sep 12</p>
                        </div>
                    </div>

                    <div class="col-lg-1 col-md-2 col-sm-2 col-4">
                        <div class="horoscope-card-wrapper text-center" data-bs-toggle="modal"
                            data-bs-target="#horoscopeModal">
                            <div class="horoscope-card">
                                <img src="img/pic10.png" alt="Cancer" class="img-fluid">
                            </div>
                            <h1>Aries</h1>
                            <p>Mar 19 - Sep 12</p>
                        </div>
                    </div>

                    <div class="col-lg-1 col-md-2 col-sm-2 col-4">
                        <div class="horoscope-card-wrapper text-center" data-bs-toggle="modal"
                            data-bs-target="#horoscopeModal">
                            <div class="horoscope-card">
                                <img src="img/pic11.png" alt="Leo" class="img-fluid">
                            </div>
                            <h1>Aries</h1>
                            <p>Mar 19 - Sep 12</p>
                        </div>
                    </div>

                    <div class="col-lg-1 col-md-2 col-sm-2 col-4">
                        <div class="horoscope-card-wrapper text-center" data-bs-toggle="modal"
                            data-bs-target="#horoscopeModal">
                            <div class="horoscope-card">
                                <img src="img/pic12.png" alt="Virgo" class="img-fluid">
                            </div>
                            <h1>Aries</h1>
                            <p>Mar 19 - Sep 12</p>
                        </div>
                    </div>
                </div>

                <!-- Nepali -->
                <div class="row g-3 mt-3">
                    <!-- Horoscope Items (6 per row on large screens) -->
                    <div class="col-lg-1 col-md-2 col-sm-2 col-4">
                        <div class="horoscope-card-wrapper text-center" data-bs-toggle="modal"
                            data-bs-target="#horoscopeModal">
                            <div class="horoscope-card">
                                <img src="img/pic1.png" alt="Taurus" class="img-fluid">
                            </div>
                            <h1>वृष</h1>
                            <p>(इ, उ, ए, ओ, बा)</p>

                        </div>
                    </div>

                    <div class="col-lg-1 col-md-2 col-sm-2 col-4">
                        <div class="horoscope-card-wrapper text-center" data-bs-toggle="modal"
                            data-bs-target="#horoscopeModal">
                            <div class="horoscope-card">
                                <img src="img/pic2.png" alt="Aries" class="img-fluid">
                            </div>
                            <h1>वृष</h1>
                            <p>(इ, उ, ए, ओ, बा)</p>
                        </div>
                    </div>

                    <div class="col-lg-1 col-md-2 col-sm-2 col-4">
                        <div class="horoscope-card-wrapper text-center" data-bs-toggle="modal"
                            data-bs-target="#horoscopeModal">
                            <div class="horoscope-card">
                                <img src="img/pic3.png" alt="Gemini" class="img-fluid">
                            </div>
                            <h1>वृष</h1>
                            <p>(इ, उ, ए, ओ, बा)</p>
                        </div>
                    </div>

                    <div class="col-lg-1 col-md-2 col-sm-2 col-4">
                        <div class="horoscope-card-wrapper text-center" data-bs-toggle="modal"
                            data-bs-target="#horoscopeModal">
                            <div class="horoscope-card">
                                <img src="img/pic4.png" alt="Cancer" class="img-fluid">
                            </div>
                            <h1>वृष</h1>
                            <p>(इ, उ, ए, ओ, बा)</p>
                        </div>
                    </div>

                    <div class="col-lg-1 col-md-2 col-sm-2 col-4">
                        <div class="horoscope-card-wrapper text-center" data-bs-toggle="modal"
                            data-bs-target="#horoscopeModal">
                            <div class="horoscope-card">
                                <img src="img/pic5.png" alt="Leo" class="img-fluid">
                            </div>
                            <h1>वृष</h1>
                            <p>(इ, उ, ए, ओ, बा)</p>
                        </div>
                    </div>

                    <div class="col-lg-1 col-md-2 col-sm-2 col-4">
                        <div class="horoscope-card-wrapper text-center" data-bs-toggle="modal"
                            data-bs-target="#horoscopeModal">
                            <div class="horoscope-card">
                                <img src="img/pic6.png" alt="Virgo" class="img-fluid">
                            </div>
                            <h1>वृष</h1>
                            <p>(इ, उ, ए, ओ, बा)</p>
                        </div>
                    </div>
                    <div class="col-lg-1 col-md-2 col-sm-2 col-4">
                        <div class="horoscope-card-wrapper text-center" data-bs-toggle="modal"
                            data-bs-target="#horoscopeModal">
                            <div class="horoscope-card">
                                <img src="img/pic7.png" alt="Taurus" class="img-fluid">
                            </div>
                            <h1>वृष</h1>
                            <p>(इ, उ, ए, ओ, बा)</p>
                        </div>
                    </div>

                    <div class="col-lg-1 col-md-2 col-sm-2 col-4">
                        <div class="horoscope-card-wrapper text-center" data-bs-toggle="modal"
                            data-bs-target="#horoscopeModal">
                            <div class="horoscope-card">
                                <img src="img/pic8.png" alt="Aries" class="img-fluid">
                            </div>
                            <h1>वृष</h1>
                            <p>(इ, उ, ए, ओ, बा)</p>
                        </div>
                    </div>

                    <div class="col-lg-1 col-md-2 col-sm-2 col-4">
                        <div class="horoscope-card-wrapper text-center" data-bs-toggle="modal"
                            data-bs-target="#horoscopeModal">
                            <div class="horoscope-card">
                                <img src="img/pic9.png" alt="Gemini" class="img-fluid">
                            </div>
                            <h1>वृष</h1>
                            <p>(इ, उ, ए, ओ, बा)</p>
                        </div>
                    </div>

                    <div class="col-lg-1 col-md-2 col-sm-2 col-4">
                        <div class="horoscope-card-wrapper text-center" data-bs-toggle="modal"
                            data-bs-target="#horoscopeModal">
                            <div class="horoscope-card">
                                <img src="img/pic10.png" alt="Cancer" class="img-fluid">
                            </div>
                            <h1>वृष</h1>
                            <p>(इ, उ, ए, ओ, बा)</p>
                        </div>
                    </div>

                    <div class="col-lg-1 col-md-2 col-sm-2 col-4">
                        <div class="horoscope-card-wrapper text-center" data-bs-toggle="modal"
                            data-bs-target="#horoscopeModal">
                            <div class="horoscope-card">
                                <img src="img/pic11.png" alt="Leo" class="img-fluid">
                            </div>
                            <h1>वृष</h1>
                            <p>(इ, उ, ए, ओ, बा)</p>
                        </div>
                    </div>

                    <div class="col-lg-1 col-md-2 col-sm-2 col-4">
                        <div class="horoscope-card-wrapper text-center" data-bs-toggle="modal"
                            data-bs-target="#horoscopeModal">
                            <div class="horoscope-card">
                                <img src="img/pic12.png" alt="Virgo" class="img-fluid">
                            </div>
                            <h1>वृष</h1>
                            <p>(इ, उ, ए, ओ, बा)</p>
                        </div>
                    </div>
                </div>
            </div>


        </div>



        <!-- Modal for displaying description -->
        <div class="modal fade" id="horoscopeModal" tabindex="-1" aria-labelledby="horoscopeModalLabel"
            aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog modal-dialog-centered"> <!-- Centering modal -->
                <div class="modal-content">
                    <div class="modal-header bg-white position-relative">
                        <div class="d-flex flex-column align-items-start w-100">
                            <div class="d-flex align-items-center">
                                <div class="img-container me-2">
                                    <img alt="Taurus symbol" class="img-fluid" src="img/pic1.png" />
                                </div>
                                <div>
                                    <h5 class="modal-title mb-0" id="horoscopeModalLabel">वृष - Taurus</h5>
                                    <p class="mb-0">इ, उ, ए, ओ, बा, बि, बु, बे, बो</p>
                                </div>
                            </div>
                        </div>
                        <!-- Close button in the top-right corner -->
                        <button type="button" class="btn-close position-absolute top-0 end-0 m-2"
                            data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p class="text-muted-horoscope px-4">
                            बेलामा होस नपुर्याउँदा केही अच्यारा चुनौती आउन सक्छन्
                            फाइदाका पछि लाग्दा आफ्नै धनमाल गुम्न सक्छथ साथीभाइसँग
                            पनि असमझदारी बढ्न सक्छ खर्च बढ्नुकासाथै आर्थिक अभाव
                            देख्न पर्ने समय छ। आयथ लगानीहरु सक्रिय हुनेछन् भने
                            सहयोगी गर्नेहरु कमै भेटिन्छन्। अवसरको खोजिमा केही दौडधुप
                            गर्नुपर्ला धेरै लगानी गर्दा थोरै फाइदा हुनेछ। लगनशीलताले
                            कोटिमानि दिलाउन सक्छ।
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
        <div class="container-fluid banner-horoscope d-flex align-items-center" style="height:272px;">
             <div class="container">
                <div class="overlay">
                    <h4 class="py-3 text-white">Match your Kundli/horoscope</h4>
                    <div class="button-container-horoscope-kundali mb-3">
                        <button class="btn btn-kundali active" id="kundaliBtn">Kundali Matching</button>
                        <button class="btn btn-horoscope" id="horoscopeBtn">Kundali</button>
                    </div>
                </div>
            </div>
        </div>


    <section class="Horoscope">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <!-- Personal-Section -->
                    <div class="Personal-Section" id="Personal-Section">
                        <h1 class="my-4">Enter Your Personal Details</h1>
                        <div class="card mb-5">
                            <div class="card-body">
                                <h5 class="card-title">Person Details</h5>
                                <form>
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Name<span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="name"
                                            placeholder="Enter name" required>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Date of Birth<span class="text-danger">*</span></label>
                                        <div class="row g-2">
                                            <div class="col">
                                                <input type="number" class="form-control" placeholder="Day" required>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" placeholder="Month" required>
                                            </div>
                                            <div class="col">
                                                <input type="number" class="form-control" placeholder="Year" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Time of Birth<span class="text-danger">*</span></label>
                                        <div class="row g-2">
                                            <div class="col">
                                                <input type="number" class="form-control" placeholder="Hour" required>
                                            </div>
                                            <div class="col">
                                                <input type="number" class="form-control" placeholder="Minute" required>
                                            </div>
                                            <div class="col">
                                                <input type="number" class="form-control" placeholder="Second" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="place" class="form-label">Place of Birth<span
                                                class="text-danger">*</span></label>
                                        <select class="form-select" id="place" required>
                                            <option selected disabled>Pokhara, Gandaki Zone</option>
                                        </select>
                                    </div>

                                    <button type="button" class="btn next-match-btn float-end"
                                        id="nextButton1">Next</button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Question -->

                    <div class="Question-Section" id="Question-Section" style="display: none;">
                        <h1 class="pb-3">Enter a Questions to ask</h1>
                        <div class="card mb-5">
                            <div class="card-body">
                                <h5 class="card-title mb-3"><i class="bi bi-chevron-left"
                                        id="backButtonqen1"></i>Question you want to ask out Jyotish</h5>
                                <form>
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Question 1</label>
                                        <input type="text" class="form-control" id="name"
                                            placeholder="Enter name" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Question 2</label>
                                        <input type="text" class="form-control" id="name"
                                            placeholder="Enter name" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Question 3</label>
                                        <input type="text" class="form-control" id="name"
                                            placeholder="Enter name" required>
                                    </div>

                                    <button type="button" class="btn next-match-btn float-end"
                                        id="payButton">Pay</button>
                                </form>
                            </div>
                        </div>
                    </div>





                    <!-- Girls-Section -->
                    <div class="Girls-Section" id="Girls-Section">
                        <h1 class="my-4">Enter Girl’s Birth Details</h1>
                        <div class="card mb-5">
                            <div class="card-body">
                                <h5 class="card-title">Girl’s Details</h5>
                                <form>
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Name<span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="name"
                                            placeholder="Enter name" required>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Date of Birth<span class="text-danger">*</span></label>
                                        <div class="row g-2">
                                            <div class="col">
                                                <input type="number" class="form-control" placeholder="Day" required>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" placeholder="Month" required>
                                            </div>
                                            <div class="col">
                                                <input type="number" class="form-control" placeholder="Year" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Time of Birth<span class="text-danger">*</span></label>
                                        <div class="row g-2">
                                            <div class="col">
                                                <input type="number" class="form-control" placeholder="Hour" required>
                                            </div>
                                            <div class="col">
                                                <input type="number" class="form-control" placeholder="Minute" required>
                                            </div>
                                            <div class="col">
                                                <input type="number" class="form-control" placeholder="Second" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="place" class="form-label">Place of Birth<span
                                                class="text-danger">*</span></label>
                                        <select class="form-select" id="place" required>
                                            <option selected disabled>Pokhara, Gandaki Zone</option>
                                        </select>
                                    </div>

                                    <button type="button" class="btn next-match-btn float-end"
                                        id="nextButton">Next</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Boy-Section -->
                    <div class="Boys-Section" id="Boys-Section">
                        <h1 class="pb-3">Enter Boy’s Birth Details</h1>
                        <div class="card mb-5">
                            <div class="card-body">
                                <h5 class="card-title"><i class="bi bi-chevron-left" id="backButton"></i>Boy’s Details
                                </h5>
                                <form>
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Name<span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="name"
                                            placeholder="Enter name" required>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Date of Birth<span class="text-danger">*</span></label>
                                        <div class="row g-2">
                                            <div class="col">
                                                <input type="number" class="form-control" placeholder="Day" required>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" placeholder="Month"
                                                    required>
                                            </div>
                                            <div class="col">
                                                <input type="number" class="form-control" placeholder="Year"
                                                    required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Time of Birth<span
                                                class="text-danger">*</span></label>
                                        <div class="row g-2">
                                            <div class="col">
                                                <input type="number" class="form-control" placeholder="Hour"
                                                    required>
                                            </div>
                                            <div class="col">
                                                <input type="number" class="form-control" placeholder="Minute"
                                                    required>
                                            </div>
                                            <div class="col">
                                                <input type="number" class="form-control" placeholder="Second"
                                                    required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="place" class="form-label">Place of Birth<span
                                                class="text-danger">*</span></label>
                                        <select class="form-select" id="place" required>
                                            <option selected disabled>Pokhara, Gandaki Zone</option>
                                        </select>
                                    </div>

                                    <button type="button" class="btn next-match-btn float-end"
                                        id="MatchButton">Match</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Question -->
                    <div class="Question-Section" id="Question-Section" style="display: none;">
                        <h1 class="pb-3">Enter Question to ask</h1>
                        <div class="card mb-5">
                            <div class="card-body">
                                <h5 class="card-title mb-3"><i class="bi bi-chevron-left"
                                        id="backButtonqen2"></i>Question you want to ask out Jyotish</h5>
                                <form>
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Question 1</label>
                                        <input type="text" class="form-control" id="name"
                                            placeholder="Enter name" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Question 2</label>
                                        <input type="text" class="form-control" id="name"
                                            placeholder="Enter name" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Question 3</label>
                                        <input type="text" class="form-control" id="name"
                                            placeholder="Enter name" required>
                                    </div>
                                    <button type="button" class="btn next-match-btn float-end"
                                        id="payButton">Pay</button>
                                </form>
                            </div>
                        </div>
                    </div>




                    <!-- payment-section -->
                    <div id="payment-section" class="payment-section" style="display: none;">
                        <h5 class="mb-4"><i id="back-btn" class="bi bi-chevron-left"
                                style="cursor: pointer;"></i> Payment</h5>
                        <h6>Review:</h6>
                        <table class="table table-bordered table-sm">
                            <tbody>
                                <tr>
                                    <td> Jyotish Name</td>
                                    <td>Sagar Timilsina</td>
                                </tr>
                                <tr>
                                    <td> A/C Number</td>
                                    <td>266543212345123456</td>
                                </tr>
                                <tr>
                                    <td> Charge Amount</td>
                                    <td>10,000</td>
                                </tr>
                                <tr>
                                    <td> Discount/ Coupon</td>
                                    <td>0</td>
                                </tr>
                                <tr>
                                    <td> Remarks</td>
                                    <td>remarks dim </td>
                                </tr>
                            </tbody>
                        </table>

                        <h6 class="mt-4"> Select Payment Wallet:</h6>

                        <div class="card card-esewa mb-4 mt-4">
                            <img src="Images/esewa.png" alt="eSewa" class="img-fluid">
                        </div>

                        <button class="btn payment-section-btn mb-5 "><i class="fas fa-credit-card"></i> Pay with eSewa:
                            10,000</button>
                    </div>



                    <div class="Thanks-Section" id="Thanks-Section">
                        <div class="card Thanks-card pt-5 pb-5 mt-5 mb-5 ">
                            <h2 class="text-center">Thanks for filling the form!</h2>
                            <p class="text-center">You will be notified once your kundali is ready!</p>
                            <button class="ok-btn">Ok</button>
                        </div>
                    </div>


                </div>

                <div class="col-lg-4 Jyotish mt-5 ">
                    <h3 class="mb-4">Meet our Jyotish</h3>
                    <img src="frontend\assets\Images\profile.jpg">
                    <p class="mt-3">Pokhara</p>
                    <small class="text-bold">9876543210</small>
                </div>
            </div>
        </div>
        </div>






        </div>
        <style>
            .banner-horoscope {
  background:
    linear-gradient(90deg, rgba(0, 0, 0, 0.3) 30%, rgba(102, 102, 102, 0.3) 100%),
    url("frontend/img/ad.png") center/cover no-repeat;
  color: white;
  width: 100%;
  height: 250px;
            }
            </style>

        <!-- <script>
            document.addEventListener("DOMContentLoaded", function() {
                const buttons = document.querySelectorAll(".button-container-horoscope button");
                const sections = document.querySelectorAll(".horoscope-section");

                // Function to show the selected section and hide others
                function showSection(sectionId) {
                    sections.forEach(section => {
                        section.style.display = "none"; // Hide all sections
                    });

                    document.getElementById(sectionId).style.display = "block"; // Show the selected section

                    buttons.forEach(button => {
                        button.classList.remove("btn-primary", "active");
                        button.classList.add("btn-outline-primary");
                    });




                    // Activate the clicked button
                    document.getElementById(sectionId + "Btn").classList.remove("btn-outline-primary");
                    document.getElementById(sectionId + "Btn").classList.add("btn-primary", "active");
                }

                // Attach event listeners to all buttons
                document.getElementById("dailyBtn").addEventListener("click", () => showSection("daily"));
                document.getElementById("weeklyBtn").addEventListener("click", () => showSection("weekly"));
                document.getElementById("monthlyBtn").addEventListener("click", () => showSection("monthly"));
                document.getElementById("yearlyBtn").addEventListener("click", () => showSection("yearly"));

                // Set default active section
                showSection("daily");
            });

            // Function to show horoscope details in the modal
            function showDescription(title, description) {
                document.getElementById("horoscopeTitle").innerText = title;
                document.getElementById("horoscopeDescription").innerText = description;
            }


            // Show Girls Section in kundali
            document.getElementById("nextButton").addEventListener("click", function(event) {
                event.preventDefault(); // Prevent form submission
                document.getElementById("Girls-Section").style.display = "none"; // Hide Girls Section
                document.getElementById("Boys-Section").style.display = "block"; // Show Boys Section
                document.getElementById("Boys-Section").scrollIntoView({
                    behavior: "smooth"
                });
            });

            // Show Thanks Section
            document.getElementById("MatchButton").addEventListener("click", function(event) {
                event.preventDefault(); // Prevent form submission
                document.getElementById("Girls-Section").style.display = "none"; // Hide Girls Section
                document.getElementById("Boys-Section").style.display = "none"; // Hide Boys Section
                document.getElementById("Question-Section").style.display = "block"; // Show Thanks Section
                document.getElementById("Question-Section").scrollIntoView({
                    behavior: "smooth"
                });
            });

            // Go back to Girls Section when clicking the arrow icon
            document.getElementById("backButton").addEventListener("click", function(event) {
                event.preventDefault(); // Prevent default action
                document.getElementById("Girls-Section").style.display = "block"; // Show Girls Section
                document.getElementById("Boys-Section").style.display = "none"; // Hide Boys Section
                document.getElementById("Girls-Section").scrollIntoView({
                    behavior: "smooth"
                });
            });

            document.querySelector(".ok-btn").addEventListener("click", function(event) {
                event.preventDefault(); // Prevent any default behavior of the button
                document.getElementById("Thanks-Section").style.display = "none"; // Hide the Thanks Section
                document.getElementById("Girls-Section").style.display = "block"; // Show the Girls Section
                document.getElementById("Girls-Section").scrollIntoView({
                    behavior: "smooth"
                }); // Scroll to Girls Section
            });


            // Kundali & Horoscope btn
            document.addEventListener("DOMContentLoaded", function() {
                const kundaliBtn = document.getElementById("kundaliBtn");
                const horoscopeBtn = document.getElementById("horoscopeBtn");
                const girlsSection = document.getElementById("Girls-Section");
                const boysSection = document.getElementById("Boys-Section");
                const personalDetailsSection = document.getElementById("Personal-Section");
                const paymentSection = document.getElementById("payment-section");
                const questionSection = document.getElementById("Question-Section");

                // Initially show only the Girls-Section and hide Personal-Section
                function showSection(activeSection) {
                    girlsSection.style.display = activeSection === girlsSection ? "block" : "none";
                    boysSection.style.display = activeSection === boysSection ? "block" : "none";
                    personalDetailsSection.style.display = activeSection === personalDetailsSection ? "block" : "none";
                    paymentSection.style.display = activeSection === paymentSection ? "block" : "none";
                    questionSection.style.display = activeSection === questionSection ? "block" : "none";
                }

                function toggleActiveButton(activeBtn, inactiveBtn) {
                    activeBtn.classList.add("active");
                    inactiveBtn.classList.remove("active");
                }

                kundaliBtn.addEventListener("click", function() {
                    toggleActiveButton(kundaliBtn, horoscopeBtn);
                    showSection(girlsSection);
                });

                horoscopeBtn.addEventListener("click", function() {
                    toggleActiveButton(horoscopeBtn, kundaliBtn);
                    showSection(personalDetailsSection);
                    personalDetailsSection.scrollIntoView({
                        behavior: "smooth"
                    });
                });

                // Show only the initial section on load
                showSection(girlsSection);
            });


            document.getElementById("nextButton1").addEventListener("click", function(event) {
                event.preventDefault(); // Prevent form submission
                document.getElementById("Personal-Section").style.display = "none"; // Hide Girls Section
                document.getElementById("Question-Section").style.display = "block"; // Show Boys Section
                document.getElementById("Question-Section").scrollIntoView({
                    behavior: "smooth"
                });
            });


            // Go back to personal when clicking the arrow icon
            document.getElementById("backButtonqen2").addEventListener("click", function(event) {
                event.preventDefault(); // Prevent default action
                document.getElementById("Boys-Section").style.display = "block"; // Show Girls Section
                document.getElementById("Question-Section").style.display = "none"; // Hide Boys Section
                document.getElementById("Boys-Section").scrollIntoView({
                    behavior: "smooth"
                });

            });

            // Go back to personal when clicking the arrow icon
            document.getElementById("backButtonqen1").addEventListener("click", function(event) {
                event.preventDefault(); // Prevent default action
                document.getElementById("Personal-Section").style.display = "block"; // Show Girls Section
                document.getElementById("Question-Section").style.display = "none"; // Hide Boys Section
                document.getElementById("Personal-Section").scrollIntoView({
                    behavior: "smooth"
                });

            });

            // Show Thanks Section
            document.getElementById("MatchButton").addEventListener("click", function(event) {
                event.preventDefault(); // Prevent form submission
                document.getElementById("Girls-Section").style.display = "none"; // Hide Girls Section
                document.getElementById("Boys-Section").style.display = "none"; // Hide Boys Section
                document.getElementById("Question-Section").style.display = "block"; // Show Thanks Section
                document.getElementById("Question-Section").scrollIntoView({
                    behavior: "smooth"
                });
            });


            document.getElementById("payButton").addEventListener("click", function(event) {
                event.preventDefault(); // Prevent form submission
                document.getElementById("Girls-Section").style.display = "none"; // Hide Girls Section
                document.getElementById("Boys-Section").style.display = "none"; // Hide Boys Section
                document.getElementById("Question-Section").style.display = "none"; // Show Thanks Section
                document.getElementById("payment-section").style.display = "block"; // Show Thanks Section
                document.getElementById("payment-section").scrollIntoView({
                    behavior: "smooth"
                });
            });

            document.getElementById("back-btn").addEventListener("click", function(event) {
                event.preventDefault(); // Prevent default action

                // Show the Question Section
                document.getElementById("Question-Section").style.display = "block";

                // Hide the Payment Section
                document.getElementById("payment-section").style.display = "none";

                // Scroll to the Question Section smoothly
                document.getElementById("Question-Section").scrollIntoView({
                    behavior: "smooth"
                });
            });
        </script> -->


        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const buttons = document.querySelectorAll(".button-container-horoscope button");
                const sections = document.querySelectorAll(".horoscope-section");

                // Function to show the selected section and hide others
                function showSection(sectionId) {
                    sections.forEach(section => {
                        section.style.display = "none"; // Hide all sections
                    });

                    document.getElementById(sectionId).style.display = "block"; // Show the selected section

                    buttons.forEach(button => {
                        button.classList.remove("btn-primary", "active");
                        button.classList.add("btn-outline-primary");
                    });

                    // Activate the clicked button
                    document.getElementById(sectionId + "Btn").classList.remove("btn-outline-primary");
                    document.getElementById(sectionId + "Btn").classList.add("btn-primary", "active");
                }

                // Attach event listeners to all buttons
                document.getElementById("dailyBtn").addEventListener("click", () => showSection("daily"));
                document.getElementById("weeklyBtn").addEventListener("click", () => showSection("weekly"));
                document.getElementById("monthlyBtn").addEventListener("click", () => showSection("monthly"));
                document.getElementById("yearlyBtn").addEventListener("click", () => showSection("yearly"));

                // Set default active section
                showSection("daily");
            });

            // Function to show horoscope details in the modal
            function showDescription(title, description) {
                document.getElementById("horoscopeTitle").innerText = title;
                document.getElementById("horoscopeDescription").innerText = description;
            }

            // Show Boys Section in Kundali
            document.getElementById("nextButton").addEventListener("click", function(event) {
                event.preventDefault(); // Prevent form submission
                document.getElementById("Girls-Section").style.display = "none"; // Hide Girls Section
                document.getElementById("Boys-Section").style.display = "block"; // Show Boys Section
                document.getElementById("Boys-Section").scrollIntoView({
                    behavior: "smooth"
                });
            });

            // Show Thanks Section
            document.getElementById("MatchButton").addEventListener("click", function(event) {
                event.preventDefault(); // Prevent form submission
                document.getElementById("Girls-Section").style.display = "none"; // Hide Girls Section
                document.getElementById("Boys-Section").style.display = "none"; // Hide Boys Section
                document.getElementById("Question-Section").style.display = "block"; // Show Question Section
                document.getElementById("Question-Section").scrollIntoView({
                    behavior: "smooth"
                });
            });

            // Go back to Girls Section when clicking the arrow icon
            document.getElementById("backButton").addEventListener("click", function(event) {
                event.preventDefault();
                document.getElementById("Girls-Section").style.display = "block";
                document.getElementById("Boys-Section").style.display = "none";
                document.getElementById("Girls-Section").scrollIntoView({
                    behavior: "smooth"
                });
            });

            document.querySelector(".ok-btn").addEventListener("click", function(event) {
                event.preventDefault();
                document.getElementById("Thanks-Section").style.display = "none";
                document.getElementById("Girls-Section").style.display = "block";
                document.getElementById("Girls-Section").scrollIntoView({
                    behavior: "smooth"
                });
            });

            // Kundali & Horoscope Buttons
            document.addEventListener("DOMContentLoaded", function() {
                const kundaliBtn = document.getElementById("kundaliBtn");
                const horoscopeBtn = document.getElementById("horoscopeBtn");
                const girlsSection = document.getElementById("Girls-Section");
                const boysSection = document.getElementById("Boys-Section");
                const personalDetailsSection = document.getElementById("Personal-Section");
                const paymentSection = document.getElementById("payment-section");
                const questionSection = document.getElementById("Question-Section");

                function showSection(activeSection) {
                    girlsSection.style.display = activeSection === girlsSection ? "block" : "none";
                    boysSection.style.display = activeSection === boysSection ? "block" : "none";
                    personalDetailsSection.style.display = activeSection === personalDetailsSection ? "block" : "none";
                    paymentSection.style.display = activeSection === paymentSection ? "block" : "none";
                    questionSection.style.display = activeSection === questionSection ? "block" : "none";
                }

                function toggleActiveButton(activeBtn, inactiveBtn) {
                    activeBtn.classList.add("active");
                    inactiveBtn.classList.remove("active");
                }

                kundaliBtn.addEventListener("click", function() {
                    toggleActiveButton(kundaliBtn, horoscopeBtn);
                    showSection(girlsSection);
                });

                horoscopeBtn.addEventListener("click", function() {
                    toggleActiveButton(horoscopeBtn, kundaliBtn);
                    showSection(personalDetailsSection);
                    personalDetailsSection.scrollIntoView({
                        behavior: "smooth"
                    });
                });

                // Show only the initial section on load
                showSection(girlsSection);
            });

            // Navigate to Question Section
            document.getElementById("nextButton1").addEventListener("click", function(event) {
                event.preventDefault();
                document.getElementById("Personal-Section").style.display = "none";
                document.getElementById("Question-Section").style.display = "block";
                document.getElementById("Question-Section").scrollIntoView({
                    behavior: "smooth"
                });
            });

            // Back to Personal Section from Question Section
            document.getElementById("backButtonqen1").addEventListener("click", function(event) {
                event.preventDefault();
                document.getElementById("Personal-Section").style.display = "block";
                document.getElementById("Question-Section").style.display = "none";
                document.getElementById("Personal-Section").scrollIntoView({
                    behavior: "smooth"
                });
            });

            // Back to Boys Section from Question Section
            document.getElementById("backButtonqen2").addEventListener("click", function(event) {
                event.preventDefault();
                document.getElementById("Boys-Section").style.display = "block";
                document.getElementById("Question-Section").style.display = "none";
                document.getElementById("Boys-Section").scrollIntoView({
                    behavior: "smooth"
                });
            });

            // Show Payment Section when Pay Button is Clicked
            document.getElementById("payButton").addEventListener("click", function(event) {
                event.preventDefault();
                document.getElementById("Girls-Section").style.display = "none";
                document.getElementById("Boys-Section").style.display = "none";
                document.getElementById("Question-Section").style.display = "none";
                document.getElementById("payment-section").style.display = "block";
                document.getElementById("payment-section").scrollIntoView({
                    behavior: "smooth"
                });
            });

            // Back to Question Section from Payment Section
            document.getElementById("back-btn").addEventListener("click", function(event) {
                event.preventDefault();
                document.getElementById("Question-Section").style.display = "block";
                document.getElementById("payment-section").style.display = "none";
                document.getElementById("Question-Section").scrollIntoView({
                    behavior: "smooth"
                });
            });
        </script>
    @endsection
