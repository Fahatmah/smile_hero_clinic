<?php
require_once '../includes/config_session.inc.php';
require_once '../includes/login_view.inc.php';
require_once '../includes/dbh.inc.php';

if(!isset($_SESSION['adminEmail'])) {
  // Redirect user to login if not logged in
  header("Location: ../login.php?login=failed");
  exit();
}

$query  = "SELECT * FROM appointments WHERE status = 'request' ";
$result = $conn->query($query);
$users = [];
if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
      $users[] = $row;
  }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="shortcut icon" href="../assets/images/logoipsum.svg" type="image/x-icon" />
  <title>Appointments | Admin</title>
  <link rel="stylesheet" href="../src/dist/styles.css" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&display=swap"
    rel="stylesheet" />
</head>

<body>
  <main>
    <!-- nav header -->
    <?php include("includes/nav.php"); ?>

    <!-- side bar -->
    <?php include("includes/side_nav.php"); ?>

    <section class="account__container admin-cards">
      <!-- appointments -->
      <div class="appointments__container appointments__page">
        <!-- appointment items -->
        <div class="appointments">
          <div class="top_header">
            <h4>Pending Requests</h4>
            <form class="search__bar">
              <input type="text" name="appointment" id="appointment" placeholder="Search..." />
              <button type="submit">
                <img src="../assets/admin_images/search.svg" alt="search icon" />
              </button>
            </form>
          </div>

          <!-- appointments table -->
          <table>
            <!-- head -->
            <thead>
              <tr>
                <th class="patient_img">IMG</th>
                <th class="patient_appointment">APPOINTMENT ID</th>
                <th class="patient_name">PATIENT NAME</th>
                <th class="patient_time">TIME</th>
                <th class="patient_email">EMAIL</th>
                <th class="patient_message">MESSAGE</th>
                <th class="actions">ACTIONS</th>
              </tr>
            </thead>

            <!-- body -->

            <?php foreach ($users as $user){?>
            <tr>
              <td>
                <img src="../assets/admin_images/default_image.svg" class="img"
                  style="border-radius: 4rem; width: 2rem; height: 2rem" />
              </td>
              <td><?php echo $user['appointment_id']; ?></td>
              <td><?php echo $user['name']; ?></td>
              <td><?php echo $user['date']; ?></td>
              <td><?php echo $user['email']; ?></td>
              <td><?php echo $user['message']; ?></td>
              <td>
                <div class="action_button__container">
                  <form action="includes/send_email.php" method="post">
                    <input type="hidden" name="app_id" value="<?php echo $user['appointment_id'];?>">
                    <input type="hidden" name="name" value="<?php echo $user['name'];?>">
                    <input type="hidden" name="email" value="<?php echo $user['email'];?>">
                    <input type="hidden" name="subject" value="Smile Hero Dental Clinic Appointment">
                    <input type="hidden" name="message"
                      value="Good Day <?php echo $user['name']; ?> this is Smile Hero Dental Clinic your appointment on <?php echo $user['date']; ?> at <?php echo $user['time']; ?> has been accept. Here is your Appointment ID : <?php echo $user['appointment_id']; ?> ">
                    <input type="submit" value="accept" name="submit" class="button accept">
                  </form>
                  <button class="button cancel">Cancel</button>
                </div>
              </td>
            </tr>
            <?php } ?>
          </table>
          <?php if($result->num_rows == 0) { ?>
          <p>No appointment requests</p>
          <?php } ?>
        </div>
      </div>
    </section>
  </main>
</body>

</html>