<?php
require_once '../includes/config_session.inc.php';
require_once '../includes/login_view.inc.php';
require_once '../includes/dbh.inc.php';

if(!isset($_SESSION['user_id'])) {
   // Redirect user to login if not logged in
   header("Location: ../login.php");
   exit();
} 
$user_id = $_SESSION['user_id'];

// Fetch user details from users table
$user_query = "SELECT * FROM users WHERE user_id = ?";
$stmt = $conn->prepare($user_query);
$stmt->bind_param("s", $user_id);
$stmt->execute();
$result = $stmt->get_result();

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="shortcut icon" href="../assets/images/logoipsum.svg" type="image/x-icon">
  <title>Account | Smile Hero Clinic</title>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&display=swap"
    rel="stylesheet" />
  <link rel="stylesheet" href="../src/dist/styles.css" />
</head>

<body>
  <main>
    <!-- navigation header bar -->
    <?php include('includes/nav.php'); ?>

    <!-- navigation side nav -->
    <?php include('includes/sidenav.php'); ?>

    <!-- profile info -->
    <section class="profile__info account__container">
      <?php if($row= $result->fetch_assoc() ) { ?>
      <div class="account">
        <h1>Your account information</h1>
        <div class="info__header">
          <!-- details -->
          <div class="details__container">
            <img src="../assets/images/default_profile_image.png" alt="profile image"
              style="width: 90px; height: 90px" />
            <div class="user__details">
              <h2 class="user__name" id="headerUserName">
                <?php echo $row["fullname"]; ?> </h2>
              <p class="user__address" id="headerUserAddress">
                <?php if(strlen($row["address"])===0) { ?>
                No Address
                <?php }else {
                  echo $row["address"];
                } ?>
              </p>
            </div>
          </div>
          <!-- action buttons -->
          <div class="button_container">
            <a href="includes/edit_profile.php" style="text-align: center;" class="button edit" id="editAccountBtn">
              Edit Account
            </a>
            <button class="button delete" id="deleteAccountBtn">
              Delete Account
            </button>
          </div>
        </div>

        <div class="modal_container delete-account">
          <div class="delete-account">
            <div class="header">
              <h3>Are you sure you want to permanently delete your account?</h3>
              <p>*This action cannot be undone and all your data will be lost.*
              </p>
            </div>
            <div class="button_container">
              <button type="submit" id="deleteAccountButton">
                <a href="includes/delete_acc.php" style="color: white;">
                  Yes, delete my account
                </a>
              </button>
              <button id="exitButton">No, keep my account</button>
            </div>
          </div>
        </div>

        <!-- more details -->
        <div class="additional_details__container">
          <div class="item">
            <div class="details">
              <p class="detail__header">Name</p>
              <p class="full__name detail_content" id="fullName"><?php echo $row["fullname"]; ?></p>
            </div>
          </div>
          <div class="item">
            <div class="details">
              <p class="detail__header">Contact Number</p>
              <p class="contact__number detail_content" id="contactNumber">
                <?php echo $row["contact"]; ?></p>
            </div>
          </div>
          <div class="item">
            <div class="details">
              <p class="detail__header">Address</p>
              <p class="address detail_content" id="address">
                <?php if(strlen($row["address"])===0) { ?>
                No Address
                <?php }else {
                  echo $row["address"];
                } ?>
              </p>
            </div>
          </div>
          <div class="item">
            <div class="details">
              <p class="detail__header">Email</p>
              <p class="email detail_content" id="email"><?php echo $row["email"]; ?></p>
            </div>
          </div>
          <div class="item">
            <div class="details">
              <p class="detail__header">Password</p>
              <p class="password detail_content" id="password">********</p>
            </div>
          </div>
        </div>
      </div>
      <?php } ?>
    </section>
  </main>
</body>
<script>
const openModalBtn = document.getElementById("deleteAccountBtn");
const modalContainer = document.querySelector(".modal_container.delete-account");
const exitBtn = document.getElementById("exitButton");
const deleteAccountBtn = document.getElementById("deleteAccountButton");

openModalBtn.addEventListener("click", () => {
  modalContainer.style.transform = "scale(1)";
})

exitBtn.addEventListener("click", () => {
  modalContainer.style.transform = "scale(0)";
})

// AJAX request to delete user when confirmation is clicked
deleteAccountBtn.addEventListener("click", () => {
  console.log("Delete Account Button Clicked!");
});
</script>

</html>