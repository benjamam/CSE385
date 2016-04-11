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

//FoodGroup

echo "<h1>Table name: Food Group</h1>";

$sql = "SELECT * FROM FoodGroup;";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "GroupName: " . $row["GroupName"] . "<br>" . "Description: " . $row["Description"] . "<br>";
    }
} else {
    echo "0 results";
}

// FoodItem

echo "<h1>Table name: Food Item</h1>";

$sql = "SELECT * FROM FoodItem;";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "FoodId: " . $row["FoodId"] . "<br>" . "FGroup: " . $row["FGroup"] . "<br>" . "Price: " . $row["Price"] . "<br>" . "Carbs: " . $row["Carbs"] . "<br>"
        		. "Protn: " . $row["Protn"] . "<br>" . "Sod: " . $row["Sod"] . "<br>" . "Sug: " . $row["Sug"] . "<br>" . "Cal: " . $row["Cal"] . "<br>" . "Fat: " . $row["Fat"] . "<br>";
    	echo "<br>";
    }
} else {
    echo "0 results";
}

// Recipe

echo "<h1>Table name: Recipe</h1>";

$sql = "SELECT * FROM Recipe;";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "RecipeId: " . $row["RecipeId"] . "<br>" . "Name: " . $row["Name"] . "<br>" . "Directions: " . $row["Directions"] . "<br>";
    	echo "<br>";
    }
} else {
    echo "0 results";
}

// Category

echo "<h1>Table name: Category</h1>";

$sql = "SELECT * FROM Category;";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "RecipeId: " . $row["RecipeId"] . "<br>" . "CategoryName: " . $row["CaregoryName"] . "<br>";
        echo "<br>";
    }
} else {
    echo "0 results";
}

// Meal

echo "<h1>Table name: Meal</h1>";

$sql = "SELECT * FROM Meal;";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "MealId: " . $row["MealId"] . "<br>" . "MealName: " . $row["MealName"] . "<br>";
        echo "<br>";
    }
} else {
    echo "0 results";
}

// MenuPlan

echo "<h1>Table name: Menu Plan</h1>";

$sql = "SELECT * FROM MenuPlan;";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "MenuId: " . $row["MenuId"] . "<br>" . "MenuName: " . $row["MenuName"] . "<br>" . "Start: " . $row["Start"] . "<br>" . "End: " . $row["End"] . "<br>";
        echo "<br>";
    }
} else {
    echo "0 results";
}

// InMenu

echo "<h1>Table name: In Menu</h1>";

$sql = "SELECT * FROM InMenu;";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "MenuId: " . $row["MenuId"] . "<br>" . "MealId: " . $row["MealId"] . "<br>";
        echo "<br>";
    }
} else {
    echo "0 results";
}

// Eats

echo "<h1>Table name: Eats</h1>";

$sql = "SELECT * FROM Eats;";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "Email: " . $row["Email"] . "<br>" . "MenuId: " . $row["MenuId"] . "<br>";
        echo "<br>";
    }
} else {
    echo "0 results";
}

// InRecipe

echo "<h1>Table name: In Recipe</h1>";

$sql = "SELECT * FROM InRecipe;";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "FoodId: " . $row["FoodId"] . "<br>" . "Recipe: " . $row["Recipe"] . "<br>" . "Number: " . $row["Number"] . "<br>" . "Unit: " . $row["Unit"] . "<br>";
        echo "<br>";
    }
} else {
    echo "0 results";
}

// InMeal

echo "<h1>Table name: In Meal</h1>";

$sql = "SELECT * FROM InMeal";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "RecipeId: " . $row["RecipeId"] . "<br>" . "MealId: " . $row["MealId"] . "<br>";
        echo "<br>";
    }
} else {
    echo "0 results";
}

// Customer

echo "<h1>Table name: Customer</h1>";

$sql = "SELECT * FROM Customer";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "Email: " . $row["Email"] . "<br>" . "CustomerName: " . $row["CustomerName"] . "<br>" . "Password: " . $row["Password"] . "<br>";
        echo "<br>";
    }
} else {
    echo "0 results";
}



$conn->close();
?>
</html>