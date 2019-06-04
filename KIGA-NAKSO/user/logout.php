<?php
	//セッションに保存されている情報を空にし、
	//クッキーに保存されているセッションID（PHPSESID）も無効にし、セッションを破棄する。
	$_SESSION = [];
	if (isset($_COOKIE[session_name()])){
		setcookie(session_name(),'',time() - 1000,'/');
    }
    
    $_SESSION = array();
	//session_destroy();

	//ユーザーIDと名前のクッキー情報も破棄する
	setcookie('u_id',   '' , time() - 1000,'/');
	setcookie('u_name', '' , time() - 1000,'/');
    
	//強制遷移
    //header("Location:login.php");
    
?>

<?php
  require_once __DIR__ . '/../components/header.php';
?>

<html>
<body>
    
<div class="container">
    <div class="mx-auto" style="width: 550px;">
        <div class="card" id="simple-card">
            <div class="card-header">
                ログアウト
            </div>
            <div class="card-body" id="simple-card-body">
                <p class="card-text">
                    ログアウトしました。<br>
                    <a href="login.php" class="text-center">ログインする</a>

                </p>
            </div>
        </div>
    </div>

</div>

</body>
</html>

<?php
  require_once __DIR__ . '/../components/footer.php';
?>
