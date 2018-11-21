<!DOCTYPE html>
<html>
<?php 
require_once(__DIR__.'\..\Untitles\connection.php');
?>

<head>
    <meta charset="utf-8" />
    <meta name="author" content="Miłosz Leszko 4C">
    <title>Księgarnia internetowa</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="" />
</head>

<body>
    <div id="header"><span>Księgarnia internetowa</span></div><br>
    <div>
        <div style="float: left;">
            <button onclick="location.href=' ..\\GatunkiPage\\addGatunki.php';">Dodaj gatunek</button><br>
            <button onclick="location.href=' ..\\GatunkiPage\\deleteGatunki.php';">Usuń gatunek</button><br>
            <button onclick="location.href=' ..\\GatunkiPage\\updateGatunki.php';">Edytuj gatunek</button><br>
            <button onclick="location.href=' ..\\GatunkiPage\\listGatunki.php';">Wyświetl gatunki</button><br>
        </div>
        <div style="float: left; margin-left: 5px;">
            <button onclick="location.href=' ..\\WydawnictwoPage\\addWydawnictwo.php';">Dodaj wydawce</button><br>
            <button onclick="location.href=' ..\\WydawnictwoPage\\deleteWydawnictwo.php';">Usuń wydawce</button><br>
            <button onclick="location.href=' ..\\WydawnictwoPage\\updateWydawnictwo.php';">Edytuj wydawce</button><br>
            <button onclick="location.href=' ..\\WydawnictwoPage\\listWydawnictwo.php';">Wyświetl wydawców</button><br>
        </div>
    </div>
</body>

</html>