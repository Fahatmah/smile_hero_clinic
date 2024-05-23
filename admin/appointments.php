<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="shortcut icon" href="../assets/images/logoipsum.svg" type="image/x-icon" />
  <title>Appointments | Admin</title>
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

    <section class="account__container admin-cards">
      <!-- appointments -->
      <div class="appointments__container appointments__page">
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
        </div>
      </div>
    </section>
  </main>
</body>

</html>