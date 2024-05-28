<!DOCTYPE html>
<html>
<head>
    <title>Reservation Mail</title>
    <style>
        /* Voeg hier alleen CSS toe die door alle e-mailclients wordt ondersteund */
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
        .reservation-list {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }
        .reservation-list li {
            margin: 10px 0;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #fafafa;
        }
        .product-info p {
            margin: 5px 0;
        }
        .product-info p:first-child {
            margin-top: 0;
        }
        .product-info p:last-child {
            margin-bottom: 0;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="email-header">
            <h1>Reservation Mail</h1>
        </div>
        <div class="email-body">
            <h2>Hallo, {{ $user }}</h2>
            <p>De volgende producten zijn gereserveerd:</p>
            <ul class="reservation-list">
                @foreach($producten as $product)
                    <li>
                        <div class="product-info">
                            <p><strong>name:</strong> {{ $product->title }} {{ $product->merk }}</p>
                            <p><strong>Category:</strong> {{ $product->category }}</p>
                            <p><strong>Beschrijving:</strong> {{ $product->beschrijving }}</p>
                            <p><strong>Datum:</strong> {{ $product->date }} tot {{ $product->enddate }}</p>
                            <p><strong>Aantal:</strong> {{ $product->count }}</p>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="email-footer">
            <p>&copy; 2024 group 6</p>
        </div>
    </div>
</body>
</html>
