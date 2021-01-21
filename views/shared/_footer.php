<?php
// セッション破棄
if(isset($_GET['logout'])) {
  $_SESSION = array();
  session_destroy();
  header('location: /my_app/views/index.php');
}
 ?>

<div class="shared_footer">
  <div class="shared_footer-nav">
    <a href="index.php"><h2>neigbor-<span>Food</span></h2></a>
    <ul>

      <li>
        <a href="/my_app/views/index.php">top</a>
      </li>

      <?php if(isset($_SESSION['User'])): ?>
        <li>
          <a href="/my_app/views/search_store.php">search</a>
        </li>
      <?php endif; ?>

      <?php if(isset($_SESSION['User']) && $_SESSION['User']['role'] == 1): ?>
        <li>
          <a href="/my_app/views/user_account.php">account</a>
        </li>
      <?php endif; ?>

      <?php if(isset($_SESSION['User']) && $_SESSION['User']['role'] == 0): ?>
        <li>
          <a href="/my_app/views/administrator_account.php">data</a>
        </li>
      <?php endif; ?>

      <!-- <li>
        <a href="/my_app/views/search_blog.php">blog</a>
      </li> -->

        <li>
          <?php if(!isset($_SESSION['User'])): ?>
            <a href="/my_app/views/registrations/login.php">login</a>
          <?php else: ?>
            <a href="?logout=1">logout</a>
          <?php endif; ?>
        </li>

      <?php if(!isset($_SESSION['User'])): ?>
        <li>
          <a href="/my_app/views/registrations/new.php">sign-in</a>
        </li>
      <?php endif; ?>

    </ul>
  </div>
</div>
