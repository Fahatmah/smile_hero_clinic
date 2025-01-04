<?php
// Start session and include necessary files for authentication and database connection
session_start();
require_once '../includes/login_view.inc.php';
require_once '../includes/dbh.inc.php';

// Check if admin is logged in, otherwise redirect to login page
if (!isset($_SESSION['adminID'])) {
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
          <h1>Manage Your Website's Contents</h1>

          <div class="links-container">
              <a href="edit-lp-home.php" class="link-item">
                <p class="page-title">
                  <span class="header">Home Page</span>
                  Manage and update the main content displayed on the landing page of your website.
                </p>
                <img src="../assets/admin_assets/icons/arrow-right.svg" alt="arrow right icon">
              </a>
            
              <a href="edit-lp-about.php" class="link-item">
                <p class="page-title">
                  <span class="header">About Page</span>
                  Update information about your clinic such as address and clinic name.
                </p>
                
                <img src="../assets/admin_assets/icons/arrow-right.svg" alt="arrow right icon">
              </a>
            
              <a href="edit-lp-services.php" class="link-item">
                <p class="page-title">
                  <span class="header">Services Page</span>
                  Edit the services offered, showcased on the services page.
                </p>
                
                <img src="../assets/admin_assets/icons/arrow-right.svg" alt="arrow right icon">
              </a>
            
              <a href="edit-lp-promotions.php" class="link-item">
                <p class="page-title">
                  <span class="header">Promotions Page</span>
                  Update promotional banners, deals, and offers displayed on the promotions page.
                </p>
                
                <img src="../assets/admin_assets/icons/arrow-right.svg" alt="arrow right icon">
              </a>
            
              <a href="edit-lp-footer.php" class="link-item">
                <p class="page-title">
                  <span class="header">Footer Component</span>
                  Customize the footer section of the landing page, including contact information and social media links.
                </p>
                
                <img src="../assets/admin_assets/icons/arrow-right.svg" alt="arrow right icon">
              </a>
            
              <a href="edit-user-homepage.php" class="link-item">
                <p class="page-title">
                  <span class="header">User Homepage</span>
                  Adjust content specific to the user homepage to enhance user engagement.
                </p>
                
                <img src="../assets/admin_assets/icons/arrow-right.svg" alt="arrow right icon">
              </a>          
          </div>
        </div>
      </section>
    </main>
  </body>
</html>
