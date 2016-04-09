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

$content .= '<a href="delete.php" class="btn btn-primary pull-right">Delete Menu</a>';

$content .= '<a href="insert.php" class="btn btn-primary pull-right">Create New Menu</a>';

$content .= '<a href="query.php" class="btn btn-primary pull-right">Search Menus</a></h1>';

$content .= '</div>';

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