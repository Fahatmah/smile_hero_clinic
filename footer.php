<?php 
include_once "includes/dbh.inc.php";

$query = "SELECT * FROM footer";
$stmt =  $conn->prepare($query);
$stmt->execute();
$result = $stmt->get_result();
?>

<footer>
  <section class="form-section">
    <div class="container">
      <p class="footer-header">Ready for a new smile?</p>

      <ul class="form-links">
        <li>
          <a href="./signup.php" class="signup-link">Signup</a>
        </li>
        <li>
          <a href="./login.php" class="login-link">Login</a>
        </li>
      </ul>
    </div>
  </section>

  <?php if($dataFetch = $result->fetch_assoc()): ?>

  <section class="contact-section">
    <div class="container">
      <p class="footer-header">
        <?php echo $dataFetch['title_one']; ?>
      </p>

      <ul class="contact-list">
        <li><a href="tel:<?php echo $dataFetch['contact']; ?>"> <img src="././assets/landing-page/footer/call.svg" alt="call"><?php echo $dataFetch['contact']; ?></a></li>
        <li><a href="mailto:<?php echo $dataFetch['email']; ?>"> <img src="././assets/landing-page/footer/sms.svg" alt="sms"><?php echo $dataFetch['email']; ?></a></li>
        <li><a href="<?php echo $dataFetch['socmedlink']; ?>"> <img src="././assets/landing-page/footer/facebook.svg" alt="sms"><?php echo $dataFetch['socmedname']; ?></a></li>
        <li><a href="https://www.google.com/maps?q=Ground <?php echo $dataFetch['address']; ?>" target="_blank"> <img src="././assets/landing-page/footer/location.svg" alt="location"><?php echo $dataFetch['address']; ?></a></li>

        <li><a href="https://www.google.com/maps?q=Ground <?php echo $dataFetch['otherbranch_one_link']; ?>" target="_blank"> <img src="././assets/landing-page/footer/location.svg" alt="location">Other Branch - <?php echo $dataFetch['otherbranch_one']; ?></a></li>

        <li><a href="https://www.google.com/maps?q=Ground <?php echo $dataFetch['otherbranch_two_link']; ?>" target="_blank"> <img src="././assets/landing-page/footer/location.svg" alt="location">Other Branch - <?php echo $dataFetch['otherbranch_two']; ?></a></li>
      </ul>

      <div class="footer-info">
        <p class="footer-info__text">
        <?php echo $dataFetch['paragraph']; ?>
        </p>
        <p class="footer-info__credits">2024 - 2025 Capstone for SMILE HERO CLINIC</p>
      </div>
    </div>
  </section>

  <?php endif; ?>
</footer>