<!-- resources/views/chua_ma_qr.blade.php -->
<!DOCTYPE html>
<html>

<head>
    <title>QR Code View</title>
</head>

<body>
    <h1>QR Code Example</h1>

    <!-- Generate and display the QR code -->
    {!! QrCode::size(100)->generate('Hello World!!!') !!}
    <br>
    {!! QrCode::size(100)->backgroundColor(255, 165, 0)->generate('Hello World 2 !!!') !!}
    <br>


</body>

</html>
