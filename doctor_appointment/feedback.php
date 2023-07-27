<?php

//dashboard.php



include('class/Appointment.php');

$object = new Appointment;

include('header.php');

?>

<div class="container-fluid">

  <!-- ======= Feedback Section ======= -->
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
          <div class="info bg-transparent">
            <div class="address">
              <i class="bi bi-geo-alt"></i>
              <h4>Location:</h4>
              <p style="font-weight: 800;">Branch# 1: Unit #6 8263 St. Francis Mall D. Arcadio Santos Ave. Brgy.San Dionisio Para&#241;aque City 1700</p>
              <br>
              <p style="font-weight: 800;">Branch# 2: Ground Floor, RGG Building, 71 Kamias Road, Diliman, Quezon City</p>
            </div>

            <div class="email">
              <i class="bi bi-envelope"></i>
              <h4>Email:</h4>
              <p style="font-weight: 800;">aplusdch@gmail.com</p>
            </div>

            <div class="phone">
              <i class="bi bi-phone"></i>
              <h4>Call:</h4>
              <p style="font-weight: 800;" v>Landline - (02) 8661 4827</p>
              <p style="font-weight: 800;">Smart - 0910-745-8298</p>
              <p style="font-weight: 800;">Globe - 0955-457-8899</p>
            </div>

          </div>

        </div>

        <div class="col-lg-8 mt-5 mt-lg-0 text-center">

          <form name="frmContact" class="needs-validation " method="post" action="contact.php">
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
            <input type="submit" name="Submit" id="Submit" value="Submit" class="btn btn-primary btn-lg btn-block mt-4">
          </form>

        </div>

      </div>

    </div>
  </section><!-- End Contact Section -->

  <?php

  include('footer2.php');


  ?>
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
        appId: "s55176d70-f32d-11ed-bd07-6d62b0f47674",
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