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
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&display=swap"
    rel="stylesheet">
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
      <div class="account">
        <div class="header">
          <h1>Your appointment</h1>
          <a class="appointment__button" href="../user_pages/appointment_form_page.php" target="_blank">
            Create New Appointment
          </a>
        </div>

        <div class="appointment__container">
          <div class="header">
            <h2>Appointment Date</h2>
            <h3>Remove</h3>
          </div>

          <div class="appointments">
            <div class="item">
              <!-- header -->
              <?php if ($row = $result->fetch_assoc()) { ?>
              <div class="item_header">
                <p class="appoinment_date" id="appointmentDate">Appointment ID: <?php echo $row["appointment_id"]; ?>
                </p>
                <button class="remove__button" id="removeAppointmentBtn">
                  Cancel
                </button>
              </div>

              <!-- appointment container -->
              <div class="appointment">
                <!-- appointment header -->
                <div class="appointment_header">
                  <p>Personal Details</p>
                  <p>Preferences</p>
                </div>
                <div class="appointment_details">
                  <div class="details__container">
                    <div class="details">
                      <!-- name -->
                      <div class="detail">
                        <p class="detail_header">Name</p>
                        <p class="detail_content" id="appName"><?php echo $row["name"]; ?></p>
                      </div>

                      <!-- date -->
                      <div class="detail">
                        <p class="detail_header">Date</p>
                        <p class="detail_content" id="appDate"><?php echo $row["date"]; ?></p>
                      </div>

                      <!-- email -->
                      <div class="detail">
                        <p class="detail_header">Email</p>
                        <p class="detail_content" id="appEmail"><?php echo $row["email"]; ?></p>
                      </div>

                      <!-- time -->
                      <div class="detail">
                        <p class="detail_header">Time</p>
                        <p class="detail_content" id="appTime"><?php echo $row["time"]; ?></p>
                      </div>

                      <!-- contact number -->
                      <div class="detail">
                        <p class="detail_header">Contact Number</p>
                        <p class="detail_content" id="appContact"><?php echo $row["contact"]; ?></p>
                      </div>

                      <!-- location -->
                      <div class="detail">
                        <p class="detail_header">Location</p>
                        <p class="detail_content" id="appLoc"><?php echo $row["location"]; ?></p>
                      </div>

                      <!-- message/requests -->
                      <div class="detail">
                        <p class="detail_header">Message</p>
                        <p class="detail_content" id="appMessage"><?php echo $row["message"]; ?></p>
                      </div>
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
      </div>
    </section>
  </main>
</body>

</html>