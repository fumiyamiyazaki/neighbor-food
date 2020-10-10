


<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
<title>my_app</title>
<link rel="stylesheet" type="text/css" href="../../css/reset.css">
<link rel="stylesheet" type="text/css" href="../../css/shared.css">
<link rel="stylesheet" type="text/css" href="../../css/new.css">
<script type="text/javascript" src="../../js/jquery.js"></script>
<script>
</script>
</head>
<body>


  <?php require("../shared/_header.php") ?>

  <div class="new_wrapp">

    <div class="new_top">
      <p>新規登録</p>
    </div>

    <div class="new_bottom">
      <!-- ログインフォーム -->
      <form class="new_form" action="" method="post">

        <div>
          <label for="user_name">
            お名前
          </label>
          <input type="text" name="user_name" placeholder="例） 麺太郎">
        </div>

        <div>
          <label for="new_id">
            ユーザーID<span>(メールアドレス)</span>
          </label>
          <input type="text" name="new_id" placeholder="例） neighbor@food.jp">
        </div>

        <div>
          <label for="password">
            パスワード
          </label>
          <input type="text" name="password" placeholder="半角英数字を含めた4文字以上">
        </div>

        <button type="submit" class="new_btn">ログインする</button>
      </form>

    </div>

  </div>
    <p><a href="login.php">ログイン</a></p>



</body>
</html>
