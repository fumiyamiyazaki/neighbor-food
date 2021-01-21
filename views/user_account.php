<?php

session_start();

require_once ("../config/config.php");
require_once ("../model/User.php");



// ログイン画面を経由したか,一般ユーザーか判定
if(!isset($_SESSION['User']) || $_SESSION['User']['role'] != 1) {
  header('location: /my_app/views/registrations/new.php');
  exit;
}

try {
  $user = new User($host, $dbname, $user, $pass);
  $user->connectdb();

  if(isset($_SESSION['User'])) {
    $user_id = $_SESSION['User']['id'];
    $result['user'] = $user->findById($user_id);
    $history = $user->findHistory($user_id);


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
<link rel="stylesheet" type="text/css" href="../css/reset.css">
<link rel="stylesheet" type="text/css" href="../css/shared.css">
<link rel="stylesheet" type="text/css" href="../css/user_account.css">
<link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
<script type="text/javascript" src="../js/jquery.js"></script>
<script>
</script>
</head>
<body>

  <?php require("shared/_header.php"); ?>

  <div class="u_account-wrapp">

    <div class="u_account-content">

      <div class="u_profile">
        <p class="u_name"><?php echo $result['user']['name'] ?></p>
        <p class="u_email"><?php echo $result['user']['email'] ?></p>
        <div class="u_edit">
          <i class="far fa-user"></i>
          <a href="registrations/edit.php">編集</a>
          <a href="registrations/delete.php">退会</a>
        </div>
      </div>

      <div class="fav_stores">
        <ul class="fav_s-wrapp">

          <!-- お気に入り店一覧 for文で回す -->
          <?php foreach($history as $row): ?>
            <?php
            $cipher = 'aes-128-ecb';
            $key = 'key';
            $row['img'] = openssl_decrypt($row['img'], $cipher, $key);
            ?>
            <li class="fav_s-flame">
              <p class="went_time"><?=$row['created_at']?></p>
              <div class="fav_s">

                <div class="fav_s-img">
                  <img src="<?=$row['img']?>" alt="お店の写真">
                </div>

                <div class="fav_s-info">
                  <p class="fav_s-name"><span><?=$row['history_name']?></span><br><?=$row['vicinity']?></p>
                </div>


              </div>
            </li>
          <?php endforeach; ?>
          <!--  -->







        </ul>



      </div>

    </div>

  </div>








  <?php require("shared/_footer.php") ?>

</body>
</html>
