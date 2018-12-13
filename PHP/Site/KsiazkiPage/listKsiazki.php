<?php require_once(__DIR__.'/../Untitles/connection.php'); if (!$_SESSION['czyPracownik']) {
    die();
} ?>
<style>
table,
tr,
td {
    border: 1px solid black;
    border-collapse: collapse;
    padding: 5px;
    text-align: center;
}
</style>
</head>

<body>
    <?php
        $path = '/GitKraken/Sklep_z_ksiazkami/PHP/Site/Okladki'; //Jeśli coś się psuje z okładka to tu
        $name = "/okladkaID";
        $default_name = "/default";
        $source = '';
        $query = 'SELECT Id, Tytul, Autor, Opis, Gatunek, Data_wydania, Wydawnictwo, Ocena_ksiazki, Cena, Sprzedanych FROM ksiazki';
        if (!($result = $connection->query($query))) {
            echo 'Nie udało się wyświetlić książek';
        } elseif ($result->num_rows == 0) {
            echo 'W bazie danych nie ma żadnych książek';
        } else {
            echo '<table>';
            echo '<tr><td>ID</td><td>TYTUŁ</td><td>AUTOR</td><td>OPIS</td><td>GATUNEK</td><td>DATA WYDANIA</td><td>WYDAWNICTWO</td><td>OCENA</td><td>CENA</td><td>SPRZEDANYCH</td><td>OKLADKA</td></tr>';
            while ($row = $result->fetch_assoc()) {
                clearstatcache();
                if (file_exists("{$_SERVER['DOCUMENT_ROOT']}//GitKraken//Sklep_z_ksiazkami//PHP//Site//Okladki//okladkaID".$row['Id'].'.jpg')) {
                    $source = $path.$name.$row['Id'].'.jpg';
                } else {
                    $source = $path.$default_name.'.png';
                }
                echo '<tr><td>'.$row['Id'].'</td>
                <td>'.$row['Tytul'].'</td>
                <td>'.$row['Autor'].'</td>
                <td>'.$row['Opis'].'</td>
                <td>'.$row['Gatunek'].'</td>
                <td>'.$row['Data_wydania'].'</td>
                <td>'.$row['Wydawnictwo'].'</td>
                <td>'.$row['Ocena_ksiazki'].'</td>
                <td>'.$row['Cena'].'</td>
                <td>'.$row['Sprzedanych'].'</td>
                <td><img src = "'.$source.'" height="30" width="30"></td></tr>';
            }
            echo '</table>';
        }
    ?>
</body>

</html>