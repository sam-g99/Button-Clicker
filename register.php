<?php
require 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $password2 = trim($_POST['password2']);

    function jsonRes($status, $msg)
    {
        return json_encode(array(
            'status' => $status,
            'message' => $msg
        ));
    }

    // Username check
    if (empty($username)) {
        echo jsonRes(400, "Please enter a username");
        exit();
    }

    if (strlen($username) > 16) {
        echo jsonRes(400, "Username is needs to be under 16 characters.");
        exit();
    }

    // Password check
    if (empty($password)) {
        echo jsonRes(400, "Please enter a password.");
        exit();
    }

    if (strlen($password) < 8) {
        echo jsonRes(400, "Password needs to at least be 8 characters.");
        exit();
    }

    // Confirm Password2 check

    if (empty($password2)) {
        echo "Please confirm your password.";

        exit();
    }

    if ($password2 !== $password) {
        echo jsonRes(400, "Passwords do not match.");
        exit();
    }

    echo jsonRes(201, "Good to go.");
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
    <form onsubmit="event.preventDefault(); register();" method="post">
        <label for="username">Username</label>
        <input type="text" name="username" id="username" maxlength="16">
        <label for="password">Password</label>
        <input type="password" name="password" id="password" minlength="8">
        <label for="password2">Confirm Password</label>
        <input type="password" name="password2" id="password2" minlength="8">
        <button type="submit">Submit</button>
    </form>

    <script>
        const register = async () => {
            const formData = new FormData(document.querySelector('form'));

            const response = await fetch('/register.php', {
                method: 'POST',
                body: formData,
            })


            console.log(await response.json());
        }
    </script>
</body>

</html>