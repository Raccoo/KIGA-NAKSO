<?php

require_once __DIR__ . '/dbdata.php';

class Food extends DbData {

    public function showFood($sql){
        $stmt = $this->pdo->query($sql);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $results;
    }

//    public function addFood($u_id, $f_id){
//        //冷蔵庫にある食材を更新
//        $end_day = $this->pdo->query('select ');
//        $sql = "insert into refrigerator (u_id,f_id/*,end_day*/)values(?, ?/*, ?*/)";
//        $expiry_data = $this->pdo->query('select expiry_date from master_food where = '. $f_id );
//        /*$end_day = date("Y-m-d",strtotime($expiry_data));*/
//        $this->exe($sql, [$u_id, $f_id, /*$end_day*/]);
//    }
}