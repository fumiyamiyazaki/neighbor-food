<?php

session_start();

require_once ("../../config/config.php");
require_once ("../../model/User.php");

try {
  $user = new User($host, $dbname, $user, $pass);
  $user->connectdb();

  if($_POST) {
    $message = $user->new_validate($_POST);
    if(empty($message['name']) && empty($message['email']) && empty($message['password'])) {
      $user->addUser($_POST);
      $result = $user->lastInsertId();
      $_SESSION['User'] = $result;
      if(isset($_SESSION['User'])) {
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


  <?php require("../shared/_regist_header.php"); ?>

  <div class="new_content-wrapp">

    <div class="new_wrapp">

      <div class="new_top">
        <ul>
          <li>
            <p>新規登録</p>
          </li>
          <li>
            <a href="login.php">ログイン</a>
          </li>
        </ul>
      </div>

      <div class="new_bottom">
        <!-- ログインフォーム -->
        <form class="new_form" name="form" action="" method="post">

          <div>
            <label for="user_name">
              氏名
            </label>
            <input type="text" name="name" placeholder="例） 麺太郎" value="<?php if(isset($result['User'])) echo $result['User']['name']; ?>">
            <?php if(isset($message['name'])) echo "<p clas='error'>".$message['name']."</p>" ?>
          </div>

          <div>
            <label for="new_id">
              ユーザーID<span>(メールアドレス)</span>
            </label>
            <input type="text" name="email" placeholder="例） neighbor@food.jp" value="<?php if(isset($result['User'])) echo $result['User']['email']; ?>">
            <?php if(isset($message['email'])) echo "<p class='error'>".$message['email']."</p>" ?>
          </div>

          <div>
            <label for="password">
              パスワード
            </label>
            <input type="text" name="password" placeholder="半角英数字を含めた4文字以上" value="<?php if(isset($result['User'])) echo $result['User']['password']; ?>">
            <?php if(isset($message['password'])) echo "<p class='error'>".$message['password']."</p>" ?>
          </div>

          <button type="submit" class="new_btn">登録する</button>
        </form>
        <!-- /フォーム -->
      </div>
    </div>

    <div class="store_link-new">
      <p>店舗として登録は<a href="store_new.php">こちら</a></p>
    </div>


  </div>

  <?php require("../shared/_footer.php") ?>



</body>
</html>
