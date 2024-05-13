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
    <title>Create an appointment | Smile Hero Clinic</title>
    <link rel="stylesheet" href="../src/dist/styles.css" />

    <style>
      input::-webkit-outer-spin-button,
      input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
      }
    </style>
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
            <img
              src="../assets/icons/user_account/profile.png"
              alt=""
              style="width: 1.375rem; height: 1.375rem"
            /><a href="#">Profile</a>
          </li>
          <li>
            <img
              src="../assets/icons/user_account/moon.png"
              alt=""
              style="width: 1.375rem; height: 1.375rem"
            /><button class="theme__button">Dark Theme</button>
          </li>
          <li class="active__link">
            <img
              src="../assets/icons/user_account/appointments.png"
              alt=""
              style="width: 1.375rem; height: 1.375rem"
            /><a href="../user_pages/appointment_page.html">Appointments</a>
          </li>
          <li>
            <img
              src="../assets/icons/user_account/medical_history.png"
              alt=""
              style="width: 1.375rem; height: 1.375rem"
            /><a href="../user_pages/dental_history.html">Dental History</a>
          </li>
          <li>
            <img
              src="../assets/icons/user_account/faqs_questions.png"
              alt=""
              style="width: 1.375rem; height: 1.375rem"
            /><a href="../user_pages/faqs_questions.html">FAQs & Questions</a>
          </li>
          <li>
            <img
              src="../assets/icons/user_account/feedback.png"
              alt=""
              style="width: 1.375rem; height: 1.375rem"
            /><a href="../user_pages/feedback.html">Feedback</a>
          </li>
          <li><a href="../index.html" class="logout__button">Logout</a></li>
        </ul>
      </nav>

      <!-- appointment form -->
      <section class="appointment_form__container account__container">
        <h1>Schedule fresh meeting</h1>

        <form action="../includes/appointment.inc.php" method="post" class="form">
       
          <!-- personal details -->
          <section class="personal__details">

          <?php checkAppointErrors() ?>
            <div class="field">
              <label for="name">Name</label>
              <input required
                type="text"
                name="name"
                id="name"
                placeholder="e.g. Fahatmah Mabang"
                value="<?php outputFullName() ?>"
              />
            </div>

            <div class="field">
              <label for="email">Email</label>
              <input required
                type="email"
                name="email"
                id="email"
                placeholder="e.g. fahatmahmabang@gmail.com"
                value=" <?php outputEmail() ?>"
              />
            </div>

            <div class="field">
              <label for="contactnumber">Contact Number</label>
              <input required
                type="number"
                name="contactnumber"
                id="contactnumber"
                placeholder="e.g. 09123456789"
              />
            </div>

            <div class="field">
              <label for="message">Message/Requests</label>
              <input required type="text" name="message" id="message" />
            </div>
          </section>

          <!-- preferences -->
          <section class="preferences">
            <!-- <div class="field">
              <label for="appointmentDate">Date</label>
              <input
                type="datetime"
                name="appointmentDate"
                id="appointmentDate"
                placeholder="05-02-2024"
              />
            </div> -->

            <div class="field">
              <label for="appointmentDate">Date</label>
              <select name="appointmentDate" id="appointmentDate">
                <!-- Options will be dynamically generated here -->
              </select>
            </div>

            <div class="field">
              <label for="appointmentTime">Time</label>
              <select name="appointmentTime" id="appointmentTime">
                <option value="8:00 AM">8:00 AM</option>
                <option value="9:00 AM">9:00 AM</option>
                <option value="10:00 AM">10:00 AM</option>
                <option value="11:00 AM">11:00 AM</option>
                <option value="12:00 PM">12:00 PM</option>
                <option value="1:00 PM">1:00 PM</option>
                <option value="2:00 PM">2:00 PM</option>
                <option value="3:00 PM">3:00 PM</option>
                <option value="4:00 PM">4:00 PM</option>
                <option value="5:00 PM">5:00 PM</option>
              </select>
            </div>

            <div class="field">
              <label for="location">Location</label>
              <select name="location" id="location">
                <option value="Bayani Road, Taguig City">
                  Bayani Road, Taguig City
                </option>
                <option value="Main Street, Makati City">
                  Main Street, Makati City
                </option>
                <option value="Central Avenue, Quezon City">
                  Central Avenue, Quezon City
                </option>
              </select>
            </div>
          </section>
          <input type="submit" name="submit" value="Create Appointment">
        </form>
      </section>
    </main>

    <!-- scripts -->
    <script>
      // Function to generate options for weekdays
      function generateWeekdayOptions() {
        var select = document.getElementById("appointmentDate");
        var currentDate = new Date();
        var options = "";

        for (var i = 0; i < 7; i++) {
          currentDate.setDate(currentDate.getDate() + 1); // Move to the next day
          var dayOfWeek = currentDate.getDay(); // Get the day of the week (0-6)

          // Check if it's a weekday (Monday to Friday)
          if (dayOfWeek >= 1 && dayOfWeek <= 5) {
            var option = document.createElement("option");
            var dateFormatted = currentDate.toLocaleDateString("en-US", {
              weekday: "long",
              year: "numeric",
              month: "2-digit",
              day: "2-digit",
            });
            option.text = dateFormatted;
            option.value = dateFormatted;
            select.add(option);
          }
        }
      }

      // Call the function to generate weekday options
      generateWeekdayOptions();
    </script>
  </body>
</html>
