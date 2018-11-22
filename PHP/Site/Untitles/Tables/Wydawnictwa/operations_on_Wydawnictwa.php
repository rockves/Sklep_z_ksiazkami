<?php
	require_once(__DIR__.'\..\..\connection.php');
	$errMsg = '';
	function insertWydawnictwo($nazwa){
		global $connection, $errMsg;
		$query = "SELECT Wydawca FROM wydawnictwa WHERE Wydawca = '$nazwa'";
		if(!($result = mysqli_query($connection,$query))){
			$errMsg = 'Nie udało się dodać wydawcy';
			return;
		}
		if(mysqli_num_rows($result) > 0){
			$errMsg = 'Taki wydawca już istnieje';
			return;
		}
		$query = "INSERT INTO wydawnictwa(Wydawca) VALUES ('$nazwa')";
		if(!mysqli_query($connection,$query)){
			$errMsg = 'Nie udało się dodać wydawcy';
		}
	}
	function deleteWydawnictwo($nazwa){
		global $connection, $errMsg;
		$query = "SELECT Id FROM wydawnictwa WHERE Wydawca = '$nazwa'";
		if(!($result = mysqli_query($connection,$query))){
			$errMsg = 'Nie udało się usunąć wydawcy';
			return;
		}
		if(mysqli_num_rows($result) == 0){
			$errMsg = 'Taki wydawca nie istnieje';
			return;
		}
		$row = mysqli_fetch_assoc($result);
		$query = 'DELETE FROM wydawnictwa WHERE Id = '.$row['Id'];
		if(!mysqli_query($connection,$query)){
			$errMsg = 'Nie udało się usunąć wydawcy';
		}
	}
	function updateWydawnictwo($nazwa, $nowaNazwa){
		global $connection, $errMsg;
		$query = "SELECT Wydawca FROM wydawnictwa WHERE Wydawca = '$nazwa'";
		if(!($result = mysqli_query($connection,$query))){
			$errMsg = 'Nie udało się zmienić nazwy wydawcy';
			return;
		}
		if(mysqli_num_rows($result) == 0){
			$errMsg = 'Taki wydawca nie istnieje';
			return;
		}
		$query = "UPDATE wydawnictwa SET Wydawca = '$nowaNazwa' WHERE Wydawca = '$nazwa'";
		if(!mysqli_query($connection,$query)){
			$errMsg = 'Nie udało się zmienić nazwy wydawcy';
		}
	}

	if (empty($_POST['akcja'])) {
		exit();
	}

	if ($_POST['akcja'] == 'insert') {
		if(!empty($_POST['nazwa'])){
			insertWydawnictwo($_POST['nazwa']);
		}else{
			$errMsg = "Nie podano wydawcy";
		}
	} else if($_POST['akcja'] == 'delete'){
		if(!empty($_POST['nazwa'])){
			deleteWydawnictwo($_POST['nazwa']);
		}else{
			$errMsg = "Nie podano wydawcy";
		}
	} else if($_POST['akcja'] == 'update'){
		if(empty($_POST['nazwa'])){
			$errMsg = "Nie podano wydawcy";
		}else if(empty($_POST['nowaNazwa'])){
			$errMsg = "Nie podano nowej nazwy wydawcy";
		}else{
			if(!empty($_POST['nowaNazwa'])){
			updateWydawnictwo($_POST['nazwa'],$_POST['nowaNazwa']);
			}
		}
	}
	
?>