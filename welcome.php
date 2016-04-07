<?php

$servername = "localhost";
$username = "root";
$password = "3Topper3"; //needs to be changed
$dbname = "test";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Database connected successfully";



// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}


$sql = "SELECT Email, Password FROM users";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
	// output data of each row
	while($row = $result->fetch_assoc()) {
        if($row["Email"] == $_POST["email"] && $row["Password"] == $_POST["password"]){
            echo "Successful Login!";

            header("Location: main.php"); /* Redirect browser */
            exit();
        }
	}
} else {
	echo "Unsuccessful login";
}

echo "Unsuccessful login";


$conn->close();



?>


