<?php 
	class Ksiazka{
		private $id;
		private $tytul;
		private $autor;
		private $opis;
		private $gatunek;
		private $data;
		private $wydawnictwo;
		private $ocena;
		private $cena;
		private $sprzedanych;

		function __construct(string $ksiazka_tytul = '', string $ksiazka_autor = '', string $ksiazka_opis = '', string $ksiazka_gatunek = '', string $ksiazka_data = '', string $ksiazka_wydawnictwo = '', string $ksiazka_ocena = '', string $ksiazka_cena = ''){
			$this->setTytul($ksiazka_tytul);
			$this->setAutor($ksiazka_autor);
			$this->setOpis($ksiazka_opis);
			$this->setGatunek($ksiazka_gatunek);
			$this->setData($ksiazka_data);
			$this->setWydawnictwo($ksiazka_wydawnictwo);
			$this->setOcena($ksiazka_ocena);
			$this->setCena($ksiazka_cena);
		}

	    public function getId()
	    {
	        return $this->id;
	    }

	    public function setId($id)
	    {
	        $this->id = $id;

	        return $this;
	    }

	    public function getTytul()
	    {
	        return $this->tytul;
	    }

	    public function setTytul($tytul)
	    {
	        $this->tytul = $tytul;

	        return $this;
	    }

	    public function getAutor()
	    {
	        return $this->autor;
	    }

	    public function setAutor($autor)
	    {
	        $this->autor = $autor;

	        return $this;
	    }

	    public function getOpis()
	    {
	        return $this->opis;
	    }

	    public function setOpis($opis)
	    {
	        $this->opis = $opis;

	        return $this;
	    }

	    public function getGatunek()
	    {
	        return $this->gatunek;
	    }

	    public function setGatunek($gatunek)
	    {
	        $this->gatunek = $gatunek;

	        return $this;
	    }

	    public function getData()
	    {
	        return $this->data;
	    }

	    public function setData($data)
	    {
	        $this->data = $data;

	        return $this;
	    }

	    public function getWydawnictwo()
	    {
	        return $this->wydawnictwo;
	    }

	    public function setWydawnictwo($wydawnictwo)
	    {
	        $this->wydawnictwo = $wydawnictwo;

	        return $this;
	    }

	    public function getOcena()
	    {
	        return $this->ocena;
	    }

	    public function setOcena($ocena)
	    {
	        $this->ocena = $ocena;

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

	    public function getSprzedanych()
	    {
	        return $this->sprzedanych;
	    }

	    public function setSprzedanych($sprzedanych)
	    {
	        $this->sprzedanych = $sprzedanych;

	        return $this;
	    }

	    function getFromDB(){
			global $connection;
			if(!$connection) require_once(__DIR__.'/../../connection.php');
			if($this->tytul != '') {
				$query = "SELECT * FROM ksiazki WHERE Tytul = '$this->tytul' LIMIT 1";
			}else if($this->id != ''){
				$query = "SELECT * FROM ksiazki WHERE Id = '$this->id' LIMIT 1";
			}else{
				$errMsg = 'Taka książka nie istnieje';
				return $errMsg;
			}
			if(!($result = $connection->query($query))){
				$errMsg = 'Błąd bazy danych';
				$result->close();
				return $errMsg;
			}
			if($result->num_rows == 0){
				$errMsg = 'Taka książka nie istnieje';
				$result->close();
				return $errMsg;
			}else{
				$row = $result->fetch_assoc();
				$result->close();
				$this->id = $row['Id'];
				$this->tytul = $row['Tytul'];
				$this->autor = $row['Autor'];
				$this->opis = $row['Opis'];
				$this->gatunek = $row['Gatunek'];
				$this->data = $row['Data_wydania'];
				$this->wydawnictwo = $row['Wydawnictwo'];
				$this->ocena = $row['Ocena_ksiazki'];
				$this->cena = $row['Cena'];
				$this->sprzedanych = $row['Sprzedanych'];
			}
	    }

	    function uploadOkladka(string $ksiazka_okladka){
	    	$path = __DIR__.'/../../../Okladki/';
	    	$file_name = "okladkaID$this->id.jpg";
	    	move_uploaded_file($ksiazka_okladka, $path.$file_name);
	    }

	    function insertKsiazka(){
			global $connection;
			if(!$connection) require_once(__DIR__.'/../../connection.php');
			$errMsg = '';

			$query = "SELECT Tytul FROM ksiazki WHERE Tytul = '$this->tytul' LIMIT 1";
			if(!($result = $connection->query($query))){
				$errMsg = 'Nie udało się dodać książki';
				$result->close();
				return $errMsg;
			}
			if($result->num_rows > 0){
				$errMsg = 'Taka książki już istnieje';
				$result->close();
				return $errMsg;
			}
			$result->close();
			$query = "INSERT INTO ksiazki(Tytul, Autor, Opis, Gatunek, Data_wydania, Wydawnictwo, Ocena_ksiazki, Cena) VALUES ('$this->tytul', '$this->autor', '$this->opis', '$this->gatunek', '$this->data', '$this->wydawnictwo', '$this->ocena', '$this->cena')";
			if(!$connection->query($query)){
				$errMsg = 'Nie udało się dodać książki';
				$result->close();
				return $errMsg;
			}
	    }

	    function deleteKsiazka(){
			global $connection;
			if(!$connection) require_once(__DIR__.'/../../connection.php');
			$errMsg = '';

			$query = "SELECT Id FROM ksiazki WHERE Tytul = '$this->tytul'";
			if(!($result = $connection->query($query))){
				$errMsg = 'Nie udało się usunąć książki';
				$result->close();
				return $errMsg;
			}
			if($result->num_rows == 0){
				$errMsg = 'Taka książka nie istnieje';
				$result->close();
				return $errMsg;
			}
			$row = $result->fetch_assoc();
			$result->close();
			$this->id = $row['Id'];
			$query = 'DELETE FROM ksiazki WHERE Id = '.$this->id;
			if(!$connection->query($query)){
				$errMsg = 'Nie udało się usunąć książki';
				$result->close();
				return $errMsg;
			}
		}
	}
?>