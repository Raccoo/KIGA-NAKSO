<?php
 function h($data){
     return htmlspecialchars($data, ENT_QUOTES, "UTF-8");
 }

 require_once __DIR__ . '/../db/dbdata.php';
 $dbc = new DbData();

 //送られてきたu_idとパスワードを受け取りエスケープ
 $address = h($_POST['address']);
 $password = h($_POST['password']);

 //Userオブジェクト生成、認証処理
 require_once __DIR__ . '/../db/user.php';
 $user = new User();
 $result = $user->authUser($address,$password);

 //セッションスタート
 session_start();

 //ログインに失敗
 if(!isset($result['address'])){
    $_SESSION['login_error']='Eメールアドレス、パスワードを確認してください。';
    header('location:login.php');
    exit();
 }

 //データベースからu_idと名前を取り出す
 $u_name = $result['u_name'];
 $u_id = $result['u_id'];

 //ユーザー情報をセッションに保持
 $_SESSION['u_id'] = $u_id;
 $_SESSION['u_name'] = $u_name;
 $_SESSION['password'] = $result['password'];
 $_SESSION['address'] = $result['address'];

 //クッキーに保持
  //setcookie("address",$u_id,time()+60*60*24*14,'/');
  //setcookie("password",$password,time()+60*60*24*14,'/');

  require_once __DIR__ . '/../components/header.php';

  header('location:../food/stock_food.php');

  require_once __DIR__ . '/../components/footer.php';
?>