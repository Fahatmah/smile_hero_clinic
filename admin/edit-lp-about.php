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

$showModal = false;
if (isset( $_SESSION['updated_about_info'])) {
    if ( $_SESSION['updated_about_info'] === 'success') {
        $showModal = true;
    }
    unset( $_SESSION['updated_about_info']);
}

$query = "SELECT * FROM about_info";
$stmt = $conn->prepare($query);
$stmt->execute();

$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="../assets/logos/logo-white.png" type="image/x-icon" />
    <title>Edit About Page Component | Landing Page | Admin</title>
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
          <h1>Edit About Section in Landing Page</h1>
          
          <?php if($dataFetch = $result->fetch_assoc()) : ?>

          <form action="includes/edit-lp-about.inc.php" method="post">
              <!-- address-->
              <div class="field-group">
                  <label for="address">Short Address</label>
                  <input type="text" id="address" name="address" value="<?php echo $dataFetch['address'] ?>"/>
              </div>

              <!-- clinic name -->
              <div class="field-group">
                  <label for="clinicname">Clinic Name</label>
                  <input type="text" id="clinicname" name="clinicname" value="<?php echo $dataFetch['clinicname'] ?>"/>
              </div>

              <!-- image -->
              <div class="field-group">
                  <label for="aboutpage-image">Update About Page Image</label>
                  <input type="file" id="aboutpage-image" accept="image/*" />
                  <small id="error-message" style="color: red; display: none;">File must be less than 2MB</small>
                  
                  <div class="image-preview" id="image-preview">
                      <p>No image uploaded</p>
                  </div>
              </div>
              
              <button type="submit" id="updateBtn">Update About Page</button>
              <?php endif; ?>
          </form>
        </div>
        <!-- modal -->
        <div class="modal" style="display: none;">
          <div class="modal__content">
            <div class="body-text">
              <div class="modal__header">
                <h3 id="modalStatus" class="modal__status">
                  About Page Updated
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

      updatePageImage('aboutpage-image')
    </script>
  </body>
</html>
