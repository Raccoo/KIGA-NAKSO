<?php
require_once __DIR__ . '/../db/food.php';
$dbc = new Food();
//$sql = "select master_food.f_name from master_food where master_food.c_id = 1";
$meat = 'select sum(ref_int) as sum
from refrigerator,
     master_food
where c_id = 1
  and u_id = 1
  and master_food.f_id = refrigerator.f_id';

$result = $dbc->showFood($meat);