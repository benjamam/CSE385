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

$content .= '<form method="post" action="insert.php">
			<div class="form-group"><label for="sel1">What would you like to do?: </label>
			  <select class="form-control" id="sel1" name="control">
				<option value="foodItem">Create New Food Item</option>
				<option value="recipe">Create New Recipe</option>
				<option value="meal">Create New Meal</option>
				<option value="menu">Create New Menu</option>
			  </select>
			  <input class="btn btn-primary pull-right" type="submit" name="submit"/>
			</div>
			</form>';

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
		<label for="recipeName">Recipe Name: </label><input type="text" name="recipeName" required><br>
		<label for="recipeDirections">Recipe Directions: </label><textarea type="text" name="recipeDirections" style="width: 70%;" required></textarea>
		<input class="btn btn-primary pull-right" type="submit" name="submit" />
		</form>';
	
	} else if ($_POST['control'] == "meal") {
	
		$content .= '<form method="POST" action="insert.php">
		<label for="mealName">Meal Name: </label><input type="text" name="mealName" required><br>
		<div class="form-group">
  		<label for="sel3">Food Group: </label>
  			<select class="input-large" id="sel3" name="type">
   			<option value="bre">Breakfast</option>
   			<option value="lun">Lunch</option>
    		<option value="din">Dinner</option>
    		<option value="des">Dessert</option>
    		<option value="sna">Snack</option>
  			</select>
			</div>
		<input class="btn btn-primary pull-right" type="submit" name="submit" />
		</form>';
	
	} else if ($_POST['control'] == "menu") {
	
		$content .= '<form method="POST" action="insert.php">
		<label for="menuName">Menu Name: </label><input type="text" name="menuName" required><br>
		<label for="startDate">Start Date: </label><input type="text" name="startDate" required>(MM/DD/YY)<br>
		<label for="endDate">End Date: </label><input type="text" name="endDate" required>(MM/DD/YY)<br>
		<input class="btn btn-primary pull-right" type="submit" name="submit" />
		</form>';
	
	}
	
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

if (isset($_POST['recipeName'])) {

	$recipeId = 0;

	$sql = "SELECT MAX(RecipeId) FROM Recipe;";
	
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			$recipeId = $row['MAX(RecipeId)'];
		}
		$recipeId++;
	}

	$sql = "INSERT INTO Recipe VALUES ('" .
	$recipeId . "', '" .		
	$_POST['recipeName'] . "', '" .
	$_POST['recipeDirections'] .
	"');";

	if ($conn->query($sql) === TRUE) {
		
		$content .= "<div content='container'>";
		$content .= "Select the food to add to recipe:";
	
		$sql = "SELECT * FROM FoodItem ORDER BY FoodId;";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
			// output data of each row
			$content .= "<form method='POST' action='insert.php?addToRec=1'><table class='table-striped table'>";
			$content .= "<tr><th>Food: </th><th>Quantity: </th>";
			while($row = $result->fetch_assoc()) {
					$content .= "<tr><td>" . $row['FoodId'] . "</td><td><label for='" . $row['FoodId'] . "'><input type='text' name='" . $row['FoodId']. "'><td><tr>";
			}
			$content .= "</table><input class='btn btn-primary pull-right' type='submit' name='submit' /></form>";
			
		}
	
	
		$content .= '</div>';
	} else {
		$content .= '<div class="jumbotron">Error: ' . $conn->error . "</div>";
	}
}

if (isset($_POST['mealName'])) {

	$mealId = 0;

	$sql = "SELECT MAX(MealId) FROM Meal;";
	
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			$mealId = $row['MAX(MealId)'];
		}
		$mealId++;
	}

	$sql = "INSERT INTO Meal VALUES ('" .
	$mealId . "', '" .		
	$_POST['mealName'] . "', '" .
	$_POST['type'] .
	"');";

	if ($conn->query($sql) === TRUE) {
		$content .= '<form>ADD FORM</form';
	} else {
		$content .= '<div class="jumbotron">Error: ' . $conn->error . "</div>";
	}
}

if (isset($_POST['menuName'])) {

	$menuId = 0;

	$sql = "SELECT MAX(MenuId) FROM MenuPlan;";
	
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			$mealId = $row['MAX(MenuId)'];
		}
		$menuId++;
	}

	$sql = "INSERT INTO MenuPlan VALUES ('" .
	$menuId . "', '" .		
	$_POST['menuName'] . "', '" .
	$_POST['startDate'] . "', '" .
	$_POST['endDate'] .
	"');";

	if ($conn->query($sql) === TRUE) {
		$content .= '<form>ADD FORM</form';
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