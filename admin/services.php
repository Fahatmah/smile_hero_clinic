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
$query = "SELECT COUNT(*) AS total FROM services";
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

$query = "SELECT * FROM services LIMIT $this_page_first_result, $results_per_page";
$result = $conn->query($query);
$services = [];
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $services[] = $row;
  }
}


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
            <h1 class="table-heading">Services <span class="table-item-count"><?php echo $number_of_results;?></span></h1>
            <button><a href="add-services.php">Add Service</a></button>
            <!-- <?php // include("includes/search.php"); ?> -->
          </div>

          <table>
            <thead>
              <tr>
                <th>Service id</th>
                <th>Service name</th>
                <th>Service price</th>
                <th>actions</th>
              </tr>
            </thead>

            <tbody id="items">
              <?php foreach($services as $service):?>
             <tr>
              <td class="service-id"><?php echo $service['service_id'] ?></td>
              <td class="service-name"><?php echo $service['service_name'] ?></td>
              <td class="service-price">₱ <?php echo $service['service_price'] ?></td>
              <td>
                <div class="buttons-container">
                  <a href="update-service.php?service_id=<?php echo $service['service_id'] ?>" class="update-btn"><img src="../assets/admin_assets/icons/edit.svg" alt="edit icon"></a>
                  <a href="#" class="delete-btn"><img src="../assets/admin_assets/icons/trash.svg" alt="trash icon"></a>
                </div>
              </td>
             </tr>
             <?php endforeach; ?>
            </tbody>
          </table>
          
        </div>

        <!-- modal -->
        <div class="delete-modal" style="transform: scale(0); transition:.5s;">
          <div class="modal__container">
            <h3 id="modalStatus" class="modal__status">
              Are you sure to delete this service?
            </h3>
            
            <div class="buttons-container">
              <a href="includes/delete-service.php" class="delete-btn" id="deleteBtn" style="text-align:center;">Confirm</a>
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
    const modal = document.querySelector('.delete-modal');
    const confirmBtn = document.getElementById('deleteBtn');
    const cancelBtn = document.getElementById('cancelBtn');

    let selectedServiceId = null;

    document.querySelectorAll('.delete-btn').forEach((deleteButton) => {
      deleteButton.addEventListener('click', (e) => {
        e.preventDefault();

        const row = deleteButton.closest('tr');
        selectedServiceId = row.querySelector('.service-id').textContent;

        modal.style.transform = 'scale(1)';
      });
    });

    confirmBtn.addEventListener('click', () => {
      if (selectedServiceId) {
       
        window.location.href = `includes/delete-service.php?service_id=${selectedServiceId}`;
      }
    });

    
    cancelBtn.addEventListener('click', () => {
      modal.style.transform = 'scale(0)';
      selectedServiceId = null;
    });
</script>

</body>


</html>

