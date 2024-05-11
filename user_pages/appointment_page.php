<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Appointment | Smile Hero Clinic</title>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&display=swap"
    rel="stylesheet" />
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
            <p class="appoinment_date" id="appointmentDate">05-02-2024</p>
            <button class="remove__button" id="removeAppointmentBtn">
              Cancel
            </button>
          </div>
        </div>
      </div>
    </section>
  </main>
</body>

</html>