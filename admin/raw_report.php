<?php 
// require_once '../includes/config_session.inc.php';
session_start();
require_once '../includes/login_view.inc.php';
require_once '../includes/dbh.inc.php';

if (!isset($_SESSION['adminID'])) {
    header("Location: ../login.php?login=failed");
    exit();
}

$query = "SELECT * FROM services";
$stmt = $conn->prepare($query);
$stmt->execute();
$serviceresult = $stmt->get_result();
$serviceList = [];
if ($serviceresult->num_rows > 0) {
    while ($rowService = $serviceresult->fetch_assoc()) {
        $serviceList[] = $rowService;
    }
}

$datesStore = [];
$fromDate = $toDate = '';
$status = $labels = $services = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['filter'])) {
    $fromDate = $_POST['fromDate'] ?? '';
    $toDate = $_POST['toDate'] ?? '';
    $status = $_POST['status'] ?? [];
    $labels = $_POST['label'] ?? [];
    $services = $_POST['service'] ?? [];

    if (!empty($fromDate) && !empty($toDate)) {
        $query = "SELECT * FROM appointments WHERE date BETWEEN ? AND ?";
        $params = [$fromDate, $toDate];
        $types = "ss";

        if (!empty($status)) {
            $placeholders = implode(',', array_fill(0, count($status), '?'));
            $query .= " AND status IN ($placeholders)";
            $params = array_merge($params, $status);
            $types .= str_repeat('s', count($status));
        }

        if (!empty($labels)) {
            $placeholders = implode(',', array_fill(0, count($labels), '?'));
            $query .= " AND label IN ($placeholders)";
            $params = array_merge($params, $labels);
            $types .= str_repeat('s', count(value: $labels));
        }

        if (!empty($services)) {
          $serviceConditions = [];
          foreach ($services as $service) {
              $serviceConditions[] = "service LIKE ?";
              $params[] = "%$service%";
              $types .= 's';
          }
          $query .= " AND (" . implode(" OR ", $serviceConditions) . ")";
        }

        $stmt = $conn->prepare($query);
        if ($stmt) {
            $stmt->bind_param($types, ...$params);
            $stmt->execute();
            $result = $stmt->get_result();
            $datesStore = $result->fetch_all(MYSQLI_ASSOC);
            $totalResults = count($datesStore);
            $stmt->close();
        } else {
            echo "<script> alert('Error preparing the query: " . htmlspecialchars(json_encode($conn->error), ENT_QUOTES, 'UTF-8') . "'); </script>";
        }
    } else {
        echo "<script> alert('Please Provide Date'); </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../assets/logos/logo-white.png" type="image/x-icon" />
    <title>Appointments Filter</title>
    <link rel="stylesheet" href="../src/dist/styles.css" />
    <script>
           function printTable() {
            var printContent = document.getElementById('appointmentsTable');
            var newWindow = window.open('', '', 'height=600,width=800');
            
            // Add the CSS for table border to the printable page
            newWindow.document.write('<html><head><title>Print Appointment Table</title>');
            newWindow.document.write('<style>');
            newWindow.document.write('body { margin: 0; }');
            newWindow.document.write('table { border: 1px solid black; width: 100%; border-collapse: collapse; }');
            newWindow.document.write('thead { border: 1px solid black; }');
            newWindow.document.write('th, td { border-bottom: 1px solid black; border-right: 1px solid black; padding: 8px; text-align: left; }');
            newWindow.document.write('</style></head><body>');
            newWindow.document.write(printContent.outerHTML);
            newWindow.document.write('</body></html>');
            newWindow.document.close();
            newWindow.print();
        }
    </script>
</head>
  <body class="admin__page">
    <main class="admin__main raw-report-container">
      <!-- header -->
      <div class="header-container">
        <p class="heading">
          <img src="../assets/logos/logo-with-name-blue.png" alt="" style="width: 4rem; height: 4rem;"> 
          Smile Hero Clinic Report
        </p>
        <h1 class="header">Filter Your Reports with Ease</h1>
        <p class="sub-header">Quickly refine, sort, and customize your data to find exactly what you need.</p>
      </div>

      <!-- form fields -->
      <form action="" method="post" class="form-fields-container">
        <!-- date -->
        <div class="date-container">
          <p class="field-header">Select a date range <span>*</span></p>
          <div class="form-field">
            <div class="field">
              <label for="fromDate">From</label>
              <input type="date" name="fromDate" id="fromDate" value="<?php echo htmlspecialchars($fromDate); ?>">
            </div>
            
            <div class="field">
              <label for="toDate">To</label>
              <input type="date" name="toDate" id="toDate" value="<?php echo htmlspecialchars($toDate); ?>">
            </div>
          </div>
        </div>
          
        <!-- status -->
        <div class="status-container">
          <p class="field-header">Select status of appointment <span>*</span></p>
          <div class="form-field">
            <label for="status">Status</label>
            <div class="checkboxes-container">
              <div class="checkbox">
                <input type="checkbox" name="status[]" value="accepted" <?php echo in_array('accepted', $status) ? 'checked' : ''; ?>> <p>Accepted</p>
              </div>
              <div class="checkbox">
                <input type="checkbox" name="status[]" value="completed" <?php echo in_array('completed', $status) ? 'checked' : ''; ?>> <p>Completed</p>
              </div>
              <div class="checkbox">
                <input type="checkbox" name="status[]" value="canceled" <?php echo in_array('canceled', $status) ? 'checked' : ''; ?>> <p>Cancelled</p>
              </div>
              <div class="checkbox">
                <input type="checkbox" name="status[]" value="rejected" <?php echo in_array('rejected', $status) ? 'checked' : ''; ?>> <p>Rejected</p>
              </div>
              <div class="checkbox">
                <input type="checkbox" name="status[]" value="missed" <?php echo in_array('missed', $status) ? 'checked' : ''; ?>> <p>Missed</p>
              </div>
              <div class="checkbox">
                <input type="checkbox" name="status[]" value="request" <?php echo in_array('request', $status) ? 'checked' : ''; ?>> <p>Request</p>
              </div>
            </div>
          </div>
        </div>
        
        <!-- patient's label -->
        <div class="patient-label-container">
          <p class="field-header">Select label of patient <span>*</span></p>
          <div class="form-field">
            <label for="label">Patient's Label</label>
            <div class="checkboxes-container">
              <div class="checkbox">
                <input type="checkbox" name="label[]" value="new" <?php echo in_array('new', $labels) ? 'checked' : ''; ?>> New
              </div>

              <div class="checkbox">
                <input type="checkbox" name="label[]" value="regular" <?php echo in_array('regular', $labels) ? 'checked' : ''; ?>> Regular
              </div>

              <div class="checkbox">
                <input type="checkbox" name="label[]" value="walk-in" <?php echo in_array('walk-in', $labels) ? 'checked' : ''; ?>> Walk-in
              </div>
            </div>
          </div>
        </div>

        <!-- service -->
        <div class="service-container">
          <p class="field-header">Select service of appointment <span>*</span></p>
          <div class="form-field">
            <label for="status">Status</label>
            <div class="checkboxes-container">
            <?php foreach($serviceList as $serviceItem): ?>
              <div class="checkbox">
                <input type="checkbox" name="service[]" value="<?php echo htmlspecialchars($serviceItem['service_name']) ?>" <?php echo in_array($serviceItem['service_name'], $services) ? 'checked' : ''; ?>> <p><?php echo $serviceItem['service_name'] ?></p>
              </div>
            <?php endforeach; ?>   
            </div>
          </div>
        </div>
        
        <input type="submit" name="filter" value="Filter" class="form-button">
      </form>
      
      <hr>

      <!-- table -->
       <div class="table-container">
         <h3 class="table-header">Appointments</h3>

         <?php if (!empty($datesStore)) : ?>
          <div class="header-container">
            <div class="table-heading-container">
              <div class="header-text">Filter Results
                <span class="number-results"><?php echo $totalResults; ?></span>
              </div>
              <?php include("includes/search.php"); ?>
            </div>

            <div class="buttons-container">
              <form action="includes/export.php" method="post">
                <input type="hidden" name="fromDate" value="<?php echo htmlspecialchars($fromDate); ?>">
                <input type="hidden" name="toDate" value="<?php echo htmlspecialchars($toDate); ?>">
                <input type="hidden" name="status" value="<?php echo htmlspecialchars(json_encode($status)); ?>">
                <input type="hidden" name="label" value="<?php echo htmlspecialchars(json_encode($labels)); ?>">
                <button type="submit" name="export" class="excel-btn">Export to Excel</button>
              </form>
              <button onclick="window.print()" class="print-btn">Print Table</button>
            </div>
          </div>
          <table id="appointmentsTable" class="appointments-table">
            <thead>
              <tr>
                <th>#</th>
                <th>user id</th>
                <th>doc id</th>
                <th>apt id</th>
                <th>label</th>
                <th>name</th>
                <th>email</th>
                <th>date</th>
                <th>time</th>
                <th>service</th>
                <th>status</th>
                <th>created_at</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($datesStore as $dateReport) : ?>
              <tr class="appointment-row">
                <td>1</td>
                <td><?php echo htmlspecialchars($dateReport['user_id']); ?></td>
                <td><?php echo htmlspecialchars($dateReport['doctor_id']); ?></td>
                <td><?php echo htmlspecialchars($dateReport['appointment_id']); ?></td>
                <td><?php echo htmlspecialchars($dateReport['label']); ?></td>
                <td class="patient-name"><?php echo htmlspecialchars($dateReport['name']); ?></td>
                <td class="patient-email"><?php echo htmlspecialchars($dateReport['email']); ?></td>
                <td class="patient-cell date"><?php echo htmlspecialchars($dateReport['date']); ?></td>
                <td><?php echo htmlspecialchars($dateReport['time']); ?></td>
                <td class="patient-cell service"><?php echo htmlspecialchars($dateReport['service']); ?></td>
                <td><?php echo htmlspecialchars($dateReport['status']); ?></td>
                <td class="created-at"><?php echo htmlspecialchars($dateReport['created_at']); ?></td>
              </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
          <?php else : ?>
            <p class="no-appointment-message empty-table-text">No appointments found for the selected date range.</p>
          <?php endif; ?>
      </div>
    </main>

    <script>
    document.addEventListener("DOMContentLoaded", function () {
      // Map statuses to their corresponding colors
      const statusColors = {
        completed: "#2bc757",
        accepted: "#1d72f2",
        rejected: "#e84531",
        missed: "#faaf0d",
        canceled: "#616161",
        request: "#8a2be2",
      };

      // Get all rows in the table body
      const tableRows = document.querySelectorAll("#appointmentsTable tbody tr");

      // Iterate through each row
      tableRows.forEach((row) => {
        // Get the status cell (10th column, index 9)
        const statusCell = row.cells[9];

        if (statusCell) {
          // Extract the status text and trim any extra spaces
          const statusText = statusCell.textContent.trim().toLowerCase();

          // Check if the status exists in the colors map
          if (statusColors[statusText]) {
            // Apply the corresponding background color
            statusCell.style.color = statusColors[statusText];
            statusCell.style.fontWeight = "bold"; // Optional: Make the text bold
          }
        }
      });
    });

    const formatDateTime = (dateTime) => {
      const date = new Date(dateTime);
      const months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
      const month = months[date.getMonth()];
      const day = date.getDate();
      const year = date.getFullYear();
      let hours = date.getHours();
      const minutes = date.getMinutes().toString().padStart(2, "0");
      const amPm = hours >= 12 ? "PM" : "AM";
      hours = hours % 12 || 12;
      return `${month}, ${day}, ${year} - ${hours}:${minutes} ${amPm}`;
    };

    // Target all cells with the class "created-at"
    const createdAtCells = document.querySelectorAll(".created-at");
    createdAtCells.forEach(cell => {
      const originalDateTime = cell.textContent.trim();
      if (originalDateTime) {
        cell.textContent = formatDateTime(originalDateTime);
      }
    });
  </script>

  </body>
</html>

