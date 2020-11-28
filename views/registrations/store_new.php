<?php

session_start();

require_once ("../../config/config.php");
require_once ("../../model/Store.php");

try {
  $store = new Store($host, $dbname, $user, $pass);
  $store->connectdb();

  if($_POST) {
    $message = $store->new_validateStore($_POST);
    if(empty($message['name']) && empty($message['postal_code']) && empty($message['addr11']) && empty($message['building_name']) && empty($message['email']) && empty($message['password'])) {
      $store->addStore($_POST);
      $result = $store->lastInsertStoreId();
      $_SESSION['Store'] = $result;
      header('location: ../index.php');
      exit;
    }
  }
}catch(PDOException $e) {
  echo 'データベース接続失敗'.$e->getMessage();
}
// print_r($_SESSION['Store']);

 ?>




<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
<title>my_app</title>
<link rel="stylesheet" type="text/css" href="../../css/reset.css">
<link rel="stylesheet" type="text/css" href="../../css/shared.css">
<link rel="stylesheet" type="text/css" href="../../css/store_new.css">
<script type="text/javascript" src="../../js/jquery.js"></script>
<!-- <script src="https://ajaxzip3.github.io/ajaxzip3.js" charset="UTF-8"></script> -->
<script>
</script>
</head>
<body>


  <?php require("../shared/_regist_header.php"); ?>

  <div class="store_new_content-wrapp">

    <div class="store_new_wrapp">

      <div class="store_new_top">
        <ul>
          <li>
            <p>店舗登録</p>
          </li>
          <li>
            <a href="store_login.php">店舗ログイン</a>
          </li>
        </ul>
      </div>

      <div class="store_new_bottom">
        <!-- ログインフォーム -->
        <form class="store_new_form" name="form" action="" method="post">

          <div>
            <label for="store_name">
              店舗名
            </label>
            <input type="text" name="name" placeholder="例） 麺屋">
            <?php if(isset($message['name'])) echo "<p clas='error'>".$message['name']."</p>" ?>
          </div>

          <div>
            <label for="postal_code">
              郵便番号
            </label>
            <input type="text" name="postal_code" onKeyUp="AjaxZip3.zip2addr(this,'','addr11','addr11');" placeholder="1234567">
            <?php if(isset($message['postal_code'])) echo "<p clas='error'>".$message['postal_code']."</p>" ?>
          </div>

          <div>
            <label for="address">
              都道府県・市区町村・番地
            </label>
            <input type="text" name="address">
            <?php if(isset($message['address'])) echo "<p clas='error'>".$message['address']."</p>" ?>
          </div>

          <div>
            <label for="building_name">
              建物名・号室
            </label>
            <input type="text" name="building_name">
            <?php if(isset($message['building_name'])) echo "<p clas='error'>".$message['building_name']."</p>" ?>
          </div>

          <div>
            <label for="email">
              ユーザーID<span>(メールアドレス)</span>
            </label>
            <input type="text" name="email" placeholder="例） neighbor@food.jp">
            <?php if(isset($message['email'])) echo "<p clas='error'>".$message['email']."</p>" ?>
          </div>

          <div>
            <label for="password">
              パスワード
            </label>
            <input type="text" name="password" placeholder="半角英数字を含めた4文字以上">
            <?php if(isset($message['password'])) echo "<p clas='error'>".$message['password']."</p>" ?>
          </div>

          <button type="submit" class="new_btn">ログインする</button>
        </form>
      </div>
    </div>

    <div class="user_link-new">
      <p>一般ユーザーとして登録は<a href="new.php">こちら</a></p>
    </div>

  </div>

  <?php require("../shared/_footer.php") ?>



</body>
</html>
