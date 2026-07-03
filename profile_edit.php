<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>プロフィール編集</title>
<link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="mypage-card">
  <h2>プロフィール編集</h2>

  <img src="<?php echo $user['profile_image']; ?>" 
       class="profile-img">

  <form action="profile_update.php" method="post" enctype="multipart/form-data">

    <input type="text" name="username" 
           value="<?php echo htmlspecialchars($user['username']); ?>" 
           placeholder="ユーザー名">

    <input type="file" name="profile_image">

    <button type="submit">更新する</button>
  </form>

  <a href="mypage.php">戻る</a>
</div>

</body>
</html>
