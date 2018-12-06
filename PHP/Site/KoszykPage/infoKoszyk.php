<?php

    require_once(__DIR__.'\..\Untitles\connection.php');
    require_once(__DIR__.'\..\Untitles\link.php'); 
    (!empty($_GET['strona'])) ? $strona = $_GET['strona'] : $strona = 1;
    (!empty($_GET['count'])) ? $result_count = $_GET['count'] : $result_count = 10;
    $start_index = ($strona - 1) * $result_count;


    $self = htmlspecialchars($_SERVER['PHP_SELF']);
        $path = '/GitKraken/Sklep_z_ksiazkami/PHP/Site/Okladki'; //Jeśli coś się psuje z okładka to tu
        $name = "/okladkaID";
        $default_name = "/default";
        $source = '';

        $query = "SELECT ksiazki.Id AS Id, ksiazki.Tytul AS Tytul, ksiazki.Cena AS Cena, koszyk.Ilosc AS Ilosc FROM koszyk INNER JOIN ksiazki ON ksiazki.Id = koszyk.Id_produktu WHERE koszyk.Id_uzytkownika = '{$_SESSION['id']}' ORDER BY ksiazki.Cena ASC LIMIT $start_index , $result_count";

        echo "<div class='produktContainer'>";
        if(!($result = $connection->query($query))){
            echo 'Nie udało się wyświetlić koszyka';
            die();
        }else if($result->num_rows == 0){
            echo 'Twój koszyk jest pusty';
            die();
        }else{
            echo '<center><table class="produktTable">';
            clearstatcache();
			$suma = 0;
            while($row = $result->fetch_assoc()) {
                if(file_exists("C:\\xampp\\htdocs\\GitKraken\\Sklep_z_ksiazkami\\PHP\\Site\\Okladki\\okladkaID".$row['Id'].'.jpg')){
                    $source = $path.$name.$row['Id'].'.jpg';
                }else{
                    $source = $path.$default_name.'.png';
                }
				$suma += $row['Cena'] * $row['Ilosc'];
                $href = $_SERVER['PHP_SELF']."?product=".$row['Id'];
                echo '<tr><td><img src = "'.$source.'" height="30" width="30"></td>
                <td><a class="titleLink" href="'.$href.'">'.$row['Tytul'].'</a></td>
                <td>'.$row['Cena'].'</td>
                <td>'.$row['Ilosc'].'</td></tr>';
            }
			echo "<td>Do zapłaty: $suma</td>";
            echo '</table></center>';
            echo '</div>';
        }

        $query = "SELECT COUNT(Id_produktu) AS total FROM koszyk WHERE Id_uzytkownika = '{$_SESSION['id']}'";
        $result = $connection->query($query);
        $row = $result->fetch_assoc();
        $total_pages = ceil($row['total'] / $result_count);
        if($total_pages < 2) die();
        echo "<div class='pageList'>";
        for($i = 1; $i <= $total_pages; $i++){
            echo "<a href='$self?strona=$i&count=$result_count'".($i==$strona ? "class='curPageIndex'" : "class='pageIndex'").">$i</a> ";
        }
        echo "</div>";
    ?>