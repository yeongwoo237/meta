<?php
include 'db.php';

$searchQuery = "";
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["search"])) {
    $search = $conn->real_escape_string($_GET["search"]);
    $searchQuery = "WHERE UserID LIKE '%$search%' OR Username LIKE '%$search%' OR idnum LIKE '%$search%' OR Email LIKE '%$search%' OR address LIKE '%$search%'";
}

$sql = "SELECT UserID, Username, idnum, Email, address FROM signup $searchQuery";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>메타넷 병원 회원 관리</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; background: #f8f9fa; }
        .header-bar { background: #003366; color: white; padding: 15px; text-align: center; font-size: 24px; font-weight: bold; display: flex; justify-content: space-between; align-items: center; }
       
        .container { width: 80%; margin: auto; background: rgba(255, 255, 255, 0.95); padding: 20px; border-radius: 10px; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); }
        .search-container { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; padding-bottom: 15px; border-bottom: 2px solid #003366; }
        .search-box { display: flex; align-items: center; width: 60%; }
        .search-box input { flex: 1; padding: 10px; font-size: 16px; border: 1px solid #003366; border-radius: 5px 0 0 5px; }
        .search-box button { padding: 10px 15px; font-size: 16px; border: 1px solid #003366; border-radius: 0 5px 5px 0; background: #003366; color: white; cursor: pointer; }
        .btn-add { padding: 10px 15px; font-size: 16px; border: none; border-radius: 5px; background:rgb(35, 115, 219); color: white; cursor: pointer; }
        .btn-notice { padding: 10px 15px; font-size: 16px; border: none; border-radius: 5px; background:rgb(35, 115, 219); color: white; cursor: pointer; margin-left: 10px; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { padding: 12px; text-align: center; border: 1px solid #ddd; }
        th { background: #003366; color: white; }
        tr:nth-child(even) { background: #f9f9f9; }
    </style>
</head>
<body>

<div class="header-bar">
    <span>메타넷 병원 회원 관리</span>
</div>

<div class="container">
    <div class="search-container">
        <form class="search-box" method="GET" action="index.php">
            <input type="text" name="search" placeholder="회원 ID, 이름, 주민번호, 이메일, 주소 검색" value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>">
            <button type="submit">검색</button>
        </form>
        <div>
            <a href="add.php"><button class="btn-add">회원 추가</button></a>
            <a href="notices.php"><button class="btn-notice">공지사항 보기</button></a>
        </div>
    </div>

    <table>
        <tr>
            <th>회원 ID</th>
            <th>이름</th>
            <th>주민번호</th>
            <th>이메일</th>
            <th>집주소</th>
            <th>수정</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['UserID']}</td>
                        <td>{$row['Username']}</td>
                        <td>{$row['idnum']}</td>
                        <td>{$row['Email']}</td>
                        <td>{$row['address']}</td>
                        <td><a href='edit.php?id={$row['UserID']}'>수정</a></td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='6'>회원 정보가 없습니다.</td></tr>";
        }
        ?>
    </table>
</div>

</body>
</html>
<?php $conn->close(); ?>
