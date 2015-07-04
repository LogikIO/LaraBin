<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Account manually activated!</title>
</head>

<body>
<h1>Thanks for registering!</h1>
<p>Hello, {{ $name }}!</p>
<p>We have manually activated your account. You may now login.</p>
<p><a href="{{ route('login') }}">larabin.com/login</a></p>
<br>
<p>Sorry for the inconvenience!</p>
<br>
<br>
<p>LaraBin.com</p>
</body>
</html>