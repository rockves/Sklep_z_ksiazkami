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
    <?php require_once(__DIR__.'\..\Untitles\connection.php'); session_start(); $default = '1';?>
</head>

<body>
    <div id="header">
        <h1>
            <a href="mainPage.php" style="text-decoration: none; color: black;">Księgarnia internetowa</a>
            </h1>
    </div>
    <div id="menu">
        <center>
            <h2>KATALOG</h2>
        </center>
        <ul>
            <?php include("menu.php"); ?>
        </ul>
        <?php include("login.php"); ?>
    </div>
    <div id="window">
        <?php 
        if(!empty($_GET['product'])){
            include(__DIR__."\..\KsiazkiPage\infoKsiazki.php");
            $default = '0';   
        }else if(!empty($_GET['user'])){
            if($_GET['user'] == 'profile'){
                include(__DIR__."\..\UzytkownicyPage\infoUzytkownicy.php");
                $default = '0';  
            }else if($_GET['user'] == 'register'){
                include(__DIR__."\..\UzytkownicyPage\\registerUzytkownicy.php");
                $default = '0';
            }
        }
        if($default == '1') include(__DIR__."\..\KsiazkiPage\usersListKsiazki.php");

        ?>
    </div>
    <footer><span>Miłosz Leszko</span></footer>
</body>

</html>