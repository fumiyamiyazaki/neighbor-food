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

  if(isset($_GET['del'])) {
    $user->delete($_GET['del']);
    $_SESSION = array();
    session_destroy();
    header('location: ../index.php');
    exit;
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
<link rel="stylesheet" type="text/css" href="../../css/delete.css">
<script type="text/javascript" src="../../js/jquery.js"></script>
<script>
</script>
</head>
<body>


  <?php require("../shared/_regist_header.php"); ?>

  <div class="delete_content-wrapp">

    <div class="delete_wrapp">

      <div class="delete_top">
        <ul>
          <li>
            <p>退会</p>
          </li>
        </ul>
      </div>

      <div class="delete_bottom">
        <div class="delete_btn">
          <a href="?del=<?php echo $_SESSION['User']['id'] ?>" onclick="if(!confirm('ID<?php echo $_SESSION['User']['id'].$_SESSION['User']['name'] ?>さんのユーザーを削除しますか？')) return false;">削除</a>
        </div>

      </div>
    </div>

    <!-- <div class="store_link-new">
      <p>店舗として登録は<a href="store_new.php">こちら</a></p>
    </div> -->


  </div>

  <?php require("../shared/_footer.php") ?>



</body>
</html>
