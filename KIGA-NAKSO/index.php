<?php
  require_once __DIR__ . '/components/header.php';
  require_once __DIR__ . '/db/dbdata.php';

  $search_word = htmlspecialchars($_POST['search_word']);
  $dbc = new DbData();
?>
<head>
  <title>タイトル</title>
</head>
<body>
    <?php
      if ( !empty($search_word) ) {
        echo '<div class="col-9 text-center alert alert-primary" role="alert"><a class="alert-link">「'. $search_word . '」 </a>で検索しました</div>';
        // refrigerator query
        $all_refrigerator_food =
          'SELECT master_food.f_id, master_food.f_name, master_food.unit, refrigerator.end_day,refrigerator.ref_int
          FROM refrigerator, master_food
          WHERE master_food.f_name LIKE "%' . $search_word . '%"
          AND refrigerator.f_id = master_food.f_id
          ORDER BY end_day';
        $results = $dbc->searchRecipe($all_refrigerator_food);
      }
      else {
        $all_refrigerator_food =
          'SELECT master_food.f_id, master_food.unit, master_food.f_name, refrigerator.end_day,refrigerator.ref_int
          FROM refrigerator, master_food
          WHERE refrigerator.f_id = master_food.f_id
          ORDER BY end_day';
        $results = $dbc->searchRecipe($all_refrigerator_food);
      }

      define('MAX', '10');

      $result_count = count($results);
      $max_page = ceil($result_count / MAX);

      if ( !isset($_GET['page_id']) ){
        $now = 1;
      }
      else {
        $now = $_GET['page_id'];
      }

      $start_no = ($now - 1) * MAX;
      $disp_data = array_slice($results, $start_no, MAX, true);

      $cards_count = 0;
      //本日の3日後の日付を取得する。
      $today = strtotime( "+3 day" );

      if( !empty( $disp_data ) ) {
        /*
        foreach( $disp_data as $data ) {
          //消費期限を取得する。
          $time = strtotime($data['end_day']);
          if ($today >= $time){
            $test_alert = "<script type='text/javascript'>alert('" . $data['f_name'] . "の消費期限が3日以内になりました。');</script>";
            echo $test_alert;
          }
        }
        */
      }
      else { }
    ?>
<html>
	<head>
		<title>ホーム画面</title>
	</head>
	<body>
		<br><br>
		<div class="text-center">
			<h1><img id="blah" src="http://placehold.it/150" alt="your image">KIGA-NAKSO</h1><br>

			<img src="img/SDGs.jpg" class="img-responsive center-block">
		</div>
		<br><br>
	</body>
</html>
<?php
  require_once __DIR__ . '/../components/footer.php'
?>
