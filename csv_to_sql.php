<?php
if (isset($_POST['submit'])) {
    // Check if the file is uploaded without errors
    if ($_FILES['csv_file']['error'] == 0) {
        // Get the file info
        $csvFile = $_FILES['csv_file']['tmp_name'];
        $fileName = $_FILES['csv_file']['name'];
        $fileSize = $_FILES['csv_file']['size'];
        $fileType = $_FILES['csv_file']['type'];

        // Set the maximum file size allowed (5MB in this example)
        $maxFileSize = 5 * 1024 * 1024;

        // Define the allowed MIME types and extensions for CSV files
        $allowedMimeTypes = ['text/csv', 'application/vnd.ms-excel', 'text/plain'];
        $allowedExtensions = ['csv'];

        // Check file size
        if ($fileSize > $maxFileSize) {
            echo "Error: File size exceeds the allowed limit of 5MB.";
            exit;
        }

        // Check MIME type
        if (!in_array($fileType, $allowedMimeTypes)) {
            echo "Error: Invalid file type. Only CSV files are allowed.";
            exit;
        }

        // Check file extension
        $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        if (!in_array($fileExtension, $allowedExtensions)) {
            echo "Error: Invalid file extension. Only .csv files are allowed.";
            exit;
        }

        // Open the CSV file securely
        if (($handle = fopen($csvFile, "r")) !== FALSE) {
            $sqlStatements = "";
            $tableName = "your_table_name"; // Replace with your table name
            $columns = fgetcsv($handle); // Get the column headers

            // Loop through the CSV rows and generate SQL insert statements
            while (($data = fgetcsv($handle)) !== FALSE) {
                // Sanitize the data to prevent SQL injection
                $sanitizedData = array_map(function($value) {
                    return addslashes(trim($value)); // Add slashes to escape special characters
                }, $data);

                // Create the SQL statement
                $sqlStatements .= "INSERT INTO $tableName (" . implode(", ", $columns) . ") VALUES ('" . implode("', '", $sanitizedData) . "');\n";
            }

            fclose($handle);

            // Display the SQL statements in a readable format
            echo "<pre>" . $sqlStatements . "</pre>";

            // Offer the SQL file for download
            header('Content-Type: text/plain');
            header('Content-Disposition: attachment; filename="generated_sql.sql"');
            echo $sqlStatements;
            exit;
        } else {
            echo "Error: Unable to open the file.";
            exit;
        }
    } else {
        echo "Error uploading the file.";
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CuteTools - CSV to SQL Converter</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7fa;
            margin: 0;
            padding: 0;
        }
        .header {
            text-align: center;
            padding: 30px;
            background-color: #007bff;
            color: #fff;
        }
        .header h1 {
            font-size: 2rem;
        }
        .container {
            width: 80%;
            margin: 30px auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .container input[type="file"] {
            padding: 10px;
            margin: 20px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .container button {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 1rem;
            cursor: pointer;
        }
        .container button:hover {
            background-color: #0056b3;
        }
        .container pre {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 5px;
            overflow-x: auto;
        }
    </style>
</head>
<body>
    <header class="header">
        <h1>CuteTools - CSV to SQL Converter</h1>
    </header>
    <div class="container">
        <h2>Upload Your CSV File</h2>
        <form action="" method="post" enctype="multipart/form-data">
            <input type="file" name="csv_file" required>
            <button type="submit" name="submit">Generate SQL</button>
        </form>
    </div>
</body>
</html>
