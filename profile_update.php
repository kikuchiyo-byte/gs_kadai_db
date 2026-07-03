<?php
session_start();
require_once('db.php');

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user_id'];
$username = $_POST['username'];

// 画像アップロード処理
$profile_image_path = null;

if (!empty($_FILES['profile_image']['name'])) {
    $upload_dir = 'img/';
    $file_name = 'profile_' . $user_id . '_' . basename($_FILES['profile_image']['name']);
    $target = $upload_dir . $file_name;

    if (move_uploaded_file($_FILES['profile_image']['tmp_name'], $target)) {
        $profile_image_path = $target;
    }
}

// DB更新
if ($profile_image_path) {
    $sql = "UPDATE users SET username = :username, profile_image = :profile_image WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':profile_image', $profile_image_path);
} else {
    $sql = "UPDATE users SET username = :username WHERE id = :id";
    $stmt = $pdo->prepare($sql);
}

$stmt->bindValue(':username', $username);
$stmt->bindValue(':id', $user_id);
$stmt->execute();

header('Location: mypage.php');
exit();
