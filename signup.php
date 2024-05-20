<?php
session_start();
if(isset($_SESSION["user"])){
    header("Location: cards1.php");
    exit();
}

if (isset($_POST["submit"])) {
    require_once "database.php";

    $fullname = $_POST["fullname"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $passwordConfirm = $_POST["cpassword"];

    $passwordhash = password_hash($password, PASSWORD_DEFAULT);

    $errors = array();

    if (empty($fullname) or empty($email) or empty($password) or empty($passwordConfirm)) {
        array_push($errors, "All field are required");
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($errors, "Email is not valid");
    }
    if (strlen($password) < 8) {
        array_push($errors, "Password must be at least 8 characters long");
    }
    if ($password != $passwordConfirm) {
        array_push($errors, "Password does not match");
    }

    $sql = "SELECT * from signup WHERE email = ?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        die("SQL error");
    } else {
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $rowcount = mysqli_num_rows($result);
        if ($rowcount > 0) {
            array_push($errors, "Email already exists");
        }
    }

    if (count($errors) > 0) {
        foreach ($errors as $error) {
            echo "<div class='alert alert-danger'>$error</div>";
        }
    } else {
        $sql = "INSERT INTO signup (fullname, email, password) VALUES (?, ?, ?)";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            die("SQL error");
        } else {
            mysqli_stmt_bind_param($stmt, "sss", $fullname, $email, $passwordhash);
            mysqli_stmt_execute($stmt);
            echo "<div class='alert alert-success'>You are registered successfully.</div>";
            header("Location: sign.php");
            exit();
        }
    }
}
?>