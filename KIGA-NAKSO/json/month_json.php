<?php
require_once __DIR__ . '/../json/query.php';

$record = "select date_format(graph_date,'%Y-%m') as record, sum(purchase_volume) as pv, sum(consumption_volume) as cv, sum(disposal_volume) as dv
from graph
where now() >= graph_date &&
      graph_date >= date_format(DATE_SUB(CURRENT_DATE(), INTERVAL 11 MONTH), '%Y-%m-01')
group by date_format(graph_date,'%Y-%m')
order by date_format(graph_date,'%Y-%m')";

$result = $dbc->showFood($record);
//もう、出力の仕方がわからないので一旦push