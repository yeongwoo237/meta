<?php
$servername = "metadbserver.mysql.database.azure.com";
$username = "meta";
$password = "ABcd1234!";
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
