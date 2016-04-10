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

// Control flow here:
	//'create tables' to create the tables
	//'pyramid' to populate food pyramid
	//''test' to print users

$action ="test";

if ($action == 'create tables') {

	// create food group
	$sql = "CREATE TABLE IF NOT EXISTS FoodGroup (
		GroupName VARCHAR(12) not null,
		Description VARCHAR(200),
		PRIMARY KEY (GroupName)
		);";

	if ($conn->query($sql) === TRUE) {
    	echo "Table created successfully";
	} else {
    	echo "Error creating table: " . $conn->error;
	}
	
	// create food item
	$sql = "CREATE TABLE IF NOT EXISTS FoodItem (
		FoodId VARCHAR(30) not null,
		FGroup VARCHAR(12) not null, 
		Price DECIMAL(10,5) not null,
		Carbs DECIMAL(10,5) not null,
		Protn DECIMAL(10,5) not null,
		Sod DECIMAL(10,5) not null,
		Sug DECIMAL(10,5) not null,
		Cal DECIMAL(10,5) not null,
		Fat DECIMAL(10,5) not null,
		primary key(FoodId),
		FOREIGN KEY(FGroup) REFERENCES FoodGroup (GroupName) ON DELETE CASCADE ON UPDATE CASCADE
		);";

	if ($conn->query($sql) === TRUE) {
    	echo "Table created successfully";
	} else {
    	echo "Error creating table: " . $conn->error;
	}
	
	// create recipe
	$sql = "CREATE TABLE IF NOT EXISTS Recipe (
		RecipeId INTEGER PRIMARY KEY,
		Name VARCHAR (20) not null,
		Directions VARCHAR(500)
		);";

	if ($conn->query($sql) === TRUE) {
    	echo "Table created successfully";
	} else {
    	echo "Error creating table: " . $conn->error;
	}
	
	// create category
	$sql = "CREATE TABLE IF NOT EXISTS Category (
		RecipeId INTEGER PRIMARY KEY,
		CategoryName VARCHAR(20)
		);";

	if ($conn->query($sql) === TRUE) {
    	echo "Table created successfully";
	} else {
    	echo "Error creating table: " . $conn->error;
	}
	
	// create meal
	$sql = "CREATE TABLE IF NOT EXISTS Meal (
		MealId INTEGER PRIMARY KEY,
		MealName VARCHAR(20) not null,
		Type CHAR(5)
		);";

	if ($conn->query($sql) === TRUE) {
    	echo "Table created successfully";
	} else {
    	echo "Error creating table: " . $conn->error;
	}
	
	// create menuplan
	$sql = "CREATE TABLE IF NOT EXISTS MenuPlan (
		MenuId INTEGER PRIMARY KEY,
		MenuName VARCHAR(20),
		Start DATE,
		End DATE
		);";

	if ($conn->query($sql) === TRUE) {
    	echo "Table created successfully";
	} else {
    	echo "Error creating table: " . $conn->error;
	}
	
	// create inMenu
	$sql = "CREATE TABLE IF NOT EXISTS InMenu (
		MenuId INTEGER not null,
		MealId INTEGER not null,
		PRIMARY KEY (MenuId, MealId),  
		FOREIGN KEY(MenuId) REFERENCES MenuPlan (MenuId) ON DELETE CASCADE ON UPDATE CASCADE,
		FOREIGN KEY(MealId) REFERENCES Meal (MealId) ON DELETE CASCADE ON UPDATE CASCADE
		);";

	if ($conn->query($sql) === TRUE) {
    	echo "Table created successfully";
	} else {
    	echo "Error creating table: " . $conn->error;
	}
	
	// create eats
	$sql = "CREATE TABLE IF NOT EXISTS Eats (
		Email varchar(30) not null,
		MenuId integer not null,
		primary key(Email,MenuId),
		foreign key(MenuId) references MenuPlan(MenuId) on delete cascade on update cascade,
		foreign key(Email) references Customer(Email) on delete cascade on update cascade
		);";

	if ($conn->query($sql) === TRUE) {
    	echo "Table created successfully";
	} else {
    	echo "Error creating table: " . $conn->error;
	}
	
	// create inRecipe
	$sql = "CREATE TABLE IF NOT EXISTS InRecipe (
		FoodId VARCHAR(30) not null,
		RecipeId integer not null,
		Number decimal(5,2) not null,
		Unit varchar(8),
		primary key(FoodId,RecipeId),
		foreign key(FoodId) references FoodItem(FoodId) on delete cascade on update cascade,
		foreign key(RecipeId) references Recipe(RecipeId) on delete cascade on update cascade
		);";

	if ($conn->query($sql) === TRUE) {
    	echo "Table created successfully";
	} else {
    	echo "Error creating table: " . $conn->error;
	}
	
	// create inMeal
	$sql = "CREATE TABLE IF NOT EXISTS InMeal(
		RecipeId integer not null, 
		MealId integer not null,
		primary key(RecipeId,MealId),
		foreign key(RecipeId) references Recipe(RecipeId) on delete cascade on update cascade
		);";

	if ($conn->query($sql) === TRUE) {
    	echo "Table created successfully";
	} else {
    	echo "Error creating table: " . $conn->error;
	}
	
	// create customer
	$sql = "CREATE TABLE IF NOT EXISTS Customer (
		Email VARCHAR(30) not null,
		CustomerName VARCHAR(40),
		Password VARCHAR(12),
		primary key(Email)
		);";

	if ($conn->query($sql) === TRUE) {
    	echo "Table created successfully";
	} else {
    	echo "Error creating table: " . $conn->error;
	}
	
}

if ($action == "pyramid") {

	$sql = 'INSERT INTO FoodGroup ( GroupName, Description ) VALUES ( "Vegetables", "Vegetables and legumes or beans");';
	
	if ($conn->query($sql) === TRUE) {
    	echo "Table updated successfully<br>";
	} else {
    	echo "Error updating table:  <br>" . $conn->error  . "<br>";
	}

	$sql = "INSERT INTO FoodGroup (GroupName, Description) VALUES ('Fruit', 'Fruit');";
	
	if ($conn->query($sql) === TRUE) {
    	echo "Table updated successfully<br>";
	} else {
    	echo "Error updating table:  <br>" . $conn->error  . "<br>";
	}
	
	$sql = "INSERT INTO FoodGroup (GroupName, Description) VALUES ('Grain', 'Grain (cereal) foods, mostly wholegrain and/or high cereal fibre varieties');";
	
	if ($conn->query($sql) === TRUE) {
    	echo "Table updated successfully<br>";
	} else {
    	echo "Error updating table:  <br>" . $conn->error . "<br>";
	}

	$sql = "INSERT INTO FoodGroup (GroupName, Description) VALUES ('Protein', 'Lean meats and poultry, fish, eggs, tofu, nuts and seeds and legumes/beans');";
	
	if ($conn->query($sql) === TRUE) {
    	echo "Table updated successfully<br>";
	} else {
    	echo "Error updating table:  <br>" . $conn->error . "<br>";
	}

	$sql = "INSERT INTO FoodGroup (GroupName, Description) VALUES ('Dairy', 'Milk, yoghurt cheese and/or alternatives, mostly reduced fat');";
	
	if ($conn->query($sql) === TRUE) {
    	echo "Table updated successfully<br>";
	} else {
    	echo "Error updating table: <br>" . $conn->error . "<br>";
	}
	
}

if ($action == 'test') {

$sql = "SELECT * FROM FoodItem;";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "Name: " . $row["FoodId"]. "<br>";
    }
} else {
    echo "0 results";
}

$result = $conn->query('DESCRIBE FoodGroup');
while($row = $result->fetch_assoc()) {
    echo "{$row['Field']} - {$row['Type']}<br>";
}

}

if ($action == 'fix') {

	$sql = "SET FOREIGN_KEY_CHECKS=1;"; //
	
	if ($conn->query($sql) === TRUE) {
    	echo "Table updated successfully<br>";
	} else {
    	echo "Error updating table: <br>" . $conn->error . "<br>";
	}

}


$conn->close();
?>