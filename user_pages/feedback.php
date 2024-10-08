<?php
require_once '../includes/config_session.inc.php';
require_once '../includes/login_view.inc.php';

if(!isset($_SESSION['user_id'])) {
  // Redirect user to login if not logged in
  header("Location: ../login.php");
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="shortcut icon" href="../assets/images/logoipsum.svg" type="image/x-icon" />
  <title>Feedback Form | Smile Hero Clinic</title>
  
  <link rel="stylesheet" href="../src/dist/styles.css" />
</head>

<body class="user__page">
  <main class="user__main">
    <!-- navigation header bar -->
    <?php include('includes/nav.php'); ?>

    <section class="user-contents">
      <!-- navigation side nav -->
      <?php include('includes/sidenav.php'); ?>

      <!--  -->
      <div class="feedback__page account__container">
        <h1 class="header">We’d love to hear your feedback</h1>

        <form action="includes/send_feedback.php" method="post" class="form">
          <div class="form__rating">
            <h2>How would you rate our service?</h2>

            <div class="rating-container">
              <div class="radio-field">
                <input type="radio" name="rating" id="terrible" value="1" required>
                <label for="terrible">😡 <span>Terrible</span></label>
              </div>

              <div class="radio-field">
                <input type="radio" name="rating" id="bad" value="2" required>
                <label for="bad">😟 <span>Bad</span></label>
              </div>

              <div class="radio-field">
                <input type="radio" name="rating" id="okay" value="3" required> 
                <label for="okay">😐 <span>Okay</span></label>
              </div>

              <div class="radio-field">
                <input type="radio" name="rating" id="good" value="4" required>
                <label for="good">🙂 <span>Good</span></label>
              </div>

              <div class="radio-field">
                <input type="radio" name="rating" id="awesome" value="5" required>
                <label for="awesome">😁 <span>Awesome</span></label>
              </div>
            </div>
          </div>

          <textarea class="feedback-message" name="feedback" id="feedback" placeholder="Write your feedback here..." rows="3"></textarea>

          <input type="submit" name="submit" value="Submit" class="feedback__submit-btn">
        </form>
      </div>
    </section>
  </main>
</body>
<script>
  const feedbackMsg = document.getElementById('feedback')

  const adjustHeight = () => {
    feedbackMsg.style.height = 'auto'
    feedbackMsg.style.height = `${feedbackMsg.scrollHeight}px`
  }

  feedbackMsg.addEventListener('input', adjustHeight)

  adjustHeight()
</script>
</html>