<?php
  require_once __DIR__ . '/../components/header.php';
	require_once __DIR__ . '/../db/dbdata.php';
	
	$search_word = $_POST['search_word'];
?>
<head>
	<title>レシピ検索ページ</title>
</head>
<body>
	<div class="container">
		<div class="row justify-content-center">
			<?php
			// $search_word
			if( !empty($search_word) ) {
				echo '<div class="col-9 text-center alert alert-primary" role="alert"><a class="alert-link">「'
					. $search_word . '」 </a>で検索しました</div>';
			}
		?>
		<br>
		<div class="col-10">
				<form class="input-group" action="recipe_search.php" method="POST">
					<input type="text" name="search_word" class="form-control" placeholder="レシピ検索">
					<button type="submit">
						<i class="fa fa-search"></i>
						検索
					</button>
				</form>
			</div>
			<?php

				$dbc = new DbData();
				$all_recipe_query = "SELECT * FROM recipe";
				$result = $dbc->searchRecipe($all_recipe_query);
				
				foreach($result as $row) {
					echo '
					<div class="col-4">
						<div class="card" style="width: 18rem;">
							<img class="card-img-top" src="' . $row['r_picture'] . '" alt="カードの画像" style="height: 14rem;">
							<div class="card-body">
								<h5 class="card-title">' . $row['r_name'] . '</h5>
								<p class="card-text">';
					
					// Get the ingredients used in the recipe from db.
					$foods_name_query = 'SELECT DISTINCT master_food.f_name 
						FROM recipe_food, recipe, master_food 
						WHERE recipe_food.r_id = '
						 . $row['r_id'] . 
						' AND recipe_food.f_id = master_food.f_id';
				
					$items = $dbc->searchRecipe($foods_name_query);
					
					// process to display ingredients.
					$counter = 0;
					foreach($items as $a) {
						if( $counter >= 3 ){
							echo '...';
							break;
						}
						echo $a['f_name'] . '<br>';
						$counter += 1;
					}

					echo'	
								</p>
								<a href="#" class="btn btn-primary">材料を見る</a>
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