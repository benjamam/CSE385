<?php

session_start();

$servername = "localhost";
$username = "cse385";
$password = "bizfik19"; //needs to be changed
$dbname = "cse385";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$content = "";
	
if(isset($_GET['createAccount'])) {

	$content .= '<h1>Create Account:</h1>';
	$content .= '<form action="?setAccount" method="post">';
	$content .= '<label for="name" style="text-align: right;width: 150px;float: left;">Name:</label><input type="text" name="name"><br>';
	$content .= '<label for="email" style="text-align: right;width: 150px;float: left;">Email:</label><input type="text" name="email"><br>';
	$content .= '<label for="password" style="text-align: right;width: 150px;float: left;">Password:</label><input type="text" name="password">(12 or less characters)<br>';
	$content .= '<input type="submit" class="btn btn-primary">'; //href="?setAccount=1"
	$content .= "</form>";
	
} else if(isset($_GET['setAccount'])) {

	$sql = "INSERT INTO Customer VALUES ('" . $_POST['email'] . "', '" . $_POST['name'] . "', '" . $_POST['password'] . "');";
	
	if ($conn->query($sql) === TRUE) {
    	echo "New account created successfully";
	} else {
    	echo "Error: " . $sql . "<br>" . $conn->error;
	}
	
} else {
	
	$content .= "<h1>Login:</h1>";
	$content .= '<form action="welcome.php" method="post">';
	$content .= '<label for="email" style="text-align: right;width: 150px;float: left;">Email:</label><input type="text" name="email"><br>';
	$content .= '<label for="password" style="text-align: right;width: 150px;float: left;">Password:</label><input type="password" name="password"><br>';
	$content .= '<input type="submit" class="btn btn-primary">';
	$content .= '</form>';
	$content .= "<h1>Or:</h1>";
	$content .= '<a href="?createAccount" type="button" class="btn btn-primary">Create Account</a>';
	
}

?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
    	<title>Welcome Page</title>
    	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    </head>
	<body>

		<div class="container">
			<?=$content?>
		</div>
		
	</body>
</html>

