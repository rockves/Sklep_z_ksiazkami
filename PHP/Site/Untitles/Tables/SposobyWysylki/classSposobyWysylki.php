<?php

	class SposobWysylki
	{
		private $id;
		private $nazwa;
		private $szybkosc;
		private $cena;

		function __construct(string $sposobWysylki_nazwa = '', string $sposobWysylki_szybkosc = '', string $sposobWysylki_cena = '')
		{
			$this->setNazwa($sposobWysylki_nazwa);
            $this->setSzybkosc($sposobWysylki_szybkosc);
            $this->setCena($sposobWysylki_cena);
		}

	    public function getId()
	    {
	        return $this->id;
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

	    public function getSzybkosc()
	    {
	        return $this->szybkosc;
	    }

	    public function setSzybkosc($szybkosc)
	    {
	        $this->szybkosc = $szybkosc;

	        return $this;
	    }

	    public function getCena()
	    {
	        return $this->cena;
	    }

	    public function setCena($cena)
	    {
	        $this->cena = $cena;

	        return $this;
	    }

		function insertSposobWysylki(){
			global $connection;
			if(!$connection) require_once(__DIR__.'\..\..\connection.php');
			$errMsg = '';
            
			$query = "SELECT Nazwa_uslugi FROM sposoby_wysylki WHERE Nazwa_uslugi = '$this->nazwa' LIMIT 1";
			if(!($result = $connection->query($query))){
				$errMsg = 'Nie udało się dodać sposobu wysyłki';
				return;
			}
			if($result->num_rows > 0){
				$errMsg = 'Taki sposób wysyłki już istnieje';
				return;
			}
			$query = "INSERT INTO sposoby_wysylki(Nazwa_uslugi, Szybkosc_dostawy, Cena_uslugi) VALUES ('$this->nazwa','$this->szybkosc','$this->cena')";
			if(!$connection->query($query)){
				$errMsg = 'Nie udało się dodać sposobu wysyłki';
			}
		}

		function deleteSposobWysylki(){
			global $connection;
			if(!$connection) require_once(__DIR__.'\..\..\connection.php');
			$errMsg = '';
            
			$query = "SELECT Id FROM sposoby_wysylki WHERE Nazwa_uslugi = '$this->nazwa' LIMIT 1";
			if(!($result = $connection->query($query))){
				$errMsg = 'Nie udało się usunąć sposobu wysyłki';
				return;
			}
			if($result->num_rows == 0){
				$errMsg = 'Taki sposób wysyłki nie istnieje';
				return;
			}
			$row = mysqli_fetch_assoc($result);
			$query = 'DELETE FROM sposoby_wysylki WHERE Id = '.$row['Id'];
			if(!$connection->query($query)){
				$errMsg = 'Nie udało się usunąć sposobu wysyłki';
			}
		}

		function updateSposobWysylki($nowaNazwa, $nowaSzybkosc, $nowaCena){
			global $connection;
			if(!$connection) require_once(__DIR__.'\..\..\connection.php');
			$errMsg = '';
            
			$query = "SELECT Nazwa_uslugi FROM sposoby_wysylki WHERE Nazwa_uslugi = '$this->nazwa' LIMIT 1";
			if(!($result = $connection->query($query))){
				$errMsg = 'Zmiany w sposobie wysyłki nie powiodły się';
				return;
			}
			if($result->num_rows == 0){
				$errMsg = 'Taki sposób wysyłki nie istnieje';
				return;
			}
			$query = "UPDATE sposoby_wysylki SET";
			if($nowaNazwa != ''){
				$query .= " Nazwa_uslugi = '$nowaNazwa'";
				$this->setNazwa($nowaNazwa);
			}
			if($nowaSzybkosc != ''){
				$query .= ", Szybkosc_dostawy = '$nowaSzybkosc'";
				$this->setSzybkosc($nowaSzybkosc);
			}
			if($nowaCena != ''){
				$query .= ", Cena_uslugi = '$nowaCena'";
				$this->setCena($nowaCena);
			}
			$query .= " WHERE Nazwa_uslugi = '$this->nazwa'";
			if(!$connection->query($query)){
				$errMsg = 'Zmiany w sposobie wysyłki nie powiodły się';
				return;
			}
		}
	}
?>