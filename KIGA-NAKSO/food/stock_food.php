<?php
  require_once __DIR__ . '/../components/header.php';
  require_once __DIR__ . '/../db/dbdata.php';

  $search_word = htmlspecialchars($_POST['search_word']);
	$dbc = new DbData();
?>
<head>
	<title>食材検索ページ</title>
</head>
<body>
  <br>
	<div class="container">
    <div class="row justify-content-center">
      <?php
        if ( !empty($search_word) ) {
          echo '<div class="col-9 text-center alert alert-primary" role="alert"><a class="alert-link">「'
            . $search_word . '」 </a>で検索しました</div>';
          
          // refrigerator query
          $all_refrigerator_food = 
            'SELECT master_food.f_id, master_food.f_name, refrigerator.end_day 
            FROM refrigerator, master_food 
            WHERE master_food.f_name LIKE "%' . $search_word . '%" AND refrigerator.f_id = master_food.f_id 
            ORDER BY end_day';
          $results = $dbc->searchRecipe($all_refrigerator_food);
        }
        else {
          $all_refrigerator_food = 
            'SELECT master_food.f_id, master_food.f_name, refrigerator.end_day 
            FROM refrigerator, master_food 
            WHERE refrigerator.f_id = master_food.f_id 
            ORDER BY end_day';

          $results = $dbc->searchRecipe($all_refrigerator_food);
        }
      ?>
      <div class="col-10">
				<form class="input-group" action="stock_food.php" method="POST">
					<input type="text" name="search_word" class="form-control" placeholder="食材検索">
					<button type="submit" class="btn btn-success">
						<i class="fa fa-search"></i>
						検索
					</button>
				</form>
			</div>
    </div><br>
    <div class="row justify-content-md-center text-center">
      <div class="col-md-7">
        <?php
          if ( !empty( $results ) ) {
            echo '
              <table class="table">
                <thead>
                  <tr class="bg-warning">
                    <th>食材</th>
                    <th>保存量</th>
                    <th>消費期限</th>
                  </tr>
                </thead>
                <tbody>';
            foreach( $results as $result ) {
              // 食材名, 保存量, 消費期限を表示
              echo '<tr class="table-warning"><th>' . $result['f_name'] . '</th><th>' . $result['ref_int'] . '</th><th>' . $result['end_day'] . 'まで</th></tr>';
            }
            echo '
                </tbody>
              </table>';
          }
          else {
            echo '<div class="col-9 text-center alert alert-danger" role="alert"><a class="alert-link">冷蔵庫には入っていませんでした</div>';
          }
        ?>
      </div>
    </div>
  </div>
<?php
  require_once __DIR__ . '/../components/footer.php'
?>