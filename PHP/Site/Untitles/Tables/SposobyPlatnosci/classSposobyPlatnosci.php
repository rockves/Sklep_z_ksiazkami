<?php
    class SposobPlatnosci
    {
        private $id;
        private $nazwa;
        private $cena;
        
        public function __construct(string $sposobPlatnosci_nazwa = '', string $sposobPlatnosci_cena = '')
        {
            $this->setNazwa($sposobPlatnosci_nazwa);
            $this->setCena($sposobPlatnosci_cena);
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
        
        public function getCena()
        {
            return $this->cena;
        }

        public function setCena($cena)
        {
            $this->cena = $cena;

            return $this;
        }

        public function getId()
        {
            return $this->id;
        }
        
        public function insertSposobPlatnosci()
        {
            global $connection;
            if (!$connection) {
                require_once(__DIR__.'/../../connection.php');
            }
            $errMsg = '';
            
            $query = "SELECT Nazwa_uslugi FROM sposoby_platnosci WHERE Nazwa_uslugi = '$this->nazwa' LIMIT 1";
            if (!($result = $connection->query($query))) {
                $errMsg = 'Nie udało się dodać sposobu płatności';
                $result->close();
                return $errMsg;
            }
            if ($result->num_rows > 0) {
                $errMsg = 'Taki sposób płatności już istnieje';
                $result->close();
                return $errMsg;
            }
            $query = "INSERT INTO sposoby_platnosci(Nazwa_uslugi, Cena_uslugi) VALUES ('$this->nazwa', '$this->cena')";
            if (!$connection->query($query)) {
                $errMsg = 'Nie udało się dodać sposobu wysyłki';
                $result->close();
                return $errMsg;
            }
        }

        public function deleteSposobPlatnosci()
        {
            global $connection;
            if (!$connection) {
                require_once(__DIR__.'/../../connection.php');
            }
            $errMsg = '';
            
            $query = "SELECT Id FROM sposoby_platnosci WHERE Nazwa_uslugi = '$this->nazwa' LIMIT 1";
            if (!($result = $connection->query($query))) {
                $errMsg = 'Nie udało się usunąć sposobu płatności';
                $result->close();
                return $errMsg;
            }
            if ($result->num_rows == 0) {
                $errMsg = 'Taki sposób płatności nie istnieje';
                $result->close();
                return $errMsg;
            }
            $row = $result->fetch_assoc();
            $result->close();
            $this->id = $row['Id'];
            $query = 'DELETE FROM sposoby_platnosci WHERE Id = '.$this->id;
            if (!$connection->query($query)) {
                $errMsg = 'Nie udało się usunąć sposobu płatności';
                $result->close();
                return $errMsg;
            }
        }

        public function updateSposobPlatnosci($nowaNazwa, $nowaCena)
        {
            global $connection;
            if (!$connection) {
                require_once(__DIR__.'/../../connection.php');
            }
            $errMsg = '';
            $staraNazwa = $this->nazwa;
            $query = "SELECT Nazwa_uslugi FROM sposoby_platnosci WHERE Nazwa_uslugi = '$this->nazwa' LIMIT 1";
            if (!($result = $connection->query($query))) {
                $errMsg = 'Zmiany w sposobie płatności nie powiodły się ';
                $result->close();
                return $errMsg;
            }
            if ($result->num_rows == 0) {
                $errMsg = 'Taki sposób płatności nie istnieje';
                $result->close();
                return $errMsg;
            }
            $query = "UPDATE sposoby_platnosci SET ";
            $czyDodane = 0;
            if ($nowaNazwa != '') {
                $query .= "Nazwa_uslugi = '$nowaNazwa'";
                $this->setNazwa($nowaNazwa);
                $czyDodane = 1;
            }
            if ($nowaCena != '') {
                if($czyDodane == 1){
                    $query .= ", Cena_uslugi = '$nowaCena'";
                }else{
                    $query .= "Cena_uslugi = '$nowaCena'";
                }
                $this->setCena($nowaCena);
                $czyDodane = 1;
            }
            $query .= " WHERE Nazwa_uslugi = '$staraNazwa'";
            if (!$connection->query($query)) {
                $errMsg = 'Zmiany w sposobie płatności nie powiodły się';
                $result->close();
                return $errMsg;
            }
        }
    }