<?php
  require_once __DIR__ . '/../components/header.php';
  require_once __DIR__ . '/../db/dbdata.php';
  require_once __DIR__ . '/../db/food.php';

  $recipe_id = htmlspecialchars($_POST['recipe']);
  if ( empty($recipe_id) ) {
    header("Location: ./recipe_search.php");
	  exit;
  }

  // get recipe
  $dbc = new DbData();
  $recipe_query = 'SELECT * FROM recipe WHERE r_id = ' . $recipe_id;
  $result = $dbc->searchRecipe($recipe_query);
  $recipe = $result[0];
?>
<head>
	<title>レシピ検索ページ</title>
  <style type="text/css">
    img.food {
      height: 100%;
      width:100%;
    }
  </style>
</head>
<body>
  <br>
	<div class="container">
    <?php 
      echo '<h1>' . $recipe['r_name'] . '</h1>';
      echo '<div class="row">';
      echo '<div class="col-sm-7">';
      echo '<image class="food rounded" src="' . $recipe['r_picture'] . '">';
      echo '</div>';
      echo '<div class="col-sm-5">';
      echo '<table class="table">';
      echo '<thead>
              <tr class="bg-warning">
                  <th>食材</th>
                  <th>使用料</th>
              </tr>
          </thead>
          <tbody>';

      // Get the ingredients used in the recipe from db.
      $foods_name_query = 'SELECT DISTINCT master_food.f_name, recipe_food.f_volume, recipe_food.f_volume_int, SUM(refrigerator.ref_int) as sum_ref
        FROM (recipe_food, master_food) LEFT OUTER JOIN refrigerator ON refrigerator.f_id = recipe_food.f_id
        WHERE recipe_food.r_id = ' 
        . $recipe_id .
        ' AND recipe_food.f_id = master_food.f_id
        GROUP BY master_food.f_name, recipe_food.f_volume, recipe_food.f_volume_int';

      $items = $dbc->searchRecipe($foods_name_query);

      // process to display ingredients.
			foreach ($items as $item) {
        echo '<tr class="table-warning"><th>' . $item['f_name'] . '</th><th>'; 
        
        // regtigetor not in food
        if ( $item['f_id'] != 9 && ( empty($item['sum_ref']) || $item['sum_ref'] < $item['f_volume_int'] ) ) {
          echo '<p style="color: gray">' . $item['f_volume'] . '</p>';
        }
        else {
          echo $item['f_volume'];
        }
        echo '</th></tr>';
      };
      echo '</tbody></table>';


      echo '<table class="table table-sm">';
      echo '<tr class="table-danger"><td>';
      
      $made_dissable_flag = false;
      foreach ($items as $item) {
        if ( empty($item['sum_ref']) || $item['sum_ref'] < $item['f_volume_int'] ) {
          echo  $item['f_name'] . ', ';
          $made_dissable_flag = true;
        }
      }
      echo ' が足りません';
      echo '</td></tr>';
      echo '</table>';
      echo '</div></div><br>';

      echo $recipe['cuisine'];
      echo '</div></div><br>';
    ?>
    <div class="row justify-content-md-center">
      <button onclick="history.back()" class="btn btn-success">レシピ検索に戻る</button>
      <div class="pl-5"></div>
      <?php
        if ( $made_dissable_flag ) {
          echo '<input type="submit" class="btn btn-warning" value="作った！" disabled>';
        } else {
          echo '
          <form action="./made_a_dish.php" method="POST">
            <input type="hidden" name="recipe_id"value="';
          echo $recipe_id;
          echo '">
            <input type="submit" class="btn btn-warning" value="作った！">
          </form>';
        }
      ?>
    </div>
    <br>
  </div>
<?php
  require_once __DIR__ . '/../components/footer.php'
?>