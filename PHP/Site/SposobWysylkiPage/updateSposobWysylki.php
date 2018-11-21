<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Edytuj sposób wysyłki</title>
    <link rel="stylesheet" type="text/css" href="..\Untitles\untitles.css">
    <?php
		require_once(__DIR__.'\..\Untitles\connection.php');
		$name = '';
		$newName = '';
		$newSpeed = '';
		$newPrice = '';
		if($_SERVER["REQUEST_METHOD"] == "POST"){
			require_once('operations_on_SposobWysylki.php');
			if($errMsg != ''){
			$name = $_POST['nazwa'];
			$newName = $_POST['nowaNazwa'];
			$newSpeed = $_POST['nowaSzybkosc'];
			$newPrice = $_POST['nowaCena'];
			}
		}
	?>
</head>

<body>
    <div id="form">
        <form action="" method="post">
            <input type="hidden" name="akcja" value="update">
            Podaj nazwę gatunku: <input type="text" name="nazwa" value="<?php echo $name;?>" /><br>
            Podaj nową nazwę dla tego gatunku: <input type="text" name="nowaNazwa" value="<?php echo $newName;?>" /><br>
            Podaj nową szybkość usługi dla tego gatunku: <input type="text" name="nowaSzybkosc" value="<?php echo $newSpeed;?>" /><br>
            Podaj nową cenę dla tego gatunku: <input type="text" name="nowaCena" value="<?php echo $newPrice;?>" /><br>
            <input type="submit" />
        </form>
    </div>
    <?php
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		if($errMsg == ''){
			echo "<span class='succMsg'>Pomyślnie edytowano dane usługi</span>";
		}else if(!empty($errMsg)){
			echo "<span class='errMsg'>$errMsg</span>";
		}
	}
	?>
</body>

</html>