<?php
// require_once '../includes/config_session.inc.php';
session_start();
require_once '../includes/login_view.inc.php';
require_once '../includes/appointment_view.inc.php';

require_once '../includes/dbh.inc.php';
require_once 'includes/user_model.inc.php';

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

// Pagination setup
$limit = 10; // Number of entries to show per page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Current page number
$start = ($page - 1) * $limit; // Calculate the starting row for the query

// Get total number of completed appointments for pagination
$totalQuery = "SELECT COUNT(*) AS total FROM appointments WHERE user_id = ? AND status != 'request'";
$stmt = $conn->prepare($totalQuery);
$stmt->bind_param("s", $user_id);
$stmt->execute();
$totalResult = $stmt->get_result();
$totalRow = $totalResult->fetch_assoc();
$totalRecords = $totalRow['total'];
$stmt->close();

// Calculate total pages needed
$totalPages = ceil($totalRecords / $limit);

// Fetch appointments for the current page
$query = "SELECT * FROM appointments WHERE user_id = ? AND status != 'request' ORDER BY created_at DESC LIMIT ?, ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("sii", $user_id, $start, $limit);
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
  <link rel="shortcut icon" href="../assets/logos/logo-white.png" type="image/x-icon" />
  <title>History | Smile Hero Clinic</title>

  <link rel="stylesheet" href="../src/dist/styles.css" />
  <script src="js/mobile-nav.js" defer></script>
</head>

<body class="user__page">
  <main class="user__main">
    <!-- navigation header bar -->
    <?php include('includes/nav.php'); ?>

    <section class="user-contents">
      <!-- navigation side nav -->
      <?php include('includes/sidenav.php'); ?>

    <!--  -->
    <section class="dental-history__page account__container">
      <div class="table-container">

        <table>
          <thead>
            <tr>
              <th>Apt ID</th>
              <th>Date</th>
              <th>Time</th>
              <th>Service</th>
              <th>Req. Date</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($users as $user){ ?>
              <tr>
              <td><?php echo htmlspecialchars($user['appointment_id']) ?></td>
              <td><?php echo htmlspecialchars($user['date'])?> </td>
              <td><?php echo htmlspecialchars($user['time'])?> </td>
              <td>Tooth Extraction</td>
              <td><?php echo htmlspecialchars($user['created_at'])?> </td>
              <td>
                <p class="status">
                  <?php echo htmlspecialchars($user['status'])?> 
                </p>
              </td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
      
      <!-- pagination -->
      <div class="pagination">
        <?php if ($page > 1): ?>
          <a href="?page=<?php echo $page - 1; ?>" class="prev">Previous</a>
        <?php endif; ?>

        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
          <a href="?page=<?php echo $i; ?>" class="<?php echo $i === $page ? 'active' : ''; ?>">
            <?php echo $i; ?>
          </a>
        <?php endfor; ?>

        <?php if ($page < $totalPages): ?>
          <a href="?page=<?php echo $page + 1; ?>" class="next">Next</a>
        <?php endif; ?>
      </div>

    </section>
  </main>
</body>
<script>
  const setStatusStyles = (statusElement, statusText) => statusElement.classList.add(statusText === 'pending' ? 'pending' :  statusText === 'completed' ? 'completed' : statusText === 'accepted' ? 'accepted' : statusText === 'missed' ? 'missed' : statusText = 'canceled' ? 'canceled' : 'rejected')
  document.querySelectorAll('.status').forEach((status) => setStatusStyles(status, status.innerText.toLowerCase()))
</script>

</html>