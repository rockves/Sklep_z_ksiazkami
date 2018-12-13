<?php
        function liczSumeProduktowZamowienia($id)
        {
            global $connection;
            $suma = 0;
            $query = "SELECT ksiazki.Cena AS Cena 
                        FROM zamowione 
                        INNER JOIN ksiazki 
                        ON ksiazki.Id = zamowione.Id_produktu 
                        WHERE zamowione.Id_zamowienia = '$id'";
            if (!($result = $connection->query($query))) {
                $result->close();
                return $suma;
            } elseif ($result->num_rows < 1) {
                $result->close();
                return $suma;
            }
            while ($row = $result->fetch_assoc()) {
                $suma += $row['Cena'];
            }
            return $suma;
        }
        require_once(__DIR__.'/../Untitles/connection.php');
        if (!$_SESSION['czyPracownik']) {
            die();
        }
        $query = 'SELECT zamowienia.Id AS Id,
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
                    ON uzytkownicy.Id = zamowienia.Id_klienta)';
        if (!($result = $connection->query($query))) {
            echo 'Nie udało się wyświetlić zamówień';
            $result->close();
        } elseif ($result->num_rows == 0) {
            echo 'W bazie danych nie ma żadnych zamówień';
            $result->close();
        } else {
            echo '<table class="adminList">';
            echo <<<TITLE
            <tr>
                <td>NUMER</td>
                <td>UŻYTKOWNIK</td>
                <td>SPOSÓB PŁATNOŚCI</td>
                <td>SPOSÓB WYSYŁKI</td>
                <td>DATA ZAMÓWIENIA</td>
                <td>ZAPLACONE</td><td>WYKONANE</td>
                <td>SUMA</td>
            </tr>
TITLE;
            while ($row = $result->fetch_assoc()) {
                $zaplacone = ($row['Zaplacone'] == 0) ? 'NIE' : 'TAK';
                $wykonane = ($row['Wykonane'] == 0) ? 'NIE' : 'TAK';
                $suma = liczSumeProduktowZamowienia($row['Id']);
                $suma += $row['Platnosc_cena'] + $row['Wysylka_cena'];
                $href = "{$_SERVER['PHP_SELF']}?table=Zamowienia&action=update&id={$row['Id']}&paid={$row['Zaplacone']}&send={$row['Wykonane']}";
                echo <<<ROW
                <tr>
                    <td><a href="$href">{$row['Id']}</a></td>
                    <td>{$row['Nazwa_klienta']}</td>
                    <td>{$row['Platnosc_nazwa']}</td>
                    <td>{$row['Wysylka_nazwa']}</td>
                    <td>{$row['Data']}</td>
                    <td>$zaplacone</td>
                    <td>$wykonane</td>
                    <td>$suma</td>
                </tr>
ROW;
            }
            echo '</table>';
        }
        $result->close();
