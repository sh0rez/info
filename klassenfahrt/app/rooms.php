<?php

// rooms
function RenderRoom($room, $empty, $hide)
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

    if ($i == $room["Cap"] && $hide) {
        return "";
    }

    if ($empty) {
        for (; $i < $room["Cap"]; $i++) {
            $inputs .= RenderEmptySpot($i, $room["ID"]);
        }
    }

    $sex = $room["Sex"] == 0 ? "Weiblich" : "Männlich";

    return <<<HTML
<div style="flex-basis: 0; flex-grow: 1; margin-left: 1em; margin-bottom: 1em; max-width: 350px; min-width: 200px;">
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
