<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Lista wydawców</title>
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
    	$query = 'SELECT Id, Wydawca FROM wydawnictwa';
    	if(!($result = $connection->query($query))){
			echo 'Nie udało się wyświetlić wydawców';
		}else if($result->num_rows == 0){
			echo 'W bazie danych nie ma żadnych wydawców';
		}else{
			echo '<table>';
			echo '<tr><td>ID</td><td>NAZWA</td></tr>';
			while($row = $result->fetch_assoc()) {
				echo '<tr><td>'.$row['Id'].'</td><td>'.$row['Wydawca'].'</td></tr>';
			}
			echo '</table>';
		}
	?>
</body>

</html>