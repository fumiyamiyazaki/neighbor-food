<?php

session_start();

require_once ("../../config/config.php");
require_once ("../../model/User.php");

try {
  $user = new User($host, $dbname, $user, $pass);
  $user->connectdb();

  if($_POST) {
    $message = $user->login_validate($_POST);
    if(empty($message['email']) && empty($message['password'])) {
      $result = $user->loginUser($_POST);
      if($_POST['email'] !== @$result['email'] && $_POST['password'] !== @$result['password']) {    // @ エラーハンドラ
        $conf_error = "ユーザーIDもしくはメールアドレスが間違っています。";
      } else {
        $_SESSION['User'] = $result;
        if(!empty($_SESSION['User']) && $_SESSION['User']['role'] == 1) {
          header('location: ../index.php');
          exit;
        }elseif(!empty($_SESSION['User']) && $_SESSION['User']['role'] == 0) {
          header('location: ../administrator_account.php');
          exit;
        }
      }
    }
  }
}catch(PDOException $e) {
  echo 'データベース接続失敗'.$e->getMessage();
}




 ?>


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

  <?php require("../shared/_regist_header.php"); ?>

  <div class="login_content-wrapp">

    <div class="login_wrapp">

      <div class="login_top">
        <ul>
          <li>
            <a href="new.php">新規登録</a>
          </li>
          <li>
            <p>ログイン</p>
          </li>
        </ul>
      </div>

      <div class="login_bottom">
        <!-- ログインフォーム -->
        <form class="login_form" name="form" action="" method="post">

          <div>
            <label for="login_id">
              ユーザーID<span>(メールアドレス)</span>
            </label>
            <input type="text" name="email" placeholder="例） neighbor@food.jp">
            <?php if(isset($message['email'])) echo "<p class='error'>".$message['email']."</p>" ?>
          </div>

          <div>
            <label for="password">
              パスワード
            </label>
            <input type="text" name="password" placeholder="半角英数字を含めた4文字以上">
            <?php if(isset($message['password'])) echo "<p class='error'>".$message['password']."</p>" ?>
          </div>
          <?php if(isset($conf_error)) echo "<p class='error'>".$conf_error."</p>" ?>

          <button type="submit" class="login_btn">ログインする</button>
        </form>
        <!-- /フォーム -->
      </div>

    </div>

    <!-- <div class="store_link-login">
      <p>店舗として登録は<a href="store_login.php">こちら</a></p>
    </div> -->


  </div>

  <?php require("../shared/_footer.php"); ?>





</body>
</html>
