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

if (isset($_POST['control'])) {
	
	$content .= '<div class="container">';
	
	if ($_POST['control'] == "foodItem") {
	
		$content .= '<form method="POST" action="insert.php">
		<label for="foodName">Food Name: </label><input type="text" name="foodName" required>
		<div class="form-group">
  		<label for="sel2">Food Group: </label>
  			<select class="input-large" id="sel2" name="foodGroup">
   			<option value="Vegetables">Vegetables</option>
   			<option value="Fruit">Fruit</option>
    		<option value="Grain">Grain</option>
    		<option value="Protein">Protein</option>
    		<option value="Dairy">Dairy</option>
  			</select>
			</div>
		<label for="price">Price: $</label><input name="price" type="number" step="any" required><br>
		<label for="carbs">Carbs (g): </label><input name="carbs" type="number" step="any" required><br>
		<label for="protein">Protein (g): </label><input name="protein" type="number" step="any" required><br>
		<label for="sodium">Sodium (mg): </label><input name="sodium" type="number" step="any" required><br>
		<label for="sugar">Sugar (g): </label><input name="sugar" type="number" step="any" required>	<br>
		<label for="calories">Calories: </label><input name="calories" type="number" step="any" required><br>
		<label for="fat">Fat (g): </label><input name="fat" type="number step="any" required><br>
		<input class="btn btn-primary pull-right" type="submit" name="submit" />
		</form>';
	
	
	} else if ($_POST['control'] == "recipe") {
	
		$content .= '<form method="POST" action="insert.php">
		<label for="recipeName">Recipe Name: </label><input type="text" name="recipeName" required>
		<input class="btn btn-primary pull-right" type="submit" name="submit" />
		</form>';
	
	} else if ($_POST['control'] == "meal") {
	
	} else if ($_POST['control'] == "menu") {
	
	}
	
	$content .= '</div>';
	
} else {
	
	// What would you like to do?

	$content .= '<div class="container">';

	$content .= '<form method="post" action="insert.php">
	<div class="form-group">
	  <label for="sel1">What would you like to do?:</label>
	  <select class="input-large" id="sel1" name="control">
		<option value="foodItem">Create New Food Item</option>
		<option value="recipe">Create New Recipe</option>
		<option value="meal">Create New Meal</option>
		<option value="menu">Create New Menu</option>
	  </select>
	  <input class="btn btn-primary pull-right" type="submit" name="submit"/>
	</div>
	</form>';

	$content .= '</div>';
	
}
	
// perform inserts
if (isset($_POST['foodName'])) {

	$sql = "INSERT INTO FoodItem VALUES ('" .
	$_POST['foodName'] . "', '" .		
	$_POST['foodGroup'] . "', '" .
	$_POST['price'] . "', '" .
	$_POST['carbs'] . "', '" .
	$_POST['protein'] . "', '" .
	$_POST['sodium'] . "', '" .
	$_POST['calories'] . "', '" .
	$_POST['fat'] . "', '" .
	"');";

	if ($conn->query($sql) === TRUE) {
		$content .= '<div class="jumbotron">Item Added</div>';
	} else {
		$content .= '<div class="jumbotron">Error: ' . $conn->error . "</div>";
	}
}

$conn->close();
?>


<!doctype html>
<html lang="en">
	<head>
		<title>Add New Items</title>
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