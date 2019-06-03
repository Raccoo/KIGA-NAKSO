<?php
  require_once __DIR__ . '/../components/header.php';
?>

<html>
<body>
    
<div class="container">
    <div class="mx-auto" style="width: 550px;">
        <div class="card" id="simple-card">
            <div class="card-header">
                新規登録
            </div>
            <div class="card-body" id="simple-card-body">
                <p class="card-text">
                <form method="POST" action="">
                    <div class="form-group">
                        <label>ユーザー名</label>
                        <input type="name" class="form-control" name="u_name" required placeholder="きが　なくそう">
                    </div>
                    <div class="form-group">
                        <label for="CreateEmail2">Eメールアドレス</label>
                        <input type="email" class="form-control" name="address" required placeholder="example@email.com">
                        <small class="text-muted">あなたのメールは他の誰とも共有しません。</small>
                    </div>
                    <div class="form-group">
                        <label>パスワード</label>
                        <input type="password" class="form-control" name="password" required placeholder="パスワード">
                    </div>
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="check_user">
                        <label class="form-check-label">記憶する</label>
                    </div>
                        <button type="submit" class="btn btn-primary">新規登録</button>
                    </form>
                
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
