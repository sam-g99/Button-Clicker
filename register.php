<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
</head>

<body>
    <?php
    require 'NavBar.php';
    require 'config.php';
    $username = $_POST['username'];
    $password = $_POST['password'];
    $password2 = $_POST['password2'];

    if (isset($username) && isset($password) && isset($confirmPw)) {
        echo 'halleluja';
    }

    ?>
    <h1>Register</h1>
    <form action="" method="post">
        <label for="username">Username</label>
        <input type="text" name="username" id="username">
        <label for="password">Password</label>
        <input type="password" name="password" id="password">
        <label for="password2">Confirm Password</label>
        <input type="password2" name="password2" id="password2">
    </form>
</body>

</html>