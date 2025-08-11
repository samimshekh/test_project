<?php
/*
task: samim Aapko top 4 users nikalne hain jo pichhle 90 din me sabse zyada total spend kar chuke hain. Sirf woh orders count hon jo status IN ('paid', 'completed') me aate hain. Sirf un users ko consider karein jinke kam se kam 3 orders hon is period me.
*/ 

require_once 'config.php'; // Include your database connection file
$SQL = "SELECT *, SUM(total_amount) as amount, COUNT(*) as total, GROUP_CONCAT(CONCAT(created_at, '|', total_amount, '|', status) ORDER BY created_at ASC SEPARATOR ',') AS order_summary FROM `orders` GROUP BY user_id HAVING created_at <= DATE_SUB(NOW(), INTERVAL 90 DAY) and status IN ('paid', 'completed') ORDER BY total_amount DESC LIMIT 0,4;"; 
$Result = $DB->query($SQL);
if ($Result && $Result->num_rows > 0) {
    $data = [];
    while ($row = $Result->fetch_assoc()) {
        $data[] = $row; 
    }
    header('Content-Type: application/json');
    echo json_encode($data, JSON_PRETTY_PRINT);
} else {
    header('Content-Type: application/json');
    http_response_code(404);
    echo json_encode(['error' => 'No data found', 'code'=>404], JSON_PRETTY_PRINT);
}
