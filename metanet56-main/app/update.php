<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = intval($_POST["UserID"]);
    $username = $conn->real_escape_string($_POST["Username"]);
    $idnum = $conn->real_escape_string($_POST["idnum"]);
    $email = $conn->real_escape_string($_POST["Email"]);
    $address = $conn->real_escape_string($_POST["address"]);

    // Prepared Statement 사용하여 SQL Injection 방지
    $sql = "UPDATE signup SET Username=?, idnum=?, Email=?, address=? WHERE UserID=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssi", $username, $idnum, $email, $address, $id);

    if ($stmt->execute()) {
        echo "<script>alert('회원 정보가 성공적으로 수정되었습니다.'); window.location.href='index.php';</script>";
    } else {
        echo "<script>alert('수정 실패: " . $conn->error . "'); window.history.back();</script>";
    }

    $stmt->close();
}

$conn->close();
?>
