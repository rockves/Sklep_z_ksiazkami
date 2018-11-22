<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Lista gatunków</title>
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
    	$query = 'SELECT Id, Gatunek FROM gatunki';
    	if(!($result = $connection->query($query))){
			echo 'Nie udało się wyświetlić gatunków';
		}else if($result->num_rows == 0){
			echo 'W bazie danych nie ma żadnych gatunków';
		}else{
			echo '<table>';
			echo '<tr><td>ID</td><td>NAZWA</td></tr>';
			while($row = $result->fetch_assoc()) {
				echo '<tr><td>'.$row['Id'].'</td><td>'.$row['Gatunek'].'</td></tr>';
			}
			echo '</table>';
		}
	?>
</body>

</html>