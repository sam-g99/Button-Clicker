<?php
$USERS = "CREATE TABLE IF NOT EXISTS Users (
    ID int(11) AUTO_INCREMENT,
    username varchar(16) NOT NULL,
    password varchar(300) NOT NULL,
    PRIMARY KEY (ID)
    )";
