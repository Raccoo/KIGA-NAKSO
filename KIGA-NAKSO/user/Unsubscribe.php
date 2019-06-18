<?php

require_once __DIR__ . '/../db/dbdata.php';
  $dbc = new DbData();

session_start();

$u_id=$_SESSION['u_id'];

 //Userオブジェクトの生成
 require_once __DIR__ . '/../db/user.php';
 $user = new User();
 $result = $user->DeleteUser($u_id);

 session_start();

//セッションに保存されている情報を空に
$_SESSION = array();

//クッキーに保存されているセッションID（PHPSESID）も無効にし、セッションを破棄する。
$_SESSION = [];
if (isset($_COOKIE[session_name()])){
	setcookie(session_name(),'',time() - 1000,'/');
}
	
session_destroy();

header('location:login.php');
exit();

?>