<?php

function h($data){
  return htmlspecialchars($data,ENT_QUOTES,"UTF-8");
}
 
  require_once __DIR__ . '/../db/dbdata.php';
  $dbc = new DbData();

 //変数に代入、エスケープ処理
 $u_id = h($_POST['u_id']);
 $u_name = h($_POST['u_name']);
 $password = h($_POST['password']);
 $address = h($_POST['address']);

 //セッションスタート
 session_start();

 //メールアドレスのバリデーション
 //if(!fillter_var($address, FILTER_VALIDATE_EMAIL)){
 //　$_SESSION['signup_error']='正しいメールアドレスを入力してください';
 //}

 //Userオブジェクトの生成
 require_once __DIR__ . '/../db/user.php';
 $user = new User();
 $result = $user->signUp($u_id,$u_name,$password,$address,$_SESSION['u_id']);

//ユーザー情報をセッションに保持
 $_SESSION['u_id'] = $u_id;
 $_SESSION['u_name'] = $u_name;
 $_SESSION['password'] = $password;
 $_SESSION['address'] = $address;

 //クッキーに保持
  setcookie("u_id",$u_id,time()+60*60*24*14,'/');
  setcookie("u_name",$u_id,time()+60*60*24*14,'/');

  require_once __DIR__ . '/../components/header.php';

?>

<html>
<body>
<div class="container">
    <div class="mx-auto" style="width: 550px;">
        <div class="card" id="simple-card">
            <div class="card-header">
                新規登録の内容
            </div>
            <div class="card-body" id="simple-card-body">
                <p class="card-text">
                    <div class="form-group">
                        <label>ユーザー名</label>
                        <input type="text" class="form-control" name="u_name" value="<?=$u_name?>">
                    </div>
                    <div class="form-group">
                        <label>パスワード</label>
                        <input type="text" class="form-control" name="password" value="<?=$password?>">
                    </div>
                    <div class="form-group">
                        <label>Eメールアドレス</label>
                        <input type="email" class="form-control" name="address" value="<?=$address?>">
                    </div>
                      <button type="submit" class="btn btn-primary" name="CreateUser">ホームへGO!!</button>
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
