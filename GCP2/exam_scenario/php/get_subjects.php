<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

$host = 'database-1.ctm8u66282ry.ap-northeast-2.rds.amazonaws.com';
$db = 'exam_system';
$user = 'admin';
$pass = 'dkagh1.!';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
    $stmt = $pdo->query('SELECT exam_code, subject_name FROM Subject');
    $subjects = $stmt->fetchAll();
    echo json_encode($subjects);
} catch (PDOException $e) {
    echo json_encode(['error' => "Connection failed: " . $e->getMessage()]);
}
?>
