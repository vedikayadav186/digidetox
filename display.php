<?php
session_start();
define('DBNAME', 'e-waste');
define('DBUSER', 'root');
define('DBPASS', '');
define('DBHOST', 'localhost');

// Check if the form is submitted to schedule a pickup date
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['schedule_date'])) {
    try {
        $db = new PDO("mysql:host=" . DBHOST . ";dbname=" . DBNAME, DBUSER, DBPASS);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Prepare and execute an UPDATE query to set the schedule date
        $stmt = $db->prepare("UPDATE users SET schedule_date = :schedule_date WHERE wasteId = :wasteId");
        $stmt->bindParam(':schedule_date', $_POST['schedule_date']);
        $stmt->bindParam(':wasteId', $_POST['wasteId']);
        $stmt->execute();

        // Set a success message in the session
        $_SESSION['success_message'] = "Pickup date scheduled successfully.";
    } catch (PDOException $e) {
        echo "Error scheduling pickup date: " . $e->getMessage();
    }
}

try {
    $db = new PDO("mysql:host=" . DBHOST . ";dbname=" . DBNAME, DBUSER, DBPASS);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Perform a SELECT query to fetch data from your database
    $stmt = $db->prepare("SELECT * FROM users");
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Start HTML output with CSS styling
    echo "
    <!DOCTYPE html>
    <html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Pickup</title>
        <style>
            body {
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                background-color: #f4f7f6; /* Light background */
                color: #333; /* Dark text color */
                margin: 0;
                padding: 20px;
            }
            h1 {
                background-color: #106466; /* Dark blue background for h1 */
                color: #fff; /* White text color for h1 */
                padding: 20px; /* Padding for h1 */
                margin: 0; /* Remove default margin for h1 */
            }
            table {
                width: 100%;
                border-collapse: collapse;
                margin-top: 20px;
            }
            th, td {
                padding: 12px;
                border: 1px solid #ddd; /* Light border color */
                text-align: left;
            }
            th {
                background-color: #106466; /* Dark blue header background */
                color: #fff; /* White text color for headers */
            }
            tr:nth-child(even) {
                background-color: #f2f2f2; /* Light gray alternate row color */
            }
            input[type='date'] {
                width: calc(100% - 120px); /* Adjust width to leave space for button */
                padding: 10px;
                margin-right: 10px; /* Add margin between date input and button */
                border: 1px solid #ccc; /* Light border color for input */
                border-radius: 5px;
                box-sizing: border-box; /* Include padding and border in width calculation */
            }
            .schedule-btn {
                background-color: #4CAF50; /* Green background */
                border: none;
                color: white;
                padding: 10px 20px;
                text-align: center;
                text-decoration: none;
                display: inline-block;
                font-size: 14px;
                cursor: pointer;
                border-radius: 5px;
                transition: background-color 0.3s ease; /* Smooth transition on hover */
            }
            .schedule-btn:hover {
                background-color: #45a049; /* Darker green on hover */
            }
            .success-message {
                background-color: #5cb85c; /* Bootstrap success color */
                color: #fff;
                padding: 10px;
                margin-top: 20px;
                border-radius: 5px;
                display: none;
            }
            .container {
                max-width: 1200px;
                margin: 0 auto;
            }
        </style>
    </head>
    <body>
        <div class='container'>
            <h1>Schedule Pickup</h1>";

    // Display success message if set
    if (isset($_SESSION['success_message'])) {
        echo "<div id='success_message' class='success-message'>{$_SESSION['success_message']}</div>";
        unset($_SESSION['success_message']);
    }

    echo "
            <table>
                <tr>
                    <th>ID</th>
                    <th>Location</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Schedule Pickup Date</th>
                </tr>";

    foreach ($result as $row) {
        echo "<tr>
                <td>{$row['wasteId']}</td>
                <td>{$row['location']}</td>
                <td>{$row['start_date']}</td>
                <td>{$row['end_date']}</td>
                <td>";

        // Check if a pickup date is already scheduled for this row
        if (!empty($row['schedule_date'])) {
            echo $row['schedule_date']; // Display the scheduled date
        } else {
            // Display the form to schedule a pickup date with styled button
            echo "<form method='post' action='{$_SERVER['PHP_SELF']}' style='display: flex; align-items: center;'>
                    <input type='hidden' name='wasteId' value='{$row['wasteId']}'>
                    <input type='date' name='schedule_date' required>
                    <button type='submit' class='schedule-btn'>Schedule</button>
                  </form>";
        }

        echo "</td>
              </tr>";
    }

    echo "</table>";
    echo "</div>"; // Close container div

    // End HTML output
    echo "
    <script>
        // Hide the success message after 3 seconds
        setTimeout(function() {
            var successMessage = document.getElementById('success_message');
            if (successMessage) {
                successMessage.style.display = 'none';
            }
        }, 3000); // 3000 milliseconds = 3 seconds
    </script>
    </body>
    </html>
    ";
} catch (PDOException $e) {
    echo "Issue -> Connection failed: " . $e->getMessage();
}
?>
