<?php
$servername = "localhost";
$username = "bluebird_user";
$password = "password";
$dbname = "bluebirdhotel";
$port = 3306;

try {
    // MySQL 연결
    $conn = new mysqli($servername, $username, $password, $dbname, $port);
    $conn->set_charset("utf8mb4"); // 문자 인코딩 설정
} catch (Exception $e) {
    die(" DB 연결 실패: " . $e->getMessage());
}
?>