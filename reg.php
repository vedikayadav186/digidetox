<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/stylee.css">
</head>
<body>
    <div class="container">
        <?php
        if(isset($_POST["submit"])){
            $fullname = $_POST["fullname"];
            $email= $_POST["email"];
            $password = $_POST["password"];
            $passwordConfirm = $_POST["cpassword"];

            $passwordhash = password_hash($password , PASSWORD_DEFAULT);

            $errors = array();
            
            if(empty($fullname)or empty($email)or empty($password)or empty($passwordConfirm) ){
                array_push($errors,"All field are required");
            }
            if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
                array_push($errors,"Email is not valid");
            }
            if(strlen($password)<8){
                array_push($errors,"Password must be atleast 8 characters long");
            }
            if($password != $passwordConfirm){
                array_push($errors,"Password does not match");
            }

            require_once "database.php";
            $sql = "SELECT * from users WHERE email = '$email'";
            $result = mysqli_query($conn,$sql);
            $rowcount = mysqli_num_rows($result);
            if($rowcount>0){
                array_push($errors , "Email already exist");

            }
            if(count($errors)>0){
                foreach($errors as $error){
                    echo "<div class = 'alert alert-danger'>$error</div>";
                }
            }else{
                $sql = "INSERT INTO users ( fullname , email , password ) VALUES (? , ? , ?)";
                $stmt = mysqli_stmt_init($conn);
                $preparestmt = mysqli_stmt_prepare($stmt,$sql);
                if($preparestmt){
                    mysqli_stmt_bind_param($stmt,"sss",$fullname,$email,$passwordhash);
                    mysqli_stmt_execute($stmt);
                    echo "<div class='alert alert-success'>You are registered successfully.</div>";
                }else{
                  die("Something went wrong");  
                }
            }
        }
        ?>
        <h2 class="h2">Sign up</h2>
        <br>
        <form action="registration.php" method="post">
            <div class="form-group">
                <input type="text" class="form-control" name="fullname" placeholder="Full Name :">
            </div>
            <div class="form-group">
                <input type="email" class="form-control" name="email" placeholder="Email :">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="password" placeholder="Password :">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="cpassword" placeholder="Confirm Password :">
            </div>
            <div class="form-btn">
                <input type="submit" class="btn btn-primary" value="Register" name="submit">
            </div>
        </form>
        <div><br><p>Already Registered  <a href="login.php">Login Here</a></p></div>
    </div>
    
</body>
</html>