<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>You have been mentioned in a comment!</title>
</head>

<body>
<h3>{{ auth()->user()->username }} has mentioned you in a comment!</h3>
<br>
<p>Here is the link to the comment: <a href="{{ $comment->getCommentUrl() }}">LINK</a></p>
<br>
<br>
<p>LaraBin.com</p>
</body>
</html>