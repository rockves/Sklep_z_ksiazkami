<?php
        require_once(__DIR__.'/../Untitles/connection.php');
        if (!$_SESSION['czyPracownik']) {
            die();
        }
        $query = 'SELECT Id, Nazwa_uslugi, Cena_uslugi FROM sposoby_platnosci';
        if (!($result = $connection->query($query))) {
            echo 'Nie udało się wyświetlić sposobów płatności';
        } elseif ($result->num_rows == 0) {
            echo 'W bazie danych nie ma żadnych sposobów płatności';
        } else {
            echo '<table class="adminList">';
            echo '<tr><td>ID</td><td>NAZWA</td><td>CENA</td></tr>';
            while ($row = $result->fetch_assoc()) {
                echo '<tr><td>'.$row['Id'].'</td><td>'.$row['Nazwa_uslugi'].'</td><td>'.$row['Cena_uslugi'].'</td></tr>';
            }
            echo '</table>';
        }
