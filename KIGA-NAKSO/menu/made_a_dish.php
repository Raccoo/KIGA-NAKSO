<?php
  require_once __DIR__ . '/../db/dbdata.php';
  require_once __DIR__ . '/../db/food.php';

  $recipe_id = htmlspecialchars($_POST['recipe_id']);
  if ( empty($recipe_id) ) {
    header("Location: ./recipe_search.php");
	  exit;
  }

  $query = "SELECT refrigerator.f_id, recipe_food.f_volume_int, refrigerator.end_day, SUM(refrigerator.ref_int) as sum_ref
    FROM recipe_food INNER JOIN refrigerator on recipe_food.f_id = refrigerator.f_id 
    WHERE recipe_food.r_id = "
    . $recipe_id . 
    " GROUP BY refrigerator.f_id, recipe_food.f_volume_int, refrigerator.end_day";
  

  $dbc = new DbData();
  $items = $dbc->searchRecipe($query);

  // debug
  foreach($items as $item) {
    echo "f_id : " . $item['f_id'] . "<br>";
    echo "ref_int : " . $item['sum_ref'] . "<br>";
    echo "f_volume_int : " . $item['f_volume_int'] . "<br>";
    echo "end_day : " . $item['end_day'] . "<br><br>";
  }

  echo "<hr>";

  $reffoods_and_query = [];
  foreach ($items as $item) {
    /*
    if ( empty($item) || $item['ref_int'] - $item['f_volume_int'] < 0 ) {
      header("Location: ./recipe_search.php?error=1");
	    exit;
    }
    else {
    */
      $temp['query'] = "UPDATE refrigerator SET ref_int = " 
        . ($item['sum_ref'] - $item['f_volume_int']) 
        . " WHERE f_id = " . $item['f_id'];
      $reffoods_and_query[] = array_merge($item, $temp);
      //$dbc->execQuery($query);
    //}
  }

  print_r($reffoods_and_query);
  echo "<br><hr><br>";

  foreach ( $reffoods_and_query as $one_reffood_and_query ) {
    echo $$one_reffood_and_query['query'] . "<br>";
    $ref_delete_query = "DELETE FROM refrigerator WHERE f_id = " . $$one_reffood_and_query['f_id'] ;
    echo $ref_delete_query . "<br>";
  }
  //$query = "DELETE FROM refrigerator WHERE ref_int <= 0";
  //$dbc->execQuery($query);
  
