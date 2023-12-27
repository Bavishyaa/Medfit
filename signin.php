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
    $username = $_POST['pat_id'];
    $enteredPassword = $_POST['password'];

    // Query to retrieve stored password
    $stmt = $pdo->prepare("SELECT password FROM users WHERE pat_id = ?");
    $stmt->execute([$username]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row) {
        // Verify password
        if ($enteredPassword === $row['password']) {
            // Password is correct, set session variables and redirect to dashboard
            $_SESSION['pat_id'] = $username;
            header("Location: dummy.php");
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
    <meta charset="UTF-8">
    <title>Login Page</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <style>
        body {
            background: lightblue;
            font-family: 'Poppins', sans-serif;
        }

        .container {
            max-width: 400px;
            margin: auto;
            background: rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 10px;
            margin-top: 50px;
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px 15px;
            margin-bottom: 12px;
            display: inline-block;
            border: 1px solid #ccc;
            box-sizing: border-box;
            color: black;
        }

        p {
            color: red;
        }

        input[type="submit"] {
            background-color: lightblue;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            cursor: pointer;
            width: 100%;
            float: right;
        }

        input[type="submit"]:hover {
            opacity: 0.8;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Login</h2>

        <?php if (isset($error)) {
            echo "<p>$error</p>";
        } ?>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <label for="pat_id">Username:</label>
            <input type="text" name="pat_id" required><br>

            <label for="password">Password:</label>
            <input type="password" name="password" required><br>

            <input type="submit" value="Login">
        </form>
    </div>
</body>

</html>