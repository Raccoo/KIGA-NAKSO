<?php

require_once __DIR__ . '/dbdata.php';

class Food extends DbData {

    public function showFood($sql){
        $stmt = $this->pdo->query($sql);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $results;
    }

    public function set_food($sql) {
       return $stmt = $this->pdo->prepare($sql);
    }

    // レシピに重複した食材が表示される問題を修正する関数
    public static function getUniqueFoodArray($array) {
        $tmp = [];
        $uniqueStations = [];
        foreach ($array as $item){
            if (!in_array($item['f_name'], $tmp)) {
                $tmp[] = $item['f_name'];
                $uniqueStations[] = $item;
            }
        }
        return $uniqueStations;
    }
}