<?php
		require_once(__DIR__.'/../Untitles/connection.php');
		if(!$_SESSION['czyPracownik']) die();
		$name = '';
		if($_SERVER["REQUEST_METHOD"] == "POST"){
			require_once(__DIR__.'/../Untitles/Tables/Uzytkownicy/operations_on_Uzytkownicy.php');
			if($errMsg != ''){
			$name = $_POST['nazwa'];
			}
		}
	?>
<div id="form">
    <form action="" method="post">
        <input type="hidden" name="akcja" value="delete">
        Podaj nazwę użytkownika do usunięcia: <input type="text" name="nazwa" value="<?php echo $name;?>" />
        <input type="submit" />
    </form>
</div>
<?php
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		if($errMsg == ''){
			echo "<span class='succMsg'>Pomyślnie usunięto użytkownika</span>";
		}else if(!empty($errMsg)){
			echo "<span class='errMsg'>$errMsg</span>";
		}
	}
	?>