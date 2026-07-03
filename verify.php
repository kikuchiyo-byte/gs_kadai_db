<?php
require_once('db.php');

$token = $_GET['token'];

$sql = "SELECT * FROM users WHERE verify_token = :token";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':token', $token, PDO::PARAM_STR);
$stmt->execute();
$user = $stmt->fetch();

if (!$user) {
    exit("無効なトークンです");
}

$sql = "UPDATE users SET is_verified = 1 WHERE verify_token = :token";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':token', $token, PDO::PARAM_STR);
$stmt->execute();

echo "メール認証が完了しました。ログインできます。<br>";
echo '<a href="login.php">ログインページへ</a>';
