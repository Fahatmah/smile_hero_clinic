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
    <title>Edit Home Page Component | Landing Page | Admin</title>
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
          <h1>Edit Homepage Component in Landing Page</h1>
          

          <form action="" method="post">
              <!-- header-->
              <div class="field-group">
                  <label for="header">Header</label>
                  <input type="text" id="header" name="header" value="Seamless smiles begin here"/>
              </div>

              <!-- subheading -->
              <div class="field-group">
                  <label for="subheading">Subheading</label>
                  <input type="text" id="subheading" name="subheading" value="Expert dental care for a confident, healthy smile. Streamlined dental appointments for your convenience"/>
              </div>

              <!-- image -->
              <div class="field-group">
                  <label for="homepage-image">Update Homepage Image</label>
                  <input type="file" id="homepage-image" accept="image/*" />
                  <small id="error-message" style="color: red; display: none;">File must be less than 2MB</small>
                  
                  <div class="image-preview" id="image-preview">
                      <p>No image uploaded</p>
                  </div>
              </div>
              
              <button type="submit" id="updateBtn">Update Homepage</button>
          </form>
        </div>
        <!-- modal -->
        <div class="modal" style="display: none;">
          <div class="modal__content">
            <div class="body-text">
              <div class="modal__header">
                <h3 id="modalStatus" class="modal__status">
                  Homepage Updated
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

      document.addEventListener("DOMContentLoaded", () => {
      const imageInput = document.getElementById("homepage-image");
      const imagePreview = document.getElementById("image-preview");
      const errorMessage = document.getElementById("error-message");
      const updateBtn = document.getElementById("updateBtn");

        // Event listener for when a file is selected
      imageInput.addEventListener("change", () => {
        const file = imageInput.files[0]; // Get the selected file
        errorMessage.style.display = "none"; // Reset error message

        // Check if a file is selected and is an image
        if (file) {
          if (file.size > 2 * 1024 * 1024) { // Check file size (2MB)
            errorMessage.textContent = "File must be less than 2MB";
            errorMessage.style.display = "block";
            imageInput.value = ""; // Reset the file input
            imagePreview.innerHTML = `<p>No image uploaded</p>`;
            return;
          }

          if (file.type.startsWith("image/")) {
            const reader = new FileReader();

            // When the file is loaded, set it as the preview image
            reader.onload = function (e) {
              imagePreview.innerHTML = `<img src="${e.target.result}" alt="Selected Image" style="max-width: 100%; height: auto; border: 1px solid #ddd; border-radius: 5px;" />`;
            };

            reader.readAsDataURL(file); // Read the file as a data URL
          } else {
            imagePreview.innerHTML = `<p>No image uploaded</p>`;
          }
        }
        });
      });

    </script>
  </body>
</html>
