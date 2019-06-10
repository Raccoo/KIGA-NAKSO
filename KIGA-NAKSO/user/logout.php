<?php
	//セッションに保存されている情報を空にし、
	//クッキーに保存されているセッションID（PHPSESID）も無効にし、セッションを破棄する。
	$_SESSION = [];
	if (isset($_COOKIE[session_name()])){
		setcookie(session_name(),'',time() - 1000,'/');
    }
    
	session_destroy();

	//ユーザーIDと名前のクッキー情報も破棄する
	//setcookie('address',   '' , time() - 1000,'/');
	//setcookie('password', '' , time() - 1000,'/');

	//強制遷移
    header("Location:login.php");  

?>
