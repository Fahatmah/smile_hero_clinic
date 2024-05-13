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
    <title>Account | Smile Hero Clinic</title>
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
          <li class="active__link">
            <a href="#">
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
          <li>
            <a href="../user_pages/dental_history.php">
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

      <!-- profile info -->
      <section class="profile__info account__container">
        <h1>Your account information</h1>
        <div class="info__header">
          <!-- details -->
          <div class="details__container">
            <img
              src="../assets/images/default_profile_image.png"
              alt="profile image"
              style="width: 90px; height: 90px"
            />
            <div class="user__details">
              <h2 class="user__name" id="headerUserName">Fahatmah Mabang</h2>
              <p class="user__address" id="headerUserAddress">
                Reyes, Purok 3, Bicutan, Taguig City
              </p>
            </div>
          </div>
          <!-- action button -->
          <button class="delete__button" id="deleteAccountBtn">
            Delete Account
          </button>
        </div>

        <!-- more details -->
        <div class="additional_details__container">
          <div class="item">
            <div class="details">
              <p class="detail__header">Name</p>
              <p class="full__name" id="fullName">Fahatmah Mabang</p>
            </div>
            <button class="edit__button">Edit</button>
          </div>
          <div class="item">
            <div class="details">
              <p class="detail__header">Contact Number</p>
              <p class="contact__number" id="contactNumber">09123456789</p>
            </div>
            <button class="edit__button">Edit</button>
          </div>
          <div class="item">
            <div class="details">
              <p class="detail__header">Address</p>
              <p class="address" id="address">
                Reyes, Purok 3, Bicutan, Taguig City
              </p>
            </div>
            <button class="edit__button">Edit</button>
          </div>
          <div class="item">
            <div class="details">
              <p class="detail__header">Email</p>
              <p class="email" id="email">fahatmahmabang@gmail.com</p>
            </div>
            <button class="edit__button">Edit</button>
          </div>
          <div class="item">
            <div class="details">
              <p class="detail__header">Password</p>
              <p class="password" id="password">********</p>
            </div>
            <button class="edit__button">Edit</button>
          </div>
        </div>
      </section>
    </main>
  </body>
</html>