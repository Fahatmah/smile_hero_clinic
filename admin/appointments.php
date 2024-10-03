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
$query = "SELECT COUNT(*) AS total FROM appointments WHERE status = 'request'";
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

$query = "SELECT * FROM appointments WHERE status = 'request'";
$result = $conn->query($query);

$totalAppointments = 0;
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $totalAppointments++;
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
      
      <div class="appointments__container appointments__page">
        <div class="appointments__table">
          <h1 class="table-heading">pending appointments <span class="table-item-count"><?php echo $totalAppointments ?></span></h1>

          <?php if (count($users) > 0) { ?>
          <table>
            <thead>
              <tr>
                <th>patient id #</th>
                <th>patient name</th>
                <th>phone</th>
                <th>time</th>
                <th>date</th>
                <th>message</th>
                <th>actions</th>
              </tr>
            </thead>

            <?php foreach ($users as $user){?>
            <tbody>
              <tr>
                <td class="patient-cell id">
                  <?php echo $user['appointment_id']; ?>
                </td>
                <td class="patient-cell name">
                  <p class="patient-name" title="<?php echo $user['name']; ?>"><?php echo $user['name']; ?></p>
                  <p class="patient-email" title="<?php echo $user['email']; ?>"><?php echo $user['email']; ?></p>
                </td>
                <td class="patient-cell phone"> 
                  <?php echo $user['contact']; ?>
                </td>
                <td class="patient-cell time"><?php echo $user['time']; ?></td>
                <td class="patient-cell date"><?php echo $user['date']; ?></td>
                <td class="patient-cell message">
                  <!-- <button class="view-message-btn">View Message</button> -->
                  <p class="message-text" title="<?php echo $user['message']; ?>">
                    <?php echo $user['message']; ?>
                  </p>
                </td>
                <td class="patient-cell actions">
                  <div class="button-container">
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
            </tbody>
            <?php } ?>
          </table>
          <?php } else { ?>
            <p>No appointment requests</p>
          <?php } ?>
        </div>

          <!-- Pagination -->
        <?php renderPagination($page, $totalPages) ?>
      </div>
    </section>
  </main>
</body>

</html>

