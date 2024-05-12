<?php
// Get the current page filename
$current_page = basename($_SERVER['PHP_SELF']);
?>

<nav class="side__nav">
  <ul>
    <li <?php echo ($current_page == 'profile.php') ? 'class="active__link"' : ''; ?>>
      <a href="../user_pages/profile.php">
        <img
          src="../assets/icons/user_account/<?php echo ($current_page == 'profile.php') ? 'profile_active.png' : 'profile.png'; ?>"
          alt="" style="width: 1.375rem; height: 1.375rem" />Profile</a>
    </li>
    <!-- <li <?php echo ($current_page == 'dark_theme.php') ? 'class="active__link"' : ''; ?>>
      <button class="theme__button">
        <img
          src="../assets/icons/user_account/<?php echo ($current_page == 'dark_theme.php') ? 'moon_active.png' : 'moon.png'; ?>"
          alt="" style="width: 1.375rem; height: 1.375rem" />Dark Theme</button>
    </li> -->
    <li
      <?php echo ($current_page == 'appointment_page.php' || $current_page == 'appointment_form_page.php') ? 'class="active__link"' : ''; ?>>
      <a href="../user_pages/appointment_page.php">
        <img
          src="../assets/icons/user_account/<?php echo ($current_page == 'appointment_page.php' || $current_page == 'appointment_form_page.php') ? 'appointments_active.png' : 'appointments.png'; ?>"
          alt="" style="width: 1.375rem; height: 1.375rem" />Appointments</a>
    </li>
    <li <?php echo ($current_page == 'dental_history.php') ? 'class="active__link"' : ''; ?>>
      <a href="../user_pages/dental_history.php">
        <img
          src="../assets/icons/user_account/<?php echo ($current_page == 'dental_history.php') ? 'medical_history_active.png' : 'medical_history.png'; ?>"
          alt="" style="width: 1.375rem; height: 1.375rem" />Dental
        History</a>
    </li>
    <li <?php echo ($current_page == 'faqs_questions.php') ? 'class="active__link"' : ''; ?>>
      <a href="../user_pages/faqs_questions.php">
        <img
          src="../assets/icons/user_account/<?php echo ($current_page == 'faqs_questions.php') ? 'faqs_questions_active.png' : 'faqs_questions.png'; ?>"
          alt="" style="width: 1.375rem; height: 1.375rem" />FAQs &
        Questions</a>
    </li>
    <li <?php echo ($current_page == 'feedback.php') ? 'class="active__link"' : ''; ?>>
      <a href="../user_pages/feedback.php">
        <img
          src="../assets/icons/user_account/<?php echo ($current_page == 'feedback.php') ? 'feedback_active.png' : 'feedback.png'; ?>"
          alt="" style="width: 1.375rem; height: 1.375rem" />Feedback</a>
    </li>
    <li id="logout_button" <?php echo ($current_page == 'index.php') ? 'class="active__link"' : ''; ?>><a
        href="../index.php" class="logout__button">Logout</a></li>
  </ul>
</nav>