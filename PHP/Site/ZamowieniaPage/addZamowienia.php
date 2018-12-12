<?php 
require_once(__DIR__.'/../Untitles/connection.php');
if (session_status() == PHP_SESSION_NONE) session_start();
$error = '';
if(empty($_POST['wysylkaForm'])) $error .= 'Należy wybrać sposób wysyłki';
if(empty($_POST['platnoscForm'])) {
$message = 'Należy wybrać sposób płatności';
empty($error) ? $error = $message : $error .= "<br>$message";
}
if($error != ''){
$_SESSION['errorAddZamowienia'] = $error;
header('Location: ../MainPage/mainPage.php?cart=show');
die();
}
$query = "SELECT COUNT(Id_produktu) AS total FROM koszyk WHERE Id_uzytkownika = '{$_SESSION['id']}'";
$result = $connection->query($query);
$row = $result->fetch_assoc();
if($row['total'] < 1){ $message='Należy dodać produkty do koszyka' ; empty($error) ? $error=$message : $error .="<br>$message" ; $_SESSION['errorAddZamowienia']=$error; header('Location: ../MainPage/mainPage.php?cart=show'); die(); } $id_klienta=$_SESSION['id']; $platnosc=$_POST['platnoscForm']; $wysylka=$_POST['wysylkaForm']; $data=date('Y-m-d'); $query="INSERT INTO zamowienia (Id_klienta, Rodzaj_platnosci, Usluga_wysylki, Data_zamowienia) VALUES ('$id_klienta','$platnosc', '$wysylka', '$data')" ; if(!$connection->query($query)){
    $_SESSION['errorAddZamowienia'] = 'Błąd bazy danych';
    header('Location: ../MainPage/mainPage.php?cart=show');
    die();
    }
    $id_zamowienia = $connection->insert_id;
    $deleteQuery = "DELETE FROM zamowienia WHERE Id = '$id_zamowienia'";
    $query = "SELECT Id, Id_produktu, Ilosc FROM koszyk WHERE Id_uzytkownika = '{$_SESSION['id']}'";
    if(!($result = $connection->query($query))){
    $_SESSION['errorAddZamowienia'] = 'Nie udało się dodać zamówienia';
    $connection->query($deleteQuery);
    header('Location: ../MainPage/mainPage.php?cart=show');
    die();
    }
    if(!$stmtAdd = $connection->prepare("INSERT INTO zamowione (Id_zamowienia, Id_produktu, Ilosc) VALUES (?,?,?)")){
    $_SESSION['errorAddZamowienia'] = 'Nie udało się spreparować';
    $connection->query($deleteQuery);
    header('Location: ../MainPage/mainPage.php?cart=show');
    die();
    }
    $stmtDelete = $connection->prepare("DELETE FROM koszyk WHERE Id = ?");
    $stmtUpdate = $connection->prepare("UPDATE ksiazki SET Sprzedanych = Sprzedanych+? WHERE Id = ?");
    while ($row = $result->fetch_assoc()) {
    $stmtAdd->bind_param("sss",$id_zamowienia, $row['Id_produktu'], $row['Ilosc']);
    $stmtUpdate->bind_param("ss", $row['Ilosc'], $row['Id_produktu']);
    $stmtDelete->bind_param("s", $row['Id']);
    if(!$stmtAdd->execute()){
    $_SESSION['errorAddZamowienia'] = 'Nie udało się dodać zamówienia';
    $connection->query($deleteQuery);
    header('Location: ../MainPage/mainPage.php?cart=show');
    die();
    }
    $stmtDelete->execute();
    $stmtUpdate->execute();
    }
    $_SESSION['successAddZamowienia'] = 'Pomyślnie złożono zamówienie';
    $connection->close();
    header('Location: ../MainPage/mainPage.php?cart=show');
?>