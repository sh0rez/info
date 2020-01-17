<?php
include_once("common.php");

$action = $_POST["action"];
switch ($action) {
    case "new":
        $pdo->exec("INSERT INTO $RoomsTable (cap, sex) VALUES (0, true);");
        break;
    case "delete":
        $id = $_POST["id"];
        $pdo->exec("DELETE FROM $RoomsTable WHERE id=$id;");
        break;
    case "reset":
        $pdo->exec("DROP TABLE $StudentsTable");
        $pdo->exec("DROP TABLE $RoomsTable");
        break;
    case "update":
        $id = $_POST["id"];
        $sex = $_POST["sex"] == "Männlich" ? 1 : 0;
        $cap = $_POST["cap"];

        $sql = "UPDATE $RoomsTable SET sex=$sex, cap=$cap WHERE id=$id;";
        $pdo->exec($sql);
}

header("Location: $urlPrefix/admin.php");
