<?php
	require_once(__DIR__.'\..\..\connection.php');
	require_once('classUzytkownicy.php');
	$errMsg = '';

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
			$uzytkownik = $uzytkownik = new Uzytkownik($_POST['nazwa']);
			$errMsg = $uzytkownik->deleteUzytkownik();
		}else{
			$errMsg = "Nie podano nazwy użytkownika";
		}
	} else if($_POST['akcja'] == 'update'){
		if(!empty($_POST['nazwa'])){
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
			}
		}else{
			$errMsg = "Nie podano nazwy usługi";
		}
	}
?>