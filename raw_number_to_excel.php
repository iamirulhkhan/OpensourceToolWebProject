<?php
// Database connection
$host = 'localhost'; // Update to your database host
$db = ''; // Update to your database name
$user = ''; // Update to your database username
$pass = '8H'; // Update to your database password

$conn = new mysqli($host, $user, $pass, $db); 
if ($conn->connect_error) {
    die('Database connection failed: ' . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $rawData = $_POST['raw_data'];

    // Step 1: Remove all non-numeric characters except spaces and commas
    $cleanData = preg_replace('/[^0-9, ]/', '', $rawData);

    // Step 2: Split data into potential numbers based on spaces or commas
    $potentialNumbers = preg_split('/[ ,]+/', $cleanData);

    // Step 3: Process each number
    $numbers = [];
    foreach ($potentialNumbers as $num) {
        if (strlen($num) > 10) {
            // If number is longer than 10 digits, assume it's country code + number
            $num = substr($num, -10); // Keep only the last 10 digits
        }
        if (strlen($num) == 10) {
            $numbers[] = $num; // Add valid 10-digit numbers to the list
        }
    }

    // Remove duplicates
    $numbers = array_unique($numbers);

    // Save to database and prepare SQL file content
    $sqlInsertStatements = [];
    foreach ($numbers as $phone) {
        // Save to database
        $stmt = $conn->prepare("INSERT INTO phone_numbers (phone) VALUES (?)");
        $stmt->bind_param('s', $phone);
        $stmt->execute();

        // Prepare SQL insert statements
        $sqlInsertStatements[] = "INSERT INTO phone_numbers (phone) VALUES ('$phone');";
    }

    // Generate CSV
    $csvFilename = 'phone_numbers_.csv';
    $csvFilePath = __DIR__ . '/data/' . $csvFilename;
    $csvFile = fopen($csvFilePath, 'w');
    fputcsv($csvFile, ['ID', 'Phone']);
    $id = 1;
    foreach ($numbers as $phone) {
        fputcsv($csvFile, [$id++, $phone]);
    }
    fclose($csvFile);

    // Generate SQL
    $sqlFilename = 'phone_numbers_.sql';
    $sqlFilePath = __DIR__ . '/data/' . $sqlFilename;
    $sqlFile = fopen($sqlFilePath, 'w');
    fwrite($sqlFile, implode("\n", $sqlInsertStatements));
    fclose($sqlFile);

    // Provide download links
    echo "<p>Files generated successfully:</p>";
    echo "<ul>";
    echo "<li><a href='data/$csvFilename' download>Download CSV File</a></li>";
    echo "<li><a href='data/$sqlFilename' download>Download SQL File</a></li>";
    echo "</ul>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Phone Number Processor</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 20px;
            color: #333;
        }
        .container {
            width: 80%;
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h1 {
            font-size: 2rem;
            color: #007bff;
            text-align: center;
            margin-bottom: 20px;
        }
        textarea {
            width: 100%;
            height: 200px;
            margin-bottom: 20px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            box-sizing: border-box;
        }
        button {
            background-color: #007bff;
            color: #fff;
            padding: 15px;
            width: 100%;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        button:hover {
            background-color: #0056b3;
        }
        ul {
            list-style-type: none;
            padding-left: 0;
            text-align: center;
        }
        ul li {
            margin: 10px 0;
        }
        ul li a {
            text-decoration: none;
            color: #007bff;
            font-size: 18px;
        }
        ul li a:hover {
            color: #0056b3;
        }
        .footer {
            text-align: center;
            margin-top: 40px;
            font-size: 14px;
            color: #777;
        }
        .footer a {
            color: #007bff;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Phone Number Processor</h1>
        <form method="POST" action="">
            <textarea name="raw_data" placeholder="Paste raw phone numbers here..."></textarea>
            <button type="submit">Process and Download</button>
        </form>

        <?php if (isset($csvFilename) && isset($sqlFilename)): ?>
            <h3>Files Generated:</h3>
            <ul>
                <li><a href="<?= "data/".$csvFilename; ?>" download>Download CSV File</a></li>
                <li><a href="<?= "data/".$sqlFilename; ?>" download>Download SQL File</a></li>
            </ul>
        <?php endif; ?>
    </div>

    <div class="footer">
        <p>&copy; 2024 <a href="index">CuteTools</a>. All rights reserved.</p>
    </div>

</body>
</html>
