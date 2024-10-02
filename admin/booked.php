<?php
require_once '../includes/config_session.inc.php';
require_once '../includes/login_view.inc.php';
require_once '../includes/dbh.inc.php';
require_once './includes/pagination.php';

if (!isset($_SESSION['adminEmail'])) {
  // Redirect user to login if not logged in
  header("Location: ../login.php?login=failed");
  exit();
}

// Pagination setup
$limit = 5; // Number of entries to show per page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Current page number
$start = ($page - 1) * $limit; // Calculate the starting row for the query

// Get total number of records for booked meetings
$totalQuery = "SELECT COUNT(*) AS total FROM appointments WHERE status = 'accepted' OR status = 'rescheduled'";
$totalResult = $conn->query($totalQuery);
$totalRow = $totalResult->fetch_assoc();
$totalRecords = $totalRow['total'];

// Fetch records for the current page
$query = "SELECT * FROM appointments WHERE status = 'accepted' OR status = 'rescheduled' LIMIT $start, $limit";
$result = $conn->query($query);
$users = [];
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $users[] = $row;
  }
}

// Calculate total pages needed
$totalPages = ceil($totalRecords / $limit);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="shortcut icon" href="../assets/images/logoipsum.svg" type="image/x-icon" />
  <title>Reports | Admin</title>
  <link rel="stylesheet" href="../src/dist/styles.css" />
  
</head>

<body class="admin__page">
  <main class="admin__main">
    <!-- nav header -->
    <?php include("includes/nav.php"); ?>

     <section class="admin__content">
      <!-- side bar -->
      <?php include("includes/side_nav.php"); ?>
       
      <!-- booked appointments -->
      <div class="booked__container">
        <div class="booked-appointments__table">
          <h1 class="table-heading">booked appointments <span class="table-item-count">13</span></h1>

          <table>
            <thead>
              <tr>
                <th>
                  date 
                  <div class="dropdown-container">
                    <button class="filter-btn">
                    <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M5.22488 3.35999L3.36487 1.5L1.50488 3.35999" stroke="#616161" stroke-width="0.75" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M3.36499 10.5V1.5" stroke="#616161" stroke-width="0.75" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M6.77466 8.64001L8.63467 10.5L10.4947 8.64001" stroke="#616161" stroke-width="0.75" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M8.63379 1.5V10.5" stroke="#616161" stroke-width="0.75" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    </button>

                    <ul class="dropdown">
                      <li><button>today</button></li>
                      <li><button>this week</button></li>
                      <li><button>this month</button></li>
                      <li><button>custom date range</button></li>
                    </ul>
                  </div>
                </th>
                <th>
                  time 
                </th>
                <th>
                  patient name
                  <div class="dropdown-container">
                    <button class="filter-btn">
                    <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M5.22488 3.35999L3.36487 1.5L1.50488 3.35999" stroke="#616161" stroke-width="0.75" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M3.36499 10.5V1.5" stroke="#616161" stroke-width="0.75" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M6.77466 8.64001L8.63467 10.5L10.4947 8.64001" stroke="#616161" stroke-width="0.75" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M8.63379 1.5V10.5" stroke="#616161" stroke-width="0.75" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    </button>
                    <ul class="dropdown">
                      <li><button>all patients</button></li>
                      <li><button>new patients</button></li>
                      <li><button>regular patients</button></li>
                    </ul>
                  </div>

                </th>
                <th>phone #</th>
                <th>id #</th>
                <th>
                  action 
                  <div class="dropdown-container">
                    <button class="filter-btn">
                    <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M5.22488 3.35999L3.36487 1.5L1.50488 3.35999" stroke="#616161" stroke-width="0.75" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M3.36499 10.5V1.5" stroke="#616161" stroke-width="0.75" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M6.77466 8.64001L8.63467 10.5L10.4947 8.64001" stroke="#616161" stroke-width="0.75" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M8.63379 1.5V10.5" stroke="#616161" stroke-width="0.75" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    </button>

                    <ul class="dropdown">
                      <li><button>updated</button></li>
                      <li><button>accepted</button></li>
                    </ul>
                  </div>
                </th>
              </tr>
            </thead>

            <tbody>
              <?php foreach ($users as $user){?>
              <tr class="appointment-row"
                data-date="<?php echo date('Y-m-d', strtotime($user['date'])); ?>">
                <td class="patient-cell date">
                  <?php echo date('l, m/d/Y', strtotime($user['date'])); ?>
                </td>

                <td class="patient-cell time">
                  <?php echo $user['time']; ?>
                </td>

                <td class="patient-cell name-email">
                  <p class="patient-name" title="<?php echo $user['name']; ?>">
                    <?php echo $user['name']; ?>
                  </p>
                  <p class="patient-email" title="<?php echo $user['email']; ?>">
                    <?php echo $user['email']; ?>
                  </p>
                </td>

                <td class="patient-cell contact">
                  <?php echo $user['contact']; ?>
                </td>

                <td class="patient-cell apt-id">
                  <?php echo $user['appointment_id']; ?>
                </td>

                <td class="patient-cell action" data-status="<?php echo $user['status']; ?>">

                </td>
              </tr>
              <?php } ?>
            </tbody>
          </table>
          <?php if($result->num_rows == 0) { ?>
          <p>No appointment requests</p>
          <?php } ?>
        </div>

        <!-- Pagination -->
        <?php renderPagination($page, $number_of_pages) ?>
      </div>
    </section>
  </main>
</body>
<script>
  const actions = document.querySelectorAll('.patient-cell.action')
  const actBtns = ["Reschedule", "View History"]
  actions.forEach(action => {
    action.innerHTML = `<button class="reschedule-btn">${action.dataset.status === 'accepted'? 'Reschedule': 'View History'}</button>`
    
    const button = action.querySelector('button')
    let actionText = button.textContent.trim()
    
    if(actionText === 'Reschedule') 
      button.style.color = 'var(--cancel-btn-clr)'
  })

  const dropdownContainers = document.querySelectorAll('.dropdown-container')
  dropdownContainers.forEach(container => {
    container.addEventListener('click', e => {   
      if(e.target.closest('.filter-btn')) {
        const dropdown = container.querySelector('.dropdown')
        dropdown.style.display = dropdown.style.display === 'flex' ? 'none' : 'flex'
      } 
    })
  })

  document.addEventListener('click', e => {
    if(!e.target.closest('.filter-btn'))
     document.querySelectorAll('.dropdown').forEach(dropdown => {
      dropdown.style.display = 'none'
     })
  })
</script>
</html>