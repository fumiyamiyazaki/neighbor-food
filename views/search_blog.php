





<!DOCTYPE html>
<html lang="ja">
<head>
<title>my_app</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
<link rel="stylesheet" type="text/css" href="../css/reset.css">
<link rel="stylesheet" type="text/css" href="../css/shared.css">
<link rel="stylesheet" type="text/css" href="../css/search_blog.css">
<link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
<script type="text/javascript" src="../js/jquery.js"></script>
<script>

$(function() {
  scrollTop();
});


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

  <div class="search_wrapp">

    <div class="search_header" id="top_page">
      <img src="../img/search.png" alt="ラーメンの画像">
      <h1>stores-blog</h1>

      <div class="search_form-wrapp">
        <form class="search_form" action="#" method="#">
          <input type="search" name="search" value="" class="search_input" placeholder="店名、二郎系、スープ">
          <button type="submit" class="search_btn"><i class="fas fa-search"></i></button>
        </form>
      </div>

    </div>

    <div class="blog_content-wrapp">

      <div class="side_nav">
        <ul>
          <li></li>
          <li></li>
        </ul>
      </div>

      <ul class="blog_wrapp">
        <!-- for文で回す -->
        <li class="blog_content">
          <a href="#">
            <div class="blog_img-wrapp">
              <img src="../img/main.jpg" class="blog_img-pict" alt="ブログの写真">
            </div>
            <div class="blog_info-wrapp">
              <p class="store_name-blog">aaaa</p>
              <p class="created_blog">2020-10-29</p>
            </div>
            <div class="sentence_wrapp">
              <p class="sentence_blog">濃厚スープのラーメン</p>
            </div>
          </a>
        </li>
        <!--  -->
        <li class="blog_content">
          <a href="#">
            <div class="blog_img-wrapp">
              <img src="../img/main.jpg" class="blog_img-pict" alt="ブログの写真">
            </div>
            <div class="blog_info-wrapp">
              <p class="store_name-blog">aaaa</p>
              <p class="created_blog">2020-10-29</p>
            </div>
            <div class="sentence_wrapp">
              <p class="sentence_blog">濃厚スープのラーメン</p>
            </div>
          </a>
        </li>
        <li class="blog_content">
          <a href="#">
            <div class="blog_img-wrapp">
              <img src="../img/main.jpg" class="blog_img-pict" alt="ブログの写真">
            </div>
            <div class="blog_info-wrapp">
              <p class="store_name-blog">aaaa</p>
              <p class="created_blog">2020-10-29</p>
            </div>
            <div class="sentence_wrapp">
              <p class="sentence_blog">濃厚スープのラーメン</p>
            </div>
          </a>
        </li>
        <li class="blog_content">
          <a href="#">
            <div class="blog_img-wrapp">
              <img src="../img/main.jpg" class="blog_img-pict" alt="ブログの写真">
            </div>
            <div class="blog_info-wrapp">
              <p class="store_name-blog">aaaa</p>
              <p class="created_blog">2020-10-29</p>
            </div>
            <div class="sentence_wrapp">
              <p class="sentence_blog">濃厚スープのラーメン</p>
            </div>
          </a>
        </li>
        <li class="blog_content">
          <a href="#">
            <div class="blog_img-wrapp">
              <img src="../img/main.jpg" class="blog_img-pict" alt="ブログの写真">
            </div>
            <div class="blog_info-wrapp">
              <p class="store_name-blog">aaaa</p>
              <p class="created_blog">2020-10-29</p>
            </div>
            <div class="sentence_wrapp">
              <p class="sentence_blog">濃厚スープのラーメン</p>
            </div>
          </a>
        </li>
        <li class="blog_content">
          <a href="#">
            <div class="blog_img-wrapp">
              <img src="../img/main.jpg" class="blog_img-pict" alt="ブログの写真">
            </div>
            <div class="blog_info-wrapp">
              <p class="store_name-blog">aaaa</p>
              <p class="created_blog">2020-10-29</p>
            </div>
            <div class="sentence_wrapp">
              <p class="sentence_blog">濃厚スープのラーメン</p>
            </div>
          </a>
        </li>
        <li class="blog_content">
          <a href="#">
            <div class="blog_img-wrapp">
              <img src="../img/main.jpg" class="blog_img-pict" alt="ブログの写真">
            </div>
            <div class="blog_info-wrapp">
              <p class="store_name-blog">aaaa</p>
              <p class="created_blog">2020-10-29</p>
            </div>
            <div class="sentence_wrapp">
              <p class="sentence_blog">濃厚スープのラーメン</p>
            </div>
          </a>
        </li>



      </ul>



      <div class="scroll_top-btn">
        <a href="#top_page"><i class="fas fa-arrow-up top_btn"></i></a>
      </div>

    </div>

    <?php require("shared/_footer.php") ?>



  </div>


</body>
</html>
