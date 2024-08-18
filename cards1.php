<?php
session_start();
if (!isset($_SESSION["user"])) {
    header("Location: login.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Card Showcase</title>
    <link rel="stylesheet" href="cards1.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <style>
        /* Sidebar styles */
        /* Sidebar styles */
        /* Sidebar styles */
        .sidebar {
            height: 100%;
            width: 250px;
            position: fixed;
            top: 93px;
            /* Adjust according to your navbar height */
            right: -250px;
            /* Hidden by default */
            background: linear-gradient(135deg, #9b8fbc, #5b548a);
            /* Nature-inspired green gradient */
            overflow-x: hidden;
            transition: 0.3s;
            z-index: 1000;
            /* Ensure it appears above other content */
            padding-top: 60px;
            color: #ffffff;
            /* White text color for contrast */
        }

        .sidebar a {
            padding: 10px 15px;
            text-decoration: none;
            font-size: 15px;
            color: #ffffff;
            /* White text color for visibility */
            display: block;
            transition: 0.3s;
        }

        .sidebar a:hover {
            color: #d9f99d;
            /* Light green on hover */
        }

        .sidebar .closebtn {
            position: absolute;
            top: 0;
            right: 1px;
            font-size: 36px;
            color: #ffffff;
            /* White text color */
        }

        .sidebar-open {
            right: 0;
        }

        .main-content {
            transition: margin-right 0.3s;
            padding: 16px;
        }

        .main-content.shifted {
            margin-right: 250px;
        }

        /* sidebzr css */
        #news {
            width: 50%;
            /* Adjust width as needed */
            float: left;
            /* Float the section to the left */
            padding: 20px;
            box-sizing: border-box;
        }

        .news-box {
            border: 2px solid #420851;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
        }

        .news-container {
            background-color: #f9f9f9;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 20px;
            line-height: 1.6;
            transition: background-color 0.3s, box-shadow 0.3s ease;
        }

        .news-container:hover {
            background-color: #f9f9f9;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
        }

        .news-container h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .news-container article {
            line-height: 1.6;
        }

        .news-container p {
            margin-bottom: 10px;
            font-size: 18px;
        }


        /* Optional: Add hover effect */
        .news-container article:hover {
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
        }

        .images {
            margin-left: 800px;
            height: 100px;
        }

        .read-more-btn {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }

        .read-more-btn:hover {
            background-color: #0056b3;
        }

        .full-text {
            display: none;
            /* Initially hide the full text */
        }

        .show-full {
            display: block !important;
            /* Force display the full text when the class is applied */
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
                &nbsp;
                <!-- Profile Button -->
                <a href="#" class="button profile-button" onclick="toggleSidebar()">
                    <i class="fa-solid fa-user"></i> Open Sidebar
                </a>

                <!-- Sidebar -->
                <div id="mySidebar" class="sidebar">
                    <a href="javascript:void(0)" class="closebtn" onclick="toggleSidebar()">×</a>
                    <?php

                    $output = '';

                    // Check if the form has been submitted

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

                    $viewUserId = $_SESSION["userId"];

                    $sql = "SELECT userId, name, etype FROM users WHERE userId = ?";
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
                            $userId = htmlspecialchars($row["userId"]);
                            $userName = htmlspecialchars($row["name"]);
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
                        $output .= "<h3>User Details</h3>";
                        
                        $output .= "<p>User ID: " . $userId . "</p>";
                        $output .= "<p>Name: " . $userName . "</p>";
                        $output .="<h3>E-Waste Savings Viewer</h3>";
                        $output .= "<h5>Total Resources Saved</h5>";
                        $output .= "<p>Total E-Waste Diverted: " . $total_ewaste_diverted . " kg</p>";
                        echo "\r\n";
                        $output .= "<h5>Aggregated Resources Saved:</h5>";
                        $output .= "<ul>";
                        $output .= "<li>Rare Metals Saved: " . implode(', ', array_unique($resources_saved['rare_metals'])) . "</li>";
                        $output .= "<li>Total Energy Saved: " . $resources_saved['energy_saved'] . " kWh</li>";
                        $output .= "<li>Total Rare Metals Saved: " . count(array_unique($resources_saved['rare_metals'])) . "</li>";
                        $output .= "</ul>";

                        // Showing the total amount of resources saved





                        $conn->close();
                    }

                    ?><div class="container">
                        
                        <br>
                        <div id="result"><?php echo $output; ?></div>
                    </div>
                </div>

            </div>

        </nav>
    </header>
    <div class="container">




        <!-- close here -->

        <div class="controls">


        </div>




        <div class="card-grid">
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
                <img src="./ui/e9 .jpg" alt="Card 1">
                <h2>Tablets E-waste</h2>
                <p>Estimated credits:30</p>



            </div>


            <!-- Add more cards here -->
        </div>
    </div>
    <main>
        <section id="news">
            <h2>News/Articles</h2>
            <div class="news-box">
                <article class="news-container">
                    <p>Extract gold and other metals from e-waste</p>
                    <p>To extract valuable metals from discarded computer motherboards, researchers have developed a gold-absorbing material made from old milk. An aerogel made from old milk can extract highly pure gold nuggets from discarded computer motherboards. Discarded electronics, known as e-waste often contain large amounts of gold and other heavy metals. Scientists have come up with methods to recover the valuable metals, but these processes often rely on synthetic chemicals that can damage the environment.</p>
                    <p>
                        DigiDetOX Launches Nationwide E-Waste Collection Drive
                        <br>
                        <br>
                        In a pioneering move towards sustainable e-waste management, DigiDetOX, a leading name in digital detoxification solutions, has announced the launch of a nationwide e-waste collection drive. This initiative aims to address the pressing environmental challenges posed by electronic waste while promoting responsible disposal practices among consumers.
                        <!-- <button class="read-more-btn">Read More</button> -->
                </article>
            </div>
        </section>
        <div class="images">
            <img src="./ui/plastic.webp" alt="..." class="img-thumbnail">
        </div>
    </main>
    <br>
    <script>
        function toggleSidebar() {
            var sidebar = document.getElementById("mySidebar");
            var mainContent = document.getElementById("main");

            // Toggle sidebar open/close
            if (sidebar.style.right === "0px") {
                sidebar.style.right = "-250px";
                mainContent.classList.remove("shifted");
            } else {
                sidebar.style.right = "0px";
                mainContent.classList.add("shifted");
            }
        }
        const cards = document.querySelectorAll('.card');

        cards.forEach(card => {
            card.addEventListener('mouseenter', () => {
                card.style.transform = 'scale(1.05)';
                card.style.backgroundColor = '#f9f9f9';
            });

            card.addEventListener('mouseleave', () => {
                card.style.transform = 'scale(1)';
                card.style.backgroundColor = '#fff';
            });
        });
        document.getElementById('price-filter').addEventListener('change', function() {
            const selectedPrice = this.value;
            const cardsContainer = document.querySelector('.card-grid');
            const cards = Array.from(cardsContainer.querySelectorAll('.card'));

            cards.forEach(card => {
                const cardPrice = parseInt(card.querySelector('.price').innerText.replace('₹', '').replace(',', ''));

                if (selectedPrice === 'all' || (selectedPrice === 'budget' && cardPrice >= 1500 && cardPrice <= 3000) ||
                    (selectedPrice === 'mid-range' && cardPrice > 3000 && cardPrice <= 6000) ||
                    (selectedPrice === 'luxury' && cardPrice > 6000 && cardPrice <= 15000) ||
                    (selectedPrice === 'luxuries' && cardPrice > 15000)) {
                    cardsContainer.insertBefore(card, cardsContainer.firstChild);
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        });
        document.querySelectorAll('.read-more-btn').forEach(button => {
            button.addEventListener('click', () => {
                const fullText = button.parentElement.querySelector('.full-text');
                fullText.classList.toggle('show-full'); // Toggle visibility
                button.style.display = 'none'; // Hide the "Read More" button after clicked
            });
        });
    </script> <!-- Optional: If you need interactivity -->

</body>

</html>