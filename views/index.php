<?php

session_start();

 ?>


<!DOCTYPE html>
<html lang="ja">
<head>
<title>my_app</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
<link rel="stylesheet" type="text/css" href="../css/reset.css">
<link rel="stylesheet" type="text/css" href="../css/shared.css">
<link rel="stylesheet" type="text/css" href="../css/index.css">
<link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript" src="../js/jquery-css-transform.js"></script>
<script type="text/javascript" src="../js/rotate3Di.js"></script>
<script>
// window.addEventListener('DOMContentLoaded', function(){
//
//     window.addEventListener('scroll', function(){
//       console.log("縦スクロール：" + window.scrollY);
//     });
//
//   });

  $(function() {
    fadeIn();
    scrollDisplay();
    fadeUp();
    spin();
    scrollTop();
  });

  function fadeIn() {
    const div = document.querySelector('.main_content');
    div.animate([{opacity:'0'}, {opacity:'1'}],2000);
  }

  function scrollDisplay() {
    const nav = document.querySelector('.shared_header');
    const btn = document.querySelector('.index_top-btn');
    nav.style.display = 'none';
    btn.style.display = 'none';
    window.addEventListener('scroll', function(){
      if(window.scrollY > 250) {
        nav.style.display = 'flex';
        btn.style.display = 'block';
      }
    });
  }

  function fadeUp() {
    const intr = document.querySelector('.head_p');
    const intTxt = document.querySelector('.int_text');
    const first_img = document.querySelector('.first_st-img');
    const second_img = document.querySelector('.second_img');
    const third_img = document.querySelector('.third_img');
    const cards = document.querySelectorAll('.step_card');
    const regist_txt = document.querySelector('.regist_fade');
    const account_txt = document.querySelector('.int-blog_btn');
    const his_txt = document.querySelector('.his_txt');
    const his_img = document.querySelector('.his_img');
    window.addEventListener('scroll', function() {
      if(window.scrollY > 580) {
        intr.classList.add('fade_up');
      }
      if(window.scrollY > 847) {
        intTxt.classList.add('fade_up');
      }
      if(window.scrollY > 1200) {
        first_img.classList.add('fade_up');
      }
      if(window.scrollY > 2000) {
        second_img.classList.add('fade_up');
      }
      if(window.scrollY > 2600) {
        third_img.classList.add('fade_up');
      }
      if(window.scrollY >3300) {
        cards[0].animate({opacity:'1'},2500);
        cards[1].animate({opacity:'1'},2500);
        cards[2].animate({opacity:'1'},2500);
      }
      if(window.scrollY > 3400) {
        regist_txt.classList.add('regist_fade-right');
      }
      if(window.scrollY > 3500) {
        account_txt.classList.add('account_fade');
      }
      if(window.scrollY > 3800) {
        his_txt.classList.add('fade_up');
      }
      if(window.scrollY > 4000) {
        his_img.classList.add('his_img-fade');
      }
    })
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

  function scrollTop() {
    $('a[href^=#]').click(function(){
      var speed = 500;
      var href = $(this).attr('href');
      var target = $(href == '#' || href == '' ? 'html':href);
      var position = target.offset().top;
      $('body,html').animate({scrollTop:position},speed,'swing')
      return false;
    });
  }



</script>
</head>
<body>


  <?php require("shared/_header.php"); ?>

  <section>
  <div class="main_content" id="top_page">

    <div class="main_left">
      <h1>neighbor - <span>Food</span></h1>
      <h2 class="about_p">今すぐ行けるラーメン屋を探せる</h2>
      <h3 class="about_text">即行けラーメン検索プラットフォーム</h3>
      <!-- <div class="near_btn"><a href="#">近くのお店</a></div> -->
    </div>

    <div class="main_right">
      <img src="../img/main.jpg" alt="メインの画像" class="right_img">
    </div>

  </div>
  </section>

  <section>
  <div class="introduction">

    <div class="head_int">
      <h2 class="head_p">introduction</h2>
    </div>

    <div class="content_wrapp">

      <div class="int_text">
        <p>neighbor-foodは<br><br>今すぐ行ける、今開店しているラーメン屋が<br><br>
          一目でわかるラーメン屋専門プラットホームです。
        </p>
        <p>
          neighbor-foodを使ば、もう定休日などに惑わされる心配はありません。
        </p>
      </div>

      <!-- first -->
      <div class="first_wrapp">
        <div class="first_img">
          <div class="useage">
            <h3>useage</h3>
          </div>
          <img src="../img/first.png" alt="スマホ登録画像" class="first_st-img">
        </div>
      </div>

      <!-- second -->
      <div class="second_wrapp">
        <div class="second_img">
          <img src="../img/map.png" alt="地図の画像">
          <a href="search_store.php" class="second_search">
            <div class="second_search-box">
              <span><a href="search_store.php">search<i class="fas fa-search"></i></a></span>
            </div>
          </a>
        </div>
      </div>


      <!-- third -->
      <div class="third_wrapp">
        <div class="third_img-wrapp">
          <img src="../img/store2.jpg" alt="お店の画像" class="third_img">
          <div class="usage_int">
            <p><span>neightbor-foodの使い方</span><br><br><br>
              まずはneightbor-foodに会員登録をして下さい。<br><br>
              次に、現在の位置情報を所得し、近くのお店を見つけます。<br><br>
              お店の営業状況を確認したら、お店に向かいましょう。
            </p>
          </div>
        </div>
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
        <p class="regist_fade"><a href="registrations/new.php">← 会員登録</a></p>
      </div>

      <div class="int2_wrapp">

        <div class="blog_wrapp">
          <h3 class="his_txt">history</h3>
          <div class="blog_page">
            <img src="../img/history.png" alt="ブログの画像" class="his_img">
          </div>
          <div class="int2_text">
            <p>neighbor-foodを利用して行ったお店は,<br><br>
              アカウント画面から閲覧できます。</p>
          </div>
        </div>

        <div class="int-blog_btn">
          <p><a href="user_account.php">アカウントページへ →</a></p>
        </div>

      </div>

    </div>
  </div>

  <div class="bottom_img-table"></div>
  </section>

  <div class="index_top-btn">
    <a href="#top_page"><i class="fas fa-arrow-up top_btn"></i></a>
  </div>




  <?php require("shared/_footer.php") ?>








</body>
</html>
