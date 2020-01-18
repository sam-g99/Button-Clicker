<?php
session_start();

// Redirect if already logged in
if (!isset($_SESSION['username'])) {
    header('Location: /login.php');
    exit();
}

require 'config.php';

function jsonRes($status, $msg)
{
    return json_encode(array(
        'status' => $status,
        'msg' => $msg
    ));
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $button = trim($_POST['button']);

    if (empty($button)) {
        echo  jsonRes(400, "No button set.");
        exit();
    }

    if ($button !== "blue button" && $button !== "green button" && $button !== "gray button") {
        echo jsonRes(400, "button is invalid");
        exit();
    }

    $sql = "INSERT INTO Clicks (button, username) VALUES (?, ?)";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([$button, $_SESSION['username']]);

    echo jsonRes(201, "Click registered");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/styles/main.css">
    <title>Document</title>
</head>

<body>

    <?php
    require 'NavBar.php'
    ?>
    <div class="center">
        <div class="buttons-container">
            <button id="blueButton" onclick="buttonClick('blue button')">Click Me</button>
            <button id="greenButton" onclick="buttonClick('green button')">Click Me</button>
            <button id="grayButton" onclick="buttonClick('gray button')">Click Me</button>
        </div>

        <a href="/stats.php" class="view-stats"> View Stats </a>
    </div>

    <script>
        const buttonClick = async (button) => {
            const formData = new FormData();

            formData.append("button", button);

            const response = await fetch('/buttons.php', {
                method: 'POST',
                body: formData,
            })

            const data = await response.text();
            console.log(data);
        }
    </script>
</body>

</html>