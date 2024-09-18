<?php
require_once '../includes/config_session.inc.php';
require_once '../includes/login_view.inc.php';
require_once '../includes/dbh.inc.php';
require_once './includes/pagination.php';

if(!isset($_SESSION['adminEmail'])) {
  // Redirect user to login if not logged in
  header("Location: ../login.php?login=failed");
  exit();
}

// Define how many results per page
$results_per_page = 5;

// Find out the number of results stored in the database
$query = "SELECT COUNT(*) AS total FROM users";
$result = $conn->query($query);
$row = $result->fetch_assoc();
$number_of_results = $row['total'];

// Determine the total number of pages available
$number_of_pages = ceil($number_of_results / $results_per_page);

// Determine which page number visitor is currently on
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$page = max(1, $page); // Ensure the page number is at least 1

// Determine the SQL LIMIT starting number for the results on the displaying page
$this_page_first_result = ($page - 1) * $results_per_page;

// Retrieve selected results from the database and display them on the page
$query = "SELECT * FROM users LIMIT $this_page_first_result, $results_per_page";
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
  <title>Patients | Admin</title>
  <link rel="stylesheet" href="../src/dist/styles.css" />
  
</head>

<body class="admin__page">
  <main class="admin__main">
    <!-- nav header -->
    <?php include("includes/nav.php"); ?>

    <!-- patients container -->
    <section class="admin__content">
      <!-- side bar -->
      <?php include("includes/side_nav.php"); ?>
      <!-- patients -->
      <div class="patients__container">
        <div class="patients">
          <div class="top_header">
            <h6>Patients (Page <?php echo $page; ?>)</h6>
            <form class="search__bar">
              <input type="text" name="patient" id="patient" placeholder="Search..." />
              <button type="submit">
                <img src="../assets/admin_images/search.svg" alt="search icon" />
              </button>
            </form>
          </div>

          <!-- patients table -->
          <table>
            <!-- head -->
            <thead>
              <tr>
                <th class="patient_img">IMG</th>
                <th class="patient_id">USER ID</th>
                <th class="patient_name">PATIENT NAME</th>
                <th class="patient_email">EMAIL</th>
                <th class="patient_contact">CONTACT</th>
                <th class="patient_address">ADDRESS</th>
              </tr>
            </thead>

            <!-- body -->
            <tbody>
              <!-- get only 3 patients to show -->
              <?php foreach ($users as $user){ ?>
              <tr>
                <td>
                  <img src="../assets/admin_images/default_image.svg" class="img"
                    style="border-radius: 4rem; width: 2rem; height: 2rem" />
                </td>
                <td><?php echo htmlspecialchars($user['user_id']); ?></td>
                <td><?php echo htmlspecialchars($user['fullname']); ?></td>
                <td><?php echo htmlspecialchars($user['email']); ?></td>
                <td><?php echo htmlspecialchars($user['contact']); ?></td>
                <?php if(strlen($user['address']) === 0){ ?>
                    <td>No Address</td>
                <?php }else{?>
                  <td><?php echo htmlspecialchars($user['address']); ?></td>
                <?php } ?>
              </tr>
              <?php } ?>
            </tbody>
          </table>

          <!-- Pagination -->
          <?php renderPagination($page, $number_of_pages) ?>

        </div>
      </div>
    </section>
  </main>
</body>

</html>