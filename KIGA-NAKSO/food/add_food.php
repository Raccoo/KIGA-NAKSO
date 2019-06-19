<?php
require_once __DIR__ . '/../components/header.php';
require_once __DIR__ . '/../db/food.php';

$dbc = new Food();
$food_query = 'SELECT * FROM master_food';
$results = $dbc->showFood($food_query);
?>

    <head>
        <title>食材登録</title>
    </head>
    <body>
    <div class="container">
    <div class="form-group">
        <br>
        <div class="mx-auto text-center">
			<h1>冷蔵庫に食材を追加</h1>
		</div>
		<hr><br>
        <div class="row justify-content-center">
    <form method="POST" action="<?php echo $_SERVER["PHP_SELF"] ?>">
        <label>
            <select class="form-control" name="food" id="input_vol">
                <option selected value="">登録する食材を選択してください</option>
                <?php
                foreach ($results as $result) {
                    echo '<option value="' . $result["f_id"] . '">' . $result['f_name'] . "</option><br>";
                }
                ?>
            </select>
        </label>


        <?php
        session_start();

        echo '<input type="number" step="0.5" min="0" id="input_vol" class="form-control" name="vol" placeholder="数量を入力">';
        echo '<small class="text-muted">※野菜は 個数 肉はグラム 魚は切り身 液体はmL 単位 | 1/2は0.5として、登録してください。</small><br>';
        $fid = $_POST['food'];
        $sql = "select f_name, expiry_date from master_food where f_id ='" . $fid . "'";
        $show = $dbc->showFood($sql);

        
        if ($fid != '') {
            echo '<br>' . $show[0]['f_name'] . 'を　' . $_POST['vol'] . '　登録します。';
            echo "<br>" . $show[0]['f_name'] . "の";
            echo '消費期限は、およそ';

            $food_end_day = date('Y-m-d', mktime(0, 0, 0, date('n'), date('j') + $show[0]['expiry_date'], date('Y')));
            echo $food_end_day . "です。";

        }else{
            echo '<br><button type="submit" class="btn btn-outline-success btn-block">登録する</button><br>';
        }

        if ($_POST['vol'] > 0) {
            $vol = $_POST['vol'];
            $uid = $_SESSION['u_id'];
            if ($uid != Null && $fid != Null && $food_end_day && $vol != Null) {
                try {
                    $ref_insert = 'insert into refrigerator (u_id, f_id, end_day, ref_int) VALUES (:uid,:fid,:food_end_day,:ref_int)';
                    $stmt = $dbc->set_food($ref_insert);
                    $stmt->bindValue(':uid', $uid, PDO::PARAM_INT);
                    $stmt->bindValue(':fid', $fid, PDO::PARAM_INT);
                    $stmt->bindValue(':food_end_day', $food_end_day, PDO::PARAM_STR);
                    $stmt->bindValue(':ref_int', $vol, PDO::PARAM_INT);

                    if ( !$stmt->execute() ) {
                        $errors['error'] = "食材登録に失敗しました。";
                    }
                    
                    $graph_insert = 'insert into graph (u_id, purchase_volume, consumption_volume, disposal_valume, graph_date) 
                        VALUES (:uid, :purchase_volume, 0, 0, :graph_date)';
                    
                    $nowtime = date('Y-m-d', mktime(0, 0, 0, date('n'), date('j'), date('Y')));
                    $graph_stmt = $dbc->set_food($graph_insert);
                    $graph_stmt->bindValue(':uid', $uid, PDO::PARAM_INT);
                    $graph_stmt->bindValue(':purchase_volume', $vol, PDO::PARAM_INT);
                    $graph_stmt->bindValue(':graph_date', $nowtime, PDO::PARAM_STR);

                    if ( !$graph_stmt->execute() ) {
                        $errors['error'] = "食材登録に失敗しました。";
                    }
                    
                    echo '<p>登録が完了しました。</p>';
                    echo '<br><a class="btn btn-primary btn-block" href="stock_food.php" role="button"><i class="fas fa-arrow-circle-right"></i> 冷蔵庫を確認する</a>';
                    echo '<br><button type="submit" class="btn btn-outline-success btn-block">他の食材も追加する</button><br>';
                }
                catch ( Exception $e ) { }
            }
        }

        //echo '<br><button type="submit" class="btn btn-outline-success btn-block" id="btn">登録する</button><br>';

        ?>

    </form>
    </div>
    </div>
    </div>
    </body>
<?php
require_once __DIR__ . ' /../components/footer.php';