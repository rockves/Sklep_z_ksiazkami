<?php

    class SposobWysylki
    {
        private $id;
        private $nazwa;
        private $szybkosc;
        private $cena;

        public function __construct(string $sposobWysylki_nazwa = '', string $sposobWysylki_szybkosc = '', string $sposobWysylki_cena = '')
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

        public function insertSposobWysylki()
        {
            global $connection;
            if (!$connection) {
                require_once(__DIR__.'/../../connection.php');
            }
            $errMsg = '';
            
            $query = "SELECT Nazwa_uslugi FROM sposoby_wysylki WHERE Nazwa_uslugi = '$this->nazwa' LIMIT 1";
            if (!($result = $connection->query($query))) {
                $errMsg = 'Nie udało się dodać sposobu wysyłki';
                $result->close();
                return $errMsg;
            }
            if ($result->num_rows > 0) {
                $errMsg = 'Taki sposób wysyłki już istnieje';
                $result->close();
                return $errMsg;
            }
            $query = "INSERT INTO sposoby_wysylki(Nazwa_uslugi, Szybkosc_dostawy, Cena_uslugi) VALUES ('$this->nazwa','$this->szybkosc','$this->cena')";
            if (!$connection->query($query)) {
                $errMsg = 'Nie udało się dodać sposobu wysyłki';
                $result->close();
                return $errMsg;
            }
        }

        public function deleteSposobWysylki()
        {
            global $connection;
            if (!$connection) {
                require_once(__DIR__.'/../../connection.php');
            }
            $errMsg = '';
            
            $query = "SELECT Id FROM sposoby_wysylki WHERE Nazwa_uslugi = '$this->nazwa' LIMIT 1";
            if (!($result = $connection->query($query))) {
                $errMsg = 'Nie udało się usunąć sposobu wysyłki';
                return;
            }
            if ($result->num_rows == 0) {
                $errMsg = 'Taki sposób wysyłki nie istnieje';
                return;
            }
            $row = mysqli_fetch_assoc($result);
            $query = 'DELETE FROM sposoby_wysylki WHERE Id = '.$row['Id'];
            if (!$connection->query($query)) {
                $errMsg = 'Nie udało się usunąć sposobu wysyłki';
            }
        }

        public function updateSposobWysylki($nowaNazwa, $nowaSzybkosc, $nowaCena)
        {
            global $connection;
            if (!$connection) {
                require_once(__DIR__.'/../../connection.php');
            }
            $errMsg = '';
            $staraNazwa = $this->nazwa;
            $query = "SELECT Nazwa_uslugi FROM sposoby_wysylki WHERE Nazwa_uslugi = '$this->nazwa' LIMIT 1";
            if (!($result = $connection->query($query))) {
                $errMsg = 'Zmiany w sposobie wysyłki nie powiodły się';
                return $errMsg;
            }
            if ($result->num_rows == 0) {
                $errMsg = 'Taki sposób wysyłki nie istnieje';
                return $errMsg;
            }
            $query = "UPDATE sposoby_wysylki SET ";
            $czyDodane = 0;
            if ($nowaNazwa != '') {
                $query .= "Nazwa_uslugi = '$nowaNazwa'";
                $this->setNazwa($nowaNazwa);
                $czyDodane = 1;
            }
            if ($nowaSzybkosc != '') {
                if ($czyDodane == 1) {
                    $query .= ", Szybkosc_dostawy = '$nowaSzybkosc'";
                } else {
                    $query .= "Szybkosc_dostawy = '$nowaSzybkosc'";
                }
                
                $this->setSzybkosc($nowaSzybkosc);
                $czyDodane = 1;
            }
            if ($nowaCena != '') {
                if ($czyDodane == 1) {
                    $query .= ", Cena_uslugi = '$nowaCena'";
                } else {
                    $query = "Cena_uslugi = '$nowaCena'";
                }
                
                $this->setCena($nowaCena);
                $czyDodane = 1;
            }
            $query .= " WHERE Nazwa_uslugi = '$staraNazwa'";
            if (!$connection->query($query)) {
                $errMsg = 'Zmiany w sposobie wysyłki nie powiodły się';
                return $errMsg;
            }
        }
    }
