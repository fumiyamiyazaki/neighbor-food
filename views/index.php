


<!DOCTYPE html>
<html lang="ja">
<head>
<title>my_app</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
<link rel="stylesheet" type="text/css" href="../css/reset.css">
<link rel="stylesheet" type="text/css" href="../css/index.css">
<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript" src="../js/jquery-css-transform.js"></script>
<script type="text/javascript" src="../js/rotate3Di.js"></script>
<script>
  $(function() {
    hover();
    spin();
    btn_man();
  });

  function hover() {
    $(".store-img_front").hover(function() {
      $(this).css("display", "none");
      $(".store-img_back").fadeIn(2000);
    });
  }

  function spin() {
    $('#card').hover(
    function () {$(this).rotate3Di('flip', 500);},
    function () {$(this).rotate3Di('unflip', 500);}
    );
    $('#card2').hover(
    function () {$(this).rotate3Di('flip', 500);},
    function () {$(this).rotate3Di('unflip', 500);}
    );
    $('#card3').hover(
    function () {$(this).rotate3Di('flip', 500);},
    function () {$(this).rotate3Di('unflip', 500);}
    );
  }

  function btn_man() {
    $(".step_btn").hover(function() {
      $(".btn_man1").css("display", "flex");
    });
    $(".int-blog_btn").hover(function() {
      $(".btn_man2").css("display", "flex").animate({"right":"-20vw"},1000, function() {
        $(".btn_man2").fadeOut(2000);
      });
    });
    $(".int-store_btn").hover(function() {
      $(".btn_man3").css("display", "flex").animate({"right":"10vw"},1000, function() {
        $(".btn_man3").fadeOut(2000);
      });
    });
  }
</script>
</head>
<body>




  <section>
  <div class="main_content">

    <div class="main_left">
      <h1>neighbor - <span>Food</span></h1>
      <h2 class="about_p">今すぐ行けるラーメン屋を探せる</h2>
      <h3 class="about_text">即行けラーメン検索プラットフォーム</h3>
      <div class="near_btn"><a href="#">近くのお店</a></div>
    </div>

    <div class="main_right">
      <img src="../img/main.jpg" alt="メインの画像" class="right_img">
      <div class="regist_link">
        <p><a href="registrations/new.php">新規登録</a></p>
        /
        <p><a href="registrations/login.php">ログイン</a></p>
      </div>
    </div>

  </div>
  </section>

  <section>
  <div class="introduction">

    <div class="head_int">
      <img src="../img/flame.png" alt="暖簾の画像" class="flame_img">
      <h2 class="head_p">introduction</h2>
    </div>

    <div class="content_wrapp">

      <div class="int_text">
        <h3>heighbor-foodは今すぐ行ける、今開店しているラーメン屋が一目でわかる<br>
          ラーメン屋専門プラットホームです。</h3>
      </div>

      <div class="step_wrapp">
        <ul class="step">
          <!-- step1 -->
          <li class="step_card" id="card">
            <div class="step_img">
              <img src="../img/step1.png" alt="step1の画像">
            </div>
            <div class="step_text">
              <h4>STEP1</h4>
              <p>neigbor-foodに会員登録</p>
            </div>
          </li>
          <!-- step2 -->
          <li class="step_card" id="card2">
            <div class="step_img">
              <img src="../img/step2.png" alt="ste2の画像">
            </div>
            <div class="step_text">
              <h4>STEP2</h4>
              <p>位置情報から近くのラーメン屋情報を所得</p>
            </div>
          </li>
          <!-- step3 -->
          <li class="step_card" id="card3">
            <div class="step_img">
              <img src="../img/step3.png" alt="step3の画像">
            </div>
            <div class="step_text">
              <h4>STEP3</h4>
              <p>すぐに行けるラーメン屋へGO</p>
            </div>
          </li>
        </ul>
      </div>

      <div class="step_btn">
        <p><a href="registrations/new.php">会員登録する</a></p>
        <div class="btn_man1">
          <img src="../img/btn_man1.png" alt="人の画像">
        </div>
      </div>

      <div class="int2_wrapp">

        <div class="int2_text">
          <h3>neighbor-foodに登録しているお店のブログが読める</h3>
          <p>お得な情報が掲載されているかも</p>
        </div>

        <div class="int_bottom">
          <div class="int-img_wrapp">
            <div class="int2_img">
              <img src="../img/blog.png" alt="携帯ブログの画像">
            </div>
            <div class="int-blog_btn">
              <p><a href="#">ブログを見に行く</a></p>
              <div class="btn_man2">
                <img src="../img/btn_man2.png" alt="人の画像" class="btn_man2">
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>
  </div>
  </section>

  <section>
  <div class="int-store_wrapp">

    <div class="store_head">
      <h3>店側として登録すると、お店の情報やブログを掲載し、広告としても利用できる</h3>
    </div>

    <div class="store-content_wrapp">

      <div class="store-img_front">
        <img src="../img/store_pict0.png" alt="人の画像" class="store-man_img">
      </div>

      <div class="store-img_back">
        <div class="store-img_wrapp">
          <div class="store-img_top">
            <img src="../img/store_pict1.png" alt="スマホ写真" class="store-phone_img">
          </div>

          <div class="store-img_middle">
            <img src="../img/store_pict2.png" alt="メッセージ写真" class="store-message_img">
          </div>

          <div class="store-img_bottom">
            <img src="../img/store_pict4.png" alt="PC写真" class="store-pc_img">
          </div>
        </div>

      </div>

    </div>

    <div class="int-store_btn">
      <p><a href="#">店側として会員登録する</a></p>
      <div class="btn_man3">
        <img src="../img/btn_man3.png" alt="人の画像" class="btn_man3">
      </div>
    </div>

  </div>
  </section>





</body>
</html>
