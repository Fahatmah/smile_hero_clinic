<?php
require_once '../../includes/config_session.inc.php';
require_once '../../includes/login_view.inc.php';
require_once '../../includes/dbh.inc.php';

// Get period from query string
$period = isset($_GET['period']) ? $_GET['period'] : 'today';

// Prepare the response array
$response = [];

// SQL queries for different periods
if ($period == 'today') {
    $sql = "SELECT 
            (SELECT COUNT(*) FROM appointments WHERE label = 'walk-in' AND DATE(created_at) = NOW()) AS walkInCount,
            (SELECT COUNT(*) FROM appointments WHERE label != 'walk-in' AND DATE(created_at) = NOW()) AS onlineCount,
            (SELECT COUNT(*) FROM appointments WHERE DATE(created_at) = NOW()) AS totalAppointments,
            (SELECT COUNT(*) FROM users WHERE DATE(created_at) = NOW()) AS newPatients,
            (SELECT COUNT(*) FROM doctors WHERE DATE(created_at) = NOW()) AS doctorsOnDuty";
} elseif ($period == 'weekly') {
    $sql = "SELECT 
            (SELECT COUNT(*) FROM appointments WHERE label = 'walk-in' AND WEEK(created_at) = WEEK(NOW())) AS walkInCount,
            (SELECT COUNT(*) FROM appointments WHERE label != 'walk-in' AND WEEK(created_at) = WEEK(NOW())) AS onlineCount,
            (SELECT COUNT(*) FROM appointments WHERE WEEK(created_at) = WEEK(NOW())) AS totalAppointments,
            (SELECT COUNT(*) FROM users WHERE WEEK(created_at) = WEEK(NOW())) AS newPatients,
            (SELECT COUNT(*) FROM doctors WHERE WEEK(created_at) = WEEK(NOW())) AS doctorsOnDuty;";
} elseif ($period == 'monthly') {
    $sql = "SELECT
            (SELECT COUNT(*) FROM appointments WHERE label = 'walk-in' AND MONTH(created_at) = MONTH(NOW())) AS walkInCount,
            (SELECT COUNT(*) FROM appointments WHERE label != 'walk-in' AND MONTH(created_at) = MONTH(NOW())) AS onlineCount,
            (SELECT COUNT(*) FROM appointments WHERE MONTH(created_at) = MONTH(NOW())) AS totalAppointments,
            (SELECT COUNT(*) FROM users WHERE MONTH(created_at) = MONTH(NOW())) AS newPatients,
            (SELECT COUNT(*) FROM doctors WHERE MONTH(created_at) = MONTH(NOW())) AS doctorsOnDuty";
} else {
    $response['error'] = 'Invalid period';
    echo json_encode($response);
    exit;
}

// Run the query
$result = $conn->query($sql);

// Fetch the data
if ($result && $row = $result->fetch_assoc()) {

    if ($period == 'today') {
        $response = [
            'label' => "Today's Overview",
            'scheduleLabel' => "Today's Schedule",
            'walkInCount' => (int)$row['walkInCount'],
            'onlineCount' => (int)$row['onlineCount'],
            'totalAppointments' => (int)$row['totalAppointments'],
            'newPatients' => (int)$row['newPatients'],
            'doctorsOnDuty' => (int)$row['doctorsOnDuty']
        ];
    } elseif ($period == 'weekly') {
        $response = [
            'label' => "Weekly Overview",
            'scheduleLabel' => "This Week's Schedule",
            'walkInCount' => (int)$row['walkInCount'],
            'onlineCount' => (int)$row['onlineCount'],
            'totalAppointments' => (int)$row['totalAppointments'],
            'newPatients' => (int)$row['newPatients'],
            'doctorsOnDuty' => (int)$row['doctorsOnDuty']
        ];
    }elseif ($period == 'monthly') {
        $response = [
            'label' => "Monthly Overview",
            'scheduleLabel' => "This Month's Schedule",
            'walkInCount' => (int)$row['walkInCount'],
            'onlineCount' => (int)$row['onlineCount'],
            'totalAppointments' => (int)$row['totalAppointments'],
            'newPatients' => (int)$row['newPatients'],
            'doctorsOnDuty' => (int)$row['doctorsOnDuty']
        ];
    }
    
}

// Return the response as JSON
echo json_encode($response);