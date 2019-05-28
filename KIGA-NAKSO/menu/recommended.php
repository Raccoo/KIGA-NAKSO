<?php
  require_once __DIR__ . '/../components/header.php';
	require_once __DIR__ . '/../db/dbdata.php';
	
	$dbc = new DbData();
?>
<head>
	<title>おすすめのレシピ紹介</title>
</head>
<body>
	<br>
	<div class="container">
		<div class="mx-auto text-center">
			<h1>おすすめのメニュー</h1>
		</div>
		<hr><br>
		<div class="row justify-content-center">	
<?php
	session_start();
	
	// debug
	$_SESSION['user_id'] = 1;
	
	$user_id = $_SESSION['user_id'];
	$query = 'SELECT DISTINCT recipe.r_name, recipe.r_picture, recipe.r_id FROM recipe_food, refrigerator, recipe 
		WHERE recipe_food.f_id = refrigerator.f_id 
		AND recipe.r_id = recipe_food.r_id
		AND refrigerator.u_id = ' . $user_id;
	
	$recipes = $dbc->searchRecipe($query);
	foreach ( $recipes as $recipe ) {
		echo '
			<div class="col-4">
			<div class="card" style="width: 18rem;">
			<img class="card-img-top" src="' . $recipe['r_picture'] . '" alt="カードの画像" style="height: 14rem;">
			<div class="card-body">
			<h5 class="card-title">' . $recipe['r_name'] . '</h5>
			<p class="card-text">';

			// Get the ingredients used in the recipe from db.
			$foods_name_query = 'SELECT DISTINCT master_food.f_name 
				FROM recipe_food, recipe, master_food 
				WHERE recipe_food.r_id = '
				. $recipe['r_id'] . 
				' AND recipe_food.f_id = master_food.f_id';
						
			$items = $dbc->searchRecipe($foods_name_query);
							
			// process to display ingredients.
			$counter = 0;
			foreach($items as $item) {
				if( $counter >= 3 ){
					echo '...';
					break;
				}
				echo $item['f_name'] . '、';
				$counter += 1;
			}

			echo'	
			</p>
			<form method="POST" action="recipe_view.php">
			<input type="hidden" name="recipe" value="' . $recipe['r_id'] . '" />
			<button class="btn btn-primary">材料を見る</button>
			</form>
			</div>
			</div>
			</div>';
	}
?>
		</div>
	</div>

<?php
	require_once __DIR__ . '/../components/footer.php';
?>