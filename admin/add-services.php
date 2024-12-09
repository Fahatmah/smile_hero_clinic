<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="../assets/logos/logo-white.png" type="image/x-icon" />
    <title>Add Service | Admin</title>
    <link rel="stylesheet" href="../src/dist/styles.css" />
  </head>
  <body class="admin__page">
    <main class="admin__main">
      <!-- nav header -->
      <?php include("includes/nav.php"); ?>

      <section class="admin__content">
        <!-- side bar -->
        <?php include("includes/side_nav.php"); ?>

        <div class="set-date-container">
          <h1>Add Service</h1>

          <form action="" method="post" id="">
              <div class="field-group">
                  <label for="dates">Enter Service Name</label>
                  <input type="text" id="serviceName" name="service-name" placeholder="Service Name here..." required="true" />
              </div>

              <div class="field-group">
                  <label for="servicePrice">Set Price</label>
                  <input type="number" id="servicePrice" name="service-price" placeholder="Enter the service price" required="true" />
              </div>
              <button type="submit">Add New Service</button>
          </form>

          <!-- modal -->
        <div class="modal" style="display: none">
          <div class="modal__content">
            <div class="body-text">
              <div class="modal__header">
                <h3 id="modalStatus" class="modal__status">
                  New Service Added
                </h3>
                <p id="modalMessage" class="modal__message">
                  <a href="services.php">
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
          
        </div>
      </section>
    </main>

    <script>
      document.addEventListener('DOMContentLoaded', () => {
        const modalContainer = document.querySelector(".modal");
        const exitBtn = modalContainer.querySelector("#exitButton");
        const modalStatus = modalContainer.querySelector("#modalStatus");

        // Check if the modal should be displayed
        <?php if ($showModal) : ?>
        modalStatus.innerText = "<?php echo $modalStatus; ?>";
        modalContainer.style.display = "flex";
        <?php endif; ?>
        exitBtn.addEventListener("click", () => {
          modalContainer.style.transform = "scale(0)";
        });
      });
    </script>
  </body>
  
</html>