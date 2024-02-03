<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "root";
$database = "gdsc";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve form data
$location = $_POST['location'];
$price = $_POST['price'];

// Prepare SQL statement to insert data into the table
$sql = "INSERT INTO Charging_Station (location, price) VALUES ('$location', '$price')";

// Execute SQL statement
if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close connection
$conn->close();
?>