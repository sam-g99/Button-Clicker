<?php
$USERS = "CREATE TABLE IF NOT EXISTS Users (
    ID int(11) AUTO_INCREMENT,
    username varchar(16) NOT NULL UNIQUE,
    password varchar(300) NOT NULL,
    PRIMARY KEY (ID)
    )";

$CLICKS = "CREATE TABLE IF NOT EXISTS Clicks (
    ID int(11) AUTO_INCREMENT,
    button varchar(100) NOT NULL,
    username varchar(16) NOT NULL,
    created TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (ID)
    )";
