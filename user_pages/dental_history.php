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
  $query = "SELECT * FROM appointments WHERE user_id = ? AND status != 'request' ORDER BY created_at DESC";
  $stmt = $conn->prepare($query);
  $stmt->bind_param("s", $user_id);
  $stmt->execute();
  $result = $stmt->get_result();
  $users = [];
  if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
          $users[] = $row;
      }
  }
  $stmt->close();
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

<body class="user__page">
  <main class="user__main">
    <!-- navigation header bar -->
    <?php include('includes/nav.php'); ?>

    <section class="user-contents">
      <!-- navigation side nav -->
      <?php include('includes/sidenav.php'); ?>

    <!--  -->
    <section class="dental_history__page account__container">
      <div class="account">
        <div class="header">
          <h1>Dental History</h1>
        </div>
        <div class="appointment__container">
          <table>
            <thead>
              <tr>
                <th>Id</th>
                <th>Date</th>
                <th>Time</th>
                <th>Request Date</th>
                <th>Status</th>
              </tr>
            </thead>

            <tbody>
            <?php foreach ($users as $user){ ?>
              <tr>
                <td><?php echo htmlspecialchars($user['appointment_id']) ?></td>
                <td><?php echo htmlspecialchars($user['date'])?> </td>
                <td><?php echo htmlspecialchars($user['time'])?> </td>
                <td><?php echo htmlspecialchars($user['created_at'])?> </td>
                <td><?php echo htmlspecialchars($user['status'])?> </td>
              </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
       
      </div>
    </section>
  </main>
</body>

</html>