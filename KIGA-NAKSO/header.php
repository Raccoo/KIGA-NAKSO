<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">

  <!-- bootstrapの読み込みはページ最下部の方がよい -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="index.php">KIGA-NAKSO</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- header contents -->
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <!-- Home page -->
        <li class="nav-item">
          <a class="nav-link" href="index.php">ホーム</a>
        </li>
        
        <!-- Foodstuff page -->
        <li class="nav-item">
          <a class="nav-link" href="#">食材</a>
        </li>
        
        <!-- Search page -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            検索
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="menu/recipe_search.php">レシピ</a>
            <a class="dropdown-item" href="#">おすすめ</a>
          </div>
        </li>
      </ul>
    </div>

  </nav>
</body>
</html>