<?php 
session_start();
require_once '../includes/login_view.inc.php';
require_once '../includes/dbh.inc.php';

$service_id = $_GET['service_id'];

$query = "SELECT * FROM services WHERE service_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $service_id);
$stmt->execute();

$result = $stmt->get_result();

$showModal = false;
if (isset($_SESSION['service_updated'])) {
    if ($_SESSION['service_updated'] === 'updated') {
        $showModal = true;
    }
    unset($_SESSION['service_updated']);
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="../assets/logos/logo-white.png" type="image/x-icon" />
    <title>Update Service | Admin</title>
    <link rel="stylesheet" href="../src/dist/styles.css" />
  </head>
  <body class="admin__page">
    <main class="admin__main">
      <!-- nav header -->
      <?php include("includes/nav.php"); ?>

      <section class="admin__content">
        <!-- side bar -->
        <?php include("includes/side_nav.php"); ?>
        <?php if($getServiceDet = $serviceRes = $result->fetch_assoc()): ?>
        
        <div class="set-date-container">
          <h1>Update <?php echo $getServiceDet['service_name'] ?> Service</h1>

          <form action="includes/update_services.php" onsubmit="return validate()"  method="post">
             <input type="hidden" name="service_id" value="<?php echo $getServiceDet['service_id'] ?>">
              <div class="field-group">
                  <label for="serviceName">Update Service Name</label>
                  <input type="text" id="serviceName" name="serviceName" value="<?php echo $getServiceDet['service_name'] ?>"/>
              </div>

              <div class="field-group">
                  <label for="servicePrice">Update Price</label>
                  <input type="text" id="servicePrice" name="servicePrice" value="<?php echo $getServiceDet['service_price'] ?>"/>
              </div>
              <p id="form_error" style="color: red; font-size: 0.875rem;"></p>
              <button type="submit">Update Service</button>
            </form>
          </div>
          <?php endif; ?>
      </section>

      <!-- modal -->
        <div class="modal" style="display: none;">
          <div class="modal__content">
            <div class="body-text">
              <div class="modal__header">
                <h3 id="modalStatus" class="modal__status">
                  Service Information Updated
                </h3>
                <p id="modalMessage" class="modal__message">
                  <a href="">
                    View Services
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M9.62 3.95337L13.6667 8.00004L9.62 12.0467" stroke="#E84531" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                      <path d="M2.33333 8H13.5533" stroke="#E84531" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                  </a>
                </p>
              </div>
              <button type="button" id="exitButton" class="modal__button">
                okay, got it!
              </button>
            </div>
            <div class="illustration__container">
              <img src="../assets/appointment-update.svg" alt="illustration of accepted appointment">
            </div>
          </div>
        </div>
    </main>

    <script>
      document.addEventListener('DOMContentLoaded', () => {
        const modalContainer = document.querySelector(".modal");
        const exitBtn = modalContainer.querySelector("#exitButton");

        // Check if the modal should be displayed
        <?php  if ($showModal) : ?>
        modalContainer.style.display = "flex";
        <?php endif; ?>
        exitBtn.addEventListener("click", () => {
          modalContainer.style.transform = "scale(0)";
        });
      });

      function validate(){

      var serviceName = document.getElementById("serviceName"); 
      var servicePrice = document.getElementById("servicePrice"); 
      var form_error =  document.getElementById("form_error");

      notValid = false;

      const nameRegex = /^[A-Za-z ]+$/;
      const currencyRegex = /^(?!0(\.00?)?$)(\d{1,3}(?:,\d{3})*(?:\.\d{2})?)$/;


      if (serviceName.value == "" || servicePrice.value == "") {
          form_error.innerHTML = "Please fill up the form";
          form_error.style.display = "flex";
          
          return false; // prevent form submission
        }
        else if(!nameRegex.test(serviceName.value)){
          form_error.innerHTML = "Invalid service name format"
          form_error.style.display = "flex";
          return false;
        }
        else if(!currencyRegex.test(servicePrice.value)){
          form_error.innerHTML = "Invalid price format. Use Use 100 or 1,000 or 1,000.50"
          form_error.style.display = "flex";
          return false;
        }
      return true; // allow form submission if all checks pass
      }
    </script>
  </body>
  
</html>