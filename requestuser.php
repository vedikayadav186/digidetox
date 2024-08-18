<?php
session_start();
// if (isset($_SESSION["userId"])) {
//     $userId = $_SESSION["userId"];
//     echo "userId is set: " . $userId;
// } else {
//     echo "userId is not set in the session.";
// } ?>
<!DOCTYPE html>
<html lang='en'>

<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Pickup Requests</title>
    <style>
        /* CSS for navbar */
        header {
            background: linear-gradient(135deg, #00feba, #5b548a);
            padding: 10px 20px;
            margin-bottom: 5px;
        }

        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        nav a {
            text-decoration: none;
            color: #fff; /* White text color for navbar links */
            padding: 10px 10px;
        }

        .profile-info {
            font-weight: 700;
            font-size: 24px; /* Reduced font size */
        }

        .button {
            background-color: #0d2640;
            color: white;
            border-radius: 5px;
            text-decoration: none;
            padding: 10px 20px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .button:hover {
            background-color: #420851;
        }

        /* CSS for table */
        body {
            font-family: Arial, sans-serif;
            color: #333; /* Dark text color */
            margin: 0;
            padding: 20px;
        }

        h1 {
            background-color: #106466; /* Dark blue background for h1 */
            color: #fff; /* White text color for h1 */
            padding: 20px; /* Padding for h1 */
            margin: 0; /* Remove default margin for h1 */
            text-align: center; /* Center the heading text */
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
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

        .success-message {
            background-color: #5cb85c; /* Bootstrap success color */
            color: #fff;
            padding: 10px;
            margin-top: 20px;
            border-radius: 5px;
            display: none;
            text-align: center; /* Center the success message */
        }

        .container {
            max-width: 900px; /* Adjust container width */
            margin: 0 auto; /* Center the container */
        }
    </style>
</head>

<body>
<header>
        <nav>
            <a href="#">
                <div class="profile-info">
                    <span>DigiDetOX</span>
                </div>
            </a>
        </nav>
    </header>

    <div class='container'>
        <h1>Pickup Requests</h1>
        <table>
            <tr>
                <th>Form NO.</th>
                <th>Name</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Scheduled Pickup Date</th>
            </tr>
            <?php
            // Include your database connection file
            require_once "database.php";

            // Check if userId is set in the session again (for safety)
            if (isset($_SESSION["userId"])) {
                // Get userId from the session
                $userId = $_SESSION["userId"];
                
                // Define database connection constants
                define('DBNAME', 'e-waste');
                define('DBUSER', 'root');
                define('DBPASS', '');
                define('DBHOST', 'localhost');

                try {
                    // Create a PDO database connection
                    $db = new PDO("mysql:host=" . DBHOST . ";dbname=" . DBNAME, DBUSER, DBPASS);
                    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    // Prepare and execute the SQL query
                    $stmt = $db->prepare("SELECT userId, name, start_date, end_date, schedule_date FROM users WHERE userId = :userId");
                    $stmt->execute(['userId' => $userId]);

                    // Fetch all rows as associative array
                    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    // Loop through the result and display data in HTML table rows
                    foreach ($result as $row) {
                        echo "<tr>
                            <td>{$row['userId']}</td>
                            <td>{$row['name']}</td>
                            <td>{$row['start_date']}</td>
                            <td>{$row['end_date']}</td>
                            <td>";

                        // Display the scheduled pickup date or "Not Scheduled" if empty
                        if (!empty($row['schedule_date'])) {
                            echo $row['schedule_date']; // Display the scheduled date
                        } else {
                            echo "Not Scheduled"; // Display "Not Scheduled" status
                        }

                        echo "</td>
                            </tr>";
                    }

                    // Close the table
                    echo "</table>";

                    // Success message container (hidden by default)
                    echo "<div id='success_message' class='success-message'>Pickup date scheduled successfully.</div>";

                } catch (PDOException $e) {
                    // Display an error message if connection or query fails
                    echo "Connection failed: " . $e->getMessage();
                }
            } else {
                // Display a message if userId is not set in the session
                echo "User ID not set.";
            }
            ?>
    </div>

    <!-- JavaScript to hide success message after 3 seconds -->
    <script>
        setTimeout(function () {
            document.getElementById('success_message').style.display = 'none';
        }, 3000); // 3000 milliseconds = 3 seconds
    </script>
</body>

</html>