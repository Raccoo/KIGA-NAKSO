<?php

require_once __DIR__ . '/../db/dbdata.php';
  $dbc = new DbData();

session_start();

$u_id=$_SESSION['u_id'];

 //Userオブジェクトの生成
 require_once __DIR__ . '/../db/user.php';
 $user = new User();
 $result = $user->DeleteUser($u_id);

header('location:logout.php');
exit();

?>