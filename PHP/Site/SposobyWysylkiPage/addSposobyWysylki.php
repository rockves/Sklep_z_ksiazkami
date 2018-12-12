<?php
		require_once(__DIR__.'/../Untitles/connection.php');
		if(!$_SESSION['czyPracownik']) die();
		$name = '';
		$szybkosc = '';
		$cena = '';
		if($_SERVER["REQUEST_METHOD"] == "POST"){
			require_once(__DIR__.'/../Untitles/Tables/SposobyWysylki/operations_on_SposobyWysylki.php');
			if($errMsg != ''){
				$name = $_POST['nazwa'];
				$szybkosc = $_POST['szybkosc'];
				$cena = $_POST['cena'];
			}
		}
	?>
<div id="form">
    <form action="" method="post">
        <input type="hidden" name="akcja" value="insert">
        Podaj nazwę usługi: <input type="text" name="nazwa" value="<?php echo $name;?>" /><br>
        Podaj szybkość usługi (w dniach): <input type="text" name="szybkosc" value="<?php echo $szybkosc;?>" /><br>
        Podaj koszt usługi: <input type="text" name="cena" value="<?php echo $cena;?>" /><br>
        <input type="submit" />
    </form>
</div>
<?php
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		if($errMsg == ''){
			echo "<span class='succMsg'>Pomyślnie dodano sposób wysyłki</span>";
		}else if(!empty($errMsg)){
			echo "<span class='errMsg'>$errMsg</span>";
		}
	}
	?>