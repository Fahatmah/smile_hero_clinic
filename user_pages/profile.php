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
  <main>
    <!-- navigation header bar -->
    <?php include('includes/nav.php'); ?>

    <!-- navigation side nav -->
    <?php include('includes/sidenav.php'); ?>

    <!-- profile info -->
    <section class="profile__info account__container">
      <h1>Your account information</h1>
      <div class="info__header">
        <!-- details -->
        <div class="details__container">
          <img src="../assets/images/default_profile_image.png" alt="profile image" style="width: 90px; height: 90px" />
          <div class="user__details">
            <h2 class="user__name" id="headerUserName">Fahatmah Mabang</h2>
            <p class="user__address" id="headerUserAddress">
              Reyes, Purok 3, Bicutan, Taguig City
            </p>
          </div>
        </div>
        <!-- action button -->
        <button class="delete__button" id="deleteAccountBtn">
          Delete Account
        </button>
      </div>

      <!-- more details -->
      <div class="additional_details__container">
        <div class="item">
          <div class="details">
            <p class="detail__header">Name</p>
            <p class="full__name" id="fullName">Fahatmah Mabang</p>
          </div>
          <button class="edit__button">Edit</button>
        </div>
        <div class="item">
          <div class="details">
            <p class="detail__header">Contact Number</p>
            <p class="contact__number" id="contactNumber">09123456789</p>
          </div>
          <button class="edit__button">Edit</button>
        </div>
        <div class="item">
          <div class="details">
            <p class="detail__header">Address</p>
            <p class="address" id="address">
              Reyes, Purok 3, Bicutan, Taguig City
            </p>
          </div>
          <button class="edit__button">Edit</button>
        </div>
        <div class="item">
          <div class="details">
            <p class="detail__header">Email</p>
            <p class="email" id="email">fahatmahmabang@gmail.com</p>
          </div>
          <button class="edit__button">Edit</button>
        </div>
        <div class="item">
          <div class="details">
            <p class="detail__header">Password</p>
            <p class="password" id="password">********</p>
          </div>
          <button class="edit__button">Edit</button>
        </div>
      </div>
    </section>
  </main>
</body>

</html>