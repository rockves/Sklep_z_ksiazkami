<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Dodaj wydawce</title>
    <link rel="stylesheet" type="text/css" href="..\Untitles\untitles.css">
    <?php
		require_once(__DIR__.'\..\Untitles\connection.php');
		$name = '';
		if($_SERVER["REQUEST_METHOD"] == "POST"){
			require_once('operations_on_Wydawnictwo.php');
			if($errMsg != ''){
				$name = $_POST['nazwa'];
			}
		}
	?>
</head>

<body>
    <div id="form">
        <form action="" method="post">
            <input type="hidden" name="akcja" value="insert">
            Podaj wydawce do dodania: <input type="text" name="nazwa" value="<?php echo $name;?>" />
            <input type="submit" />
        </form>
    </div>
    <?php
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		if($errMsg == ''){
			echo "<span class='succMsg'>Pomyślnie dodano wydawce</span>";
		}else if(!empty($errMsg)){
			echo "<span class='errMsg'>$errMsg</span>";
		}
	}
	?>
</body>

</html>