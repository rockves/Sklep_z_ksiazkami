<?php
    require_once(__DIR__.'/../Untitles/connection.php');
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    if (!$_SESSION['czyPracownik']) {
        die();
    }
        $id = (!empty($_GET['id'])) ? $_GET['id'] : '';

        if (!empty($_GET['paid'])) {
            if ($_GET['paid'] == 1) {
                $paid = 'checked';
            } else {
                $paid = '';
            }
        } else {
            $paid = '';
        }

        if (!empty($_GET['send'])) {
            if ($_GET['send'] == 1) {
                $send = 'checked';
            } else {
                $send = '';
            }
        } else {
            $send = '';
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            require_once(__DIR__.'/../Untitles/Tables/Zamowienia/operations_on_Zamowienia.php');
            if ($errMsg != '') {
                $id = $_POST['id'];
            }
        }
    ?>
<div id="form">
    <form action="" method="post">
        <input type="hidden" name="akcja" value="update">
        Podaj numer zamówienia do edycji: <input type="number" name="id" value="<?php echo $id;?>" /><br>
        Zapłacone: <input type="checkbox" name="zaplacone" <?php echo $paid ?>>&nbsp&nbsp
        Wykonane: <input type="checkbox" name="wykonane" <?php echo $send ?>><br>
        <input type="submit" />
    </form>
</div>
<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if ($errMsg == '') {
            echo "<span class='succMsg'>Pomyślnie edytowano zamówienie</span>";
        } elseif (!empty($errMsg)) {
            echo "<span class='errMsg'>$errMsg</span>";
        }
    }
?>