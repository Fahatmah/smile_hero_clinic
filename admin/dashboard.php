<?php
require_once '../includes/config_session.inc.php';
require_once '../includes/login_view.inc.php';
require_once '../includes/dbh.inc.php';

if(!isset($_SESSION['adminID'])) {
  // Redirect user to login if not logged in
  header("Location: ../login.php?login=failed");
  exit();
}

$query = "SELECT * FROM doctors";
$result = $conn->query($query);
$doctors = 0;
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $doctors++;
  }
}

$query = "SELECT * FROM appointments WHERE status = 'rejected' OR status = 'canceled'";
$result = $conn->query($query);
$countStats = 0;
if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()){
    $countStats++;
  }
}

$query = "SELECT * FROM appointments WHERE status = 'rejected' OR status = 'canceled' 
  ORDER BY created_at DESC LIMIT 3";
$result = $conn->query($query);
$allStats = [];
if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()){
    $allStats[] = $row;
  }
}

$dateNow = date('Y-m-d, l');


$query  = "SELECT * FROM appointments WHERE status = 'accepted' AND date > CURDATE() ORDER BY time DESC LIMIT 3";
$result = $conn->query($query);
$users = [];
if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
      $users[] = $row;
  }
}

$query  = "SELECT * FROM appointments WHERE status = 'accepted' AND date > CURDATE()";
$result = $conn->query($query);
$totalAppointments = 0;
if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
      $totalAppointments++;
  }
}

$query  = "SELECT * FROM appointments WHERE date = CURDATE() AND status = 'accepted'";
$result = $conn->query($query);
$todaysAppointment = 0;
if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    $todaysAppointment++;
  }
}


$query  = "SELECT * FROM users";
$result = $conn->query($query);
$usersinfo = [];
$totalUsers = 0;
if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
      $usersinfo[] = $row;
      $totalUsers++;
  }
}

$query = "SELECT MONTH(created_at) as month, COUNT(*) as count FROM appointments
            GROUP BY MONTH(created_at)";
$result = $conn->query($query);
$totalAppointmentsPerMonth = 0;
if($result->num_rows > 0){
  while($row = $result->fetch_assoc()){
    $totalAppointmentsPerMonth++;
  }
}

$query = "SELECT WEEKDAY(created_at) + 1 as weekday, COUNT(*) as count
        FROM appointments
        GROUP BY WEEKDAY(created_at)
        ORDER BY weekday";
$result = $conn->query($query);
$totalAppointmentsPerWeek = 0;
if($result->num_rows > 0){
  while($row = $result->fetch_assoc()){
    $totalAppointmentsPerWeek++;
  }
}

// Count the number of walk-in and online appointments for today
$query = "SELECT 
            SUM(CASE WHEN label = 'walk-in' THEN 1 ELSE 0 END) as walkInCount,
            SUM(CASE WHEN label != 'walk-in' THEN 1 ELSE 0 END) as onlineCount
          FROM appointments 
          WHERE date = CURDATE() AND status = 'accepted'";

$result = $conn->query($query);
$counts = $result->fetch_assoc();

$walkInCount = $counts['walkInCount'] ?? 0; // Default to 0 if NULL
$onlineCount = $counts['onlineCount'] ?? 0; // Default to 0 if NULL

$filter = isset($_GET['filter']) ? $_GET['filter'] : 'today';
$dateNow = date('Y-m-d');
$startOfWeek = date('Y-m-d', strtotime('monday this week'));
$startOfMonth = date('Y-m-01');
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="shortcut icon" href="../assets/images/logoipsum.svg" type="image/x-icon" />
  <!-- <link href="https://fonts.googleapis.com/css?family=Inter:100,200,300,regular,500,600,700,800,900,100italic,200italic,300italic,italic,500italic,600italic,700italic,800italic,900italic" rel="stylesheet" /> -->
  <title>Dashboard | Admin</title>
  <link rel="stylesheet" href="../src/dist/styles.css" />
  
</head>

<body class="admin__page">
  <main class="admin__main">
    <!-- nav header -->
    <?php include("includes/nav.php"); ?>

    <!-- dashboard container -->
    <section class="admin__content dashboard">
      <!-- side bar -->
      <?php include("includes/side_nav.php"); ?>

      <div class="cards">
        <article class="overview">
          <div class="overview__header">

            <div class="overview_details">
              <h1 class="overview__title">Today's Overview</h1>
                
              <button class="filter-btn" id="filterBtn">
                <svg width="25" height="12" viewBox="0 0 25 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <circle cx="6.66666" cy="6" r="2" fill="#616161"/>
                  <circle cx="12.6667" cy="6" r="2" fill="#616161"/>
                  <circle cx="18.6667" cy="6" r="2" fill="#616161"/>
                </svg>
              </button>    
              <div class="filter-summary" id="filterSummary">
                <div class="filter-types">
                  <label id="todayBtn">
                    Today
                    <input type="radio" name="filterType" value="today" onclick="scaleDownFilterSummary()" readonly/>
                  </label>
                  <label id="weeklyBtn">
                    Weekly
                    <input type="radio" name="filterType" value="weekly" onclick="scaleDownFilterSummary()" readonly/>
                  </label>
                  <label id="monthlyBtn">
                    Monthly
                    <input type="radio" name="filterType" value="monthly" onclick="scaleDownFilterSummary()" readonly/>
                  </label>
                </div>
              </div>
            </div>

            <a href="includes/report.php" class="generate-report-btn" target="_blank">Generate Report</a>
          </div>
          
          <div class="overview__content">
           <section class="overview__item">
            <div class="header">
              <p class="overview__label">Today's Schedule</p>
              <button class="more-btn" id="moreBtn">
                <svg width="25" height="12" viewBox="0 0 25 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                <circle cx="6.66666" cy="6" r="2" fill="#616161"/>
                <circle cx="12.6667" cy="6" r="2" fill="#616161"/>
                <circle cx="18.6667" cy="6" r="2" fill="#616161"/>
                </svg>
              </button>

              <div class="appointment-summary" id="appointmentSummary">
                <p class="summary-title">Number of appointments</p>
                <hr>
                <div class="appointment-types">
                  <p class="appointment-type">Walk-ins<span class="appointment-count"><?php echo $walkInCount; ?></span></p>
                  <p class="appointment-type">Online<span class="appointment-count"><?php echo $onlineCount; ?></span></p>
                </div>
              </div>
            </div>
             <div class="overview__icon-wrapper">
               <svg width="36" height="36" viewBox="0 0 36 36"      fill="none" xmlns="http://www.w3.org/2000/svg"    aria-label="Today's Schedule Icon">
                 <rect width="36" height="36" rx="18"     fill="#1D72F2" />
                 <path d="M14 8V11" stroke="white" stroke-width="1.     5" stroke-linecap="round" stroke-linejoin="round"/>
                 <path d="M22 8V11" stroke="white" stroke-width="1.     5" stroke-linecap="round" stroke-linejoin="round"/>
                 <path d="M9.5 15.0901H26.5" stroke="white"     stroke-width="1.5" stroke-linecap="round"     stroke-linejoin="round"/>
                 <path d="M27 14.5V23C27 26 25.5 28 22 28H14C10.5 28      9 26 9 23V14.5C9 11.5 10.5 9.5 14 9.5H22C25.5 9.5     27 11.5 27 14.5Z" stroke="white" stroke-width="1.5"      stroke-linecap="round" stroke-linejoin="round"/>
                 <path d="M21.6947 19.7H21.7037" stroke="white"     stroke-width="2" stroke-linecap="round"     stroke-linejoin="round"/>
                 <path d="M21.6947 22.7H21.7037" stroke="white"     stroke-width="2" stroke-linecap="round"     stroke-linejoin="round"/>
                 <path d="M17.9955 19.7H18.0045" stroke="white"     stroke-width="2" stroke-linecap="round"     stroke-linejoin="round"/>
                 <path d="M17.9955 22.7H18.0045" stroke="white"     stroke-width="2" stroke-linecap="round"     stroke-linejoin="round"/>
                 <path d="M14.2943 19.7H14.3033" stroke="white"     stroke-width="2" stroke-linecap="round"     stroke-linejoin="round"/>
                 <path d="M14.2943 22.7H14.3033" stroke="white"     stroke-width="2" stroke-linecap="round"     stroke-linejoin="round"/>
               </svg>
               <p class="overview__value" id="todaysSchedule"><?php echo $todaysAppointment; ?></p>
             </div>
           </section>

           <section class="overview__item">
             <p class="overview__label">Total Patients</p>
             <div class="overview__icon-wrapper">
               <svg width="37" height="36" viewBox="0 0 37 36" fill="none" xmlns="http://www.w3.org/2000/svg">
              <rect x="0.666656" width="36" height="36" rx="18" fill="#E84531"/>
              <path d="M24.6667 13.16C24.6067 13.15 24.5367 13.15 24.4767 13.16C23.0967 13.11 21.9967 11.98 21.9967 10.58C21.9967 9.15 23.1467 8 24.5767 8C26.0067 8 27.1567 9.16 27.1567 10.58C27.1467 11.98 26.0467 13.11 24.6667 13.16Z" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
              <path d="M23.6367 20.4399C25.0067 20.6699 26.5167 20.4299 27.5767 19.7199C28.9867 18.7799 28.9867 17.2399 27.5767 16.2999C26.5067 15.5899 24.9767 15.3499 23.6067 15.5899" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
              <path d="M12.6367 13.16C12.6967 13.15 12.7667 13.15 12.8267 13.16C14.2067 13.11 15.3067 11.98 15.3067 10.58C15.3067 9.15 14.1567 8 12.7267 8C11.2967 8 10.1467 9.16 10.1467 10.58C10.1567 11.98 11.2567 13.11 12.6367 13.16Z" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
              <path d="M13.6667 20.4399C12.2967 20.6699 10.7867 20.4299 9.72666 19.7199C8.31666 18.7799 8.31666 17.2399 9.72666 16.2999C10.7967 15.5899 12.3267 15.3499 13.6967 15.5899" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
              <path d="M18.6667 20.63C18.6067 20.62 18.5367 20.62 18.4767 20.63C17.0967 20.58 15.9967 19.45 15.9967 18.05C15.9967 16.62 17.1467 15.47 18.5767 15.47C20.0067 15.47 21.1567 16.63 21.1567 18.05C21.1467 19.45 20.0467 20.59 18.6667 20.63Z" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
              <path d="M15.7567 23.7799C14.3467 24.7199 14.3467 26.2599 15.7567 27.1999C17.3567 28.2699 19.9767 28.2699 21.5767 27.1999C22.9867 26.2599 22.9867 24.7199 21.5767 23.7799C19.9867 22.7199 17.3567 22.7199 15.7567 23.7799Z" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
              </svg>

               <p class="overview__value" id="newPatients"><?php echo $totalUsers; ?></p>
             </div>
           </section>

           <section class="overview__item">
             <p class="overview__label">Doctor's On-Duty</p>
             <div class="overview__icon-wrapper">
               <svg width="31" height="32" viewBox="0 0 31 32" fill="none" xmlns="http://www.w3.org/2000/svg">
              <rect x="0.333374" width="30" height="32" rx="15" fill="#FAAF0D"/>
              <path d="M13.3334 10H17.3334C19.3334 10 19.3334 9 19.3334 8C19.3334 6 18.3334 6 17.3334 6H13.3334C12.3334 6 11.3334 6 11.3334 8C11.3334 10 12.3334 10 13.3334 10Z" stroke="white" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
              <path d="M19.3334 10.0348C22.6634 10.2205 24.3334 8.91066 24.3334 13.6239V19.8119C24.3334 23.9373 23.3334 26 18.3334 26H12.3334C7.33337 26 6.33337 23.9373 6.33337 19.8119V13.6239C6.33337 8.92097 8.00337 10.2205 11.3334 10.0348" stroke="white" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
              <path d="M18.3334 18H12.3334" stroke="white" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
              <path d="M15.3334 21V15" stroke="white" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
              </svg>

               <p class="overview__value" id="doctorsOnDuty"><?php echo $doctors ?></p>
             </div>
           </section>

          </div>
        </article>

        <article class="appointments">
          <h2>Appointments</h2>

          <div class="appointments-content">
            <section class="upcoming__appointments">
              <header class="appointments-header">
                <p>Upcoming<span class="upcoming appointments-count">
                  <?php if($todaysAppointment === "0"){ ?>0
                 <?php }else{ echo $totalAppointments; }?>
                </span></p>
                <button type="button">
                  <a href="appointments.php">
                    See all 
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M9.62 3.95337L13.6667 8.00004L9.62 12.0467" stroke="#616161" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                      <path d="M2.33333 8H13.5533" stroke="#616161" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                  </a>
                </button>
              </header>

              <table class="appointments-table">
                <thead>
                  <tr>
                    <th>patient name</th>
                    <th>phone #</th>
                    <th>time</th>
                    <th>date</th>
                    <th>actions</th>
                  </tr>
                </thead>

                <tbody>
                  <?php foreach ($users as $user){?>
                  <tr>
                   <td><?php echo $user['name'] ?></td>
                    <td><?php echo $user['contact'] ?></td>
                    <td><?php echo $user['time'] ?></td>
                    <td><?php echo $user['date'] ?></td>
                    <td>
                      <div class="appointments-actions">
                        <button type="button" class="reschedule-btn">resched</button>
                        <button type="button" class="cancel-btn">cancel</button>
                      </div>
                    </td>
                  </tr>
              <?php  } ?>
                </tbody>
              </table>
            </section>

            <section class="missed__appointments">
              <header class="appointments-header">
                <p>missed/ <br> canceled/rejected<span class="missed appointments-count"><?php echo $countStats?></span></p>
                <button type="button">
                  <a href="#">
                    view
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M9.62 3.95337L13.6667 8.00004L9.62 12.0467" stroke="#616161" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                      <path d="M2.33333 8H13.5533" stroke="#616161" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                  </a>
                </button>
              </header>

              <table class="appointments-table">
                <thead>
                  <tr>
                    <th>time</th>
                    <th>date</th>
                    <th>status</th>
                  </tr>
                </thead>

                <tbody>
                  <?php foreach($allStats as $allStat){  ?>
                  <tr>
                    <td><?php echo $allStat['time']?></td>

                    <?php
                    $dateFromDatabase = $allStat['date'];
                    $dateOnly = explode(',', $dateFromDatabase)[0];
                    
                    $date = DateTime::createFromFormat('Y-m-d', $dateOnly);
                    $formattedDate = $date->format('m/d/Y');
                     ?>
                     
                    <td><?php echo $formattedDate?></td>
                    <td>
                    <?php switch ($allStat['status']) { 
                      case 'rejected': ?>
                        <p class="appointment-status rejected"><?php echo $allStat['status']?></p>
                      <?php  break;
                      case 'canceled': ?>
                        <p class="appointment-status canceled"><?php echo $allStat['status']?></p>
                      <?php break; 
                      case 'missed': ?>
                        <p class="appointment-status missed"><?php echo $allStat['status']?></p>
                      <?php break; 
                      default: ?>
                         <p class="appointment-status accepted"><?php echo $allStat['status']?></p>
                      <?php break;
                        } ?>
                    </td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
            </section>
          </div>
        </article>

        <article class="summary">
          <h3>Performance Summary</h3>

          <section class="charts-container">
            <article>
              <!-- line chart -->
              <p class="chart-header daily">weekly<span><?php echo $totalAppointmentsPerWeek?></span></p>
              <div class="daily chart">
                <canvas id="lineChart" width="200" height="104" style="display: unset"></canvas>
              </div>
            </article>
            <article>
              <!-- bar chart -->
              <p class="chart-header monthly">monthly<span><?php echo $totalAppointmentsPerMonth?></span></p>
              <div class="monthly chart">
                <canvas id="barChart" width="200" height="104" style="display: unset"></canvas>
              </div>
            </article>
          </section>
        </article>
      </div>
    </section>
  </main>
</body>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  // Canvas contexts
  const lineCtx = document.getElementById('lineChart').getContext('2d');
  const barCtx = document.getElementById('barChart').getContext('2d');

  // Gradient for the line chart
  const gradient = lineCtx.createLinearGradient(0, 0, 0, 400);
  gradient.addColorStop(0, 'hsla(216, 89%, 53%, 0.35)');
  gradient.addColorStop(1, 'hsla(0, 0%, 100%, 0)');

  // Fetch daily appointments (weekdays)
  fetch('includes/getAppointmentsPerWeekday.php')
    .then(response => response.json())
    .then(data => {
      const weekdays = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];
      const appointmentsPerDay = new Array(7).fill(0);

      data.forEach(item => {
        appointmentsPerDay[item.weekday - 1] = item.count;
      });

      const lineGraphData = {
        labels: weekdays,
        datasets: [{
          label: 'Daily Appointments',
          data: appointmentsPerDay,
          fill: true,
          backgroundColor: gradient,
          borderColor: '#1D72F2',
          borderWidth: 2,
          pointBackgroundColor: '#fff',
          pointBorderColor: '#1D72F2',
          tension: 0.45,
        }]
      };

      const lineConfig = {
        type: 'line',
        data: lineGraphData,
        options: {
          responsive: true,
          plugins: {
            legend: { display: false }
          },
          scales: {
            x: {
              ticks: {
                font: { family: 'DM Sans, sans-serif' }
              }
            },
            y: {
              beginAtZero: true,
              max: 30,
              ticks: {
                stepSize: 6,
                font: { family: 'DM Sans, sans-serif' }
              }
            }
          }
        }
      };

      new Chart(lineCtx, lineConfig);
    })
    .catch(error => console.error('Error fetching daily appointments data:', error));

  // Fetch monthly appointments
  fetch('includes/getAppointmentsPerMonth.php')
    .then(response => response.json())
    .then(data => {
      const months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
      const appointmentsPerMonth = new Array(12).fill(0);

      data.forEach(item => {
        appointmentsPerMonth[item.month - 1] = item.count;
      });

      const barGraphData = {
        labels: months,
        datasets: [{
          label: 'Monthly Appointments',
          data: appointmentsPerMonth,
          backgroundColor: [
            '#616161', '#1D72F2', '#FAAF0D', '#1D72F2', '#E84531', '#616161', '#1D72F2', 
            '#FAAF0D', '#1D72F2', '#E84531', '#FAAF0D', '#616161'
          ],
          borderColor: 'transparent',
          borderRadius: 20,
        }]
      };

      const barConfig = {
        type: 'bar',
        data: barGraphData,
        options: {
          responsive: true,
          plugins: {
            legend: { display: false }
          },
          scales: {
            x: {
              ticks: {
                font: { family: 'DM Sans, sans-serif' }
              }
            },
            y: {
              beginAtZero: true,
              max: 100,
              ticks: {
                stepSize: 25,
                font: { family: 'DM Sans, sans-serif' }
              }
            }
          }
        }
      };

      new Chart(barCtx, barConfig);
    })
    .catch(error => console.error('Error fetching monthly appointments data:', error));

    // overview pop up
    const summary = document.getElementById('appointmentSummary')
    const moreBtn = document.getElementById('moreBtn')

    moreBtn.addEventListener('click', (e) => {
      summary.classList.toggle('active')
    })

    const filterSummary = document.getElementById('filterSummary')
    const filterBtn = document.getElementById('filterBtn')

    filterBtn.addEventListener('click', (e) => {
      filterSummary.classList.toggle('active')
    })

    // Function to fetch data based on selected period (today, weekly, or monthly)
  function fetchData(period) {
    fetch(`includes/get_appointments_data.php?period=${period}`)
      .then(response => response.json())
      .then(dataFromDB => {
        if (period === 'today') {
          data.today = dataFromDB;
        } else if (period === 'weekly') {
          data.weekly = dataFromDB;
        } else if (period === 'monthly') {
          data.monthly = dataFromDB;
        }

        // Update the UI with the new data (this will depend on your HTML structure)
        updateDashboard(period);
      })
      .catch(error => console.error('Error fetching data:', error));
    }

    // Assuming you have data objects for each filter type
    const data = {
      today: {
        label: "Today's Overview",
        scheduleLabel: "Today's Schedule",
        walkInCount: 0,
        onlineCount: 0,
        totalAppointments: 0,
        newPatients: 0,
        doctorsOnDuty: 0
      },
      weekly: {
        label: "Weekly Overview",
        scheduleLabel: "This Week's Schedule",
        walkInCount: 0,
        onlineCount: 0,
        totalAppointments: 0,
        newPatients: 0,
        doctorsOnDuty: 0
      },
      monthly: {
        label: "Monthly Overview",
        scheduleLabel: "This Month's Schedule",
        walkInCount: 0,
        onlineCount: 0,
        totalAppointments: 0,
        newPatients: 0,
        doctorsOnDuty: 0
      }
    };

    // Event listener for radio button changes
    document.querySelectorAll('input[name="filterType"]').forEach(button => {
      button.addEventListener('change', function() {
        fetchData(this.value);
      });
    });

    // Initial data fetch
    fetchData('today');
    fetchData('weekly');
    fetchData('monthly');


    const overviewLabel = document.querySelector(".overview__header .overview__title");
    const scheduleLabel = document.querySelector(".overview__content .overview__label");
    const walkInCountElem = document.querySelector(".appointment-type span.appointment-count");
    const onlineCountElem = document.querySelector(".appointment-type:nth-child(2) span.appointment-count");
    const totalAppointmentsElem = document.querySelector(".overview__value"); 
    const newPatientsElem = document.querySelectorAll(".overview__value")[1]; 
    const doctorsOnDutyElem = document.querySelectorAll(".overview__value")[2]; 

    function updateOverview(filterType) {
      const filterData = data[filterType];
      
      overviewLabel.textContent = filterData.label;
      scheduleLabel.textContent = filterData.scheduleLabel;
      
      walkInCountElem.textContent = filterData.walkInCount;
      onlineCountElem.textContent = filterData.onlineCount;
      
      totalAppointmentsElem.textContent = filterData.totalAppointments;
      newPatientsElem.textContent = filterData.newPatients;
      doctorsOnDutyElem.textContent = filterData.doctorsOnDuty;
    }

    // Event listeners for filter buttons
    document.getElementById("todayBtn").addEventListener("click", () => updateOverview("today"));
    document.getElementById("weeklyBtn").addEventListener("click", () => updateOverview("weekly"));
    document.getElementById("monthlyBtn").addEventListener("click", () => updateOverview("monthly"));

    function scaleDownFilterSummary() {
      const filterSummary = document.getElementById('filterSummary');
      filterSummary.classList.remove('active');
    }


    // Optionally, add an event listener to reset scale when the filter summary container is clicked again
    document.getElementById('filterSummary').addEventListener('click', function() {
        scaleDownFilterSummary();  // Apply scale-down when clicked
    });

</script>

</html>