<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Dodaj użytkownika</title>
    <link rel="stylesheet" type="text/css" href="..\Untitles\untitles.css">
    <?php
		require_once(__DIR__.'\..\Untitles\connection.php');
		$nazwa = $imie = $nazwisko = $ulica = $miasto = $kod = $email = $numer = '';
		if($_SERVER["REQUEST_METHOD"] == "POST"){
			require_once(__DIR__.'\..\Untitles\Tables\Uzytkownicy\operations_on_Uzytkownicy.php');
			if($errMsg != ''){
				$nazwa = $_POST['nazwa'];
				$imie = $_POST['imie'];
				$nazwisko = $_POST['nazwisko'];
				$ulica = $_POST['ulica'];
				$miasto = $_POST['miasto'];
				$kod = $_POST['kod'];
				$email = $_POST['email'];
				$numer = $_POST['numer'];
			}
		}
	?>
</head>

<body>
    <div id="form">
        <form action="" method="post">
            <input type="hidden" name="akcja" value="insert">
            Nazwa użytkownika: <input type="text" name="nazwa" value="<?php echo $nazwa;?>" /><br>
            Hasło: <input type="password" name="haslo" /><br>
            Imie: <input type="text" name="imie" value="<?php echo $imie;?>" /><br>
            Nazwisko: <input type="text" name="nazwisko" value="<?php echo $nazwisko;?>" /><br>
            Ulica: <input type="text" name="ulica" value="<?php echo $ulica;?>" /><br>
            Miasto: <input type="text" name="miasto" value="<?php echo $miasto;?>" /><br>
            Kod pocztowy: <input type="text" name="kod" value="<?php echo $kod;?>" /><br>
            Email: <input type="text" name="email" value="<?php echo $email;?>" /><br>
            Numer telefonu: <input type="text" name="numer" value="<?php echo $numer;?>" /><br>
            Pracownik: <input type="checkbox" name="czyPracownik" value="1"><br>
            <input type="submit" />
        </form>
    </div>
    <?php
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		if($errMsg == ''){
			echo "<span class='succMsg'>Pomyślnie dodano użytkownika</span>";
		}else if(!empty($errMsg)){
			echo "<span class='errMsg'>$errMsg</span>";
		}
	}
	?>
</body>

</html>