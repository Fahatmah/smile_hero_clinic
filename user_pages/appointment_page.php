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
    <?php include('includes/nav.php'); ?>

    <!-- navigation side nav -->
    <?php include('includes/sidenav.php'); ?>

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