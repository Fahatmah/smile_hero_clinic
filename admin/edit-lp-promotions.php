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
    <title>Edit Promotions Page Component | Landing Page | Admin</title>
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
          <h1>Edit Promotions Section in Landing Page</h1>
          
          <form action="" method="post" id="promotionsForm">
            <div id="promotionsContainer" style="width: 100%; display: flex; flex-direction: column; align-items: flex-start; gap: 1rem">
              <!-- Promotion 1 -->
              <div class="field-group" data-id="1">
                <label contenteditable="true" for="promotion1">New Patient Special</label>
                <input type="text" id="promotion1" name="promotion1" value="Get a Free Dental exam and X-rays on your first visit." />
                <label for="start_date1">Start Date:</label>
                <input type="text" id="start_date1" name="start_date1" class="flatpickr" value="2025-01-01" />
                <label for="end_date1">End Date:</label>
                <input type="text" id="end_date1" name="end_date1" class="flatpickr" value="2025-12-31" />
                <button type="button" class="removePromotionBtn">Delete</button>
              </div>
              <!-- Promotion 2 -->
              <div class="field-group" data-id="2">
                <label contenteditable="true" for="promotion2">Family Plans</label>
                <input type="text" id="promotion2" name="promotion2" value="Bring your family for checkups and get 10% off." />
                <label for="start_date2">Start Date:</label>
                <input type="text" id="start_date2" name="start_date2" class="flatpickr" value="2025-01-01" />
                <label for="end_date2">End Date:</label>
                <input type="text" id="end_date2" name="end_date2" class="flatpickr" value="2025-12-31" />
                <button type="button" class="removePromotionBtn">Delete</button>
              </div>
              <!-- Promotion 3 -->
              <div class="field-group" data-id="3">
                <label contenteditable="true" for="promotion3">Teeth Whitening Discount</label>
                <input type="text" id="promotion3" name="promotion3" value="Brighten your smile with 30% Off Professional Whitening Treatments." />
                <label for="start_date3">Start Date:</label>
                <input type="text" id="start_date3" name="start_date3" class="flatpickr" value="2025-01-01" />
                <label for="end_date3">End Date:</label>
                <input type="text" id="end_date3" name="end_date3" class="flatpickr" value="2025-12-31" />
                <button type="button" class="removePromotionBtn">Delete</button>
              </div>
              <!-- Promotion 4 -->
              <div class="field-group" data-id="4">
                <label contenteditable="true" for="promotion4">Emergency Dental Care Offer</label>
                <input type="text" id="promotion4" name="promotion4" value="Flat $50 Off for Same-Day Emergency Appointments." />
                <label for="start_date4">Start Date:</label>
                <input type="text" id="start_date4" name="start_date4" class="flatpickr" value="2025-01-01" />
                <label for="end_date4">End Date:</label>
                <input type="text" id="end_date4" name="end_date4" class="flatpickr" value="2025-12-31" />
                <button type="button" class="removePromotionBtn">Delete</button>
              </div>
            </div>
            <button type="button" id="addPromotionBtn">Add Promotion</button>
            <button type="submit" id="updateBtn">Update Promotions Page</button>
            <input type="hidden" name="deletedPromotions" id="deletedPromotions" value="">
          </form>
        </div>

        <!-- modal -->
        <div class="modal" style="display: none;">
          <div class="modal__content">
            <div class="body-text">
              <div class="modal__header">
                <h3 id="modalStatus" class="modal__status">
                  Promotions Page Updated
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
      // Initialize flatpickr for date inputs
      flatpickr('.flatpickr', {
        dateFormat: 'Y-m-d',  // Set the date format
      });

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

      const promotionsContainer = document.getElementById('promotionsContainer');
      const addPromotionBtn = document.getElementById('addPromotionBtn');
      const deletedPromotionsInput = document.getElementById('deletedPromotions');
      let promotionCount = promotionsContainer.querySelectorAll('.field-group').length;
      const deletedPromotions = [];

      // Prevent default focus behavior on label click
      promotionsContainer.addEventListener('click', (e) => {
        if (e.target.tagName === 'LABEL') {
          e.preventDefault(); // Prevent focusing the input field
          e.target.focus();   // Allow direct editing of the label
        }
      });

      // Add new promotion
      addPromotionBtn.addEventListener('click', () => {
        promotionCount++;
        const newPromotion = document.createElement('div');
        newPromotion.className = 'field-group';
        newPromotion.dataset.id = `new-${promotionCount}`;
        newPromotion.innerHTML = `
          <label contenteditable="true" for="promotion${promotionCount}">New Promotion</label>
          <input type="text" id="promotion${promotionCount}" name="promotion${promotionCount}" value="Enter promotion details here." />
          <label for="start_date${promotionCount}">Start Date:</label>
          <input type="text" id="start_date${promotionCount}" name="start_date${promotionCount}" class="flatpickr" value="2025-01-01" />
          <label for="end_date${promotionCount}">End Date:</label>
          <input type="text" id="end_date${promotionCount}" name="end_date${promotionCount}" class="flatpickr" value="2025-12-31" />
          <button type="button" class="removePromotionBtn">Delete</button>
        `;
        promotionsContainer.appendChild(newPromotion);

        // Initialize the flatpickr on new input fields
        flatpickr(`#start_date${promotionCount}`, { dateFormat: 'Y-m-d' });
        flatpickr(`#end_date${promotionCount}`, { dateFormat: 'Y-m-d' });
      });

      // Remove promotion
      promotionsContainer.addEventListener('click', (e) => {
        if (e.target.classList.contains('removePromotionBtn')) {
          const fieldGroup = e.target.closest('.field-group');
          if (fieldGroup) {
            const promotionId = fieldGroup.dataset.id;

            // Mark for deletion if it is an existing promotion
            if (!promotionId.startsWith('new-')) {
              deletedPromotions.push(promotionId);
              deletedPromotionsInput.value = deletedPromotions.join(',');
            }

            promotionsContainer.removeChild(fieldGroup);
          }
        }
      });
    </script>
  </body>
</html>
