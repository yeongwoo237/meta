<?php
include 'db.php'; // DB 연결

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
    $id = intval($_GET["id"]); // ID를 정수로 변환하여 SQL Injection 방지

    // 해당 회원 존재 여부 확인
    $stmt = $conn->prepare("SELECT UserID FROM signup WHERE UserID = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        die("회원 정보를 찾을 수 없습니다.");
    }

    // 회원 삭제 쿼리 실행
    $stmt = $conn->prepare("DELETE FROM signup WHERE UserID = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "<script>alert('회원 정보가 삭제되었습니다.'); window.location.href='index.php';</script>";
    } else {
        echo "삭제 실패: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
} else {
    die("잘못된 접근입니다.");
}
?>

