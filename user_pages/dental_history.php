<?php
require_once '../includes/config_session.inc.php';
require_once '../includes/login_view.inc.php';
require_once '../includes/appointment_view.inc.php';
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Feedback Form | Smile Hero Clinic</title>
    <link rel="stylesheet" href="../src/dist/styles.css" />
  </head>
  <body>
  <?php outputUserId() ?>
    <main>
      <!-- navigation header bar -->
      <nav class="account__header">
        <img src="../assets/images/logoipsum.svg" alt="logo" class="logo" />
        <div class="account__profile_image">
          <img
            src="../assets/images/default_profile_image.png"
            alt="account image"
          />
        </div>
      </nav>

      <!-- navigation side nav -->
      <nav class="side__nav">
        <ul>
          <li>
            <a href="../user_pages/profile.php">
              <img
                src="../assets/icons/user_account/profile.png"
                alt=""
                style="width: 1.375rem; height: 1.375rem"
              />
              Profile
            </a>
          </li>
          <li>
            <a href="#">
              <img
                src="../assets/icons/user_account/moon.png"
                alt=""
                style="width: 1.375rem; height: 1.375rem"
              />
              Dark Theme
            </a>
          </li>
          <li>
            <a href="../user_pages/appointment_page.php">
              <img
                src="../assets/icons/user_account/appointments.png"
                alt=""
                style="width: 1.375rem; height: 1.375rem"
              />
              Appointments
            </a>
          </li>
          <li class="active__link">
            <a href="#">
              <img
                src="../assets/icons/user_account/medical_history.png"
                alt=""
                style="width: 1.375rem; height: 1.375rem"
              />
              Dental History
            </a>
          </li>
          <li>
            <a href="../user_pages/faqs_questions.php">
              <img
                src="../assets/icons/user_account/faqs_questions.png"
                alt=""
                style="width: 1.375rem; height: 1.375rem"
              />
              FAQs & Questions
            </a>
          </li>
          <li>
            <a href="../user_pages/feedback.php">
              <img
                src="../assets/icons/user_account/feedback.png"
                alt=""
                style="width: 1.375rem; height: 1.375rem"
              />
              Feedback
            </a>
          </li>
          <li>
            <form action="../includes/logout.php">
              <input
                type="submit"
                style="cursor: pointer"
                class="logout__button"
                value="Logout"
              />
            </form>
          </li>
        </ul>
      </nav>
    </main>
  </body>
</html>
