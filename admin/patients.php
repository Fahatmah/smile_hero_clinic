<?php
require_once '../includes/config_session.inc.php';
require_once '../includes/login_view.inc.php';
require_once '../includes/dbh.inc.php';
require_once './includes/pagination.php';

if(!isset($_SESSION['adminEmail'])) {
  // Redirect user to login if not logged in
  header("Location: ../login.php?login=failed");
  exit();
}

// Define how many results per page
$results_per_page = 20;

// Find out the number of results stored in the database
$query = "SELECT COUNT(*) AS total FROM users";
$result = $conn->query($query);
$row = $result->fetch_assoc();
$number_of_results = $row['total'];

// Determine the total number of pages available
$number_of_pages = ceil($number_of_results / $results_per_page);

// Determine which page number visitor is currently on
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$page = max(1, $page); // Ensure the page number is at least 1

// Determine the SQL LIMIT starting number for the results on the displaying page
$this_page_first_result = ($page - 1) * $results_per_page;

// Retrieve selected results from the database and display them on the page
$query = "SELECT * FROM users LIMIT $this_page_first_result, $results_per_page";
$result = $conn->query($query);
$users = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $users[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="shortcut icon" href="../assets/images/logoipsum.svg" type="image/x-icon" />
  <title>Patients | Admin</title>
  <link rel="stylesheet" href="../src/dist/styles.css" />
  
</head>

<body class="admin__page">
  <main class="admin__main">
    <!-- nav header -->
    <?php include("includes/nav.php"); ?>

    <!-- patients container -->
    <section class="admin__content">
      <!-- side bar -->
      <?php include("includes/side_nav.php"); ?>
      <!-- patients -->
      <div class="patients__container">
        <div class="patients__table">
          <h1 class="table-heading">Patients <span class="table-item-count">13</span></h1>

          <table>
            <thead>
              <tr>
                <th>id #</th>
                <th>name & email</th>
                <th>
                  gender
                  <div class="dropdown-container">
                    <button class="filter-btn">
                    <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M5.22488 3.35999L3.36487 1.5L1.50488 3.35999" stroke="#616161" stroke-width="0.75" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M3.36499 10.5V1.5" stroke="#616161" stroke-width="0.75" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M6.77466 8.64001L8.63467 10.5L10.4947 8.64001" stroke="#616161" stroke-width="0.75" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M8.63379 1.5V10.5" stroke="#616161" stroke-width="0.75" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    </button>

                    <ul class="dropdown gender">
                      <li><button>all</button></li>
                      <li><button>male</button></li>
                      <li><button>female</button></li>
                    </ul>
                  </div>
                </th>
                <th>birthdate</th>
                <th>phone #</th>
                <th>address</th>
                <th>reg. date</th>
              </tr>
            </thead>

            <tbody>
              <tr class="no-appointment-message" style="display:none;">
                <td colspan="6" style="text-align: center;">There's no such appointment in this section</td>
              </tr>
              <?php foreach ($users as $user){ ?>
              <tr>
                <td class="patient-cell id">
                  <?php echo htmlspecialchars($user['user_id']); ?>
                </td>

                <td class="patient-cell name-email">
                  <p class="patient-name" title="<?php echo $user['fullname']; ?>">
                    <?php echo htmlspecialchars($user['fullname']); ?>
                  </p>
                  <p class="patient-email" title="<?php echo $user['email']; ?>">
                    <?php echo htmlspecialchars($user['email']); ?>
                  </p>
                </td>

                <td class="patient-cell gender">
                  
                </td>

                <td class="patient-cell birthdate">
                  09-19-1989
                </td>

                <td class="patient-cell phone">
                  <?php echo htmlspecialchars($user['contact']); ?>
                </td>

                <td class="patient-cell address">
                  <?php if(strlen($user['address']) === 0){
                    echo "No Address";
                   } else {
                  echo htmlspecialchars($user['address']); 
                 } ?>
                </td>

                <td class="patient-cell regdate">
                  <?php echo htmlspecialchars($user['created_at']); ?>
                </td>
              </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
        <!-- Pagination -->
        <?php renderPagination($page, $number_of_pages) ?>
      </div>
    </section>
  </main>
</body>
<script>
  const registrationDates = document.querySelectorAll('.patient-cell.regdate')
  
  function sliceRegistrationDate(dateObjs){   
    return Array.from(dateObjs).map(dateObj => {
      let dateText = dateObj.textContent.trim()
      let date = dateText.slice(0, 11) // remove time and get date
      dateObj.textContent = date
    })
  }
  sliceRegistrationDate(registrationDates)

  // temp gender
  const genderTexts = document.querySelectorAll('.patient-cell.gender')
  let genderArray = ["Male", "Female"]
  const displayGender = () => Math.floor(Math.random() * genderArray.length)
  genderTexts.forEach(gender => gender.textContent = genderArray[displayGender()])

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

  const filterByGender = (gender) => {
    const rows = document.querySelectorAll('.patients__table tbody tr:not(.no-appointment-message)');
    let visibleRows = 0
    let showRow = false

    rows.forEach(row => {
      const userGender = row.querySelector('.patient-cell.gender').textContent.trim();
      if (gender === 'all' || userGender.toLowerCase() === gender.toLowerCase()) {
        row.style.display = '';
        showRow = true
      } else {
        row.style.display = 'none';
      }
      if (showRow) visibleRows++
    });
    document.querySelector('.no-appointment-message').style.display = visibleRows === 0 ? '' : 'none'
  };

  const genderButtons = document.querySelectorAll('.dropdown.gender button');
  genderButtons.forEach(button => {
    button.addEventListener('click', (e) => {
      const selectedGender = e.target.textContent.toLowerCase();
      filterByGender(selectedGender);
    });
  });
</script>

</html>