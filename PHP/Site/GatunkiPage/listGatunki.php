<?php
        require_once(__DIR__.'/../Untitles/connection.php');
        if (!$_SESSION['czyPracownik']) {
            die();
        }
        $query = 'SELECT Id, Gatunek FROM gatunki';
        if (!($result = $connection->query($query))) {
            echo 'Nie udało się wyświetlić gatunków';
        } elseif ($result->num_rows == 0) {
            echo 'W bazie danych nie ma żadnych gatunków';
        } else {
            echo '<table class="adminList">';
            echo '<tr><td>ID</td><td>NAZWA</td></tr>';
            while ($row = $result->fetch_assoc()) {
                echo '<tr><td>'.$row['Id'].'</td><td>'.$row['Gatunek'].'</td></tr>';
            }
            echo '</table>';
        }
