<?php
require_once 'includes/config_session.inc.php';
require_once 'includes/signup_view.inc.php';
require_once 'includes/login_view.inc.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="shortcut icon" href="./assets/images/logoipsum.svg" type="image/x-icon">
  <title>Log in your account | Smile Hero Clinic</title>
  
  
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
  <main class="login__page">
    <!-- navigation bar -->
    <?php include('nav.php') ?>

    <!-- sign up form -->
    <section class="login form_container">
      <h1 class="header">Login</h1>
      <!-- form -->
      <form action="includes/login.inc.php" method="post" class="login__form">
        <div class="field">
          <input type="email" placeholder="fahatmahmabang@gmail.com" id="email" name="email" required autofocus />
          <label for="email">Email</label>
        </div>
        <div class="field error_handler">
          <input type="password" placeholder="********" id="password" name="password" required />
          <label for="password">Password</label>

            <div class="error_container">
              <?php //classs name of text is form_error
                checkLoginErrors();?>
            </div>
        </div>
        <!-- submit button -->
        <button type="submit" class="submit__button">Login</button>
        <!-- signup form link -->
        <a href="signup.php" rel="noopener noreferrer" class="signup__link">Don't have an account?
          Signup</a>
      </form>
    </section>
  </main>
  <!-- footer -->
  <?php include('footer.php') ?>
</body>

</html>