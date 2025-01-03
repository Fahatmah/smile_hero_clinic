<?php $current_page = basename($_SERVER['PHP_SELF']); ?>

<nav class="nav landing-page">
  <div class="nav-container">
    <a href="index.php" class="logo" style="width: 4rem !important; height: 4rem !important">
      <img src="././assets/logos/logo-with-name-blue-circle-60x60.png" alt="logo" style="width: 4rem !important; height: 4rem !important"/>
    </a>

    <div class="mobile-nav-container hidden">
      <ul class="menu-links">
        <div class="landing-page-links">
          <button class="close-nav-btn">
            <img
              src="./assets/landing-page/nav/arrow-left.svg"
              alt="arrow-left"
              id="closeBtn"
            />
          </button>
          <li <?php echo ($current_page == 'index.php') ? 'class="active__link"' : ''; ?>>
            <a href="index.php">Home</a>
          </li>
          <li <?php echo ($current_page == 'about.php') ? 'class="active__link"' : ''; ?>>
            <a href="./about.php">About</a>
          </li>
          <li <?php echo ($current_page == 'services.php') ? 'class="active__link"' : ''; ?>>
            <a href="./services.php">Services</a>
          </li>
        </div>

        <div class="form-links">
          <li <?php echo ($current_page == 'signup.php') ? 'class="active__link"' : ''; ?>>
            <a href="./signup.php" class="signup-link">Signup</a>
          </li>
          <li <?php echo ($current_page == 'login.php') ? 'class="active__link"' : ''; ?>>
            <a href="./login.php" class="login-link">Login</a>
          </li>
        </div>
      </ul>
    </div>

    <button>
      <img
        src="./assets/landing-page/nav/menu.svg"
        alt="menu-bar"
        id="menuBtn"
        class="menu-button"
      />
    </button>
  </div>
</nav>