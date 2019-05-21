<?php
  require_once __DIR__ . '/../components/header.php';
	require_once __DIR__ . '/../db/dbdata.php';
	
	$dbc = new DbData();
?>
<head>
	<title>おすすめのレシピ紹介</title>
</head>
<body>
	<br>
	<div class="container">
<?php
	session_start();
	
	// debug
	$_SESSION['user_id'] = 1;
	
	$user_id = $_SESSION['user_id'];
	$query = '';
	$result = $dbc->searchRecipe($query);
?>
	</div>

<?php
	require_once __DIR__ . '/../components/footer.php';
?>