<?php

    require_once(__DIR__.'/../Untitles/connection.php');
    require_once(__DIR__.'/../Untitles/link.php');
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
        if (!empty($_SESSION['successAddZamowienia'])) {
            echo $_SESSION['successAddZamowienia'];
            unset($_SESSION['successAddZamowienia']);
            die();
        }
        if (!($result = $connection->query($query))) {
            echo 'Nie udało się wyświetlić koszyka';
            die();
        } elseif ($result->num_rows == 0) {
            echo 'Twój koszyk jest pusty';
            die();
        } else {
            echo '<center><table class="produktTable">';
            clearstatcache();
            $suma = 0;
            while ($row = $result->fetch_assoc()) {
                if (file_exists("{$_SERVER['DOCUMENT_ROOT']}//GitKraken//Sklep_z_ksiazkami//PHP//Site//Okladki//okladkaID".$row['Id'].'.jpg')) {
                    $source = $path.$name.$row['Id'].'.jpg';
                } else {
                    $source = $path.$default_name.'.png';
                }
                $suma += $row['Cena'] * $row['Ilosc'];
                $href = $_SERVER['PHP_SELF']."?product=".$row['Id'];
                echo<<<LIST
                <tr>
                    <td><img src = "$source" height="30" width="30"></td>
                    <td><a class="titleLink" href="$href">{$row['Tytul']}</a></td>
                    <td>{$row['Cena']}</td>
                    <td>{$row['Ilosc']}</td>
                    <td><button type="button" onclick="window.location.href='$self?cart=delete&product={$row['Id']}'">USUŃ</button></td>
                </tr>
LIST;
            }
            echo "<td>Do zapłaty: $suma</td>";
            echo '</table></center>';
            echo "<form action='../ZamowieniaPage/addZamowienia.php' method='POST'>";
            $query = 'SELECT Id, Nazwa_uslugi, Szybkosc_dostawy, Cena_uslugi FROM sposoby_wysylki ORDER BY Nazwa_uslugi ASC';
            if (!($result = $connection->query($query))) {
                echo 'Nie udało się wyświetlić sposobów wysyłki';
                die();
            } elseif ($result->num_rows == 0) {
                echo 'Nie ma sposobów wysyłki';
                die();
            } else {
                echo '<fieldset id="wysylkaForm" style="border:0;"><span style="font-weight:bold">Wybierz metodę wysyłki:</span><table class="wysylkaTable">';
                while ($row = $result->fetch_assoc()) {
                    $cenaW = ($row['Cena_uslugi'] == 0) ? "Za darmo" : "{$row['Cena_uslugi']} zł";
                    echo<<<LIST
                    <tr>
                        <td><input type="radio" value="{$row['Id']}" name="wysylkaForm"></td>
                        <td>{$row['Nazwa_uslugi']}</td>
                        <td>{$row['Szybkosc_dostawy']} dni</td>
                        <td>$cenaW</td>
                    </tr>
LIST;
                }
                echo '</table></fieldset>';
            }

            $query = 'SELECT Id, Nazwa_uslugi, Cena_uslugi FROM sposoby_platnosci ORDER BY Nazwa_uslugi ASC';
            if (!($result = $connection->query($query))) {
                echo 'Nie udało się wyświetlić sposobów płatności';
                die();
            } elseif ($result->num_rows == 0) {
                echo 'Nie ma sposobów płatności';
                die();
            } else {
                echo '<fieldset id="platnoscForm" style="border:0;"><span style="font-weight:bold">Wybierz metodę płatnosci:</span><table class="platnoscTable">';
                while ($row = $result->fetch_assoc()) {
                    $cenaP = ($row['Cena_uslugi'] == 0) ? "Za darmo" : "{$row['Cena_uslugi']} zł";
                    echo<<<LIST
                    <tr>
                        <td><input type="radio" value="{$row['Id']}" name="platnoscForm"></td>
                        <td>{$row['Nazwa_uslugi']}</td>
                        <td>$cenaP</td>
                    </tr>
LIST;
                }
                echo '</table></fieldset><input type="submit">';
            }
            echo '</form>';
            if (!empty($_SESSION['errorAddZamowienia'])) {
                echo $_SESSION['errorAddZamowienia'];
                unset($_SESSION['errorAddZamowienia']);
            }
            echo '</div>';
        }

        $query = "SELECT COUNT(Id_produktu) AS total FROM koszyk WHERE Id_uzytkownika = '{$_SESSION['id']}'";
        $result = $connection->query($query);
        $row = $result->fetch_assoc();
        $total_pages = ceil($row['total'] / $result_count);
        if ($total_pages < 2) {
        } else {
            echo "<div class='pageList'>";
            for ($i = 1; $i <= $total_pages; $i++) {
                echo "<a href='$self?strona=$i&count=$result_count'".($i==$strona ? "class='curPageIndex'" : "class='pageIndex'").">$i</a> ";
            }
            echo "</div>";
        }
