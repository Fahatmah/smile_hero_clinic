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
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&display=swap"
    rel="stylesheet" />
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

<body>
  <main>

    <div id="loading-screen" style="display: none;">
      <div class="spinner"></div>
      <p>Loading...</p>
    </div>


    <!-- navigation header bar -->
    <nav class="account__header">
      <img src="../../assets/images/logoipsum.svg" alt="logo" class="logo" />
      <div class="account__profile_image">
        <!-- profile image -->
        <img src="../../assets/images/default_profile_image.png" alt="account image" />
      </div>
    </nav>

    <!-- profile info -->
    <section class="edit_profile profile__info account__container">
      <?php if($row= $result->fetch_assoc() ) { ?>
      <div class="account">
        <h1>Edit your account information</h1>
        <div class="info__header">
          <!-- details -->
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
            <!-- action buttons -->
            <div class="button_container">
              <input type="submit" value="Save" class="button edit" id="editAccountBtn">
              <a href="profile.php" style="text-align: center;" class="button delete" id="deleteAccountBtn">
                Cancel
              </a>
            </div>
        </div>

        <!-- more details -->
        <div class="additional_details__container">
          <div class="item">
            <div class="details">
              <p class="detail__header">Name</p>
              <input type="text" name="fullname" value="<?php echo htmlspecialchars($row["fullname"]); ?>"
                class="full__name detail_content" id="fullName">
            </div>
          </div>
          <div class="item">
            <div class="details">
              <p class="detail__header">Contact Number</p>
              <input type="text" name="contact" value="<?php echo htmlspecialchars($row["contact"]); ?>"
                class="contact__number detail_content" id="contactNumber">
            </div>
          </div>
          <div class="item">
            <div class="details">
              <p class="detail__header">Address</p>
              <input type="text" name="address" value="<?php echo htmlspecialchars($row["address"]); ?>"
                placeholder="no address" name="address" class="address detail_content" id="address">
            </div>
          </div>
          <div class="item">
            <div class="details">
              <p class="detail__header">Email</p>
              <input type="text" name="email" value="<?php echo htmlspecialchars($row["email"]); ?>"
                class="email detail_content" id="email">
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
  </script>

</body>

</html>