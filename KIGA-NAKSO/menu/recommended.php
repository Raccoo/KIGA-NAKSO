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
<?php
	session_start();
	
	// debug
	$_SESSION['user_id'] = 1;
	
	$user_id = $_SESSION['user_id'];
	$query = 'SELECT * FROM recipe_food, refrigerator, recipe 
		WHERE recipe_food.f_id = refrigerator.f_id 
		AND recipe.r_id = recipe_food.r_id
		AND refrigerator.u_id = ' . $user_id;
	
	$recipes = $dbc->searchRecipe($query);
	foreach ( $recipes as $recipe ) {

	}
?>
	</div>

<?php
	require_once __DIR__ . '/../components/footer.php';
?>