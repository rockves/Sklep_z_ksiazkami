<?php
	require_once(__DIR__.'/../../connection.php');
	require_once('classWydawnictwa.php');
	$errMsg = '';

	if (empty($_POST['akcja'])) {
		exit();
	}

	if ($_POST['akcja'] == 'insert') {
		if(!empty($_POST['nazwa'])){
			$wydawnictwo = new Wydawnictwo($_POST['nazwa']);
			$errMsg = $wydawnictwo->insertWydawnictwo();
		}else{
			$errMsg = "Nie podano wydawcy";
		}
	} else if($_POST['akcja'] == 'delete'){
		if(!empty($_POST['nazwa'])){
			$wydawnictwo = new Wydawnictwo($_POST['nazwa']);
			$errMsg = $wydawnictwo->deleteWydawnictwo();
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
				$wydawnictwo = new Wydawnictwo($_POST['nazwa']);
				$errMsg = $wydawnictwo->updateWydawnictwo($_POST['nowaNazwa']);
			}
		}
	}
	
?>