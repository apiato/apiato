<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>
<h3>Reset password</h3>
<div>
    Please click on the link to reset your password: <a
        href="{{config('app.url')}}/{{$reseturl}}?email={{$email}}&token={{$token}}">{{config('app.url')}}/{{$reseturl}}
        ?email={{$email}}&token={{$token}}</a>.
</div>
</body>
</html>
