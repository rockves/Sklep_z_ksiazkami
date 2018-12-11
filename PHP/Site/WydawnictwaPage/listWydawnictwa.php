<?php 
    require_once(__DIR__.'/../Untitles/connection.php'); 
    if(!$_SESSION['czyPracownik']) die();

        $query = 'SELECT Id, Wydawca FROM wydawnictwa';
        if(!($result = $connection->query($query))){
            echo 'Nie udało się wyświetlić wydawców';
        }else if($result->num_rows == 0){
            echo 'W bazie danych nie ma żadnych wydawców';
        }else{
            echo '<table class="adminList">';
            echo '<tr><td>ID</td><td>NAZWA</td></tr>';
            while($row = $result->fetch_assoc()) {
                echo '<tr><td>'.$row['Id'].'</td><td>'.$row['Wydawca'].'</td></tr>';
            }
            echo '</table>';
        }
    ?>