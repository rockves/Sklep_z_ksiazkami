<?php
        require_once(__DIR__.'/../Untitles/connection.php');
        if (!$_SESSION['czyPracownik']) {
            die();
        }
        $tytul = '';
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            require_once(__DIR__.'/../Untitles/Tables/Ksiazki/operations_on_Ksiazki.php');
            if ($errMsg != '') {
                $tytul = $_POST['nazwa'];
            }
        }
    ?>
<div id="form">
    <form action="" method="post">
        <input type="hidden" name="akcja" value="delete">
        Podaj książkę do usunięcia: <input type="text" name="tytul" value="<?php echo $tytul;?>" />
        <input type="submit" />
    </form>
</div>
<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if ($errMsg == '') {
            echo "<span class='succMsg'>Pomyślnie usunięto książkę</span>";
        } elseif (!empty($errMsg)) {
            echo "<span class='errMsg'>$errMsg</span>";
        }
    }
    ?>