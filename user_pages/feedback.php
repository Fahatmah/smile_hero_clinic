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
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&display=swap"
    rel="stylesheet" />
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
        <div class="account">
          <h1>Feedback</h1>

          <form action="includes/send_feedback.php" method="post">
            <input type="text" name="name" placeholder="Name" value="<?php outputFullName() ?>" required/>
            <input type="text" name="email" placeholder="Email" value="<?php outputEmail() ?>" required/>
            <div class="radio-container">
              <h2>Feedback Type</h2>
              <div class="radios">
                <div class="radio-label">
                  <input type="radio" id="compliment" name="choices" value="compliment" required/>
                  <label for="compliment">Compliment</label>
                </div>
                <div class="radio-label">
                  <input type="radio" id="suggestion" name="choices" value="suggestion" required/>
                  <label for="suggestion">Suggestion</label>
                </div>
                <div class="radio-label">
                  <input type="radio" id="complaint" name="choices" value="complaint" required/>
                  <label for="complaint">Complaint</label>
                </div>
              </div>
            </div>
            <textarea name="feedback" id="feedback" placeholder="Please type your feedback here..."></textarea>
            <button>
              <input type="submit" name="submit" value="Submit" style="color: white; cursor: pointer;">
            </button>
          </form>
        </div>
      </div>
    </section>
  </main>
</body>

</html>