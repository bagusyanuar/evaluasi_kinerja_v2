<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form role="form" action="/post-login" method="POST">
    @csrf

    <input placeholder="Email" type="email" name="email"/>

    <input placeholder="Password" type="password" name="password"/>

    <button type="submit" class="btn btn-primary my-4">Login</button>
</form>
</body>
</html>
