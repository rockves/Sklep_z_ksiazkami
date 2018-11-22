<?php 
	
	class Wydawnictwo
	{
		private $id;
		private $nazwa;

		function __construct(string $wydawnictwo_nazwa = '')
		{
			$this->setNazwa($wydawnictwo_nazwa);
		}
	
	    public function getNazwa()
	    {
	        return $this->nazwa;
	    }

	    public function setNazwa($nazwa)
	    {
	        $this->nazwa = $nazwa;

	        return $this;
	    }

	    public function getId()
	    {
	        return $this->id;
	    }

	    function insertWydawnictwo(){
			global $connection;
			if(!$connection) require_once(__DIR__.'\..\..\connection.php');
			$errMsg = '';

			$query = "SELECT Wydawca FROM wydawnictwa WHERE Wydawca = '$this->nazwa'";
			if(!($result = $connection->query($query))){
				$errMsg = 'Nie udało się dodać wydawcy';
				$result->close();
				return $errMsg;
			}
			if($result->num_rows > 0){
				$errMsg = 'Taki wydawca już istnieje';
				$result->close();
				return $errMsg;
			}
			$result->close();
			$query = "INSERT INTO wydawnictwa(Wydawca) VALUES ('$this->nazwa')";
			if(!$connection->query($query)){
				$errMsg = 'Nie udało się dodać wydawcy';
				$result->close();
				return $errMsg;
			}
		}
		function deleteWydawnictwo(){
			global $connection;
			if(!$connection) require_once(__DIR__.'\..\..\connection.php');
			$errMsg = '';

			$query = "SELECT Id FROM wydawnictwa WHERE Wydawca = '$this->nazwa'";
			if(!($result = $connection->query($query))){
				$errMsg = 'Nie udało się usunąć wydawcy';
				$result->close();
				return $errMsg;
			}
			if($result->num_rows == 0){
				$errMsg = 'Taki wydawca nie istnieje';
				$result->close();
				return $errMsg;
			}
			$row = $result->fetch_assoc();
			$result->close();
			$this->id = $row['Id'];
			$query = 'DELETE FROM wydawnictwa WHERE Id = '.$this->id;
			if(!$connection->query($query)){
				$errMsg = 'Nie udało się usunąć wydawcy';
				$result->close();
				return $errMsg;
			}
		}
		function updateWydawnictwo($nowaNazwa){
			global $connection;
			if(!$connection) require_once(__DIR__.'\..\..\connection.php');
			$errMsg = '';

			$query = "SELECT Wydawca FROM wydawnictwa WHERE Wydawca = '$this->nazwa'";
			if(!($result = $connection->query($query))){
				$errMsg = 'Nie udało się zmienić nazwy wydawcy';
				$result->close();
				return $errMsg;
			}
			if($result->num_rows == 0){
				$errMsg = 'Taki wydawca nie istnieje';
				$result->close();
				return $errMsg;
			}
			$result->close();
			$query = "UPDATE wydawnictwa SET Wydawca = '$nowaNazwa' WHERE Wydawca = '$this->nazwa'";
			if(!$connection->query($query)){
				$errMsg = 'Nie udało się zmienić nazwy wydawcy';
				return $errMsg;
			}
		}
}
?>