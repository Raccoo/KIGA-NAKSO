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
            'SELECT master_food.f_id, master_food.f_name, DATE_FORMAT((refrigerator.ref_expiry_date + master_food.expiry_date), "%Y-%m-%d") AS ex_date 
            FROM refrigerator, master_food 
            WHERE master_food.f_name LIKE "%' . $search_word . '%" AND refrigerator.f_id = master_food.f_id 
            ORDER BY ex_date';
          $results = $dbc->searchRecipe($all_refrigerator_food);
        }
        else {
          $all_refrigerator_food = "SELECT * FROM refrigerator, master_food WHERE refrigerator.f_id = master_food.f_id";
          $results = $dbc->searchRecipe($all_refrigerator_food);
        }
      ?>
      <div class="col-10">
				<form class="input-group" action="search_food.php" method="POST">
					<input type="text" name="search_word" class="form-control" placeholder="レシピ検索">
					<button type="submit" class="btn btn-success">
						<i class="fa fa-search"></i>
						検索
					</button>
				</form>
			</div>
    </div><br>
    <div class="row justify-content-md-center text-center">
      <div class="col-md-7">
        <table class="table">
          <thead>
            <tr class="bg-warning">
              <th>食材</th>
              <th>保存料</th>
              <th>消費期限</th>
            </tr>
          </thead>
          <tbody>
          <?php
            foreach( $results as $result ) {
              // 食材名, 保存料, 消費期限を表示
              echo '<tr class="table-warning"><th>' . $result['f_name'] . '</th><th>' . $result[''] . '</th><th>' . $result['ex_date'] . '</th></tr>';
            }
          ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
<?php
  require_once __DIR__ . '/../components/footer.php'
?>