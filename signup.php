<?php
require_once "includes/config_session.inc.php";
require_once "includes/signup_view.inc.php"
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="shortcut icon" href="./assets/images/logoipsum.svg" type="image/x-icon">
  <title>Signup an Account | Smile Hero Clinic</title>
  
  
  <!-- stylesheets -->
  <link rel="stylesheet" href="src/dist/styles.css" />
  <style>
  .error_container {
    position: absolute;
    display: flex;
    justify-content: center;
    bottom: -1.5em;
    column-gap: 3px;
    width: 100%;
  }

  .form_error {
    color: red;
    font-size: .75rem;
  }

  .error_handler {
    position: relative;
  }
  </style>
</head>

<body>
  <main class="signup__page">
    <!-- navigation bar -->
    <?php include('nav.php') ?>

    <!-- sign up form -->
    <section class="signup form_container">
      <h1 class="header">Create new account</h1>
      <!-- form -->
      <form action="includes/signup.inc.php" method="post" class="signup__form">
        <div class="field">
          <input type="text" placeholder="e.g. Fahatmah Mabang" id="fullname" name="fullname" required autofocus />
          <label for="fullname">Name</label>
        </div>
        <div class="field">
          <input type="email" placeholder="e.g. fahatmahmabang@gmail.com" id="email" name="email" required />
          <label for="email">Email</label>
        </div>
        <div class="field">
          <input type="tel" placeholder="e.g. 09000000000" id="contact" name="contact" required />
          <label for="contact">Contact Number</label>
        </div>
        <div class="field error_handler">
          <input type="password" placeholder="e.g. password" id="password" name="password" required />
          <label for="password">Password</label>

            <div class="error_container">
              <?php //classs name of text is form_error
                checkSignupErrors();?>
            </div>
        </div>


        <!-- submit button -->
        <button type="submit" class="submit__button">Signup</button>
        <!-- login form link -->
        <a href="login.php" rel="noopener noreferrer" class="login__link">Already have an account?
          Login</a>
      </form>
    </section>
  </main>
  <!-- footer -->
  <?php include('footer.php') ?>
</body>

</html>