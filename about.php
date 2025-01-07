<?php 
include_once "includes/dbh.inc.php";

$query = "SELECT * FROM about_info";
$stmt = $conn->prepare($query);
$stmt->execute();

$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="./assets/logos/logo-blue.png" type="image/x-icon">
  <title>About Us | Smile Hero Clinic</title>
  <link rel="stylesheet" href="src/dist/styles.css" />
</head>
<body class="homepage">
  <main class="about-page">
    <?php include("nav.php"); ?>
    
    <?php if($dataFetch = $result->fetch_assoc()) : ?>
    <header>
      <div class="texts-container">
        <div class="header-text">
          <p>About Us</p>
          <h1>your trusted partner for comprehensive dental care</h1>
        </div>

        <div class="contents">
          <div class="paragraph-text">
            <div class="group">
              <img src="././assets/landing-page/about/location.svg" alt="location icon">
              <div class="texts">
                <p class="header-text">Our Location</p>
                <p>Located on <?php echo $dataFetch['address'] ?>, near Heritage, our clinic is dedicated to providing top-notch dental services to ensure your smile remains healthy and beautiful.</p>
              </div>
            </div>

            <div class="group">
              <img src="././assets/landing-page/about/hmo-philhealth.svg" alt="HMO and PhilHealth icon">
              <div class="texts">
                <p class="header-text">HMO & PhilHealth Accredited</p>
                <p><?php echo $dataFetch['clinicname'] ?> is proud to be HMO Accredited and a recognized partner of PhilHealth. We ensure our services are accessible and affordable, helping you make the most of your healthcare benefits.</p>
              </div>
            </div>

            <div class="group">
              <img src="././assets/landing-page/about/accessibility.svg" alt="accessibility icon">
              <div class="texts">
                <p class="header-text">Convenience & Accessibility</p>
                <p>At <?php echo $dataFetch['clinicname'] ?>, we understand the importance of convenience and accessibility when it comes to your dental health.</p>
              </div>
            </div>

            <div class="group">
              <img src="././assets/landing-page/about/schedule-anytime.svg" alt="schedule icon">
              <div class="texts">
                <p class="header-text">Schedule Anytime, Anywhere</p>
                <p>Whether you're at home, at work, or on the go, you can schedule your appointments with just a few clicks.</p>
              </div>
            </div>
          </div>
          <div class="image-container">
            <img src="./<?php echo $dataFetch['image_path'] ?>" alt="about image" onerror="this.onerror=null; this.src='././assets/landing-page/about.jpg'; this.style.borderRadius='0.5rem'">
          </div>
        </div>
      </div>
    </header>
    <?php endif; ?>
  </main>
  <?php include("footer.php"); ?>
</body>
<script src="./js/nav.js"></script>
</html>