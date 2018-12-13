<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Lista książek</title>
    <?php 
    require_once(__DIR__.'/../Untitles/connection.php');
    require_once(__DIR__.'/../Untitles/link.php'); 
    (!empty($_GET['strona'])) ? $strona = $_GET['strona'] : $strona = 1;
    (!empty($_GET['count'])) ? $result_count = $_GET['count'] : $result_count = 9;
    $start_index = ($strona - 1) * $result_count;
    ?>
</head>

<body>
    <?php
        $self = htmlspecialchars($_SERVER['PHP_SELF'], ENT_QUOTES, 'utf-8');
        $path = '/GitKraken/Sklep_z_ksiazkami/PHP/Site/Okladki'; //Jeśli coś się psuje z okładka to tu
        $name = "/okladkaID";
        $default_name = "/default";
        $source = '';
        if(!empty($_GET['search'])){
            $search = prepareFormData($_GET['search']);
            $query = "SELECT ksiazki.Id, Tytul, Autor, Cena FROM ksiazki INNER JOIN gatunki ON ksiazki.Gatunek = gatunki.Id WHERE ksiazki.Tytul LIKE '%$search%' ORDER BY ksiazki.Sprzedanych DESC LIMIT $start_index , $result_count";
        }else if(!empty($_GET['gatunek'])){
            $gatunek = prepareFormData($_GET['gatunek']);
            $query = "SELECT ksiazki.Id, Tytul, Autor, Cena FROM ksiazki INNER JOIN gatunki ON ksiazki.Gatunek = gatunki.Id WHERE gatunki.Gatunek = '$gatunek' ORDER BY ksiazki.Sprzedanych DESC LIMIT $start_index , $result_count";
        }else{
            $query = "SELECT Id, Tytul, Autor, Cena FROM ksiazki ORDER BY ksiazki.Sprzedanych DESC LIMIT $start_index , $result_count";
        }
        echo "<div class='produktContainer'>";
        if(!($result = $connection->query($query))){
            echo 'Nie udało się wyświetlić książek';
            die();
        }else if($result->num_rows == 0){
            echo 'W bazie danych nie ma takiej książki';
            die();
        }else{
            echo '<div class="produktList">';
            clearstatcache();
            while($row = $result->fetch_assoc()) {
                if(file_exists("{$_SERVER['DOCUMENT_ROOT']}//GitKraken//Sklep_z_ksiazkami//PHP//Site//Okladki//okladkaID".$row['Id'].'.jpg')){
                    $source = $path.$name.$row['Id'].'.jpg';
                }else{
                    $source = $path.$default_name.'.png';
                }
                $href = $_SERVER['PHP_SELF']."?product=".$row['Id'];
                echo <<<LIST
                <div class='produktItem'>
                    <a class='itemImage' href='$href'>
                        <img src="$source">
                    </a>
                    <div class='itemOpis'>
                        <a class="itemTitle" href="$href">{$row['Tytul']}</a><br>
                        <span class='itemAuthor'>{$row['Autor']}</span><br>
                        <span class='itemPrice'>{$row['Cena']}</span><br>
                        <button type="button" onclick="window.location.href='$self?cart=add&product={$row['Id']}'">DO KOSZYKA</button>
                    </div>
                </div>
LIST;
            }
            echo '</div></div>';
        }
        if(!empty($_GET['gatunek'])){
            $query = "SELECT COUNT(ksiazki.Id) AS total FROM ksiazki INNER JOIN gatunki ON ksiazki.Gatunek = gatunki.Id WHERE gatunki.Gatunek = '$gatunek'";
        }else if(!empty($_GET['search'])){
            $query = "SELECT COUNT(ksiazki.Id) AS total FROM ksiazki INNER JOIN gatunki ON ksiazki.Gatunek = gatunki.Id WHERE ksiazki.Tytul LIKE '%$search%'";
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
                $href = $self."?";
                $href .= http_build_query($url);
            }
            echo "<a href='$href$add'".($i==$strona ? "class='curPageIndex'" : "class='pageIndex'").">$i</a> ";
        }
        echo "</div>";
    ?>
</body>

</html>