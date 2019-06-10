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
                <?php 
                    //if(isset($_SESSION['signup_error'])){
                    //    echo '<p id="error_call">' . $_SESSION['signup_error'] . '</p>';
                    //    unset($_SESSION['signup_error']);
                    //
                    //}
                ?>
                <form method="POST" action="signup_db.php">
                    <div class="form-group">
                        <label>ユーザー名</label>
                        <input type="text" class="form-control" name="u_name" required placeholder="きが　なくそう">
                    </div>
                    <div class="form-group">
                        <label>パスワード</label>
                        <input type="password" class="form-control" name="password" required placeholder="パスワード">
                    </div>
                    <div class="form-group">
                        <label>パスワード <span class="badge badge-danger">確認 </span></label>
                        <input type="password" class="form-control" name="Re_password" required placeholder="パスワード">
                    </div> 
                    <div class="form-group">
                        <label>Eメールアドレス</label>
                        <input type="email" class="form-control" name="address" required placeholder="example@email.com">
                        <small class="text-muted">あなたのメールは他の誰とも共有しません。</small>
                    </div>
                    <!-- <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" name="CreateCheck">
                        <label class="form-check-label" for="CreateCheck">記憶する</label>
                    </div> -->
                    <div class="center">
                        <button type="submit" class="btn btn-primary" name="CreateUser">新規登録</button>
                    </div>
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
