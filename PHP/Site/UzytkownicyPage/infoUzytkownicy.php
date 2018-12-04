<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Lista użytkowników</title>
    <?php 
    require_once(__DIR__.'\..\Untitles\connection.php'); 
    require_once(__DIR__.'\..\Untitles\Tables\Uzytkownicy\classUzytkownicy.php');
    if (session_status() == PHP_SESSION_NONE) session_start();
    ?>
</head>

<body>
    <?php
        if(empty($_SESSION['login'])){
            echo "Najpierw musisz się zalogować";
            die();
        }
    	$query = "SELECT Id, Nazwa_uzytkownika, Imie, Nazwisko, Ulica, Miasto, Kod_pocztowy, Email, Numer_telefonu, Czy_pracownik FROM uzytkownicy WHERE Nazwa_uzytkownika = '{$_SESSION['login']}'";
    	if(!($result = $connection->query($query))){
			$errMsg = 'Nie udało się wyświetlić informacji o użytkowniku';
            $result->close();
		}else if($result->num_rows == 0){
			$errMsg = 'W bazie danych nie ma takiego użytkownika';
            $result->close();
		}else{
			$row = $result->fetch_assoc();
            $result->close();
			$nazwa = $row['Nazwa_uzytkownika'];
            $imie = $row['Imie'];
            $nazwisko = $row['Nazwisko'];
            $ulica = $row['Ulica'];
            $miasto = $row['Miasto'];
            $kod = $row['Kod_pocztowy'];
            $email = $row['Email'];
            $numer = $row['Numer_telefonu'];
		}

        if($errMsg != ''){
            echo $errMsg;
            die();
        }

        echo <<<END
            <div class='uzytkownicyInfo'>
                <div id="nazwa">$nazwa</div>
                <div id="imie">$imie</div>
                <div id="nazwisko">$nazwisko</div>
                <div id="ulica">$ulica</div>
                <div id="miasto">$miasto</div>
                <div id="kod">$kod</div>
                <div id="email">$email</div>
                <div id="numer">$numer</div>
            </div>
END;
	?>
</body>

</html>