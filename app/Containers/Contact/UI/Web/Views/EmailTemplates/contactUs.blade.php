<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">

    <style type="text/css">
        .confirm-btn {
            -moz-box-shadow:inset 0px 1px 0px 0px #97c4fe;
            -webkit-box-shadow:inset 0px 1px 0px 0px #97c4fe;
            box-shadow:inset 0px 1px 0px 0px #97c4fe;
            background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #3d94f6), color-stop(1, #1e62d0) );
            background:-moz-linear-gradient( center top, #3d94f6 5%, #1e62d0 100% );
            filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#3d94f6', endColorstr='#1e62d0');
            background-color:#3d94f6;
            -webkit-border-top-left-radius:20px;
            -moz-border-radius-topleft:20px;
            border-top-left-radius:20px;
            -webkit-border-top-right-radius:20px;
            -moz-border-radius-topright:20px;
            border-top-right-radius:20px;
            -webkit-border-bottom-right-radius:20px;
            -moz-border-radius-bottomright:20px;
            border-bottom-right-radius:20px;
            -webkit-border-bottom-left-radius:20px;
            -moz-border-radius-bottomleft:20px;
            border-bottom-left-radius:20px;
            text-indent:0;
            border:1px solid #337fed;
            display:inline-block;
            color:#ffffff;
            font-family:Arial;
            font-size:15px;
            font-weight:bold;
            font-style:normal;
            height:40px;
            line-height:40px;
            width:220px;
            text-decoration:none;
            text-align:center;
            text-shadow:1px 1px 0px #1570cd;
        }
        .confirm-btn:hover {
            background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #1e62d0), color-stop(1, #3d94f6) );
            background:-moz-linear-gradient( center top, #1e62d0 5%, #3d94f6 100% );
            filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#1e62d0', endColorstr='#3d94f6');
            background-color:#1e62d0;
        }.confirm-btn:active {
             position:relative;
             top:1px;
         }</style>

</head>
<body>
<h3>Support Request from: {{$name}}</h3>
<div>
    Message: {{$content}}
</div>
<div>
    Email: {{$email}}
</div>
</body>
</html>
