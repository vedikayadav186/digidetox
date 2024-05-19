<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="signup.css">
    <title>Registration Form</title>
</head>

<body>

    <div class="container" id="container">
        <div class="form-container sign-up">
        <form action="signup.php" method="post">
                <h1>Create Account</h1>
        
                <input type="text" name="fullname" placeholder="Name">
                <input type="email" name="email" placeholder="Email">
                <input type="password" name="password" placeholder="Password">
                <input type="password" name="cpassword" placeholder="Confirm Password">
                <!-- <button>Sign Up</button> -->
                <div class="form-btn">
                <input type="submit" class="btn btn-primary" value="Register" name="submit">
            </div>
            </form>
        </div>
        <div class="form-container sign-in">
        <form action="signin.php" method="post">
                <h1>Sign In</h1>

                <input type="email" name="email" placeholder="Email">
                <input type="password" name="password" placeholder="Password">
                <div class="form-btn">
                <input type="submit" value="Login" name="login" class="btn btn-primary">
            </div>
                <!-- <button>Sign In</button> -->
            </form>
        </div>
        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-left">
                    <h1>Welcome Back!</h1>
                    <p>Enter your personal details to use all of site features</p>
                    <button class="hidden" id="login">Sign In</button>
                </div>
                <div class="toggle-panel toggle-right">
                    <h1>Hello, Friend!</h1>
                    <p>Register with your personal details to use all of site features</p>
                    <button class="hidden" id="register">Sign Up</button>
                </div>
            </div>
        </div>
    </div>

    <script src="signup.js"></script>
</body>

</html>