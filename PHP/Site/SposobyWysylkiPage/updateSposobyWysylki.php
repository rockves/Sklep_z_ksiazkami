<?php
        require_once(__DIR__.'/../Untitles/connection.php');
        if (!$_SESSION['czyPracownik']) {
            die();
        }
        $name = '';
        $newName = '';
        $newSpeed = '';
        $newPrice = '';
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            require_once(__DIR__.'/../Untitles/Tables/SposobyWysylki/operations_on_SposobyWysylki.php');
            if ($errMsg != '') {
                $name = $_POST['nazwa'];
                $newName = $_POST['nowaNazwa'];
                $newSpeed = $_POST['nowaSzybkosc'];
                $newPrice = $_POST['nowaCena'];
            }
        }
    ?>
<div id="form">
    <form action="" method="post">
        <input type="hidden" name="akcja" value="update">
        Podaj nazwę usługi: <input type="text" name="nazwa" value="<?php echo $name;?>" /><br>
        Podaj nową nazwę usługi: <input type="text" name="nowaNazwa" value="<?php echo $newName;?>" /><br>
        Podaj nową szybkość usługi: <input type="text" name="nowaSzybkosc" value="<?php echo $newSpeed;?>" /><br>
        Podaj nową cenę usługi: <input type="text" name="nowaCena" value="<?php echo $newPrice;?>" /><br>
        <input type="submit" />
    </form>
</div>
<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if ($errMsg == '') {
            echo "<span class='succMsg'>Pomyślnie edytowano dane usługi</span>";
        } elseif (!empty($errMsg)) {
            echo "<span class='errMsg'>$errMsg</span>";
        }
    }
    ?>