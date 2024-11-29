<?php 
require_once '../includes/config_session.inc.php';
require_once '../includes/login_view.inc.php';
require_once '../includes/dbh.inc.php';

if (!isset($_SESSION['adminID'])) {
    header("Location: ../login.php?login=failed");
    exit();
}

$datesStore = [];
$fromDate = $toDate = '';
$status = $labels = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['filter'])) {
    $fromDate = $_POST['fromDate'] ?? '';
    $toDate = $_POST['toDate'] ?? '';
    $status = $_POST['status'] ?? [];
    $labels = $_POST['label'] ?? [];

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

        $stmt = $conn->prepare($query);
        if ($stmt) {
            $stmt->bind_param($types, ...$params);
            $stmt->execute();
            $result = $stmt->get_result();
            $datesStore = $result->fetch_all(MYSQLI_ASSOC);
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
    <title>Appointments Filter</title>
    <style>
        body {
            margin: 0;
        }
        table {
            border: 1px solid black; 
            width: 98.5vw;
        }
        thead {
            border: 1px solid black;
        }
        th, td {
            border-bottom: 1px solid black;
            border-right: 1px solid black;
        }
    </style>
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
<body>
    <form action="" method="post">
        <label for="fromDate">From:</label>
        <input type="date" name="fromDate" id="fromDate" value="<?php echo htmlspecialchars($fromDate); ?>">

        <label for="toDate">To:</label>
        <input type="date" name="toDate" id="toDate" value="<?php echo htmlspecialchars($toDate); ?>">

        <br>

        <label for="status">Status</label>
        <input type="checkbox" name="status[]" value="accepted" <?php echo in_array('accepted', $status) ? 'checked' : ''; ?>> Accepted
        <input type="checkbox" name="status[]" value="completed" <?php echo in_array('completed', $status) ? 'checked' : ''; ?>> Completed
        <input type="checkbox" name="status[]" value="canceled" <?php echo in_array('canceled', $status) ? 'checked' : ''; ?>> Canceled
        <input type="checkbox" name="status[]" value="rejected" <?php echo in_array('rejected', $status) ? 'checked' : ''; ?>> Rejected
        <input type="checkbox" name="status[]" value="missed" <?php echo in_array('missed', $status) ? 'checked' : ''; ?>> Missed

        <br>

        <label for="label">Patient's Label</label>
        <input type="checkbox" name="label[]" value="new" <?php echo in_array('new', $labels) ? 'checked' : ''; ?>> New
        <input type="checkbox" name="label[]" value="regular" <?php echo in_array('regular', $labels) ? 'checked' : ''; ?>> Regular
        <input type="checkbox" name="label[]" value="walk-in" <?php echo in_array('walk-in', $labels) ? 'checked' : ''; ?>> Walk-in

        <br>
        <input type="submit" name="filter" value="Filter">
    </form>
    
    <h3>Appointments:</h3>
    <?php if (!empty($datesStore)) : ?>
    <form action="includes/export.php" method="post">
        <input type="hidden" name="fromDate" value="<?php echo htmlspecialchars($fromDate); ?>">
        <input type="hidden" name="toDate" value="<?php echo htmlspecialchars($toDate); ?>">
        <input type="hidden" name="status" value="<?php echo htmlspecialchars(json_encode($status)); ?>">
        <input type="hidden" name="label" value="<?php echo htmlspecialchars(json_encode($labels)); ?>">
        <button type="submit" name="export">Export to Excel</button>
    </form>
    <button onclick="printTable()">Print Table</button>
    <table id="appointmentsTable">
        <thead>
            <tr>
                <th>user_id</th>
                <th>doctor_id</th>
                <th>appointment_id</th>
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
                <tr>
                    <td><?php echo htmlspecialchars($dateReport['user_id']); ?></td>
                    <td><?php echo htmlspecialchars($dateReport['doctor_id']); ?></td>
                    <td><?php echo htmlspecialchars($dateReport['appointment_id']); ?></td>
                    <td><?php echo htmlspecialchars($dateReport['label']); ?></td>
                    <td><?php echo htmlspecialchars($dateReport['name']); ?></td>
                    <td><?php echo htmlspecialchars($dateReport['email']); ?></td>
                    <td><?php echo htmlspecialchars($dateReport['date']); ?></td>
                    <td><?php echo htmlspecialchars($dateReport['time']); ?></td>
                    <td><?php echo htmlspecialchars($dateReport['service']); ?></td>
                    <td><?php echo htmlspecialchars($dateReport['status']); ?></td>
                    <td><?php echo htmlspecialchars($dateReport['created_at']); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php else : ?>
        <p>No appointments found for the selected date range.</p>
    <?php endif; ?>
</body>
</html>

