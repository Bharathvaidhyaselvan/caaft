<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content>
    <meta name="keywords" content>

    <title> CAAFT Consultancy Services Private Limited </title>

    <?php include "header-top.php"; ?>
</head>

<body class="home-3">
<div class="preloader">
        <div class="loader-ripple">
            <div>
            <a>
                        <img src="assets/img/caaft-logo-header.webp" alt="caaft" title="caaft" class="img-fluid">
                    </a>
            </div>
            <!-- <div></div> -->
        </div>
    </div>

    <div class="header-sections">
        <?php include "header.php"; ?>
    </div>


    <div class="search-popup">
        <button class="close-search"><span class="far fa-times"></span></button>
        <form action="#">
            <div class="form-group">
                <input type="search" name="search-field" class="form-control" placeholder="Search Here..." required>
                <button type="submit"><i class="far fa-search"></i></button>
            </div>
        </form>
    </div>

    <main class="main">

        <div class="site-breadcrumb" style="background: url(assets/img/contact-us-banner-new.webp)">
            <div class="container">
                <h2 class="breadcrumb-title">Contact Us</h2>

            </div>
        </div>

        <!-- about-area -->

        <div class="contact-area py-120">
            <div class="container">
                <div class="contact-content">
                    <div class="row">

                        <div class="col-md-4">
                            <div class="contact-info">
                                <div class="contact-info-icon">
                                    <i class="fal fa-phone-volume"></i>
                                </div>
                                <div class="contact-info-content">
                                    <h5>Call Us</h5>
                                    <p><a href="tel:918870078870">+91 8870 07 8870</a> <br>
                                        <a href="tel:919944617891">+91 9944 61 7891</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="contact-info">
                                <div class="contact-info-icon">
                                    <i class="fal fa-map-location-dot"></i>
                                </div>
                                <div class="contact-info-content">
                                    <h5>Reach Us</h5>
                                    <p>No: C105, 1st Floor, Apeejay House, 39/12, Haddows Road,
                                        Nungambakkam, Chennai-600006.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="contact-info">
                                <div class="contact-info-icon">
                                    <i class="fal fa-envelopes"></i>
                                </div>
                                <div class="contact-info-content">
                                    <h5>Email Us</h5>
                                    <p><a href="info@caaft.com" class="__cf_email__"
                                            data-cfemail="01686f676e416479606c716d642f626e6c">info@caaft.com</a>
                                        <br>
                                        <br>
                                    </p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="contact-wrapper pt-60" id="contact_us">
                    <div class="row g-4">
                        <div class="col-lg-4">
                            <div class="about-img-sixteen contact-img">
                                <img src="assets/img/contact-form.webp" alt>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="contact-form">
                                <div class="contact-form-header">
                                    <h2>Get In Touch</h2>
                                    <p>Start your journey to seamless Accounting & Reporting, Taxation, Business Incorporation, Consultancy and Compliance Services by reaching out to us. </p>
                                </div>
								<div class="alert alert-success automated_msg" style="display: none; font-size: 15px;"
                           role="alert">
                           <strong>Thank you!</strong> for contacting us.
                        </div>
                                <form method="post" action="#" class="contact" id="contact-form">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="far fa-user-tie"></i></span>
                                                <input type="text" class="form-control name-valid" name="name" id="name"
                                                    placeholder="Your Name" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="far fa-envelope"></i></span>
                                                <input type="email" id="email" class="form-control" name="email"
                                                    placeholder="Your Email" required>
													<input type="hidden" name="title" id="title" value="Contact">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="far fa-phone"></i></span>
                                            <input type="text" name="phone" id="phone" maxlength="10" class="form-control" placeholder="Your Phone">
                                        </div>
                                    </div>
                                  <div class="col-lg-6">
									<div class="input-group" id="select-group">
										<span class="input-group-text"><i class="far fa-box"></i></span>
										<select class="select form-select form-control" id="about" name="about">
											<option value="" selected disabled>How did you hear about us?</option>
											<option value="Social Media">Social Media</option>
											<option value="Email">Email</option>
											<option value="Word of mouth">Word of mouth</option>
											<option value="Google Search">Google Search</option>
											<option value="Others">Others (Please mention)</option>
										</select>
									</div>
									

                                  </div class="col-lg-12">
								  <div >
								  <div id="other-input" class="input-group" style="display: none;">
										<span class="input-group-text"><i class="far fa-box"></i></span>
										<input type="text" id="other-text" class="form-control" placeholder="How did you hear about us? Please mention">
									</div>
									</div><!-- Hidden input field for 'Others' -->
    
                                   
</div>
                                    <div class="input-group textarea">
                                        <span class="input-group-text"><i class="far fa-comment-lines"></i></span>
                                        <textarea name="msg" id="msg" cols="30" rows="5" class="form-control"
                                            placeholder="Write Your Message"></textarea>
                                    </div>
                                    <button type="submit" class="theme-btn automated_mail">Send
                                        Message <i class="far fa-paper-plane"></i></button>
                                    <div class="col-md-12 mt-3">
                                        <div class="form-messege text-success"></div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="contact-map">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d7773.137959101068!2d80.247945!3d13.063085!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3a5267869930183d%3A0xd55a3127e2b87405!2sApeejay%20House!5e0!3m2!1sen!2sin!4v1732277904412!5m2!1sen!2sin"
                width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>







    </main>

    <?php include "footer.php";?>
    <a href="#" id="scroll-top"><i class="far fa-arrow-up"></i></a>


    <?php include "footer-bottom.php"; ?>
	<script>
    $(document).ready(function () {
        $('#about').change(function () {
            if ($(this).val() === "Others") {
                //$('#select-group').hide(); 
                $('#other-input').show(); 
                $('#other-text').attr('name', 'about'); 
                $('#about').removeAttr('name'); 
            } else {
                $('#select-group').show(); 
                $('#other-input').hide(); 
                $('#other-text').removeAttr('name'); 
                $('#about').attr('name', 'about'); 
            }
        });

        $('.name-valid').on('keypress', function (e) {
            var regex = new RegExp("^[a-zA-Z ]*$");
            var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
            if (!regex.test(str)) {
                e.preventDefault();
                return false;
            }
        });

        $('#phone').on('input', function () {
            var sanitized = $(this).val().replace(/[^0-9]/g, '');
            $(this).val(sanitized);
        });

        $('.automated_mail').click(function (e) {
            e.preventDefault(); 
            var valid = true; 
            var name = $('#name').val().trim();
            var email = $('#email').val();
            var phone = $('#phone').val().trim(); 
            var about = $('#about').val(); 
            var otherAbout = $('#other-text').val().trim(); 
            var msg = $('#msg').val().trim();
            var title = $('#title').val().trim();

            if (name === '') {
                alert('Please enter your name');
                valid = false;
            } else if (email === '') {
                alert('Please enter your email id');
                valid = false;
            } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
                alert('Please enter a valid email id');
                valid = false;
            } else if (phone === '') {
                alert('Please enter your phone number');
                valid = false;
            } else if (phone.length < 10) {
                alert('Please enter a valid mobile number');
                valid = false;
            } else if ($('#other-input').is(':visible') && otherAbout === '') {
                alert('How did you hear about us? please mension');
                valid = false;
            } else if (!$('#other-input').is(':visible') && about == null) {
                alert('Please select "How did you hear about us?"');
                valid = false;
            } else if (msg === '') {
                alert('Please enter your message');
                valid = false;
            } else if (!validateInput(msg)) {
                alert('Please enter a valid message');
                valid = false;
            }

            if (valid) {
                var selectedAbout = $('#other-input').is(':visible') ? otherAbout : about; // Get correct value for 'about'
                
                var actual_link = (window.location.protocol == 'https:' ? 'https://' : 'http://') + window.location.host;
                var redirectUrl = actual_link + '/contact_mail.php' + 
                    '?name=' + encodeURIComponent(name) + 
                    '&email=' + encodeURIComponent(email) + 
                    '&phone=' + encodeURIComponent(phone) + 
                    '&about=' + encodeURIComponent(selectedAbout) + 
                    '&msg=' + encodeURIComponent(msg) + 
                    '&title=' + encodeURIComponent(title);

                window.location.href = redirectUrl;

                // Display success message
                $('.contact').fadeOut('fast');
                $('.automated_msg').fadeIn('fast');

                
                return false;
            }

            function validateInput(input) {
                var regex = /^[\x00-\x7F]+$/; // ASCII validation
                return regex.test(input);
            }
        });
    });
</script>

</body>
<script>
$(document).ready(function() {
    $("#manimaenu").attr("class", function(i, hide) {
        return hide + " hides";

    });
});
// $(document).ready(function(){
//     $(".nav-link").click(function(){
//         $("#static-logo").addClass("hide");
//     });

// })
</script>

</html>