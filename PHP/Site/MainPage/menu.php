<?php
require_once(__DIR__.'/../Untitles/connection.php');
require_once(__DIR__.'/../Untitles/link.php');
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

    $query = 'SELECT Gatunek FROM gatunki';
    if (!($result = $connection->query($query))) {
        die();
    } elseif ($result->num_rows == 0) {
        echo 'W bazie danych nie ma żadnych gatunków';
    } else {
        while ($row = $result->fetch_assoc()) {
            if (!empty($_GET['gatunek'])) {
                if ($_GET['gatunek'] == $row['Gatunek']) {
                    $class = 'curGatunekLi';
                } else {
                    $class = 'gatunekLi';
                }
            } else {
                $class = 'gatunekLi';
            }
            $href = 'mainPage.php?';
            (substr($href, -4) == '.php') ? $href .= '?' : '';
            echo "<li><a href='".$href."gatunek=".$row['Gatunek']."' class='$class'>".$row['Gatunek'].'</a></li>';
        }
        echo '</ul>';
    }
