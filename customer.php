<?php
require_once('database.php');
$query = "select * from signup";
$result = mysqli_query($conn,$query);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body class="bg-dark">
    <div class="container">
        <div class="row mt-5">
            <div class="col">
                <div class="card mt-5">
                    <div class="card-header">
                        <h2 class="display-6 text-center">Customer Data </h2>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered text-center">
                            <tr>
                                <td>USER ID</td>
                                <td>FULL NAME</td>
                                <td>E-MAIL</td>
                            </tr>
                            <tr>
                              <?php

                              while($row = mysqli_fetch_assoc($result))
                              {
                                ?>
                                <td> <?php echo $row['userId']; ?> </td>
                                <td> <?php echo $row['fullname']; ?> </td>
                                <td> <?php echo $row['email']; ?> </td>

                                </tr>
                                <?php
                              }
                              ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>