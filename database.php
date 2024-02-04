<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$database = "gdsc";

// Create connection
$conn = new mysqli($servername, $username, $password, $database) or die(mysqli_error());

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $latitude = floatval($_POST['latitude']);
    $longitude = floatval($_POST['longitude']);
    $price = floatval($_POST['price']);

    // Prepare SQL statement to insert data into the table
    $sql = "INSERT INTO charging_stations (latitude, longitude, price) VALUES ('$latitude', '$longitude', '$price')";

    // Execute SQL statement
    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    
} else {
    // Handle case where form is not submitted
    echo "Form not submitted";
}

// Close connection
$conn->close();
?>

