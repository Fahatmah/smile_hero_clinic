<?php
require_once '../../includes/config_session.inc.php';
require_once '../../includes/login_view.inc.php';
require_once '../../includes/dbh.inc.php';

if(isset($_SESSION['user_id']) && isset($_SESSION["email"])) {
  $user_id = $_SESSION['user_id'];
  $currentEmail = $_SESSION['email'];

  if($_SERVER["REQUEST_METHOD"] == "POST"){
    $fullname = $_POST['fullname'];
    $email = trim($_POST['email']);
    $contact = trim($_POST['contact']);
    $address = $_POST['address'];
    $password = trim($_POST['password']);

    require_once("../../includes/signup_model.inc.php");
    require_once("../../includes/signup_contr.inc.php");

    if (!isInputEmpty($fullname, $email, $contact, $address)) {
      $fullname = htmlspecialchars($fullname);
      $contact = htmlspecialchars($contact);
      $address = htmlspecialchars($address);
      $email = filter_var($email, FILTER_SANITIZE_EMAIL);

      if (isUpdatedEmailIsValid($conn, $email, $currentEmail)) {
        echo "<script> alert('Email is already in used') </script>";
        echo "<script>window.location.href='edit_profile.php';</script>";
        die();
      }

      if (!isEmailInvalid($email)) {
        $query = "UPDATE users SET fullname = ?, email = ?, contact = ?, address = ? WHERE user_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ssiss", $fullname, $email, $contact, $address, $user_id);
        $stmt->execute();

          if (!empty($password)) {
              $hashed_password = password_hash($password, PASSWORD_DEFAULT);
              $password_query = "UPDATE users SET pass = ? WHERE user_id = ?";
              $password_stmt = $conn->prepare($password_query);
              $password_stmt->bind_param("ss", $hashed_password, $user_id);
              $password_stmt->execute();
            }

          echo "<script>alert('Successfully Updated');</script>";
          echo "<script>window.location.href='../profile.php';</script>";
        }else{
          echo "<script>alert('Invalid email format!');</script>";
        }
    }else{
      echo "<script>alert('Please fill in all fields!');</script>";
    }
    }
    // Fetch user details from users table
    $user_query = "SELECT * FROM users WHERE user_id = ?";
    $stmt = $conn->prepare($user_query);
    $stmt->bind_param("s", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
  // Redirect user to login if not logged in
  header("Location: ../../login.php");
  exit();
}

$current_page = basename($_SERVER['PHP_SELF']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="shortcut icon" href="../assets/images/logoipsum.svg" type="image/x-icon">
  <title>Edit account | Smile Hero Clinic</title>
  
  <link rel="stylesheet" href="../../src/dist/styles.css" />
  <style>
  #loading-screen {
    position: fixed;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    background: rgba(0, 0, 0, 0.7);
    z-index: 1000;
    display: flex;
    justify-content: center;
    align-items: center;
    color: #fff;
    font-size: 1.5rem;
    flex-direction: column;
  }

  .spinner {
    border: 8px solid rgba(255, 255, 255, 0.3);
    border-top: 8px solid #fff;
    border-radius: 50%;
    width: 60px;
    height: 60px;
    animation: spin 1s linear infinite;
    margin-bottom: 20px;
  }

  @keyframes spin {
    0% {
      transform: rotate(0deg);
    }

    100% {
      transform: rotate(360deg);
    }
  }
  </style>

</head>

<body class="user__page">
  <main class="user__main">
    <div id="loading-screen" style="display: none;">
      <div class="spinner"></div>
      <p>Loading...</p>
    </div>

    <!-- navigation header bar -->
    <nav class="account__header user-header">
      <svg class="header__icon" width="44" height="44" viewBox="0 0 44 44" fill="none" xmlns="http://www.w3.org/2000/svg">
        <rect width="44" height="44" rx="22" fill="#1D72F2" />
        <g clip-path="url(#clip0_246_1826)">
          <path fill-rule="evenodd" clip-rule="evenodd" d="M16 10C19.3137 10 22 12.6863 22 16V10H28C31.3137 10 34 12.6863 34 16C34 19.3137 31.3137 22 28 22C31.3137 22 34 24.6863 34 28C34 29.6454 33.3377 31.1361 32.2651 32.22L32.2427 32.2427L32.2227 32.2625C31.1385 33.3366 29.6468 34 28 34C26.3645 34 24.8817 33.3456 23.7994 32.2843C23.7854 32.2705 23.7713 32.2566 23.7573 32.2427C23.7442 32.2295 23.7311 32.2163 23.7181 32.2031C22.6554 31.1205 22 29.6368 22 28C22 31.3137 19.3137 34 16 34C12.6863 34 10 31.3137 10 28V22H16C12.6863 22 10 19.3137 10 16C10 12.6863 12.6863 10 16 10ZM20.8 16C20.8 18.651 18.651 20.8 16 20.8V11.2C18.651 11.2 20.8 13.349 20.8 16ZM32.8 28C32.8 25.349 30.651 23.2 28 23.2C25.349 23.2 23.2 25.349 23.2 28H32.8ZM11.2 23.2V28C11.2 30.651 13.349 32.8 16 32.8C18.651 32.8 20.8 30.651 20.8 28V23.2H11.2ZM23.2 20.8V11.2H28C30.651 11.2 32.8 13.349 32.8 16C32.8 18.651 30.651 20.8 28 20.8H23.2Z" fill="white" />
        </g>
        <defs>
          <clipPath id="clip0_246_1826">
            <rect width="24" height="24" fill="white" transform="translate(10 10)" />
          </clipPath>
        </defs>
      </svg>

      <div class="header__content">
        <div class="header__date">
          Getting date and time...
        </div>
      </div>
    </nav>

    <section class="edit-profile">
      <!-- Header -->
      <form method="post" class="edit-profile__form">
        <div class="edit-profile__header">
          <h1 class="edit-profile__title">edit your profile details</h1>

          <div class="edit-profile__actions">
            <input type="submit" value="Save" class="edit-profile__save-btn" />
            <button class="edit-profile__cancel-btn" id="cancel-btn" type="button">
              <a href="../profile.php" class="edit-profile__cancel-link">Cancel</a>
            </button>
          </div>
        </div>
        <!-- End of Header -->

        <div class="edit-profile__details">
        <?php if($row = $result->fetch_assoc()) { ?>
          <div class="edit-profile__item">
            <p class="edit-profile__label">Name</p>
            <input type="text" name="fullname" value="<?php echo htmlspecialchars($row["fullname"]); ?>"
              class="edit-profile__input" id="fullName" style="width: 100%;">
          </div>
          <div class="edit-profile__item">
            <p class="edit-profile__label">Contact Number</p>
            <input type="text" name="contact" value="<?php echo htmlspecialchars($row["contact"]); ?>"
              class="edit-profile__input" id="contactNumber" style="width: 100%;">
          </div>
          <div class="edit-profile__item">
            <p class="edit-profile__label">Address</p>
            <input type="text" name="address" value="<?php echo htmlspecialchars($row["address"]); ?>"
              placeholder="no address" class="edit-profile__input" id="address" style="width: 100%;">
          </div>
          <div class="edit-profile__item">
            <p class="edit-profile__label">Email</p>
            <input type="text" name="email" value="<?php echo htmlspecialchars($row["email"]); ?>"
              class="edit-profile__input" id="email" style="width: 100%;">
          </div>
          <div class="edit-profile__item">
            <p class="edit-profile__label">Enter New Password</p>
            <input type="password" name="password" placeholder="********" class="edit-profile__input">
          </div>
        <?php } ?>
        </div>
      </form>
    </section>

  </main>
  <script>
    document.querySelector('form').addEventListener('submit', function(event) {
      event.preventDefault(); // Prevent the form from submitting immediately
      document.getElementById('loading-screen').style.display = 'flex';

      // Wait for 3 seconds
      setTimeout(function() {
        event.target.submit(); // Submit the form after 3 seconds
      }, 3000);
    });

    function getCurrentDateTime() {
      const date = new Date()
      const daysOfWeek = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"]
      const months = [
        "January", "February", "March", "April", "May", "June",
        "July", "August", "September", "October", "November", "December"
      ]

      // get current day, month, date and year
      const dayOfWeek = daysOfWeek[date.getDay()]
      const month = months[date.getMonth()]
      const day = date.getDate()
      const year = date.getFullYear()

      let hours = date.getHours()
      let minutes = date.getMinutes().toString().padStart(2, '0')

      const period = hours >= 12 ? 'PM':'AM'
      hours = hours % 12 || 12

      return document.querySelector('.header__date').innerText = `${dayOfWeek} ${hours}:${minutes} ${period} | ${month} ${day}, ${year}`
    }

    setInterval(getCurrentDateTime, 1000)
  </script>

</body>
</html>

<!-- 
<section class="edit_profile profile__info account__container">
      <?php if($row= $result->fetch_assoc() ) { ?>
      <div class="account">
        <h1>Edit your account information</h1>
        <div class="info__header">
          <div class="details__container">
            <img src="../../assets/images/default_profile_image.png" alt="profile image"
              style="width: 90px; height: 90px" />
            <div class="user__details">
              <h2 class="user__name" id="headerUserName">
                <?php echo htmlspecialchars($row["fullname"]); ?> </h2>
              <p class="user__address" id="headerUserAddress">
                <?php if(strlen($row["address"])===0) { ?>
                No Address
                <?php }else {
                  echo $row["address"];
                } ?>
              </p>
            </div>
          </div>
          <form action="" method="post">
            <div class="button_container">
              <input type="submit" value="Save" class="button edit" id="editAccountBtn">
              <a href="../profile.php" style="text-align: center;" class="button delete" id="deleteAccountBtn">
                Cancel
              </a>
            </div>
        </div>

        <div class="additional_details__container">
          <div class="item">
            <div class="details">
              <p class="detail__header">Name</p>
              <input type="text" name="fullname" value="<?php echo htmlspecialchars($row["fullname"]); ?>"
                class="full__name detail_content" id="fullName" style="width: 100%;">
            </div>
          </div>
          <div class="item">
            <div class="details">
              <p class="detail__header">Contact Number</p>
              <input type="text" name="contact" value="<?php echo htmlspecialchars($row["contact"]); ?>"
                class="contact__number detail_content" id="contactNumber" style="width: 100%;">
            </div>
          </div>
          <div class="item">
            <div class="details">
              <p class="detail__header">Address</p>
              <input type="text" name="address" value="<?php echo htmlspecialchars($row["address"]); ?>"
                placeholder="no address" name="address" class="address detail_content" id="address"
                style="width: 100%;">
            </div>
          </div>
          <div class="item">
            <div class="details">
              <p class="detail__header">Email</p>
              <input type="text" name="email" value="<?php echo htmlspecialchars($row["email"]); ?>"
                class="email detail_content" id="email" style="width: 100%;">
            </div>
          </div>
          <div class="item">
            <div class="details">
              <p class="detail__header">Enter New Password</p>
              <input type="password" name="password" placeholder="********">
            </div>
          </div>
        </div>
      </div>
      </form>
      <?php } ?>
    </section>
-->