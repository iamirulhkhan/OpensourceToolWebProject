<?php
$qrCodeImage = '';

if (isset($_POST['generate_qr'])) {
    $qrCodeText = trim($_POST['qr_text']);
    
    // Validate the input (ensure it's not empty)
    if (!empty($qrCodeText)) {
        // Encode the text/URL to be used in the Google API
        $encodedText = urlencode($qrCodeText);
        
        // Google Chart API URL for QR code generation
        $qrCodeImage = "https://api.qrserver.com/v1/create-qr-code/?size=300x300&data={$encodedText}";
    } else {
        $qrCodeImage = 'Error: Please provide some text or a URL to generate the QR code.';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CuteTools - Dynamic QR Code Generator</title>
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
            width: 60%;
            margin: 30px auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .container input[type="text"] {
            padding: 10px;
            width: 80%;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1rem;
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
        .container .qr-container {
            text-align: center;
            margin-top: 20px;
        }
        .container img {
            max-width: 200px;
            margin-top: 20px;
        }
        .container .error {
            color: red;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <header class="header">
        <h1>CuteTools - Dynamic QR Code Generator</h1>
    </header>
    <div class="container">
        <h2>Enter URL or Text to Generate QR Code</h2>
        <form action="" method="post">
            <input type="text" name="qr_text" placeholder="Enter URL or Text" required value="<?php echo htmlspecialchars($qrCodeText ?? ''); ?>">
            <button type="submit" name="generate_qr">Generate QR Code</button>
        </form>
        
        <div class="qr-container">
            <?php
            if (!empty($qrCodeImage) && strpos($qrCodeImage, 'Error') === false) {
                echo '<img src="' . $qrCodeImage . '" alt="Generated QR Code">';
            } elseif (strpos($qrCodeImage, 'Error') !== false) {
                echo '<p class="error">' . $qrCodeImage . '</p>';
            }
            ?>
        </div>
    </div>
</body>
</html>
