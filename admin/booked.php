<?php
require_once '../includes/config_session.inc.php';
require_once '../includes/login_view.inc.php';
require_once '../includes/dbh.inc.php';
require_once './includes/pagination.php';

if (!isset($_SESSION['adminEmail'])) {
  // Redirect user to login if not logged in
  header("Location: ../login.php?login=failed");
  exit();
}

// Pagination setup
$limit = 5; // Number of entries to show per page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Current page number
$start = ($page - 1) * $limit; // Calculate the starting row for the query

// Get total number of records for booked meetings
$totalQuery = "SELECT COUNT(*) AS total FROM appointments WHERE status = 'accepted'";
$totalResult = $conn->query($totalQuery);
$totalRow = $totalResult->fetch_assoc();
$totalRecords = $totalRow['total'];

// Fetch records for the current page
$query = "SELECT * FROM appointments WHERE status = 'accepted' LIMIT $start, $limit";
$result = $conn->query($query);
$users = [];
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $users[] = $row;
  }
}

// Calculate total pages needed
$totalPages = ceil($totalRecords / $limit);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="shortcut icon" href="../assets/images/logoipsum.svg" type="image/x-icon" />
  <title>Reports | Admin</title>
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
            <h4>Confirmed Appointments (Page <?php echo $page; ?>)</h4>
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
              <td><?php echo date('l, m/d/Y', strtotime($user['date'])); ?></td>
              <td><?php echo $user['email']; ?></td>
              <?php if(strlen($user['message']) === 0){ ?>
                <td>No Message</td>
              <?php } else {?>
                <td><?php echo $user['message']; ?></td>
              <?php } ?>
            </tr>
            <?php } ?>
          </table>
          <?php if($result->num_rows == 0) { ?>
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