


<!DOCTYPE html>
<html lang="ja">
<head>
<title>my_app</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
<link rel="stylesheet" type="text/css" href="../../css/reset.css">
<link rel="stylesheet" type="text/css" href="../../css/shared.css">
<link rel="stylesheet" type="text/css" href="../../css/login.css">
<script type="text/javascript" src="../../js/jquery.js"></script>
<script>
</script>
</head>
<body>

  <?php require("../shared/_header.php") ?>

    <div class="login_wrapp">

      <div class="login_top">
        <p>ログイン</p>
      </div>

      <div class="login_bottom">
        <!-- ログインフォーム -->
        <form class="login_form" action="" method="post">

          <div>
            <label for="login_id">
              ユーザーID<span>(メールアドレス)</span>
            </label>
            <input type="text" name="login_id" placeholder="例） neighbor@food.jp">
          </div>

          <div>
            <label for="password">
              パスワード
            </label>
            <input type="text" name="password" placeholder="半角英数字を含めた4文字以上">
          </div>

          <button type="submit" class="login_btn">ログインする</button>
        </form>

      </div>

    </div>
    <!-- <p><a href="new.php">新規登録</a></p> -->


</body>
</html>
