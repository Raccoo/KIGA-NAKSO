<?php
	session_start();

	//セッションに保存されている情報を空に
	$_SESSION = array();

	//クッキーに保存されているセッションID（PHPSESID）も無効にし、セッションを破棄する。
	$_SESSION = [];
	if (isset($_COOKIE[session_name()])){
		setcookie(session_name(),'',time() - 1000,'/');
    }
	
	session_destroy();
?>
<script>
	alert('ログアウトしました');
    location.href='login.php';
</script>
