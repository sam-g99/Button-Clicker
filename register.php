<?php
require 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $password2 = trim($_POST['password2']);



    if (empty($username)) {
        echo "Please enter a username";
        exit();
    }

    if (strlen($username) > 16) {
        echo "Username is needs to be under 16 characters.";
        exit();
    }

    echo "Cool beans " . isset($username);
    exit();
}

?>
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
    ?>
    <h1>Register</h1>
    <form action="/register.php" method="post">
        <label for="username">Username</label>
        <input type="text" name="username" id="username">
        <label for="password">Password</label>
        <input type="password" name="password" id="password">
        <label for="password2">Confirm Password</label>
        <input type="password" name="password2" id="password2">
        <button type="submit">Submit</button>
    </form>
</body>

</html>