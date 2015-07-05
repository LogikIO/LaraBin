<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>New comment on your bin!</title>
</head>

<body>
<h3>{{ $comment->user->username }} has commented on your bin!</h3>
<p>Your bin <a href="{{ $comment->bin->url() }}">{{ $comment->bin->title }}</a> has received a new comment!</p>
<br>
<p>Here is the link to the comment: <a href="{{ $comment->getCommentUrl() }}">LINK</a></p>
<br>
<br>
<p>LaraBin.com</p>
</body>
</html>