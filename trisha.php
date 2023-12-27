<!DOCTYPE html>
<html>

<head>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/utilities.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin: 50px;
        }

        p {
            font-size: 18px;
            line-height: 1.6;
            color: #333;
        }

        .outer-container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #fff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .inner-container {
            max-width: 600px;
            margin: 20px auto;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #f9f9f9;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        /* Add some styling for the dropdown */
        select {
            padding: 5px;
            font-size: 16px;
        }
    </style>
</head>

<body>
<a href="intro.php" class="btn btn-secondary">Back</a>
<button type="button" class="btn btn-secondary" onclick="window.location.href='profile.php'">Go to Profile</button>
    <div class="outer-container">
        <!-- Add the form for sorting -->
        <form method="get" action="">
            <label for="sort">Sort By:</label>
            <select id="sort" name="sort">
                <option value="date_asc">Date Ascending</option>
                <option value="date_desc">Date Descending</option>
                <option value="cost_asc">Cost Ascending</option>
                <option value="cost_desc">Cost Descending</option>
            </select>
            <input type="submit" value="Sort">
        </form>

        <p>Medical Records:</p>
        <?php

        session_start();

        if (isset($_SESSION['pat_id'])) {
            $host = "localhost";
            $port = "5432";
            $dbname = "postgres";
            $user = "postgres";
            $password = "postgres";

            try {

                $selectedDomain = isset($_GET['domain']) ? $_GET['domain'] : '';
                // Create a PDO connection
                $pdo = new PDO("pgsql:host=$host;port=$port;dbname=$dbname;user=$user;password=$password");

                // Set the PDO error mode to exception
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $username = $_SESSION['pat_id'];

                // Check if the sorting option is set in the URL
                $sortOption = isset($_GET['sort']) ? $_GET['sort'] : 'date_asc';

                // Use a prepared statement to prevent SQL injection and handle sorting
                $stmt = $pdo->prepare("SELECT MR.*,D.disease_name,DOC.doc_name FROM MedicalRecords MR
                                      JOIN users U ON MR.patient_id = U.pat_id 
                                      JOIN diseases D ON D.disid = MR.condition
                                      JOIN domain DOM ON DOM.domain_id = MR.domain_id
                                      JOIN doctors DOC ON MR.doc_id=DOC.doc_id
                                      WHERE U.pat_id = ? AND DOM.domain_id=?
                                      ORDER BY 
                                      CASE WHEN ? = 'date_asc' THEN MR.diagnosisdate END ASC,
                                      CASE WHEN ? = 'date_desc' THEN MR.diagnosisdate END DESC,
                                      CASE WHEN ? = 'cost_asc' THEN MR.cost END ASC,
                                      CASE WHEN ? = 'cost_desc' THEN MR.cost END DESC");
                $stmt->execute([$username, $selectedDomain, $sortOption, $sortOption, $sortOption, $sortOption]);

                if ($stmt->rowCount() > 0) {
                    // Output data of each row
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo "    <div class='inner-container'>    ";
                        echo "RecordID: " . $row["recordid"] . "<br>";
                        echo "Domain ID: " . $row["domain_id"] . "<br>";
                        echo "Patient ID: " . $row["patient_id"] . "<br>";
                        echo "Doctor ID: " . $row["doc_id"] . "<br>";
                        echo "Condition: " . $row["condition"] . "<br>";
                        echo "Condition Name: " . $row["disease_name"] . "<br>";
                        echo "Doctor Name: " . $row["doc_name"] . "<br>";
                        echo "Value: " . $row["value"] . "<br>";
                        echo "Diagnosis Date: " . $row["diagnosisdate"] . "<br>";
                        echo "Cost: $" . $row["cost"] . "<br>";
                        echo "</div>";
                    }

                    // Use a prepared statement to calculate the total cost
                    $stmt1 = $pdo->prepare("SELECT SUM(cost) AS total_cost FROM MedicalRecords WHERE patient_id = ?");
                    $stmt1->execute([$username]);
                    $result = $stmt1->fetch(PDO::FETCH_ASSOC);

                    // Display the total cost
                    $totalCost = $result['total_cost'];
                    echo "Total Cost for Patient ID " . $username . ": $" . number_format($totalCost, 2);
                } else {
                    echo "No records found for the logged-in user in the corresponding domain.";
                }
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }

            // Close the PDO connection
            $pdo = null;
        } else {
            echo "User not logged in.";
        }
        ?>
    </div>
</body>

</html>