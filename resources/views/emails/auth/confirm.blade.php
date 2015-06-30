<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Registration Confirmation</title>
</head>

<body>
    <h1>Thanks for registering!</h1>
    <p>We just need you to <a href="{{ route('confirm', $token) }}">confirm your email address</a> real quick!</p>
    <br>
    <br>
    <br>
    <p>LaraBin.com</p>
</body>
</html>