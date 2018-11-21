<?php
	require_once(__DIR__.'\..\Untitles\connection.php');
	$errMsg = '';

	function insertSposobWysylki($nazwa,$szybkosc,$cena){
		global $connection, $errMsg;
		$query = "SELECT Nazwa_uslugi FROM sposob_wysylki WHERE Nazwa_uslugi = '$nazwa' LIMIT 1";
		if(!($result = mysqli_query($connection,$query))){
			$errMsg = 'Nie udało się dodać sposobu wysyłki';
			return;
		}
		if(mysqli_num_rows($result) > 0){
			$errMsg = 'Taki sposób wysyłki już istnieje';
			return;
		}
		$query = "INSERT INTO sposob_wysylki(Nazwa_uslugi, Szybkosc_dostawy, Cena_uslugi) VALUES ('$nazwa','$szybkosc','$cena')";
		if(!mysqli_query($connection,$query)){
			$errMsg = 'Nie udało się dodać sposobu wysyłki';
		}
	}

	function deleteSposobWysylki($nazwa){
		global $connection, $errMsg;
		$query = "SELECT Id FROM sposob_wysylki WHERE Nazwa_uslugi = '$nazwa' LIMIT 1";
		if(!($result = mysqli_query($connection,$query))){
			$errMsg = 'Nie udało się usunąć sposobu wysyłki';
			return;
		}
		if(mysqli_num_rows($result) == 0){
			$errMsg = 'Taki sposób wysyłki nie istnieje';
			return;
		}
		$row = mysqli_fetch_assoc($result);
		$query = 'DELETE FROM sposob_wysylki WHERE Id = '.$row['Id'];
		if(!mysqli_query($connection,$query)){
			$errMsg = 'Nie udało się usunąć sposobu wysyłki';
		}
	}

	function updateSposobWysylki($nazwa, $nowaNazwa, $nowaSzybkosc, $nowaCena){
		global $connection, $errMsg;
		$query = "SELECT Nazwa_uslugi FROM sposob_wysylki WHERE Nazwa_uslugi = '$nazwa' LIMIT 1";
		if(!($result = mysqli_query($connection,$query))){
			$errMsg = 'Zmiany w sposobie wysyłki się nie powiodły';
			return;
		}
		if(mysqli_num_rows($result) == 0){
			$errMsg = 'Taki sposób wysyłki nie istnieje';
			return;
		}
		$query = "UPDATE sposob_wysylki SET";
		if($nowaNazwa != ''){
			$query .= " Nazwa_uslugi = '$nowaNazwa'";
		}
		if($nowaSzybkosc != ''){
			$query .= ", Szybkosc_dostawy = '$nowaSzybkosc'";
		}
		if($nowaCena != ''){
			$query .= ", Cena_uslugi = '$nowaCena'";
		}
		$query .= " WHERE Nazwa_uslugi = '$nazwa'";
		if(!mysqli_query($connection,$query)){
			$errMsg = 'Zmiany w sposobie wysyłki się nie powiodły';
			return;
		}
	}

	if (empty($_POST['akcja'])) {
		exit();
	}

	if ($_POST['akcja'] == 'insert') {
		if(!empty($_POST['nazwa'])){
			if(!empty($_POST['szybkosc'])){
				if(!empty($_POST['cena'])){
					insertSposobWysylki($_POST['nazwa'],$_POST['szybkosc'],$_POST['cena']);
				}else{
					$errMsg = "Nie podano ceny usługi";
				}
			}else{
				$errMsg = "Nie podano szybkości usługi";
			}
		}else{
			$errMsg = "Nie podano nazwy usługi";
		}
	} else if($_POST['akcja'] == 'delete'){
		if(!empty($_POST['nazwa'])){
			deleteSposobWysylki($_POST['nazwa']);
		}else{
			$errMsg = "Nie podano nazwy usługi";
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