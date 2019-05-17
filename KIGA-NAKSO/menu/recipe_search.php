<?php
  require_once __DIR__ . '/../header.php';
  //require_once __DIR__ . '/../db/dbdata.php';
?>

<head>
	<title>レシピ</title>
	<link href="../css/bootstrap.min.css" rel="stylesheet">
	<script src="../js/bootstrap.min.js"></script>
	<script defer src="../js/all.min.js"></script>
</head>
<body>
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-10">
				<div class="input-group">
					<input type="text" class="form-control" placeholder="レシピ検索">
					<button>
						<i class="fa fa-search"></i>
					</button>
				</div>
			</div>
		<div class="row">
			<div class="col-4">
				<?php
				echo 'aaa';
					$dbc = new mysqli('localhost','kiga','nakso','kiga_nakso'); //or die('Error connectiong to mysql server');
					//mysqli_set_charaset($dbc,'utf8');
					$query = "SELECT * FROM recipe";
					$result = mysqli_query($dbc,$query); //or die('Error querying database');
					while ($row = mysqli_fetch_array($result)){
						echo 'vvvv';
						$recipe_name = $row['r_name'];
						echo $recipe_name;
					}
				?>
				<?php
				echo 'bbb';
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
			<div class="col-4">
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
		</div>
	</div>
</body>
</html>