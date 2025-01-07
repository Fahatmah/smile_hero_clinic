<?php 
include_once "includes/dbh.inc.php";
function isPromotionsTableEmpty($conn) {
    $query = "SELECT COUNT(*) FROM promotions_info";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_row($result);
    return $row[0] == 0;
}

$show_promotions = !isPromotionsTableEmpty($conn);

// try mo insert to sa sql ng promotions_info
//  INSERT INTO promotions_info (title, description, start_date, end_date, discount_percentage) VALUES ('New Patient Special', 'Get a Free Dental exam and X-rays on your first visit.', '2025-01-01', '2025-12-31', NULL), ('Family Plans', 'Bring your family for checkups and get 10% off.', '2025-01-01', '2025-12-31', 10.00), ('Teeth Whitening Discount', 'Brighten your smile with 30% Off Professional Whitening Treatments.', '2025-01-01', '2025-12-31', 30.00), ('Emergency Dental Care Offer', 'Flat $50 Off for Same-Day Emergency Appointments.', '2025-01-01', '2025-12-31', NULL);


$current_page = basename($_SERVER['PHP_SELF']); 
?>

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

          <li class="dropdown <?php echo ($current_page == 'services.php' || ($current_page == 'promotions.php' && $show_promotions)) ? 'active__link' : ''; ?>">
            <a href="#" class="dropdown-toggle">Offers</a>
            <ul class="dropdown-menu">
              <li <?php echo ($current_page == 'services.php') ? 'class="active__link"' : ''; ?>>
                <a href="./services.php">Services</a>
              </li>
              
              <?php if ($show_promotions): ?>
                <li <?php echo ($current_page == 'promotions.php') ? 'class="active__link"' : ''; ?>>
                  <a href="./promotions.php">Promotions</a>
                </li>
              <?php endif; ?>
            </ul>
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