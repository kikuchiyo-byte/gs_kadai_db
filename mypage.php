<?php
session_start();
require_once('db.php');

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT username, email, profile_image FROM users WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $user_id);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>マイページ</title>
<link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="mypage-card">
  <h2>マイページ</h2>

  <img src="<?php echo $user['profile_image']; ?>" 
       alt="プロフィール画像" 
       class="profile-img">

  <div class="mypage-info">
    <p><strong>ユーザー名：</strong> <?php echo htmlspecialchars($user['username']); ?></p>
    <p><strong>メール：</strong> <?php echo htmlspecialchars($user['email']); ?></p>
  </div>

  <a href="profile_edit.php">プロフィールを編集する</a>
</div>

</body>
</html>
