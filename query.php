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

	if ($_POST['control'] == 'user') {

		$sql = "SELECT CustomerName, Email FROM Customer;";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
			// output data of each row
			$content .= "<table class='table-striped table'>";
			$content .= "<tr><th>Name: </th><th>Email: </th></tr>";
			while($row = $result->fetch_assoc()) {
				if ($_POST['search'] == $row['CustomerName'] or $_POST['search'] == $row['Email'])
					$content .= "<tr><td>" . $row['CustomerName'] . "</td><td>" . $row['Email'] . "</td></tr>";
			}
			$content .= "</table>";
		} else {
			$content .= "<div class='jumbotron'>0 results</div>";
		}

	} else if ($_POST['control'] == 'foodItem') {

		$sql = "SELECT * FROM FoodItem;";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
			// output data of each row
			$content .= "<table class='table-striped table'>";
			$content .= "<tr><th>Food: </th><th>Food Group: </th><th>Price: </th><th>Carbs: </th><th>Protein: </th><th>Sodium: </th><th>Sugar: </th><th>Calories: </th><th>Fat: </th></tr>";
			while($row = $result->fetch_assoc()) {
				if ($_POST['search'] == $row['FGroup'] or $_POST['search'] == $row['FoodId'])
					$content .= "<tr><td>" . $row['FoodId'] . "</td><td>" . $row['FGroup'] . "</td><td> $" . 
					$row['Price'] . "</td><td>" . $row['Carbs'] . "</td><td>" . $row['Protn'] . 
					"</td><td>" . $row['Sod'] . "</td><td>" . $row['Sug'] . "</td><td>" . 
					$row['Cal'] . "</td><td>" . $row['Fat'] . "</td></tr>";
			}
			$content .= "</table>";
		} else {
			$content .= "<div class='jumbotron'>0 results</div>";
		}

	} else if ($_POST['control'] == 'recipe') {

		$sql = "SELECT Name, Directions FROM Recipe;";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
			// output data of each row
			$content .= "<table class='table-striped table'>";
			$content .= "<tr><th>Name: </th><th>Directions: </th></tr>";
			while($row = $result->fetch_assoc()) {
				if ($_POST['search'] == $row['Name'])
					$content .= "<tr><td>" . $row['Name'] . "</td><td>" . $row['Directions'] . "</td></tr>";
			}
			$content .= "</table>";
		} else {
			$content .= "<div class='jumbotron'>0 results</div>";
		}


	} else if ($_POST['control'] == 'meal') {

		$sql = "SELECT MealName FROM Meal;";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
			// output data of each row
			$content .= "<table class='table-striped table'>";
			$content .= "<tr><th>Name: </th></tr>";
			while($row = $result->fetch_assoc()) {
				if ($_POST['search'] == $row['MealName'])
					$content .= "<tr><td>" . $row['MealName'] . "</td></tr>";
			}
			$content .= "</table>";
		} else {
			$content .= "<div class='jumbotron'>0 results</div>";
		}

	} else if ($_POST['control'] == 'menu') {

		$sql = "SELECT MenuName FROM MenuPlan;";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
			// output data of each row
			$content .= "<table class='table-striped table'>";
			$content .= "<tr><th>Name: </th><th>Start Date: </th><th>End Date:</th></tr>";
			while($row = $result->fetch_assoc()) {
				if ($_POST['search'] == $row['MenuName'])
					$content .= "<tr><td>" . $row['MenuName'] . "</td><td>" . $row['Start'] . "</td><td>" . $row['End'] . "</td></tr>";
			}
			$content .= "</table>";
		} else {
			$content .= "<div class='jumbotron'>0 results</div>";
		}

	} else if ($_POST['control'] == 'mealNut') {

		$content .= '<form method="POST" action="query.php?quer=1">
		<div class="form-group">
  		<label for="sel4">Nutrient </label>
  			<select class="input-large" id="sel4" name="nutrient">
   			<option value="Carbs">Carbohydrates</option>
   			<option value="Protn">Protein</option>
    		<option value="Sod">Sodium</option>
    		<option value="Sug">Sugar</option>
    		<option value="Cal">Calories</option>
    		<option value="Fat">Fat</option>
  			</select>
			</div>
		<div class="form-group">
  		<label for="sel4">Nutrient </label>
  			<select class="input-large" id="sel4" name="moreLess">
   			<option value=">"> More than </option>
   			<option value="<"> Less than </option>
  			</select>
			</div>
		<label for="quantity">Quantity: </label><input type="number" step="any" name="quantity" required><br>
		<input class="btn btn-primary pull-right" type="submit" name="submit" />
		</form>';
	
	} else if ($_POST['control'] == 'userMeals') {

		$sql = "SELECT CustomerName, MenuName
			FROM Customer LEFT JOIN Eats ON Customer.Email = Eats.Email LEFT JOIN MenuPlan ON Eats.MenuId = MenuPlan.MenuId;";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
			// output data of each row
			$content .= "<table class='table-striped table'>";
			$content .= "<tr><th>Name: </th><th>Menu: </th></tr>";
			while($row = $result->fetch_assoc()) {
					$content .= "<tr><td>" . $row['CustomerName'] . "</td><td>" . $row['MenuName'] . "</td></tr>";
			}
			$content .= "</table>";
		} else {
			$content .= "<div class='jumbotron'>0 results</div>";
		}
	
	}

	$content .= '</div>';

} else if (isset($_GET['quer']) AND $_GET['quer'] == 1) {
	
	$sql = "SELECT Name
		FROM Recipe NATURAL JOIN InRecipe NATURAL JOIN FoodItem
		GROUP BY RecipeId
		HAVING SUM(" . $_POST['nutrient'] . ") " . $_POST['moreLess'] . $_POST['quantity'] . ";";
		
	$result = $conn->query($sql);
	
	if ($result->num_rows > 0) {
			// output data of each row
			$content .= "<table class='table-striped table'>";
			$content .= "<tr><th>Recipe: </th></tr>";
			while($row = $result->fetch_assoc()) {
					$content .= "<tr><td>" . $row['Name'] . "</td></tr>";
			}
			$content .= "</table>";
		} else {
			$content .= "<div class='jumbotron'>0 results</div>";
		}
	
} else {

// What would you like to do?

$content .= '<div class="container">';

$content .= '<form method="post" action="query.php">
			<div class="form-group">
  			<label for="sel2">What do you wish to search?: </label>
  				<select class="form-control" id="sel2" name="control">
   				<option value="user">Users (By Name or Email)</option>
   				<option value="foodItem">Food Items (By Name)</option>
    			<option value="recipe">Recipes (By Name)</option>
    			<option value="meal">Meals (By Name)</option>
    			<option value="menu">Menus (By Name)</option>
  				</select>
			</div>
			<label for="search">Search: </label><input type="text" name="search">
			<input class="btn btn-primary pull-right" type="submit" name="submit"/></form>';

$content .= '</div>';

$content .= '<div class="container">';

$content .= '<form method="post" action="query.php">
			<div class="form-group">
  			<label for="sel3">Or search by: </label>
  				<select class="form-control" id="sel3" name="control">
   				<option value="mealNut">Meals (By Nutrients or Price)</option>
  				</select>
			</div>
			<input class="btn btn-primary pull-right" type="submit" name="submit"/></form>';
			
$content .= '</div>';

$content .= '<div class="container">';

$content .= '<form method="post" action="query.php">
			<div class="form-group">
  			<label for="sel4">Or list all by: </label>
  				<select class="form-control" id="sel4" name="control">
   				<option value="userMeals">User</option>
  				</select>
			</div>
			<input class="btn btn-primary pull-right" type="submit" name="submit"/></form>';

$content .= '</div>';

}

$conn->close();
?>


<!doctype html>
<html lang="en">
	<head>
		<title>Search for Items</title>
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