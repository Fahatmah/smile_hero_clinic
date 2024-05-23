<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="shortcut icon" href="../assets/images/logoipsum.svg" type="image/x-icon" />
  <title>Dashboard | Admin</title>
  <link rel="stylesheet" href="../src/dist/styles.css" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&display=swap"
    rel="stylesheet" />
</head>

<body>
  <main>
    <!-- nav header -->
    <?php include("includes/nav.php"); ?>

    <!-- side bar -->
    <?php include("includes/side_nav.php"); ?>


    <!-- dashboard container -->
    <section class="account__container admin-cards">
      <!-- cards overview -->
      <div class="cards__container">
        <div class="card patients">
          <h1>20</h1>
          <p>New Patients</p>
          <img src="../assets/admin_images/new_patients.svg" class="card_image" alt="" />
        </div>
        <div class="card doctors">
          <h2>5</h2>
          <p>Today's Doctors</p>
          <img src="../assets/admin_images/doctors.svg" class="card_image" alt="" />
        </div>
        <div class="card appointments">
          <h3>10</h3>
          <p>Today's Appointment</p>
          <img src="../assets/admin_images/todays_appointments.svg" class="card_image" alt="" />
        </div>
      </div>

      <!-- appointments -->
      <div class="appointments__container">
        <!-- appointment items -->
        <div class="appointments">
          <div class="top_header">
            <h4>Appointments</h4>
            <form class="search__bar">
              <input type="text" name="appointment" id="appointment" placeholder="Search..." />
              <button type="submit">
                <img src="../assets/admin_images/search.svg" alt="search icon" />
              </button>
            </form>
          </div>

          <!-- appointments table -->
          <table>
            <!-- head -->
            <thead>
              <tr>
                <th class="patient_img">IMG</th>
                <th class="patient_name">PATIENT NAME</th>
                <th class="patient_time">TIME</th>
                <!-- <th class="patient_doctor">DOCTOR</th> -->
                <th class="actions">ACTIONS</th>
              </tr>
            </thead>

            <!-- body -->
            <tbody>
              <!-- get only 3 appointments to show -->
              <tr>
                <td>
                  <img src="../assets/admin_images/default_image.svg" class="img"
                    style="border-radius: 4rem; width: 2rem; height: 2rem" />
                </td>
                <td>Juan Dela Cruz</td>
                <td>10 AM</td>
                <!-- <td>Dr. Morice Vergara</td> -->
                <td>
                  <div class="action_button__container">
                    <button class="button accept">Accept</button>
                    <button class="button cancel">Cancel</button>
                  </div>
                </td>
              </tr>

              <tr>
                <td>
                  <img src="../assets/admin_images/default_image.svg" class="img"
                    style="border-radius: 4rem; width: 2rem; height: 2rem" />
                </td>
                <td>Anna Muntinlupa</td>
                <td>2 PM</td>
                <!-- <td>Dr. Andrew Gardo</td> -->
                <td>
                  <div class="action_button__container">
                    <button class="button accept">Accept</button>
                    <button class="button cancel">Cancel</button>
                  </div>
                </td>
              </tr>

              <tr>
                <td>
                  <img src="../assets/admin_images/default_image.svg" class="img"
                    style="border-radius: 4rem; width: 2rem; height: 2rem" />
                </td>
                <td>Jose Tamasyo</td>
                <td>8 AM</td>
                <!-- <td>Dr. Liam Monte</td> -->
                <td>
                  <div class="action_button__container">
                    <button class="button accept">Accept</button>
                    <button class="button cancel">Cancel</button>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>

          <!-- see all button -->
          <a href="../admin/appointments.php" class="see_all__button">See all</a>
        </div>

        <!-- doctors today -->
        <div class="doctors__container">
          <h5>Doctors</h5>
          <ul>
            <li>
              <img src="../assets/admin_images/doctors/d1.jpg" alt="" />
              <p>Dr. Michael Smith</p>
            </li>
            <li>
              <img src="../assets/admin_images/doctors/d2.jpg" alt="" />
              <p>Dr. Emily Johnson</p>
            </li>
            <li>
              <img src="../assets/admin_images/doctors/d3.jpg" alt="" />
              <p>Dr. David Brown</p>
            </li>
            <li>
              <img src="../assets/admin_images/doctors/d4.jpg" alt="" />
              <p>Dr. Sarah Davis</p>
            </li>
            <li>
              <img src="../assets/admin_images/doctors/d5.jpg" alt="" />
              <p>Dr. James Wilson</p>
            </li>
          </ul>
        </div>
      </div>

      <!-- patients -->
      <div class="patients__container">
        <div class="patients">
          <div class="top_header">
            <h6>Patients</h6>
            <form class="search__bar">
              <input type="text" name="patient" id="patient" placeholder="Search..." />
              <button type="submit">
                <img src="../assets/admin_images/search.svg" alt="search icon" />
              </button>
            </form>
          </div>

          <!-- appointments table -->
          <table>
            <!-- head -->
            <thead>
              <tr>
                <th class="patient_img">IMG</th>
                <th class="patient_name">PATIENT NAME</th>
                <th class="patient_time">TIME</th>
                <th class="patient_location">LOCATION</th>
                <th class="actions">ACTIONS</th>
              </tr>
            </thead>

            <!-- body -->
            <tbody>
              <!-- get only 3 patients to show -->
              <tr>
                <td>
                  <img src="../assets/admin_images/default_image.svg" class="img"
                    style="border-radius: 4rem; width: 2rem; height: 2rem" />
                </td>
                <td>Juan Dela Cruz</td>
                <td>10 AM</td>
                <td>123 Street, Example City</td>
                <td class="action_button__container">
                  <button class="button edit">
                    <img src="../assets/admin_images/edit.svg" alt="edit icon" />
                  </button>
                  <button class="button delete">
                    <img src="../assets/admin_images/trash.svg" alt="trash icon" />
                  </button>
                </td>
              </tr>

              <tr>
                <td>
                  <img src="../assets/admin_images/default_image.svg" class="img"
                    style="border-radius: 4rem; width: 2rem; height: 2rem" />
                </td>
                <td>Juan Dela Cruz</td>
                <td>10 AM</td>
                <td>123 Street, Example City</td>
                <td class="action_button__container">
                  <button class="button edit">
                    <img src="../assets/admin_images/edit.svg" alt="edit icon" />
                  </button>
                  <button class="button delete">
                    <img src="../assets/admin_images/trash.svg" alt="trash icon" />
                  </button>
                </td>
              </tr>

              <tr>
                <td>
                  <img src="../assets/admin_images/default_image.svg" class="img"
                    style="border-radius: 4rem; width: 2rem; height: 2rem" />
                </td>
                <td>Juan Dela Cruz</td>
                <td>10 AM</td>
                <td>123 Street, Example City</td>
                <td class="action_button__container">
                  <button class="button edit">
                    <img src="../assets/admin_images/edit.svg" alt="edit icon" />
                  </button>
                  <button class="button delete">
                    <img src="../assets/admin_images/trash.svg" alt="trash icon" />
                  </button>
                </td>
              </tr>
            </tbody>
          </table>

          <!-- see all button -->
          <a href="../admin/patients.php" class="see_all__button">See all</a>
        </div>
      </div>
    </section>
  </main>
</body>

</html>