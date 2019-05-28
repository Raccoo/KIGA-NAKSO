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

    <form method="POST" action="<?php echo $_SERVER["PHP_SELF"] ?>">
        <label>
            <select name="food">
                <option selected value="">登録する食材を選択してください</option>
                <?php
                foreach ($results as $result) {
                    echo '<option value="' . $result["f_id"] . '">' . $result['f_name'] . "</option><br>";
                }
                ?>
            </select>
        </label>


        <?php
        echo '<input type="text" name="vol" placeholder="数量を入力">';
        $fid = $_POST['food'];
        $sql = 'select f_name, expiry_date from master_food where f_id =' . $fid;
        $show = $dbc->showFood($sql);
        if ($fid != '') {
            echo "<br>" . $show[0]['f_name'] . "の";
            echo '消費期限は、およそ';
            $food_end_day = date('Y年m月d日', mktime(0, 0, 0, date('n'), date('j') + $show[0]['expiry_date'], date('Y')));
            echo $food_end_day . "です。";
        }

        ?>

        <input type="submit" name='submit' value="登録する">
    </form>
    </body>
<?php
require_once __DIR__ . ' /../components/footer.php';