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
}