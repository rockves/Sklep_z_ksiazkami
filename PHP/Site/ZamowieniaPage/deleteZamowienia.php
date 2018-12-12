<?php
	require_once(__DIR__.'/../Untitles/connection.php');
	if (session_status() == PHP_SESSION_NONE) session_start();
	if(!$_SESSION['czyPracownik']) die();
		$id = '';
		if($_SERVER["REQUEST_METHOD"] == "POST"){
			require_once(__DIR__.'/../Untitles/Tables/Zamowienia/operations_on_Zamowienia.php');
			if($errMsg != ''){
			$id = $_POST['id'];
			}
		}
	?>
<div id="form">
    <form action="" method="post">
        <input type="hidden" name="akcja" value="delete">
        Podaj numer zamówienia do usunięcia: <input type="number" name="id" value="<?php echo $id;?>" />
        <input type="submit" />
    </form>
</div>
<?php
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		if($errMsg == ''){
			echo "<span class='succMsg'>Pomyślnie usunięto zamówienie</span>";
		}else if(!empty($errMsg)){
			echo "<span class='errMsg'>$errMsg</span>";
		}
	}
?>