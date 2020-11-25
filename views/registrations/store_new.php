

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
<script src="https://ajaxzip3.github.io/ajaxzip3.js" charset="UTF-8"></script>
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
        <form class="store_new_form" action="" method="post">

          <div>
            <label for="user_name">
              店舗名
            </label>
            <input type="text" name="user_name" placeholder="例） 麺太郎">
          </div>

          <div>
            <label for="postal_code">
              郵便番号
            </label>
            <input type="text" name="zip11" onKeyUp="AjaxZip3.zip2addr(this,'','addr11','addr11');" placeholder="1234567">
          </div>

          <div>
            <label for="address">
              都道府県・市区町村・番地
            </label>
            <input type="text" name="addr11">
          </div>

          <div>
            <label for="building_name">
              建物名・号室
            </label>
            <input type="text" name="building_name">
          </div>

          <div>
            <label for="new_id">
              ユーザーID<span>(メールアドレス)</span>
            </label>
            <input type="text" name="new_id" placeholder="例） neighbor@food.jp">
          </div>

          <div>
            <label for="password">
              パスワード
            </label>
            <input type="text" name="password" placeholder="半角英数字を含めた4文字以上">
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
