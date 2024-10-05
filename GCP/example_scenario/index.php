<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: text/html");

// 데이터베이스 연결
$host = '127.0.0.1';
$db   = 'exam_db';
$user = 'dasc-sql-aws-exam';
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
} catch (\PDOException $e) {
    echo 'Database connection failed: ' . htmlspecialchars($e->getMessage());
    exit;
}

// 데이터 가져오기
$stmt = $pdo->query('SELECT * FROM Exam_q');
while ($row = $stmt->fetch()) {
    // 데이터베이스에서 가져온 각 컬럼을 변수에 저장
    $questionId = htmlspecialchars($row['question_id']);
    $examCode = htmlspecialchars($row['exam_code']);
    $content = htmlspecialchars($row['content']);
    $A = htmlspecialchars($row['A']);
    $B = htmlspecialchars($row['B']);
    $C = htmlspecialchars($row['C']);
    $D = htmlspecialchars($row['D']);
    $answer = htmlspecialchars($row['answer']);

    echo '<div class="question-item">';
    echo '<h2>Question ID: ' . $questionId . '</h2>';
    echo '<p><strong>Exam Code:</strong> ' . $examCode . '</p>';
    echo '<p><strong>Content:</strong> ' . $content . '</p>';
    echo '<ul>';
    echo '<li><strong>A:</strong> ' . $A . '</li>';
    echo '<li><strong>B:</strong> ' . $B . '</li>';
    echo '<li><strong>C:</strong> ' . $C . '</li>';
    echo '<li><strong>D:</strong> ' . $D . '</li>';
    echo '</ul>';
    echo '<p><strong>Answer:</strong> ' . $answer . '</p>';
    echo '</div>';
}
?>
