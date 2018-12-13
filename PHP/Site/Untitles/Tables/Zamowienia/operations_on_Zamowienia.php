<?php
    require_once(__DIR__.'/../../connection.php');
    $errMsg = '';

    if (empty($_POST['akcja'])) {
        if ($_POST['akcja'] == 'delete') {
            if (!empty($_POST['id'])) {
                $query = "SELECT Id FROM zamowienia WHERE Id = '{$_POST['id']}' LIMIT 1";
                if (!($result = $connection->query($query))) {
                    $errMsg = 'Nie udało się usunąć gatunku';
                    $result->close();
                } elseif ($result->num_rows == 0) {
                    $errMsg = 'Takie zamówienie nie istnieje';
                    $result->close();
                } else {
                    $result->close();
                    $query = "DELETE FROM zamowienia WHERE Id = '{$_POST['id']}'";
                    $connection->query($query);
                    $query = "DELETE FROM zamowione WHERE Id_zamowienia = '{$_POST['id']}'";
                    $connection->query($query);
                }
            } else {
                $errMsg = "Nie podano numeru zamowienia";
            }
        } elseif ($_POST['akcja'] == 'update') {
            if (empty($_POST['id'])) {
                $errMsg = "Nie podano numeru zamówienia";
            } else {
                $zaplacone = (empty($_POST['zaplacone'])) ? '0' : '1';
                $wykonane = (empty($_POST['wykonane'])) ? '0' : '1';
                $query = "UPDATE zamowienia SET Zaplacone='$zaplacone', Wykonane='$wykonane' WHERE Id='{$_POST['id']}'";
                if (!$connection->query($query)) {
                    $errMsg = "Nie udało się edytować zamówienia";
                }
            }
        }
    }
