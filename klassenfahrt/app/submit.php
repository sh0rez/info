<?php

include_once("common.php");

foreach ($_POST as $key => $value) {
    if ($value == "") {
        continue;
    }

    $a = explode("-", $key);
    $roomID = $a[0];

    try {
        $pdo->exec("INSERT INTO students (roomID, Name) VALUES ($roomID, \"$value\");");
    } catch (PDOException $e) {
        echo $e->getMessage();
    }

    header("Location: $urlPrefix/");
}