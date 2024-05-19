<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DigiDetOX</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <style>
    @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800;900&display=swap");

    body,
    html {
        margin: 0;
        padding: 0;
        font-family: Arial, sans-serif;
    }

    .navbar {
        display: flex;
        /* Add flex display */
        align-items: center;
        /* Vertically center items */
        justify-content: space-between;
        /* Space items evenly */
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        background-color: transparent;
        z-index: 1000;
    }

    .navbar h1 {
        color: #fff;
        font-size: 30px;
        font-weight: bold;
        margin-left: 15px;
    }

    .navbar ul {
        list-style-type: none;
        margin: 0;
        padding: 0;
        text-align: right;
    }

    .navbar ul li {
        display: inline;
        margin: 0 20px;
    }

    .navbar ul li a {
        text-decoration: none;
        color: white;
        font-size: 20px;
        font-weight: bold;
        position: relative;
    }

    .navbar ul li a::after {
        content: "";
        position: absolute;
        left: 0;
        bottom: -2px;
        width: 100%;
        height: 2px;
        background-color: transparent;
        transition: background-color 0.3s ease;
    }

    .navbar ul li a:hover::after {
        background-color: white;
    }

    .video-container {
        position: relative;
        /* Change to relative positioning */
        width: 100%;
        height: 100vh;
        /* Set to viewport height */
        overflow: hidden;
    }

    #video-background {
        position: absolute;
        top: 50%;
        /* Center vertically */
        left: 50%;
        /* Center horizontally */
        min-width: 100%;
        min-height: 100%;
        width: auto;
        height: auto;
        transform: translate(-50%, -50%);
    }

    .signup-btn {
        position: absolute;
        bottom: 140px;
        /* Adjust as needed */
        left: 50%;
        transform: translateX(-50%);
        z-index: 1001;
        /* Ensure it's above the video */
    }

    .signup-btn button {
        padding: 15px 30px;
        background-color: #022135;
        border-radius: 30px;
        box-shadow: 1px 1px 6px 3px #fff;
        color: white;
        font-size: 18px;
        border: none;
        cursor: pointer;
    }

    .content-section {
        padding: 100px 20px;
        background-color: rgba(255, 255, 255, 0.8);
        text-align: center;
    }

    h2 {
        margin-bottom: 30px;
    }

    * {
        margin: 0;
        padding: 0;
        scroll-behavior: smooth;
        box-sizing: border-box;
        font-family: 'Poppins', sans-serif;
    }

    nav {
        position: -webkit-sticky;
        position: fixed;
        display: flex;
        height: 80px;
        width: 100%;
        background: #1b1b1b;
        align-items: center;
        justify-content: space-between;
        padding: 0 20px;
        flex-wrap: wrap;
        z-index: 1000;
    }

    nav .logo {
        color: #29fd53;
        font-size: 35px;
        font-weight: 600;
    }

    nav ul {
        display: flex;
        flex-wrap: wrap;
        list-style: none;
    }

    nav ul li {
        margin: 0 5px;
    }

    nav ul li a {
        color: #fff;
        text-decoration: none;
        font-size: 18px;
        font-weight: 500;
        padding: 8px 15px;
        border-radius: 5px;
        letter-spacing: 1px;
        margin-left: 35px;
        transition: 0.3s;
    }

    li a.active {
        color: #111;
        background: #fff;
    }

    nav ul li a:hover {
        color: #111;
        background: #fff;
    }

    .main {
        display: flex;
        align-items: center;
    }

    .main a {
        margin-right: 25px;
        margin-left: 10px;
        color: #fff;
        text-decoration: none;
        font-size: 1.1rem;
        font-weight: 500;
        transition: all .50s ease;
    }

    .main a:hover {
        color: #29fd53;
    }

    nav .menu-btn i {
        color: #fff;
        font-size: 22px;
        cursor: pointer;
        display: none;
    }

    input[type="checkbox"] {
        display: none;
    }

    section {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        font-size: 20px;
        color: #041407;
        padding: 20px;
        font-style: times new roman;
    }

/* Update styles for the .information container */
.information {
    display: flex;
    justify-content: space-between; /* Distribute items evenly */
    align-items: center; /* Align items vertically */
    font-size: 25px;
    color: #041407;
    padding: 30px;
    font-family: 'Times New Roman', Times, serif;
}

/* Update styles for the text portion */
.information .text {
    flex: 1; /* Take up half of the available space */
    padding-right: 10px; /* Add some spacing between text and image */
    text-align: justify; /* Justify text */
}

/* Update styles for the image */
.information .Flow {
    flex: 1; /* Take up half of the available space */
    max-width: 50%; /* Limit the width to half of the container */
    height: auto; /* Allow the height to adjust based on the aspect ratio */
    object-fit: contain; /* Maintain aspect ratio without cropping */
}



/* Update styles for the #about section */
/* Update styles for the #about section */
/* Styling for the #about section */
#about {
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column; /* Display items in a column */
    font-size: 20px;
    color: #041407;
    padding: 20px;
    font-family: 'Times New Roman', Times, serif; /* Correct the font-family property */
}

/* Styling specifically for the .information div inside #about */
#about .information {
    background-color: #eaeaea; /* Grayish background color */
    padding: 20px; /* Add padding for spacing */
    border-radius: 8px; /* Add rounded corners */
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Add a subtle shadow */
}

/* Styling specifically for the image inside .information div inside #about */
#about .information img {
    width: 100%; /* Set the image width to 100% of its parent container */
    height: auto; /* Allow the height to adjust based on the aspect ratio */
    object-fit: fill; /* Fill the container without preserving aspect ratio *//* Add space below the image */
}


    @media(max-width: 1000px) {
        nav {
            padding: 0 40px 0 50px;
        }

        .content {
            margin: 20px;
        }
    }

    @media(max-width: 920px) {
        nav .menu-btn i {
            display: block;
        }

        #click:checked~.menu-btn i:before {
            content: "\f00d";
        }

        nav ul {
            position: -webkit-sticky;
            position: sticky;
            position: fixed;
            top: 80px;
            left: -60%;
            background: #060e08;
            height: 37vh;
            border-radius: 0px 0px 20px 20px;
            width: 150px;
            text-align: left;
            display: block;
            transition: all 0.3s ease;
        }

        #click:checked~ul {
            left: 0;
        }

        nav ul li {
            width: 100%;
            margin: 10px 0;
        }

        nav ul li a {
            width: 100%;
            margin-left: -100%;
            display: block;
            font-size: 20px;
            transition: 0.6s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        }

        #click:checked~ul li a {
            margin-left: 0px;
        }

        nav ul li a.active,
        nav ul li a:hover {
            background: none;
            color: #060b31;
            text-decoration: underline;
            transition: transform .4s linear;
            transform: translateY(5px);
        }

        .content {
            margin: 20px;
        }
    }

    .user {
        display: flex;
        align-items: center;
    }

    .user i {
        color: #0a130c;
        font-size: 28px;
        margin-right: 7px;
    }

    .content video {
        display: block;
        margin: 1em auto;
        width: 100%;
    }

    .content {
        color: #09100a;
        font-size: 100px;
        font-weight: 600;
        text-align: center;
        background-color: #F3F3F3;
        width: 100%;
        max-width: 1200px;
    }



    .footer {
        position: relative;
        width: 100%;
        background: #3586ff;
        min-height: 100px;
        padding: 20px 50px;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
    }

    .social-icon,
    .menu {
        position: relative;
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top: 90px;
        margin-left: 40%;
        flex-wrap: wrap;
    }

    .social-icon__item,
    .social-icon__link {
        font-size: 20px;
        color: #fff;
        margin: 0 10px;
        display: inline-block;
        transition: 0.5s;
    }

    .social-icon__link:hover {
        transform: translateY(-10px);
    }

    .menu__link {
        font-size: 1.2rem;
        color: #fff;
        position: relative;
        /* margin: 0 10px; */
        display: inline-block;
        transition: 0.5s;
        text-decoration: none;
        opacity: 0.75;
        font-weight: 300;
        top: 10px;
    }

    .menu__link:hover {
        opacity: 1;
    }

    .footer p {
        color: #fff;
        margin: 15px 0 10px 0;
        font-size: 30px;
        font-weight: 300;
    }

    .wave {
        position: absolute;
        top: -100px;
        left: 0;
        width: 100%;
        height: 100px;
        background: url("https://i.ibb.co/wQZVxxk/wave.png");
        background-size: 1000px 100px;
    }

    .wave#wave1 {
        z-index: 1000;
        opacity: 1;
        bottom: 0;
        animation: animateWaves 4s linear infinite;
    }

    .wave#wave2 {
        z-index: 999;
        opacity: 0.5;
        bottom: 10px;
        animation: animate 4s linear infinite !important;
    }

    .wave#wave3 {
        z-index: 1000;
        opacity: 0.2;
        bottom: 15px;
        animation: animateWaves 3s linear infinite;
    }

    .wave#wave4 {
        z-index: 999;
        opacity: 0.7;
        bottom: 20px;
        animation: animate 3s linear infinite;
    }
    #explore {
    padding: 20px;
    margin: 75px;
    background-color: #f8f8f8;
    overflow: hidden; 
    height: 500px;/* Hide overflow to prevent scrollbars */
}
.animated-sentence {
    font-size: 32px;
    font-family: Arial, sans-serif;
    font-weight: bold; /* Make the text bold */
    color: #00a86b;
    text-align: center;
    margin-bottom: 20px;
    animation: animateSentence 2s ease-in-out 1 forwards; /* Animation runs once and stops at final position */
}

@keyframes animateSentence {
    0% {
        transform: translateX(-10px);
    }
    100% {
        transform: translateX(10px);
    }
}


.video-container {
    height: 100vh;
    display: flex;
    
}

.video-container iframe {
    width: 490px; /* Set the width of each video */
    height: 300px; /* Set the height of each video */
    margin-right: 10px; /* Add space between videos */
}







    @keyframes animateWaves {
        0% {
            background-position-x: 1000px;
        }

        100% {
            background-positon-x: 0px;
        }
    }

    .container {
        display: flex;
        flex-wrap: wrap;
        font-size: 100px;
        position: relative;
        justify-content: space-between;
    }

    .first {
        width: 50vw;
        DISPLAY: flex;
        JUSTIFY-ITEMS: center;
        ALIGN-ITEMS: CENTER;
        position: relative;
        left: 200px;
        font-size: 60px;
    }

    .footer__nav {
        display: flex;
        flex-flow: row-reverse wrap;
    }

    .nav__title {
        font-weight: 400;
        font-size: 25px;
        font-weight: bold;
        ;
    }

    .footer ul {

        padding-left: 5;
    }
    .flow {
    width: 50px; /* Set the width to 300 pixels */
    height: 20px; /* Set the height to 200 pixels */
}


    @keyframes animate {
        0% {
            background-position-x: -1000px;
        }

        100% {
            background-positon-x: 0px;
        }
    }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar">
        <h1>DigiDetOX</h1>
        <ul>
            <li><a href="#home">Home</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="#explore">Explore</a></li>
            <!-- <li><a href="#latest">Latest</a></li> -->
        </ul>
    </nav>


    <!-- Video Background -->
    <div class="video-container">
        <video autoplay muted loop id="video-background">
            <source src="cinematic.mp4" type="video/mp4">
            Your browser does not support the video tag.
        </video>
    </div>

    <!-- Sign Up Button -->
    <div class="signup-btn">
        <a href="registration.php">
            <button>Sign Up</button>
        </a>
    </div>

    <!-- Content Sections -->
    <div id="home" class="content-section">
    <section id="home">
        <div class="information">
            <div class="text">
                <p>
                    "Discover the Environmental Power of Recycling and embrace the eco-revolution with DigiDetOX Ltd!
                    🌍♻ Unlocking the power of recycling, we're your guardians of green, preserving nature's treasures
                    for generations to come. Dive into our world of cutting-edge tech where every circuit tells a tale
                    of sustainability. With us, you're not just recycling – you're reshaping the future, one electron at
                    a time. Join the movement, and let's make our planet thrive together! #GreenGuardians
                    #DigiDetOXRevolution";
                </p>
            </div>
            <img src="Smiling Green Recycle Bin.jpeg" class="Flow" alt="Empowering India, Sustaining Tomorrow!">
        </div>
    </section>
</div>

    <div id="about" class="content-section">

        <!-- Your about content here -->
        <section id="about">

            
            <div class="information">
                <img src="./ui/e-waste.jpeg" alt="Empowering India, Sustaining Tomorrow!">
            </div>
        </section>
    </div>


    <div id="explore" class="content-section">
    <div class="animated-sentence">Discover new worlds with our amazing content!</div>
    <div class="video-container">
        <!-- Embed YouTube videos -->
        <iframe src="https://www.youtube.com/embed/3s_ZNEFPiE0"></iframe> 
        <iframe src="https://www.youtube.com/embed/_Y2ePj3wr8M"></iframe>
        <iframe src="https://www.youtube.com/embed/MQLadfsvfLo"></iframe>
            
                   
        <!-- Add more YouTube videos as needed -->
    </div>
</div>


    <!-- <div id="latest" class="content-section">
        <h2>Latest</h2>
        Your latest content here -->
    <!-- </div> -->
    <footer class="footer">
        <div class="waves">
            <div class="wave" id="wave1"></div>
            <div class="wave" id="wave2"></div>
            <div class="wave" id="wave3"></div>
            <div class="wave" id="wave4"></div>
        </div>
        <div class="container">
            <div class="first">
                <div>
                    <h5>Contact Us</h5>
                    <p>Email: digidetoxewastemanagement@gmail.com</p>
                    <p>Phone: 123-456-7890</p>
                    <p>Address: 123 Green Street, Eco City</p>

                </div>

                <div>
                </div>
            </div>
            <div class="third">
                <ul class="social-icons">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                </ul>
            </div>
        </div>
        <br>
        <br>
        <!-- <ul class="social-icon">
            <li class="social-icon_item"><a class="social-icon_link" href="#">
                    <ion-icon name="logo-facebook"></ion-icon>
                </a></li>
            <li class="social-icon_item"><a class="social-icon_link" href="#">
                    <ion-icon name="logo-twitter"></ion-icon>
                </a></li>
            <li class="social-icon_item"><a class="social-icon_link" href="#">
                    <ion-icon name="logo-linkedin"></ion-icon>
                </a></li>
            <li class="social-icon_item"><a class="social-icon_link" href="#">
                    <ion-icon name="logo-instagram"></ion-icon>
                </a></li>
        </ul> -->

        <ul class="menu__item">
            <a class="menu__link" href="#">Home</a>&nbsp;
            <a class="menu__link" href="#">About</a>&nbsp;
            <a class="menu__link" href="#">Services</a>&nbsp;
            <a class="menu__link" href="#">Contact</a>&nbsp;
        </ul>
        <p style="margin-left: 5%;">&copy; 2024 DigidetOX eWaste Management Ltd. All Rights Reserved.</p>
    </footer>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

    <script>
    document.addEventListener("DOMContentLoaded", function() {
        const navbarLinks = document.querySelectorAll('.navbar a');

        navbarLinks.forEach(navbarLink => {
            navbarLink.addEventListener('click', function(e) {
                e.preventDefault();
                const targetId = this.getAttribute('href').substring(1);
                const targetElement = document.getElementById(targetId);
                targetElement.scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });
    });

    function scrollToContent() {
        const contentSection = document.getElementById("home");
        contentSection.scrollIntoView({
            behavior: "smooth"
        });
    }
    document.addEventListener("DOMContentLoaded", function() {
        const navbar = document.querySelector('.navbar');

        window.addEventListener('scroll', function() {
            if (window.scrollY > 0) {
                navbar.style.backgroundColor = '#0ca17e';
            } else {
                navbar.style.backgroundColor = 'transparent';
            }
        });
    });

    const videoContainer = document.getElementById('video-container');
const videos = videoContainer.querySelectorAll('iframe');


    </script>
</body>

</html>