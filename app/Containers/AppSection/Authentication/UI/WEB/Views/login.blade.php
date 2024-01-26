<!DOCTYPE html>
<html lang="en">
<head>
    <title>Apiato</title>
    <style>
        @import url(https://fonts.googleapis.com/css?family=Roboto:300);

        .login-page {
            width: 360px;
            padding: 8% 0 0;
            margin: auto;
        }

        .form {
            position: relative;
            z-index: 1;
            background: #FFFFFF;
            max-width: 360px;
            margin: 0 auto 100px;
            padding: 45px;
            text-align: center;
            box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
        }

        .form input {
            font-family: "Roboto", sans-serif;
            outline: 0;
            background: #f2f2f2;
            width: 100%;
            border: 0;
            margin: 0 0 15px;
            padding: 15px;
            box-sizing: border-box;
            font-size: 14px;
        }

        .form button {
            font-family: "Roboto", sans-serif;
            text-transform: uppercase;
            outline: 0;
            background: #4CAF50;
            width: 100%;
            border: 0;
            padding: 15px;
            color: #FFFFFF;
            font-size: 14px;
            -webkit-transition: all 0.3s ease;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .form button:hover, .form button:active, .form button:focus {
            background: #43A047;
        }

        .form .message {
            margin: 15px 0 0;
            color: #b3b3b3;
            font-size: 12px;
        }

        .form .message a {
            color: #4CAF50;
            text-decoration: none;
        }

        .form .register-form {
            display: none;
        }

        h1 {
            margin: 0 0 15px;
            padding: 0;
            font-size: 36px;
            font-weight: 300;
            color: #1a1a1a;
        }

        .center {
            text-align: center;
        }

        body {
            background: #ffffff;
            font-family: "Roboto", sans-serif;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        .text-red {
            color: red;
            margin-bottom: 10px;
        }

        .hide {
            display: none;
        }
    </style>
</head>
<body>

<div class="login-page">
    <h1 class="center">Login</h1>
    <form class="form" action="{{ route('login') }}" method="post">
        @csrf
        @if(session('login'))
            <div class="text-red">{{ session('login') }}</div>
        @endif
        <label class="hide" for="email">Email</label>
        <input type="text" placeholder="email" id="email" name="email"/>
        <span class="text-red">{{ $errors->first('email') }}</span>
        <label class="hide" for="password">Password</label>
        <input type="password" placeholder="password" id="password" name="password"/>
        <span class="text-red">{{ $errors->first('password') }}</span>

        <button>login</button>
    </form>
</div>

</body>
</html>
