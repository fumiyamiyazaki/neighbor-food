
<?php

// セッション破棄
if(isset($_GET['logout'])) {
  $_SESSION = array();
  session_destroy();
  header('location: /my_app/views/index.php');
}
 ?>

<div class="shared_header">

  <div class="shared_header-title">
    <p><a href="/my_app/views/index.php">neighbor - <span>Food</span></a></p>

  </div>

  <div class="shared_header-nav">

    <ul>

      <li>
        <a href="/my_app/views/index.php">top</a>
      </li>

      <?php if(isset($_SESSION['User']) || isset($_SESSION['Store'])): ?>
        <li>
          <a href="/my_app/views/search_store.php">search</a>
        </li>
      <?php endif; ?>

      <?php if(isset($_SESSION['User'])): ?>
        <li>
          <a href="/my_app/views/user_account.php">account</a>
        </li>
      <?php endif; ?>

      <?php if(isset($_SESSION['Store'])): ?>
        <li>
          <a href="/my_app/views/store_account.php">account</a>
        </li>
      <?php endif; ?>

      <li>
        <a href="/my_app/views/search_blog.php">blog</a>
      </li>

        <li>
          <?php if(!isset($_SESSION['User']) && !isset($_SESSION['Store'])): ?>
            <a href="/my_app/views/registrations/login.php">login</a>
          <?php else: ?>
            <a href="?logout=1">logout</a>
          <?php endif; ?>
        </li>
        
      <?php if(!isset($_SESSION['User']) && !isset($_SESSION['Store'])): ?>
        <li class="shared_li-before">
          <a href="/my_app/views/registrations/new.php">sign-in</a>
        </li>
      <?php endif; ?>

    </ul>

  </div>

</div>
