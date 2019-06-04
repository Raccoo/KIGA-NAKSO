<?php
//セッションを開始させる
if(!isset($_SESSION)){
    session_start();
}

//セッション情報としてu_idと名前
$u_id = isset($_SESSION['u_id']) ?  $_SESSION['u_id']:'';
$u_name = isset($_SESSION['u_name']) ? $_SESSION['u_name']:'';

//セッション情報にu_idと名前が保持されていない場合
if(empty($u_id) || empty($u_name)){
    //クッキーにu_idと名前が保持されているなら取得
    if(isset($_COOKIE['u_id']) && isset($_COOKIE['u_name'])){
        $u_id = $_COOKIE['u_id'];
        $u_name = $_COOKIE['u_name'];
    }
}

//u_idと名前をセッション情報として保持する
$_SESSION["u_id"] = $u_id;
$_SESSION["u_name"] = $u_name;


?>