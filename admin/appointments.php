<?php
require_once '../includes/config_session.inc.php';
require_once '../includes/login_view.inc.php';
require_once '../includes/dbh.inc.php';
require_once './includes/pagination.php';

if (!isset($_SESSION['adminEmail'])) {
  header("Location: ../login.php?login=failed");
  exit();
}

// Define how many results per page
$results_per_page = 5;

// Find out the number of results stored in the database
$query = "SELECT COUNT(*) AS total FROM appointments";
$result = $conn->query($query);
$row = $result->fetch_assoc();
$number_of_results = $row['total'];

// Determine the total number of pages available
$totalPages = ceil($number_of_results / $results_per_page);

// Determine which page number visitor is currently on
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$page = max(1, $page); // Ensure the page number is at least 1

// Determine the SQL LIMIT starting number for the results on the displaying page
$this_page_first_result = ($page - 1) * $results_per_page;

$query = "SELECT * FROM appointments WHERE status = 'request' LIMIT $this_page_first_result, $results_per_page";
$result = $conn->query($query);

$users = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
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
  
</head>

<body class="admin__page">
  <main class="admin__main">
    <!-- nav header -->
    <?php include("includes/nav.php"); ?>

    <section class="admin__content">
      <!-- side bar -->
      <?php include("includes/side_nav.php"); ?>
      
      <!-- appointments -->
      <div class="appointments__container appointments__page">
        <!-- appointment items -->
        <div class="appointments">
          <div class="top_header">
            <h4>Pending Requests (Page <?php echo $page; ?>)</h4>
            <form class="search__bar">
              <input type="text" name="appointment" id="appointment" placeholder="Search..." />
              <button type="submit">
                <img src="../assets/admin_images/search.svg" alt="search icon" />
              </button>
            </form>
          </div>

          <!-- appointments table -->
          <?php if (count($users) > 0) { ?>
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
                  <!-- accepts appointment -->
                  <form action="includes/send_email.php" method="post">
                    <input type="hidden" name="app_id" value="<?php echo $user['appointment_id'];?>">
                    <input type="hidden" name="name" value="<?php echo $user['name'];?>">
                    <input type="hidden" name="email" value="<?php echo $user['email'];?>">
                    <input type="hidden" name="subject" value="Smile Hero Dental Clinic Appointment">
                    <input type="hidden" name="message"
                      value="Good Day <?php echo $user['name']; ?> this is Smile Hero Dental Clinic your appointment on <?php echo $user['date']; ?> at <?php echo $user['time']; ?> has been accept. Here is your Appointment ID : <?php echo $user['appointment_id']; ?> ">
                    <input type="submit" value="Accept" name="accept" class="button accept">
                  </form>

                  <!-- cancel appointment -->
                  <form action="includes/send_email.php" method="post">
                    <input type="hidden" name="app_id" value="<?php echo $user['appointment_id'];?>">
                    <input type="hidden" name="name" value="<?php echo $user['name'];?>">
                    <input type="hidden" name="email" value="<?php echo $user['email'];?>">
                    <input type="hidden" name="subject" value="Smile Hero Dental Clinic Appointment">
                    <input type="hidden" name="message"
                      value="Good Day <?php echo $user['name']; ?> this is Smile Hero Dental Clinic we are afraid to tell you that your appointment on <?php echo $user['date']; ?> at <?php echo $user['time']; ?> has been Canceled. Please try your appointment request on another day.">
                    <input type="submit" value="Cancel" name="cancel" class="button cancel">
                </div>
              </td>
            </tr>
            <?php } ?>
          </table>
          <?php } else { ?>
          <p>No appointment requests</p>
          <?php } ?>

          <!-- Pagination -->
          <?php renderPagination($page, $totalPages) ?>

        </div>
      </div>
    </section>
  </main>
</body>

</html>