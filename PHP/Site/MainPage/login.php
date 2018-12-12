<?php
require_once(__DIR__.'/../Untitles/connection.php');
if (session_status() == PHP_SESSION_NONE) session_start();

$logNazwa = '';

if($_SERVER["REQUEST_METHOD"] == "POST"){
	require_once(__DIR__.'/../Untitles/Tables/Uzytkownicy/operations_on_Uzytkownicy.php');
	if($loginErrMsg != ''){
		$logNazwa = $_POST['logNazwa'];
	}
}

$self = htmlspecialchars($_SERVER['PHP_SELF']);

if(empty($_SESSION['login'])){

	echo <<<END
		<div id='loginForm'>
		<form action='$self' method='POST'>
			<input type="hidden" name="akcja" value="login"/>
			Login: <input type="text" name="logNazwa" value="$logNazwa"/><br>
			Haslo: <input type="password" name="logHaslo"/><br>
			<input type="submit" name="submit" value='Zaloguj'/>
			<a href='$self?user=register'>Zarejestruj</a>
		</form>
		</div>
END;
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		if(!empty($loginErrMsg)){
			echo "<span class='errMsg'>$loginErrMsg</span>";
		}
	}
}else{
	$koszyk = $_SESSION['czyPracownik'] ? "" : "<a href='$self?cart=show' class='a-login'>&nbsp;Mój koszyk&nbsp;</a>";
	echo <<<END
	<div id='userMenu'>
	<span>Witaj {$_SESSION['login']}!<span><br>
	<a href='$self?user=profile' class='a-login'>&nbsp;Moje konto&nbsp;</a>
	$koszyk
	<form action='logout.php' method='POST'>
	<input type='submit' value='Logout'>
	</form>
	</div>
END;
}
?>