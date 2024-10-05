<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $name = $_POST['name'];
    $date = date('Y-m-d H:i:s');

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

        $stmt = $pdo->prepare("INSERT INTO User (email, user_name, user_password, sudscription_date) VALUES (?, ?, ?, ?)");
        $stmt->execute([$email, $name, $password, $date]);

        echo "Signup successful!";
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
}
?>

