<?php
include 'db_azure.php';  // Azure RDS 전용 DB 연결

$searchQuery = "";
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["search"])) {
    $search = $conn_azure->real_escape_string($_GET["search"]);
    $searchQuery = "WHERE title LIKE '%$search%' OR author LIKE '%$search%' OR category LIKE '%$search%'";
}

$sql = "SELECT id, title, author, created_at, is_active, category FROM notices $searchQuery ORDER BY created_at DESC";
$result = $conn_azure->query($sql);
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>공지사항 관리</title>
    <link rel="stylesheet" href="style.css"> <!-- 외부 CSS 파일 적용 -->
</head>
<body>

<!-- 사이드바 -->
<div class="sidebar">
    <h2>관리자 메뉴</h2>
    <ul>
        <li><a href="index.php">🏥 메타넷 병원 회원관리</a></li>
        <li><a href="notices.php" style="background: #5cb85c;">📢 공지사항 관리</a></li>
    </ul>
</div>

<!-- 메인 컨텐츠 -->
<div class="content">
    <div class="container">
        <h2>📢 공지사항 목록</h2>

        <!-- 검색 필드 -->
        <div class="search-box">
            <form method="GET" action="notices.php">
                <input type="text" name="search" placeholder="제목, 작성자, 카테고리 검색" value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>">
                <button type="submit">검색</button>
            </form>
            <a href="add_notice.php" class="btn btn-success">📌 공지사항 추가</a>
        </div>

        <table>
            <tr>
                <th>번호</th>
                <th>제목</th>
                <th>작성자</th>
                <th>작성일</th>
                <th>상태</th>
                <th>카테고리</th>
                <th>관리</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $row["id"]; ?></td>
                    <td><?php echo htmlspecialchars($row["title"]); ?></td>
                    <td><?php echo htmlspecialchars($row["author"]); ?></td>
                    <td><?php echo $row["created_at"]; ?></td>
                    <td><?php echo $row["is_active"] ? "✅ 활성" : "❌ 비활성"; ?></td>
                    <td><?php echo htmlspecialchars($row["category"] ?? "없음"); ?></td>
                    <td class="action-links">
                        <a href="edit_notice.php?id=<?php echo $row['id']; ?>" class="edit-btn">수정</a> 
                        <a href="delete_notice.php?id=<?php echo $row['id']; ?>" class="delete-btn" onclick="return confirm('정말 삭제하시겠습니까?');">삭제</a>
                    </td>
                </tr>
            <?php } ?>
        </table>
         <!-- 병원 이미지 추가 -->
        <div class="hospital-image">
            <img src="images/hospital.jpg" alt="병원 전경">
        </div>
    </div>
    </div> <!-- 공지사항 컨테이너 닫기 -->
   
    </div> <!-- 메인 컨텐츠 닫기 -->
    </body>
    
</html>

</div>
    
</body>
</html>
