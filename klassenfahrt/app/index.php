<?php
include_once('common.php');

try {
    $mRooms = $pdo->query("SELECT * from $RoomsTable WHERE sex=1");
    $fRooms = $pdo->query("SELECT * from $RoomsTable WHERE sex=0");

    print_r(Render($mRooms, $fRooms));
} catch (PDOException $e) {
    echo $e->getMessage();
}

function Render($mRooms, $fRooms)
{
    global $urlPrefix;

    $nav = RenderNav("active", "");
    $rooms = RenderRooms($mRooms, $fRooms);
    return <<<HTML
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    </head>
    <body>
        <style>
        *, *:before, *:after {
          box-sizing: border-box;
        }
        </style>
        $nav 
        <div style="display: flex; width: 100%; align-items: center; flex-direction: column; padding: 1em;">
        
            <div style="display: flex; width: 100%; max-width: 800px; flex-direction: column; margin-bottom: 1em">
                <h1>Zimmerverteilung</h1>
            </div>
            <main style="display: flex; width: 100%; max-width: 800px; flex-direction: column" class="card">
                <div class="card-body" style="display: flex; flex-direction: column;">
                    <form style="display: flex; flex-direction: column; margin-bottom: 0;" action="$urlPrefix/submit.php" method="post">
                        $rooms 
                        <div class="form-row">
                            <div class="col-md-auto"> <button class="btn btn-primary" type="submit">Übernehmen</button> </div>
                            <div class="col-md-auto"> <button class="btn btn-secondary" type="button" style="margin-bottom: .3em" onclick="window.print()">Drucken</button> </div>
                        </div>
                    </form>
                </div>
            </main>
        </div>
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    </body>
</html>
HTML;
}

function RenderRooms($mRooms, $fRooms)
{
    $male = "";
    foreach ($mRooms as $row) {
        $male .= RenderRoom($row);
    }

    $female = "";
    foreach ($fRooms as $row) {
        $female .= RenderRoom($row);
    }

    return <<<HTML
<div style="display: flex; flex-direction: row; width: 100%; margin-left: -2em; justify-content: space-between;">
    <div style="margin-left: 1em; width: 100%;">
        $male
    </div>
    <div style="margin-left: 1em; width: 100%;">
        $female
    </div>
</div>
HTML;
}

function RenderRoom($room)
{
    global $pdo;
    global $StudentsTable;

    $id = $room["ID"];
    $students = $pdo->query("SELECT * FROM $StudentsTable WHERE roomid=$id");

    $inputs = "";
    $i = 0;
    foreach ($students as $s) {
        $inputs .= RenderSpot($s);
        $i++;
    }

    for (; $i < $room["Cap"]; $i++) {
        $inputs .= RenderEmptySpot($i, $room["ID"]);
    }

    $sex = $room["Sex"] == 0 ? "Weiblich" : "Männlich";

    return <<<HTML
<div style="width: 100%; margin-left: 1em; margin-bottom: 1em;">
    Betten: $room[Cap], $sex
    $inputs
</div>
HTML;
}

function RenderEmptySpot($i, $roomID)
{
    return <<<HTML
<input class="form-control" type="text" name="$roomID-$i" style="width: 100%; margin-bottom: .5em;" />
HTML;
}

function RenderSpot($student)
{
    $name = $student["Name"];
    return <<<HTML
<input disabled value="$name" type="text" style="width: 100%; margin-bottom: .5em;" class="form-control"/>
HTML;
}