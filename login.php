<?php
session_start();

// Redirect if already logged in
if (isset($_SESSION['username'])) {
    header('Location: /');
    exit();
}

require 'config.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    function jsonRes($status, $msg)
    {
        return json_encode(array(
            'status' => $status,
            'msg' => $msg
        ));
    }

    if (isset($_SESSION['username'])) {
        echo jsonRes(200, "You're already logged in.");
        exit();
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

    // Get user data

    $sql = "SELECT * FROM Users WHERE username = ?";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([$username]);

    $user = $stmt->fetch(PDO::FETCH_OBJ);

    if (empty($user)) {
        echo jsonRes(401, "Username does not exist.");
        exit();
    }

    if (password_verify($password, $user->password)) {
        $_SESSION['username'] = $user->username;
        echo jsonRes(201, "Logged In");
        exit();
    } else {
        echo jsonRes(401, "Wrong password.");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/styles/main.css">
    <title>Login</title>
</head>

<body>

    <div class="center">
        <h1>Login</h1>
        <form onsubmit="event.preventDefault(); login();" method="post">
            <label for="username">Username</label>
            <input type="text" name="username" id="username" maxlength="16" required>
            <label for="password">Password</label>
            <input type="password" name="password" id="password" minlength="8" required>
            <button type="submit">Submit</button>
            <div id="errorMessage"></div>
        </form>
        <?php
        require_once 'NavBar.php'
        ?>
    </div>
    <script>
        const login = async () => {
            const formData = new FormData(document.querySelector('form'));

            const response = await fetch('/login.php', {
                method: 'POST',
                body: formData,
            })

            const data = await response.json();

            if (data.status == 201) {
                window.location = "/";
            } else {
                document.getElementById('errorMessage').innerText = data.msg;
            }
        }
    </script>
</body>

</html>