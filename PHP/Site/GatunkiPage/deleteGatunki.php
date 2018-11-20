<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Usuń gatunek</title>
    <link rel="stylesheet" type="text/css" href="..\Untitles\untitles.css">
    <?php
		require_once(__DIR__.'\..\Untitles\connection.php');
		$name = '';
		if($_SERVER["REQUEST_METHOD"] == "POST"){
			require_once('operations_on_Gatunki.php');
			if($errMsg != ''){
			$name = $_POST['nazwa'];
			}
		}
	?>
</head>

<body>
    <div id="form">
        <form action="" method="post">
            <input type="hidden" name="akcja" value="delete">
            Podaj gatunek do usunięcia: <input type="text" name="nazwa" value="<?php echo $name;?>" />
            <input type="submit" />
        </form>
    </div>
    <?php
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		if($errMsg == ''){
			echo "<span class='succMsg'>Pomyślnie usunięto gatunek</span>";
		}else if(!empty($errMsg)){
			echo "<span class='errMsg'>$errMsg</span>";
		}
	}
	?>
</body>

</html>