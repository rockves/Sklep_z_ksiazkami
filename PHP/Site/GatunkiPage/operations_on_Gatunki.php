<?php
	require_once(__DIR__.'\..\Untitles\connection.php');
	$errMsg = '';
	function insertGatunek($nazwa){
		global $connection, $errMsg;
		$query = "SELECT Gatunek FROM gatunki WHERE Gatunek = '$nazwa'";
		if(!($result = mysqli_query($connection,$query))){
			$errMsg = 'Nie udało się dodać gatunku1';
			return;
		}
		if(mysqli_num_rows($result) > 0){
			$errMsg = 'Taki gatunek już istnieje';
			return;
		}
		$query = "INSERT INTO gatunki(Gatunek) VALUES ('$nazwa')";
		if(!mysqli_query($connection,$query)){
			$errMsg = 'Nie udało się dodać gatunku2';
		}
	}
	function deleteGatunek($nazwa){
				global $connection, $errMsg;
		$query = "SELECT Id FROM gatunki WHERE Gatunek = '$nazwa'";
		if(!($result = mysqli_query($connection,$query))){
			$errMsg = 'Nie udało się usunąć gatunku';
			return;
		}
		if(mysqli_num_rows($result) == 0){
			$errMsg = 'Taki gatunek nie istnieje';
			return;
		}
		$row = mysqli_fetch_assoc($result);
		$query = 'DELETE FROM gatunki WHERE Id = '.$row['Id'];
		if(!mysqli_query($connection,$query)){
			$errMsg = 'Nie udało się usunąć gatunku';
		}
	}
	function updateGatunek($nazwa, $nowaNazwa){
				global $connection, $errMsg;
		$query = "SELECT Gatunek FROM gatunki WHERE Gatunek = '$nazwa'";
		if(!($result = mysqli_query($connection,$query))){
			$errMsg = 'Nie udało się zmienić nazwy gatunku';
			return;
		}
		if(mysqli_num_rows($result) == 0){
			$errMsg = 'Taki gatunek nie istnieje';
			return;
		}
		$query = "UPDATE gatunki SET Gatunek = '$nowaNazwa' WHERE Gatunek = '$nazwa'";
		if(!mysqli_query($connection,$query)){
			$errMsg = 'Nie udało się zmienić nazwy gatunku';
		}
	}

	if (empty($_POST['akcja'])) {
		exit();
	}

	if ($_POST['akcja'] == 'insert') {
		if(!empty($_POST['nazwa'])){
			insertGatunek($_POST['nazwa']);
		}else{
			$errMsg = "Nie podano gatunku";
		}
	} else if($_POST['akcja'] == 'delete'){
		if(!empty($_POST['nazwa'])){
			deleteGatunek($_POST['nazwa']);
		}else{
			$errMsg = "Nie podano gatunku";
		}
	} else if($_POST['akcja'] == 'update'){
		if(empty($_POST['nazwa'])){
			$errMsg = "Nie podano gatunku";
		}else if(empty($_POST['nowaNazwa'])){
			$errMsg = "Nie podano nowej nazwy gatunku";
		}else{
			if(!empty($_POST['nowaNazwa'])){
			updateGatunek($_POST['nazwa'],$_POST['nowaNazwa']);
			}
		}
	}
	
?>