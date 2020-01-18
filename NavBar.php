<?php
session_start();

if (isset($_SESSION['username'])) {
    echo '<a href="/"> Home </a>
    <a href="/logout.php"> Logout </a>';
    exit();
}

$nav = '
<a href="/"> Home </a>
<a href="/login.php"> Login </a>
    <a href="/register.php"> Register </a>';
echo $nav;
