<?php
// require_once '../includes/config_session.inc.php';
session_start();
require_once '../includes/login_view.inc.php';
require_once '../includes/dbh.inc.php';

if(!isset($_SESSION['user_id'])) {
   // Redirect user to login if not logged in
   header("Location: ../login.php");
   exit();
} 

require_once 'includes/user_model.inc.php';

$user_id = $_SESSION['user_id'];

$totalAppointment = isValidRegularPatient($conn, $user_id);

if($totalAppointment >= 5){
  $query = "UPDATE users SET label = 'regular' WHERE user_id = ?";
  $stmt = $conn->prepare($query);
  $stmt->bind_param("s",$user_id);
  $stmt->execute();
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="../assets/logos/logo-white.png" type="image/x-icon" />
    <title>Homepage | Smile Hero Clinic</title>
    <link rel="stylesheet" href="../src/dist/styles.css" />
  </head>
  <body class="user-homepage">
    <main>
      <!-- user navigation -->
      <nav class="navbar__user" aria-label="Main Navigation">
        <!-- logo -->
        <div class="navbar__user-logo">
          <a href="#" aria-label="Smile Hero Clinic Homepage">
            <img src="../assets/logos/logo-with-name-blue.png" alt="smile hero clinic logo">
          </a>
        </div>
        <!-- end of logo -->

        <div class="navbar__user-menu" role="menu">
          <button
            type="button"
            class="menu__button"
            id="logoutBtn"
            role="menuitem"
          >
            <a href="../includes/logout.php">Logout</a>
          </button>
          <button
            type="button"
            class="menu__button"
            role="menuitem"
            id="accountBtn"
          >
            <a href="profile.php"
              >Account
              <img
                src="../assets/icons/user_account/arrow-up-small.svg"
                alt="Arrow icon"
              />
            </a>
          </button>
        </div>
      </nav>
      <!-- end of user navigation -->

      <!-- hero -->
      <header class="hero">
        <h1>Welcome to Smile Hero <span class="circle-span">Clinic</span></h1>
        <section class="hero__details" aria-labelledby="clinicInfo">
          <ul class="contact__info" aria-label="Clinic Contact Information">
            <li>
              Ground Floor Amber Place, #67 Bayani Road, Western Bicutan, Fort
              Bonifacio, Taguig, Philippines
            </li>
            <li>Monday to Sunday</li>
            <li>0917 160 6212</li>
          </ul>
          <p class="current__date">Loading...</p>
        </section>
      </header>
      <!-- end of hero -->

      <!-- about -->
      <section class="about" aria-labelledby="aboutTitle">
        <div class="about__intro">
          <h2 id="aboutTitle">
            Your Trusted Partner for Comprehensive Dental Care
          </h2>
          <p class="sub-header">
            We make booking easy with our web-based appointment system. Schedule
            your dental visits quickly from anywhere—home, work, or on the go.
          </p>
        </div>

        <article class="services" aria-labelledby="servicesTitle">
          <h3 id="servicesTitle">Our Services</h3>
          <ul class="services__list" aria-label="List of Dental Services">
            <li>
              <img
                src="../assets/icons/user_account/check-icon.svg"
                alt="Check icon"
              />
              Routine dental check-ups and cleanings
            </li>
            <li>
              <img
                src="../assets/icons/user_account/check-icon.svg"
                alt="Check icon"
              />
              Cosmetic dentistry, such as teeth whitening and veneers
            </li>
            <li>
              <img
                src="../assets/icons/user_account/check-icon.svg"
                alt="Check icon"
              />
              Orthodontic treatments, including braces and Invisalign
            </li>
            <li>
              <img
                src="../assets/icons/user_account/check-icon.svg"
                alt="Check icon"
              />
              Restorative procedures like fillings, crowns, and bridges
            </li>
            <li>
              <img
                src="../assets/icons/user_account/check-icon.svg"
                alt="Check icon"
              />
              Emergency dental services
            </li>
          </ul>
          <a class="appointment__button" href="appointment_form_page.php" role="button">
            Book Your Appointment
            <img
              src="../assets/icons/user_account/arrow-up-large.svg"
              alt="Arrow icon"
            />
          </a>
        </article>
      </section>
      <!-- end of about -->
    </main>

    <script>
      function getDate() {
        let currentDate = document.querySelector('.current__date')
        let date = new Date()

        const days = [
          'Sunday',
          'Monday',
          'Tuesday',
          'Wednesday',
          'Thursday',
          'Friday',
          'Saturday',
        ]
        let day = days[date.getDay()]
        let hours = date.getHours()
        let minutes = date.getMinutes()

        let ampm = hours >= 12 ? 'pm' : 'am'
        hours = hours % 12 || 12

        const formattedMinutes = minutes < 10 ? `0${minutes}` : minutes

        currentDate.innerText = `Today is ${day} ${hours}:${formattedMinutes}${ampm}`
      }

      setInterval(getDate, 1000)
    </script>
  </body>
</html>
