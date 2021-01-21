<?php
session_start();

require_once ("../../config/config.php");
require_once ("../../model/User.php");

// ログイン画面を経由したか,一般ユーザーか判定
if(!isset($_SESSION['User']) || $_SESSION['User']['role'] != 1) {
  header('location: ../index.php');
  exit;
}


try {
  $user = new User($host, $dbname, $user, $pass);
  $user->connectdb();

  // 編集処理
  if($_POST) {
    $message = $user->new_edit_validate($_POST);
    if(empty($message['name']) && empty($message['email']) && empty($message['password'])) {
      $user->edit($_POST);
      if(!empty($_SESSION['User'])) {
        header('location: ../user_account.php');
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
<link rel="stylesheet" type="text/css" href="../../css/edit.css">
<link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
<script type="text/javascript" src="../../js/jquery.js"></script>
<script>
$(function() {
  passVisible();
});

function passVisible() {
  $(".eye_btn").click(function() {
    if($(this).hasClass("fas fa-eye")) {
      $(this).removeClass("fas fa-eye");
      $(this).addClass("fas fa-eye-slash");
    }else if ($(this).hasClass("fas fa-eye-slash")) {
      $(this).removeClass("fas fa-eye-slash");
      $(this).addClass("fas fa-eye");
    }

    var input = document.querySelector('#js_pass');
    if(input.getAttribute("type") == "password") {
      input.setAttribute("type", "text");
    }else {
      input.setAttribute("type", "password");
    }
  })
}


</script>
</head>
<body>


  <?php require("../shared/_header.php"); ?>

  <div class="edit_content-wrapp">

    <div class="edit_wrapp">

      <div class="edit_top">
        <ul>
          <li>
            <p>情報編集</p>
          </li>
        </ul>
      </div>

      <div class="edit_bottom">
        <!-- ログインフォーム -->
        <form class="edit_form" name="form" action="" method="post">
          <input type="hidden" name="id" value="<?php if(isset($_SESSION['User'])) echo $_SESSION['User']['id']; ?>">
          <div>
            <label for="name">
              氏名
            </label>
            <input type="text" name="name" placeholder="例） 麺太郎" value="<?php if(isset($_SESSION['User'])) echo $_SESSION['User']['name']; ?>">
            <?php if(isset($message['name'])) echo "<p class='error'>".$message['name']."</p>" ?>
          </div>

          <div>
            <label for="edit_id">
              ユーザーID<span>(メールアドレス)</span>
            </label>
            <input type="text" name="email" placeholder="例） neighbor@food.jp" value="<?php if(isset($_SESSION['User'])) echo $_SESSION['User']['email']; ?>">
            <?php if(isset($message['email'])) echo "<p class='error'>".$message['email']."</p>" ?>
          </div>

          <div>
            <label for="password">
              パスワード
            </label>
            <input type="password" name="password" id="js_pass" placeholder="半角英数字を含めた4文字以上" value="<?php if(isset($_SESSION['User'])) echo $_SESSION['User']['password']; ?>">
            <span class="pass_icon"><i class="eye_btn fas fa-eye"></i></span>
            <?php if(isset($message['password'])) echo "<p class='error'>".$message['password']."</p>" ?>
          </div>

          <button type="submit" class="edit_btn">登録する</button>
        </form>
        <!-- /フォーム -->
      </div>
    </div>

    <!-- <div class="store_link-new">
      <p>店舗として登録は<a href="store_new.php">こちら</a></p>
    </div> -->


  </div>

  <?php require("../shared/_footer.php") ?>



</body>
</html>
