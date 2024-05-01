<?php
require_once "includes/config_session.inc.php";
require_once "includes/signup_view.inc.php"
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Signup an Account | Smile Hero Clinic</title>
    <!-- stylesheets -->
    <link rel="stylesheet" href="src/dist/styles.css" />
  </head>
  <body>
    <main>
      <!-- navigation bar -->
      <nav class="nav">
        <img src="./assets/images/logoipsum.svg" alt="smile hero clinic logo " />
        <!-- links -->
        <ul class="nav__links">
          <!-- <li>
            <a href="/index.html#branchesSection">Branches</a>
          </li> -->
          <li>
            <button>
              <a href="#">About Us</a>
            </button>
          </li>
          <li>
            <button>
              <a href="login.php" target="_blank">Login</a>
            </button>
          </li>
          <li class="signup_button">
            <button>
              <a href="signup.html">Sign Up</a>
            </button>
          </li>
        </ul>
      </nav>

      <!-- sign up form -->
      <section class="signup-form__section">
        <h1 class="header">Create new account</h1>
        <!-- form -->
        <form action="includes/signup.inc.php" method="post" class="signup__form">
          <div class="field">
            <label for="fullname">Name</label>
            <input
              type="text"
              placeholder="e.g. Fahatmah Mabang"
              id="fullname"
              name="fullname"
            />
          </div>
          <div class="field">
            <label for="email">Email</label
            ><input
              type="email"
              placeholder="e.g. fahatmahmabang@gmail.com"
              id="email"
              name="email"
            />
          </div>
          <div class="field">
            <label for="username">Username</label
            ><input
              type="text"
              placeholder="e.g. fahatmah"
              id="username"
              name="username"
            />
          </div>
          <div class="field">
            <label for="password">Password</label
            ><input
              type="password"
              placeholder="e.g. password"
              id="password"
              name="password"
            />
          </div>
          <!-- submit button -->
          <button type="submit" class="submit__button">Signup</button>
          <!-- login form link -->
          <a
            href="/login.html"
            target="_blank"
            rel="noopener noreferrer"
            class="login__link"
            >Already have an account? Login</a
          >
        </form>

      <?php
      //classs name of text is form_error
       checkSignupErrors();
      ?>
      </section>
    </main>
    <!-- footer -->
    <footer class="footer__section">
      <div class="footer__header">
        <div class="heading">
          <h5 class="header">Ready for a new smile?</h5>
          <p>Create an account for a new appointment.</p>
        </div>
        <form action="">
          <input
            type="email"
            name="email"
            id="email"
            placeholder="name@email.com"
          />
          <button type="submit">Subscribe</button>
        </form>
      </div>

      <div class="contacts__container">
        <div class="contact">
          <img
            src="/assets/icons/landing_page/location-dot-solid.svg"
            alt=""
            style="width: 2rem; height: 2rem"
          />
          <p>01 Bayani Road, Philippines</p>
        </div>
        <div class="contact">
          <img
            src="/assets/icons/landing_page/envelope-solid.svg"
            alt=""
            style="width: 2rem; height: 2rem"
          />
          <p>smilehero@gmail.com</p>
        </div>
        <div class="contact">
          <img
            src="/assets/icons/landing_page/phone-solid.svg"
            alt=""
            style="width: 2rem; height: 2rem"
          />
          <p>0987 4560 321</p>
        </div>
      </div>

      <div class="social-media__container">
        <p>
          Stay connected on our social media for updates on appointments,
          monthly adjustments, and checkups at our dental clinic.
        </p>

        <div class="social-medias">
          <a href=""
            ><img
              src="/assets/icons/landing_page/square-instagram.svg"
              alt="instagram"
              style="width: 2rem; height: 2rem"
            />
          </a>
          <a href=""
            ><img
              src="/assets/icons/landing_page/square-facebook.svg"
              alt="facebook"
              style="width: 2rem; height: 2rem"
            />
          </a>
          <a href=""
            ><img
              src="/assets/icons/landing_page/linkedin.svg"
              alt="linkedin"
              style="width: 2rem; height: 2rem"
            />
          </a>
        </div>
      </div>
    </footer>
  </body>
</html>
