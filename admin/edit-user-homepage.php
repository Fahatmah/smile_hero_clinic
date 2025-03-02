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
if (isset( $_SESSION['updated-homepage'])) {
    if ( $_SESSION['updated-homepage'] === 'success') {
        $showModal = true;
    }
    unset( $_SESSION['updated-homepage']);
}

require_once '../includes/dbh.inc.php';

$sql = "SELECT * FROM homepage_info WHERE id = 1"; // Assuming there's only one row to fetch
$result = $conn->query($sql);
$content = $result->fetch_assoc();

$conn->close();
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

          <form action="includes/edit-user-homepage.inc.php" method="post" enctype="multipart/form-data">
              <!-- header title -->
              <div class="field-group">
                  <label for="title">Header Title</label>
                  <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($content['title']); ?>" placeholder="Title"/>
              </div>
              
              <!-- sub header 1 -->
              <div class="field-group">
                  <label for="subheader1">Sub Header 1</label>
                  <textarea name="subheader1" id="subheader1"><?php echo htmlspecialchars($content['subheader1']); ?></textarea>
              </div>

              <!-- sub header 2 -->
              <div class="field-group">
                <label for="subheader2">Sub Header 2</label>
                <textarea name="subheader2" id="subheader2"><?php echo htmlspecialchars($content['subheader2']); ?></textarea>
              </div>
              
              <!-- address -->
              <div class="field-group">
                  <label for="address">Address</label>
                  <input type="text" id="address" name="address" value="<?php echo htmlspecialchars($content['address']); ?>" placeholder="address"/>
              </div>

              <!-- workdays -->
              <div class="field-group">
                  <label for="Workdays">Workdays</label>
                  <input type="text" id="Workdays" name="Workdays" value="<?php echo htmlspecialchars($content['workdays']); ?>" placeholder="Monday to Sunday"/>
              </div>

              <!-- number -->
              <div class="field-group">
                  <label for="number">Number</label>
                  <input type="number" id="number" name="number" value="<?php echo htmlspecialchars($content['number']); ?>" placeholder="0917 160 6212"/>
              </div>

              <!-- summary of services (bullet format) -->
              <div class="field-group">
                  <label for="service-input">Services</label>
                  <input type="text" id="service-input" maxlength="60"/>
                  <span id="char-count">0/60 characters</span>
                  <button type="button" id="add-service-btn">Add Service</button>

                  <ul id="services-list"></ul>
                  <input type="hidden" name="services" id="services-hidden-input" />
              </div>

              <!-- image -->
              <div class="field-group">
                  <label for="homepage-image">Upload Homepage Image</label>
                  <input type="file" id="homepage-image" name="homepage-image" accept="image/*" />
                  <small id="error-message" style="color: red; display: none;">File must be less than 2MB</small>
                  
                  <div class="image-preview" id="image-preview">
                      <?php if ($content['image_path']): ?>
                          <img src="../<?php echo $content['image_path'] ?>" alt="Current Image" style="max-width: 100%; height: auto;">
                      <?php else: ?>
                          <p>No image uploaded</p>
                      <?php endif; ?>
                  </div>
              </div>
              
              <button type="submit" id="updateBtn">Update User Homepage</button>
          </form>
        </div>
        <!-- modal -->
        <div class="modal" style="display: none;">
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
    <script src="js/image-update.js"></script>
    <script>
      document.addEventListener('DOMContentLoaded', () => {
        const modalContainer = document.querySelector(".modal");
        const exitBtn = modalContainer.querySelector("#exitButton");

        // Check if the modal should be displayed
       <?php if ($showModal) : ?>
        modalContainer.style.display = "flex";
       <?php endif; ?>
        exitBtn.addEventListener("click", () => {
          modalContainer.style.transform = "scale(0)";
        });
      });
      // Simulated initial list of services (hardcoded for now)
      const initialServices = <?php echo json_encode(json_decode($content['services'], true)); ?>;

      // Select necessary DOM elements
      const serviceInput = document.getElementById("service-input");
      const addServiceBtn = document.getElementById("add-service-btn");
      const servicesList = document.getElementById("services-list");
      const servicesHiddenInput = document.getElementById("services-hidden-input");

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
              updateHiddenInput();
          });

          updateHiddenInput();
      }

      // Function to update the hidden input with the current services
      function updateHiddenInput() {
          const services = [];
          servicesList.querySelectorAll("li").forEach(li => {
              services.push(li.textContent.replace("Remove", "").trim());
          });
          servicesHiddenInput.value = JSON.stringify(services);
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

      updatePageImage('homepage-image')
    </script>
  </body>
</html>
