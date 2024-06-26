<?php
require_once("config.php");

// Fetch data from the leaderboards table ordered by total_credits in descending order
$sql = "SELECT user_id, username, total_credits FROM leaderboards ORDER BY total_credits DESC";
$stmt = $db->query($sql);
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leaderboard</title>
    <style>
         body {
            text-align: center;
            font-family: Arial, sans-serif;
        }

        h2 {
                background-color: #106466; /* Dark blue background for h1 */
                color: #fff; /* White text color for h1 */
                padding: 20px; /* Padding for h1 */
                margin: 0; /* Remove default margin for h1 */
            }
        table {
            width: 80%;
            margin: 0 auto;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #0ca17e;
            color: #333;
        }
    </style>
</head>
<body>
    <h2>Leaderboard</h2>
    <br>
    
    <table>
        <thead>
            <tr>
                <th>Rank</th>
                <th>User ID</th>
                <th>Username</th>
                <th>Total Credits</th>
            </tr>
        </thead>
        <tbody>
            <?php $serial = 1; ?>
            <?php foreach ($rows as $row): ?>
                <tr>
                    <td><?php echo $serial; ?></td>
                    <td><?php echo $row['user_id']; ?></td>
                    <td><?php echo $row['username']; ?></td>
                    <td><?php echo $row['total_credits']; ?></td>
                </tr>
                <?php $serial++; ?>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>