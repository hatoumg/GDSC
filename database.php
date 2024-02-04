<?php
// Database connection parameters
$servername = "172.18.98.107";
$username = "member@EV";
$password = "1234";
$database = "gdsc";

// Create connection
$conn = new mysqli($servername, $username, $password, $database) or die(mysqli_error());

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