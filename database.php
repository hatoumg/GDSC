<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$database = "gdsc";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize form data
    $address = htmlspecialchars($_POST['address']);
    $city = htmlspecialchars($_POST['city']);
    $province = htmlspecialchars($_POST['province']);
    $postal_code = htmlspecialchars($_POST['postal_code']);
    $country = htmlspecialchars($_POST['country']);
    $price = floatval($_POST['price']);

    // Construct the address string
    $fullAddress = $address . ', ' . $city . ', ' . $province . ', ' . $postal_code . ', ' . $country;

    // Call the Google Maps Geocoding API to get latitude and longitude
    $apiKey = 'AIzaSyDXGg-5yZrV2TN5y8Vf7PC1a5iz2L1V4mE';
    $url = "https://maps.googleapis.com/maps/api/geocode/json?address={$fullAddress}&key={$apiKey}";

    // $response = file_get_contents($url);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_URL, $url);
    $result = curl_exec($ch);
    curl_close($ch);

    $responseData = json_decode($result, true);

    // Check if the API request was successful
    var_dump($responseData);
    if ($responseData['status'] == 'OK') {
        $latitude = $responseData['results'][0]['geometry']['location']['lat'];
        $longitude = $responseData['results'][0]['geometry']['location']['lng'];

        /// Prepare SQL statement to insert data into the table
        $sql = "INSERT INTO charging_stations (address, city, province, postal_code, country, latitude, longitude, price) VALUES ('$address', '$city', '$province', '$postal_code' '$country', '$latitude', '$longitude', '$price')";

        // Execute SQL statement
        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Error: Geocoding API request failed";
    }
} else {
    // Handle case where form is not submitted
    echo "Form not submitted";
}

// Close connection
$conn->close();
?>

