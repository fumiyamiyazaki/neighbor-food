<?php

session_start();

require_once ("../../config/config.php");
require_once ("../../model/Store.php");

try {
  $store = new Store($host, $dbname, $user, $pass);
  $store->connectdb();

  if($_POST) {
    $message = $store->login_validateStore($_POST);
    if(empty($message['email']) && empty($message['password'])) {
      $result = $store->loginStore($_POST);
      $_SESSION['Store'] = $result;
      if(!empty($_SESSION['Store'])) {
        header('location: ../index.php');
        exit;
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
        <ul>
          <li>
            <a href="store_new.php">店舗登録</a>
          </li>
          <li>
            <p>店舗ログイン</p>
          </li>
        </ul>
      </div>

      <div class="store_login_bottom">
        <!-- ログインフォーム -->
        <form class="store_login_form" action="" method="post">

          <div>
            <label for="email">
              店舗ID<span>(メールアドレス)</span>
            </label>
            <input type="text" name="email" placeholder="例） neighbor@food.jp">
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

    <div class="user_link-login">
      <p>一般ユーザーとして登録は<a href="new.php">こちら</a></p>
    </div>


  </div>

  <?php require("../shared/_footer.php"); ?>





</body>
</html>
