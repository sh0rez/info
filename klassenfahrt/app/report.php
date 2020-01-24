<?php include_once("common.php"); ?>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
              integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    </head>
    <style>
        *, *:before, *:after {
            box-sizing: border-box;
        }
    </style>
    <body>
    <?php echo RenderNav("", "active", ""); ?>
    <main style="display: flex; flex-direction: column; align-items: center; padding: 1em;">
        <div style="display: flex; width: 100%; max-width: 900px; flex-direction: column; margin-bottom: 1em">
            <h1>Bericht</h1>
        </div>
        <div style="display: flex; flex-wrap: wrap; max-width: 900px; width: 100%; margin-left: -1em;">
            <?php
              $rooms = $pdo->query("SELECT * from $RoomsTable");
              foreach ($rooms as $r) {
                  echo RenderRoom($r, false, false);
              }
            ?>
        </div>
    </main>
    </body>
</html>