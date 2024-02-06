<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>
        @page {
            size: A4;
            margin: 0;
        }

        body {
            text-align: center;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }

        .qr-code-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
            max-width: 20%;
            margin-bottom: 20px;
        }

        .qr-code {
            margin: 10px;
            padding: 10px;
            width: calc(.33% - 22px);
            /* Three QR codes per row with margins */
        }

        .qr-code img {
            width: 50%;
            max-width: 50px;
            height: auto;
        }

        .qr-label {
            margin-top: 5px;
            font-size: 12px;
        }
    </style>
</head>

<body>
    <div class="qr-code-container">
        @foreach ($barcodes as $barcode)
            <div class="qr-code">
                {!! DNS2D::getBarcodeHTML($barcode, 'QRCODE') !!}
                <div class="qr-label">Label for QR Code: {{ $barcode }}</div>
            </div>
        @endforeach
    </div>
</body>

</html>
