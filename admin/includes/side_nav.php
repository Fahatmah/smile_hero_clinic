<?php $current_page = basename($_SERVER['PHP_SELF']); ?>

<nav class="side__nav admin-sidenav">
  <ul>
    <!-- dashboard -->
    <li <?php echo ($current_page == 'dashboard.php') ? 'class="active__link"' : ''; ?>>
      <a href="../admin/dashboard.php">
        <img
          src="../assets/admin_images/<?php echo ($current_page == 'dashboard.php') ? 'dashboard_active.png' : 'dashboard.svg'; ?>"
          alt="" style="width: 1.375rem; height: 1.375rem" />Dashboard</a>
    </li>

    <!-- appointments -->
    <li <?php echo ($current_page == 'appointments.php') ? 'class="active__link"' : ''; ?>>
      <a href="../admin/appointments.php">
        <img
          src="../assets/admin_images/<?php echo ($current_page == 'appointments.php') ? 'appointments_active.png' : 'appointments.svg'; ?>"
          alt="" style="width: 1.375rem; height: 1.375rem" />Appointments</a>
    </li>

    <!-- patients -->
    <li <?php echo ($current_page == 'patients.php') ? 'class="active__link"' : ''; ?>>
      <a href="../admin/patients.php">
        <img
          src="../assets/admin_images/<?php echo ($current_page == 'patients.php') ? 'patients_active.png' : 'patients.svg'; ?>"
          alt="" style="width: 1.375rem; height: 1.375rem" />Patients</a>
    </li>

    <!-- reports -->
    <li <?php echo ($current_page == 'reports.php') ? 'class="active__link"' : ''; ?>>
      <a href="../admin/reports.php">
        <img
          src="../assets/admin_images/<?php echo ($current_page == 'reports.php') ? 'reports_active.png' : 'reports.svg'; ?>"
          alt="" style="width: 1.375rem; height: 1.375rem" />Reports</a>
    </li>

    <!-- logout button -->
    <li id="logout_button">
      <a href="../includes/logout.php" class="logout__button">Logout</a>
    </li>
  </ul>
</nav>