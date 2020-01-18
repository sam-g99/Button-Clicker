<?php
session_start();

function jsonRes($status, $msg)
{
    return json_encode(array(
        'status' => $status,
        'msg' => $msg
    ));
}

if (!isset($_SESSION['username'])) {
    header('Location: /login.php');
    exit();
}

require 'config.php';

function getStat($sql, $pdo)
{

    $stmt = $pdo->prepare($sql);

    $stmt->execute([$_SESSION['username']]);

    return $stmt->fetch(PDO::FETCH_OBJ);
}

function counter($sql, $pdo)
{
    $stmt = $pdo->prepare($sql);

    $stmt->execute([$_SESSION['username']]);

    return $stmt->fetchColumn();
}

// First Button user clicked
$sql = "SELECT * FROM Clicks WHERE username = ? order by DATE(created) DESC LIMIT 1";

$stat = getStat($sql, $pdo);
if (!empty($stat)) {
    $stats = ['firstButton' => $stat->button];
} else {
    $stats = ['firstButton' => 'none clicked'];
}

// Amount of times the blue button was clicked
$sql = "SELECT COUNT(*) FROM Clicks WHERE username = ? AND button = 'blue button'";

$stat = counter($sql, $pdo);

$stats["blueClicks"] =  $stat;

// Amount of times the green button was clicked
$sql = "SELECT COUNT(*) FROM Clicks WHERE username = ? AND button = 'green button'";

$stat = counter($sql, $pdo);

$stats["greenClicks"] =  $stat;


// Amount of times the gray button was clicked
$sql = "SELECT COUNT(*) FROM Clicks WHERE username = ? AND button = 'gray button'";

$stat = counter($sql, $pdo);

$stats["grayClicks"] =  $stat;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/styles/main.css">
    <title>Stats Page</title>
</head>

<body>
    <?php
    require 'NavBar.php'
    ?>
    <div class="stats-container center">
        <?php
        echo "
            <div> First Button Clicked: $stats[firstButton] </div>
            <div> Blue button clicks: $stats[blueClicks] </div>
            <div> Green button clicks: $stats[greenClicks] </div>
            <div> Gray button clicks: $stats[grayClicks] </div>
        " ?>
        <a href="/buttons.php"> Go back to buttons </a>
    </div>

</body>

</html>