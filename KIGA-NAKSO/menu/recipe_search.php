<?php
  require_once __DIR__ . '/../components/header.php';
  require_once __DIR__ . '/../db/dbdata.php';
?>

	<div class="container">
		<div class="row justify-content-center">
			<div class="col-10">
				<!-- <div class="input-group"> -->
					<form class="input-group action="" methods="POST" name="search_word">
						<input type="text" class="form-control" placeholder="レシピ検索">
						<div class="submit">
							<button type="button">
								<i class="fa fa-search"></i>
							</button>
						</div>
					</form>
				<!-- </div> -->
			</div>
<<<<<<< HEAD
		<div class="row">
			<div class="col-4">
				<?php
				//echo 'aaa';
					//$dbc = new mysqli('localhost','kiga','nakso','kiga_nakso'); //or die('Error connectiong to mysql server');
					//mysqli_set_charaset($dbc,'utf8');
					//$query = "SELECT * FROM recipe";
					//$result = mysqli_query($dbc,$query); //or die('Error querying database');
					//while ($row = mysql_fetch_array($result)){
					//	echo 'vvvv';
					//	$recipe_name = $row['r_name'];
					//	echo $recipe_name;
					//}
				?>
				<?php
				//echo 'bbb';
				?>
				<div class="card" style="width: 18rem;">
  					<img class="card-img-top" src="../img/omuraisu.jpg" alt="カードの画像" style="height: 14rem;">
  					<div class="card-body">
    					<h5 class="card-title">ドレスオムライス</h5>
    					<p class="card-text" >鶏肉、たまねぎ、ピーマン...</p>
    					<a href="#" class="btn btn-primary">材料を見る。</a>
  					</div>
				</div>
			</div>
			<div czlass="col-4">
				<div class="card" style="width: 18rem;">
  					<img class="card-img-top" src="../img/kare-.jpg" alt="カードの画像" style="height: 14rem;">
  					<div class="card-body">
   						 <h5 class="card-title">普通のカレー</h5>
   						 <p class="card-text" >にんじん、じゃがいも、豚肉...</p>
  						 <a href="#" class="btn btn-primary">材料を見る。</a>
 					 </div>
				</div>
			</div>
			<div class="col-4">
				<div class="card" style="width: 18rem;">
  					<img class="card-img-top" src="../img/monburan.jpg" alt="カードの画像" style="height: 14rem;">
  					<div class="card-body">
   						 <h5 class="card-title">ざるそばモンブラン</h5>
   						 <p class="card-text" >栗、グラニュー糖、生クリーム</p>
  						 <a href="#" class="btn btn-primary">材料を見る。</a>
 					 </div>
				</div>
			</div>
=======
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
								<p class="card-text" >';
					
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
>>>>>>> 263b2b57fd785b627b7f984fbcafb97df865c1c4
		</div>
	</div>

<?php
  require_once __DIR__ . '/../components/footer.php';
?>