<?php
        require_once(__DIR__.'/../Untitles/connection.php');
        $nazwa = ($_SESSION['czyPracownik']) ? '' : $_SESSION['login'];
        $newName = $newImie = $newNazwisko = $newUlica = $newMiasto = $newKodPocztowy = $newEmail = $newNumer = '';
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            require_once(__DIR__.'/../Untitles/Tables/Uzytkownicy/operations_on_Uzytkownicy.php');
            if ($errMsg != '') {
                $nazwa = $_POST['nazwa'];
                $newName = $_POST['newName'];
                $newImie = $_POST['newImie'];
                $newNazwisko = $_POST['newNazwisko'];
                $newUlica = $_POST['newUlica'];
                $newMiasto = $_POST['newMiasto'];
                $newKodPocztowy = $_POST['newKodPocztowy'];
                $newEmail = $_POST['newEmail'];
                $newNumer = $_POST['newNumer'];
            }
        }
    ?>
<div id="form">
    <form action="" method="post">
        <input type="hidden" name="akcja" value="update">
        <?php if ($_SESSION['czyPracownik']) {
        echo "Podaj nazwe użytkownika: <input type='text' name='nazwa' value='$nazwa'/><br>";
    } else {
        echo "<input type='hidden' name='nazwa' value='$nazwa'/><br>";
    } ?>
        Podaj nową nazwę: <input type="text" name="newName" value="<?php echo $newName;?>" /><br>
        Podaj nowe hasło: <input type="text" name="newHaslo" /><br>
        Podaj nowe imię: <input type="text" name="newImie" value="<?php echo $newImie;?>" /><br>
        Podaj nowe nazwisko: <input type="text" name="newNazwisko" value="<?php echo $newNazwisko;?>" /><br>
        Podaj nową ulice: <input type="text" name="newUlica" value="<?php echo $newUlica;?>" /><br>
        Podaj nowe miasto: <input type="text" name="newMiasto" value="<?php echo $newMiasto;?>" /><br>
        Podaj nowy kod pocztowy: <input type="text" name="newKodPocztowy" value="<?php echo $newKodPocztowy;?>" /><br>
        Podaj nowy email: <input type="text" name="newEmail" value="<?php echo $newEmail;?>" /><br>
        Podaj nowy numer telefonu: <input type="text" name="newNumer" value="<?php echo $newNumer;?>" /><br>
        <input type="submit" />
    </form>
</div>
<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if ($errMsg == '') {
            echo "<span class='succMsg'>Pomyślnie edytowano dane użytkownika</span>";
            include(__DIR__.'/../MainPage/logout.php');
        } elseif (!empty($errMsg)) {
            echo "<span class='errMsg'>$errMsg</span>";
        }
    }
    ?>