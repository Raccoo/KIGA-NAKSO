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
                <form>
                    <div class="form-group">
                        <label for="CreateUserName">ユーザー名</label>
                        <input type="name" class="form-control" id="CreateUserName" required placeholder="きが　なくそう">
                    </div>
                    <div class="form-group">
                        <label for="CreateUserId">ユーザーid</label>
                        <input type="text" class="form-control" id="CreateUserName" required placeholder="kiganakso">
                    </div>
                    <div class="form-group">
                        <label for="CreateEmail2">Eメールアドレス</label>
                        <input type="email" class="form-control" id="CreateEmail2" required placeholder="example@email.com">
                        <small class="text-muted">あなたのメールは他の誰とも共有しません。</small>
                    </div>
                    <div class="form-group">
                        <label for="CreatePassword2">パスワード</label>
                        <input type="password" class="form-control" id="CreatePassword2" required placeholder="パスワード">
                    </div>
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="CreateCheck">
                        <label class="form-check-label" for="CreateCheck">記憶する</label>
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
