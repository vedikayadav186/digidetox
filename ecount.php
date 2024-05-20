<?php
// Include the database connection file
include 'database.php';

// Fetch all etype values from the users table
$sql = "SELECT etype FROM users";
$result = mysqli_query($conn, $sql);

// Check if the query was successful
if ($result) {
    // Initialize an array to store the count of each specified e-waste type
    $eWasteTypes = [
        "Mobile" => 0,
        "Charger" => 0,
        "Headphones" => 0,
        "Smartwatch" => 0,
        "Router" => 0,
        "Printer" => 0,
        "Camera" => 0,
        "Solar_Panels" => 0,
        "Microwave" => 0,
        "Refrigerator" => 0,
        "Motherboard" => 0,
        "Tablet" => 0
    ];

    // Loop through the results and count each specified e-waste type
    while ($row = mysqli_fetch_assoc($result)) {
        $types = explode(',', $row['etype']); // Split etype string into an array
        foreach ($types as $type) {
            $type = trim($type); // Trim any extra whitespace
            if (array_key_exists($type, $eWasteTypes)) {
                $eWasteTypes[$type]++;
            }
        }
    }

    // Start HTML output
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin - E-Waste Count</title>
        <!-- Bootstrap CSS -->
        <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css'>
        <!-- Custom CSS -->
        <style>
            body {
                font-family: Arial, sans-serif;
                margin: 15px;
                padding: 0;
                background-color: #f2f2f2;
            }

            h2 {
                color: #333;
                background-color: #106466;
                /* Dark blue background for h2 */
                color: #fff;
                /* White text color for h2 */
                padding: 20px;
                /* Padding for h2 */
                margin: 0;
            }

            table {
                width: 100%;
                border-collapse: collapse;
                margin-top: 20px;
            }

            th,
            td {
                padding: 10px;
                text-align: left;
                border-bottom: 1px solid #ddd;
            }

            th {
                background-color: #106466;
                font-weight: bold;
            }

            tr:hover {
                background-color: #e9e9e9;
            }

            button {
                padding: 5px 10px;
                background-color: #4CAF50;
                color: white;
                border: none;
                cursor: pointer;
                border-radius: 5px;
                margin-top: 50px;
                /* Added margin-top */
            }

            .btn-primary {
                color: #fff;
                background-color: #007bff;
                border-color: #007bff;
                margin: 15px;
            }

            button:hover {
                background-color: #45a049;
            }
        </style>
    </head>

    <body>
        <div class='container'>
            <h2>Admin - E-Waste Count</h2>
            <div class="table-responsive">
                <table>
                    <thead class='thead-dark'>
                        <tr>
                            <th>E-Waste Type</th>
                            <th>Count</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Loop through the eWasteTypes array and display each item in the table
                        foreach ($eWasteTypes as $type => $count) {
                            echo "<tr>";
                            echo "<td>{$type}</td>";
                            echo "<td>{$count}</td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <a href="admin.php" class="btn btn-primary">Back to Dashboard</a>
        </div>
    </body>

    </html>
<?php
} else {
    // Display an error message if the query fails
    echo "Error retrieving e-waste count: " . mysqli_error($conn);
}

// Close the database connection
mysqli_close($conn);
?>
