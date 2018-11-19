<?php
	require_once('connection.php');
	errMsg = '';
	function insertGatunek($nazwa){
		$query = "SELECT Gatunek FROM Gatunki WHERE Gatunek = '$nazwa'";
		if(!($result = mysqli_query($connection,$query)){
			errMsg = 'Nie udało się dodać gatunku';
			return;
		}
		if(mysqli_num_rows($result) > 0){
			errMsg = 'Taki gatunek już istnieje';
			return;
		}
		$query = "INSERT INTO Gatunki('Gatunek') VALUES ('$nazwa')";
		if(!mysqli_query($connection,$query)){
			errMsg = 'Nie udało się dodać gatunku';
		}
	}
	function deleteGatunek($nazwa){
		$query = "SELECT Id FROM Gatunki WHERE Gatunek = '$nazwa'";
		if(!($result = mysqli_query($connection,$query)){
			errMsg = 'Nie udało się usunąć gatunku';
			return;
		}
		if(mysqli_num_rows($result) == 0){
			errMsg = 'Taki gatunek nie istnieje';
			return;
		}
		$row = mysqli_fetch_assoc($result)
		$query = 'DELETE FROM Gatunki WHERE Id = '.$row['Id'];
		if(!mysqli_query($connection,$query)){
			errMsg = 'Nie udało się usunąć gatunku';
		}
	}
	function updateGatunek($nazwa, $nowaNazwa){
		$query = "SELECT Gatunek FROM Gatunki WHERE Gatunek = '$nazwa'";
		if(!($result = mysqli_query($connection,$query)){
			errMsg = 'Nie udało się zmienić nazwy gatunku';
			return;
		}
		if(mysqli_num_rows($result) == 0){
			errMsg = 'Taki gatunek nie istnieje';
			return;
		}
		$query = "UPDATE Gatunki SET Gatunek = '$nowaNazwa' WHERE Gatunek = '$nazwa'";
		if(!mysqli_query($connection,$query)){
			errMsg = 'Nie udało się zmienić nazwy gatunku';
		}
	}

	if (empty($_POST['akcja'])) {
		exit();
	}

	if ($_POST['akcja'] == 'insert') {
		if(!empty($_POST['nazwa'])){
			insertGatunek($_POST['nazwa']);
		}else{
			errMsg = "Nie podano gatunku";
		}
	} else if($_POST['akcja'] == 'delete'){
		if(!empty($_POST['nazwa'])){
			deleteGatunek($_POST['nazwa']);
		}else{
			errMsg = "Nie podano gatunku";
		}
	} else if($_POST['akcja'] == 'modify'){
		if(!empty($_POST['nazwa'])){
			updateGatunek($_POST['nazwa']);
		}else{
			errMsg = "Nie podano gatunku";
		}
	}
	
?>