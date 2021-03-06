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
$sql = "SELECT * FROM Clicks WHERE username = ? order by ID ASC LIMIT 1";

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

// Last Button user clicked
$sql = "SELECT * FROM Clicks WHERE username = ? ORDER BY ID DESC LIMIT 1";

$stat = getStat($sql, $pdo);

if (!empty($stat)) {
    $stats['lastButton'] =  $stat->button;
} else {
    $stats['lastButton'] =  'none clicked';
}


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
    <div class="center">
        <div class="stats-container ">
            <h3>Your Click Stats!</h3>
            <?php
            echo "
            <div> <p>First button clicked</p> $stats[firstButton] </div>
            <div> <p>Last button Clicked</p> $stats[lastButton] </div>
            <div> <p>Blue button clicks</p> $stats[blueClicks] </div>
            <div> <p>Green button clicks</p> $stats[greenClicks] </div>
            <div> <p>Gray button clicks</p> $stats[grayClicks] </div>
        " ?>
            <a href="/buttons.php"> Go back to buttons </a>
        </div>
    </div>

</body>

</html>