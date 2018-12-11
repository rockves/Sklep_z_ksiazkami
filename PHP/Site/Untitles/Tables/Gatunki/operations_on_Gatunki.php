<?php
	require_once(__DIR__.'/../../connection.php');
	require_once('classGatunki.php');
	$errMsg = '';

	if (empty($_POST['akcja'])) {
		exit();
	}

	if ($_POST['akcja'] == 'insert') {
		if(!empty($_POST['nazwa'])){
			$gatunek = new Gatunek($_POST['nazwa']);
			$errMsg = $gatunek->insertGatunek();
		}else{
			$errMsg = "Nie podano gatunku";
		}
	} else if($_POST['akcja'] == 'delete'){
		if(!empty($_POST['nazwa'])){
			$gatunek = new Gatunek($_POST['nazwa']);
			$errMsg = $gatunek->deleteGatunek();
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
				$gatunek = new Gatunek($_POST['nazwa']);
				$errMsg = $gatunek->updateGatunek($_POST['nowaNazwa']);
			}
		}
	}
	
?>