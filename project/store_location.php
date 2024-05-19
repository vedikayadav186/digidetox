<?php
// Establish database connection
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

// Get longitude, latitude, and user ID from the form submission
$lng = $_POST['lng'];
$lat = $_POST['lat'];
// $user_id = $_POST['userId']; // Assuming the input field name is 'userId'

    session_start();
    // if (isset($_SESSION["userId"])) {
    //     $userId = $_SESSION["userId"];
    //     echo "userId is set: " . $userId;
    // } else {
    //     echo "userId is not set in the session.";
    // } 
            // Include your database connection file
            require_once "database.php";

            // Check if userId is set in the session again (for safety)
            if (isset($_SESSION["userId"])) {
                // Get userId from the session
                $userId = $_SESSION["userId"];}
                
// SQL query to insert location into database with user ID
$sql = "INSERT INTO user_locations (user_id, lng, lat) VALUES ('$userId', '$lng', '$lat')";

if ($conn->query($sql) === TRUE) {
    echo "Location stored successfully";
    header("Location: cards1.php");
} else {
    echo "Error storing location: " . $conn->error;
}

$conn->close();
?>
