<?php
require_once '../includes/config_session.inc.php';
require_once '../includes/login_view.inc.php';

if(!isset($_SESSION['user_id'])) {
  // Redirect user to login if not logged in
  header("Location: ../login.php");
  exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="shortcut icon" href="../assets/images/logoipsum.svg" type="image/x-icon">
  <title>FAQs & Questions | Smile Hero Clinic</title>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&display=swap"
    rel="stylesheet" />
  <link rel="stylesheet" href="../src/dist/styles.css" />
</head>

<body>
  <main>
    <!-- navigation header bar -->
    <?php include('includes/nav.php'); ?>

    <!-- navigation side nav -->
    <?php include('includes/sidenav.php'); ?>

    <!--  -->
    <section class="faq_and_questions__page account__container">
      <div class="account">
        <h1>FAQs & Questions</h1>

        <div class="accordion">
          <div class="accordion_item active">
            <div class="accordion_header active">How do I schedule an appointment?

              <img src="../assets/icons/user_account/up_angle.png" alt="" class="arrow_angle">
            </div>
            <div class="accordion_content" style="display: block">
              To schedule an appointment, you can call our clinic directly or use the <strong>online booking
                system</strong> available on
              our website. Simply choose your preferred date and time, and <strong>we'll confirm your appointment via
                email.</strong> </div>
          </div>
          <div class="accordion_item">
            <div class="accordion_header">Can I cancel or reschedule my appointment online?
              <img src="../assets/icons/user_account/down_angle.png" alt="" class="arrow_angle">
            </div>
            <div class="accordion_content">
              Yes, you can cancel or reschedule your appointment online by logging into your Smile Hero Dental Clinic
              account. Go to the <strong>Appointments section</strong>, find the appointment you want to change, and
              follow the
              instructions to cancel or reschedule.
            </div>
          </div>
          <div class="accordion_item">
            <div class="accordion_header">What should I do if I have a dental emergency?
              <img src="../assets/icons/user_account/down_angle.png" alt="" class="arrow_angle">
            </div>
            <div class="accordion_content">
              If you have a dental emergency, <strong>please contact our clinic immediately</strong>. We offer
              emergency dental
              services
              and will do our best to accommodate you as soon as possible. For after-hours emergencies, please follow
              the
              instructions on our voicemail.
            </div>
          </div>
          <div class="accordion_item">
            <div class="accordion_header">How can I update my contact information?
              <img src="../assets/icons/user_account/down_angle.png" alt="" class="arrow_angle">
            </div>
            <div class="accordion_content">
              You can update your contact information, and other personal information by logging in to your Smile Hero
              Dental Clinic account and accessing the <strong>Profile section</strong>. From there, you can edit your
              information as
              needed and save the changes.
            </div>
          </div>
          <div class="accordion_item">
            <div class="accordion_header">Can I leave feedback or review my experience with Smile Hero Dental Clinic?
              <img src="../assets/icons/user_account/down_angle.png" alt="" class="arrow_angle">
            </div>
            <div class="accordion_content">
              We appreciate your feedback! You can leave a review of your experience by logging into your Smile Hero
              Dental Clinic account and navigating to the <strong>Feedback section</strong>. Your feedback helps us
              improve our services. </div>
          </div>
          <div class="accordion_item">
            <div class="accordion_header">Can I view my upcoming and past appointments online?
              <img src="../assets/icons/user_account/down_angle.png" alt="" class="arrow_angle">
            </div>
            <div class="accordion_content">
              Yes, you can view your upcoming and past appointments by logging in to your Smile Hero Dental Clinic
              account
              and accessing the <strong>Appointments section</strong>. There, you'll find a list of all your scheduled
              appointments,
              including date, time, and any additional details.
            </div>
          </div>
        </div>
      </div>

    </section>
  </main>

  <script>
  document.addEventListener('DOMContentLoaded', function() {
    const accordionHeaders = document.querySelectorAll('.accordion_header');

    accordionHeaders.forEach(header => {
      header.addEventListener('click', function() {
        const currentlyActiveHeader = document.querySelector('.accordion_header.active');
        const arrow = this.querySelector('.arrow_angle');

        if (currentlyActiveHeader && currentlyActiveHeader !== header) {
          currentlyActiveHeader.classList.remove('active');
          currentlyActiveHeader.nextElementSibling.style.display = 'none';
          const currentlyActiveArrow = currentlyActiveHeader.querySelector('.arrow_angle');
          currentlyActiveArrow.src = '../assets/icons/user_account/down_angle.png';
        }

        header.classList.toggle('active');
        const content = header.nextElementSibling;
        if (header.classList.contains('active')) {
          content.style.display = 'block';
          arrow.src = '../assets/icons/user_account/up_angle.png';
        } else {
          content.style.display = 'none';
          arrow.src = '../assets/icons/user_account/down_angle.png';
        }
      });
    });
  });
  </script>
</body>

</html>