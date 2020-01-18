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
            'msg' => $msg
        ));
    }

    // Username check
    if (empty($username)) {
        echo jsonRes(400, "Please enter a username");
        exit();
    }

    if (strlen($username) > 16) {
        echo jsonRes(400, "Username needs to be under 16 characters.");
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

    //Hash the password 

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Create account 
    $sql = "INSERT INTO Users (username, password) VALUES (?, ?)";

    $stmt = $pdo->prepare($sql);




    $stmt->execute([$username, $hashedPassword]);

    // Probably should reconsider...
    if ($stmt->errorInfo()[1]) {
        if ($stmt->errorInfo()[1] == "1062") {
            echo jsonRes(409, "Username already exist");
            exit();
        }
        echo jsonRes(409, "Unknown Error");
        exit();
    }

    echo jsonRes(201, "User created.");

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
        <input type="text" name="username" id="username" maxlength="16" required>
        <label for="password">Password</label>
        <input type="password" name="password" id="password" minlength="8" required>
        <label for="password2">Confirm Password</label>
        <input type="password" name="password2" id="password2" minlength="8" required>
        <button type="submit">Submit</button>
        <div id="errorMessage"></div>
    </form>

    <script>
        const register = async () => {
            const formData = new FormData(document.querySelector('form'));

            const response = await fetch('/register.php', {
                method: 'POST',
                body: formData,
            })

            const data = await response.json();
            if (data.status == 201) {
                alert('Your account has been created');
            } else {
                document.getElementById('errorMessage').innerText = data.msg;
            }
        }
    </script>
</body>

</html>