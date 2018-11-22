<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Lista sposobów płatności</title>
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
    	$query = 'SELECT Id, Nazwa_uslugi, Cena_uslugi FROM sposoby_platnosci';
    	if(!($result = mysqli_query($connection,$query))){
			echo 'Nie udało się wyświetlić sposobów płatności';
		}else if(mysqli_num_rows($result) == 0){
			echo 'W bazie danych nie ma żadnych sposobów płatności';
		}else{
			echo '<table>';
			echo '<tr><td>ID</td><td>NAZWA</td><td>CENA</td></tr>';
			while($row = mysqli_fetch_assoc($result)) {
				echo '<tr><td>'.$row['Id'].'</td><td>'.$row['Nazwa_uslugi'].'</td><td>'.$row['Cena_uslugi'].'</td></tr>';
			}
			echo '</table>';
		}
	?>
</body>

</html>