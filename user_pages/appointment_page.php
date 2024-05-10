<?php
require_once '../includes/config_session.inc.php';
require_once '../includes/login_view.inc.php';
require_once '../includes/appointment_view.inc.php';

require_once '../includes/dbh.inc.php';

if(isset($_SESSION['user_id'])) {
  $user_id = $_SESSION['user_id'];

  // Fetch appointments for the user
  $query = "SELECT * FROM appointments WHERE user_id = ?";
  $stmt = $conn->prepare($query);
  $stmt->bind_param("s", $user_id);
  $stmt->execute();
  $result = $stmt->get_result();
} else {
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
    <title>Appointment | Smile Hero Clinic</title>
    <link rel="stylesheet" href="../src/dist/styles.css" />
  </head>
  <body>
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
            <a href="../user_pages/profile.html">
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
          <li class="active__link">
            <a href="#">
              <img
                src="../assets/icons/user_account/appointments.png"
                alt=""
                style="width: 1.375rem; height: 1.375rem"
              />
              Appointments
            </a>
          </li>
          <li>
            <a href="../user_pages/dental_history.html">
              <img
                src="../assets/icons/user_account/medical_history.png"
                alt=""
                style="width: 1.375rem; height: 1.375rem"
              />
              Dental History
            </a>
          </li>
          <li>
            <a href="../user_pages/faqs_questions.html">
              <img
                src="../assets/icons/user_account/faqs_questions.png"
                alt=""
                style="width: 1.375rem; height: 1.375rem"
              />
              FAQs & Questions
            </a>
          </li>
          <li>
            <a href="../user_pages/feedback.html">
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
                <input type="submit" style="cursor: pointer;" class="logout__button" value="Logout"> 
            </form>
          </li>
        </ul>
      </nav>

      <!-- appointment page -->
      <section class="appointment__page account__container">
        <div class="header">
          <h1>Your appointment</h1>
          <a
            class="appointment__button"
            href="../user_pages/appointment_form_page.php"
            target="_blank"
          >
            Create New Appointment
          </a>
        </div>

        <div class="appointment__container">
          <div class="header">
            <h2>Appointment Date</h2>
            <h3>Remove</h3>
          </div>

          <div class="appointments">
            <div class="appointment">

            <?php if ($row = $result->fetch_assoc()) { ?>
              <div class="date">
                <p class="appoinment_date" id="appointmentDate">Appointment ID: <?php echo $row["appointment_id"]; ?></p>
                <button class="remove__button" id="removeAppointmentBtn">
                  Cancel
                </button>
              </div>
              <div class="details__container">
                <div class="detail__header">
                  <p>Personal Details</p>
                  <p>Preferences</p>
                </div>
                <div class="details">
                  <div class="detail">
                    <div class="item">
                      <p>Name</p>
                      <p id="name"><?php echo $row["name"]; ?></p>
                    </div>
                    <div class="item">
                      <p>Email</p>
                      <p id="email"><?php echo $row["email"]; ?></p>
                    </div>
                    <div class="item">
                      <p>Contact Number</p>
                      <p id="contactNumber"><?php echo $row["contact"]; ?></p>
                    </div>
                    <div class="item">
                      <p>Message</p>
                      <p id="message"><?php echo $row["message"]; ?></p>
                    </div>
                  </div>
                  <div class="detail">
                    <div class="item">
                      <p>Date</p>
                      <p id="date"><?php echo $row["date"]; ?></p>
                    </div>
                    <div class="item">
                      <p>Time</p>
                      <p id="time"><?php echo $row["time"]; ?></p>
                    </div>
                    <div class="item">
                      <p>Location</p>
                      <p id="location"><?php echo $row["location"]; ?></p>
                    </div>
                  </div>
                </div>
              </div>
              <?php } else {
                echo "<p> No Appointments Found. </p>";
              } 
              
              $conn->close()?>
            </div>
          </div>
        </div>
      </section>
    </main>
  </body>
</html>
