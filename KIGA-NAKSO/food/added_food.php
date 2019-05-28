<?php
require_once __DIR__ . '/../components/header.php';
require_once __DIR__ . '/../db/food.php';
require_once __DIR__ . '/../food/add_food.php';

//$ref_insert = 'insert into refrigerator (u_id, f_id, ref_expiry_date) VALUES (1,:fid,:food_end_day)';
//$stmt = $dbc->set_food($ref_insert);
//$stmt->bindValue(':fid', $fid, PDO::PARAM_INT);
//$stmt->bindValue(':food_end_day', $food_end_day, PDO::PARAM_INT);
//if(!$stmt->execute()){
//    $errors['error'] = "食材登録に失敗しました。";
$a = $_POST['food_end_day'];
echo $a;//}
echo '<p>登録が完了しました。</p>';
?>

    <head>
        <title>食材登録完了</title>
    </head>
    <body>


    <input type="submit" name='submit' value="登録する">

    </body>
<?php
require_once __DIR__ . '/../components/footer.php';