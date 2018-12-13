<?php
        require_once(__DIR__.'/../Untitles/connection.php');
        if (!$_SESSION['czyPracownik']) {
            die();
        }
        $tytul = $autor = $opis = $data = $ocena = $cena = '';
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            require_once(__DIR__.'/../Untitles/Tables/Ksiazki/operations_on_Ksiazki.php');
            if ($errMsg != '') {
                $tytul = $_POST['tytul'];
                $autor = $_POST['autor'];
                $opis = $_POST['opis'];
                $data = $_POST['data'];
                $ocena = $_POST['ocena'];
                $cena = $_POST['cena'];
            }
        }
    ?>
<div id="form">
    <form action="" method="post" enctype="multipart/form-data">
        <input type="hidden" name="akcja" value="insert">
        Tytuł: <input type="text" name="tytul" value="<?php echo $tytul;?>" /><br>
        Autor: <input type="text" name="autor" value="<?php echo $autor;?>" /><br>
        Opis: <textarea name="opis" rows="10" cols="50"><?php echo $opis?></textarea><br>
        Gatunek: <select name="gatunek">
            <option style="display:none" disabled selected value> -- Wybierz gatunek -- </option>
            <?php
                $query = 'SELECT * FROM gatunki ORDER BY Id';
                if (($result = $connection->query($query))) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<option value="'.$row['Id'].'">'.$row['Gatunek'].'</option>';
                    }
                    $result->close();
                }
                ?>
        </select><br>
        Data wydania: <input type="date" name="data" max="<?php echo date('Y-m-d');?>" value="<?php echo $data;?>" /><br>
        Wydawnictwo: <select name="wydawnictwo">
            <option style="display:none" disabled selected value> -- Wybierz wydawnictwo -- </option>
            <?php
                $query = 'SELECT * FROM wydawnictwa ORDER BY Id';
                if (($result = $connection->query($query))) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<option value="'.$row['Id'].'">'.$row['Wydawca'].'</option>';
                    }
                    $result->close();
                }
                ?>
        </select><br>
        Ocena książki: <input type="number" name="ocena" min="1" max="10" value="<?php echo $ocena;?>" /><br>
        Cena: <input type="number" name="cena" min="0" step="0.01" value="<?php echo $cena;?>" /><br>
        Okladka: <input type="file" name="okladka" accept="image/*" /><br>
        <input type="submit" />
    </form>
</div>
<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if ($errMsg == '') {
            echo "<span class='succMsg'>Pomyślnie dodano książkę</span>";
        } elseif (!empty($errMsg)) {
            echo "<span class='errMsg'>$errMsg</span>";
        }
    }
    ?>