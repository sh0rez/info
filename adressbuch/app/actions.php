<?php
include_once("common.php");

$action = $_POST["action"];
$id = $_POST["id"];

$name = $_POST["name"];
$surname = $_POST["surname"];
$address = $_POST["address"];
$email = $_POST["email"];

switch ($action) {
    case "update":
        $sql = "UPDATE $AddressTable SET name='$name', surname='$surname', address='$address', email='$email' WHERE id=$id;";
        $pdo->exec($sql);
        break;
    case "delete":
        $sql = "DELETE FROM $AddressTable WHERE id=$id";
        $pdo->exec($sql);
        break;
    case "create":
        $sql = "INSERT INTO $AddressTable (name, surname, address, email) VALUES ('$name', '$surname', '$address', '$email');";
        $pdo->exec($sql);
        break;
}

header("Location: $urlPrefix/index.php");
