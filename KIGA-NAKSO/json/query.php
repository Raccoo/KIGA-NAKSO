<?php
require_once __DIR__ . '/../db/food.php';
$dbc = new Food();


//$sql = "select master_food.f_name from master_food where master_food.c_id = 1";
$this_month = 'select c_id, ifnull(sum(purchase_volume),0) as pv, ifnull(sum(consumption_volume),0) as cv, ifnull(sum(disposal_volume),0) as dv
from graph
where LAST_DAY(now()) > graph_date && graph_date >= date_format(now(), \'%Y-%m-01\')
and u_id = 1000
group by c_id';

$compare_this_month_all_category = 'select ifnull(sum(consumption_volume),0) as cv, ifnull(sum(disposal_volume),0) as dv
from graph
where LAST_DAY(now()) > graph_date && graph_date >= date_format(now(), \'%Y-%m-01\')
  and u_id = 1000';

$comp = $dbc->showFood($compare_this_month_all_category);
$ctmac_cv = $comp[0]['cv'];
$ctmac_dv = $comp[0]['dv'];

$result = $dbc->showFood($this_month);
$t_mon1 = $result[0];
$t_mon2 = $result[1];
$t_mon3 = $result[2];
$t_mon4 = $result[3];
$t_mon5 = $result[4];
$t_mon6 = $result[5];
$t_mon7 = $result[6];

$tm = array(
    'a' => array('pv' => (int)$t_mon1['pv'], 'cv' => (int)$t_mon1['cv'], 'dv' => (int)$t_mon1['dv']),
    'b' => array('pv' => (int)$t_mon2['pv'], 'cv' => (int)$t_mon2['cv'], 'dv' => (int)$t_mon2['dv']),
    'c' => array('pv' => (int)$t_mon3['pv'], 'cv' => (int)$t_mon3['cv'], 'dv' => (int)$t_mon3['dv']),
    'd' => array('pv' => (int)$t_mon4['pv'], 'cv' => (int)$t_mon4['cv'], 'dv' => (int)$t_mon4['dv']),
    'e' => array('pv' => (int)$t_mon5['pv'], 'cv' => (int)$t_mon5['cv'], 'dv' => (int)$t_mon5['dv']),
    'f' => array('pv' => (int)$t_mon6['pv'], 'cv' => (int)$t_mon6['cv'], 'dv' => (int)$t_mon6['dv']),
    'g' => array('pv' => (int)$t_mon7['pv'], 'cv' => (int)$t_mon7['cv'], 'dv' => (int)$t_mon7['dv'])
);

$last_month = 'select c_id, ifnull(sum(purchase_volume),0) as pv, ifnull(sum(consumption_volume),0) as cv, ifnull(sum(disposal_volume),0) as dv
from graph
where LAST_DAY(DATE_SUB(CURRENT_DATE(),INTERVAL 1 MONTH)) > graph_date && graph_date >= date_format(DATE_SUB(CURRENT_DATE(),INTERVAL 1 MONTH), \'%Y-%m-01\')
and u_id = 1000
group by c_id';

$result = $dbc->showFood($last_month);
$l_mon1 = $result[0];
$l_mon2 = $result[1];
$l_mon3 = $result[2];
$l_mon4 = $result[3];
$l_mon5 = $result[4];
$l_mon6 = $result[5];
$l_mon7 = $result[6];

$lm = array(
    'a' => array('pv' => (int)$l_mon1['pv'], 'cv' => (int)$l_mon1['cv'], 'dv' => (int)$l_mon1['dv']),
    'b' => array('pv' => (int)$l_mon2['pv'], 'cv' => (int)$l_mon2['cv'], 'dv' => (int)$l_mon2['dv']),
    'c' => array('pv' => (int)$l_mon3['pv'], 'cv' => (int)$l_mon3['cv'], 'dv' => (int)$l_mon3['dv']),
    'd' => array('pv' => (int)$l_mon4['pv'], 'cv' => (int)$l_mon4['cv'], 'dv' => (int)$l_mon4['dv']),
    'e' => array('pv' => (int)$l_mon5['pv'], 'cv' => (int)$l_mon5['cv'], 'dv' => (int)$l_mon5['dv']),
    'f' => array('pv' => (int)$l_mon6['pv'], 'cv' => (int)$l_mon6['cv'], 'dv' => (int)$l_mon6['dv']),
    'g' => array('pv' => (int)$l_mon7['pv'], 'cv' => (int)$l_mon7['cv'], 'dv' => (int)$l_mon7['dv'])
);

$year_ago = 'select c_id, ifnull(sum(purchase_volume),0) as pv, ifnull(sum(consumption_volume),0) as cv, ifnull(sum(disposal_volume),0) as dv
from graph
where LAST_DAY(DATE_SUB(CURRENT_DATE(),INTERVAL 12 MONTH)) > graph_date && graph_date >= date_format(DATE_SUB(CURRENT_DATE(),INTERVAL 1 MONTH), \'%Y-%m-01\')
and u_id = 1000
group by c_id';

$result = $dbc->showFood($year_ago);
$ya1 = $result[0];
$ya2 = $result[1];
$ya3 = $result[2];
$ya4 = $result[3];
$ya5 = $result[4];
$ya6 = $result[5];
$ya7 = $result[6];

$year_ago_cv = array(
    'a' => array('cv' => (int)$ya1['cv'], 'dv' => (int)$ya1['dv']),
    'b' => array('cv' => (int)$ya2['cv'], 'dv' => (int)$ya2['dv']),
    'c' => array('cv' => (int)$ya3['cv'], 'dv' => (int)$ya3['dv']),
    'd' => array('cv' => (int)$ya4['cv'], 'dv' => (int)$ya4['dv']),
    'e' => array('cv' => (int)$ya5['cv'], 'dv' => (int)$ya5['dv']),
    'f' => array('cv' => (int)$ya6['cv'], 'dv' => (int)$ya6['dv']),
    'g' => array('cv' => (int)$ya7['cv'], 'dv' => (int)$ya7['dv'])
);

$record = "select date_format(graph_date,'%Y-%m') as record, sum(purchase_volume) as pv, sum(consumption_volume) as cv, sum(disposal_volume) as dv
from graph
where now() >= graph_date &&
      graph_date >= date_format(DATE_SUB(CURRENT_DATE(), INTERVAL 11 MONTH), '%Y-%m-01')
group by date_format(graph_date,'%Y-%m')
order by date_format(graph_date,'%Y-%m')";

$result = $dbc->showFood($record);

