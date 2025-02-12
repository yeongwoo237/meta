<?php
include 'db.php';

if (!isset($_GET["id"])) {
    die("잘못된 접근입니다.");
}

$id = intval($_GET["id"]);
$sql = "SELECT * FROM signup WHERE UserID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("회원 정보를 찾을 수 없습니다.");
}

$row = $result->fetch_assoc();
$stmt->close();
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>메타넷 병원 회원 수정</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; background: #f8f9fa; }
        .header-bar { background: #003366; color: white; padding: 15px; text-align: center; font-size: 24px; font-weight: bold; }
        .container { width: 50%; margin: auto; background: rgba(255, 255, 255, 0.95); padding: 20px; border-radius: 10px; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); }
        .form-container { display: flex; flex-direction: column; align-items: center; }
        label { font-weight: bold; width: 100%; text-align: left; margin-bottom: 5px; }
        input { width: 100%; padding: 10px; font-size: 16px; border-radius: 5px; border: 1px solid #ccc; margin-bottom: 15px; }
        .btn { background: #003366; color: white; border: none; cursor: pointer; padding: 10px; font-size: 16px; width: 100%; border-radius: 5px; }
        .btn:hover { background: #002855; }
        .btn-back { background: #6c757d; }
        .btn-delete { background: red; }
    </style>
</head>
<body>

<!-- ✅ 메타넷 병원 회원 수정 -->
<div class="header-bar">메타넷 병원 회원 수정</div>

<div class="container">
    <h2 style="text-align: center;">회원 정보 수정</h2>
    <form id="editForm" class="form-container">
        <input type="hidden" name="UserID" value="<?= $row['UserID'] ?>">

        <label>이름</label>
        <input type="text" name="Username" value="<?= htmlspecialchars($row['Username']) ?>" required>

        <label>주민번호</label>
        <input type="text" name="idnum" value="<?= htmlspecialchars($row['idnum']) ?>" required>

        <label>이메일</label>
        <input type="email" name="Email" value="<?= htmlspecialchars($row['Email']) ?>" required>

        <label>집주소</label>  <!-- ✅ 주소 수정 추가 -->
        <input type="text" name="address" value="<?= htmlspecialchars($row['address']) ?>" required>

        <button type="submit" class="btn">수정</button>
    </form>

    <!-- ✅ 회원 삭제 버튼 -->
    <form action="delete.php" method="GET" onsubmit="return confirm('정말 삭제하시겠습니까?');" class="form-container">
        <input type="hidden" name="id" value="<?= $row['UserID'] ?>">
        <button type="submit" class="btn btn-delete">삭제</button>
    </form>

    <!-- ✅ 회원 목록으로 돌아가는 버튼 -->
    <div style="text-align: center; margin-top: 20px;">
        <a href="index.php"><button class="btn btn-back">회원 목록으로 돌아가기</button></a>
    </div>
</div>

<script>
document.getElementById("editForm").onsubmit = function(event) {
    event.preventDefault();
    let formData = new FormData(this);

    fetch("update.php", {
        method: "POST",
        body: formData
    }).then(response => response.text()).then(data => {
        alert(data);
        window.location.href = "index.php";
    }).catch(error => console.error("오류:", error));
};
</script>

</body>
</html>
<?php $conn->close(); ?>
