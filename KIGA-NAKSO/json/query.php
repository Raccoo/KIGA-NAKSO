<?php
require_once __DIR__ . '/../db/food.php';
$dbc = new Food();
//$sql = "select master_food.f_name from master_food where master_food.c_id = 1";
$this_month = 'select c_id, sum(purchase_volume), sum(consumption_volume), sum(disposal_valume)
from graph
where LAST_DAY(now()) > graph_date && graph_date >= date_format(now(), \'%Y-%m-01\')
and u_id = 1000
group by c_id';

$result = $dbc->showFood($this_month);
$t_mon1 = $result[0];
$t_mon2 = $result[1];
$t_mon3 = $result[2];
$t_mon4 = $result[3];

$last_month = 'select c_id, sum(purchase_volume), sum(consumption_volume), sum(disposal_valume)
from graph
where LAST_DAY(DATE_SUB(CURRENT_DATE(),INTERVAL 1 MONTH)) > graph_date && graph_date >= date_format(DATE_SUB(CURRENT_DATE(),INTERVAL 1 MONTH), \'%Y-%m-01\')
and u_id = 1000
group by c_id';

$result = $dbc->showFood($last_month);
$l_mon1 = $result[0];
$l_mon2 = $result[1];
$l_mon3 = $result[2];
$l_mon4 = $result[3];