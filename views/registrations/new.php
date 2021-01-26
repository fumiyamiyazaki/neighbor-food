<?php

session_start();

require_once ("../../config/config.php");
require_once ("../../model/User.php");



try {
  $user = new User($host, $dbname, $user, $pass);
  $user->connectdb();

  if($_POST) {
    $message = $user->new_edit_validate($_POST);
    if(empty($message['name']) && empty($message['email']) && empty($message['password'])) {
      $user->addUser($_POST);
      $result = $user->lastInsertUserId();
      $_SESSION['User'] = $result;
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
<link rel="stylesheet" type="text/css" href="../../css/new.css">
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
            <label for="name">
              氏名
            </label>
            <input type="text" name="name" placeholder="例） 麺太郎" value="<?php if(isset($result['User'])) echo $result['User']['name']; ?>">
            <?php if(isset($message['name'])) echo "<p class='error'>".$message['name']."</p>" ?>
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
            <input type="password" name="password" id="js_pass" placeholder="半角英数字を含めた4文字以上" value="<?php if(isset($result['User'])) echo $result['User']['password']; ?>">
            <span class="pass_icon"><i class="eye_btn fas fa-eye"></i></span>
            <?php if(isset($message['password'])) echo "<p class='error'>".$message['password']."</p>" ?>
          </div>

          <button type="submit" class="new_btn">登録する</button>
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
