<?php 
include_once "includes/dbh.inc.php";
?>

<!DOCTYPE html>
<html lang="en">
<s>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="./assets/logos/logo-blue.png" type="image/x-icon">
  <title>Promotions | Smile Hero Clinic</title>
  <link rel="stylesheet" href="src/dist/styles.css" />

  <style>
    .promotion-duration {
      display: flex;
      align-items: center;
      justify-content: flex-start;
      gap: 1rem;
    }

    .promotion-duration > * {
      font-weight: 600;
      color: #1d72f2;
      padding: 0.5rem 0.8rem;
      border-radius: 0.5rem;
      border: 1px solid #1d72f2;
      background: #1d72f220;
    }

    /* .promotion-duration .start-date {

    } */
  </style>
</s>
<body class="homepage">
  <main class="promotions-page">
    <?php include("nav.php"); ?>

    <header>
      <div class="texts-container">

        <h1>Special Offers and Promotions</h1>
        
        <div class="cards-container">
          <div class="card">
            <p class="header">New Patient Special</p>
            <p class="description">Get a Free Dental exam and X-rays on your first visit.</p>

            <div class="promotion-duration">
              <p class="start-date">Start Date: 2025-01-01</p>
              <p class="end-date">End Date: 2025-12-31</p>
            </div>
          </div>
          
          <div class="card">
            <p class="header">Family Plans</p>
            <p class="description">Bring your family for checkups and get 10% off.</p>

            <div class="promotion-duration">
              <p class="start-date">Start Date: 2025-01-01</p>
              <p class="end-date">End Date: 2025-12-31</p>
            </div>
          </div>
          
          <div class="card">
            <p class="header">Teeth Whitening Discount</p>
            <p class="description">Brighten your smile with 30% Off Professional Whitening Treatments.</p>

            <div class="promotion-duration">
              <p class="start-date">Start Date: 2025-01-01</p>
              <p class="end-date">End Date: 2025-12-31</p>
            </div>
          </div>
          
          <div class="card">
            <p class="header">Emergency Dental Care Offer</p>
            <p class="description">Flat $50 Off for Same-Day Emergency Appointments.</p>

            <div class="promotion-duration">
              <p class="start-date">Start Date: 2025-01-01</p>
              <p class="end-date">End Date: 2025-12-31</p>
            </div>
          </div>
        </div>
      </div>
    </header>
  </main>

  <?php include("footer.php"); ?>
</body>
<script src="./js/nav.js"></script>
<script>
    // Function to format date to "01 Jan 2025" format
    function formatDate(dateString) {
      const date = new Date(dateString);
      const options = { day: '2-digit', month: 'short', year: 'numeric' };
      return date.toLocaleDateString('en-GB', options); // 'en-GB' for "01 Jan 2025" format
    }

    // Convert all start and end dates
    document.querySelectorAll('.start-date').forEach(function(element) {
      const originalDate = element.textContent.replace('Start Date: ', '').trim();
      element.textContent = 'Start Date: ' + formatDate(originalDate);
    });

    document.querySelectorAll('.end-date').forEach(function(element) {
      const originalDate = element.textContent.replace('End Date: ', '').trim();
      element.textContent = 'End Date: ' + formatDate(originalDate);
    });
  </script>
</html>