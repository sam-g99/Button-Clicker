<?php
session_start();

// Redirect if already logged in
if (!isset($_SESSION['username'])) {
    header('Location: /login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>

    <?php
    require 'NavBar.php'
    ?>
    <div class="buttons-container">
        <button id="blueButton">Click Me</button>
        <button id="greenButton">Click Me</button>
        <button id="grayButton">Click Me</button>
    </div>

    <a href="/stats.php"> View Stats </a>
</body>

</html>