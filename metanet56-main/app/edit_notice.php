<?php
include 'db_azure.php';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']);

    // 데이터 가져오기
    $sql = "SELECT * FROM notices WHERE id = ?";
    $stmt = $conn_azure->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
    } else {
        die("❌ 공지사항을 찾을 수 없습니다.");
    }

    $stmt->close();
} else {
    die("⚠ 잘못된 접근입니다.");
}
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>공지 수정</title>
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
    <div class="form-container">
        <h2>✏ 공지 수정</h2>
        <form action="update_notice_process.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $id; ?>">

            <div class="form-group">
                <label>제목:</label>
                <input type="text" name="title" value="<?php echo htmlspecialchars($row['title']); ?>" required>
            </div>

            <div class="form-group">
                <label>내용:</label>
                <textarea name="content" required><?php echo htmlspecialchars($row['content']); ?></textarea>
            </div>

            <div class="form-group">
                <label>작성자:</label>
                <input type="text" name="author" value="<?php echo htmlspecialchars($row['author']); ?>" required>
            </div>

            <div class="form-group">
                <label>카테고리:</label>
                <input type="text" name="category" value="<?php echo htmlspecialchars($row['category']); ?>">
            </div>

            <div class="form-group">
                <label>활성화 여부:</label>
                <input type="checkbox" name="is_active" <?php echo $row["is_active"] ? "checked" : ""; ?>> 활성화
            </div>

            <div class="form-group">
                <button type="submit">수정 완료</button>
            </div>
        </form>
    </div>
</div>

</body>
</html>
