<?php
// require_once '../includes/config_session.inc.php';
session_start();
require_once '../includes/login_view.inc.php';
require_once '../includes/dbh.inc.php';
require_once './includes/pagination.php';

if (!isset($_SESSION['adminID'])) {
  header("Location: ../login.php?login=failed");
  exit();
}

// Define how many results per page
$results_per_page = 10;

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

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="shortcut icon" href="../assets/logos/logo-white.png" type="image/x-icon" />
  <title>Services | Admin</title>
  <link rel="stylesheet" href="../src/dist/styles.css" />
  
</head>

<body class="admin__page">
  <main class="admin__main">
    <!-- nav header -->
    <?php include("includes/nav.php"); ?>

    <section class="admin__content">
      <!-- side bar -->
      <?php include("includes/side_nav.php"); ?>
      
      <div class="appointments__container appointments__page services">
        <div class="appointments__table">
          <div class="table-heading__container">
            <h1 class="table-heading">Services <span class="table-item-count">12</span></h1>
            <button><a href="add-services.php">Add Service</a></button>
            <!-- <?php // include("includes/search.php"); ?> -->
          </div>

          <table>
            <thead>
              <tr>
                <th>service id</th>
                <th>
                  service name
                </th>
                <th>actions</th>
              </tr>
            </thead>

            <tbody id="items">
             <tr>
              <td class="service-name">Tooth Extraction</td>
              <td class="service-price">₱1,500</td>
              <td>
                <div class="buttons-container">
                  <a href="update-service.php" class="update-btn"><img src="../assets/admin_assets/icons/edit.svg" alt="edit icon"></a>
                  <button class="delete-btn"><img src="../assets/admin_assets/icons/trash.svg" alt="trash icon"></button>
                </div>
              </td>
             </tr>
            </tbody>
          </table>
          
        </div>

        <!-- modal -->
        <div class="delete-modal" style="display: none">
          <div class="modal__container">
            <h3 id="modalStatus" class="modal__status">
              Delete Tooth Extraction Service?
            </h3>
            
            <div class="buttons-container">
              <button class="delete-btn" id="deleteBtn">Confirm</button>
              <button class="cancel-btn" id="cancelBtn">No, Keep it</button>
            </div>
          </div>
        </div>

          <!-- Pagination -->
        <?php renderPagination($page, $totalPages) ?>
      </div>
    </section>
  </main>

  <script>
      document.addEventListener('DOMContentLoaded', () => {
        const modalContainer = document.querySelector(".delete-modal");
        const exitBtn = modalContainer.querySelector("#cancelBtn");
        const modalStatus = modalContainer.querySelector("#modalStatus");

        // Check if the modal should be displayed
        <?php if ($showModal) : ?>
        modalStatus.innerText = "<?php echo $modalStatus; ?>";
        modalContainer.style.display = "flex";
        <?php endif; ?>
        exitBtn.addEventListener("click", () => {
          modalContainer.style.transform = "scale(0)";
        });
      });
    </script>
</body>


</html>

