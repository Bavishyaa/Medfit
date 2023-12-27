<?php
// Your database connection code here

$host = "localhost";
$port = "5432";
$dbname = "postgres";
$user = "postgres";
$password = "postgres";

try {
    // Establish a PDO pdoection
    $pdo = new PDO("pgsql:host=$host;port=$port;dbname=$dbname;user=$user;password=$password");

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Fetch data from the feedback table
    $stmt = $pdo->query("SELECT * FROM feedback");
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Close the pdoection
    $pdo = null;

    // Prepare data for JavaScript
    $chartData = [];

    foreach ($data as $row) {

        $question = preg_replace('/[^a-zA-Z0-9_]/', '_', $row['question']);

        $chartData[$question] = [
            'ch_one' => (int)$row['ch_one'],
            'ch_two' => (int)$row['ch_two'],
            'ch_three' => (int)$row['ch_three'],
            'ch_four' => (int)$row['ch_four'],
            'ch_five' => (int)$row['ch_five'],
        ];
    }

    // Convert to JSON for JavaScript
    $jsonChartData = json_encode($chartData);

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback Pie Charts</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel = "stylesheet" href = "assets/css/main.css" />
    <link rel = "stylesheet" href = "assets/css/utilities.css" />
    <style>
        body {
            background-color: #e3effd;
            box-sizing: border-box;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        canvas {
            margin: 0 auto;
            display: block;
        }
    </style>
</head>
<body>

<?php
// Echo the JSON data to the console for inspection
echo '<script>console.log(' . $jsonChartData . ');</script>';
?>


<?php foreach ($chartData as $question => $values): ?>
    <div class = "services-item" style = "width: 95%;">
        <h4 class="title-separator mx-auto"><?php echo $question; ?></h4>
        <canvas id="chart_<?php echo $question; ?>" width="500" height="500"></canvas>
    </div>
<?php endforeach; ?>


<script>
    <?php foreach ($chartData as $question => $values): ?>
        var chartData_<?php echo $question; ?> = <?php echo json_encode($values); ?>;
        
        var ctx_<?php echo $question; ?> = document.getElementById('chart_<?php echo $question; ?>').getContext('2d');
        var myChart_<?php echo $question; ?> = new Chart(ctx_<?php echo $question; ?>, {
            type: 'pie',
            data: {
                labels: ['1', '2', '3', '4', '5'],
                datasets: [
                    {
                        label: '<?php echo $question; ?>',
                        data: [
                            chartData_<?php echo $question; ?>.ch_one,
                            chartData_<?php echo $question; ?>.ch_two,
                            chartData_<?php echo $question; ?>.ch_three,
                            chartData_<?php echo $question; ?>.ch_four,
                            chartData_<?php echo $question; ?>.ch_five,
                        ],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.7)',
                            'rgba(255, 205, 86, 0.7)',
                            'rgba(54, 162, 235, 0.7)',
                            'rgba(75, 192, 192, 0.7)',
                            'rgba(153, 102, 255, 0.7)',
                        ],
                    },
                ],
            },
            options: {
                responsive: false, // Disable responsiveness
            },
        });
    <?php endforeach; ?>
</script>


</body>
</html>