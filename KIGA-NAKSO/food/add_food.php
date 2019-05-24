<?php
require_once __DIR__ . '/../components/header.php';
require_once __DIR__ . '/../db/food.php';

$dbc = new DbData();
$food_query = 'SELECT * FROM master_food';
$results = $dbc->searchRecipe($food_query);
?>

<head>
    <title>食材登録</title>
</head>
<body>
<script>
function chose() {
    let value　= document.getElementById("food").value;
    $.post('add_food.php',{val : value});
}
</script>
<form method="POST" action="<?php echo $_SERVER["PHP_SELF"]?>">
<select name="food"  onchange="chose()">
<option  value="">登録する食材を選択してください</option>
<?php
foreach ($results as $result){
    echo '<option value="'.$result["f_id"].'">'.$result['f_name']."</option><br>";
}
?>
</select>


<br>消費期限は
<?php
/*
    $val = $_POST['val'];
    echo $val;

    $calc = 'select expiry_date from master_food where f_id ='. $id;
    echo $calc;
    $end_day = date("Y-m-d",strtotime($calc));//$result['expiry_date']
    //echo $end_day;
    echo 'です。'
*/
?>
    <input type="submit" name='submit' value="登録する">
</form>
</body>
<?php
    require_once __DIR__ . '/../components/footer.php';