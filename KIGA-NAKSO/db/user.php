<?php
 
 require_once __DIR__ . '/dbdata.php';

class User extends DbData{
  //ログイン処理
  public function authUser($address, $password){
    $sql = "select * from user where address = ? and password = ?";
    $stmt = $this->query($sql,[$address,$password]);
    return $stmt->fetch();
  }

}
