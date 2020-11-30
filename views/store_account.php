<?php

session_start();

require_once ("../config/config.php");
require_once ("../model/Store.php");

try {
  $store = new Store($host, $dbname, $user, $pass);
  $store->connectdb();

  // アカウント画像を登録
  if($_FILES && isset($_SESSION['Store'])) {
    $store_id = $_SESSION['Store']['id'];
    $imgdir = '../store_image/';
    $image = date('YmdHis') . $_FILES['img']['name'];
    move_uploaded_file($_FILES['img']['tmp_name'], $imgdir . $image);
    $store->insertImg($image, $store_id);
    // $_SESSION['Store']['img'] = $image
  }

  if(isset($_SESSION['Store'])) {
    $store_id = $_SESSION['Store']['id'];
    $result['Store'] = $store->findByStoreId($store_id);
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
<link rel="stylesheet" type="text/css" href="../css/store_account.css">
<link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
<script type="text/javascript" src="../js/jquery.js"></script>
<script>
</script>
</head>
<body>

  <?php require("shared/_header.php"); ?>

  <div class="store_account-wrapp">

    <!-- side_bar -->
    <div class="store_side-bar">
      <div class="store_nav">
        <ul>
          <li>
            <a href="index.php">ホーム</a>
          </li>
          <li>
            プロフィール
          </li>
          <li>
            ブログを投稿する
          </li>
          <li>
            アカウントを削除する
          </li>
          <li>
          </li>
        </ul>
      </div>

    </div>

    <!-- main_content -->
    <div class="store_main-content">

      <div class="store_main-pict">
        <div class="pict_flame">

          <?php if(empty($result['Store']['image'])): ?>
            <form class="store_img-form" action="" enctype="multipart/form-data" method="post">

              <div class="store_imgup">
                <label for="imgfile_input">
                  <i class="fas fa-plus-circle"></i>
                </label>
                <input type="file" name="img" accept="image/*" id="imgfile_input">
              </div>

              <input type="submit" value="送信">

            </form>
          <?php else: ?>
            <?php $dir = "../store_image/"; ?>
            <img src="<?php echo $dir.$result['Store']['image']; ?>" alt="お店の画像">
          <?php endif; ?>


        </div>
      </div>

      <div class="store_sub-cont">

        <div class="store_profile">
          <p class="store_name"><?php echo $result['Store']['name']; ?></p>
          <p class="store_locate"><?php echo $result['Store']['address'].$result['Store']['building_name'] ?></p>
        </div>

        <div class="fav_icon">
          <img src="../img/fav.png" alt="ハートのアイコン">
        </div>

      </div>

      <!-- article -->
      <div class="store_articles">
        <!-- for文またはwhile文で回す -->
        <div class="store_article new_article">
          <img src="../img/plus.png" alt="＋のアイコン">
          <p>記事の作成</p>
        </div>
        <div class="store_article">

        </div>
        <div class="store_article">

        </div>
        <div class="store_article">

        </div>
        <div class="store_article">

        </div>


      </div>

    </div>

  </div>

  <?php require("shared/_footer.php") ?>









</body>
</html>
