<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>会員登録</title>
<link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="login-card">
  <h2>会員登録</h2>

<form action="register_act.php" method="post">
  <input type="text" name="name" placeholder="ユーザー名" required autocomplete="username">
  <input type="email" name="email" placeholder="メールアドレス" required autocomplete="email">
  <input type="password" name="password" placeholder="パスワード" required autocomplete="new-password">
  <button type="submit">登録する</button>
</form>

  <p style="text-align:center; margin-top:10px;">
    <a href="login.php">ログインはこちら</a>
  </p>
</div>

</body>
</html>
