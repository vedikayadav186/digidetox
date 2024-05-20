<?php
// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "e-waste";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch user's location from the database (assuming you have a table named 'user_locations')
$user_id = $_GET['user_id']; // Get user ID from the request
$sql = "SELECT latitude, longitude FROM user_locations WHERE user_id = '$user_id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of the first row (assuming one location per user)
    $row = $result->fetch_assoc();
    $location = array("latitude" => $row["latitude"], "longitude" => $row["longitude"]);
    echo json_encode($location); // Output as JSON
} else {
    echo json_encode(array("error" => "User location not found"));
}
$conn->close();
?>
