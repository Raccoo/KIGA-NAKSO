<?php
  require_once __DIR__ . '/../components/header.php';
?>

<html>
<body>
    
<div class="container">
    <div class="mx-auto" style="width: 550px;">
        <div class="card" id="simple-card">
            <div class="card-header">
                ログイン
            </div>
            <div class="card-body" id="simple-card-body">
                <p class="card-text">
                <?php 
                    if(isset($_SESSION['login_error'])){
                        echo '<p id="error_call">' . $_SESSION['login_error'] . '</p>';
                        unset($_SESSION['login_error']);

                    }
                ?>
                <form method="POST" action="login_db.php">
                    <div class="form-group">
                        <label >Eメールアドレス</label>
                        <input type="text" class="form-control" name="address" required placeholder="example@email.com">
                        <small class="text-muted">あなたのメールは他の誰とも共有しません。</small>
                    </div>
                    <div class="form-group">
                        <label>パスワード</label>
                        <input type="password" class="form-control" name="password" required placeholder="パスワード">
                    </div>
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" name="check_user">
                        <label class="form-check-label">記憶する</label>
                    </div>
                        <button type="submit" class="btn btn-primary">ログイン</button>
                    </form>
                    <div class="center">
                        <a href="signup.php">新規登録はこちら</a>
                    </div>
                
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
