<?php
include_once('common.php');

function RenderContacts()
{
    global $pdo;
    global $AddressTable;
    global $urlPrefix;
    $addrs = $pdo->query("SELECT * from $AddressTable;");

    $s = "";

    foreach ($addrs as $addr) {
        $name = $addr["Name"];
        $surname = $addr["Surname"];
        $email = $addr["Email"];
        $address = $addr["Address"];
        $id = $addr["ID"];

        $s .= <<<HTML
<form action="$urlPrefix/actions.php" method="post">
<div class="form-row">
    <div class="col-md-auto" style="display: none">
        <input name="id" class="form-control" type="text" value="$id"> 
    </div>
    <input name="name" type="text" class="form-control col-sm" placeholder="Vorname" value="$name">
    <input name="surname" type="text" class="form-control col-sm" placeholder="Nachname" value="$surname">
    <input name="address" type="text" class="form-control col-sm" placeholder="Adresse" value="$address">
    <input name="email" type="text" class="form-control col-sm" placeholder="Email" value="$email">
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

    return $s;
}

?>

<html lang="de">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>Adressbuch</title>
</head>
<body>
<style>
    *, *:before, *:after {
        box-sizing: border-box;
    }
</style>

<?php print_r(RenderNav()) ?>
<div style="display: flex; width: 100%; align-items: center; flex-direction: column; padding: 1em;">

    <div style="display: flex; width: 100%; max-width: 800px; flex-direction: column; margin-bottom: 1em">
        <h1>Zimmerverteilung</h1>
    </div>
    <main style="display: flex; width: 100%; max-width: 800px; flex-direction: column" class="card">
        <div class="card-body">
            <div style="margin-top: 1em;" class="container">
                <?php echo RenderContacts()?>
                <hr />
                <?php echo "<form style=\"margin-top: 1em;\" action=\"$urlPrefix/actions.php\" method=\"post\">" ?>
                    <div class="form-row">
                        <input name="name" type="text" class="form-control col-sm" placeholder="Vorname" >
                        <input name="surname" type="text" class="form-control col-sm" placeholder="Nachname">
                        <input name="address" type="text" class="form-control col-sm" placeholder="Adresse">
                        <input name="email" type="text" class="form-control col-sm" placeholder="Email">
                        <div class="col-md-auto">
                            <div class="btn-group">
                                <button class="btn btn-success" type="submit" name="action" value="create">Erstellen</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main>
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
</html>

