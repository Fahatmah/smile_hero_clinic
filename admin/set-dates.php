<?php
require_once '../includes/config_session.inc.php';
require_once '../includes/login_view.inc.php';
require_once '../includes/appointment_view.inc.php';

if (!isset($_SESSION['adminID'])) {
  // Redirect user to login if not logged in
  header("Location: ../login.php?login=failed");
  exit();
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      rel="shortcut icon"
      href="../assets/images/logoipsum.svg"
      type="image/x-icon"
    />
    <title>Set Dates | Admin</title>
    <link rel="stylesheet" href="../src/dist/styles.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
  </head>
  <body class="admin__page">
    <main class="admin__main">
      <!-- nav header -->
      <?php include("includes/nav.php"); ?>

      <section class="admin__content">
        <!-- side bar -->
        <?php include("includes/side_nav.php"); ?>

        <div class="set-date-container">
          <h1>Create Appointment Dates</h1>

          <form action="" method="post" id="">
            <!-- <div class="field-group">
              <label for="start-date">Start Date</label>
              <input type="date" id="start-date" name="start_date" required />
            </div>

            <div class="field-group">
              <label for="end-date">End Date</label>
              <input type="date" id="end-date" name="end_date" required />
            </div>
            <button type="submit">Generate Appointment Dates</button> -->

            <div class="field-group">
                        <label for="dates">Select Available Dates</label>
                        <input type="text" id="dates" name="dates" placeholder="Select dates" required />
                    </div>
                    <button type="submit">Generate Appointment Dates</button>
          </form>
        </div>
      </section>
    </main>
  </body>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      flatpickr("#dates", {
          mode: "multiple",
          dateFormat: "Y-m-d",
          minDate: "today",
          onChange: function(selectedDates) {
              const datesArray = selectedDates.map(date => date.toLocaleDateString('en-CA'));
              console.log(datesArray); // for debugging purposes
          }
          });
      });
    </script>
</html>
