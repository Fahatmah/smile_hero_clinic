<?php
require_once '../includes/config_session.inc.php';
require_once '../includes/login_view.inc.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Account | Smile Hero Clinic</title>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&display=swap"
    rel="stylesheet" />
  <link rel="stylesheet" href="../src/dist/styles.css" />
</head>

<body>
<?php outputUserId(); ?>
  <main>
    <!-- navigation header bar -->
    <?php include('includes/nav.php'); ?>

    <!-- navigation side nav -->
    <?php include('includes/sidenav.php'); ?>

    <!-- profile info -->
    <section class="profile__info account__container">
      <div class="account">
        <h1>Your account information</h1>
        <div class="info__header">
          <!-- details -->
          <div class="details__container">
            <img src="../assets/images/default_profile_image.png" alt="profile image"
              style="width: 90px; height: 90px" />
            <div class="user__details">
              <h2 class="user__name" id="headerUserName">Fahatmah Mabang</h2>
              <p class="user__address" id="headerUserAddress">
                Reyes, Purok 3, Bicutan, Taguig City
              </p>
            </div>
          </div>
          <!-- action buttons -->
          <div class="button_container">
            <button class="button edit" id="editAccountBtn">
              Edit Account
            </button>
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
              <button type="submit" id="deleteAccountButton">Yes, delete my account</button>
              <button id="exitButton">No, keep my account</button>
            </div>
          </div>
        </div>

        <!-- more details -->
        <div class="additional_details__container">
          <div class="item">
            <div class="details">
              <p class="detail__header">Name</p>
              <p class="full__name detail_content" id="fullName">Fahatmah Mabang</p>
            </div>
            <!-- <button class="edit__button">Edit</button> -->
          </div>
          <div class="item">
            <div class="details">
              <p class="detail__header">Contact Number</p>
              <p class="contact__number detail_content" id="contactNumber">09123456789</p>
            </div>
            <!-- <button class="edit__button">Edit</button> -->
          </div>
          <div class="item">
            <div class="details">
              <p class="detail__header">Address</p>
              <p class="address detail_content" id="address">
                Reyes, Purok 3, Bicutan, Taguig City
              </p>
            </div>
            <!-- <button class="edit__button">Edit</button> -->
          </div>
          <div class="item">
            <div class="details">
              <p class="detail__header">Email</p>
              <p class="email detail_content" id="email">fahatmahmabang@gmail.com</p>
            </div>
            <!-- <button class="edit__button">Edit</button> -->
          </div>
          <div class="item">
            <div class="details">
              <p class="detail__header">Password</p>
              <p class="password detail_content" id="password">********</p>
            </div>
            <!-- <button class="edit__button">Edit</button> -->
          </div>
        </div>
      </div>
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