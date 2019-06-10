<?php
  require_once __DIR__ . '/../components/header.php';
  require_once __DIR__ . '/../db/dbdata.php';

  $search_word = htmlspecialchars($_POST['search_word']);
  $dbc = new DbData();
?>
<head>
  <title>マイ冷蔵庫ページ</title>
</head>
<body>
<br>
<div class="container">
  <div class="row justify-content-center">
    <?php
        if ( !empty($search_word) ) {
          echo '<div class="col-9 text-center alert alert-primary" role="alert"><a class="alert-link">「'. $search_word . '」 </a>で検索しました</div>';           
          // refrigerator query
          $all_refrigerator_food = 
          'SELECT master_food.f_id, master_food.f_name, master_food.unit, refrigerator.end_day,refrigerator.ref_int
          FROM refrigerator, master_food 
          WHERE master_food.f_name LIKE "%' . $search_word . '%" 
          AND refrigerator.f_id = master_food.f_id 
          AND refrigerator.u_id = ' . $_SESSION['u_id'] . '
          ORDER BY end_day';
          $results = $dbc->searchRecipe($all_refrigerator_food);
        }
        else {
          $all_refrigerator_food = 
          'SELECT master_food.f_id, master_food.unit, master_food.f_name, refrigerator.end_day,refrigerator.ref_int
          FROM refrigerator, master_food 
          WHERE refrigerator.f_id = master_food.f_id 
          AND refrigerator.u_id = ' . $_SESSION['u_id'] . '
          ORDER BY end_day';
          $results = $dbc->searchRecipe($all_refrigerator_food);
        }
      ?>
    <div class="col-10">
      <form class="input-group" action="stock_food.php" method="POST">
        <input type="text" name="search_word" class="form-control" placeholder="食材検索">
        <button type="submit" class="btn btn-success">
          <i class="fa fa-search"></i>検索
        </button>
      </form>
    </div>
  </div>
  <br>
  <ul class="nav nav-tabs">
    <li class="nav-item">
      <a href="#tab1" class="nav-link active" data-toggle="tab">冷蔵庫</a>
    </li>
    <li class="nav-item">
      <a href="#tab2" class="nav-link" data-toggle="tab">貢献度</a>
    </li>
  </ul>
  <div class="p-3">
    <div class="tab-content">
      <div id="tab1" class="tab-pane active">
        <div class="row justify-content-md-center text-center">
          <div class="col-md-7">
          <?php
          define('MAX', '10');

          $result_count = count($results);
          $max_page = ceil($result_count / MAX);
          if(!isset($_GET['page_id'])){
              $now = 1;
          }else{
              $now = $_GET['page_id'];
          }
          $start_no = ($now - 1) * MAX;
          $disp_data = array_slice($results, $start_no, MAX, true);

          $cards_count = 0;

          if( !empty( $disp_data ) ) {
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
            foreach( $disp_data as $data ) {
              // 食材名, 保存量, 消費期限を表示
              echo '<tr class="table-warning"><th>' . $data['f_name'] . '</th><th>' . $data['ref_int'] . $data['unit'] . '</th><th>' . $data['end_day'] . 'まで</th></tr>';
              $cards_count += 1;
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
          <br>
        </div>
        <br>
        <nav>
          <ul class="pagination justify-content-center">
      <?php
        $prev = $now - 1;
        $next = $now + 1;
        if ( $now != 1 ) {
          echo '<li class="page-item"><a class="page-link" href="./stock_food.php?page_id=' . $prev . '"><i class="fas fa-angle-left"></i></a></li>';
        }
        for( $i = 1; $i <= $max_page; $i++ ){
          if ( $i != $now ) {
            echo '<li class="page-item"><a class="page-link" href="./stock_food.php?page_id='. $i. '">'. $i. '</a></li>';
          }
          else {
            echo '<li class="page-item active"><a class="page-link" href="./stock_food.php?page_id='. $i. '">'. $i. '</a></li>';
          }
        }
        if ( $now != $max_page ) {
          echo '<li class="page-item"><a class="page-link" href="./stock_food.php?page_id='. $next . '"><i class="fas fa-angle-right"></i></a></li>';
        }
      ?>
          </ul>
        </nav>
      </div>
      <div id="tab2" class="tab-pane">
        <!--貢献度-->
      </div>
    </div>
  </div>
</div>
<?php
  require_once __DIR__ . '/../components/footer.php'
?>