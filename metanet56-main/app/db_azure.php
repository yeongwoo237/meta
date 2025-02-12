<?php
$servername = "database-4.cbci4a0663pd.ap-northeast-3.rds.amazonaws.com";
$username = "admin";
$password = "ASDQdas123!";
$dbname = "hospital";
$port = 3306;

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    $conn_azure = new mysqli($servername, $username, $password, $dbname, $port);
    $conn_azure->set_charset("utf8mb4");
} catch (Exception $e) {
    die(" Azure RDS 연결 실패: " . $e->getMessage());
}
?>
