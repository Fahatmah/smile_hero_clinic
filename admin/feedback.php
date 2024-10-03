<?php
require_once '../includes/config_session.inc.php';
require_once '../includes/login_view.inc.php';
require_once '../includes/dbh.inc.php';
require_once './includes/pagination.php'; // Ensure this file includes a `renderPagination` function

if (!isset($_SESSION['adminEmail'])) {
  // Redirect user to login if not logged in
  header("Location: ../login.php?login=failed");
  exit();
}

// Pagination setup
$limit = 5; // Number of entries to show per page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Current page number
$start = ($page - 1) * $limit; // Calculate the starting row for the query

// Get total number of feedback records
$totalQuery = "SELECT COUNT(*) AS total FROM feedback"; // Adjust table name as needed
$totalResult = $conn->query($totalQuery);
$totalRow = $totalResult->fetch_assoc();
$totalRecords = $totalRow['total'];

// Fetch records for the current page
$query = "SELECT * FROM feedback LIMIT $start, $limit"; // Adjust table name as needed
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
      
      <div class="feedbacks__container">
        <div class="feedbacks__table">
          <h1 class="table-heading">feedbacks<span class="table-item-count">10</span></h1>

          <table>
            <thead>
              <tr>
                <th>feedback id</th>
                <th>client name</th>
                <th>email</th>
                <th>rating</th>
                <th>message</th>
                <th>date</th>
              </tr>
            </thead>

            <tbody>
              <?php foreach($users as $user){?>
              <tr>
                <td class="patient-cell id">FB00  <?php echo $user['id']?></td>
                <td class="patient-cell name"><?php echo $user['name']?></td>
                <td class="patient-cell email"><?php echo $user['email']?></td>
                <td class="patient-cell rating"><?php echo $user['rating']?></td>
                <td class="patient-cell message"><?php echo $user['feedback']?></td>
                <td class="patient-cell date"><?php echo $user['created_at']?></td>
              </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>

        <!-- Pagination -->
        <?php renderPagination($page, $totalPages) ?>
      </div>
    </section>
  </main>
</body>

</html>