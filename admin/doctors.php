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

// Get total number of records for doctors
$totalQuery = "SELECT COUNT(*) AS total FROM doctors";
$totalResult = $conn->query($totalQuery);
$totalRow = $totalResult->fetch_assoc();
$totalRecords = $totalRow['total'];

// Fetch records for the current page
$query = "SELECT * FROM doctors LIMIT $start, $limit";
$result = $conn->query($query);
$doctors = [];
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $doctors[] = $row;
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
  <title>Doctors | Admin</title>
  <link rel="stylesheet" href="../src/dist/styles.css" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&display=swap"
    rel="stylesheet" />
</head>

<body>
  <main class="admin-main">
    <!-- nav header -->
    <?php include("includes/nav.php"); ?>

    <!-- side bar -->
    <?php include("includes/side_nav.php"); ?>

     <section class="account__container admin-cards">
      <!-- doctors -->
      <div class="doctors-page">
        <div class="doctors-page__content">
          <!-- header -->
          <div class="doctors-page__content-header">
              <h1>Doctors</h1>
              <form class="doctors-page__content-header-search-bar">
                <input type="text" name="appointment" id="appointment" placeholder="Search..." />
                <button type="submit">
                  <img src="../assets/admin_images/search.svg" alt="search icon" />
                </button>
              </form>
          </div>
          <!-- end of header -->

          <!-- table -->
          <table>
              <thead>
                <tr>
                  <th>FIRST NAME</th>
                  <th>LAST NAME</th>
                  <th>PHONE NUMBER</th>
                  <th>EMAIL</th>
                  <th><button>ADD DOCTOR</button></th>
                </tr>
              </thead>

              <tbody>
                <?php if (!empty($doctors)): ?>
                  <?php foreach ($doctors as $doctor): ?>
                    <tr>
                      <td><?php echo htmlspecialchars($doctor['first_name']); ?></td>
                      <td><?php echo htmlspecialchars($doctor['last_name']); ?></td>
                      <td><?php echo htmlspecialchars($doctor['phone_number']); ?></td>
                      <td><?php echo htmlspecialchars($doctor['email']); ?></td>
                      <td>
                        <div class="button__container">
                          <button class="edit-btn">Edit</button>
                          <button class="delete-btn">Delete</button>
                        </div>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                <?php else: ?>
                  <tr>
                    <td colspan="5">No doctors found.</td>
                  </tr>
                <?php endif; ?>
              </tbody>
          </table>
          <!-- end of table -->

          <!-- Pagination -->
          <?php renderPagination($page, $totalPages) ?>
        </div>
      </div>
      
    </section>
  </main>
</body>

</html>