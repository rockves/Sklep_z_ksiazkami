<?php 

	require_once(__DIR__.'/../Untitles/connection.php'); 
	if (session_status() == PHP_SESSION_NONE) session_start();

	if(empty($_SESSION['login'])){
		echo 'Najpierw musisz się zalogować';
		die();
	}

    $produktId = prepareFormData($_GET['product']);
    if(!ctype_digit($produktId)) die();

    $query = $connection->prepare("SELECT Id FROM koszyk WHERE Id_produktu = ? AND Id_uzytkownika = ?");
    $query->bind_param("ss", $produktId, $_SESSION['id']);
    $query->execute();
    $result = $query->get_result();
    $query->close();
    if($result->num_rows == 0){
    	$result->close();
    	$query = $connection->prepare("INSERT INTO koszyk(Id_uzytkownika, Id_produktu) VALUES (?,?)");
    	$query->bind_param("ss", $_SESSION['id'], $produktId);
    	$query->execute();
    	$query->close();
    }else{
        $result->close();
        $query = $connection->prepare("UPDATE koszyk SET Ilosc = Ilosc + 1 WHERE Id_produktu = ? AND Id_uzytkownika = ?");
        $query->bind_param("ss", $produktId, $_SESSION['id']);
        $query->execute();
        $query->close();
    }
?>