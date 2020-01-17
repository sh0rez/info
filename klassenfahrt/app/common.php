<?php

// defaults
$RoomsTable = "rooms";
$StudentsTable = "students";

$urlPrefix = "";

// load user config (must provide $pdo)
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

// ensure schema
$pdo->exec($RoomsSchema);
$pdo->exec($StudentsSchema);

// header
function RenderNav($homeActive, $settingsActive)
{
    global $urlPrefix;
    return <<<HTML
<nav class="navbar navbar-dark navbar-expand-lg bg-dark">
    <a class="navbar-brand" href="$urlPrefix/">Klassenfahrt</a>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item $homeActive">
                <a class="nav-link" href="$urlPrefix/">Home<a>
            </li>
            <li class="nav-item $settingsActive">
                <a class="nav-link" href="$urlPrefix/admin.php">Einstellungen</a>
            </li>
        </ul>
    </div>  
</nav>
HTML;
}
