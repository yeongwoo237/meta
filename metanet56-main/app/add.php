<?php
include 'db.php';

$error_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = htmlspecialchars(trim($_POST["username"]));
    $idnum = htmlspecialchars(trim($_POST["idnum"]));
    $email = htmlspecialchars(trim($_POST["email"]));
    $password = password_hash(trim($_POST["password"]), PASSWORD_BCRYPT); // 비밀번호 해싱
    $address = htmlspecialchars(trim($_POST["address"]));

    if (empty($username) || empty($idnum) || empty($email) || empty($password) || empty($address)) {
        $error_message = "⚠️ 모든 필드를 입력해야 합니다.";
    } else {
        $stmt = $conn->prepare("INSERT INTO signup (Username, idnum, Email, Password, address) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $username, $idnum, $email, $password, $address);

        if ($stmt->execute()) {
            echo "<script>window.location.href='index.php';</script>"; // 성공 시 목록으로 이동
            exit;
        } else {
            $error_message = "⚠️ 회원 추가 실패: " . $conn->error;
        }

        $stmt->close();
    }
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>메타넷 병원 회원 추가</title>
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

        /* ✅ 오류 메시지 스타일 */
        .error-box {
            background: #ff4d4d;
            color: white;
            padding: 15px;
            text-align: center;
            font-weight: bold;
            border-radius: 5px;
            margin-bottom: 15px;
            width: 100%;
        }
    </style>
</head>
<body>

<!-- ✅ 메타넷 병원 회원 추가 -->
<div class="header-bar">메타넷 병원 회원 추가</div>

<div class="container">
    <h2 style="text-align: center;">회원 추가</h2>

    <!-- ✅ PHP 오류 메시지 한 번만 표시 -->
    <?php if (!empty($error_message)) { ?>
        <div class="error-box"><?= htmlspecialchars($error_message) ?></div>
    <?php } ?>

    <form class="form-container" action="add.php" method="POST">
        <label>이름</label>
        <input type="text" name="username" required>

        <label>주민번호</label>
        <input type="text" name="idnum" placeholder="예: 920101-1234567" required>

        <label>이메일</label>
        <input type="email" name="email" required>

        <label>비밀번호</label>
        <input type="password" name="password" required>

        <label>집주소</label>  <!-- ✅ 주소 입력 추가 -->
        <input type="text" name="address" placeholder="예: 서울특별시 강남구 테헤란로 123" required>

        <button type="submit" class="btn">회원 추가</button>
    </form>

    <!-- ✅ 회원 목록으로 돌아가는 버튼 -->
    <div style="text-align: center; margin-top: 20px;">
        <a href="index.php"><button class="btn btn-back">회원 목록으로 돌아가기</button></a>
    </div>
</div>

</body>
</html>
