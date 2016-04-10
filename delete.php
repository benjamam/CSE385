<?php

session_start();

$content ="";

$servername = "localhost";
$username = "cse385";
$password = "bizfik19"; 
$dbname = "cse385";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$content .= '<div class="container">';

$content .= '<h1>Welcome to Project FOODIE!';

$content .= '<a href="index.php" class="btn btn-primary pull-right">Log Out</a>';

$content .= '<a href="delete.php" class="btn btn-primary pull-right">Delete Items</a>';

$content .= '<a href="insert.php" class="btn btn-primary pull-right">Create Items</a>';

$content .= '<a href="query.php" class="btn btn-primary pull-right">Search Items</a></h1>';

$content .= '</div>';

// What would you like to do?

$content .= '<div class="container">';

$content .= '<form method="post" action="delete.php">
<div class="form-group">
  <label for="sel1">What would you like to do?:</label>
  <select class="form-control" id="sel1" name="control">
    <option value="foodItem">Delete Food Item</option>
    <option value="recipe">Delete Recipe</option>
    <option value="meal">Delete Meal</option>
    <option value="menu">Delete Menu</option>
  </select>
  <input class="btn btn-primary pull-right" type="submit" name="submit"/>
</div>
</form>';

$content .= '</div>';

if (isset($_POST['control'])) {

	$content .= '<div class="container">';

	if ($_POST['control'] == 'foodItem') {
		
		$content .= "<form method='POST' action='delete.php'>
						<label for='foodid'>Enter Food Name:</label><input name='foodid' type='text'>
						</form>";

	} else if ($_POST['control'] == 'recipe') {

		$content .= "<form method='POST' action='delete.php'>
				<label for='recipeid'>Enter Recipe Name:</label><input name='recipeid' type='text'>
				</form>";

	} else if ($_POST['control'] == 'meal') {

		$content .= "<form method='POST' action='delete.php'>
				<label for='mealid'>Enter Meal Name:</label><input name='mealid' type='text'>
				</form>";

	} else if ($_POST['control'] == 'menu') {

		$content .= "<form method='POST' action='delete.php'>
				<label for='menuid'>Enter Menu Name:</label><input name='menuid' type='text'>
				</form>";

	} 

	$content .= '</div>';

	
}

// performs deletes
if(isset($_POST['foodid'])) {

	$content .= '<div class="container">';

	$sql = "DELETE FROM FoodItem WHERE FoodId='" . $_POST['foodid'] . "';";

	if ($conn->query($sql) === TRUE) {
		$content .= '<div class="jumbotron">Item Deleted</div>';
	} else {
		$content .= '<div class="jumbotron">Error: ' . $conn->error . "</div>";
	}
	
	$content .= '</div>';
}

if(isset($_POST['recipeid'])) {

	$content .= '<div class="container">';

	$sql = "DELETE FROM Recipe WHERE Name='" . $_POST['recipeid'] . "';";

	if ($conn->query($sql) === TRUE) {
		$content .= '<div class="jumbotron">Item Deleted</div>';
	} else {
		$content .= '<div class="jumbotron">Error: ' . $conn->error . "</div>";
	}
	
	$content .= '</div>';
}

if(isset($_POST['mealid'])) {

	$content .= '<div class="container">';

	$sql = "DELETE FROM Meal WHERE MealName='" . $_POST['mealid'] . "';";

	if ($conn->query($sql) === TRUE) {
		$content .= '<div class="jumbotron">Item Deleted</div>';
	} else {
		$content .= '<div class="jumbotron">Error: ' . $conn->error . "</div>";
	}
	
	$content .= '</div>';
}

if(isset($_POST['menuid'])) {

	$content .= '<div class="container">';

	$sql = "DELETE FROM MenuPlan WHERE MenuName='" . $_POST['menuid'] . "';";

	if ($conn->query($sql) === TRUE) {
		$content .= '<div class="jumbotron">Item Deleted</div>';
	} else {
		$content .= '<div class="jumbotron">Error: ' . $conn->error . "</div>";
	}
	
	$content .= '</div>';
}

$conn->close();
?>


<!doctype html>
<html lang="en">
	<head>
		<title>Delete Items</title>
		<meta charset="utf-8">
		<style> 
			label {text-align: right;width: 200px;float: left;}
			.input-large { width: 70%;}
		</style>
		<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	</head>
	<body>
		<div class="container">
			<?=$content?>
		</div>
	</body>
</html>