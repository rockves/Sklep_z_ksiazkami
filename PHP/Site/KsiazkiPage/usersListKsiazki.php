<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Lista książek</title>
    <?php 
    require_once(__DIR__.'\..\Untitles\connection.php');
    require_once(__DIR__.'\..\Untitles\link.php'); 
    (!empty($_GET['strona'])) ? $strona = $_GET['strona'] : $strona = 1;
    (!empty($_GET['count'])) ? $result_count = $_GET['count'] : $result_count = 10;
    $start_index = ($strona - 1) * $result_count;
    ?>
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
        if(!empty($_GET['search'])){
            $search = prepareFormData($_GET['search']);
            $query = "SELECT ksiazki.Id, Tytul, Ocena_ksiazki, Cena FROM ksiazki INNER JOIN gatunki ON ksiazki.Gatunek = Gatunki.Id WHERE ksiazki.Tytul LIKE '%$search%' ORDER BY ksiazki.Sprzedanych DESC LIMIT $start_index , $result_count";
        }else if(!empty($_GET['gatunek'])){
            $gatunek = prepareFormData($_GET['gatunek']);
            $query = "SELECT ksiazki.Id, Tytul, Ocena_ksiazki, Cena FROM ksiazki INNER JOIN gatunki ON ksiazki.Gatunek = Gatunki.Id WHERE Gatunki.Gatunek = '$gatunek' ORDER BY ksiazki.Sprzedanych DESC LIMIT $start_index , $result_count";
        }else{
            $query = "SELECT Id, Tytul, Ocena_ksiazki, Cena FROM ksiazki ORDER BY ksiazki.Sprzedanych DESC LIMIT $start_index , $result_count";
        }
        echo "<div class='produktContainer'>";
        if(!($result = $connection->query($query))){
            echo 'Nie udało się wyświetlić książek';
            die();
        }else if($result->num_rows == 0){
            echo 'W bazie danych nie ma takiej książki';
            die();
        }else{
            echo '<center><table class="produktTable">';
            clearstatcache();
            while($row = $result->fetch_assoc()) {
                if(file_exists("C:\\xampp\\htdocs\\GitKraken\\Sklep_z_ksiazkami\\PHP\\Site\\Okladki\\okladkaID".$row['Id'].'.jpg')){
                    $source = $path.$name.$row['Id'].'.jpg';
                }else{
                    $source = $path.$default_name.'.png';
                }
                $href = $_SERVER['PHP_SELF']."?product=".$row['Id'];
                echo '<tr><td><img src = "'.$source.'" height="30" width="30"></td>
                <td><a class="titleLink" href="'.$href.'">'.$row['Tytul'].'</a></td>
                <td>'.$row['Ocena_ksiazki'].'</td>
                <td>'.$row['Cena'].'</td></tr>';
            }
            echo '</table></center>';
            echo "</div>";
        }
        if(!empty($_GET['gatunek'])){
            $query = "SELECT COUNT(ksiazki.Id) AS total FROM ksiazki INNER JOIN gatunki ON ksiazki.Gatunek = Gatunki.Id WHERE Gatunki.Gatunek = '$gatunek'";
        }else{
            $query = "SELECT COUNT(Id) AS total FROM ksiazki";
        }
        $result = $connection->query($query);
        $row = $result->fetch_assoc();
        $total_pages = ceil($row['total'] / $result_count);
        $href = getLink();
        (substr($href, -4) == '.php') ? $href .= '?' : '';
        echo "<div class='pageList'>";
        for($i = 1; $i <= $total_pages; $i++){
            $add = '';
            $url = $_GET;
            if(!empty($_GET['strona'])){
                $url['strona'] = $i;
            }else{
                $add .= "&strona=$i";
            }
            if(!empty($_GET['count'])){
                $url['count'] = $result_count;
            }else{
                $add .= "&count=$result_count";
            }
            if(!empty($_GET['strona']) || !empty($_GET['count'])){
                $href = $_SERVER['PHP_SELF']."?";
                $href .= http_build_query($url);
            }
            echo "<a href='$href$add'".($i==$strona ? "class='curPageIndex'" : "class='pageIndex'").">$i</a> ";
        }
        echo "</div>";
    ?>
</body>

</html>