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
      session_start();
      $uid = $_SESSION['u_id'];
      
      if ( !empty( $uid ) ) {
        $user_refrigerator_end_day =
          'SELECT master_food.f_name, refrigerator.end_day
          FROM refrigerator, master_food
          WHERE refrigerator.f_id = master_food.f_id
          AND refrigerator.u_id = ' . $uid . ' ORDER BY end_day';
        $results = $dbc->searchRecipe($user_refrigerator_end_day);
        
        //本日の3日後の日付を取得する。
        $today = strtotime( "+3 day" );
        
        foreach( $results as $data ) {
          //消費期限を取得する。
          $time = strtotime($data['end_day']);
          if ($today > $time){
            $alert_str = $alert_str . '<p>* ' . $data['f_name'] . '</p>';

          }
        }
                echo '
          <div class="modal fade">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">消費期限が迫っています!!!</h4>
                  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                </div>
                <div class="modal-body">
                  ' . $alert_str . 'の消費期限が3日以内になりました...
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
          </div>';

echo     '<!-- call modal window -->
          <script>
            jQuery(document).ready(function(){
              jQuery(".modal").modal("show");
            });
          </script>';
      }
    ?>
	<head>
		<title>ホーム画面</title>
	</head>
	<body>
		<br><br>
		<div class="text-center">
			<h1><img id="blah" src="img/kiganakso_red.png" alt="your image" width="100px" height="100px">KIGA-NAKSO</h1><br>

			<img src="img/SDGs.jpg" class="img-responsive center-block">
		</div>
		<br><br>
	</body>
</html>
<?php
  require_once __DIR__ . '/components/footer.php'
?>
