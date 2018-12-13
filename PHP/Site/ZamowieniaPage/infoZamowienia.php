<?php
    require_once(__DIR__.'/../Untitles/connection.php');
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    if (!$_SESSION['czyPracownik']) {
        die();
    }
    if($_SERVER["REQUEST_METHOD"] != "POST"){
        echo<<<FORM
        <div id="form">
            <form action="" method="post">
                Podaj numer zamówienia do sprawdzenia: <input type="number" name="id"/>
                <input type="submit" />
            </form>
        </div>
FORM;
    }else{
        if(empty($_POST['id'])){
           echo "Nie wybrano zamowienia";
        }else{
            $id = $_POST['id'];
            $query = "SELECT zamowienia.Id AS Id,
                    uzytkownicy.Nazwa_uzytkownika AS Nazwa_klienta,
                    sposoby_platnosci.Nazwa_uslugi AS Platnosc_nazwa,
                    sposoby_platnosci.Cena_uslugi AS Platnosc_cena,
                    sposoby_wysylki.Nazwa_uslugi AS Wysylka_nazwa,
                    sposoby_wysylki.Cena_uslugi AS Wysylka_cena,
                    zamowienia.Data_zamowienia AS Data,
                    zamowienia.Zaplacone AS Zaplacone,
                    zamowienia.Wykonane AS Wykonane 
                    FROM (((zamowienia 
                    INNER JOIN sposoby_platnosci 
                    ON sposoby_platnosci.Id = zamowienia.Rodzaj_platnosci) 
                    INNER JOIN sposoby_wysylki 
                    ON sposoby_wysylki.Id = zamowienia.Usluga_wysylki)
                    INNER JOIN uzytkownicy 
                    ON uzytkownicy.Id = zamowienia.Id_klienta) WHERE zamowienia.Id = '$id'";

            if (!($result = $connection->query($query))) {
                echo 'Nie udało się wyświetlić zamówienia';
                $result->close();
            } elseif ($result->num_rows == 0) {
                echo 'W bazie danych nie ma takiego zamówienia';
                $result->close();
            } else {
                $row = $result->fetch_assoc();
                $zaplacone = ($row['Zaplacone'] == 0) ? 'NIE' : 'TAK';
                $wykonane = ($row['Wykonane'] == 0) ? 'NIE' : 'TAK';
                $href = "{$_SERVER['PHP_SELF']}?table=Zamowienia&action=update&id={$row['Id']}&paid={$row['Zaplacone']}&send={$row['Wykonane']}";
                echo <<<ROW
                <div class="daneZamowienia">
                    <div id='id'><a href="$href">{$row['Id']}</a></div>
                    <div id='nazwa'>{$row['Nazwa_klienta']}</div>
                    <div id='platnosc'>{$row['Platnosc_nazwa']}</div>
                    <div id='wysylka'>{$row['Wysylka_nazwa']}</div>
                    <div id='data'>{$row['Data']}</div>
                    <div id='zaplacone'>$zaplacone</div>
                    <div id='wykonane'>$wykonane</div>
                </div>
ROW;
                echo '<table id="tabelaZamowionychProduktow">';

                $query = "SELECT ksiazki.Id AS Id,
                        ksiazki.Tytul AS Tytul,
                        ksiazki.Cena AS Cena 
                        FROM zamowione 
                        INNER JOIN ksiazki 
                        ON ksiazki.Id = zamowione.Id_produktu 
                        WHERE zamowione.Id_zamowienia = '$id'";
                if (!($result = $connection->query($query))) {
                    echo "Nie udało się wyświetlić produktów w zamówieniu";
                } else {
                    echo "<tr><td>TYTUL</td><td>CENA</td></tr>";
                while ($row = $result->fetch_assoc()) {
                    echo "<tr><td><a href='mainPage.php?product={$row['Id']}'>{$row['Tytul']}</a></td><td>{$row['Cena']}</td></tr>";
                }
                echo "</table>";
            }
        }
    }
        
}

        
?>