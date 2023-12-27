<?php
session_start();

$host = "localhost";
$port = "5432";
$dbname = "postgres";
$user = "postgres";
$password = "postgres";

try {
    $pdo = new PDO("pgsql:host=$host;port=$port;dbname=$dbname;user=$user;password=$password");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $username = $_SESSION['pat_id'];

    //$email='aarav.kumar@example.com';
    $stmt = $pdo->prepare("SELECT * FROM Patient WHERE pid=:id");
    $stmt->bindParam(':id', $username, PDO::PARAM_STR);
    $stmt->execute();

    //var_dump($email);

    //$stmt = $pdo->query("SELECT * FROM Patient");
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    //var_dump($user);

    // Load XML and XSL files
    $xml = new DOMDocument;
    $xml->load('profileinfo.xml');

    $xml->getElementsByTagName('ID')->item(0)->nodeValue = 'ID: ' . $user['pid'];
    $xml->getElementsByTagName('FNAME')->item(0)->nodeValue = 'First Name: ' . $user['pfname'];
    $xml->getElementsByTagName('LNAME')->item(0)->nodeValue = 'Last Name: ' . $user['plname'];
    $xml->getElementsByTagName('AGE')->item(0)->nodeValue = 'Age: ' . $user['age'];
    $xml->getElementsByTagName('GENDER')->item(0)->nodeValue = 'Gender: ' . $user['gen'];
    $xml->getElementsByTagName('BLOODTYPE')->item(0)->nodeValue = 'Blood Type: ' . $user['blood_type'];
    $xml->getElementsByTagName('PHONE')->item(0)->nodeValue = 'Contact No.: ' . $user['p_contact'];
    $xml->getElementsByTagName('EMAIL')->item(0)->nodeValue = 'Email ID: ' . $user['p_email'];

    //echo $xml->saveXML();

    $xsl = new DOMDocument;
    $xsl->load('profilexsl.xsl');

    // Create XSLT processor
    $proc = new XSLTProcessor;
    $proc->importStyleSheet($xsl);

    $proc->setParameter('', 'id', $username);

    // Debug statement to check the value of p_email
    //var_dump($email);

    // Transform XML
    $result = $proc->transformToXML($xml);

    //var_dump($result);

    // Output transformed result
    echo $result;

} catch (PDOException $e) {
    // Handle database connection errors
    die("Connection failed: " . $e->getMessage());

} catch (Exception $e) {
    // Handle other exceptions
    echo "Error: " . $e->getMessage();
}

?>