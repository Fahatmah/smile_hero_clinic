<?php $current_page = basename($_SERVER['PHP_SELF']); ?>

<aside class="aside__sidebar admin-sidenav">
  <ul>
    <!-- dashboard -->
    <li <?php echo ($current_page == 'dashboard.php') ? 'class="active__link"' : ''; ?>>
      <a href="../admin/dashboard.php">
        <img
          src="../assets/admin_images/<?php echo ($current_page == 'dashboard.php') ? 'dashboard_active.png' : 'dashboard.svg'; ?>"
          alt="" style="width: 1.375rem; height: 1.375rem" />Overview</a>
    </li>

    <!-- appointments -->
    <li <?php echo ($current_page == 'appointments.php') ? 'class="active__link"' : ''; ?>>
      <a href="../admin/appointments.php">
        <img
          src="../assets/admin_images/<?php echo ($current_page == 'appointments.php') ? 'appointments_active.png' : 'appointments.svg'; ?>"
          alt="" style="width: 1.375rem; height: 1.375rem" />Pending Requests</a>
    </li>

    <!-- accepted appointments -->
    <li <?php echo ($current_page == 'booked.php') ? 'class="active__link"' : ''; ?>>
      <a href="../admin/booked.php">
        <img
          src="../assets/admin_images/<?php echo ($current_page == 'booked.php') ? 'reports_active.png' : 'reports.svg'; ?>"
          alt="" style="width: 1.375rem; height: 1.375rem" />Booked Meetings</a>
    </li>

    <!-- patients -->
    <li <?php echo ($current_page == 'patients.php') ? 'class="active__link"' : ''; ?>>
      <a href="../admin/patients.php">
        <img
          src="../assets/admin_images/<?php echo ($current_page == 'patients.php') ? 'patients_active.png' : 'patients.svg'; ?>"
          alt="" style="width: 1.375rem; height: 1.375rem" />Clients/Patients</a>
    </li>

    <!-- reviews -->
    <li <?php echo ($current_page == 'feedback.php') ? 'class="active__link"' : ''; ?>>
      <a href="../admin/feedback.php">
        <img
          src="../assets/admin_images/<?php echo ($current_page == 'feedback.php') ? 'feedback_active.svg' : 'feedback.svg'; ?>"
          alt="" style="width: 1.375rem; height: 1.375rem" />Reviews</a>
    </li>

    <!-- doctors -->
    <li <?php echo ($current_page == 'doctors.php') ? 'class="active__link"' : ''; ?>>
      <a href="../admin/doctors.php">
        <img
          src="../assets/admin_images/doctors/<?php echo ($current_page == 'doctors.php') ? 'doctors-blue.png' : 'doctors-black.png'; ?>"
          alt="" style="width: 1.375rem; height: 1.375rem" />Doctors</a>
    </li>

    <!-- logout button -->
    <li id="logout_button">
      <a href="../includes/logout.php" class="logout__button">Logout</a>
    </li>
  </ul>
</aside>