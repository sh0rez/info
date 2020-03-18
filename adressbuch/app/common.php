<?php

// defaults
$AddressTable = "addresses";
$urlPrefix = "";

// load user config (must provide $pdo)
include_once("../config.php");

// database schema
$AddressSchema = <<<SQL
CREATE TABLE IF NOT EXISTS $AddressTable(
    ID INT( 11 ) AUTO_INCREMENT PRIMARY KEY,
    Name VARCHAR ( 255 ),
    Surname VARCHAR (255) NOT NULL,
    Address VARCHAR(255),
    Email VARCHAR(255)
);
SQL;

// ensure schema
$pdo->exec($AddressSchema);

// header
function RenderNav()
{
    global $urlPrefix;
    return <<<HTML
<nav class="navbar navbar-dark navbar-expand-lg bg-dark">
    <a class="navbar-brand" href="$urlPrefix/">Adressbuch</a>
</nav>
HTML;
}

