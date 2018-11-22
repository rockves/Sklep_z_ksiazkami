<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Dodaj sposób płatności</title>
    <link rel="stylesheet" type="text/css" href="..\Untitles\untitles.css">
    <?php
		require_once(__DIR__.'\..\Untitles\connection.php');
		$name = '';
		$cena = '';
		if($_SERVER["REQUEST_METHOD"] == "POST"){
			require_once(__DIR__.'\..\Untitles\Tables\SposobyPlatnosci\operations_on_SposobyPlatnosci.php');
			if($errMsg != ''){
				$name = $_POST['nazwa'];
				$cena = $_POST['cena'];
			}
		}
	?>
</head>

<body>
    <div id="form">
        <form action="" method="post">
            <input type="hidden" name="akcja" value="insert">
            Podaj nazwę usługi: <input type="text" name="nazwa" value="<?php echo $name;?>" /><br>
            Podaj koszt usługi: <input type="text" name="cena" value="<?php echo $cena;?>" /><br>
            <input type="submit" />
        </form>
    </div>
    <?php
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		if($errMsg == ''){
			echo "<span class='succMsg'>Pomyślnie dodano usługę</span>";
		}else if(!empty($errMsg)){
			echo "<span class='errMsg'>$errMsg</span>";
		}
	}
	?>
</body>

</html>