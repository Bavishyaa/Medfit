<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>
        /* Remove the navbar's default margin-bottom and rounded borders */
        .navbar {
            margin-bottom: 0;
            border-radius: 0;
        }

        /* Hide the carousel text when the screen is less than 600 pixels wide */
        @media (max-width: 600px) {
            .carousel-caption {
                display: none;
            }
        }

        /* Full-width input fields */
        input[type=text],
        input[type=date],
        input[type=number],
        input[type=email] {
            width: 100%;
            padding: 10px 15px;
            margin-bottom: 8px;
            display: inline-block;
            border: 1px solid #ccc;
            box-sizing: border-box;
            color: black;
        }

        /* Set a style for all buttons */
        button {
            background-color: lightblue;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            cursor: pointer;
            width: 100%;
            float: right;
        }

        button:hover {
            opacity: 0.8;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: lightblue;
            font-family: 'Poppins', sans-serif;
        }

        .header {
            width: 100%;
            height: 100vh;
            /*background-image: linear-gradient(360deg, rgba(0, 0, 0, 0.9), transparent);*/
            background-size: cover;
        }

        .header-text {
            height: 100vh;
            display: inline;
            justify-content: center;
            align-items: center;
            text-align: center;
            color: #aaa;
        }

        /* Adjusted styling for responsiveness */
        .form-container {
            max-width: 100vh;
            margin: auto;
            background: rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 10px;
        }

        .form-container label {
            display: block;
            margin-bottom: 8px;
        }

        .form-container input {
            width: calc(50% - 10px);
            margin-bottom: 12px;
            display: inline-block;
            box-sizing: border-box;
        }

        .form-container::after {
            content: "";
            display: table;
            clear: both;
        }
    </style>
</head>




<body>
<?php
$host = "localhost";
$port = "5432";
$dbname = "postgres";
$user = "postgres";
$password = "postgres";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $conn = new PDO("pgsql:host=$host;port=$port;dbname=$dbname;user=$user;password=$password");

        // Set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Prepare SQL statement
        $stmt = $conn->prepare("INSERT INTO patient (pid, hosp_chosen, pfname, plname, age, gen, blood_type, pincode, p_contact, p_email) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

        // Bind parameters
        $stmt->bindParam(1, $_POST['pid']);
        $stmt->bindParam(2, $_POST['hosp_chosen']);
        $stmt->bindParam(3, $_POST['pfname']);
        $stmt->bindParam(4, $_POST['plname']);
        $stmt->bindParam(5, $_POST['age']);
        $stmt->bindParam(6, $_POST['gen']);
        $stmt->bindParam(7, $_POST['blood_type']);
        $stmt->bindParam(8, $_POST['pincode']);
        $stmt->bindParam(9, $_POST['p_contact']);
        $stmt->bindParam(10, $_POST['p_email']);


        // Execute the statement
        $stmt->execute();

        header("Location: dummy.php");
        exit(); // Make sure to exit after the redirection
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
}
?>


<!DOCTYPE html>
<html lang="en">
 
<body>
    <div class="header">
        <div class="header-text">
            <div class="content">
                <h1 style="color:#fff;">USER-FRIENDLY HOSPITAL SYSTEM </h1>
                <div class="form-container">
                <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    
                    <label for="pid">ID:</label>
                    <input type="number" name="pid" required>
                    
                    <label for="pfname">First Name:</label>
                    <input type="text" name="pfname" required>

                    <label for="plname">Last Name:</label>
                    <input type="text" name="plname" required>

                    <label for="age">Age:</label>
                    <input type="number" name="age" required>

                    <label for="gen">Gender:</label>
                    <input type="text" name="gen" required>

                    <label for="hosp_chosen">Hospital:</label>
                    <input type="number" name="hosn_chosen" required>

                    <label for="blood_type">Blood Type:</label>
                    <input type="text" name="blood_type" required>

                    <label for="pincode">Pincode:</label>
                    <input type="text" name="pincode" required>

                    <label for="p_contact">Contact:</label>
                    <input type="text" name="p_contact" required>

                    <label for="p_email">Email:</label>
                    <input type="email" name="p_email" required>

                    <button type="submit">Submit</button>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
</form>
</html>