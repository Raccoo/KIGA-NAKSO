<?php

    session_start();

    require_once __DIR__ . '/../components/header.php';

?>
<html>
<body>
<div class="container">
    <div class="mx-auto" style="width: 550px;">
        <div class="card" id="simple-card">
            <div class="card-header">
                ユーザー情報
            </div>
            <div class="card-body" id="simple-card-body">
                <p class="card-text">
                    <div class="form-group">
                        <label>ユーザー名</label>
                        <input type="text" class="form-control" disabled name="u_name" value="<?=$_SESSION['u_name']?>">
                    </div>
                    <div class="form-group">
                        <label>Eメールアドレス</label>
                        <input type="email" class="form-control" disabled name="address" value="<?=$_SESSION['address']?>">
                    </div><br>
                    <div class="center">
                        <button id="D_User" class="btn btn-outline-danger">退会する</button>
                    </div>
                </p>
            </div>
        </div>
    </div>
</div>

<script> 
    $('#D_User').on('click', function(){
        var result = confirm('本当に退会しますか?\n登録したユーザー情報と冷蔵庫の中身は削除されます');
        if(result){
            alert('退会しました。');
            location.href='unsubscribe.php';
        }
    });
</script>
</body>
</html>

<?php
  require_once __DIR__ . '/../components/footer.php';
?>