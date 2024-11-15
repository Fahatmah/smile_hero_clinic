<?php
require_once '../includes/config_session.inc.php';
require_once '../includes/dbh.inc.php';


$userid = $_SESSION['user_id'];
$status = "accepted";

// Prepare and execute query to check appointments
$qry = "SELECT * FROM appointments WHERE user_id = ?";
$stmts = $conn->prepare($qry);

if ($stmts) {  // Check if prepare was successful
    $stmts->bind_param("s", $userid);
    $stmts->execute();
    $qryRes = $stmts->get_result();
    $hasAppointments = ($qryRes->num_rows > 0);
    $qryRes->free();  // Free the result set
    $stmts->close();  // Close the prepared statement
} else {
    $hasAppointments = false; // Fallback if query fails
}

// Function to resolve the correct path
// function require_with_fallback($relativePath1, $relativePath2) {
//   $currentDir = __DIR__;
//   $path1 = realpath($currentDir . '/' . $relativePath1);
//   $path2 = realpath($currentDir . '/' . $relativePath2);
  
//   if ($path1 && file_exists($path1)) {
//     require_once $path1;
//   } elseif ($path2 && file_exists($path2)) {
//     require_once $path2;
//     } else {
//       die('Required file not found: ' . $relativePath1 . ' or ' . $relativePath2);
//     }
//   }
  
//   // Include the config session file
//   require_with_fallback('../includes/config_session.inc.php', '../../includes/config_session.inc.php');
  
//   // Include the login view file
//   require_with_fallback('../includes/login_view.inc.php', '../../includes/login_view.inc.php');
  
  // Get the current page filename
  $current_page = basename($_SERVER['PHP_SELF']);
?>

<aside class="aside__sidebar">
  <ul>
    <li <?php echo ($current_page == 'profile.php') ? 'class="active__link"' : ''; ?>>
      <a href="../user_pages/profile.php">
        <img
          src="../assets/icons/user_account/<?php echo ($current_page == 'profile.php') ? 'profile-icon-active.png' : 'profile.png'; ?>"
          alt="" style="width: 1.375rem; height: 1.375rem" />Profile</a>
    </li>
    <li
      <?php echo ($current_page == 'appointment_page.php' || $current_page == 'appointment_form_page.php') ? 'class="active__link"' : ''; ?>>
      <a href="../user_pages/appointment_page.php">
        <img
          src="../assets/icons/user_account/<?php echo ($current_page == 'appointment_page.php' || $current_page == 'appointment_form_page.php') ? 'appointments-icon-active.png' : 'appointments.png'; ?>"
          alt="" style="width: 1.375rem; height: 1.375rem" />Appointments</a>
    </li>
    <li <?php echo ($current_page == 'dental_history.php') ? 'class="active__link"' : ''; ?>>
      <a href="../user_pages/dental_history.php">
        <img
          src="../assets/icons/user_account/<?php echo ($current_page == 'dental_history.php') ? 'dental-icon-active.png' : 'dental-history.png'; ?>"
          alt="" style="width: 1.375rem; height: 1.375rem" />Dental
        History</a>
    </li>
    <li <?php echo ($current_page == 'faqs_questions.php') ? 'class="active__link"' : ''; ?>>
      <a href="../user_pages/faqs_questions.php">
        <img
          src="../assets/icons/user_account/<?php echo ($current_page == 'faqs_questions.php') ? 'faqs-and-questions-icon-active.png' : 'faqs-and-questions.png'; ?>"
          alt="" style="width: 1.375rem; height: 1.375rem" />FAQs &
        Questions</a>
    </li>

    <li <?php echo ($current_page == 'feedback.php') ? 'class="active__link"' : ''; ?> style="display: <?php echo ($hasAppointments ? 'block' : 'none'); ?>;">
        <a href="../user_pages/feedback.php">
            <img src="../assets/icons/user_account/<?php echo ($current_page == 'feedback.php') ? 'feedback-icon-active.png' : 'feedback.png'; ?>" 
              alt="" style="width: 1.375rem; height: 1.375rem" />Feedback
        </a>
    </li>

  </ul>
  <button id="logout_button" <?php echo ($current_page == '../includes/logout.php') ? 'class="active__link"' : ''; ?>><a
        href="../includes/logout.php" class="logout__button">Logout</a></button>
</aside>