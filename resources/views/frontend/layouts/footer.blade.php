<section class="footer">
    <div class="container">
        <div class="row pt-5 "> <!-- Centered content -->
            <div class="col-lg-12"> <!-- Restricting width for better alignment -->
                <div class="row ">
                    <div class="col-lg-2 py-3">
                        <img src="{{ asset('frontend/assets/Images/logolast.png') }}" class="image-fluid" alt="">
                    </div>

                    <div class="col-lg-2 py-3">
                        <h5 class="pb-3">Quick Link</h5>
                        <p>Home</p>
                        <p>About Us</p>
                        <p>Articles</p>
                        <p>Contact Us</p>
                    </div>

                    <div class="col-lg-3 py-3">
                        <h5 class="pb-3">Contact Us</h5>
                        <p><i class="fa fa-map-marker-alt"></i>Kathmandu,Nepal</p>
                        <p><i class="fa fa-envelope"></i>sandeepsingh.y2018@hmail.com</p>
                        <p><i class="fas fa-phone"></i>9745620743 | 9814317185</p>
                    </div>

                    <div class="col-lg-2 py-3">
                        <h5 class="pb-3">Links</h5>
                        <p>Privacy Policy</p>
                        <p>Terms & Condition</p>
                    </div>
                    <div class="col-lg-3 py-3">
                        <h5 class="pb-3">Download App</h5>
                        <div class="img d-flex">
                            <!-- Left Side: QR Code -->
                            <img class="img1" src="{{ asset('frontend/assets/Images/pattern.png') }}" alt="QR Code">

                            <!-- Right Side: Store Buttons -->
                            <div class="store-buttons">
                                <a href="https://apps.apple.com/us/app/yourapp/id123456789" target="_blank">
                                    <img class="img2" src="{{ asset('frontend/assets/Images/appstore.png') }}"
                                        alt="App Store">
                                </a>
                                <a href="https://play.google.com/store/apps/details?id=com.example.yourapp"
                                    target="_blank">
                                    <img class="img2" src="{{ asset('frontend/assets/Images/google.png') }}"
                                        alt="Google Play Store">
                                </a>
                            </div>
                        </div>
                        <!-- Social Icons Below -->
                        <div class="icon">
                            <span><i class="fab fa-facebook"></i></span>
                            <span><i class="fab fa-twitter"></i></span>
                            <span><i class="fab fa-instagram"></i></span>
                            <span><i class="fab fa-linkedin"></i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
   

    <hr>
    <div class="pb-3">
        <a>Copyright <?php echo date('Y'); ?> Kaam Sansar | All rights reserved.</a>
    </div>
    

</section>
