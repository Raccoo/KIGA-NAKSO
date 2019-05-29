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
  <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark">
    <div class="navbar-collapse collapse w-100 order-1 order-md-0 dual-collapse2">
      <a class="navbar-brand" href="../index.php">KIGA-NAKSO</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <!-- header contents -->
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <!-- Home page -->
          <li class="nav-item">
            <a class="nav-link" href="../index.php">ホーム</a>
          </li>
          
          <!-- Foodstuff page -->
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="../food/search_food.php" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              冷蔵庫
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="../food/stock_food.php">一覧</a>
              <a class="dropdown-item" href="../food/add_food.php">追加</a>
            </div>
          </li>
          
          <!-- Search page -->
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="../menu/recipe_search.php" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              検索
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="../menu/recipe_search.php">レシピ</a>
              <a class="dropdown-item" href="../menu/recommended.php">おすすめ</a>
            </div>
          </li>
        </ul>
      </div>
      <div class="navbar-collapse collapse order-3 dual-collapse2">
        <ul class="navbar-nav ml-auto">

<?php
  // security check
  ini_set('display_errors', 0);
  header("X-FRAME-OPTIONS: DENY");
  header("X-Content-Type-Options: nosniff");

  if( !isset($_SESSION['user_id']) ) {
    echo '<li class="nav-item"><a class="nav-link" href="../user/create-user.php">新規作成</a></li>';
    echo '<li class="nav-item"><a class="nav-link" href="../user/login.php">ログイン</a></li>';
  }
  else {
    echo '<li class="nav-item"><a class="nav-link" href="#">ログアウト</a></li>';
  }
?>
        </ul>
      </div>
  </nav><br><br>
</div>
</nav>
</body>


