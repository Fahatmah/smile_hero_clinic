<?php
require_once '../includes/config_session.inc.php';
require_once '../includes/login_view.inc.php';
require_once '../includes/dbh.inc.php';

if(!isset($_SESSION['adminEmail'])) {
  // Redirect user to login if not logged in
  header("Location: ../login.php?login=failed");
  exit();
}

$query  = "SELECT * FROM appointments WHERE status = 'accepted' ";
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
  <title>Reports | Admin</title>
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
            <h4>Confirmed Appointments</h4>
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
                <th class="patient_name" style="width: 7.5rem">APPOINTMENT ID</th>
                <th class="patient_id" style="width: 2rem">USER ID</th>
                <th class="patient_name">PATIENT NAME</th>
                <th class="patient_time">TIME</th>
                <th class="patient_email">EMAIL</th>
                <th class="patient_message">MESSAGE</th>
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
              <td><?php echo $user['user_id']; ?></td>
              <td><?php echo $user['name']; ?></td>
              <td><?php echo $user['date']; ?></td>
              <td><?php echo $user['email']; ?></td>
              <td><?php echo $user['message']; ?></td>
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