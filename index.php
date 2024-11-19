<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CuteTools - Free Tools for Your Productivity Hub</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(120deg, #f3f4f6, #ffffff);
        }

        .header {
            text-align: center;
            padding: 50px 20px;
            background: #007bff;
            color: #fff;
        }

        .header h1 {
            font-size: 2.5rem;
            margin: 0;
            padding: 0;
        }

        .header p {
            font-size: 1.2rem;
            margin-top: 10px;
        }

        .tools-section {
            padding: 50px 20px;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 30px;
        }

        .tool-card {
            width: 300px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            text-align: center;
            overflow: hidden;
            padding: 20px;
        }

        .tool-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 6px 10px rgba(0, 0, 0, 0.15);
        }

        .tool-card i {
            font-size: 50px;
            color: #007bff;
            margin-bottom: 20px;
        }

        .tool-card h3 {
            font-size: 1.5rem;
            margin: 20px 0 10px;
            color: #333;
        }

        .tool-card p {
            font-size: 1rem;
            color: #666;
            margin: 0 20px 20px;
        }

        .tool-card a {
            display: inline-block;
            margin-bottom: 20px;
            padding: 10px 20px;
            background: #007bff;
            color: #fff;
            border-radius: 5px;
            text-decoration: none;
            font-size: 1rem;
            transition: background 0.3s ease;
        }

        .tool-card a:hover {
            background: #0056b3;
        }

        .footer {
            text-align: center;
            padding: 20px;
            background: #f3f4f6;
            font-size: 0.9rem;
            color: #777;
        }
    </style>
</head>
<body>
    <header class="header">
        <h1>CuteTools - Explore Our Free Tools Hub</h1>
        <p>All tools are completely free of cost to help you enhance your productivity.</p>
    </header>

    <section class="tools-section">
        <!-- Tool Card Example 1 -->
        <div class="tool-card">
            <i class="fas fa-phone-alt"></i>
            <h3>Phone Number Processor</h3>
            <p>Quickly clean, format, and process phone numbers for your projects.</p>
            <a href="raw_number_to_excel">Use Now</a>
        </div>

        <!-- Tool Card Example 2 -->
        <div class="tool-card">
            <i class="fas fa-database"></i>
            <h3>CSV to SQL Converter</h3>
            <p>Transform your CSV data into SQL scripts effortlessly.</p>
            <a href="csv_to_sql">Try Now</a>
        </div>

        <!-- Tool Card Example 3 -->
        <div class="tool-card">
            <i class="fas fa-qrcode"></i>
            <h3>Dynamic QR Code Generator</h3>
            <p>Create dynamic UPI QR codes with custom pricing in seconds.</p>
            <a href="d-qr">Try Now</a>
        </div>

        <!-- Tool Card Example 4 -->
        <div class="tool-card">
            <i class="fas fa-file-pdf"></i>
            <h3>PDF Form Filler</h3>
            <p>Fill blank PDFs dynamically and download them instantly.</p>
            <a href="/pdf-form-filler">Try Now</a>
        </div>

        <!-- Tool Card Example 5 -->
        <div class="tool-card">
            <i class="fas fa-lock"></i>
            <h3>Password Hash Generator</h3>
            <p>Securely hash your passwords using industry-standard algorithms.</p>
            <a href="password-hash-generator">Generate Now</a>
        </div>
    </section>

    <footer class="footer">
        <p>&copy; 2024 CuteTools. All tools are free and built to empower your workflows.</p>
    </footer>
</body>
</html>
