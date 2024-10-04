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
  
</head>

<body class="admin__page">
  <main class="admin__main">
    <!-- nav header -->
    <?php include("includes/nav.php"); ?>

     <section class="admin__content">
      <!-- side bar -->
      <?php include("includes/side_nav.php"); ?>
      
      <!-- doctors -->
      <div class="doctors__container">
        <div class="doctors__table">
          <h1 class="table-heading">
            doctors <span class="table-item-count"><?php echo $totalRecords?></span>
          </h1>

          <table>
            <thead>
              <tr>
                <th>doctor id</th>
                <th>name & email</th>
                <th>contact #</th>
                <th>status</th>
              </tr>
            </thead>

            <tbody>
              <?php if (!empty($doctors)): ?>
                <?php foreach ($doctors as $doctor): ?>
              <tr>
                <td><?php echo htmlspecialchars($doctor['doctor_id']); ?></td>
                <td class="patient-cell name-email">
                  <p class="name" title="<?php echo $doctor['last_name'] ." ". $doctor['first_name'] ?>">
                    <?php echo htmlspecialchars($doctor['last_name']); ?>
                    <?php echo htmlspecialchars($doctor['first_name']); ?>
                  </p>
                  <p class="email" title="<?php echo $doctor['email'] ?>">
                    <?php echo htmlspecialchars($doctor['email']); ?>
                  </p>
                </td>
                <td><?php echo htmlspecialchars($doctor['phone_number']); ?></td>
                <td>On Duty</td>
              </tr>
                <?php endforeach; ?>
                <?php else: ?>
                <tr>
                    <td colspan="5">No doctors found.</td>
                  </tr>
                <?php endif; ?>
            </tbody>
          </table>
        </div>
      </div>
      
    </section>
  </main>
</body>

</html>