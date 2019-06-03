<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">

  <!-- bootstrapの読み込みはページ最下部の方がよい -->
  <link href="../css/bootstrap.min.css" rel="stylesheet">
  <link href="../css/KIGA-NAKSO.css" rel="stylesheet">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
  <script src="../js/jquery.min.js"></script>
  <script src="../js/bootstrap.min.js"></script>
</head>
<body>
 <div class="header sticky-top">
  <nav class="navbar navbar-expand-md navbar-dark bg-dark">
   <a class="navbar-brand" href="../index.php">KIGA-NAKSO</a>
   <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    
     <!--<div class="navbar-collapse collapse w-100 order-1 order-md-0 dual-collapse2"> -->
       <!--header contents -->
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <!-- Home page -->
          <li class="nav-item">
            <a class="nav-link" href="../index.php"><i class="fas fa-home"> ホーム</i></a>
          </li>
          
          <!-- Foodstuff page -->
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="../food/search_food.php" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-door-closed"> 冷蔵庫</i>
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="../food/stock_food.php"><i class="fas fa-list-ul"> 一覧</i></a>
              <a class="dropdown-item" href="../food/add_food.php"><i class="fas fa-cart-arrow-down"> 追加</i></a>
            </div>
          </li>
          
          <!-- Search page -->
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="../menu/recipe_search.php" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-search-plus"> 検索</i>
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="../menu/recipe_search.php"><i class="fas fa-utensils"> レシピ</i></a>
              <a class="dropdown-item" href="../menu/recommended.php"><i class="far fa-thumbs-up"> おすすめ</i></a>
            </div>
          </li>
        </ul>
      <!-- </div>
      <div class="navbar-collapse collapse order-3 dual-collapse2"> -->
        <ul class="navbar-nav ml-auto">

<?php
  // security check
  ini_set('display_errors', 0);
  header("X-FRAME-OPTIONS: DENY");
  header("X-Content-Type-Options: nosniff");

  if( !isset($_SESSION['user_id']) ) {
    echo '<li class="nav-item"><a class="nav-link" href="../user/create-user.php"><i class="fas fa-user"> 新規作成</i></a></li>';
    echo '<li class="nav-item"><a class="nav-link" href="../user/login.php"><i class="fas fa-sign-in-alt"> ログイン</i></a></li>';
  }
  else {
    echo '<li class="nav-item"><a class="nav-link" href="#"><i class="fas fa-sign-out-alt"> ログアウト</i></a></li>';
  }
?>
        </ul>
      </div>
  </nav><br><br>
</div>
</nav>
</div>
</body>


