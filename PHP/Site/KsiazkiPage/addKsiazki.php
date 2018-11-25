<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Dodaj książkę</title>
    <link rel="stylesheet" type="text/css" href="..\Untitles\untitles.css">
    <?php
		require_once(__DIR__.'\..\Untitles\connection.php');
		$nazwa = $autor = $opis = $gatunek = $data = $wydawnictwo = $ocena = $cena = '';
		if($_SERVER["REQUEST_METHOD"] == "POST"){
			require_once(__DIR__.'\..\Untitles\Tables\SposobyPlatnosci\operations_on_SposobyPlatnosci.php');
			if($errMsg != ''){
				$nazwa = $_POST['nazwa'];
				$cena = $_POST['cena'];
			}
		}
	?>
</head>

<body>
    <div id="form">
        <form action="" method="post">
            <input type="hidden" name="akcja" value="insert">
            Tytuł: <input type="text" name="nazwa" value="<?php echo $nazwa;?>" /><br>
            Autor: <input type="text" name="autor" value="<?php echo $autor;?>" /><br>
            Opis: <textarea name="opis" rows="10" cols="50"><?php echo $opis?></textarea><br>
            Gatunek: <input type="text" name="gatunek" value="<?php echo $gatunek;?>" /><br>
            Data wydania: <input type="text" name="data" value="<?php echo $data;?>" /><br>
            Wydawnictwo: <input type="text" name="wydawnictwo" value="<?php echo $wydawnictwo;?>" /><br>
            Ocena książki: <input type="text" name="ocena" value="<?php echo $ocena;?>" /><br>
            Cena: <input type="text" name="cena" value="<?php echo $cena;?>" /><br>
            <input type="submit" />
        </form>
    </div>
    <?php
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		if($errMsg == ''){
			echo "<span class='succMsg'>Pomyślnie dodano książkę</span>";
		}else if(!empty($errMsg)){
			echo "<span class='errMsg'>$errMsg</span>";
		}
	}
	?>
</body>

</html>