<?php
	require_once(__DIR__.'\..\..\connection.php');
	$errMsg = '';

	function insertSposobPlatnosci($nazwa,$cena){
		global $connection, $errMsg;
		$query = "SELECT Nazwa_uslugi FROM sposoby_platnosci WHERE Nazwa_uslugi = '$nazwa' LIMIT 1";
		if(!($result = mysqli_query($connection,$query))){
			$errMsg = 'Nie udało się dodać sposobu płatności';
			return;
		}
		if(mysqli_num_rows($result) > 0){
			$errMsg = 'Taki sposób płatności już istnieje';
			return;
		}
		$query = "INSERT INTO sposoby_platnosci(Nazwa_uslugi, Cena_uslugi) VALUES ('$nazwa', '$cena')";
		if(!mysqli_query($connection,$query)){
			$errMsg = 'Nie udało się dodać sposobu wysyłki';
		}
	}

	function deleteSposobPlatnosci($nazwa){
		global $connection, $errMsg;
		$query = "SELECT Id FROM sposoby_platnosci WHERE Nazwa_uslugi = '$nazwa' LIMIT 1";
		if(!($result = mysqli_query($connection,$query))){
			$errMsg = 'Nie udało się usunąć sposobu płatności';
			return;
		}
		if(mysqli_num_rows($result) == 0){
			$errMsg = 'Taki sposób płatności nie istnieje';
			return;
		}
		$row = mysqli_fetch_assoc($result);
		$query = 'DELETE FROM sposoby_platnosci WHERE Id = '.$row['Id'];
		if(!mysqli_query($connection,$query)){
			$errMsg = 'Nie udało się usunąć sposobu płatności';
		}
	}

	function updateSposobPlatnosci($nazwa, $nowaNazwa, $nowaCena){
		global $connection, $errMsg;
		$query = "SELECT Nazwa_uslugi FROM sposoby_platnosci WHERE Nazwa_uslugi = '$nazwa' LIMIT 1";
		if(!($result = mysqli_query($connection,$query))){
			$errMsg = 'Zmiany w sposobie płatności nie powiodły się ';
			return;
		}
		if(mysqli_num_rows($result) == 0){
			$errMsg = 'Taki sposób płatności nie istnieje';
			return;
		}
		$query = "UPDATE sposoby_platnosci SET";
		if($nowaNazwa != ''){
			$query .= " Nazwa_uslugi = '$nowaNazwa'";
		}
		if($nowaCena != ''){
			$query .= ", Cena_uslugi = '$nowaCena'";
		}
		$query .= " WHERE Nazwa_uslugi = '$nazwa'";
		if(!mysqli_query($connection,$query)){
			$errMsg = 'Zmiany w sposobie płatności nie powiodły się';
			return;
		}
	}

	
	if (empty($_POST['akcja'])) {
		exit();
	}

	if ($_POST['akcja'] == 'insert') {
		if(!empty($_POST['nazwa'])){
				if(!empty($_POST['cena'])){
					insertSposobPlatnosci($_POST['nazwa'],$_POST['cena']);
				}else{
					$errMsg = "Nie podano ceny usługi";
				}
		}else{
			$errMsg = "Nie podano nazwy usługi";
		}
	} else if($_POST['akcja'] == 'delete'){
		if(!empty($_POST['nazwa'])){
			deleteSposobPlatnosci($_POST['nazwa']);
		}else{
			$errMsg = "Nie podano nazwy usługi";
		}
	} else if($_POST['akcja'] == 'update'){
		if(!empty($_POST['nazwa'])){
			if(empty($_POST['nowaNazwa']) && empty($_POST['nowaCena'])){
				$errMsg = "Nie podano danych do edycji";
			}else{
				$nowaNazwa = '';
				$nowaCena = '';
				if(!empty($_POST['nowaNazwa'])){
					$nowaNazwa = $_POST['nowaNazwa'];
				} 
				if(!empty($_POST['nowaCena'])){
					$nowaCena = $_POST['nowaCena'];
				} 
				updateSposobPlatnosci($_POST['nazwa'], $nowaNazwa, $nowaCena);
			}
		}else{
			$errMsg = "Nie podano nazwy usługi";
		}
	}
?>