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

// Insert queries here




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