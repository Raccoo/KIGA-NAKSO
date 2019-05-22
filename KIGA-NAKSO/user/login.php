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
                <form>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Eメールアドレス</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" required placeholder="example@email.com">
                        <small class="text-muted">あなたのメールは他の誰とも共有しません。</small>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">パスワード</label>
                        <input type="password" class="form-control" id="exampleInputPassword1" required placeholder="パスワード">
                    </div>
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1">記憶する</label>
                    </div>
                        <button type="submit" class="btn btn-primary">ログイン</button>
                    </form>
                    <div class="center">
                        <a href="create-user.php">新規登録はこちら</a>
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
