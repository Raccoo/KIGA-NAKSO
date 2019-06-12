<?php
  require_once __DIR__ . '/../db/dbdata.php';
  require_once __DIR__ . '/../db/food.php';
  
  session_start();
  
  $uid = $_SESSION['u_id'];
  $recipe_id = htmlspecialchars($_POST['recipe_id']);
  if ( empty($recipe_id) ) {
    header("Location: ./recipe_search.php");
	  exit;
  }

  $query = "SELECT 
      refrigeratorA.f_id, 
      recipe_food.f_volume_int, 
      refrigeratorB.sum_ref, 
      refrigeratorB.MaxDay 
    FROM 
      (recipe_food INNER JOIN refrigerator 
          as refrigeratorA 
          on recipe_food.f_id = refrigeratorA.f_id 
      )
      INNER JOIN (SELECT
                    refrigerator.f_id,
                    SUM(refrigerator.ref_int) AS sum_ref,
                    MAX(refrigerator.end_day) AS MaxDay
                  FROM
                    refrigerator
                  GROUP BY
                    refrigerator.f_id
                  ) AS refrigeratorB
      ON refrigeratorA.f_id = refrigeratorB.f_id
      AND refrigeratorA.end_day = refrigeratorB.MaxDay
    WHERE 
      recipe_food.r_id = $recipe_id AND refrigeratorA.u_id = $uid";
  
  try{
    $dbc = new DbData();
    $items = $dbc->searchRecipe($query);

    $reffoods_and_query = [];
    foreach ($items as $item) {
      if ( $item['f_id'] != 9 ) {
        if ( $item['sum_ref'] - $item['f_volume_int'] < 0 ) {
          header("Location: ./recipe_search.php?alert=2");
          exit;
        }
        else {
          $temp['query'] = "INSERT INTO refrigerator (u_id, f_id, end_day, ref_int)
            VALUES (:u_id, :f_id, :end_day, :ref_int)";
          $reffoods_and_query[] = array_merge($item, $temp);
        }
      }
    }

    $uid = $_SESSION['u_id'];
    
    foreach ( $reffoods_and_query as $one_query ) {
      $ref_delete_query = "DELETE FROM refrigerator WHERE f_id = :f_id";
      $dbc->DeleteRefrigator($ref_delete_query, $one_query['f_id']);

      $dbc->InsertRefrigator($one_query['query'], $uid, $one_query['f_id'], $one_query['MaxDay'], $one_query['sum_ref'] - $one_query['f_volume_int']);
    }
    
    header("Location: ./recipe_search.php?alert=1");
  }
  catch( Exception $e ) {}
