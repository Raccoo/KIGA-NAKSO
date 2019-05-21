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
</head>
<body>
	<div class="container">
    <?php 
      echo '<h1>' . $recipe['r_name'] . '</h1>';
      echo '<image src="' . $recipe['r_picture'] . '">';
      
      // Get the ingredients used in the recipe from db.
			$foods_name_query = 'SELECT DISTINCT master_food.f_name 
			FROM recipe_food, recipe, master_food 
			WHERE recipe_food.r_id = '
				. $recipe['r_id'] . 
			  ' AND recipe_food.f_id = master_food.f_id';

			$items = $dbc->searchRecipe($foods_name_query);

			// process to display ingredients.
			foreach($items as $a) {
				echo ' * ' . $a['f_name'] . ' : ' . $a['f_volume'] . '<br>';
			}
    
      echo '<image src="' . $recipe['cuisine'] . '">';
    ?>
  </div>
<?php
  require_once __DIR__ . '/../components/footer.php'
?>