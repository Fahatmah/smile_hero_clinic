<?php
require_once '../../includes/dbh.inc.php';

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
    <link rel="stylesheet" href="../../src/dist/styles.css" />
    <title>Generated Report</title>
</head>
<body class="dashboard-report">
  <main class="dashboard-report-container">

    <div class="report-header">
      <p class="heading">Smile Hero Clinic Report</p>
      <button class="print-report-btn" onclick="window.print()">Print Report</button>
    </div>
    <section class="table-container">
        
      <!-- Overview Table -->
      <div class="overview">
        <h1 class="table-header">Appointments Overview</h1>
        <table>
          <thead>
            <tr>
              <th>Today</th>
              <th>Weekly</th>
              <th>Monthly</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>8</td>
              <td>14</td>
              <td>42</td>
            </tr>
          </tbody>
        </table>
        <table>
          <thead>
            <tr>
              <th>Walk-in Patients</th>
              <th>Online Patients</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>8</td>
              <td>14</td>
            </tr>
          </tbody>
        </table>
      </div>

      <!-- Table for Patients -->
      <div class="patients-summary">
        <h2 class="table-header">Walk-in and Online Patients Summary</h2>
        <table>
          <thead>
            <tr>
              <th>Time Periods</th>
              <th>Walk-in</th>
              <th>Online</th>
              <th>Total</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td style="font-weight: bold;">Today</td>
              <td>2</td>
              <td>8</td>
              <td>39</td>
            </tr>
            <tr>
              <td style="font-weight: bold;">Weekly</td>
              <td>2</td>
              <td>8</td>
              <td>39</td>
            </tr>
            <tr>
              <td style="font-weight: bold;">Monthly</td>
              <td>2</td>
              <td>8</td>
              <td>39</td>
            </tr>
          </tbody>
        </table>
      </div>

      <!-- Table for Appointments -->
      <div class="appointments-summary">
        <h3 class="table-header">Appointments Summary</h3>
        <table>
          <thead>
            <tr>
              <th>Accepted</th>
              <th>Canceled</th>
              <th>Rejected</th>
              <th>Missed</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>34</td>
              <td>5</td>
              <td>8</td>
              <td>3</td>
            </tr>
          </tbody>
        </table>
      </div>
    </section>

    <article class="performance-summary">
      <h4 class="chart-header">Performance Summary</h4>

      <section class="charts-container">
        <article>
          <!-- line chart -->
          <p class="header daily">weekly<span><?php echo $totalAppointmentsPerWeek?></span></p>
          <div class="daily chart">
            <canvas id="lineChart" width="200" height="104" style="display: unset"></canvas>
          </div>
        </article>
        <article>
          <!-- bar chart -->
          <p class="header monthly">monthly<span><?php echo $totalAppointmentsPerMonth?></span></p>
          <div class="monthly chart">
            <canvas id="barChart" width="200" height="104" style="display: unset"></canvas>
          </div>
        </article>
      </section>
    </article>
  </main>
  
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
  fetch('getAppointmentsPerWeekday.php')
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
  fetch('getAppointmentsPerMonth.php')
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
</script>
</body>
</html>
