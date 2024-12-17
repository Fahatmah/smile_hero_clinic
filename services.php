<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="./assets/logos/logo-blue.png" type="image/x-icon">
  <title>Our Services | Smile Hero Clinic</title>
  <link rel="stylesheet" href="src/dist/styles.css" />
</head>
<body class="homepage">
  <main class="services-page">
    <?php include("nav.php"); ?>
    <header>
      <div class="container">
        <div class="texts-container">
          <div class="header-text">
          <p>Our Services</p>
          <h1>We offer a wide range of services, including:</h1>
          </div>

          <ul class="paragraph-text">
            <div class="list-column">
              <li>
                <img src="././assets/landing-page/tick-circle.svg" alt="tick-circle">
                <p>Routine dental check-ups and cleanings</p>
              </li>
              <li>
                <img src="././assets/landing-page/tick-circle.svg" alt="tick-circle">
                <p>Cosmetic dentistry, such as teeth whitening and veneers</p>
              </li>
              <li>
                <img src="././assets/landing-page/tick-circle.svg" alt="tick-circle">
                <p>Orthodontic treatments, including braces and Invisalign</p>
              </li>
            </div>
            <div class="list-column">
              <li>
                <img src="././assets/landing-page/tick-circle.svg" alt="tick-circle">
                <p>Restorative procedures like fillings, crowns, and bridges</p>
              </li>
              <li>
                <img src="././assets/landing-page/tick-circle.svg" alt="tick-circle">
                <p>Emergency dental services</p>
              </li>
            </div> 
          </ul>
        </div>

        <div class="image-container">
          <img src="././assets/landing-page/services-img.png" style="width: 800px" alt="services image" onerror="this.onerror=null; this.src='././assets/landing-page/services.jpg'; this.style.borderRadius='0.5rem'; this.style.width='800px'; this.style.height='600px'; this.style.objectFit='cover';">
        </div>
      </div>
    </header>
  </main>
  <?php include("footer.php"); ?>
</body>
<script src="./js/nav.js"></script>
</html>