<?php
        require_once(__DIR__.'/../Untitles/connection.php');
        if (!$_SESSION['czyPracownik']) {
            die();
        }

        $query = 'SELECT Id, Nazwa_uzytkownika, Imie, Nazwisko, Ulica, Miasto, Kod_pocztowy, Email, Numer_telefonu, Czy_pracownik FROM uzytkownicy';
        if (!($result = $connection->query($query))) {
            echo 'Nie udało się wyświetlić sposobów płatności';
        } elseif ($result->num_rows == 0) {
            echo 'W bazie danych nie ma żadnych sposobów płatności';
        } else {
            echo '<table class="adminList">';
            echo '
                <tr>
                    <td>ID</td>
                    <td>NAZWA</td>
                    <td>IMIE</td>
                    <td>NAZWISKO</td>
                    <td>ULICA</td>
                    <td>MIASTO</td>
                    <td>KOD POCZTOWY</td>
                    <td>EMAIL</td>
                    <td>NUMER TELEFONU</td>
                    <td>PRACOWNIK</td>
                </tr>';
            while ($row = $result->fetch_assoc()) {
                $pracownik = ($row['Czy_pracownik'] == '0') ? 'NIE' : 'TAK';
                $href = "{$_SERVER['PHP_SELF']}?user=profile&account={$row['Nazwa_uzytkownika']}";
                echo <<<TABLE
                <tr>
                    <td>{$row['Id']}</td>
                    <td><a href="$href">{$row['Nazwa_uzytkownika']}</a></td>
                    <td>{$row['Imie']}</td>
                    <td>{$row['Nazwisko']}</td>
                    <td>{$row['Ulica']}</td>
                    <td>{$row['Miasto']}</td>
                    <td>{$row['Kod_pocztowy']}</td>
                    <td>{$row['Email']}</td>
                    <td>{$row['Numer_telefonu']}</td>
                    <td>$pracownik</td>
                </tr>
TABLE;
            }
            echo '</table>';
        }
