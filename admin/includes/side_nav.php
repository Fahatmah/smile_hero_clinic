<?php $current_page = basename($_SERVER['PHP_SELF']); ?>

<aside class="admin-sidenav">
  <ul>
    <!-- dashboard -->
    <li <?php echo ($current_page == 'dashboard.php') ? 'class="active__link"' : ''; ?>>
      <a href="../admin/dashboard.php">
        <img
          src="../assets/admin_assets/icons/dashboard/<?php echo ($current_page == 'dashboard.php') ? 'active/dashboard.svg' : 'default/dashboard.svg'; ?>"
          alt="" style="width: 1.375rem; height: 1.375rem" />Dashboard</a>
    </li>

    <!-- appointments -->
    <li <?php echo ($current_page == 'appointments.php') ? 'class="active__link"' : ''; ?>>
      <a href="../admin/appointments.php">
        <img
          src="../assets/admin_assets/icons/dashboard/<?php echo ($current_page == 'appointments.php') ? 'active/pending-appointment.svg' : 'default/pending-appointment.svg'; ?>"
          alt="" style="width: 1.375rem; height: 1.375rem" />Pending Appointment</a>
    </li>

    <!-- accepted appointments -->
    <li <?php echo ($current_page == 'booked.php') ? 'class="active__link"' : ''; ?>>
      <a href="../admin/booked.php">
        <img
          src="../assets/admin_assets/icons/dashboard/<?php echo ($current_page == 'booked.php') ? 'active/booked-appointments.svg' : 'default/booked-appointments.svg'; ?>"
          alt="" style="width: 1.375rem; height: 1.375rem" />Booked Meetings</a>
    </li>

    <!-- patients -->
    <li <?php echo ($current_page == 'patients.php') ? 'class="active__link"' : ''; ?>>
      <a href="../admin/patients.php">
        <img
          src="../assets/admin_assets/icons/dashboard/<?php echo ($current_page == 'patients.php') ? 'active/patients.svg' : 'default/patients.svg'; ?>"
          alt="" style="width: 1.375rem; height: 1.375rem" />Clients/Patients</a>
    </li>

    <!-- doctors -->
    <li <?php echo ($current_page == 'doctors.php') ? 'class="active__link"' : ''; ?>>
      <a href="../admin/doctors.php">
        <img
          src="../assets/admin_assets/icons/dashboard/<?php echo ($current_page == 'doctors.php') ? 'active/doctors.svg' : 'default/doctors.svg'; ?>"
          alt="" style="width: 1.375rem; height: 1.375rem" />Doctors</a>
    </li>

    <!-- feedback -->
    <li <?php echo ($current_page == 'feedback.php') ? 'class="active__link"' : ''; ?>>
      <a href="../admin/feedback.php">
        <img
          src="../assets/admin_assets/icons/dashboard/<?php echo ($current_page == 'feedback.php') ? 'active/feedback.svg' : 'default/feedback.svg'; ?>"
          alt="" style="width: 1.375rem; height: 1.375rem" />Feedback</a>
    </li>
  </ul>

  <!-- logout button -->
  <button id="logout_button">
    <a href="../includes/logout.php">Logout</a>
  </button>
</aside>