<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="author" content="Miłosz Leszko 4C">
    <title>Księgarnia internetowa</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="" />
    <?php 
    require_once(__DIR__.'\..\Untitles\connection.php');
    ?>
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
            <button onclick="location.href=' ..\\WydawnictwaPage\\addWydawnictwa.php';">Dodaj wydawce</button><br>
            <button onclick="location.href=' ..\\WydawnictwaPage\\deleteWydawnictwa.php';">Usuń wydawce</button><br>
            <button onclick="location.href=' ..\\WydawnictwaPage\\updateWydawnictwa.php';">Edytuj wydawce</button><br>
            <button onclick="location.href=' ..\\WydawnictwaPage\\listWydawnictwa.php';">Wyświetl wydawców</button><br>
        </div>
        <div style="float: left; margin-left: 5px;">
            <button onclick="location.href=' ..\\SposobyWysylkiPage\\addSposobyWysylki.php';">Dodaj sposób wysyłki</button><br>
            <button onclick="location.href=' ..\\SposobyWysylkiPage\\deleteSposobyWysylki.php';">Usuń sposób wysyłki</button><br>
            <button onclick="location.href=' ..\\SposobyWysylkiPage\\updateSposobyWysylki.php';">Edytuj sposób wysyłki</button><br>
            <button onclick="location.href=' ..\\SposobyWysylkiPage\\listSposobyWysylki.php';">Wyświetl sposoby wysyłki</button><br>
        </div>
        <div style="float: left; margin-left: 5px;">
            <button onclick="location.href=' ..\\SposobyPlatnosciPage\\addSposobyPlatnosci.php';">Dodaj sposób płatności</button><br>
            <button onclick="location.href=' ..\\SposobyPlatnosciPage\\deleteSposobyPlatnosci.php';">Usuń sposób płatności</button><br>
            <button onclick="location.href=' ..\\SposobyPlatnosciPage\\updateSposobyPlatnosci.php';">Edytuj sposób płatności</button><br>
            <button onclick="location.href=' ..\\SposobyPlatnosciPage\\listSposobyPlatnosci.php';">Wyświetl sposoby płatności</button><br>
        </div>
        <div style="float: left; margin-left: 5px;">
            <button onclick="location.href=' ..\\UzytkownicyPage\\addUzytkownicy.php';">Dodaj użytkownika</button><br>
            <button onclick="location.href=' ..\\UzytkownicyPage\\deleteUzytkownicy.php';">Usuń użytkownika</button><br>
            <button onclick="location.href=' ..\\UzytkownicyPage\\listUzytkownicy.php';">Wyświetl użytkowników</button><br>
        </div>
        <div style="float: left; margin-left: 5px;">
            <button onclick="location.href=' ..\\KsiazkiPage\\addKsiazki.php';">Dodaj książkę</button><br>
            <button onclick="location.href=' ..\\KsiazkiPage\\deleteKsiazki.php';">Usuń książkę</button><br>
            <button onclick="location.href=' ..\\KsiazkiPage\\listKsiazki.php';">Wyświetl książkę</button><br>
            <button onclick="location.href=' ..\\KsiazkiPage\\usersListKsiazki.php';">Wyświetl liste książek dla użytkownika</button><br>
        </div>
    </div>
</body>

</html>