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

$sql = "SELECT * FROM homepage_info WHERE id = 1"; // Assuming there's only one row to fetch
$result = $conn->query($sql);
$content = $result->fetch_assoc();

$conn->close();
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
            <img src="../assets/logos/logo-with-name-blue.png" alt="smile hero clinic logo" style="width: 4rem; height: 4rem">
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
        <h1><?php echo htmlspecialchars($content['title']); ?></h1>
        <section class="hero__details" aria-labelledby="clinicInfo">
          <ul class="contact__info" aria-label="Clinic Contact Information">
            <li><?php echo htmlspecialchars($content['address']); ?></li>
            <li><?php echo htmlspecialchars($content['workdays']); ?></li>
            <li><?php echo htmlspecialchars($content['number']); ?></li>
          </ul>
          <p class="current__date">Loading...</p>
        </section>
      </header>
      <!-- end of hero -->

      <!-- about -->
      <section class="about" aria-labelledby="aboutTitle">
        <div class="about__intro">
          <h2 id="aboutTitle"><?php echo htmlspecialchars($content['subheader1']); ?></h2>
          <p class="sub-header"><?php echo htmlspecialchars($content['subheader2']); ?></p>
        </div>

        <article class="services" aria-labelledby="servicesTitle">
          <h3 id="servicesTitle">Our Services</h3>
          <ul class="services__list" aria-label="List of Dental Services">
            <?php
            $services = json_decode($content['services'], true);
            foreach ($services as $service) {
                echo '<li><img src="../assets/icons/user_account/check-icon.svg" alt="Check icon" />' . htmlspecialchars($service) . '</li>';
            }
            ?>
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
