<?php

function h($data){
  return htmlspecialchars($data,ENT_QUOTES,"UTF-8");
}
 
  require_once __DIR__ . '/../db/dbdata.php';
  $dbc = new DbData();

 //変数に代入、エスケープ処理
 $u_name = h($_POST['u_name']);
 $pass_input = h($_POST['password']);
 $Re_password = h($_POST['Re_password']);
 $address = h($_POST['address']);

 $password = password_hash($pass_input, PASSWORD_DEFAULT);

 //セッションスタート
 session_start();

 //メールアドレスのバリデーション
 //if(!fillter_var($address, FILTER_VALIDATE_EMAIL)){
 //　$_SESSION['signup_error']='正しいメールアドレスを入力してください';
 //}

 //パスワードと確認パスワードの合致
 if(!password_verify($Re_password,$password)){
    $_SESSION['signup_error']='確認パスワードが一致しません';
    header('location:signup.php');
    exit();
 }

 //Userオブジェクトの生成
 require_once __DIR__ . '/../db/user.php';
 $user = new User();
 $result = $user->signUp($u_name,$password,$address);

//ユーザー情報をセッションに保持
 $_SESSION['u_name'] = $u_name;
 $_SESSION['address'] = $address;

 //クッキーに保持
  //setcookie("u_id",$u_id,time()+60*60*24*14,'/');
  //setcookie("u_name",$u_name,time()+60*60*24*14,'/');

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
                        <input type="text" class="form-control" disabled name="u_name" value="<?=$_SESSION['u_name']?>">
                    </div>
                    <div class="form-group">
                        <label>パスワード</label>
                        <input type="text" class="form-control" disabled value="****">
                    </div>
                    <div class="form-group">
                        <label>Eメールアドレス</label>
                        <input type="email" class="form-control" disabled name="address" value="<?=$address?>">
                    </div><br>
                    <div class="center">
                        <a class="btn btn-primary" href="login.php" role="button">ログインする</a>
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
