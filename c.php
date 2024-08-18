<?php
session_start();
if (!isset($_SESSION["user"])) {
    header("Location: login.php");
    exit();
}

// Debugging statement
echo "Session User ID: " . $_SESSION["user"];


$output = '';
if (isset($_SESSION["user"])) {
    // Include resource data
    include 'resources.php';

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "e-waste"; // Use your actual database name

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $viewUserId = $_SESSION["user"];

    $sql = "SELECT etype FROM users WHERE userId = ?";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("i", $viewUserId);
    $stmt->execute();
    $result = $stmt->get_result();

    $total_ewaste_diverted = 0;
    $resources_saved = [
        'rare_metals' => [],
        'energy_saved' => 0,
    ];

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $ewaste_types = explode(',', htmlspecialchars($row["etype"]));

            foreach ($ewaste_types as $ewaste_type) {
                $ewaste_type = trim($ewaste_type);

                if (isset($resourceData[$ewaste_type])) {
                    $ewaste_data = $resourceData[$ewaste_type];
                    $total_ewaste_diverted += $ewaste_data['ewaste_diverted'];
                    
                    if (!empty($ewaste_data['rare_metals'])) {
                        $resources_saved['rare_metals'] = array_merge($resources_saved['rare_metals'], explode(', ', $ewaste_data['rare_metals']));
                    }
                    
                    if (isset($ewaste_data['energy_saved'])) {
                        $resources_saved['energy_saved'] += (int)str_replace(' kWh', '', $ewaste_data['energy_saved']);
                    }
                }
            }
        }

        $output .= "<h3>Total Resources Saved</h3>";
        $output .= "<p>Total E-Waste Diverted: " . $total_ewaste_diverted . " kg</p>";

        $output .= "<h4>Aggregated Resources Saved:</h4>";
        $output .= "<ul>";
        $output .= "<li>Rare Metals Saved: " . implode(', ', array_unique($resources_saved['rare_metals'])) . "</li>";
        $output .= "<li>Total Energy Saved: " . $resources_saved['energy_saved'] . " kWh</li>";
        $output .= "</ul>";

        // Showing the total amount of resources saved
        $output .= "<h4>Amount of Resources Saved:</h4>";
        $output .= "<ul>";
        $output .= "<li>Total Rare Metals Saved: " . count(array_unique($resources_saved['rare_metals'])) . "</li>";
        $output .= "<li>Total Energy Saved: " . $resources_saved['energy_saved'] . " kWh</li>";
        $output .= "</ul>";

    } else {
        $output .= "<p>No records found for User ID: " . htmlspecialchars($viewUserId) . "</p>";
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Card Showcase</title>
    <link rel="stylesheet" href="cards1.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" crossorigin="anonymous" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <style>
        /* Custom styles for the card grid and e-waste savings */
        .container {
            display: flex;
            justify-content: space-between;
            padding: 20px;
        }

        .card-grid {
            width: 60%;
        }

        .savings-info {
            width: 35%;
            padding: 20px;
            border: 2px solid #420851;
            border-radius: 10px;
            background-color: #f9f9f9;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
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
            <div class="main">
                <a href="fetchlocate.php" class="button request-button">
                    <i class="fa-solid fa-location-crosshairs"></i>
                </a>
                &nbsp;
                <a href="empreg.php" title="logistics icons" class="button request-button">
                    <i class="fa-solid fa-truck-pickup"></i>
                    &nbsp; Dispose E-waste</a>
                &nbsp;

                <a href="ld.php" class="button request-button">
                    <i class="fa-solid fa-coins"></i> Leaderboard
                </a>
                &nbsp;

                <a href="requestuser.php" class="button request-button">
                    <i class="fas fa-cart-plus"></i> Request
                </a>
                &nbsp;

                <a href="logout.php" class="button logout-button">
                    <i class="fa-solid fa-right-from-bracket"></i> Logout
                </a>
            </div>
        </nav>
    </header>

    <div class="container">
        <div class="card-grid">
            <!-- Card Showcase -->
            <div class="card">
                <img src="ui/e22.jpg" alt="Card 1">
                <h2>Mobile E-waste</h2>
                <p>Estimated credits:10</p>
            </div>
            <div class="card">
                <img src="ui/e1.jpeg" alt="Card 1">
                <h2>Charger E-waste</h2>
                <p>Estimated credits:5</p>
            </div>
            <div class="card">
                <img src="ui/e2.jpeg" alt="Card 1">
                <h2>Headphones E-waste</h2>
                <p>Estimated credits:30</p>
            </div>
            <div class="card">
                <img src="ui/e3.jpeg" alt="Card 1">
                <h2>Smartwatch E-waste</h2>
                <p>Estimated credits:15</p>
            </div>
            <div class="card">
                <img src="ui/e4.jpeg" alt="Card 1">
                <h2>Router E-waste</h2>
                <p>Estimated credits:40</p>
            </div>
            <div class="card">
                <img src="ui/e5.jpeg" alt="Card 1">
                <h2>Printer E-waste</h2>
                <p>Estimated credits:45</p>
            </div>
            <div class="card">
                <img src="ui/e6.jpeg" alt="Card 1">
                <h2>Camera E-waste</h2>
                <p>Estimated credits:30</p>
            </div>
            <div class="card">
                <img src="ui/e7.jpeg" alt="Card 1">
                <h2>Solar panels E-waste</h2>
                <p>Estimated credits:50</p>
            </div>
            <div class="card">
                <img src="ui/e15.jpeg" alt="Card 1">
                <h2>Microwave E-waste</h2>
                <p>Estimated credits:70</p>
            </div>
            <div class="card">
                <img src="ui/e16.jpeg" alt="Card 1">
                <h2>Refrigerator E-waste</h2>
                <p>Estimated credits:100</p>
            </div>
            <div class="card">
                <img src="ui/e8.jpeg" alt="Card 1">
                <h2>Motherboards E-waste</h2>
                <p>Estimated credits:40</p>
            </div>
            <div class="card">
                <img src="./ui/e9.jpg" alt="Card 1">
                <h2>Tablets E-waste</h2>
                <p>Estimated credits:30</p>
            </div>
        </div>

        <!-- E-Waste Savings Information -->
        <div class="savings-info">
            <h2>Your E-Waste Savings</h2>
            <?php echo $output; ?>
        </div>
    </div>

    <script>
        // Add any JavaScript logic here if needed
    </script>
</body>
</html>
