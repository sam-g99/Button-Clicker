<?php
session_start();

$username = htmlentities($_SESSION['username']);

if (isset($_SESSION['username'])) {
    echo "<nav class='logged-in'><p class='greeting'>Hello $username</p>
    <a href='/logout.php'> Logout </a></nav>";
} else {
    $nav = '
    <nav>
    <a href="/"> Home </a>
    <a href="/login.php"> Login </a>
        <a href="/register.php"> Register </a></nav>';
    echo $nav;
}
