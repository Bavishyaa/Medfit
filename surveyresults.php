<?php


if ($_SERVER['REQUEST_METHOD']=='POST') {
    
    $data = $_POST;

    //$jsonData = file_get_contents("php://input", true);
    //var_dump($jsonData);

    //$data = json_decode($jsonData);

    //var_dump($data);

    $host = "localhost";
    $port = "5432";
    $dbname = "postgres";
    $user = "postgres";
    $password = "postgres";

    try {
        // Establish a PDO pdoection
        $pdo = new PDO("pgsql:host=$host;port=$port;dbname=$dbname;user=$user;password=$password");

        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


        foreach ($data as $key => $value) {

            $key=(int)$key;

            if ($value == 1) {
                $stmt = $pdo->prepare("UPDATE feedback SET ch_one=ch_one+1, total_entries=total_entries+1 WHERE qno=:qno");
            } else if ($value == 2) {
                $stmt = $pdo->prepare("UPDATE feedback SET ch_two=ch_two+1, total_entries=total_entries+1 WHERE qno=:qno");
            } else if ($value == 3) {
                $stmt = $pdo->prepare("UPDATE feedback SET ch_three=ch_three+1, total_entries=total_entries+1 WHERE qno=:qno");
            } else if ($value == 4) {
                $stmt = $pdo->prepare("UPDATE feedback SET ch_four=ch_four+1, total_entries=total_entries+1 WHERE qno=:qno");
            } else if ($value == 5) {
                $stmt = $pdo->prepare("UPDATE feedback SET ch_five=ch_five+1, total_entries=total_entries+1 WHERE qno=:qno");
            } 

            $stmt->bindParam(':qno', $key, PDO::PARAM_INT);
            $stmt->execute();
        }

        //echo "Data stored successfully!";

    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    } finally {
        // Close the pdoection
        $pdo = null;
    }
}

?>



<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="refresh" content="3;url=dummy.php"> <!-- Adjust the URL and time as needed -->
    <title>Thank You</title>
</head>
<body>
    <div>
        <h1 class = "title-box-name">Thank You for Your Feedback!</h1>
        <p class = "text title-box-text">Your response has been received. You will be redirected in 3 seconds...</p>
        <p class = "text title-box-text">If you are not redirected, <a href="dummy.php">click here</a>.</p>
    </div>
</body>
</html>