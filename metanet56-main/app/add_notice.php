<?php include 'db_azure.php'; ?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>공지 추가</title>
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
        <h2>📌 공지 추가</h2>
        <form action="add_notice_process.php" method="POST">
            <div class="form-group">
                <label>제목:</label>
                <input type="text" name="title" required>
            </div>

            <div class="form-group">
                <label>내용:</label>
                <textarea name="content" required></textarea>
            </div>

            <div class="form-group">
                <label>작성자:</label>
                <input type="text" name="author" required>
            </div>

            <div class="form-group">
                <label>카테고리:</label>
                <input type="text" name="category">
            </div>

            <div class="form-group">
                <label>활성화 여부:</label>
                <input type="checkbox" name="is_active" checked> 활성화
            </div>

            <div class="form-group">
                <button type="submit">등록</button>
            </div>
        </form>
    </div>
</div>

</body>
</html>
