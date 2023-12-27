<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $host = "localhost";
    $port = "5432";
    $dbname = "postgres";
    $user = "postgres";
    $password = "postgres";

    // Establish a PDO connection
    $pdo = new PDO("pgsql:host=$host;port=$port;dbname=$dbname;user=$user;password=$password");

    // User input
    $username = $_POST['username'];
    $enteredPassword = $_POST['password'];

    // Query to retrieve stored password
    $stmt = $pdo->prepare("SELECT password FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row) {
        // Verify password
        if ($enteredPassword === $row['password']) {
            // Password is correct, set session variables and redirect to dashboard
            $_SESSION['username'] = $username;
            header("Location: signin.php");
            exit();
        } else {
            // Incorrect password
            $error = "Incorrect password!";
        }
    } else {
        // Username not found
        $error = "Username not found!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MedFit</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/utilities.css">
    <style>
        /* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  padding-top: 60px;
}

/* box background*/
.modal-content {
  margin: 5% auto 15% auto; /* 5% from the top, 15% from the bottom and centered */
  border:2px solid #fff;
  width: 80%; /* Could be more or less, depending on screen size */
  color:black;
  border-radius: 10px;

}
.modal-content h2,
    .modal-content label,
    .modal-content input {
        color: black;

    }
    
    .modal-content input[type="text"],
    .modal-content input[type="password"] {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        box-sizing: border-box;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    .modal-content input[type="submit"] {
        background-color: lightpink;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

  

    </style>
</head>
<body>
    <div class="page-wrapper">
        <!-- header -->
        <header class="header">
            <nav class="navbar">
                <div class="container">
                    <div class="navbar-content d-flex justify-content-between align-items-center">
                        <div class="brand-and-toggler d-flex align-items-center justify-content-between">
                            <a href="#" class="navbar-brand d-flex align-items-center">
                                <span class="brand-shape d-inline-block text-white">M</span>
                                <span class="brand-text fw-7">MedFit</span>
                            </a>
                            <button type="button" class="d-none navbar-show-btn">
                                <i class="fas fa-bars"></i>
                            </button>


                        </div>
                    </div>
                </div>
            </nav>

            <div class="element-one">
                <img src="assets/images/element-img-1.png" alt="">
            </div>

            <div class="banner">
                <div class="container">
                    <div class="banner-content">
                        <div class="banner-left">
                            <div class="content-wrapper">
                                <h1 class="banner-title">The HealthHub Connect</h1>
                                <p class="text text-white">Welcome to MedFit, your personalized portal for seamless access to your comprehensive medical history. Our user-friendly website is designed to empower you with convenient and secure tools to manage and monitor your health information anytime, anywhere.</p>
                                <a href="signup.php" class="btn btn-secondary">Sign Up</a>
                                <a href="signin.php" class="btn btn-secondary">Sign In</a>
                                <a class="btn btn-secondary" href="creator.php">Creator Sign Up</a>

                            </div>
                        </div>

                        <div class="banner-right d-flex align-items-center justify-content-end">
                            <img src="assets/images/banner-image.png" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- end of header -->

        <p class="text text-white">Discover a patient-centric website providing comprehensive medical histories from diverse hospitals, enhancing healthcare accessibility and empowering individuals with seamless information management for a holistic understanding of their health journey.</p>

        <footer class="footer">
            <div class="container">
                <div class="footer-content">
                    <div class="footer-list d-grid text-white">
                    <div class = "footer-item">
                                <a href = "#" class = "navbar-brand d-flex align-items-center">
                                    <span class = "brand-shape d-inline-block text-white">M</span>
                                    <span class = "brand-text fw-7">MedFit</span>
                                </a>
                                <p class = "text-white">MedFit provides progressive healthcare, accessible on mobile and online for everyone</p>
                            </div>

                            <div class = "footer-item">
                                <h3 class = "footer-item-title">Company</h3>
                                <ul class = "footer-links">
                                    <li><a href = "#">About</a></li>
                                    <li><a href = "#">Find a doctor</a></li>
                                    <li><a href = "#">Apps</a></li>
                                </ul>
                            </div>

                            <div class = "footer-item">
                                <h3 class = "footer-item-title">Region</h3>
                                <ul class = "footer-links">
                                    <li><a href = "#">India</a></li>
                                    <li><a href = "#">Singapore</a></li>
                                    <li><a href = "#">Hongkong</a></li>
                                    <li><a href = "#">Canada</a></li>
                                </ul>
                            </div>

                            <div class = "footer-item">
                                <h3 class = "footer-item-title">Help</h3>
                                <ul class = "footer-links">
                                    <li><a href = "#">Help center</a></li>
                                    <li><a href = "#">Contact support</a></li>
                                    <li><a href = "#">Instructions</a></li>
                                    <li><a href = "#">How it works</a></li>
                                </ul>
                            </div>
                    </div>
                </div>
            </div>
            <div class="footer-element-1">
                <img src="assets/images/element-img-4.png" alt="">
            </div>
            <div class="footer-element-2">
                <img src="assets/images/element-img-5.png" alt="">
            </div>
        </footer>
    </div>
</body>
</html>