<?php
include 'db_azure.php';

$message = "";
$messageClass = "";

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']);

    // DELETE SQL 실행
    $sql = "DELETE FROM notices WHERE id = ?";
    $stmt = $conn_azure->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        $message = "✅ 공지가 성공적으로 삭제되었습니다!";
        $messageClass = "success";
        header("refresh:2;url=notices.php"); // 2초 후 목록으로 이동
    } else {
        $message = "❌ 오류 발생: " . $stmt->error;
        $messageClass = "error";
    }

    $stmt->close();
} else {
    $message = "⚠ 잘못된 요청입니다.";
    $messageClass = "error";
}

$conn_azure->close();
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>공지 삭제 결과</title>
    <link rel="stylesheet" href="style.css"> <!-- 공통 CSS 적용 -->
</head>
<body>

<!-- 사이드바 -->
<div class="sidebar">
    <h2>관리자 메뉴</h2>
    <ul>
        <li><a href="index.php">🏥 메타넷 병원 회원관리</a></li>
        <li><a href="notices.php">📢 공지사항 관리</a></li>
    </ul>
</div>

<!-- 메인 컨텐츠 -->
<div class="content">
    <div class="message-container">
        <p class="<?php echo $messageClass; ?>"><?php echo $message; ?></p>
        <a href="notices.php" class="btn btn-primary">📋 공지 목록으로 이동</a>
    </div>
</div>

</body>
</html>
