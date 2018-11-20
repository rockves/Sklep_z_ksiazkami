<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Edytuj gatunek</title>
    <link rel="stylesheet" type="text/css" href="..\Untitles\untitles.css">
    <?php
		require_once(__DIR__.'\..\Untitles\connection.php');
		$name = '';
		$newName = '';
		if($_SERVER["REQUEST_METHOD"] == "POST"){
			require_once('operations_on_Gatunki.php');
			if($errMsg != ''){
			$name = $_POST['nazwa'];
			$newName = $_POST['nowaNazwa'];
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
            <input type="submit" />
        </form>
    </div>
    <?php
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		if($errMsg == ''){
			echo "<span class='succMsg'>Pomyślnie zmieniono nazwę</span>";
		}else if(!empty($errMsg)){
			echo "<span class='errMsg'>$errMsg</span>";
		}
	}
	?>
</body>

</html>