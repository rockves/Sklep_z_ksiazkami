<?php
    require_once(__DIR__.'/../../connection.php');
        require_once('classSposobyWysylki.php');
    $errMsg = '';

    if (empty($_POST['akcja'])) {
        exit();
    }

    if ($_POST['akcja'] == 'insert') {
        if (!empty($_POST['nazwa'])) {
            if (!empty($_POST['szybkosc'])) {
                if (!empty($_POST['cena'])) {
                    $sposobWysylki = new SposobWysylki($_POST['nazwa'], $_POST['szybkosc'], $_POST['cena']);
                    $sposobWysylki->insertSposobWysylki();
                } else {
                    $errMsg = "Nie podano ceny usługi";
                }
            } else {
                $errMsg = "Nie podano szybkości usługi";
            }
        } else {
            $errMsg = "Nie podano nazwy usługi";
        }
    } elseif ($_POST['akcja'] == 'delete') {
        if (!empty($_POST['nazwa'])) {
            $sposobWysylki = new SposobWysylki($_POST['nazwa']);
            $sposobWysylki->deleteSposobWysylki();
        } else {
            $errMsg = "Nie podano nazwy usługi";
        }
    } elseif ($_POST['akcja'] == 'update') {
        if (!empty($_POST['nazwa'])) {
            if (empty($_POST['nowaNazwa']) && empty($_POST['nowaSzybkosc']) && empty($_POST['nowaCena'])) {
                $errMsg = "Nie podano danych do edycji";
            } else {
                $nowaNazwa = '';
                $nowaSzybkosc = '';
                $nowaCena = '';
                if (!empty($_POST['nowaNazwa'])) {
                    $nowaNazwa = $_POST['nowaNazwa'];
                }
                if (!empty($_POST['nowaSzybkosc'])) {
                    $nowaSzybkosc = $_POST['nowaSzybkosc'];
                }
                if (!empty($_POST['nowaCena'])) {
                    $nowaCena = $_POST['nowaCena'];
                }
                $sposobWysylki = new SposobWysylki($_POST['nazwa']);
                $errMsg = $sposobWysylki->updateSposobWysylki($nowaNazwa, $nowaSzybkosc, $nowaCena);
            }
        } else {
            $errMsg = "Nie podano nazwy usługi";
        }
    }
