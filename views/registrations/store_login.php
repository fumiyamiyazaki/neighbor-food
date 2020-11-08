




<!DOCTYPE html>
<html lang="ja">
<head>
<title>my_app</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
<link rel="stylesheet" type="text/css" href="../../css/reset.css">
<link rel="stylesheet" type="text/css" href="../../css/shared.css">
<link rel="stylesheet" type="text/css" href="../../css/store_login.css">
<script type="text/javascript" src="../../js/jquery.js"></script>
<script>
</script>
</head>
<body>

  <?php require("../shared/_regist_header.php"); ?>

  <div class="store_login_content-wrapp">

    <div class="store_login_wrapp">

      <div class="store_login_top">
        <p>店舗ログイン</p>
      </div>

      <div class="store_login_bottom">
        <!-- ログインフォーム -->
        <form class="store_login_form" action="" method="post">

          <div>
            <label for="login_id">
              店舗ID<span>(メールアドレス)</span>
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
  </div>

  <?php require("../shared/_footer.php"); ?>





</body>
</html>
