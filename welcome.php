<?php

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

$sql = "SELECT Email, Password FROM Customer";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
	// output data of each row
	while($row = $result->fetch_assoc()) {
		//echo $row;
        if($row["Email"] == $_POST["email"] && $row["Password"] == $_POST["password"]){
            echo "Successful Login!";

            header("Location: main.php"); /* Redirect browser */
            exit();
        }
	}
} else {
	echo "Unsuccessful login";
}

$content ="";

$content .= "<div class='jumbotron'>Invalid username or password.</div>";

$conn->close();



?>

<!doctype html>
<html lang="en">
	<head>
		<title>Delete Items</title>
		<meta charset="utf-8">
		<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	</head>
	<body>
		<div class="container">
			<?=$content?>
		</div>
	</body>
</html>


