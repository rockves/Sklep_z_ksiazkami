<?php
		require_once(__DIR__.'/../Untitles/connection.php');
		if (!(session_status() == PHP_SESSION_NONE)) {
			if(!empty($_SESSION['login'])){
				echo "Jesteś już zarejestrowany";
				die();
			}
		}else{
			session_start();
		}
		$regNazwa = $regImie = $regNazwisko = $regUlica = $regMiasto = $regKod = $regEmail = $regNumer = '';
		if($_SERVER["REQUEST_METHOD"] == "POST"){
			require_once(__DIR__.'/../Untitles/Tables/Uzytkownicy/operations_on_Uzytkownicy.php');
			if($registerErrMsg != ''){
				$regNazwa = $_POST['regNazwa'];
				$regImie = $_POST['regImie'];
				$regNazwisko = $_POST['regNazwisko'];
				$regUlica = $_POST['regUlica'];
				$regMiasto = $_POST['regMiasto'];
				$regKod = $_POST['regKod'];
				$regEmail = $_POST['regEmail'];
				$regNumer = $_POST['regNumer'];
			}
		}
?>
<div id="regForm">
    <form action="" method="post">
        <input type="hidden" name="akcja" value="register">
        Nazwa użytkownika: <input type="text" name="regNazwa" value="<?php echo $regNazwa;?>" /><br>
        Hasło: <input type="password" name="regHaslo" /><br>
        Imie: <input type="text" name="regImie" value="<?php echo $regImie;?>" /><br>
        Nazwisko: <input type="text" name="regNazwisko" value="<?php echo $regNazwisko;?>" /><br>
        Ulica: <input type="text" name="regUlica" value="<?php echo $regUlica;?>" /><br>
        Miasto: <input type="text" name="regMiasto" value="<?php echo $regMiasto;?>" /><br>
        Kod pocztowy: <input type="text" name="regKod" value="<?php echo $regKod;?>" /><br>
        Email: <input type="regEmail" name="regEmail" value="<?php echo $regEmail;?>" /><br>
        Numer telefonu: <input type="text" name="regNumer" value="<?php echo $regNumer;?>" /><br>
        <input type="submit" name="submit" value="Zarejestruj" />
    </form>
</div>
<?php
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		if($registerErrMsg == '' && $_POST['submit'] == 'Zarejestruj'){
			echo "<span class='succMsg'>Pomyślnie zarejestrowano</span>";
		}else if(!empty($registerErrMsg)){
			echo "<span class='errMsg'>$registerErrMsg</span>";
		}
	}
	?>