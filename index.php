<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Example PHP Site</title>
</head>

<body>
    <?php
    $message = htmlentities($_GET["message"]);
    echo "<h1>$message</h1>";
    ?>
    <div class="div">
        <h1>Button Clicker</h1>
        <p> Three buttons, so many clicks. </p>
        <?php
        require_once 'NavBar.php'
        ?>
    </div>
</body>

</html>