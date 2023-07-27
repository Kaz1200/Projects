<?php

//index.php

include('class/Appointment.php');

$object = new Appointment;
include('header2.php');
?>

  <?php
// Connect to the database
$servername = "localhost";
$username = "u556402485_doctor_appoint";
$password = "BW76X^sB{%7TrqzG";
$dbname = "u556402485_doctor_appoint";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Update the view count
$sql = "UPDATE page_views SET count = count + 1 WHERE id = 1";
$conn->query($sql);

// Close the database connection
$conn->close();
?>

<!-- ======= Hero Section ======= -->
<section id="hero" class="d-flex align-items-center">
  <div class="container">
    <h1>Welcome to A+ Dental Care Haven</h1>
    <h2>We offer General Dentistry, Orthodontics, Oral Surgery, Aesthetic Dentistry</h2>
    <a href="login.php" class="btn-get-started scrollto text-decoration-none">Make an Appointment</a>
  </div>
</section><!-- End Hero -->
 
<main id="main">

  <!-- ======= Why Us Section ======= -->
  <section id="why-us" class="why-us">
    <div class="container">

      <div class="row">
        <div class="col-lg-4 d-flex align-items-stretch">
          <div class="content">
            <h3>Why Choose A+ DENTAL CARE HAVEN?</h3>
            <p>
              We are a dental clinic that is committed to provide quality and affordable dental care. A+ Dental Care Haven offers high-quality care, comprehensive services, and a relaxing atmosphere.
              <br>
              <br>
            </p>
            <div class="text-center">
              <a href="#about" class="more-btn">Learn More <i class="bx bx-chevron-right"></i></a>
            </div>
          </div>
        </div>
        <div class="col-lg-8 d-flex align-items-stretch">
          <div class="icon-boxes d-flex flex-column justify-content-center">
            <div class="row">
              
              <div class="col-xl-4 d-flex align-items-stretch">
                <div class="icon-box mt-4 mt-xl-0">
                  <i class="bx bx-cube-alt"></i>
                  <h4>Proactive assistant Chatbot</h4>
                  <p>Our proactive assistant chatbot is available 24/7 to help and guide you, and it can even take appointments on your behalf.</p>
                </div>
              </div>
              <div class="col-xl-4 d-flex align-items-stretch">
                <div class="icon-box mt-4 mt-xl-0">
                  <i class="bx bx-images"></i>
                  <h4>SMS Notification Reminder</h4>
                  <p>Dental Care Haven sends SMS reminders to our patients the day before their scheduled appointments.</p>
                </div>
              </div>
              <div class="col-xl-4 d-flex align-items-stretch">
                <div class="icon-box mt-4 mt-xl-0">
                  <i class="bx bx-receipt"></i>
                  <h4>Dental Clinic's Availability</h4>
                  <p>We are open and available to serve you from Monday to Friday, from 8:00 am to 5:00 pm. Our team of highly skilled and experienced dental professionals is dedicated to providing you with the best dental care possible.</p>
                </div>
              </div>
            </div>
          </div><!-- End .content-->
        </div>
      </div>

    </div>
  </section><!-- End Why Us Section -->

  <!-- ======= About Section ======= -->
  <section id="about" class="about">
    <div class="container-fluid">

    <div class="section-title">
        <h2>About Us</h2>
        <p>A+ Dental Care haven is an ideal choice for dental care for a variety of reasons. A+ Dental Care provides high-quality dental care. They are experienced and skilled dentists and hygienists who use the latest technology and techniques to ensure that patients receive the best possible care. A+ Dental Care haven have good customer service, ensuring that patients feel well taken care of and satisfied with their care.</p>
      </div>



      <div class="row">
        <div class="col-xl-5 col-lg-6 video-box d-flex justify-content-center align-items-stretch position-relative">
        </div>

        <div class="col-xl-7 col-lg-6 icon-boxes d-flex flex-column align-items-stretch justify-content-center py-5 px-lg-5">
          

          <div class="icon-box">
            <div class="icon"><i class="bx bx-atom"></i></div>
            <h4 class="title"><a class="text-decoration-none">Valid ID's</a></h4>
            <p class="description">Our dental office accepts and seeks out legitimate IDs that patients can present at the front desk in order to start services that require authorization. These are the lists of valid identification cards (IDs) and documents issued by the government, such as: <b>Driver's License, Passport, Senior Citizen ID, Philippine Postal ID, School ID,</b> etc.</p>
            <!-- <div class="dropdown show d-flex justify-content-center">
                <a class="btn btn-primary dropdown-toggle "  role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Valid ID&#39;s
                </a>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                      <a class="dropdown-item">Pantawid Pamilya Pilipino Program (4Ps) ID </a>
                      <a class="dropdown-item">Driver&#39;s License</a>
                      <a class="dropdown-item">Passport </a>
                      <a class="dropdown-item">Senior Citizen ID</a>
                      <a class="dropdown-item">SSS ID</a>
                      <a class="dropdown-item">Barangay ID </a>
                      <a class="dropdown-item">Philippine Identification (PhilID)</a>
                      <a class="dropdown-item">Philippine Postal ID </a>
                      <a class="dropdown-item">School ID</a>
                    </div>
                </div> -->
          </div>

          <div class="icon-box">
            <div class="icon"><i class="bx bx-fingerprint"></i></div>
            <h4 class="title"><a href="" class="text-decoration-none">Operating Hours</a></h4>
            <p class="description">Our doors are open 6 days a week, Monday to Friday, from 8:00 am to 5:00 pm to serve you better.</p>
          </div>

          <div class="icon-box">
            <div class="icon"><i class="bx bx-gift"></i></div>
            <h4 class="title"><a href="" class="text-decoration-none">Payment Method</a></h4>
            <p class="description">Our dental clinic only accepts cash on hand as payment whenever the patient has finished appointments on that specific day.</p>
          </div>

        </div>
      </div>

    </div>
  </section><!-- End About Section -->

  <!-- ======= Services Section ======= -->
  <section id="services" class="services">
    <div class="container">
      <div class="section-title">
        <h2>Services</h2>
        <p>Provides an overview of the range of dental services available at the clinic. This can include information about preventive care, such as regular cleanings and exams, as well as more advanced treatments like fillings, crowns, bridges, and dental implants. Additionally, the section can highlight any specialty services offered by the clinic, such as orthodontic treatment, periodontics, endodontics, oral surgery and cosmetic dentistry.</p>
      </div>

      <div class="testimonials-slider swiper" data-aos="fade-up" data-aos-delay="100">
        <div class="swiper-wrapper">

          <div class="swiper-slide">
            <div class="testimonial-wrap">
              <div class="testimonial-item">

                <div class="row">
                  <div class="col-md-5 d-flex justify-content-center ">
                    <div class="icon-box">
                      <div class="icon"><i class="fas fa-heartbeat"></i></div>
                      <h4><a href="" class="text-decoration-none">Metal and Ceramic Braces</a></h4>
                      <p>Procedure Estimated Time: 1 hour and 30 minutes.</p>
                    </div>
                  </div>

                  <div class="col-md-5 d-flex justify-content-center ">
                    <div class="icon-box">
                      <div class="icon"><i class="fas fa-pills"></i></div>
                      <h4><a href="" class="text-decoration-none">Self-ligating braces</a></h4>
                      <p>Procedure Estimated Time: 1 hour and 30 minutes.</p>
                      <p>Price Range: ₱35k to ₱40k. Downpayment ₱5k and ₱1.5k monthly adjustment.</p>
                    </div>
                  </div>

                  <div class="col-md-5 d-flex justify-content-center mt-4 mt-md-6">
                    <div class="icon-box">
                      <div class="icon"><i class="fas fa-hospital-user"></i></div>
                      <h4><a href="" class="text-decoration-none">Invisible Aligners/ Braces</a></h4>
                      <p>Procedure Estimated Time: 1 hour and 30 minutes.</p>
                      <p>Price Range: ₱57k to ₱90k. Downpayment 30%</p>
                    </div>
                  </div>

                  <div class="col-md-5 d-flex justify-content-center mt-4 mt-md-6">
                    <div class="icon-box">
                      <div class="icon"><i class="fas fa-dna"></i></div>
                      <h4><a href="" class="text-decoration-none">Oral Prophylaxis</a></h4>
                      <p>Procedure Estimated Time: - 30 minutes to 1 hour.</p>
                      <p>Price Range: ₱500 to ₱1500</p>
                      <p>Deep Cleaning: ₱3000</p>
                    </div>
                  </div>
                  <div class="col-md-5 d-flex justify-content-center  mt-4 mt-md-6">
                    <div class="icon-box">
                      <div class="icon"><i class="fas fa-dna"></i></div>
                      <h4><a href="" class="text-decoration-none">Tooth Restoration</a></h4>
                      <p>Procedure Estimated Time: 30 minutes to 1 hour.</p>
                      <p>Price Range: ₱500 to ₱1200 per tooth.</p>
                      <p>Aesthetic Restoration: ₱1000 to ₱3000.</p>
                    </div>
                  </div>
                  <div class="col-md-5 d-flex justify-content-center mt-4 mt-md-6">
                    <div class="icon-box">
                      <div class="icon"><i class="fas fa-dna"></i></div>
                      <h4><a href="" class="text-decoration-none">Root Canal Treatment</a></h4>
                      <p>Procedure Estimated Time: - 1 hour to 3 hours</p>
                      <p>Price Range: ₱7000 per canal.</p>
                    </div>
                  </div>
                </div>

              </div>
            </div>
          </div><!-- End testimonial item -->

          <div class="swiper-slide">
            <div class="testimonial-wrap">
              <div class="testimonial-item">

                <div class="row">
                  <div class="col-md-5 d-flex justify-content-center">
                    <div class="icon-box">
                      <div class="icon"><i class="fas fa-heartbeat"></i></div>
                      <h4><a href="" class="text-decoration-none">Tooth Extraction</a></h4>
                      <p>Procedure Estimated Time: Simple Extraction: 30 minutes <br>
                        Complicated Extraction: 1 hour</p>
                        <p>Simple Extraction: ₱500 to ₱1k per tooth.
                        Molars/Bagang Extraction: ₱1k to ₱3k per tooth.
                        Wisdom Tooth Removal: ₱8k to ₱10k per tooth.</p>
                    </div>
                  </div>

                  <div class="col-md-5 d-flex justify-content-center mt-4 mt-md-6 mt-md-0">
                    <div class="icon-box">
                      <div class="icon"><i class="fas fa-pills"></i></div>
                      <h4><a href="" class="text-decoration-none">Wisdom Tooth Removal</a></h4>
                      <p>Procedure Estimated Time: - 1 hour and 30 minutes. to 2 hours</p>
                      <p>Price Range: ₱8000 to ₱10k per tooth.</p>
                    </div>
                  </div>

                  <div class="col-md-5 d-flex justify-content-center mt-4 mt-md-6">
                    <div class="icon-box">
                      <div class="icon"><i class="fas fa-hospital-user"></i></div>
                      <h4><a href="" class="text-decoration-none">Teeth Whitening</a></h4>
                      <p>Procedure Estimated Time: - 1 hour and 30 minutes.</p>
                      <p>Price Range: ₱6000 with 1 session, 2 cycles.</p>
                    </div>
                  </div>

                  <div class="col-md-5 d-flex justify-content-center mt-4 mt-md-6">
                    <div class="icon-box">
                      <div class="icon"><i class="fas fa-dna"></i></div>
                      <h4><a href="" class="text-decoration-none">Crowns and Bridges</a></h4>
                      <p>Procedure Estimated Time: 1 hour and 30 minutes. 2 hours</p>
                      <p>Price Range: -Plastic Jacket/Crown ₱6500 per tooth
                        -Porcelain / Tilite ₱9k per tooth
                        -Zirconia Crown ₱25k per tooth
                        -Emax Crown ₱25k per tooth</p>
                    </div>
                  </div>

                  <div class="col-md-5 d-flex justify-content-center mt-4 mt-md-6">
                    <div class="icon-box">
                      <div class="icon"><i class="fas fa-dna"></i></div>
                      <h4><a href="" class="text-decoration-none">Veneers</a></h4>
                      <p>Procedure Estimated Time: First appointment: 1 hour to 2 hours<br>
                        - Second Appointment: 2 hours to 3 hours</p>
                        <p>Price Range: Direct Veneers ₱3000 per tooth
                          Emax Veneers ₱25k per tooth</p>
                    </div>
                  </div>

                  <div class="col-md-5 d-flex justify-content-center mt-4 mt-md-6">
                    <div class="icon-box">
                      <div class="icon"><i class="fas fa-dna"></i></div>
                      <h4><a href="" class="text-decoration-none">Complete Dentures</a></h4>
                      <p>Procedure Estimated Time:  1 hour and 30 minutes.</p>
                      <p>Price Range: ₱12,500 Complete Denture</p>
                    </div>
                  </div>
                </div>

              </div>
            </div>
          </div><!-- End testimonial item -->

          <div class="swiper-slide">
            <div class="testimonial-wrap">
              <div class="testimonial-item">

                <div class="row">
                  <div class="col-md-5 d-flex justify-content-center">
                    <div class="icon-box">
                      <div class="icon"><i class="fas fa-heartbeat"></i></div>
                      <h4><a href="" class="text-decoration-none">Removable Dentures (Ordinary & Flexite)</a></h4>
                      <p>Procedure Estimated Time: 1 hour to 2 hours</p>
                      <p>Price Range: Ordinary: ₱15k to ₱50k <br> Flexite: ₱20k to ₱60k</p>
                    </div>
                  </div>

                  <div class="col-md-5 d-flex justify-content-center mt-4 mt-md-6 mt-md-0">
                    <div class="icon-box">
                      <div class="icon"><i class="fas fa-pills"></i></div>
                      <h4><a href="" class="text-decoration-none">Pediatric Dentistry</a></h4>
                      <p>Procedure Estimated Time: 1 hour and 30 mins</p>
                    </div>
                  </div>

                  <div class="col-md-5 d-flex justify-content-center mt-4 mt-md-6">
                    <div class="icon-box">
                      <div class="icon"><i class="fas fa-hospital-user"></i></div>
                      <h4><a href="" class="text-decoration-none">Digital Panoramic X-Ray</a></h4>
                      <p>Procedure Estimated Time: 10 minutes to 20 minutes</p>
                      <p>Price Range: ₱800</p>
                    </div>
                  </div>

                  <div class="col-md-5 d-flex justify-content-center mt-4 mt-md-6">
                    <div class="icon-box">
                      <div class="icon"><i class="fas fa-dna"></i></div>
                      <h4><a href="" class="text-decoration-none">Periapical X-Ray</a></h4>
                      <p>Procedure Estimated Time: 5 minutes to 10 minutes</p>
                      <p>Price Range: ₱500</p>
                    </div>
                  </div>

                  <div class="col-md-5 d-flex justify-content-center mt-4 mt-md-6">
                    <div class="icon-box">
                      <div class="icon"><i class="fas fa-dna"></i></div>
                      <h4><a href="" class="text-decoration-none">Implant</a></h4>
                      <p>Procedure Estimated Time: Surgical Implant: 1 hour to 3 hours</p>
                      <p>Price Range: ₱60k to ₱120k</p>
                    </div>
                  </div>
                </div>

              </div>
            </div>
          </div><!-- End testimonial item -->

        </div>
        <br>
        <br>
        <div class="swiper-pagination"></div>
      </div>

    </div>
  </section><!-- End Testimonials Section -->

  <!-- ======= Doctors Section ======= -->
  <section id="doctors" class="doctors">
    <div class="container">

      <div class="section-title">
        <h2>Doctors</h2>
        <p>Introduce patients to get to know the dentists who will be providing their care. It includes professional photos of each team member, along with information about their profession, expertise, and years of experience. This information can help patients select a dentist who has the specific qualifications and experience to meet their needs.</p>
      </div>

      <div class="row">

        <div class="col-lg-6">
          <div class="member d-flex align-items-start">
            <div class="pic"><img src=doctor/assets/img/doctors/doc1.jpg class="img-fluid" alt=""></div>
            <div class="member-info">
              <h4>Dr. Chloe Hernando</h4>
              <span>Aesthetic Dentistry, Orthodontics, Oral Surgery</span>
              <p>I'm Chloe with 4 and half years of experience who specializes in aesthetic dentistry, orthodontics, oral Surgery. 
              </p>
            </div>
          </div>
        </div>

        <div class="col-lg-6 mt-4 mt-lg-0">
          <div class="member d-flex align-items-start">
            <div class="pic"><img src="doctor/assets/img/doctors/doc2.jpg" class="img-fluid" alt=""></div>
            <div class="member-info">
              <h4>Dr. Mikk Eusebio</h4>
              <span>Aesthetic Dentistry, Orthodontic</span>
              <p>I'm Mikk with 1 and half years of experience who specializes in esthetic dentistry, orthodontics. </p>
            </div>
          </div>
        </div>

        <div class="col-lg-6 mt-4">
          <div class="member d-flex align-items-start">
            <div class="pic"><img src="doctor/assets/img/doctors/docc3.jpg" class="img-fluid" alt=""></div>
            <div class="member-info">
              <h4>Dr. Alroze Regala</h4>
              <span>Aesthetic Dentistry and Orthodontics</span>
              <p>I'm Alroze, a Smile Haven dental expert with 1 and half years of experience who specializes in esthetic dentistry, orthodontics.</p>
            </div>
          </div>
        </div>

        <div class="col-lg-6 mt-4">
          <div class="member d-flex align-items-start">
            <div class="pic"><img src="doctor/assets/img/doctors/assistant.png" class="img-fluid" alt=""></div>
            <div class="member-info">
              <h4>Asst. Rica Francisco Calumarde</h4>
              <span>Assistant Doctor</span>
              <p>I'm Rica, an assistant dental doctor who is dedicated to assisting and improving my patients' overall oral health.</p>             
            </div>
          </div>
        </div>

      </div>

    </div>
  </section><!-- End Doctors Section -->

  <!-- ======= Frequently Asked Questions Section ======= -->
  <section id="faq" class="faq section-bg">
    <div class="container">

      <div class="section-title">
        <h2>Frequently Asked Questions</h2>
        <p>Welcome to the A+ Dental Clinic FAQ page! We understand that visiting the dentist can sometimes be confusing or overwhelming, so we've compiled a list of frequently asked questions to help make your experience with us as smooth and stress-free as possible. If you have any additional questions, please don't hesitate to reach out to us. Thank you for choosing A+ Dental Clinic!</p>
      </div>

      <div class="faq-list">
        <ul>
          <li data-aos="fade-up">
            <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse" class="collapse" data-bs-target="#faq-list-1">Where is your location? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
            <div id="faq-list-1" class="collapse show" data-bs-parent=".faq-list">
              <p><i class="bi bi-geo-alt"></i>
                Paranaque Branch: Unit #6 8263 St. Francis Mall D. Arcadio Santos Avenue Brgy. San Dionisio Parañaque City 1700, Parañaque, Philippines
                <br><i class="bi bi-geo-alt"></i> Quezon Branch: Ground Floor, RGG Building, 71 Kamias Road, Diliman, Quezon City.

              </p>
            </div>
          </li>

          <li data-aos="fade-up" data-aos-delay="100">
            <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse" data-bs-target="#faq-list-2" class="collapsed">How much is the Down payment for Metal braces? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
            <div id="faq-list-2" class="collapse" data-bs-parent=".faq-list">
              <p>
                It ranges in price from PHP 35,000 to PHP 40,000, with a minimum down payment of PHP 5,000. The monthly adjustment fee is PHP 1,500. </p>
            </div>
          </li>

          <li data-aos="fade-up" data-aos-delay="200">
            <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse" data-bs-target="#faq-list-3" class="collapsed">How much is the Down payment for Ceramic Braces? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
            <div id="faq-list-3" class="collapse" data-bs-parent=".faq-list">
              <p>
                It ranges in price from PHP 49,000 to PHP 65,000, with a minimum down payment of PHP 5,000. The monthly adjustment fee is PHP 1,500. </p>
            </div>
          </li>

          <li data-aos="fade-up" data-aos-delay="300">
            <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse" data-bs-target="#faq-list-4" class="collapsed">How much is pasta? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
            <div id="faq-list-4" class="collapse" data-bs-parent=".faq-list">
              <p>
                Depending on your condition, the cost of tooth restoration or tooth filling ranges between Php 1,000 and Php 2,000.
              <ul class="list-group list-group-flush">
                <li class="list-group-item">Simple Tooth Extraction costs Php 500 to Php 1,000 per tooth</li>
                <li class="list-group-item">Molars/Bagang Extraction costs Php 1,000 to Php 3,000 per tooth</li>
                <li class="list-group-item">Wisdom Tooth Removal costs Php 8,000 to Php 10,000 per tooth</li>
              </ul>
              </p>
            </div>
          </li>

          <li data-aos="fade-up" data-aos-delay="400">
            <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse" data-bs-target="#faq-list-5" class="collapsed">How much is tooth extraction? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
            <div id="faq-list-5" class="collapse" data-bs-parent=".faq-list">
              <p>
                Our clinic offers three types of tooth extraction which are Simple Tooth Extraction, Molars/Bagang Extraction and Wisdom tooth Extraction. The price varies depending on the type of your extraction.
              </p>
            </div>
          </li>

        </ul>
      </div>

    </div>
  </section><!-- End Frequently Asked Questions Section -->

  <!-- ======= Testimonials Section ======= -->
 <!-- End Testimonials Section -->

  <!-- ======= Gallery Section ======= -->
  <section id="gallery" class="gallery">
    <div class="container">

      <div class="section-title">
        <h2>Gallery</h2>
        <p>Welcome to the A+ Dental Clinic gallery! Here, you'll have the opportunity to see some of the amazing transformations we've helped our patients achieve through our advanced dental treatments and services. Take a look at how we prepare for your appointments and during your operation, and see the quality of care you can expect when you visit us. We're proud of the results we've achieved and can't wait to help you achieve your own perfect smile. Thank you for choosing A+ Dental Clinic!</p>
      </div>
    </div>

    <div class="container-fluid">
      <div class="row g-0">

        <div class="col-lg-3 col-md-4">
          <div class="gallery-item">
            <a href="assets/img/gallery/gallery1.jpg" class="galelry-lightbox">
              <img src="assets/img/gallery/gallery1.jpg" alt="" class="img-fluid">
            </a>
          </div>
        </div>

        <div class="col-lg-3 col-md-4">
          <div class="gallery-item">
            <a href="assets/img/gallery/gallery2.jpg" class="galelry-lightbox">
              <img src="assets/img/gallery/gallery2.jpg" alt="" class="img-fluid">
            </a>
          </div>
        </div>

        <div class="col-lg-3 col-md-4">
          <div class="gallery-item">
            <a href="assets/img/gallery/gallery3.jpg" class="galelry-lightbox">
              <img src="assets/img/gallery/gallery3.jpg" alt="" class="img-fluid">
            </a>
          </div>
        </div>

        <div class="col-lg-3 col-md-4">
          <div class="gallery-item">
            <a href="assets/img/gallery/gallery4.jpg" class="galelry-lightbox">
              <img src="assets/img/gallery/gallery4.jpg" alt="" class="img-fluid">
            </a>
          </div>
        </div>

        <div class="col-lg-3 col-md-4">
          <div class="gallery-item">
            <a href="assets/img/gallery/gallery5.jpg" class="galelry-lightbox">
              <img src="assets/img/gallery/gallery5.jpg" alt="" class="img-fluid">
            </a>
          </div>
        </div>

        <div class="col-lg-3 col-md-4">
          <div class="gallery-item">
            <a href="assets/img/gallery/gallery6.jpg" class="galelry-lightbox">
              <img src="assets/img/gallery/gallery6.jpg" alt="" class="img-fluid">
            </a> 
          </div>
        </div>

        <div class="col-lg-3 col-md-4">
          <div class="gallery-item">
            <a href="assets/img/gallery/gallery7.jpg" class="galelry-lightbox">
              <img src="assets/img/gallery/gallery7.jpg" alt="" class="img-fluid">
            </a>
          </div>
        </div>

        <div class="col-lg-3 col-md-4">
          <div class="gallery-item">
            <a href="assets/img/gallery/gallery8.jpg" class="galelry-lightbox">
              <img src="assets/img/gallery/gallery8.jpg" alt="" class="img-fluid">
            </a>
          </div>
        </div>

      </div>

    </div>
  </section><!-- End Gallery Section -->

  <!-- ======= Contact Section ======= -->
  <section id="contact" class="contact">
    <div class="container">

      <div class="section-title">
        <h2>Contact Us</h2>
        <p>Welcome to the "contact us" section of the A+ Dental Clinic! Our team is dedicated to providing you with the best dental care possible, and we're here to assist you in any way we can. Whether you have a question, a concern, or would like to schedule an appointment, we're just a phone call or email away. Don't hesitate to reach out to us; we're here to help! Thank you for choosing A+ Dental Clinic.</p>
      </div>
    </div>

    <div>
      <iframe style="border:0; width: 100%; height: 350px;" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3863.1627638568148!2d120.99909505035008!3d14.475341489832674!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397cff6097aa5eb%3A0x51140b2330c294ab!2sA%2B%20Dental%20Care%20Haven%20Incorporated!5e0!3m2!1sen!2sph!4v1681222905460!5m2!1sen!2sph" frameborder="0" allowfullscreen>></iframe>
    </div>

    <div class="container">
      <div class="row mt-5">

        <div class="col-lg-4">
          <div class="info">
            <div class="address">
              <i class="bi bi-geo-alt"></i>
              <h4>Location:</h4>
              <p>Branch# 1: Unit #6 8263 St. Francis Mall D. Arcadio Santos Ave. Brgy.San Dionisio Para&#241;aque City 1700</p>
              <br>
              <p>Branch# 2: Ground Floor, RGG Building, 71 Kamias Road, Diliman, Quezon City</p>
            </div>

            <div class="email">
              <i class="bi bi-envelope"></i>
              <h4>Email:</h4>
              <p>aplusdch@gmail.com</p>
            </div>

            <div class="phone">
              <i class="bi bi-phone"></i>
              <h4>Call:</h4>
              <p>Landline - (02) 8661 4827</p>
              <p>Smart - 0910-745-8298</p>
              <p>Globe - 0955-457-8899</p>
            </div>

          </div>

        </div>

       <div class="col-lg-8 mt-5 mt-lg-0">

<form name="frmContact" class="needs-validation " method="post" action="contact-index.php">
  <div class="row">
    <div class="col-md-6 form-group">
      <input type="text" class="form-control" name="txtName" id="txtName" placeholder="Name" value="" required>
      <div class="invalid-feedback">
        Valid first name is required.
      </div>
    </div>
    <div class="col-md-6 form-group mt-3 mt-md-0">
      <input type="text" class="form-control" name="txtEmail" id="txtEmail" placeholder="Email" value="" required>
    </div>
  </div>
  <div class="form-group mt-3">
    <input type="text" class="form-control" name="txtSubject" id="txtSubject" placeholder="Subject" value="" required>
  </div>
  <div class="form-group mt-3">
    <textarea name="txtMessage" class="form-control pb-5" id="txtMessage" placeholder="Message" required></textarea>
  </div>
  <div class="form-group mt-3 text-center">
  <input type="submit" name="Submit" id="Submit" value="Submit" class="btn btn-primary btn-lg btn-block">
      </div>
</form>

        </div>

      </div>

    </div>
  </section><!-- End Contact Section -->

  <!--<div class="h5 mb-0 font-weight-bold text-gray-800" id="count"></div>-->
x
</main><!-- End #main -->

<!-- ======= Footer ======= -->
<footer id="footer">

  <div class="container d-md-flex py-4">

    <div class="me-md-auto text-center text-md-start">
      <div class="copyright">
        &copy; Copyright <strong><span>Smile Haven</span></strong>. All Rights Reserved
      </div>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/medilab-free-medical-bootstrap-theme/ -->
        Designed by <a href="https://bootstrapmade.com/">Smile Haven</a>
      </div>
    </div>
    <div class="social-links text-center text-md-right pt-3 pt-md-0">
      <a href="https://www.facebook.com/aplusDCH/" target="_blank" class="facebook"><i class="bx bxl-facebook"></i></a>
      <a href="https://www.instagram.com/aplusdchqc/" target="_blank" class="instagram"><i class="bx bxl-instagram"></i></a>
    </div>
  </div>
</footer><!-- End Footer -->

<div id="preloader"></div>
<a href="#" class="back-to-top d-flex align-items-center "><i class="bi bi-arrow-up-short"></i></a>

<!-- Vendor JS Files -->
<script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
<script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
<script src="assets/vendor/php-email-form/validate.js"></script>

<!-- Template Main JS File -->
<script src="assets/js/main.js"></script>

    <script>
    var BotStar = {
        appId: "sa9b7c8d0-ffde-11ed-bfdb-21a5ffa65a27",
        mode: "livechat"
    };
    !function(t,a){
        var e=function(){(e.q=e.q||[]).push(arguments)};
        e.q=e.q||[],t.BotStarApi=e;
        var s=a.createElement("script");
        s.type="text/javascript",s.async=1,s.src="https://widget.botstar.com/static/js/widget.js";
        var n=a.getElementsByTagName("script")[0];
        n.parentNode.insertBefore(s,n)
    }(window,document);
</script>