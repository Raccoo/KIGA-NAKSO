<?php
  require_once __DIR__ . '/../db/dbdata.php';
  require_once __DIR__ . '/../db/food.php';

  $recipe_id = htmlspecialchars($_POST['recipe_id']);
  if ( empty($recipe_id) ) {
    header("Location: ./recipe_search.php");
	  exit;
  }

$query = "SELECT * 
    FROM recipe_food INNER JOIN refrigerator on recipe_food.f_id = refrigerator.f_id 
    WHERE recipe_food.r_id = " . $recipe_id;

  $dbc = new DbData();
  $items = $dbc->searchRecipe($query);
  
  // process to display ingredients.
  foreach ($items as $item) {
    // 冷蔵庫内の食材が足りていなかった場合
    if ( $item['ref_int'] - $item['f_volume_int'] < 0 ) {
      header("Location: ./recipe_search.php?error=1");
	    exit;
    }
    else {
      $query = "UPDATE refrigerator SET ref_int = " . $item['ref_int'] - $item['f_volume_int'] . " WHERE f_id = " . $item['f_id'];
    }
  }

  $query = "DELETE FROM refrigerator WHERE ref_int <= 0";
  $dbc->execQuery($query);
  
