@extends('frontend.layouts.main')

@section('title', 'Horoscope')

@section('content')


<section>
    <!-- Profile Header -->
    <div class="profile-header pb-1">
        <div class="container">
            <div class="row g-4 align-items-start">
                <!-- Date Section -->
                <div class="col-12 col-md-8 col-lg-9 mb-3">
                    <h5 style="font-size: 24px; font-weight: 600;">२५ पुष २०८१, विहिबार</h5>
                    <p class="mb-1">पुष शुक्ल दशमी<br>पक्ष्य: साध्य गर भरणी</p>
                    <p class="mt-2 mb-0">9th Jan, 2025<br>Evening 05:15</p>
                </div>


                <!-- Calendar Section -->
                <div class="col-10 col-md-4 col-lg-3 mt-0">
                    <div class="calendar-container bg-white rounded-4 border p-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <h1 id="monthYear" class="h5 fw-bold text-dark mb-0 user-select-none fs-5">२०८२
                                वैशाख
                            </h1>
                            <div class="d-flex gap-2 text-dark fs-5 user-select-none">
                                <button id="prevMonth" class="btn btn-link p-0 text-dark"
                                    aria-label="Previous month">
                                    <i class="fas fa-chevron-left"></i>
                                </button>
                                <button id="nextMonth" class="btn btn-link p-0 text-dark" aria-label="Next month">
                                    <i class="fas fa-chevron-right"></i>
                                </button>
                            </div>
                        </div>

                        <div id="engMonthYear" class="text-muted small mb-2 fw-semibold" style="font-size: 10px;">
                            Apr/May 2025
                        </div>

                        <style>
                            .table-responsive table {
                                font-size: 8px;
                            }

                            .table-responsive td,
                            .table-responsive th {
                                padding: 3px;
                                vertical-align: middle;
                            }

                            .table-responsive strong {
                                font-size: 10px;
                            }

                            .table-responsive small {
                                font-size: 7px;
                            }

                            th.holiday,
                            td:nth-child(7) {
                                color: red;
                            }

                            td:nth-child(7) small {
                                color: red;
                            }

                            td:nth-child(7) strong {
                                color: red;
                            }

                                .today {
                                    background-color: #0064A7 !important;
                                    color: #fff!important;
                                }
                            </style>



                        <div class="table-responsive">
                            <!-- Baishakh Calendar -->
                            <table id="calendarBaishakh" class="table table-bordered text-center mb-0">
                                <thead class="small fw-normal">
                                    <tr>
                                        <th>आइत</th>
                                        <th>सोम</th>
                                        <th>मङ्गल</th>
                                        <th>बुध</th>
                                        <th>बिही</th>
                                        <th>शुक्र</th>
                                        <th class="holiday">शनि</th>
                                    </tr>
                                </thead>
                                <tbody class="fw-normal">
                                    <tr>
                                        <td class="text-secondary bg-light"><strong>३०</strong><br><small
                                                class="d-block text-end">13</small></td>
                                        <td><strong>१</strong><br><small class="d-block text-end">14</small>
                                        </td>
                                        <td><strong>२</strong><br><small class="d-block text-end">15</small>
                                        </td>
                                        <td><strong>३</strong><br><small class="d-block text-end">16</small>
                                        </td>
                                        <td><strong>४</strong><br><small class="d-block text-end">17</small>
                                        </td>
                                        <td><strong>५</strong><br><small class="d-block text-end">18</small>
                                        </td>
                                        <td><strong>६</strong><br><small class="d-block text-end">19</small>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>७</strong><br><small class="d-block text-end">20</small>
                                        </td>
                                        <td><strong>८</strong><br><small class="d-block text-end">21</small>
                                        </td>
                                        <td><strong>९</strong><br><small class="d-block text-end">22</small>
                                        </td>
                                        <td><strong>१०</strong><br><small class="d-block text-end">23</small>
                                        </td>
                                        <td><strong>११</strong><br><small class="d-block text-end">24</small>
                                        </td>
                                        <td class="text-danger"><strong>१२</strong><br><small class="d-block text-end">25</small>
                                        </td>
                                        <td><strong>१३</strong><br><small class="d-block text-end">26</small>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>१४</strong><br><small class="d-block text-end">27</small>
                                        </td>
                                        <td class="today"><strong>१५</strong><br><small
                                                class="d-block text-end">28</small>
                                        </td>
                                        <td><strong>१६</strong><br><small class="d-block text-end">29</small>
                                        </td>
                                        <td><strong>१७</strong><br><small class="d-block text-end">30</small>
                                        </td>
                                        <td><strong>१८</strong><br><small class="d-block text-end">1</small>
                                        </td>
                                        <td><strong>१९</strong><br><small class="d-block text-end">2</small>
                                        </td>
                                        <td><strong>२०</strong><br><small class="d-block text-end">3</small>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>२१</strong><br><small class="d-block text-end">4</small>
                                        </td>
                                        <td><strong>२२</strong><br><small class="d-block text-end">5</small>
                                        </td>
                                        <td><strong>२३</strong><br><small class="d-block text-end">6</small>
                                        </td>
                                        <td><strong>२४</strong><br><small class="d-block text-end">7</small>
                                        </td>
                                        <td><strong>२५</strong><br><small class="d-block text-end">8</small>
                                        </td>
                                        <td><strong>२६</strong><br><small class="d-block text-end">9</small>
                                        </td>
                                        <td><strong>२७</strong><br><small class="d-block text-end">10</small>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>२८</strong><br><small class="d-block text-end">11</small>
                                        </td>
                                        <td><strong>२९</strong><br><small class="d-block text-end">12</small>
                                        </td>
                                        <td><strong>३०</strong><br><small class="d-block text-end">13</small>
                                        </td>
                                        <td><strong>३१</strong><br><small class="d-block text-end">14</small>
                                        </td>
                                        <td class="text-secondary bg-light"><strong>१</strong><br><small
                                                class="d-block text-end">15</small></td>
                                        <td class="text-secondary bg-light"><strong>२</strong><br><small
                                                class="d-block text-end">16</small></td>
                                        <td class="text-secondary bg-light"><strong>३</strong><br><small
                                                class="d-block text-end">17</small></td>
                                    </tr>
                                </tbody>
                            </table>

                            <table id="calendarJestha" class="table table-bordered text-center mb-0">
                                <thead class="small fw-normal">
                                    <tr>
                                        <th>आइत</th>
                                        <th>सोम</th>
                                        <th>मङ्गल</th>
                                        <th>बुध</th>
                                        <th>बिही</th>
                                        <th>शुक्र</th>
                                        <th class="holiday">शनि</th>
                                    </tr>
                                </thead>
                                <tbody class="fw-normal">
                                    <tr>
                                        <td class="text-secondary bg-light"><strong>२८</strong><br><small class="d-block text-end">11</small></td>
                                        <td class="text-secondary bg-light"><strong>२९</strong><br><small class="d-block text-end">12</small></td>
                                        <td class="text-secondary bg-light"><strong>३०</strong><br><small class="d-block text-end">13</small></td>
                                        <td><strong>१</strong><br><small class="d-block text-end">14</small></td>
                                        <td><strong>२</strong><br><small class="d-block text-end">15</small></td>
                                        <td><strong>३</strong><br><small class="d-block text-end">16</small></td>
                                        <td><strong>४</strong><br><small class="d-block text-end">17</small></td>
                                    </tr>
                                    <tr>
                                        <td><strong>५</strong><br><small class="d-block text-end">18</small></td>
                                        <td><strong>६</strong><br><small class="d-block text-end">19</small></td>
                                        <td><strong>७</strong><br><small class="d-block text-end">20</small></td>
                                        <td><strong>८</strong><br><small class="d-block text-end">21</small></td>
                                        <td><strong>९</strong><br><small class="d-block text-end">22</small></td>
                                        <td><strong>१०</strong><br><small class="d-block text-end">23</small></td>
                                        <td><strong>११</strong><br><small class="d-block text-end">24</small></td>
                                    </tr>
                                    <tr>
                                        <td><strong>१२</strong><br><small class="d-block text-end">25</small></td>
                                        <td><strong>१३</strong><br><small class="d-block text-end">26</small></td>
                                        <td><strong>१४</strong><br><small class="d-block text-end">27</small></td>
                                        <td><strong>१५</strong><br><small class="d-block text-end">28</small></td>
                                        <td><strong>१६</strong><br><small class="d-block text-end">29</small></td>
                                        <td><strong>१७</strong><br><small class="d-block text-end">30</small></td>
                                        <td><strong>१८</strong><br><small class="d-block text-end">31</small></td>
                                    </tr>
                                    <tr>
                                        <td><strong>१९</strong><br><small class="d-block text-end">1</small></td>
                                        <td><strong>२०</strong><br><small class="d-block text-end">2</small></td>
                                        <td><strong>२१</strong><br><small class="d-block text-end">3</small></td>
                                        <td><strong>२२</strong><br><small class="d-block text-end">4</small></td>
                                        <td><strong>२३</strong><br><small class="d-block text-end">5</small></td>
                                        <td><strong>२४</strong><br><small class="d-block text-end">6</small></td>
                                        <td><strong>२५</strong><br><small class="d-block text-end">7</small></td>
                                    </tr>
                                    <tr>
                                        <td><strong>२६</strong><br><small class="d-block text-end">8</small></td>
                                        <td><strong>२७</strong><br><small class="d-block text-end">9</small></td>
                                        <td><strong>२८</strong><br><small class="d-block text-end">10</small></td>
                                        <td><strong>२९</strong><br><small class="d-block text-end">11</small></td>
                                        <td><strong>३०</strong><br><small class="d-block text-end">12</small></td>
                                        <td><strong>३१</strong><br><small class="d-block text-end">13</small></td>
                                        <td class="text-secondary bg-light"><strong>१</strong><br><small class="d-block text-end">14</small></td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>

                <script>
                    let currentMonth = 0;

                    function showCalendar() {
                        const monthName = ["बैशाख २०८२", "जेठ २०८२"];
                        const engMonthName = ["Apr/May 2025", "May/June 2025"]; // <-- Added English months

                        document.getElementById('monthYear').innerText = monthName[currentMonth];
                        document.getElementById('engMonthYear').innerText = engMonthName[currentMonth]; // <-- Update English month

                        if (currentMonth === 0) {
                            document.getElementById('calendarBaishakh').classList.remove('d-none');
                            document.getElementById('calendarJestha').classList.add('d-none');
                        } else {
                            document.getElementById('calendarBaishakh').classList.add('d-none');
                            document.getElementById('calendarJestha').classList.remove('d-none');
                        }
                    }

                    document.getElementById('prevMonth').addEventListener('click', () => {
                        currentMonth = (currentMonth - 1 + 2) % 2;
                        showCalendar();
                    });

                    document.getElementById('nextMonth').addEventListener('click', () => {
                        currentMonth = (currentMonth + 1) % 2;
                        showCalendar();
                    });

                    showCalendar();
                </script>
            </div>
        </div>
    </div>




    {{-- Horoscope Type Switcher --}}
    <div class="container bg-white mt-3">
        <div class="horoscope-header d-flex justify-content-between align-items-center">
            <h2 class="horoscope-title">Here's the horoscope for today</h2>
            <div class="button-container-horoscope">
                <form id="horoscopeTypeForm" method="GET" action="{{ route('horoscope') }}">
                    <input type="hidden" name="type" id="horoscopeTypeInput" value="{{ request('type', 'daily') }}">

                    <button type="button" id="dailyBtn"
                        class="btn {{ request('type', 'daily') == 'daily' ? 'btn-primary active' : 'btn-outline-primary' }}">Daily</button>

                    <button type="button" id="weeklyBtn"
                        class="btn {{ request('type') == 'weekly' ? 'btn-primary active' : 'btn-outline-primary' }}">Weekly</button>

                    <button type="button" id="monthlyBtn"
                        class="btn {{ request('type') == 'monthly' ? 'btn-primary active' : 'btn-outline-primary' }}">Monthly</button>

                    <button type="button" id="yearlyBtn"
                        class="btn {{ request('type') == 'yearly' ? 'btn-primary active' : 'btn-outline-primary' }}">Yearly</button>
                </form>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const form = document.getElementById('horoscopeTypeForm');
                const typeInput = document.getElementById('horoscopeTypeInput');

                // Select all buttons
                const buttons = document.querySelectorAll('.button-container-horoscope .btn');

                buttons.forEach(button => {
                    button.addEventListener('click', function() {
                        // Remove active class from all buttons
                        buttons.forEach(btn => btn.classList.remove('btn-primary', 'active'));

                        // Add active class to clicked button
                        button.classList.add('btn-primary', 'active');

                        // Set the hidden input value to the clicked button's type
                        typeInput.value = button.textContent.trim().toLowerCase();

                        // Submit the form to reload with the selected type
                        form.submit();
                    });
                });
            });
        </script>



        <!-- Horoscope Grid -->
        <div id="daily" class="horoscope-section">
            <!-- English Section -->
            <div class="row g-3 mt-3">
                @foreach($orderedHoroscopes as $sign)
                <div class="col-lg-1 col-md-2 col-sm-2 col-4">
                    <div class="horoscope-card-wrapper text-center" data-bs-toggle="modal" data-bs-target="#horoscopeModal"
                        data-zodiac="{{ $sign->zodiacSignEnglish }}"
                        data-symbol="{{ asset($sign->zodiacImgEnglish) }}"
                        data-description="{{ strip_tags($sign->contentEn) }}"
                        data-zodiac-nepali="{{ $sign->zodiacSignNepali }}"
                        data-symbol-nepali="{{ asset($sign->zodiacImgNepali) }}"
                        data-birth-month="{{ $sign->birthMonth }}"
                        data-start-letter="{{ $sign->nameStartLetter }}">
                        <div class="horoscope-card">
                            <img src="{{ asset($sign->zodiacImgEnglish) }}" alt="{{ $sign->zodiacSignEnglish }}" class="img-fluid">
                        </div>
                        <h1>{{ $sign->zodiacSignEnglish }}</h1>
                        <p>{{ $sign->birthMonth }}</p>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Nepali Section -->
            <div class="row g-3 mt-3">
                @foreach($orderedHoroscopes as $sign)
                <div class="col-lg-1 col-md-2 col-sm-2 col-4">
                    <div class="horoscope-card-wrapper text-center" data-bs-toggle="modal" data-bs-target="#horoscopeModal"
                        data-zodiac="{{ $sign->zodiacSignNepali }}"
                        data-symbol="{{ asset($sign->zodiacImgNepali) }}"
                        data-description="{{ strip_tags($sign->contentNp) }}"
                        data-zodiac-english="{{ $sign->zodiacSignEnglish }}"
                        data-symbol-english="{{ asset($sign->zodiacImgEnglish) }}"
                        data-birth-month="{{ $sign->birthMonth }}"
                        data-start-letter="{{ $sign->nameStartLetter }}">
                        <div class="horoscope-card">
                            <img src="{{ asset($sign->zodiacImgNepali) }}" alt="{{ $sign->zodiacSignNepali }}" class="img-fluid">
                        </div>
                        <h1>{{ $sign->zodiacSignNepali }}</h1>
                        <p>{{ $sign->nameStartLetter }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Modal Structure -->
        <div class="modal fade" id="horoscopeModal" tabindex="-1" aria-labelledby="horoscopeModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-white position-relative">
                        <div class="d-flex flex-column align-items-start w-100">
                            <div class="d-flex align-items-center">
                                <div class="img-container me-2">
                                    <img alt="Zodiac symbol" class="img-fluid" id="horoscopeSymbol" src="img/pic1.png" />
                                </div>
                                <div>
                                    <h5 class="modal-title mb-0" id="horoscopeModalLabel">वृष - Taurus</h5>
                                    <p class="mb-0" id="horoscopeZodiacSigns">इ, उ, ए, ओ, बा, बि, बु, बे, बो</p>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn-close position-absolute top-0 end-0 m-2" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p class="text-muted-horoscope px-4" id="horoscopeDescription">
                            <!-- Zodiac description will be injected here -->
                        </p>
                    </div>
                </div>
            </div>
        </div>


        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const horoscopeCards = document.querySelectorAll('.horoscope-card-wrapper');

                horoscopeCards.forEach(card => {
                    card.addEventListener('click', function() {
                        // Retrieve the zodiac data from the clicked card's data attributes
                        const zodiacEnglish = card.getAttribute('data-zodiac');
                        const zodiacNepali = card.getAttribute('data-zodiac-nepali');
                        const symbolEnglish = card.getAttribute('data-symbol');
                        const symbolNepali = card.getAttribute('data-symbol-nepali');
                        const description = card.getAttribute('data-description');
                        const birthMonth = card.getAttribute('data-birth-month');
                        const startLetter = card.getAttribute('data-start-letter');

                        // Update modal content
                        const modalTitle = document.getElementById('horoscopeModalLabel');
                        const modalImage = document.getElementById('horoscopeSymbol');
                        const modalDescription = document.getElementById('horoscopeDescription');
                        const modalZodiacSigns = document.getElementById('horoscopeZodiacSigns');

                        // Check if it's English or Nepali and set the appropriate content
                        if (zodiacEnglish) {
                            modalTitle.textContent = `${zodiacEnglish} - ${zodiacNepali}`;

                            modalImage.src = symbolEnglish;
                            modalZodiacSigns.textContent = startLetter;
                        }

                        if (zodiacNepali) {
                            modalTitle.textContent = `${zodiacEnglish} - ${zodiacNepali}`;

                            modalImage.src = symbolNepali;
                            modalZodiacSigns.textContent = birthMonth;

                        }

                        // Update description
                        modalDescription.textContent = description;
                        modalTitle.textContent =
                            zodiacNepali && zodiacEnglish ?
                            ` ${zodiacEnglish}` :
                            (zodiacNepali || zodiacEnglish); // Show whichever is available

                    });
                });
            });
        </script>













    </div>
    </div>


    </div>



    <!-- Modal for displaying description -->

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
                                    <input type="text" class="form-control abroad-deal-1" id="name"
                                        placeholder="Enter name" name="personName" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Date of Birth<span class="text-danger">*</span></label>
                                    <div class="row g-2">
                                        <div class="col">
                                            <input type="number" class="form-control abroad-deal-1" placeholder="Day" name="day" required>
                                        </div>
                                        <div class="col">
                                            <input type="text" class="form-control abroad-deal-1" placeholder="Month" name="month" required>
                                        </div>
                                        <div class="col">
                                            <input type="number" class="form-control abroad-deal-1" placeholder="Year" name="year" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Time of Birth<span class="text-danger">*</span></label>
                                    <div class="row g-2">
                                        <div class="col">
                                            <input type="number" class="form-control abroad-deal-1" placeholder="Hour" name="hour" required>
                                        </div>
                                        <div class="col">
                                            <input type="number" class="form-control abroad-deal-1" placeholder="Minute" name="minute" required>
                                        </div>
                                        <div class="col">
                                            <input type="number" class="form-control abroad-deal-1" placeholder="Second" name="second" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="place" class="form-label">Place of Birth<span
                                            class="text-danger">*</span></label>
                                    <select class="form-select abroad-deal-1" id="place" name="personPlaceOfBirth" required>
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
                                    <input type="text" class="form-control abroad-deal-1" id="name" name="Query1"
                                        placeholder="Enter name" required>
                                </div>
                                <div class="mb-3">
                                    <label for="name" class="form-label">Question 2</label>
                                    <input type="text" class="form-control abroad-deal-1" id="name" name="Query2"
                                        placeholder="Enter name" required>
                                </div>
                                <div class="mb-3">
                                    <label for="name" class="form-label">Question 3</label>
                                    <input type="text" class="form-control abroad-deal-1" id="name" name="Query3"
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
                                    <input type="text" class="form-control abroad-deal-1" id="name" name="girlName"
                                        placeholder="Enter name" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Date of Birth<span class="text-danger">*</span></label>
                                    <div class="row g-2">
                                        <div class="col">
                                            <input type="number" class="form-control abroad-deal-1" placeholder="Day" name="gday" required>
                                        </div>
                                        <div class="col">
                                            <input type="text" class="form-control abroad-deal-1" placeholder="Month" name="gmonth" required>
                                        </div>
                                        <div class="col">
                                            <input type="number" class="form-control abroad-deal-1" placeholder="Year" name="gyear" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Time of Birth<span class="text-danger">*</span></label>
                                    <div class="row g-2">
                                        <div class="col">
                                            <input type="number" class="form-control abroad-deal-1" placeholder="Hour" name="ghour" required>
                                        </div>
                                        <div class="col">
                                            <input type="number" class="form-control abroad-deal-1" placeholder="Minute" name="gminute" required>
                                        </div>
                                        <div class="col">
                                            <input type="number" class="form-control abroad-deal-1" placeholder="Second" name="gsecond" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="place" class="form-label">Place of Birth<span
                                            class="text-danger">*</span></label>
                                    <select class="form-select abroad-deal-1" id="place" name="girlPlaceOfBirth" required>
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
                                    <input type="text" class="form-control abroad-deal-1" id="name" name="boyName"
                                        placeholder="Enter name" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Date of Birth<span class="text-danger">*</span></label>
                                    <div class="row g-2">
                                        <div class="col">
                                            <input type="number" class="form-control abroad-deal-1" placeholder="Day" name="bday" required>
                                        </div>
                                        <div class="col">
                                            <input type="text" class="form-control abroad-deal-1" placeholder="Month" name="bmonth"
                                                required>
                                        </div>
                                        <div class="col">
                                            <input type="number" class="form-control abroad-deal-1" placeholder="Year" name="byear"
                                                required>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Time of Birth<span
                                            class="text-danger">*</span></label>
                                    <div class="row g-2">
                                        <div class="col">
                                            <input type="number" class="form-control abroad-deal-1" placeholder="Hour" name="bhour"
                                                required>
                                        </div>
                                        <div class="col">
                                            <input type="number" class="form-control abroad-deal-1" placeholder="Minute" name="bminute"
                                                required>
                                        </div>
                                        <div class="col">
                                            <input type="number" class="form-control abroad-deal-1" placeholder="Second" name="bsecond"
                                                required>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="place" class="form-label">Place of Birth<span
                                            class="text-danger">*</span></label>
                                    <select class="form-select abroad-deal-1" id="place" name="boyPlaceOfBirth" required>
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
                                    <input type="text" class="form-control abroad-deal-1" id="name" name="Query1"
                                        placeholder="Enter name" required>
                                </div>
                                <div class="mb-3">
                                    <label for="name" class="form-label">Question 2</label>
                                    <input type="text" class="form-control abroad-deal-1" id="name" name="Query2"
                                        placeholder="Enter name" required>
                                </div>
                                <div class="mb-3">
                                    <label for="name" class="form-label">Question 3</label>
                                    <input type="text" class="form-control abroad-deal-1" id="name" name="Query3"
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

            <div id="jyotishCarousel" class="carousel slide col-lg-4 Jyotish mt-5" data-bs-ride="carousel">

                <h3 class="mb-4 mt-5">Our Jyotish</h3>

                @if($jyotishs->isEmpty())
                <p>No Jyotish available at the moment.</p>
                @else
                <div class="carousel-inner">

                    @foreach($jyotishs as $index => $jyotish)

                    <div class="carousel-item {{ $index == 0 ? 'active' : '' }}" style="height: 280px; ">
                        <div class="card h-100 mb-4" style=" border-radius: 0;">
                            <br>
                            @if($jyotish->photo)
                            <img src="{{ asset('storage/' . $jyotish->photo) }}" alt="{{ $jyotish->name }}" class="card-img-top rounded-circle mx-auto d-block" style="height: 150px; width:150px; object-fit: cover;">
                            @else
                            <img src="{{ asset('images/default-image.jpg') }}" alt="No Image" class="card-img-top" style="height: 200px; object-fit: cover;">
                            @endif
                            <div class="card-body">
                                <h5 class="card-title">{{ $jyotish->name }}</h5> 
                                <p class="card-text" style="color:rgb(114, 116, 120);">Phone: {{ $jyotish->phone ?? 'N/A' }}</p> 
                                <p class="card-text" style="color:rgb(114, 116, 120);">Email: {{ $jyotish->email ?? 'N/A' }}</p>

                                @if(!empty($jyotish->astroVideoLink))
                                <div class="ratio ratio-16x9 mt-3">
                                    <iframe src="{{ $jyotish->astroVideoLink }}" title="Astrologer Video" allowfullscreen></iframe>
                                </div>
                                @endif
                            </div>

                        </div>
                    </div>
                    @endforeach

                </div>

                <!-- Controls -->
                <button class="carousel-control-prev" type="button" data-bs-target="#jyotishCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"
                        style="filter: invert(20%) sepia(0%) saturate(0%) hue-rotate(0deg) brightness(90%) contrast(100%);">
                    </span>
                    <span class="visually-hidden">Previous</span>
                </button>

                <button class="carousel-control-next" type="button" data-bs-target="#jyotishCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"
                        style="filter: invert(20%) sepia(0%) saturate(0%) hue-rotate(0deg) brightness(90%) contrast(100%);">
                    </span>
                    <span class="visually-hidden">Next</span>
                </button>
                @endif

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
            height: 250px;
        }
    </style>










    <!-- 
<script>
    $('#payButton').on('click', function () {
        let formData = new FormData();

        // Girl Info
        formData.append('girlName', $('input[name="girlName"]').val());
        formData.append('girlPlaceOfBirth', $('select[name="girlPlaceOfBirth"]').val());

        let gday = $('input[name="gday"]').val();
        let gmonth = $('input[name="gmonth"]').val();
        let gyear = $('input[name="gyear"]').val();
        formData.append('girlDateOfBirth', `${gyear}-${gmonth}-${gday}`); // YYYY-MM-DD

        let ghour = $('input[name="hour"]').eq(0).val();
        let gminute = $('input[name="minute"]').eq(0).val();
        let gsecond = $('input[name="second"]').eq(0).val();
        formData.append('girlTimeOfBirth', `${ghour}:${gminute}:${gsecond}`); // HH:MM:SS

        // Boy Info
        formData.append('boyName', $('input[name="boyName"]').val());
        formData.append('boyPlaceOfBirth', $('select[name="boyPlaceOfBirth"]').val());

        let bday = $('input[name="bday"]').val();
        let bmonth = $('input[name="bmonth"]').val();
        let byear = $('input[name="byear"]').val();
        formData.append('boyDateOfBirth', `${byear}-${bmonth}-${bday}`);

        let bhour = $('input[name="hour"]').eq(1).val();
        let bminute = $('input[name="minute"]').eq(1).val();
        let bsecond = $('input[name="second"]').eq(1).val();
        formData.append('boyTimeOfBirth', `${bhour}:${bminute}:${bsecond}`);

        // Questions
        formData.append('Query1', $('input[name="Query1"]').val());
        formData.append('Query2', $('input[name="Query2"]').val());
        formData.append('Query3', $('input[name="Query3"]').val());

        $.ajax({
            url: "{{ route('kundalimatching.store') }}",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            success: function (response) {
                alert("Kundali details saved successfully!");
                // Optional: redirect or reset
            },
            error: function (xhr) {
                alert("Something went wrong!");
                console.error(xhr.responseText);
            }
        });
    });
</script> -->


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
    <!-- <script>
    document.addEventListener("DOMContentLoaded", function () {
        const buttons = document.querySelectorAll(".button-container-horoscope button");
        const typeInput = document.getElementById("horoscopeTypeInput");
        const form = document.getElementById("horoscopeTypeForm");

        // Function to update form and submit it
        function submitType(type) {
            typeInput.value = type;
            form.submit();
        }

        buttons.forEach(button => {
            const type = button.id.replace("Btn", ""); // Get 'daily', 'weekly', etc.
            button.addEventListener("click", () => submitType(type));
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

            // // Attach event listeners to all buttons
            // document.getElementById("dailyBtn").addEventListener("click", () => showSection("daily"));
            // document.getElementById("weeklyBtn").addEventListener("click", () => showSection("weekly"));
            // document.getElementById("monthlyBtn").addEventListener("click", () => showSection("monthly"));
            // document.getElementById("yearlyBtn").addEventListener("click", () => showSection("yearly"));

            // // Set default active section
            // showSection("daily");
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

            // Next button click event to submit data using AJAX
            const nextButton = document.getElementById("nextButton"); // You might have this button in the Girl's section
            nextButton.addEventListener("click", function() {
                const girlName = document.querySelector('input[name="girlName"]').value;
                const girlDateOfBirth = `${document.querySelector('input[name="gday"]').value}-${document.querySelector('input[name="gmonth"]').value}-${document.querySelector('input[name="gyear"]').value}`;
                const girlTimeOfBirth = `${document.querySelector('input[name="hour"]').value}:${document.querySelector('input[name="minute"]').value}:${document.querySelector('input[name="second"]').value}`;
                const girlPlaceOfBirth = document.querySelector('select[name="girlPlaceOfBirth"]').value;

                const boyName = document.querySelector('input[name="boyName"]').value;
                const boyDateOfBirth = `${document.querySelector('input[name="bday"]').value}-${document.querySelector('input[name="bmonth"]').value}-${document.querySelector('input[name="byear"]').value}`;
                const boyTimeOfBirth = `${document.querySelector('input[name="hour"]').value}:${document.querySelector('input[name="minute"]').value}:${document.querySelector('input[name="second"]').value}`;
                const boyPlaceOfBirth = document.querySelector('select[name="boyPlaceOfBirth"]').value;

                const query1 = document.querySelector('input[name="Query1"]').value;
                const query2 = document.querySelector('input[name="Query2"]').value;
                const query3 = document.querySelector('input[name="Query3"]').value;

                // Collect data in an object
                const formData = {
                    girlName,
                    girlDateOfBirth,
                    girlTimeOfBirth,
                    girlPlaceOfBirth,
                    boyName,
                    boyDateOfBirth,
                    boyTimeOfBirth,
                    boyPlaceOfBirth,
                    query1,
                    query2,
                    query3
                };

                // Send the data to the server using AJAX
                $.ajax({
                    url: "{{ route('kundalimatching.store') }}",
                    type: "POST",
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        console.log(response);
                        alert('Data saved successfully');
                        showSection(questionSection); // Optionally, switch to another section after successful submission
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                        alert('There was an error saving the data');
                        console.log(xhr.responseText);
                    }
                });

            });
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




    <!-- <script>
    document.getElementById("payButton").addEventListener("click", function (event) {
        event.preventDefault();

        // Get form data from both forms
        const personalForm = new FormData(document.getElementById("personalForm"));
        const questionForm = new FormData(document.getElementById("questionForm"));

        // Merge both
        for (let [key, value] of questionForm.entries()) {
            personalForm.append(key, value);
        }

        // Add additional info if needed
        personalForm.append('personDateOfBirth', 
            personalForm.get('birthDay') + '-' + 
            personalForm.get('birthMonth') + '-' + 
            personalForm.get('birthYear')
        );

        personalForm.append('personTimeOfBirth', 
            personalForm.get('birthHour') + ':' + 
            personalForm.get('birthMinute') + ':' + 
            personalForm.get('birthSecond')
        );

        // Optionally add static data
        personalForm.append('jobSeekerId', 123); // Replace with dynamic value
        personalForm.append('emailAddress', 'test@example.com');
        personalForm.append('phoneNumber', '9800000000');

        fetch("{{ route('kundalidetail.store') }}", {
            method: "POST",
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            },
            body: personalForm
        })
        .then(response => response.json())
        .then(data => {
            alert('Form submitted successfully!');
            console.log(data);
            // Optionally redirect or show payment section
            document.getElementById("Question-Section").style.display = "none";
            document.getElementById("payment-section").style.display = "block";
            document.getElementById("payment-section").scrollIntoView({ behavior: "smooth" });
        })
        .catch(error => {
            console.error('Error:', error);
            alert('There was an error submitting the form.');
        });
    });
</script> -->

    @endsection