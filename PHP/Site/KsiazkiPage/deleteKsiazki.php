<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Usuń książkę</title>
    <link rel="stylesheet" type="text/css" href="..\Untitles\untitles.css">
    <?php
		require_once(__DIR__.'\..\Untitles\connection.php');
		$tytul = '';
		if($_SERVER["REQUEST_METHOD"] == "POST"){
			require_once(__DIR__.'\..\Untitles\Tables\Ksiazki\operations_on_Ksiazki.php');
			if($errMsg != ''){
			$tytul = $_POST['nazwa'];
			}
		}
	?>
</head>

<body>
    <div id="form">
        <form action="" method="post">
            <input type="hidden" name="akcja" value="delete">
            Podaj gatunek do usunięcia: <input type="text" name="tytul" value="<?php echo $tytul;?>" />
            <input type="submit" />
        </form>
    </div>
    <?php
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		if($errMsg == ''){
			echo "<span class='succMsg'>Pomyślnie usunięto książkę</span>";
		}else if(!empty($errMsg)){
			echo "<span class='errMsg'>$errMsg</span>";
		}
	}
	?>
</body>

</html>