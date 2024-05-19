<?php
require_once("config.php");

// Function to generate a unique user ID (you can adjust this as needed)
function generateUserId() {
    return uniqid(); // Generates a unique ID based on the current time
}

// Function to calculate total credits based on selected e-waste items
function calculateTotalCredits($selectedEtypes) {
    // Define credit values for each e-waste type
    $creditValues = [
        "Mobile" => 10,
        "Charger" => 5,
        "Headphones" => 30,
        "Smartwatch" => 15,
        "Router" => 40,
        "Printer" => 45,
        "Camera" => 30,
        "Solar_Panels" => 50,
        "Microwave" => 70,
        "Refrigerator" => 100,
        "Motherboard" => 40,
        "Tablet" => 30,
    ];

    $totalCredits = 0;

    // Calculate total credits based on selected e-waste items
    foreach ($selectedEtypes as $selectedEtype) {
        // Check if the selected e-waste item exists in the credit values array
        if (isset($creditValues[$selectedEtype])) {
            $totalCredits += $creditValues[$selectedEtype];
        }
    }

    return $totalCredits;
}
if (isset($_POST['form_submit'])) {
    // Get form data
    //$userId = trim($_POST['userId']); // Ensure the key matches the one in the form
    $name = trim($_POST['name']);
    $phone = trim($_POST['phone']);
    $location = trim($_POST['location']);
    $etype = isset($_POST['etype']) ? implode(",", $_POST['etype']) : "";
    $condition1 = isset($_POST['condition1']) ? trim($_POST['condition1']) : "";
    $quantity = isset($_POST['quantity']) ? trim($_POST['quantity']) : "";
    $service = trim($_POST['service']);
    $start_date = trim($_POST['start_date']);
    $end_date = trim($_POST['end_date']);

    // Calculate total credits based on selected e-waste items
    $totalCredits = calculateTotalCredits($_POST['etype']);
    
    session_start();
    if (isset($_SESSION["userId"])) {
        $userId = $_SESSION["userId"];
        echo "userId is set: " . $userId;
    } else {
        echo "userId is not set in the session.";
    } 
            // Include your database connection file
            require_once "database.php";

            // Check if userId is set in the session again (for safety)
            if (isset($_SESSION["userId"])) {
                // Get userId from the session
                $userId = $_SESSION["userId"];}
                
    // Insert or update user data
    $sql_user = "INSERT INTO users (userId, name, phone, location, etype, condition1, quantity, service, start_date, end_date, total_credits) 
                 VALUES (:userId, :name, :phone, :location, :etype, :condition1, :quantity, :service, :start_date, :end_date, :total_credits)
                 ON DUPLICATE KEY UPDATE userId = :userId, name = :name, location = :location, etype = :etype, condition1 = :condition1, quantity = :quantity,
                 service = :service, start_date = :start_date, end_date = :end_date, total_credits = total_credits + :total_credits";
    
    try {
        $stmt_user = $db->prepare($sql_user);
        $stmt_user->bindParam(':userId', $userId, PDO::PARAM_STR);
        $stmt_user->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt_user->bindParam(':phone', $phone, PDO::PARAM_STR);
        $stmt_user->bindParam(':location', $location, PDO::PARAM_STR);
        $stmt_user->bindParam(':etype', $etype, PDO::PARAM_STR);
        $stmt_user->bindParam(':condition1', $condition1, PDO::PARAM_STR);
        $stmt_user->bindParam(':quantity', $quantity, PDO::PARAM_STR);
        $stmt_user->bindParam(':service', $service, PDO::PARAM_STR);
        $stmt_user->bindParam(':start_date', $start_date, PDO::PARAM_STR);
        $stmt_user->bindParam(':end_date', $end_date, PDO::PARAM_STR);
        $stmt_user->bindParam(':total_credits', $totalCredits, PDO::PARAM_INT);

        // Execute the prepared statement for user data
        $stmt_user->execute();

        // Insert or update leaderboard data
        $sql_leaderboard = "INSERT INTO leaderboards (user_id, username, total_credits) 
                            VALUES (:user_id, :username, :total_credits)
                            ON DUPLICATE KEY UPDATE username = :username, total_credits = total_credits + :total_credits";
        
        $stmt_leaderboard = $db->prepare($sql_leaderboard);
        $stmt_leaderboard->bindParam(':user_id', $userId, PDO::PARAM_STR); // Use $userId here
        $stmt_leaderboard->bindParam(':username', $name, PDO::PARAM_STR);
        $stmt_leaderboard->bindParam(':total_credits', $totalCredits, PDO::PARAM_INT);

        // Execute the prepared statement for leaderboard data
        $stmt_leaderboard->execute();

        // Redirect to success page
        header("location: scheduleConfirm.php");
        exit; // Stop further execution
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}


?>