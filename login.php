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
  <title>Log in your account | Smile Hero Clinic</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&display=swap"
    rel="stylesheet">
  <!-- stylesheets -->
  <link rel="stylesheet" href="src/dist/styles.css" />

  <style>
  .form_error {
    position: absolute;
    display: block;
    left: 10em;
    top: 22em;
    color: red;
    font-size: .75rem;
  }

  .login-form__section {
    position: relative;
  }
  </style>
</head>

<body>
  <main class="login__page"
    style='background: url(assets/images/mesh_bg.png); background-repeat: no-repeat; background-size: cover'>
    <!-- navigation bar -->
    <?php include('nav.php') ?>

    <!-- sign up form -->
    <section class="login-form__section">
      <h1 class="header">Login</h1>
      <!-- form -->
      <form action="includes/login.inc.php" method="post" class="login__form">
        <div class="field">
          <label for="username">Username</label>
          <input type="text" placeholder="fahatmahmabang" id="username" name="username" required />
        </div>
        <div class="field">
          <label for="password">Password</label><input type="password" placeholder="********" id="password"
            name="password" required />
        </div>
        <?php
          //classs name of text is form_error
          checkLoginErrors();
        ?>
        <!-- submit button -->
        <button type="submit" class="submit__button">login</button>
        <!-- signup form link -->
        <a href="signup.php" target="_blank" rel="noopener noreferrer" class="signup__link">Don't have an account?
          Signup</a>
      </form>
    </section>
  </main>
  <!-- footer -->
  <?php include('footer.php') ?>
</body>

</html>