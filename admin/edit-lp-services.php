<?php
// require_once '../includes/config_session.inc.php';
session_start();
require_once '../includes/login_view.inc.php';
require_once '../includes/dbh.inc.php';

if (!isset($_SESSION['adminID'])) {
  // Redirect user to login if not logged in
  header("Location: ../login.php?login=failed");
  exit();
}

// $showModal = false;
// if (isset( $_SESSION['footer_update'])) {
//     if ( $_SESSION['footer_update'] === 'success') {
//         $showModal = true;
//     }
//     unset( $_SESSION['footer_update']);
// }

// $query = "SELECT * FROM footer";
// $stmt = $conn->prepare($query);
// $stmt->execute();

// $result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="../assets/logos/logo-white.png" type="image/x-icon" />
    <title>Edit Services Page Component | Landing Page | Admin</title>
    <link rel="stylesheet" href="../src/dist/styles.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
  </head>
  <body class="admin__page">
    <main class="admin__main">
      <!-- nav header -->
      <?php include("includes/nav.php"); ?>

      <section class="admin__content">
        <!-- side bar -->
        <?php include("includes/side_nav.php"); ?>

        <div class="edit-user-homepage-container">
          <h1>Edit Services Section in Landing Page</h1>
          

          <form action="" method="post">
              <!-- service #1-->
              <div class="field-group">
                  <label for="service1">Main Service #1</label>
                  <input type="text" id="service1" name="service1" value="Routine dental check-ups and cleanings"/>
              </div>
              
              <!-- service #2-->
              <div class="field-group">
                  <label for="service2">Main Service #2</label>
                  <input type="text" id="service2" name="service2" value="Cosmetic dentistry, such as teeth whitening and veneers"/>
              </div>

              <!-- service #3-->
              <div class="field-group">
                  <label for="service3">Main Service #3</label>
                  <input type="text" id="service3" name="service3" value="Orthodontic treatments, including braces and Invisalign"/>
              </div>

              <!-- service #4-->
              <div class="field-group">
                  <label for="service4">Main Service #4</label>
                  <input type="text" id="service4" name="service4" value="Restorative procedures like fillings, crowns, and bridges"/>
              </div>

              <!-- service #5-->
              <div class="field-group">
                  <label for="service5">Main Service #5</label>
                  <input type="text" id="service5" name="service5" value="Emergency dental services"/>
              </div>

              <!-- image -->
              <div class="field-group">
                  <label for="servicespage-image">Update Services Page Image</label>
                  <input type="file" id="servicespage-image" accept="image/*" />
                  <small id="error-message" style="color: red; display: none;">File must be less than 2MB</small>
                  
                  <div class="image-preview" id="image-preview">
                      <p>No image uploaded</p>
                  </div>
              </div>
              
              <button type="submit" id="updateBtn">Update Services Page</button>
          </form>
        </div>
        <!-- modal -->
        <div class="modal" style="display: none;">
          <div class="modal__content">
            <div class="body-text">
              <div class="modal__header">
                <h3 id="modalStatus" class="modal__status">
                  Services Page Updated
                </h3>
              </div>
              <button type="button" id="exitButton" class="modal__button">
                okay, got it!
              </button>
            </div>
            <div class="illustration__container">
              <img src="../assets/admin_assets/update-content.svg" alt="illustration of updated content">
            </div>
          </div>
        </div>
      </section>
    </main>
    <script src="js/image-update.js"></script>
    <script>
      document.addEventListener('DOMContentLoaded', () => {
        const modalContainer = document.querySelector(".modal");
        const exitBtn = modalContainer.querySelector("#exitButton");

        // Check if the modal should be displayed
        <?php if ($showModal): ?>
        modalContainer.style.display = "flex"; // Display the modal when $showModal is true
        <?php endif; ?>

        exitBtn.addEventListener("click", () => {
          modalContainer.style.display = "none"; // Hide the modal on button click
        });
      });

      updatePageImage('servicespage-image')
    </script>
  </body>
</html>
