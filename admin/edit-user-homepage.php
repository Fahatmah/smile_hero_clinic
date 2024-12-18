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

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="../assets/logos/logo-white.png" type="image/x-icon" />
    <title>Manage User Homepage | Admin</title>
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
          <h1>Manage User Homepage</h1>

          <form action="" method="post">
              <!-- header title -->
              <div class="field-group">
                  <label for="title">Header Title</label>
                  <!-- 
                      jp, pakilagay mo na lang current title 
                      as well as to other input fields gaya 
                      nung sa user apt form, already filled
                      with their name, contact and email
                  -->
                  <input type="text" id="title" name="title" placeholder="Title"/>
              </div>
              
              <!-- sub header 1 -->
              <div class="field-group">
                  <label for="subheader1">Sub Header 1</label>
                  <textarea name="subheader1" id="subheader1">Your Trusted Partner for Comprehensive Dental Care</textarea>
              </div>

              <!-- sub header 2 -->
              <div class="field-group">
                <label for="subheader2">Sub Header 2</label>
                <textarea name="subheader2" id="subheader2">We make booking easy with our web-based appointment system. Schedule your dental visits quickly from anywhere—home, work, or on the go.</textarea>
              </div>
              
              <!-- address -->
              <div class="field-group">
                  <label for="address">Address</label>
                  <input type="text" id="address" name="address" placeholder="address"/>
              </div>

              <!-- workdays -->
              <div class="field-group">
                  <label for="Workdays">Workdays</label>
                  <input type="text" id="Workdays" name="Workdays" placeholder="Monday to Sunday"/>
              </div>

              <!-- number -->
              <div class="field-group">
                  <label for="number">Number</label>
                  <input type="number" id="number" name="number" placeholder="0917 160 6212"/>
              </div>

              <!-- summary of services (bullet format) -->
              <div class="field-group">
                  <label for="service-input">Services</label>
                  <input type="text" id="service-input" maxlength="60"/>
                  <span id="char-count">0/60 characters</span>
                  <button type="button" id="add-service-btn">Add Service</button>

                  <ul id="services-list"></ul>
              </div>

              <!-- image -->
              <div class="field-group">
                  <label for="homepage-image">Upload Homepage Image</label>
                  <input type="file" id="homepage-image" accept="image/*" />
                  
                  <div class="image-preview" id="image-preview">
                      <p>No image uploaded</p>
                  </div>
              </div>
              
              <button type="submit" id="updateBtn">Update User Homepage</button>
          </form>
        </div>
        <!-- modal -->
        <div class="modal" style="display: flex;">
          <div class="modal__content">
            <div class="body-text">
              <div class="modal__header">
                <h3 id="modalStatus" class="modal__status">
                  User Homepage Updated
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
        // <?php   //if ($showModal) : ?>
        modalContainer.style.display = "flex";
        // <?php // endif; ?>
        exitBtn.addEventListener("click", () => {
          modalContainer.style.transform = "scale(0)";
        });
      });
      // Simulated initial list of services (hardcoded for now)
      const initialServices = [
          "Routine dental check-ups and cleanings",
          "Cosmetic dentistry, such as teeth whitening and veneers",
          "Orthodontic treatments, including braces and Invisalign",
          "Restorative procedures like fillings, crowns, and bridges",
          "Emergency dental services"
      ];

      // Select necessary DOM elements
      const serviceInput = document.getElementById("service-input");
      const addServiceBtn = document.getElementById("add-service-btn");
      const servicesList = document.getElementById("services-list");

      // Function to render initial services
      function renderInitialServices() {
          initialServices.forEach(service => {
              addServiceToList(service);
          });
      }

      // Function to add a service to the list
      function addServiceToList(service) {
          // Create a list item
          const li = document.createElement("li");
          li.textContent = service;

          // Add a "Remove" button for each service
          const removeBtn = document.createElement("button");
          removeBtn.textContent = "Remove";
          removeBtn.classList.add("remove-btn");
          li.appendChild(removeBtn);

          // Append the list item to the services list
          servicesList.appendChild(li);

          // Add event listener to remove the list item
          removeBtn.addEventListener("click", () => {
              servicesList.removeChild(li);
          });
      }

      // Select the necessary DOM elements for character counting
      const charCountDisplay = document.getElementById("char-count");

      // Update the character count as the user types
      serviceInput.addEventListener("input", () => {
          const currentLength = serviceInput.value.length;
          charCountDisplay.textContent = `${currentLength}/60 characters`;
      });

      // Event listener for the "Add" button
      addServiceBtn.addEventListener("click", () => {
          const serviceText = serviceInput.value.trim(); // Trim input to avoid extra spaces

          if (serviceText === "") {
              alert("Service cannot be empty.");
          } else if (serviceText.length > 60) {
              alert("Service cannot exceed 60 characters.");
          } else {
              addServiceToList(serviceText);
              serviceInput.value = "";
              charCountDisplay.textContent = `0/60 characters`;
          }
      });

      serviceInput.addEventListener("keydown", (event) => {
          if (event.key === "Enter") {
              event.preventDefault(); 
              addServiceBtn.click();
          }
      });

      // render initial hardcoded services on page load
      renderInitialServices();

      // Select the file input and preview container
      const imageInput = document.getElementById("homepage-image");
      const imagePreview = document.getElementById("image-preview");

      // Event listener for when a file is selected
      imageInput.addEventListener("change", () => {
          const file = imageInput.files[0]; // Get the selected file

          // Check if a file is selected and is an image
          if (file && file.type.startsWith("image/")) {
              const reader = new FileReader();

              // When the file is loaded, set it as the preview image
              reader.onload = function (e) {
                  imagePreview.innerHTML = `<img src="${e.target.result}" alt="Selected Image" style="max-width: 100%; height: auto; border: 1px solid #ddd; border-radius: 5px;" />`;
              };

              reader.readAsDataURL(file); // Read the file as a data URL
          } else {
              // If no valid image is selected, reset the preview
              imagePreview.innerHTML = `<p>No image uploaded</p>`;
          }
      });
    </script>
  </body>
</html>
