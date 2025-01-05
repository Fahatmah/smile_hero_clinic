<?php

require_once 'includes/dbh.inc.php';

$query = "SELECT * FROM home_info";
$stmt = $conn->prepare($query);
$stmt->execute();

$result = $stmt->get_result();


?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="./assets/logos/logo-blue.png" type="image/x-icon">
    <title>Home | Smile Hero Clinic</title>
    <link rel="stylesheet" href="src/dist/styles.css" />
  </head>
  <body class="homepage">
    <main>
      <?php include("nav.php"); ?>

      <?php if($dataFetch = $result->fetch_assoc()) : ?>
      <header>
        <div class="main-header-container">
          <div class="header-container">
            <div class="header-texts">
                <h1>
                  <?php echo $dataFetch['header'] ?>
                </h1>
                <p>
                <?php echo $dataFetch['subheading'] ?>
                </p>
              </div>
              
              <div class="form-links">
                <li><a href="signup.php" class="signup-link">Create an account</a></li>
              <li><a href="login.php" class="login-link">Login</a></li>
            </div>
          </div>

          <div class="image-container">
            <img src="././assets/landing-page/hero-images.png" alt="hero-image" onerror="this.onerror=null; this.src='././assets/landing-page/homepage.jpg'; this.style.height='500px'; this.style.objectFit='cover'; this.style.objectPosition='bottom center'; this.style.borderRadius='0.5rem'" >
          </div>
        </div>
      </header>
      <?php endif; ?>
    </main>
    <?php include("footer.php"); ?>
  </body>
  <script src="././js/nav.js"></script>
</html>
