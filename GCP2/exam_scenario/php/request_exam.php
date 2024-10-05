<?php
// 데이터베이스 연결
$servername = 'database-1.ctm8u66282ry.ap-northeast-2.rds.amazonaws.com';
$username = 'admin';
$password = 'dkagh1.!';
$dbname = 'exam_system';

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// 폼 데이터 수신
$email = $_POST['email'];
$user_name = $_POST['user_name'];
$exam_code = $_POST['exam_code'];
$test_date = $_POST['test_date'];

// 데이터베이스에 데이터 삽입
$sql = "INSERT INTO Candidate (email, user_name, exam_code, test_date) VALUES ('$email', '$user_name', '$exam_code', '$test_date')";

if ($conn->query($sql) === TRUE) {
    $exam_id = $conn->insert_id; // 삽입된 행의 ID 가져오기
    echo "시험신청 완료. Exam ID: " . $exam_id;
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
