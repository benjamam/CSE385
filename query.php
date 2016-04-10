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

$content .= '<form method="post" action="query.php">
			<div class="form-group">
  			<label for="sel2">What do you wish to search?: </label>
  				<select class="input-large" id="sel2" name="control">
   				<option value="user">Users</option>
   				<option value="foodItem">Food Items</option>
    			<option value="recipe">Recipies</option>
    			<option value="meal">Meals</option>
    			<option value="menu">Menus</option>
  				</select>
			</div>
			<label for="search">Search: </label><input type="text" name="search">
			<input class="btn btn-primary pull-right" type="submit" name="submit"/></form>';

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



	} else if ($_POST['control'] == 'meal') {



	} else if ($_POST['control'] == 'menu') {



	} 

	$content .= '</div>';

}


$conn->close();
?>


<!doctype html>
<html lang="en">
	<head>
		<title>Search for Items</title>
		<meta charset="utf-8">
		<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	</head>
	<body>
		<div class="container">
			<?=$content?>
		</div>
	</body>
</html>