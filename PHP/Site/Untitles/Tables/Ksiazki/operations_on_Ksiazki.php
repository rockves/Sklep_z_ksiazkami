<?php 
	require_once(__DIR__.'\..\..\connection.php');
	require_once('classKsiazki.php');
	$errMsg = '';

	if (empty($_POST['akcja'])) {
		exit();
	}

	if ($_POST['akcja'] == 'insert') {
		if(empty($_POST['tytul'])) $errMsg .= 'Nie podano tytułu książki';
		if(empty($_POST['autor'])) $errMsg .= '<br>Nie podano autora książki';
		if(empty($_POST['opis'])) $errMsg .= '<br>Nie podano opisu';
		if(empty($_POST['gatunek'])) $errMsg .= '<br>Nie podano gatunku';
		if(empty($_POST['data'])) $errMsg .= '<br>Nie podano daty wydania';
		if(empty($_POST['wydawnictwo'])) $errMsg .= '<br>Nie podano wydawnictwa';
		if(empty($_POST['ocena'])) $errMsg .= '<br>Nie podano oceny';
		if(empty($_POST['cena'])) $errMsg .= '<br>Nie podano ceny';
		if(!empty($_FILES['okladka']['name'])){
			$allowed =  array('jpg');
			$ext = pathinfo($_FILES['okladka']['name'], PATHINFO_EXTENSION);
			if(!in_array($ext,$allowed) ) {
			    $errMsg .= '<br>Rozszerzenie pliku nie jest dozwolone';
			}
		}
		if($errMsg == '') {
			$ksiazka = new Ksiazka($_POST['tytul'], $_POST['autor'], $_POST['opis'], $_POST['gatunek'], $_POST['data'], $_POST['wydawnictwo'], $_POST['ocena'], $_POST['cena']);
			$errMsg = $ksiazka->insertKsiazka();
			$ksiazka->getFromDB();
			$ksiazka->uploadOkladka($_FILES['okladka']["tmp_name"]);
		}
	} else if($_POST['akcja'] == 'delete'){
		if(!empty($_POST['tytul'])){
			$ksiazka = new Ksiazka($_POST['tytul']);
			$errMsg = $ksiazka->deleteKsiazka();
		}else{
			$errMsg = "Nie podano tytułu książki";
		}
	} else if($_POST['akcja'] == 'update'){
		if(!empty($_POST['tytul'])){
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
				updateSposobWysylki($_POST['tytul'], $nowaNazwa, $nowaSzybkosc, $nowaCena);
			}
		}else{
			$errMsg = "Nie podano nazwy usługi";
		}
	}
?>