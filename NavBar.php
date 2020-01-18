<?php
session_start();

if (isset($_SESSION['username'])) {
    echo '<nav><a href="/"> Home </a>
    <a href="/logout.php"> Logout </a></nav>';
    exit();
}

$nav = '
<nav>
<a href="/"> Home </a>
<a href="/login.php"> Login </a>
    <a href="/register.php"> Register </a></nav>';
echo $nav;
