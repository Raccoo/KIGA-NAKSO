<?php
//セッションを開始させる
if(!isset($_SESSION)){
    session_start();
}

//セッション情報としてu_idと名前
$u_id = isset($_SESSION['u_id']) ?  $_SESSION['u_id']:'';
$u_name = isset($_SESSION['u_name']) ? $_SESSION['u_name']:'';

//u_idと名前をセッション情報として保持する
$_SESSION["u_id"] = $u_id;
$_SESSION["u_name"] = $u_name;


?>