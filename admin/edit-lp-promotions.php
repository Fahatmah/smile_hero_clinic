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
if (isset( $_SESSION['updated_promo_info'])) {
    if ( $_SESSION['updated_promo_info'] === 'success') {
        $showModal = true;
    }
    unset( $_SESSION['updated_promo_info']);
}

// Fetch existing promotions from the database
$promotions = [];
$result = $conn->query("SELECT * FROM promotions_info");
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $promotions[] = $row;
    }
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
          
          <form action="includes/edit-lp-promotions.inc.php" method="post" id="promotionsForm">
            <div id="promotionsContainer" style="width: 100%; display: flex; flex-direction: column; align-items: flex-start; gap: 1rem">
              <?php $PromoNum = 1; foreach ($promotions as $promotion): ?>
              <div class="field-group" data-id="<?php echo $promotion['id']; ?>">
                <input type="hidden" name="promo_id[]" value="<?php echo $promotion['id']; ?>" />
                <label for="promo_title">Promo Title <?php echo $PromoNum?></label>
                <input type="text" id="promo_title" name="promo_title[]" value="<?php echo $promotion['title']; ?>" />
                <label for="promotion_desc">Description <?php echo $PromoNum?></label>
                <input type="text" id="promotion_desc" name="promotion_desc[]" value="<?php echo $promotion['description']; ?>" />
                <label for="start_date">Start Date:</label>
                <input type="text" id="start_date" name="start_date[]" class="flatpickr" value="<?php echo $promotion['start_date']; ?>" />
                <label for="end_date">End Date:</label>
                <input type="text" id="end_date" name="end_date[]" class="flatpickr" value="<?php echo $promotion['end_date']; ?>" />
                <button type="button" class="removePromotionBtn">Delete</button>
              </div>
              <?php $PromoNum++; endforeach; ?>
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
          <input type="hidden" name="promo_id[]" value="" />
          <label for="promo_title">New Promotion Title</label>
          <input type="text" id="promo_title" name="promo_title[]" placeholder="Enter promotion name"" />
          <label contenteditable="true" for="promotion">New Promotion Description</label>
          <input type="text" id="promotion_desc" name="promotion_desc[]" placeholder="Enter promotion details here." />
          <label for="start_date">Start Date:</label>
          <input type="text" id="start_date" name="start_date[]" class="flatpickr" placeholder="Select Date" />
          <label for="end_date">End Date:</label>
          <input type="text" id="end_date" name="end_date[]" class="flatpickr" placeholder="Select Date" />
          <button type="button" class="removePromotionBtn">Delete</button>
        `;
        promotionsContainer.appendChild(newPromotion);

        // Initialize the flatpickr on new input fields
        flatpickr(`#start_date`, { dateFormat: 'Y-m-d' });
        flatpickr(`#end_date`, { dateFormat: 'Y-m-d' });
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
