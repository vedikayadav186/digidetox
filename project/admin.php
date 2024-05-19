<?php
include('database.php');
?>

<!DOCTYPE html>
<html>

<head>
    <title></title>
    <style>
        a {
            text-decoration: none;
            color: #fff;
            font-size: 20px;
            font-weight: bold;
        }

        body {
            margin: 0px;
            padding: 0px;
            background-color: #4E8074;
            overflow: hidden;
            font-family: system-ui;
        }

        .clearfix {
            clear: both;
        }

        .logo {
            margin: 0px;
            margin-left: 28px;
            font-weight: bold;
            color: white;
            margin-bottom: 30px;
            font-size: 35px;
        }

        .sidenav {
            height: 100%;
            width: 300px;
            position: fixed;
            z-index: 1;
            top: 0;
            left: 0;
            background-color: #4E8074;
            overflow: hidden;
            transition: 0.5s;
            padding-top: 30px;
        }

        .sidenav a {
            padding: 15px 8px 15px 32px;
            text-decoration: none;
            font-size: 20px;
            color: #e0d4d4;
            display: block;
            transition: 0.3s;
        }

        .sidenav a:hover {
            color: #f1f1f1;
            background-color: #4E8074;
        }

        .box a {
            font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
            text-decoration: none;
            font-size: 35px;
            color: #fff;
        }

        #main {
            transition: margin-left .5s;
            padding: 16px;
            margin-left: 300px;
        }

        .head {
            padding: 20px;
        }

        .col-div-6 {
            width: 50%;
            float: left;
        }

        .profile {
            display: inline-block;
            width: 160px;
            color: white;
            font-weight: 500;
            margin-left: 55px;
            margin-top: 10px;
            font-size: 20px;
            /* Increase text size */
        }

        .profile i {
            font-size: 32px;
            /* Increase icon size */
        }

        .nav2 {
            display: none;
        }

        .col-div-3 {
            width: 25%;
            float: left;
        }

        .box {
            width: 85%;
            height: 150px;
            background-color: #67BAA6;
            margin-left: 10px;
            padding: 10px;
        }

        .box:hover {
            background-color: #C6FCED;
            transition: 0.5s;
        }

        .box p {
            font-size: 20px;
            color: white;
            font-weight: bold;
            line-height: 30px;
            padding-left: 10px;
            margin-top: 20px;
            display: inline-block;
        }

        .box p span {
            font-size: 20px;
            font-weight: 400;
            color: #fff;
        }

        .box-icon {
            font-size: 40px !important;
            float: right;
            margin-top: 35px !important;
            color: #fff;
            padding-right: 10px;
        }

        .col-div-8 {
            width: 70%;
            float: left;
        }

        .col-div-4 {
            width: 30%;
            float: left;
        }

        .content-box {
            padding: 20px;
        }

        .content-box p {
            margin: 0px;
            font-size: 20px;
            color: #ddd;
        }

        .content-box p span {
            float: right;
            background-color: #ddd;
            padding: 3px 10px;
            font-size: 15px;
            color: #4E8074;
        }

        .box-8,
        .box-4 {
            width: 96.5%;
            background-color: #67BAA6;
            height: 330px;
        }

        .box-8 {
            margin-left: 10px;
            width: 95%;
        }

        .box-8:hover {
            background-color: #C6FCED;
            transition: 0.5s;
        }

        .box-4:hover {
            background-color: #C6FCED;
            transition: 0.5s;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        td,
        th {
            text-align: center;
            padding: 15px;
            color: #ddd;
            border-bottom: 1px solid #5f171749;
        }

        .circle-wrap {
            margin: 50px auto;
            width: 150px;
            height: 150px;
            background: #e6e2e7;
            border-radius: 50%;
        }

        .circle-wrap .circle .mask,
        .circle-wrap .circle .fill {
            width: 150px;
            height: 150px;
            position: absolute;
            border-radius: 50%;
        }

        .circle-wrap .circle .mask {
            clip: rect(0px, 150px, 150px, 75px);
        }

        .circle-wrap .circle .mask .fill {
            clip: rect(0px, 75px, 150px, 0px);
            background-color: #dc7405;
        }

        .circle-wrap .circle .mask.full,
        .circle-wrap .circle .fill {
            animation: fill ease-in-out 3s;
            transform: rotate(126deg);
        }

        @keyframes fill {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(126deg);
            }
        }

        .circle-wrap .inside-circle {
            width: 130px;
            height: 130px;
            border-radius: 50%;
            background: #fff;
            line-height: 130px;
            text-align: center;
            margin-top: 10px;
            margin-left: 10px;
            position: absolute;
            z-index: 100;
            font-weight: 700;
            font-size: 2em;
        }

        .view-all {
            text-decoration: none;
            color: #fff;
            font-size: 16px;
            margin-left: 10px;
            vertical-align: middle;
        }

        .view-all:hover {
            color: #ddd;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>

<body>
    <div id="mySidenav" class="sidenav">
        <p class="logo"><span>DigidetOX</span></p>
        <a href="#" class="icon-a"><i class="fas fa-tachometer-alt icons"></i>&nbsp;&nbsp;Dashboard</a>
        <a href="#" class="icon-a"><i class="fas fa-users icons"></i>&nbsp;&nbsp;Customers</a>
        <a href="#" class="icon-a"><i class="fas fa-list-ul icons"></i>&nbsp;&nbsp;E-Waste</a>
        <a href="#" class="icon-a"><i class="fas fa-star icons"></i>&nbsp;&nbsp;Points</a>
        <a href="#" class="icon-a"><i class="fas fa-tasks icons"></i>&nbsp;&nbsp;Tasks</a>
        <a href="#" class="icon-a"><i class="fas fa-user icons"></i>&nbsp;&nbsp;Accounts</a>
    </div>
    <div id="main">
        <div class="head">
            <div class="col-div-6">
                <span style="font-size:30px; cursor:pointer;color:white;" class="nav">&#9776;Dashboard</span>
                <span style="font-size:30px; cursor:pointer;color:white;" class="nav2">&#9776;Dashboard</span>
            </div>
            <div class="col-div-6">
                <div class="profile">
                    <i class="fas fa-solid fa-user" style="color: #f5f5f5;"></i>&nbsp;Admin
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="col-div-4">
            <div class="box">
                <p>
                    <br /><span>
                        <!-- <?php
                                $query = "select * from users";
                                $result = mysqli_query($conn, $query);

                                if ($users_total = mysqli_num_rows($result)) {
                                    echo '<h4>' . $users_total . '</h4>';
                                } else {
                                    echo '<h4> No Data </h4>';
                                }
                                ?> -->
                        <a href="customer.php">Customers</a></span>
                </p>
                <i class="fas fa-users box-icon"></i>
            </div>
        </div>

        <div class="col-div-4">
            <div class="box">
                <p><i class="fas fa-star box-icon"></i><br /><span><a href="display.php">Pickup schedule
                        </a></span></p>
            </div>
        </div>
        <div class="col-div-4">
            <div class="box">
                <p><br /><span><a href="adminloc.php">Locations</span></p>
                <i class="fas fa-list-ul box-icon"></i>
            </div>
        </div>

        <div class="clearfix"></div>
        <br /><br />
        <?php
        require_once("config.php");

        // Fetch data from the leaderboards table ordered by total_credits in descending order, limit to 2 rows
        $sql = "SELECT user_id, username, total_credits FROM leaderboards ORDER BY total_credits DESC LIMIT 2";
        $stmt = $db->query($sql);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        ?>

        <div class="col-div-8">
            <div class="box-8">
                <div class="content-box">
                    <p>LEADERBOARD <a href="ld.php" class="view-all"><span>View All</span></a></p>

                    <br />
                    <table>
                        <tr>
                            <th>User ID</th>
                            <th>Username</th>
                            <th>Total Credits</th>
                        </tr>
                        <?php foreach ($rows as $row) : ?>
                            <tr>
                                <td><?php echo $row['user_id']; ?></td>
                                <td><?php echo $row['username']; ?></td>
                                <td><?php echo $row['total_credits']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-div-4">
            <div class="box-4">
                <div class="content-box">
                    <p>Total E-Waste <span>View All</span></p>
                    <div class="circle-wrap">
                        <div class="circle">
                            <div class="mask full">
                                <div class="fill"></div>
                            </div>
                            <div class="mask half">
                                <div class="fill"></div>
                            </div>
                            <div class="inside-circle">60%</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(".nav").click(function() {
            $("#mySidenav").css('width', '70px');
            $("#main").css('margin-left', '70px');
            $(".logo").css('visibility', 'hidden');
            $(".logo span").css('visibility', 'visible');
            $(".logo span").css('margin-left', '-10px');
            $(".icon-a").css('visibility', 'hidden');
            $(".icons").css('visibility', 'visible');
            $(".icons").css('margin-left', '-8px');
            $(".nav").css('display', 'none');
            $(".nav2").css('display', 'block');
        });
        $(".nav2").click(function() {
            $("#mySidenav").css('width', '300px');
            $("#main").css('margin-left', '300px');
            $(".logo").css('visibility', 'visible');
            $(".logo span").css('visibility', 'visible');
            $(".icon-a").css('visibility', 'visible');
            $(".icons").css('visibility', 'visible');
            $(".nav").css('display', 'block');
            $(".nav2").css('display', 'none');
        });
    </script>
</body>

</html>