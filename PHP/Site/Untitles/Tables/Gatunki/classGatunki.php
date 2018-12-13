<?php

    class Gatunek
    {
        private $id;
        private $nazwa;

        public function __construct(string $gatunek_nazwa = '')
        {
            $this->setNazwa($gatunek_nazwa);
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

        public function insertGatunek()
        {
            global $connection;
            if (!$connection) {
                require_once(__DIR__.'/../../connection.php');
            }
            $errMsg = '';

            $query = "SELECT Gatunek FROM gatunki WHERE Gatunek = '$this->nazwa' LIMIT 1";
            if (!($result = $connection->query($query))) {
                $errMsg = 'Nie udało się dodać gatunku';
                $result->close();
                return $errMsg;
            }
            if ($result->num_rows > 0) {
                $errMsg = 'Taki gatunek już istnieje';
                $result->close();
                return $errMsg;
            }
            $result->close();
            $query = "INSERT INTO gatunki(Gatunek) VALUES ('$this->nazwa')";
            if (!$connection->query($query)) {
                $errMsg = 'Nie udało się dodać gatunku';
                $result->close();
                return $errMsg;
            }
        }
        public function deleteGatunek()
        {
            global $connection;
            if (!$connection) {
                require_once(__DIR__.'/../../connection.php');
            }
            $errMsg = '';

            $query = "SELECT Id FROM gatunki WHERE Gatunek = '$this->nazwa' LIMIT 1";
            if (!($result = $connection->query($query))) {
                $errMsg = 'Nie udało się usunąć gatunku';
                $result->close();
                return $errMsg;
            }
            if ($result->num_rows == 0) {
                $errMsg = 'Taki gatunek nie istnieje';
                $result->close();
                return $errMsg;
            }
            $row = $result->fetch_assoc();
            $result->close();
            $this->id = $row['Id'];
            $query = 'DELETE FROM gatunki WHERE Id = '.$this->id;
            if (!$connection->query($query)) {
                $errMsg = 'Nie udało się usunąć gatunku';
                $result->close();
                return $errMsg;
            }
        }
        public function updateGatunek($nowaNazwa)
        {
            global $connection;
            if (!$connection) {
                require_once(__DIR__.'/../../connection.php');
            }
            $errMsg = '';

            $query = "SELECT Gatunek FROM gatunki WHERE Gatunek = '$this->nazwa' LIMIT 1";
            if (!($result = $connection->query($query))) {
                $errMsg = 'Nie udało się zmienić nazwy gatunku';
                $result->close();
                return $errMsg;
            }
            if ($result->num_rows == 0) {
                $errMsg = 'Taki gatunek nie istnieje';
                $result->close();
                return $errMsg;
            }
            $result->close();
            $query = "UPDATE gatunki SET Gatunek = '$nowaNazwa' WHERE Gatunek = '$this->nazwa'";
            if (!$connection->query($query)) {
                $errMsg = 'Nie udało się zmienić nazwy gatunku';
                return $errMsg;
            } else {
                $this->nazwa = $nowaNazwa;
            }
        }
    }
