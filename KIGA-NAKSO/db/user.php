<?php
 
 require_once __DIR__ . '/dbdata.php';

class User extends DbData{
  //ログイン処理
  public function authUser($address){
    $sql = "select * from user where address = ?";
    $stmt = $this->query($sql,[$address]);
		return $stmt->fetch();
		$result=$password;
  }

  public function signUP($u_name, $password, $address){
    $sql ="select * from user where address = ?";
			$stmt = $this->query($sql,[$address]);
			$result = $stmt->fetch();
			//登録しようしているEメールがすでに登録されている場合
			if ($result['address']) {
				$_SESSION['signup_error']='入力されたEメールアドレスはすでに登録されています。';
				header('location:signup.php');
    		exit();
			}
			$sql = "insert into user(u_name, password, address) values(?,?,?)";
			$result = $this->exec($sql, [$u_name, $password, $address]);

			
		}

  public function DeleteUser($u_id){
	$sql="DELETE FROM user WHERE u_id = ?";
	$stmt = $this->pdo->prepare($sql);
	$stmt->execute([$u_id]);
  }

}

