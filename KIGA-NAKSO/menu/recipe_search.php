<?php
  require_once __DIR__ . '/../components/header.php';
	require_once __DIR__ . '/../db/dbdata.php';
	
	$search_word = htmlspecialchars($_POST['search_word']);
	$error = htmlspecialchars($_GET['error']);
	$dbc = new DbData();
?>
<head>
	<title>レシピ検索ページ</title>
</head>
<body>
	<br>
	<div class="container">
		<div class="mx-auto text-center">
			<h1>レシピ一覧</h1>
		</div>
		<hr><br>
		<div class="row justify-content-center">
			<?php
				if ( !empty($error) ) {
					echo '<div class="col-9 text-center alert alert-danger" role="alert"><a class="alert-link">冷蔵庫</a>の材料が足りていません</div>';
					unset($error);
				}
				
				if ( !empty($search_word) ) {
					echo '<div class="col-9 text-center alert alert-primary" role="alert"><a class="alert-link">「'
						. $search_word . '」 </a>で検索しました</div>';
					$all_recipe_query = 'SELECT * FROM recipe WHERE r_name LIKE "%' . $search_word . '%"';
					$result = $dbc->searchRecipe($all_recipe_query);
				}
				else {
					$all_recipe_query = "SELECT * FROM recipe";
					$result = $dbc->searchRecipe($all_recipe_query);
				}
			?>
			<div class="col-10">
				<form class="input-group" action="recipe_search.php" method="POST">
					<input type="text" name="search_word" class="form-control" placeholder="レシピ検索">
					<button type="submit" class="btn btn-success">
						<i class="fa fa-search"></i>
						検索
					</button>
				</form>
			</div>
			</div>
			<br>
			<div class="row justify-content-center">
				<?php
					define('MAX', '6');

					$result_count = count($result);
					$max_page = ceil($result_count / MAX);
					if(!isset($_GET['page_id'])){
							$now = 1;
					}else{
							$now = $_GET['page_id'];
					}
					$start_no = ($now - 1) * MAX;
					$disp_data = array_slice($result, $start_no, MAX, true);
					
					$cards_count = 0;
					foreach($disp_data as $val){
						echo '
							<div class="col-4">
								<div class="card" style="width: 18rem;">
									<img class="card-img-top" src="' . $val['r_picture'] . '" alt="カードの画像" style="height: 14rem;">
									<div class="card-body">
										<h5 class="card-title">' . $val['r_name'] . '</h5>
										<p class="card-text">';
											
						// Get the ingredients used in the recipe from db.
						$foods_name_query = 'SELECT DISTINCT master_food.f_name 
							FROM recipe_food, recipe, master_food 
							WHERE recipe_food.r_id = '
							. $val['r_id'] . 
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
											<input type="hidden" name="recipe" value="' . $val['r_id'] . '" />
											<button class="btn btn-primary">レシピを見る</button>
										</form>
									</div>
								</div>
							</div>';

						$cards_count += 1;
						if ( $cards_count % 3 == 0 ) {
							echo '';
						}
					}
				?>
			</div>
			<br>
			<nav>
				<ul class="pagination justify-content-center">
				<?php
					$prev = $now - 1;
					$next = $now + 1;
					if ( $now != 1 ) {
						echo '<li class="page-item"><a class="page-link" href="./recipe_search.php?page_id=' . $prev . '"><i class="fas fa-angle-left"></i></a></li>';
					}
					for( $i = 1; $i <= $max_page; $i++ ){
						if ( $i != $now ) {
							echo '<li class="page-item"><a class="page-link" href="./recipe_search.php?page_id='. $i. '">'. $i. '</a></li>';
						}
						else {
							echo '<li class="page-item active"><a class="page-link" href="./recipe_search.php?page_id='. $i. '">'. $i. '</a></li>';
						}
					}
					if ( $now != $max_page ) {
						echo '<li class="page-item"><a class="page-link" href="./recipe_search.php?page_id='. $next . '"><i class="fas fa-angle-right"></i></a></li>';
					}
				?>
				</ul>
			</nav>
			</div>
		</div>
	</div>

<?php
  require_once __DIR__ . '/../components/footer.php';
?>