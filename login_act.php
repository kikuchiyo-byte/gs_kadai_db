<?php
session_start();
require_once('db.php');

$email = $_POST['email'];
$password = $_POST['password'];

$sql = "SELECT * FROM users WHERE email = :email";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':email', $email, PDO::PARAM_STR);
$stmt->execute();
$user = $stmt->fetch();

if (!$user) {
    exit("メールアドレスが登録されていません");
}

if ($user['is_verified'] != 1) {
    exit("メール認証が完了していません。メールをご確認ください。");
}

if (!password_verify($password, $user['password'])) {
    exit("パスワードが違います");
}

$_SESSION['chk_ssid'] = session_id();
$_SESSION['user_id'] = $user['id'];
$_SESSION['user_name'] = $user['name'];

header("Location: mypage.php");
exit;
