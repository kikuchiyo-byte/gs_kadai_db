<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>ログイン</title>
<link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="login-card">
  <h2>ログイン</h2>

  <form action="login_act.php" method="post">
<input type="email" name="email" placeholder="メールアドレス" required autocomplete="username">
<input type="password" name="password" placeholder="パスワード" required autocomplete="current-password">

    <button type="submit">ログイン</button>
  </form>

  <p style="text-align:center; margin-top:10px;">
    <a href="register.php">会員登録はこちら</a>
  </p>
</div>

</body>
</html>
