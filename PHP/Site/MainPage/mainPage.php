<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="author" content="Miłosz Leszko 4C">
    <title>Księgarnia internetowa</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="../../../CSS/mainPage.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="../Untitles/untitles.css" />
    <link href="../../../CSS/favicon.ico" rel="icon" type="image/x-icon" />
    <link href="https://fonts.googleapis.com/css?family=Bitter:400,700&amp;subset=latin-ext" rel="stylesheet">
    <script type="text/javascript" src="../../../FusionCharts/js/fusioncharts.js"></script>
    <script type="text/javascript" src="../../../FusionCharts/js/themes/fusioncharts.theme.fusion.js"></script>
    <?php require_once(__DIR__.'/../Untitles/connection.php'); session_start(); $default = '1';?>
</head>

<body>
    <div id="header">
        <a class="headerText" href="mainPage.php">Księgarnia internetowa</a>
    </div>
    <div id="menu">
        <?php include("search.php"); ?>
        <center>
            <h2>KATALOG</h2>
        </center>
        <ul>
            <?php include("menu.php"); ?>
        </ul>
        <?php
            if (!empty($_SESSION['czyPracownik'])) {
                if ($_SESSION['czyPracownik'] == true) {
                    include('reportsPanel.php');
                }
            }
        ?>
    </div>
    <div id="window">
        <?php
            require_once("mainPageUserWindow.php");
        ?>
    </div>
    <div id="rightWindow">
        <?php
            include("login.php");
            if (!empty($_SESSION['login']) && $_SESSION['czyPracownik']) {
                if ($_SESSION['czyPracownik'] == true) {
                    require_once("adminPanel.php");
                }
            }
        ?>
    </div>
    <footer>
        <span>&#x24B8;2018 Miłosz Leszko</span>
        <?php if ($connection->ping()) {
            $connection->close();
        } ?>
    </footer>
</body>

</html>