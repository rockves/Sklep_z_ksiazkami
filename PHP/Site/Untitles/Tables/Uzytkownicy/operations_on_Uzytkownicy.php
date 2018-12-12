<?php
	require_once(__DIR__.'/../../connection.php');
	require_once('classUzytkownicy.php');
	$errMsg = '';
	$loginErrMsg = '';
	$registerErrMsg = '';

	if (empty($_POST['akcja'])) {
		exit();
	}

	if ($_POST['akcja'] == 'insert') {
		if(empty($_POST['nazwa'])) $errMsg .= 'Nie podano nazwy użytkownika';
		if(empty($_POST['haslo'])) $errMsg .= '<br>Nie podano hasła';
		if(empty($_POST['imie'])) $errMsg .= '<br>Nie podano imienia';
		if(empty($_POST['nazwisko'])) $errMsg .= '<br>Nie podano nazwiska';
		if(empty($_POST['ulica'])) $errMsg .= '<br>Nie podano ulicy';
		if(empty($_POST['miasto'])) $errMsg .= '<br>Nie podano miasta';
		if(empty($_POST['kod'])) $errMsg .= '<br>Nie podano kodu pocztowego';
		if(empty($_POST['email'])) $errMsg .= '<br>Nie podano email';
		if(empty($_POST['numer'])) $errMsg .= '<br>Nie podano numeru telefonu';
		if($errMsg == '') {
			$uzytkownik = new Uzytkownik($_POST['nazwa'], $_POST['haslo'], $_POST['imie'], $_POST['nazwisko'], $_POST['ulica'], $_POST['miasto'], $_POST['kod'], $_POST['email'], $_POST['numer'],
			(isset($_POST['czyPracownik']) ? '1' : '0'));
			$errMsg = $uzytkownik->insertUzytkownik();
		}
	} else if($_POST['akcja'] == 'delete'){
		if(!empty($_POST['nazwa'])){
			$uzytkownik = new Uzytkownik($_POST['nazwa']);
			$errMsg = $uzytkownik->deleteUzytkownik();
		}else{
			$errMsg = "Nie podano nazwy użytkownika";
		}
	} else if($_POST['akcja'] == 'update'){
		/*if(!empty($_POST['nazwa'])){
			if(empty($_POST['nowaNazwa']) && empty($_POST['nowaSzybkosc']) && empty($_POST['nowaCena'])){
				$errMsg = "Nie podano danych do edycji";
			}else{
				$nowaNazwa = '';
				$nowaSzybkosc = '';
				$nowaCena = '';
				if(!empty($_POST['nowaNazwa'])){
					$nowaNazwa = $_POST['nowaNazwa'];
				} 
				if(!empty($_POST['nowaSzybkosc'])){
					$nowaSzybkosc = $_POST['nowaSzybkosc'];
				} 
				if(!empty($_POST['nowaCena'])){
					$nowaCena = $_POST['nowaCena'];
				} 
				updateSposobWysylki($_POST['nazwa'], $nowaNazwa, $nowaSzybkosc, $nowaCena);
			}*/
		}else if($_POST['akcja'] == 'login' && $_POST['submit'] == 'Zaloguj'){
			if(!empty($_POST['logNazwa'])){
				if(!empty($_POST['logHaslo'])){
					$nazwa = prepareFormData($_POST['logNazwa']);
					$uzytkownik = new Uzytkownik($nazwa);
					$loginErrMsg = $uzytkownik->getFromDB();
					if($loginErrMsg == ''){
						$pass = prepareFormData($_POST['logHaslo']);
						if(password_verify($pass, $uzytkownik->getHaslo())){
							$_SESSION['id'] = $uzytkownik->getId();
							$_SESSION['login'] = $_POST['logNazwa'];
							$_SESSION['imie'] = $uzytkownik->getImie();
							$_SESSION['nazwisko'] = $uzytkownik->getNazwisko();
							$_SESSION['czyPracownik'] = $uzytkownik->getCzyPracownik();
						}else{
							$loginErrMsg = 'Błędne hasło';
						}
					}
				}else{
					$loginErrMsg = 'Nie podano hasła';
				}
			}else{
				$loginErrMsg = 'Nie podano nazwy użytkownika';
			}
		}else if($_POST['akcja'] == 'register' && $_POST['submit'] == 'Zarejestruj'){
			if(empty($_POST['regNazwa'])){
				$registerErrMsg .= 'Nie podano nazwy użytkownika';
			}else{
				$regNazwa=prepareFormData($_POST['regNazwa']);
				if(!preg_match("/^[a-zA-Z0-9]*$/",$regNazwa)) {
					$registerErrMsg .= 'Nazwa użytkownika może zawierać tylko litery i cyfry'; 
				}
			} 
			if(empty($_POST['regHaslo'])){
				$registerErrMsg .= '<br>Nie podano hasła';
			}else{
				$regHaslo=prepareFormData($_POST['regHaslo']);
			} 
			if(empty($_POST['regImie'])){
				$registerErrMsg .= '<br>Nie podano imienia';
			}else{
				$regImie=prepareFormData($_POST['regImie']);
			} 
			if(empty($_POST['regNazwisko'])){
				$registerErrMsg .= '<br>Nie podano nazwiska';
			}else{
				$regNazwisko=prepareFormData($_POST['regNazwisko']);
			} 
			if(empty($_POST['regUlica'])){
				$registerErrMsg .= '<br>Nie podano ulicy';
			}else{
				$regUlica=prepareFormData($_POST['regUlica']);
			} 
			if(empty($_POST['regMiasto'])){
				$registerErrMsg .= '<br>Nie podano miasta';
			}else{
				$regMiasto=prepareFormData($_POST['regMiasto']);
			} 
			if(empty($_POST['regKod'])){
				$registerErrMsg .= '<br>Nie podano kodu pocztowego';
			}else{
				$regKod=prepareFormData($_POST['regKod']);
				if(!preg_match("//d{2}-/d{3}/",$regKod)) {
					$registerErrMsg .= '<br>Należy podać poprawny kod pocztowy'; 
				}
			} 
			if(empty($_POST['regEmail'])){
				$registerErrMsg .= '<br>Nie podano email';
			}else{
				$regEmail=prepareFormData($_POST['regEmail']);
				if(!filter_var($regEmail, FILTER_VALIDATE_EMAIL)) {
				  $registerErrMsg .= '<br>Należy podać poprawny adres email'; 
				}
			} 
			if(empty($_POST['regNumer'])){
				$registerErrMsg .= '<br>Nie podano numeru telefonu';
			}else{
				$regNumer=prepareFormData($_POST['regNumer']);
				if(!preg_match("/^[0-9]{9,9}$/",$regNumer)) {
					$registerErrMsg .= '<br>Należy podać poprawny numer telefonu'; 
				}
			} 
			if($registerErrMsg == '') {
				$uzytkownik = new Uzytkownik($regNazwa, $regHaslo, $regImie, $regNazwisko, $regUlica, $regMiasto, $regKod, $regEmail, $regNumer);
				$registerErrMsg = $uzytkownik->insertUzytkownik();
			}
		}
?>