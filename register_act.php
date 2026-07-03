<?php
// エラー表示
ini_set('display_errors', 1);
error_reporting(E_ALL);
// エラー検証終了

session_start();
require_once('db.php');

// 入力値
$name = $_POST['name'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

// ★ まずメールアドレスの重複チェック
$sql = "SELECT COUNT(*) FROM users WHERE email = :email";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':email', $email);
$stmt->execute();
$count = $stmt->fetchColumn();

if ($count > 0) {
    exit("このメールアドレスはすでに登録されています。<br><a href='register.php'>戻る</a>");
}

// 認証用トークン
$token = bin2hex(random_bytes(32));

// 認証URL（ここが重要）
$verify_url = "https://zogo.sakura.ne.jp/verify.php?token=" . $token;

// DB登録
$sql = "INSERT INTO users(name, email, password, verify_token, is_verified, created_at)
        VALUES(:name, :email, :password, :token, 0, NOW())";

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':name', $name);
$stmt->bindValue(':email', $email);
$stmt->bindValue(':password', $password);
$stmt->bindValue(':token', $token);
$stmt->execute();

// PHPMailer 読み込み
require_once(__DIR__ . '/PHPMailer/src/PHPMailer.php');
require_once(__DIR__ . '/PHPMailer/src/SMTP.php');
require_once(__DIR__ . '/PHPMailer/src/Exception.php');

$mail = new PHPMailer\PHPMailer\PHPMailer();

$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->Username = '30.5.1.kikuchiyo@gmail.com';
$mail->Password = 'jqeo jtgg wrto rlxw';
$mail->SMTPSecure = 'tls';
$mail->Port = 587;


// ★ 日本語メールを正しく送るための設定（重要）
$mail->CharSet = 'UTF-8';
$mail->Encoding = 'base64';
// ★ これが本文の文字化けを防ぐ最重要設定
$mail->isHTML(false);

$mail->setFrom('30.5.1.kikuchiyo@gmail.com', 'ZOGO');
$mail->addAddress($email);

// ★ 日本語タイトルが文字化けしない
$mail->Subject = "【ZOGO】メールアドレス認証のお願い";

$mail->Body = "以下のURLをクリックして認証を完了してください。\n\n" . $verify_url;

if ($mail->send()) {
    echo "認証メールを送信しました。メールをご確認ください。";
} else {
    echo "メール送信に失敗しました: " . $mail->ErrorInfo;
}


