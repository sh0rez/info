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

    $nav = RenderNav("active", "", "");
    $rooms = RenderRooms($mRooms, $fRooms);

    $enableApply = "";
    if ($rooms == "") {
        $rooms = "<p>Keine freien Räume verfügbar</p>";
        $enableApply = "disabled";
    }

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
                            <div class="col-md-auto"> <button $enableApply class="btn btn-primary" type="submit">Übernehmen</button> </div>
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

function HasRooms($rooms)
{
    $r = "";
    foreach ($rooms as $row) {
        $r .= RenderRoom($row, true, true);
    }

    return $r == "";
}

function RenderRooms($mRooms, $fRooms)
{
    $male = "";
    foreach ($mRooms as $row) {
        $male .= RenderRoom($row, true, true);
    }

    $female = "";
    foreach ($fRooms as $row) {
        $female .= RenderRoom($row, true, true);
    }

    if ($female == "" && $male == "") {
        return "";
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

