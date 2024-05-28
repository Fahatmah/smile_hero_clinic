<?php
require_once '../includes/config_session.inc.php';
require_once '../includes/login_view.inc.php';
require_once '../includes/appointment_view.inc.php';

require_once '../includes/dbh.inc.php';

if(!isset($_SESSION['user_id'])) {
  // Redirect user to login if not logged in
  header("Location: ../login.php");
  exit();
}

$user_id = $_SESSION['user_id'];

  // Fetch appointments for the user
  $query = "SELECT * FROM appointments WHERE user_id = ? AND status =  'accepted' ";
  $stmt = $conn->prepare($query);
  $stmt->bind_param("s", $user_id);
  $stmt->execute();
  $result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="shortcut icon" href="../assets/images/logoipsum.svg" type="image/x-icon">
  <title>Feedback Form | Smile Hero Clinic</title>
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

    <!--  -->
    <section class="dental_history__page account__container">
      <div class="account">
        <div class="header">
          <h1>Dental History</h1>
        </div>
        <?php if ($row = $result->fetch_assoc()) { ?>

        <div class="appointment__container">
          <table>
            <thead>
              <tr>
                <th>Id</th>
                <th>Date & Time</th>
                <th>Location</th>
                <th>Email</th>
                <th>Contact Number</th>
                <th>Name</th>
              </tr>
            </thead>

            <tbody>
              <tr>
                <td><?php echo $row["appointment_id"]; ?></td>
                <td><?php echo $row['date'] ?></td>
                <td><?php echo $row["location"]; ?></td>
                <td><?php echo $row["email"]; ?></td>
                <td><?php echo $row["contact"]; ?></td>
                <td><?php echo $row["name"]; ?></td>
              </tr>
            </tbody>
          </table>
        </div>
        <?php } else {
                echo "<p> No Appointments Found. </p>";
              } 
              
              $conn->close()?>

      </div>
    </section>
  </main>
</body>

</html>