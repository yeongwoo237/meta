<?php
// health.php - 서비스 상태 점검

$servername = "192.168.100.108";  // MySQL 서버 IP 주소
$username = "bluebird_user";      // MySQL 사용자명
$password = "password";           // MySQL 비밀번호
$dbname = "bluebirdhotel";        // MySQL 데이터베이스 이름

// MySQL 데이터베이스에 연결
$conn = new mysqli($servername, $username, $password, $dbname);

// 연결 실패 시
if ($conn->connect_error) {
    echo "DB 연결 실패: " . $conn->connect_error;
    http_response_code(500);  // 오류 상태 코드 반환
    exit();
}

// 연결이 성공하면 "Healthy" 반환
echo "Healthy";
http_response_code(200);  // 성공 상태 코드 반환

$conn->close();
?>

