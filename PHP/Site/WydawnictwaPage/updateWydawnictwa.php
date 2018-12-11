<?php
		require_once(__DIR__.'/../Untitles/connection.php');
		if(!$_SESSION['czyPracownik']) die();
		$name = '';
		$newName = '';
		if($_SERVER["REQUEST_METHOD"] == "POST"){
			require_once(__DIR__.'\..\Untitles\Tables\Wydawnictwa\operations_on_Wydawnictwa.php');
			if($errMsg != ''){
			$name = $_POST['nazwa'];
			$newName = $_POST['nowaNazwa'];
			}
		}
	?>
<div id="form">
    <form action="" method="post">
        <input type="hidden" name="akcja" value="update">
        Podaj nazwę wydawcy: <input type="text" name="nazwa" value="<?php echo $name;?>" /><br>
        Podaj nową nazwę dla tego wydawcy: <input type="text" name="nowaNazwa" value="<?php echo $newName;?>" /><br>
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