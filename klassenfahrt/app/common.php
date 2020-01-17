<?php

// defaults
$HOST = "127.0.0.1";
$USER = "root";
$PASS = "root";

$RoomsTable = "rooms";
$StudentsTable = "students";

$urlPrefix = "";

// load user config
include_once("../config.php");

// database schema
$RoomsSchema = <<<SQL
CREATE TABLE IF NOT EXISTS $RoomsTable(
    ID INT( 11 ) AUTO_INCREMENT PRIMARY KEY,
    Cap INT ( 11 ) NOT NULL,
    Sex BOOLEAN
);
SQL;

$StudentsSchema = <<<SQL
CREATE TABLE IF NOT EXISTS $StudentsTable(
    ID INT ( 11 ) AUTO_INCREMENT PRIMARY KEY,
    RoomID INT,
    Name VARCHAR ( 255 ),
    FOREIGN KEY (RoomID) REFERENCES $RoomsTable(ID) ON DELETE CASCADE
);
SQL;

// database client
$pdo = new PDO("mysql:host=$HOST;dbname=test", $USER, $PASS);

// ensure schema
$pdo->exec($RoomsSchema);
$pdo->exec($StudentsSchema);
