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

    <!-- appointment form -->
    <section class="appointment_form__container account__container">
      <div class="account">
        <h1>Schedule fresh meeting</h1>

        <form action="../includes/appointment.inc.php" method="post" class="form" id="appointmentForm">


          <!-- personal details -->
          <section class="personal__details">

            <?php checkAppointErrors() ?>


            <h2>Personal Details</h2>

         

            <div class="field">
              <label for="name">Name</label>
              <input type="text" name="name" id="name" placeholder="e.g. Fahatmah Mabang"
                value="<?php outputFullName() ?>" />
              <div class="text_validation">
                <p class="text error">Error</p>
                <p class="text valid">Valid</p>
              </div>
            </div>

            <div class="field">
              <label for="email">Email</label>
              <input type="email" name="email" id="email" placeholder="e.g. fahatmahmabang@gmail.com"
                value=" <?php outputEmail() ?>" />
              <div class="text_validation">
                <p class="text error">Error</p>
                <p class="text valid">Valid</p>
              </div>
            </div>

            <div class="field">
              <label for="contactnumber">Contact Number</label>
              <input type="tel" name="contactnumber" id="contactnumber" placeholder="e.g. 09123456789" />
              <div class="text_validation">
                <p class="text error">Error</p>
                <p class="text valid">Valid</p>
              </div>
            </div>

            <div class="field">
              <label for="message">Message/Requests</label>
              <input type="text" name="message" id="message" />
              <div class="text_validation">
                <p class="text error">Error</p>
                <p class="text valid">Valid</p>
              </div>
            </div>
          </section>

          <!-- preferences -->
          <section class="preferences">

            <div class="fields">
              <h3>Preferences</h3>

              <div class="field">
                <label for="appointmentDate">Date</label>
                <select name="appointmentDate" id="appointmentDate">

                </select>
                <div class="text_validation">
                  <p class="text error">Error</p>
                  <p class="text valid">Valid</p>
                </div>
              </div>

              <div class="field">
                <label for="appointmentTime">Time</label>
                <select name="appointmentTime" id="appointmentTime">
                  <option value="-">-</option>
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
                <div class="text_validation">
                  <p class="text error">Error</p>
                  <p class="text valid">Valid</p>
                </div>
              </div>

              <div class="field">
                <label for="location">Location</label>
                <select name="location" id="location">
                  <option value="-">-</option>
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
                <div class="text_validation">
                  <p class="text error">Error</p>
                  <p class="text valid">Valid</p>
                </div>
              </div>
            </div>
            <input type="submit" name="submit" value="Create Appointment" class="create_appointment__button">
          </section>
        </form>
      </div>
    </section>
  </main>

  <!-- scripts -->
  <script>
  const appointmentForm = document.getElementById('appointmentForm')

  // appointmentForm.addEventListener('submit', (e) => {
  //   e.preventDefault()

  //   const fields = [{
  //       id: 'name',
  //       errorMessage: 'Name cannot be empty'
  //     },
  //     {
  //       id: 'email',
  //       errorMessage: 'Email cannot be empty'
  //     },
  //     {
  //       id: 'contactnumber',
  //       errorMessage: 'Contact number cannot be empty'
  //     },
  //     {
  //       id: 'appointmentDate',
  //       errorMessage: 'Please select a date'
  //     },
  //     {
  //       id: 'appointmentTime',
  //       errorMessage: 'Please select a time'
  //     },
  //     {
  //       id: 'location',
  //       errorMessage: 'Please select a location'
  //     },
  //   ]

  //   fields.forEach((field) => {
  //     const fieldElement = document.getElementById(field.id)
  //     const errorElement =
  //       fieldElement.nextElementSibling.querySelector('.text.error')
  //     if (fieldElement.value.trim() === '-' || fieldElement.value.trim() === '') {
  //       errorElement.innerText = field.errorMessage
  //       errorElement.style.display = 'block'
  //     } else {
  //       errorElement.style.display = 'none'
  //     }
  //   })
  // })


  // Function to generate options for weekdays
  function generateWeekdayOptions() {
    var select = document.getElementById("appointmentDate");
    var currentDate = new Date();

    // Create the default option
    var defaultOption = document.createElement("option");
    defaultOption.value = "-";
    defaultOption.text = "-";
    select.add(defaultOption);

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