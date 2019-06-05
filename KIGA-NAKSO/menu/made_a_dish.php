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
  
  try{
    $dbc = new DbData();
    $items = $dbc->searchRecipe($query);

    $reffoods_and_query = [];
    foreach ($items as $item) {
      if ( empty($item) || $item['ref_int'] - $item['f_volume_int'] < 0 ) {
        header("Location: ./recipe_search.php?alert=2");
        exit;
      }
      else {
        $temp['query'] = "INSERT INTO refrigerator (u_id, f_id, end_day, ref_int)
          VALUES (:u_id, :f_id, :end_day, :ref_int)";
        $reffoods_and_query[] = array_merge($item, $temp);
      }
    }

    $uid = 1;//$_SESSION['uid'];
    /*
    foreach ( $reffoods_and_query as $one_query ) {
      $ref_delete_query = "DELETE FROM refrigerator WHERE f_id = :f_id";
      $dbc->DeleteRefrigator($ref_delete_query, $one_query['f_id']);

      $dbc->InsertRefrigator($one_query['query'], $uid, $one_query['f_id'], $one_query['end_day'], $one_query['sum_ref'] - $one_query['f_volume_int']);
    }
    
    header("Location: ./recipe_search.php?alert=1");
    */
  }
  catch( Exception $e ) {}
