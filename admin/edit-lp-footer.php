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
if (isset( $_SESSION['footer_update'])) {
    if ( $_SESSION['footer_update'] === 'success') {
        $showModal = true;
    }
    unset( $_SESSION['footer_update']);
}

$query = "SELECT * FROM footer_info";
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
    <title>Edit Footer Component | Admin</title>
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
          <h1>Edit Footer Component</h1>
          

          <form action="includes/edit-lp-footer.inc.php" method="post">
            <?php if($dataFetch = $result->fetch_assoc()): ?>
              <div class="headers-container">
                <p class="title">Headers</p>
                
                <div class="container">
                  <!-- header title 1 -->
                  <div class="field-group">
                    <label for="title1">Header Title 1</label>
                    <input type="text" id="title1" name="title1" value="<?php echo $dataFetch['title_one']?>"/>
                  </div>

                  <!-- header title 2 -->
                  <div class="field-group">
                    <label for="title2">Header Title 2</label>
                    <input type="text" id="title2" name="title2" value="<?php echo $dataFetch['title_two']?>"/>
                  </div>
                </div>
              </div>
                
              <div class="contacts-container">
                <p class="title">Contact Information</p>

                <div class="container">
                  <!-- number -->
                  <div class="field-group">
                    <label for="number">Contact Number</label>
                    <input type="tel" id="number" name="number" value="<?php echo $dataFetch['contact']?>"/>
                  </div>
                  
                  <!-- email -->
                  <div class="field-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" value="<?php echo $dataFetch['email']?>"/>
                  </div>
                  
                  <!-- socmedname -->
                  <div class="field-group">
                    <label for="socmedname">Facebook Account Name</label>
                    <input type="text" id="socmedname" name="socmedname" value="<?php echo $dataFetch['socmedname']?>"/>
                  </div>

                  <!-- socmedlink -->
                  <div class="field-group">
                    <label for="socmedlink">Facebook Account Link</label>
                    <input type="text" id="socmedlink" name="socmedlink" value="<?php echo $dataFetch['socmedlink']?>"/>
                  </div>
                </div>
              </div>

              <div class="address-container">

                <p class="title">Address</p>

                <div class="container">

                  
                  <!-- address -->
                  <div class="field-group">
                    <label for="address">Clinic Address</label>
                    <input type="text" id="address" name="address" value="<?php echo $dataFetch['address']?>"/>
                  </div>
                  
                  <div class="other-branch-container" style="width: 100%; display: flex; gap: 0.5rem">
                    <!-- otherbranch 1 -->
                    <div class="field-group" style="width: 20rem">
                      <label for="otherbranch1">Other Branch 1 - Barangay Name</label>
                      <input type="text" id="otherbranch1" name="otherbranch1" value="<?php echo $dataFetch['otherbranch_one']?>"/>
                    </div>
                    
                    <!-- otherbranch 1 link -->
                    <div class="field-group">
                      <label for="otherbranch1link">Other Branch 1 - Full Address/Google Map</label>
                      <input type="text" id="otherbranch1link" name="otherbranch1link" value="<?php echo $dataFetch['otherbranch_one_link']?>"/>
                    </div>
                  </div>
                  
                  <div class="other-branch-container" style="width: 100%; display: flex; gap: 0.5rem">
                    <!-- otherbranch 2 -->
                    <div class="field-group" style="width: 20rem">
                      <label for="otherbranch2">Other Branch 2 - Barangay Name</label>
                      <input type="text" id="otherbranch2" name="otherbranch2" value="<?php echo $dataFetch['otherbranch_two']?>"/>
                    </div>
                    
                    <!-- otherbranch 2 link -->
                    <div class="field-group">
                      <label for="otherbranch2link">Other Branch 2 - Full Address/Google Map</label>
                      <input type="text" id="otherbranch2link" name="otherbranch2link" value="<?php echo $dataFetch['otherbranch_two_link']?>"/>
                    </div>
                  </div>
                </div>
              </div>
              
              <!-- paragraph -->
              <div class="field-group">
                  <label for="paragraph">Paragraph</label>
                  <textarea name="paragraph" id="paragraph"><?php echo $dataFetch['paragraph']?></textarea>
              </div>
            <?php endif; ?>
              <button type="submit" id="updateBtn">Update Footer Component</button>
          </form>
        </div>
        <!-- modal -->
        <div class="modal" style="display: none;">
          <div class="modal__content">
            <div class="body-text">
              <div class="modal__header">
                <h3 id="modalStatus" class="modal__status">
                  Landing Page Footer Component Updated
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

    </script>
  </body>
</html>
