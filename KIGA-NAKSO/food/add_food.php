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
        //echo '<input type="number" name="vol" placeholder="数量を入力">';
        echo '<input type="number" id="input_vol" class="form-control" name="vol" placeholder="数量を入力">';
        //echo '<br>※肉はグラム 魚は切り身 液体はmL 単位で 「正の数」で 登録してください。<br>';
        echo '<small class="text-muted">※肉はグラム 魚は切り身 液体はmL 単位で 「正の数」で 登録してください。</small><br>';
        $fid = $_POST['food'];
        $sql = "select f_name, expiry_date from master_food where f_id ='" . $fid . "'";
        $show = $dbc->showFood($sql);

        
        if ($fid != '') {
            echo '<br>' . $show[0]['f_name'] . 'を　' . $_POST['vol'] . '　登録します。';
            echo "<br>" . $show[0]['f_name'] . "の";
            echo '消費期限は、およそ';

            // 'Y-m-d'の形式でないとDataBaseへ格納できない
            // Y年m月d日で表示するなら別の形で保存する必要がある
            $food_end_day = date('Y-m-d', mktime(0, 0, 0, date('n'), date('j') + $show[0]['expiry_date'], date('Y')));
            echo $food_end_day . "です。";

        }else{
            //<input type="submit" name='submit' value="登録する">
            echo '<br><button type="submit" class="btn btn-outline-success btn-block">登録する</button><br>';
        }

        if ($_POST['vol'] > 0) {
            $vol = $_POST['vol'];
            $uid = 1; // $_SESSION['$uid']; debug用の仮のuser_id
            if ($uid != Null && $fid != Null && $food_end_day && $vol != Null) {
                $ref_insert = 'insert into refrigerator (u_id, f_id, end_day, ref_int) VALUES (:uid,:fid,:food_end_day,:ref_int)';
                $stmt = $dbc->set_food($ref_insert);
                $stmt->bindValue(':uid', $uid, PDO::PARAM_INT);
                $stmt->bindValue(':fid', $fid, PDO::PARAM_INT);
                $stmt->bindValue(':food_end_day', $food_end_day, PDO::PARAM_STR);
                $stmt->bindValue(':ref_int', $vol, PDO::PARAM_INT);
                if (!$stmt->execute()) {
                    $errors['error'] = "食材登録に失敗しました。";
                }
                echo '<p>登録が完了しました。</p>';
                echo '<br><button type="submit" class="btn btn-outline-success btn-block">他の食材も追加する</button><br>';
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