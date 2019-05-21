<?php       
class  DbData {    // DbDataクラスの宣言   
      
  protected  $pdo;   // PDOオブジェクト用のプロパティ（メンバ変数）の宣言   
  
  public function __construct( ) {   // コンストラクタ   
    // PDOオブジェクトを生成する       
    $dsn = 'mysql:host=localhost;dbname=kiga_nakso;charset=utf8';       
    $user = 'nakso';
    $password = 'kiga';
    
    try{
      $this->pdo = new PDO($dsn, $user, $password);       
    } catch(Exception  $e){
      echo 'Error:' . $e->getMessage();
      die( );       
    }       
  }       
      
  public function searchRecipe($sql) {
    $stmt = $this->pdo->query($sql);
    $items = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $items;
  }
}       
