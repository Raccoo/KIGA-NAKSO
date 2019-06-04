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
      die();       
    }       
  }       
      
  public function searchRecipe($sql) {
    $stmt = $this->pdo->query($sql);
    $items = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $items;
  }

  // INSERT INTO refrigerator (u_id, f_id, end_day, ref_int) VALUES (:u_id, :f_id, :end_day, :ref_int)
  public function InsertRefrigator($sql, $u_id, $f_id, $end_day, $ref_int) {
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(':u_id', $u_id, PDO::PARAM_INT);
    $stmt->bindValue(':f_id', $f_id, PDO::PARAM_INT);
    $stmt->bindParam(':end_day', $end_day, PDO::PARAM_STR);
    $stmt->bindValue(':ref_int', $ref_int, PDO::PARAM_INT);
    
    $stmt->execute();
  }

  // DELETE FROM refrigerator WHERE f_id = :f_id
  public function DeleteRefrigator($sql, $f_id) {
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(':f_id', $f_id, PDO::PARAM_INT);
    
    $stmt->execute();
  }
}