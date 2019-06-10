<?php
 
 require_once __DIR__ . '/dbdata.php';

class User extends DbData{
  //ログイン処理
  public function authUser($address, $password){
    $sql = "select * from user where address = ? and password = ?";
    $stmt = $this->query($sql,[$address,$password]);
    return $stmt->fetch();
  }

  public function signUP($u_name, $password, $address){
    $sql ="select * from user where address = ?";
			$stmt = $this->query($sql,[$address]);
			$result = $stmt->fetch();
			//登録しようしているEメールがすでに登録されている場合
			if ($result['address']) {
				return 'この' . $address . 'はすでに登録されています。';
			}
			$sql = "insert into user(u_name, password, address) values(?,?,?)";
			$result = $this->exec($sql, [$u_name, $password, $address]);

			
		}
}

