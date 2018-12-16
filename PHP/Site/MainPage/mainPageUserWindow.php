<?php
    if (!empty($_SESSION['czyPracownik'])) {
        if ($_SESSION['czyPracownik'] && !empty($_SESSION['login'])) {
            if (!empty($_GET['table'])) {
                switch ($_GET['table']) {
                    case 'Ksiazki':
                        if (empty($_GET['action'])) {
                            break;
                        }
                        if ($_GET['action'] == 'add') {
                            include(__DIR__."/../KsiazkiPage/addKsiazki.php");
                        } elseif ($_GET['action'] == 'delete') {
                            include(__DIR__."/../KsiazkiPage/deleteKsiazki.php");
                        } elseif ($_GET['action'] == 'update') {
                            include(__DIR__."/../KsiazkiPage/updateKsiazki.php"); //TODO: zrobić update ksiazki
                        }
                        break;
                    case 'Gatunki':
                        if (empty($_GET['action'])) {
                            break;
                        }
                        if ($_GET['action'] == 'add') {
                            include(__DIR__."/../GatunkiPage/addGatunki.php");
                        } elseif ($_GET['action'] == 'delete') {
                            include(__DIR__."/../GatunkiPage/deleteGatunki.php");
                        } elseif ($_GET['action'] == 'update') {
                            include(__DIR__."/../GatunkiPage/updateGatunki.php");
                        } elseif ($_GET['action'] == 'list') {
                            include(__DIR__."/../GatunkiPage/listGatunki.php");
                        }
                        break;
                    case 'Wydawnictwa':
                        if (empty($_GET['action'])) {
                            break;
                        }
                        if ($_GET['action'] == 'add') {
                            include(__DIR__."/../WydawnictwaPage/addWydawnictwa.php");
                        } elseif ($_GET['action'] == 'delete') {
                            include(__DIR__."/../WydawnictwaPage/deleteWydawnictwa.php");
                        } elseif ($_GET['action'] == 'update') {
                            include(__DIR__."/../WydawnictwaPage/updateWydawnictwa.php");
                        } elseif ($_GET['action'] == 'list') {
                            include(__DIR__."/../WydawnictwaPage/listWydawnictwa.php");
                        }
                        break;
                    case 'SposobyPlatnosci':
                        if (empty($_GET['action'])) {
                            break;
                        }
                        if ($_GET['action'] == 'add') {
                            include(__DIR__."/../SposobyPlatnosciPage/addSposobyPlatnosci.php");
                        } elseif ($_GET['action'] == 'delete') {
                            include(__DIR__."/../SposobyPlatnosciPage/deleteSposobyPlatnosci.php");
                        } elseif ($_GET['action'] == 'update') {
                            include(__DIR__."/../SposobyPlatnosciPage/updateSposobyPlatnosci.php");
                        } elseif ($_GET['action'] == 'list') {
                            include(__DIR__."/../SposobyPlatnosciPage/listSposobyPlatnosci.php");
                        }
                        break;
                    case 'SposobyWysylki':
                        if (empty($_GET['action'])) {
                            break;
                        }
                        if ($_GET['action'] == 'add') {
                            include(__DIR__."/../SposobyWysylkiPage/addSposobyWysylki.php");
                        } elseif ($_GET['action'] == 'delete') {
                            include(__DIR__."/../SposobyWysylkiPage/deleteSposobyWysylki.php");
                        } elseif ($_GET['action'] == 'update') {
                            include(__DIR__."/../SposobyWysylkiPage/updateSposobyWysylki.php");
                        } elseif ($_GET['action'] == 'list') {
                            include(__DIR__."/../SposobyWysylkiPage/listSposobyWysylki.php");
                        }
                        break;
                    case 'Uzytkownicy':
                        if (empty($_GET['action'])) {
                            break;
                        }
                        if ($_GET['action'] == 'add') {
                            include(__DIR__."/../UzytkownicyPage/addUzytkownicy.php");
                        } elseif ($_GET['action'] == 'delete') {
                            include(__DIR__."/../UzytkownicyPage/deleteUzytkownicy.php");
                        } elseif ($_GET['action'] == 'update') {
                            include(__DIR__."/../UzytkownicyPage/updateUzytkownicy.php"); //TODO: zrobić update uzytkownicy
                        } elseif ($_GET['action'] == 'list') {
                            include(__DIR__."/../UzytkownicyPage/listUzytkownicy.php");
                        }
                        break;
                    case 'Zamowienia':
                        if (empty($_GET['action'])) {
                            break;
                        }
                        if ($_GET['action'] == 'delete') {
                            include(__DIR__."/../ZamowieniaPage/deleteZamowienia.php");
                        } elseif ($_GET['action'] == 'update') {
                            include(__DIR__."/../ZamowieniaPage/updateZamowienia.php");
                        } elseif ($_GET['action'] == 'list') {
                            include(__DIR__."/../ZamowieniaPage/listZamowienia.php");
                        } elseif ($_GET['action'] == 'info') {
                            include(__DIR__."/../ZamowieniaPage/infoZamowienia.php");
                        }
                        break;

                }
            } elseif (!empty($_GET['report'])) {
                switch ($_GET['report']) {
                    case 'top10':
                        include(__DIR__."/../Reports/top10.php");
                        break;
                    case 'top10Zysk':
                        include(__DIR__."/../Reports/top10Zysk.php");
                        break;
                    case 'sellList':
                        include(__DIR__."/../Reports/sellList.php");
                        break;
                    case 'sellListZysk':
                        include(__DIR__."/../Reports/sellListZysk.php");
                        break;
                    case 'orderCount':
                        include(__DIR__."/../Reports/orderCount.php");
                        break;
                    case 'orderCountAll':
                        include(__DIR__."/../Reports/orderCountAll.php");
                        break;
                }
            }
        }
    }
    if (empty($_GET['table']) && empty($_GET['report'])) {
        if (!empty($_GET['cart'])) {
            switch ($_GET['cart']) {
                case 'add':
                    include(__DIR__."/../KoszykPage/addKoszyk.php");
                    break;
                case 'delete':
                    include(__DIR__."/../KoszykPage/deleteKoszyk.php");
                    break;
            }
            include(__DIR__."/../KoszykPage/infoKoszyk.php");
            $default = '0';
        } elseif (!empty($_GET['product'])) {
            include(__DIR__."/../KsiazkiPage/infoKsiazki.php");
            $default = '0';
        } elseif (!empty($_GET['user'])) {
            switch ($_GET['user']) {
                case 'profile':
                    if (!empty($_GET['edit'])) {
                        include(__DIR__."/../UzytkownicyPage/updateUzytkownicy.php");
                    } else {
                        include(__DIR__."/../UzytkownicyPage/infoUzytkownicy.php");
                    }
                    $default = '0';
                    break;
                case 'register':
                    include(__DIR__."/../UzytkownicyPage//registerUzytkownicy.php");
                    $default = '0';
                    break;
            }
        } else {
            include(__DIR__."/../KsiazkiPage/usersListKsiazki.php");
        }
    }
