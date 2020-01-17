<?php include_once("common.php"); ?>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
<style>
    *, *:before, *:after {
        box-sizing: border-box;
    }

    .setting {
        display: flex;
        width: 100%;
        max-width: 800px;
        flex-direction: column;
        margin-bottom: 1em;
    }
</style>
<?php echo RenderNav("","active") ?>
<div style="display: flex; width: 100%; flex-direction: column; align-items: center; padding: 1em;">
    <div style="display: flex; width: 100%; max-width: 800px; flex-direction: column; margin-bottom: 1em">
        <h1>Einstellungen</h1>
    </div>

    <div class="card setting">
        <div class="card-body" style="display: flex; flex-direction: column;">
            <h3>Räume</h3>
            <?php
            $rooms = $pdo->query("SELECT * from rooms;");

            foreach ($rooms as $r) {
                echo RenderRoomProp($r);
            }
            ?>

            <form action="<?php echo $urlPrefix ?>/actions.php" method="post" style="margin-bottom: 0">
                <button type="submit" class="btn btn-primary" name="action" value="new">Neuer Raum</button>
            </form>
        </div>
    </div>

    <div class="card setting">
        <div class="card-body" style="display: flex; flex-direction: column;">
            <h3>Zurücksetzen</h3>
            <p>Gesame Zimmerverteilung löschen und von vorne beginnen.</p>

            <form action="<?php echo $urlPrefix ?>/actions.php" method="post" style="margin-bottom: 0">
                <button type="submit" class="btn btn-danger" name="action" value="reset">Alles löschen</button>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
        crossorigin="anonymous"></script>
</body>

<?php

function RenderSexPicker($sex)
{
    $male = $sex == 1 ? "selected" : "";
    $female = $sex == 0 ? "selected" : "";

    return <<<HTML
    <option $male>Männlich</option>
    <option $female>Weiblich</option>
HTML;
}

function RenderRoomProp($room)
{
    global $urlPrefix;
    $cap = $room["Cap"];
    $sex = $room["Sex"];
    $id = $room["ID"];


    $caps = "";
    for ($i = 0; $i <= 10; $i++) {
        if ($i == $cap) {
            $caps .= "<option selected>$i</option>";
            continue;
        }
        $caps .= "<option>$i</option>";
    }

    $sexPicker = RenderSexPicker($sex);

    return <<<HTML
<form action="$urlPrefix/actions.php" method="post">
<div class="form-row">
    <div class="col-md-auto" style="display: none">
        <input name="id" class="form-control" type="text" value="$id"> 
    </div>
    <div class="col input-group">
        <div class="input-group-prepend">
            <span class="input-group-text">Betten</span>
        </div>
        <select class="custom-select" name="cap">
            $caps
        </select>
    </div>
    <div class="col input-group">
        <div class="input-group-prepend">
            <span class="input-group-text">Geschlecht</span>
        </div>
        <select class="custom-select" name="sex">
          $sexPicker
        </select>
    </div>
        <div class="col-md-auto">
            <div class="btn-group">
                <button class="btn btn-primary" type="submit" name="action" value="update">Ok</button>
                <button class="btn btn-danger"  type="submit" name="action" value="delete">Löschen</button>
            </div>
        </div>
</div>
</form>
HTML;
}

?>

</html>
