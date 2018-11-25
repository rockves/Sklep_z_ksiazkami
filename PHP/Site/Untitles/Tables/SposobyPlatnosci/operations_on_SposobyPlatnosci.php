<?php
	require_once(__DIR__.'\..\..\connection.php');
	require_once('classSposobyPlatnosci.php');
	$errMsg = '';

	
	if (empty($_POST['akcja'])) {
		exit();
	}

	if ($_POST['akcja'] == 'insert') {
		if(!empty($_POST['nazwa'])){
				if(!empty($_POST['cena'])){
                    $sposobPlatnosci = new SposobPlatnosci($_POST['nazwa'], $_POST['cena']);
					$errMsg = $sposobPlatnosci->insertSposobPlatnosci();
				}else{
					$errMsg = "Nie podano ceny usługi";
				}
		}else{
			$errMsg = "Nie podano nazwy usługi";
		}
	} else if($_POST['akcja'] == 'delete'){
		if(!empty($_POST['nazwa'])){
            $sposobPlatnosci = new SposobPlatnosci($_POST['nazwa'], $_POST['cena']);
            $errMsg = $sposobPlatnosci->deleteSposobPlatnosci();
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
                $sposobPlatnosci = new SposobPlatnosci($_POST['nazwa']);
                $errMsg = $sposobPlatnosci->updateSposobPlatnosci($_POST['nowaNazwa'], $_POST['nowaCena']);
			}
		}else{
			$errMsg = "Nie podano nazwy usługi";
		}
	}
?>