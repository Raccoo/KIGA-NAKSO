<?php
  require_once __DIR__ . '/../components/header.php';
  require_once __DIR__ . '/../db/dbdata.php';

  $recipe_id = htmlspecialchars($_POST['recipe']);
  if ( empty($recipe_id) ) {
    header("Location: ./recipe_search.php");
	  exit;
  }

  // get recipe
  $dbc = new DbData();
  $recipe_query = 'SELECT * FROM recipe WHERE r_id = ' . $recipe_id;
  $result = $dbc->searchRecipe($recipe_query);
  $recipe = $result[0];
?>
<head>
	<title>レシピ検索ページ</title>
  <style type="text/css">
    img.food {
      height: 100%;
      width:100%;
    }
  </style>
</head>
<body>
	<div class="container">
    <?php 
      echo '<h1>' . $recipe['r_name'] . '</h1>';
      echo '<div class="row">';
      echo '<div class="col-sm-7">';
      echo '<image class="food rounded" src="' . $recipe['r_picture'] . '">';
      echo '</div>';
      echo '<div class="col-sm-5">';
      echo '<table class="table">';
      echo '<thead>
              <tr class="bg-warning">
                  <th>食材</th>
                  <th>使用料</th>
              </tr>
          </thead>
          <tbody>';
      
      // Get the ingredients used in the recipe from db.
			$foods_name_query = 'SELECT DISTINCT master_food.f_name, recipe_food.f_volume 
			FROM recipe_food, recipe, master_food 
			WHERE recipe_food.r_id = '
				. $recipe['r_id'] . 
			  ' AND recipe_food.f_id = master_food.f_id';

			$items = $dbc->searchRecipe($foods_name_query);

			// process to display ingredients.
			foreach($items as $item) {
				echo '<tr class="table-warning"><th>' . $item['f_name'] . '</th><th>' . $item['f_volume'] . '</th></tr>';
      };
      echo '</tbody></table>';
      echo '</div></div><br>';
      echo $recipe['cuisine'];
    ?>
    <div class="row">
      <div class="col-md-10 col-md-offset-1">
      <button onclick="history.back()" class="btn btn-success">レシピ検索に戻る</button>
      </div>
      <div class="col-md-2 col-md-offset-1">
        <button class="btn btn-warning">作った！</button>
      </div>
    </div>
  </div>
<?php
  require_once __DIR__ . '/../components/footer.php'
?>