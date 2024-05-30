<!DOCTYPE html>
<html>
<head>
    <title>Ban Notification</title>
    <style>
        .email-container {
            font-family: Arial, sans-serif;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            border: 1px solid #ddd;
            border-radius: 5px;
            overflow: hidden;
        }
        .email-header {
            background-color: #f2f2f2;
            padding: 20px;
            text-align: center;
        }
        .email-header h1 {
            margin: 0;
            font-size: 24px;
        }
        .email-body {
            padding: 20px;
        }
        .email-footer {
            background-color: #f2f2f2;
            padding: 20px;
            text-align: center;
        }
        .email-footer p {
            margin: 0;
            font-size: 14px;
            color: #777;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="email-header">
            <h1>Ban Notification</h1>
        </div>
        <div class="email-body">
            <h2>Hallo, {{ $name }}</h2>
            <p>We moeten u helaas informeren dat uw account is gebanned.</p>
            <p><strong>Naam: </strong> {{ $name }}</p>
            <p><strong>Gebanned tot Datum: </strong>{{ $banDate }}</p>
            <p>Gedurende deze periode heeft u geen toegang tot onze reservaties.</p>
        </div>
        <div class="email-footer">
            <p>&copy; 2024 group 6</p>
        </div>
    </div>
</body>
</html>
