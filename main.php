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

if (isset($_GET['query'])) {


} else if (isset($_GET['insert'])) {


} else if (isset($_GET['delete'])) {


} else {

$content .= '<div class="container">';

$content .= '<h1>What would you like to do?</h1>';

$content .= '<div><a href="?query" class="btn btn-primary">Search Menus</a></div>';

$content .= '<div><a href="?insert" class="btn btn-primary">Create New Menu</a></div>';

$content .= '<div><a href="?delete" class="btn btn-primary">Delete Menu</a></div>';

$content .= '</div>';

}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
    	<title>Main</title>
    	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    </head>
	<body>

		<div class="container">
			<?=$content?>
		</div>
		
	</body>
</html>