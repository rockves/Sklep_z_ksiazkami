<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Lista użytkowników</title>
    <?php require_once(__DIR__.'\..\Untitles\connection.php'); ?>
    <style>
    table,
    tr,
    td {
        border: 1px solid black;
        border-collapse: collapse;
        padding: 5px;
        text-align: center;
    }
    </style>
</head>

<body>
    <?php
    	$query = 'SELECT Id, Nazwa_uzytkownika, Imie, Nazwisko, Ulica, Miasto, Kod_pocztowy, Email, Numer_telefonu, Czy_pracownik FROM uzytkownicy';
    	if(!($result = $connection->query($query))){
			echo 'Nie udało się wyświetlić sposobów płatności';
		}else if($result->num_rows == 0){
			echo 'W bazie danych nie ma żadnych sposobów płatności';
		}else{
			echo '<table>';
			echo '<tr><td>ID</td><td>NAZWA</td><td>IMIE</td><td>NAZWISKO</td><td>ULICA</td><td>MIASTO</td><td>KOD POCZTOWY</td><td>EMAIL</td><td>NUMER TELEFONU</td><td>PRACOWNIK</td></tr>';
			while($row = $result->fetch_assoc()) {
				echo '<tr><td>'.$row['Id'].'</td><td>'.$row['Nazwa_uzytkownika'].'</td><td>'.$row['Imie'].'</td><td>'.$row['Nazwisko'].'</td><td>'.$row['Ulica'].'</td><td>'.$row['Miasto'].'</td><td>'.$row['Kod_pocztowy'].'</td><td>'.$row['Email'].'</td><td>'.$row['Numer_telefonu'].'</td><td>'.($row['Czy_pracownik'] == '0' ? 'NIE' : 'TAK').'</td></tr>';
			}
			echo '</table>';
		}
	?>
</body>

</html>