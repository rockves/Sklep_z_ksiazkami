<?php 
    if(!empty($_SESSION['czyPracownik'])){
        if($_SESSION['czyPracownik'] && !empty($_SESSION['login'])){
            if(!empty($_GET['table'])){
                switch($_GET['table']){
                    case 'Ksiazki':
                        if(empty($_GET['action'])) break;
                        if($_GET['action'] == 'add'){
                            include(__DIR__."\..\KsiazkiPage\addKsiazki.php");
                        }else if($_GET['action'] == 'delete'){
                            include(__DIR__."\..\KsiazkiPage\deleteKsiazki.php");
                        }else if($_GET['action'] == 'update'){
                            include(__DIR__."\..\KsiazkiPage\updateKsiazki.php"); //TODO: zrobić update ksiazki
                        }
                        break;
                    case 'Gatunki':
                        if(empty($_GET['action'])) break;
                        if($_GET['action'] == 'add'){
                            include(__DIR__."\..\GatunkiPage\addGatunki.php");
                        }else if($_GET['action'] == 'delete'){
                            include(__DIR__."\..\GatunkiPage\deleteGatunki.php");
                        }else if($_GET['action'] == 'update'){
                            include(__DIR__."\..\GatunkiPage\updateGatunki.php");
                        }else if($_GET['action'] == 'list'){
                            include(__DIR__."\..\GatunkiPage\listGatunki.php");
                        }
                        break;
                    case 'Wydawnictwa':
                        if(empty($_GET['action'])) break;
                        if($_GET['action'] == 'add'){
                            include(__DIR__."\..\WydawnictwaPage\addWydawnictwa.php");
                        }else if($_GET['action'] == 'delete'){
                            include(__DIR__."\..\WydawnictwaPage\deleteWydawnictwa.php");
                        }else if($_GET['action'] == 'update'){
                            include(__DIR__."\..\WydawnictwaPage\updateWydawnictwa.php");
                        }else if($_GET['action'] == 'list'){
                            include(__DIR__."\..\WydawnictwaPage\listWydawnictwa.php");
                        }
                        break;
                    case 'SposobyPlatnosci':
                        if(empty($_GET['action'])) break;
                        if($_GET['action'] == 'add'){
                            include(__DIR__."\..\SposobyPlatnosciPage\addSposobyPlatnosci.php");
                        }else if($_GET['action'] == 'delete'){
                            include(__DIR__."\..\SposobyPlatnosciPage\deleteSposobyPlatnosci.php");
                        }else if($_GET['action'] == 'update'){
                            include(__DIR__."\..\SposobyPlatnosciPage\updateSposobyPlatnosci.php");
                        }else if($_GET['action'] == 'list'){
                            include(__DIR__."\..\SposobyPlatnosciPage\listSposobyPlatnosci.php");
                        }
                        break;
                    case 'SposobyWysylki':
                        if(empty($_GET['action'])) break;
                        if($_GET['action'] == 'add'){
                            include(__DIR__."\..\SposobyWysylkiPage\addSposobyWysylki.php");
                        }else if($_GET['action'] == 'delete'){
                            include(__DIR__."\..\SposobyWysylkiPage\deleteSposobyWysylki.php");
                        }else if($_GET['action'] == 'update'){
                            include(__DIR__."\..\SposobyWysylkiPage\updateSposobyWysylki.php");
                        }else if($_GET['action'] == 'list'){
                            include(__DIR__."\..\SposobyWysylkiPage\listSposobyWysylki.php");
                        }
                        break;
                    case 'Uzytkownicy':
                        if(empty($_GET['action'])) break;
                        if($_GET['action'] == 'add'){
                            include(__DIR__."\..\UzytkownicyPage\addUzytkownicy.php");
                        }else if($_GET['action'] == 'delete'){
                            include(__DIR__."\..\UzytkownicyPage\deleteUzytkownicy.php");
                        }else if($_GET['action'] == 'update'){
                            include(__DIR__."\..\UzytkownicyPage\updateUzytkownicy.php"); //TODO: zrobić update uzytkownicy
                        }else if($_GET['action'] == 'list'){
                            include(__DIR__."\..\UzytkownicyPage\listUzytkownicy.php");
                        }
                        break;
                    case 'Zamowienia':
                        if(empty($_GET['action'])) break;
                        if($_GET['action'] == 'delete'){
                            include(__DIR__."\..\ZamowieniaPage\deleteZamowienia.php"); //TODO: zrobić usuwanie zamowienia
                        }else if($_GET['action'] == 'update'){
                            include(__DIR__."\..\ZamowieniaPage\updateZamowienia.php"); //TODO: zrobić update zamowienia
                        }else if($_GET['action'] == 'list'){
                            include(__DIR__."\..\ZamowieniaPage\listZamowienia.php"); //TODO: zrobić liste zamowien
                        }
                        break;

                }
            }
        }
    }
    if(empty($_GET['table'])){
        if(!empty($_GET['cart'])){
            switch ($_GET['cart']){
                case 'add':
                    include(__DIR__."\..\KoszykPage\addKoszyk.php");
                    break;
                case 'delete':
                    include(__DIR__."\..\KoszykPage\deleteKoszyk.php");
                    break;
            }
            include(__DIR__."\..\KoszykPage\infoKoszyk.php");
            $default = '0';
        }else if(!empty($_GET['product'])){
            include(__DIR__."\..\KsiazkiPage\infoKsiazki.php");
            $default = '0';   
        }else if(!empty($_GET['user'])){
            switch ($_GET['user']){
                case 'profile':
                    include(__DIR__."\..\UzytkownicyPage\infoUzytkownicy.php");
                    $default = '0';
                    break;
                case 'register':
                    include(__DIR__."\..\UzytkownicyPage\\registerUzytkownicy.php");
                    $default = '0';
                    break;
            }
        }else{
            include(__DIR__."\..\KsiazkiPage\usersListKsiazki.php");
        }
    }
?>