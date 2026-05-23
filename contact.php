<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Contact-Us</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?php include "./components/header.php"; ?>


</head>

<body>

    <?php include "./components/navbar.php" ?>
    <?php include "./components/preloader.php" ?>

    <!-- Journey Section -->
    <section class="journey-section py-5">
        <div class="container">

            <!-- Heading + Paragraph -->
            <div class="journey-head mb-5">
                <div class="journey-left">
                    <h2 class="journey-title">
                        Begin Your Extraordinary<br>
                        <span class="gradient-text">
                            Journey in Healthcare
                        </span>
                    </h2>
                </div>

                <div class="journey-right">
                    <p class="journey-text">
                        Seats in our prestigious, PCI-approved programs are strictly limited and filling rapidly. Don’t miss your chance to heal the world, secure your future today!  
                    </p>
                </div>
            </div>

            <!-- Image Card -->
            <div class="journey-image-card">
                <img src="./images/banner.jpg" alt="Contact DJ College of Pharmacy">
            </div>

        </div>
    </section>

    <!-- ============== form================== -->
    <section class="contact-section">
        <div class="container">
            <div class="row align-items-start">

                <!-- LEFT CONTENT -->
                <div class="col-lg-6 contact-left">
                    <h2>
                        We Are Here to<span class="gradient-text"> Guide Your<br>
                        Every Step.</span>
                    </h2>
                    <p>
                        Our devoted team is ready to assist you. Reach out today before the upcoming session closes. Please fill out the form, and our team will get back to you shortly!
                    </p>
                </div>

                <!-- RIGHT FORM -->
                <div class="col-lg-6" id="contact">
                    <?php if (isset($_GET['success'])) { ?>
                        <div class="alert alert-success">
                            Thank you! Your enquiry has been submitted successfully.
                        </div>
                    <?php } ?>

                    <?php if (isset($_GET['already'])) { ?>
                        <div class="alert alert-warning">
                            You have already submitted an enquiry today with this phone or email.
                        </div>
                    <?php } ?>

                    <?php if (isset($_GET['error'])) { ?>
                        <div class="alert alert-danger">
                            Please fill all required fields.
                        </div>
                    <?php } ?>

                    <form class="contact-form" method="post" action="https://backend-test.22web.org/submit-form.php
">

                        <div class="form-group">
                            <label>Full Name *</label>
                            <input type="text" name="full_name" placeholder="Enter your full name" required>
                        </div>

                        <div class="form-group">
                            <label>Email Address *</label>
                            <input type="email" name="email" placeholder="Enter your email address" required>
                        </div>

                        <div class="form-group">
                            <label>Phone Number *</label>
                            <input type="tel" name="phone" placeholder="Enter your phone number" required>
                        </div>

                        <div class="form-group">
                            <label>Message *</label>
                            <textarea name="message" rows="5" placeholder="Write your message here" required></textarea>
                        </div>

                        <button type="submit" class="contact-btn">
                            Submit Enquiry
                        </button>

                    </form>
                </div>


            </div>
        </div>
    </section>
    <script>
        if (window.location.search.length > 0) {
            window.history.replaceState({}, document.title, window.location.pathname);
        }
    </script>



    <!-- =============== info contact =============== -->
    <section class="contact-info-section">
        <div class="container">
            <div class="row">

                <!-- LEFT -->
                <div class="col-lg-6">
                    <div class="info-left">

                        <h3 class="gradient-text">General Inquiries</h3>
                        <p>
                            Have questions about admissions or campus life? Connect with us immediately. Opportunities are limited, so let’s talk today!
                        </p>

                        <hr>

                        <div class="info-block">
                            <h4>Admissions Office</h4>
                            <p>admissions@djpharmacycollege.com</p>
                        </div>

                        <div class="info-block">
                            <h4>Administrative Enquiries</h4>
                            <p>info@djpharmacycollege.com</p>
                        </div>

                    </div>
                </div>

                <!-- RIGHT -->
                <div class="col-lg-6">
                    <div class="info-right">

                        <h3 class="gradient-text">Student Support</h3>
                        <p>
                            Our student support team is available to assist with academic guidance, facilities, and general student-related queries.    
                        </p>

                        <hr>

                        <div class="info-block">
                            <h4>Student Support Email</h4>
                            <p>support@djpharmacycollege.com</p>
                        </div>

                        <div class="info-block">
                            <h4>Contact Number</h4>
                            <p>+91 93685 64768</p>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>


    <!-- ======================== FAQS===================== -->
    <section class="faq-section">
        <div class="container">
            <div class="faq-wrapper">

                <!-- LEFT CONTENT -->
                <div class="faq-left">
                    <h2>Frequently asked<br>questions</h2>
                    <p>
                        Find answers to common questions related to our academic,
                        laboratory, and student support services. For further
                        assistance, you may contact the college administration.
                    </p>
                </div>

                <!-- RIGHT ACCORDION -->
                <div class="faq-right">

                    <div class="faq-item">
                        <button class="faq-question">
                            What are the admission office working hours?
                            <span class="faq-icon">+</span>
                        </button>
                        <div class="faq-answer">
                            <p>
                                The office is open Monday to Saturday, 9:00 AM to 5:00 PM. Call 9368564768 or 9368564766.
                            </p>
                        </div>
                    </div>

                    <div class="faq-item">
                        <button class="faq-question">
                            How do I schedule a campus visit?
                            <span class="faq-icon">+</span>
                        </button>
                        <div class="faq-answer">
                            <p>
                                Email djpharm.college@gmail.com with your preferred date. The campus is located at Niwari Road, Modinagar, Ghaziabad - 201204.
                            </p>
                        </div>
                    </div>

                    <div class="faq-item">
                        <button class="faq-question">
                            Whom do I contact for hostel accommodation details?
                            <span class="faq-icon">+</span>
                        </button>
                        <div class="faq-answer">
                            <p>
                                Call the main administrative line to connect with the hostel administration regarding seat availability, facilities, and fee structures.
                            </p>
                        </div>
                    </div>

                    <div class="faq-item">
                        <button class="faq-question">
                            Where do I submit my admission documents? 
                            <span class="faq-icon">+</span>
                        </button>
                        <div class="faq-answer">
                            <p>
                                Final document verification and submission must be completed in person at the campus administrative block during working hours.
                            </p>
                        </div>
                    </div>

                    <div class="faq-item">
                        <button class="faq-question">
                            How do I contact the college for placement or industrial tour partnerships?
                            <span class="faq-icon">+</span>
                        </button>
                        <div class="faq-answer">
                            <p>
                                Corporate and industrial partners should email proposals directly to djpharm.college@gmail.com for the attention of the placement cell.
                            </p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>


    <?php include './components/footer.php' ?>



</body>

</html>