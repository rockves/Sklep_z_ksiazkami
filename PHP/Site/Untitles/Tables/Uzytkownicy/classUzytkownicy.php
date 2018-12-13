<?php

    class Uzytkownik
    {
        private $id;
        private $nazwa;
        private $haslo;
        private $imie;
        private $nazwisko;
        private $ulica;
        private $miasto;
        private $kod;
        private $email;
        private $numer;
        private $czy_pracownik;
        
        public function __construct(string $uzytkownik_nazwa = '', string $uzytkownik_haslo = '', string $uzytkownik_imie = '', string $uzytkownik_nazwisko = '', string $uzytkownik_ulica = '', string $uzytkownik_miasto = '', string $uzytkownik_kod = '', string $uzytkownik_email = '', string $uzytkownik_numer = '', string $uzytkownik_czy_pracownik = '0')
        {
            $this->setNazwa($uzytkownik_nazwa);
            $this->setHaslo($uzytkownik_haslo);
            $this->setImie($uzytkownik_imie);
            $this->setNazwisko($uzytkownik_nazwisko);
            $this->setUlica($uzytkownik_ulica);
            $this->setMiasto($uzytkownik_miasto);
            $this->setKod($uzytkownik_kod);
            $this->setEmail($uzytkownik_email);
            $this->setNumer($uzytkownik_numer);
            $this->setCzyPracownik($uzytkownik_czy_pracownik);
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

        public function getHaslo()
        {
            return $this->haslo;
        }

        public function setHaslo($haslo)
        {
            $this->haslo = $haslo;

            return $this;
        }

        public function getImie()
        {
            return $this->imie;
        }

        public function setImie($imie)
        {
            $this->imie = $imie;

            return $this;
        }

        public function getNazwisko()
        {
            return $this->nazwisko;
        }

        public function setNazwisko($nazwisko)
        {
            $this->nazwisko = $nazwisko;

            return $this;
        }

        public function getUlica()
        {
            return $this->ulica;
        }

        public function setUlica($ulica)
        {
            $this->ulica = $ulica;

            return $this;
        }

        public function getMiasto()
        {
            return $this->miasto;
        }

        public function setMiasto($miasto)
        {
            $this->miasto = $miasto;

            return $this;
        }

        public function getKod()
        {
            return $this->kod;
        }

        public function setKod($kod)
        {
            $this->kod = $kod;

            return $this;
        }

        public function getEmail()
        {
            return $this->email;
        }

        public function setEmail($email)
        {
            $this->email = $email;

            return $this;
        }

        public function getNumer()
        {
            return $this->numer;
        }

        public function setNumer($numer)
        {
            $this->numer = $numer;

            return $this;
        }

        public function getCzyPracownik()
        {
            return $this->czy_pracownik;
        }

        public function setCzyPracownik($czy_pracownik)
        {
            $this->czy_pracownik = $czy_pracownik;

            return $this;
        }

        public function getFromDB()
        {
            global $connection;
            if (!$connection) {
                require_once(__DIR__.'/../../connection.php');
            }
            if ($this->nazwa != '') {
                $query = "SELECT * FROM uzytkownicy WHERE Nazwa_uzytkownika = '$this->nazwa' LIMIT 1";
            } elseif ($this->id != '') {
                $query = "SELECT * FROM ksiazki WHERE Id = '$this->id' LIMIT 1";
            } else {
                $errMsg = 'Taki użytkownik nie istnieje';
                return $errMsg;
            }
            if (!($result = $connection->query($query))) {
                $errMsg = 'Błąd bazy danych';
                $result->close();
                return $errMsg;
            }
            if ($result->num_rows == 0) {
                $errMsg = 'Taki użytkownik nie istnieje';
                $result->close();
                return $errMsg;
            } else {
                $row = $result->fetch_assoc();
                $result->close();
                $this->id = $row['Id'];
                $this->nazwa = $row['Nazwa_uzytkownika'];
                $this->haslo = $row['Haslo'];
                $this->imie = $row['Imie'];
                $this->nazwisko = $row['Nazwisko'];
                $this->ulica = $row['Ulica'];
                $this->miasto = $row['Miasto'];
                $this->kod = $row['Kod_pocztowy'];
                $this->email = $row['Email'];
                $this->numer = $row['Numer_telefonu'];
                $this->czy_pracownik = $row['Czy_pracownik'];
            }
        }

        public function insertUzytkownik()
        {
            global $connection;
            if (!$connection) {
                require_once(__DIR__.'/../../connection.php');
            }
            $errMsg = '';

            $query = "SELECT Nazwa_uzytkownika FROM uzytkownicy WHERE Nazwa_uzytkownika = '$this->nazwa'";
            if (!($result = $connection->query($query))) {
                $errMsg = 'Nie udało się dodać uzytkownika';
                $result->close();
                return $errMsg;
            }
            if ($result->num_rows > 0) {
                $errMsg = 'Taki uzytkownik już istnieje';
                $result->close();
                return $errMsg;
            }
            $query = "SELECT Email FROM uzytkownicy WHERE Email = '$this->email'";
            if (!($result = $connection->query($query))) {
                $errMsg = 'Nie udało się dodać uzytkownika';
                $result->close();
                return $errMsg;
            }
            if ($result->num_rows > 0) {
                $errMsg = 'Użytkownik o takim adresie email już istnieje';
                $result->close();
                return $errMsg;
            }
            $result->close();
            $this->haslo = password_hash($this->haslo, PASSWORD_BCRYPT);
            $query = "INSERT INTO uzytkownicy(Nazwa_uzytkownika, Haslo, Imie, Nazwisko, Ulica, Miasto, Kod_pocztowy, Email, Numer_telefonu, Czy_pracownik) VALUES ('$this->nazwa', '$this->haslo', '$this->imie', '$this->nazwisko', '$this->ulica', '$this->miasto', '$this->kod', '$this->email', '$this->numer', '$this->czy_pracownik')";
            if (!$connection->query($query)) {
                $errMsg = 'Nie udało się dodać uzytkownika';
                $result->close();
                return $errMsg;
            }
        }

        public function deleteUzytkownik()
        {
            global $connection;
            if (!$connection) {
                require_once(__DIR__.'/../../connection.php');
            }
            $errMsg = '';

            $query = "SELECT Id FROM uzytkownicy WHERE Nazwa_uzytkownika = '$this->nazwa'";
            if (!($result = $connection->query($query))) {
                $errMsg = 'Nie udało się usunąć użytkownika';
                $result->close();
                return $errMsg;
            }
            if ($result->num_rows == 0) {
                $errMsg = 'Taki użytkownik nie istnieje';
                $result->close();
                return $errMsg;
            }
            $row = $result->fetch_assoc();
            $result->close();
            $this->id = $row['Id'];
            $query = 'DELETE FROM uzytkownicy WHERE Id = '.$this->id;
            if (!$connection->query($query)) {
                $errMsg = 'Nie udało się usunąć użytkownika';
                $result->close();
                return $errMsg;
            }
        }

        public function updateSposobWysylki($newNazwa, $newHaslo, $newImie, $newNazwisko, $newUlica, $newMiasto, $newKodPocztowy, $newEmail, $newNumer)
        {
            global $connection;
            if (!$connection) {
                require_once(__DIR__.'/../../connection.php');
            }
            $errMsg = '';
            
            $query = "SELECT Nazwa_uzytkownika FROM uzytkownicy WHERE Nazwa_uzytkownika = '$this->nazwa' LIMIT 1";
            if (!($result = $connection->query($query))) {
                $errMsg = 'Zmiany w danych użytkownika nie powiodły się';
                return;
            }
            if ($result->num_rows == 0) {
                $errMsg = 'Taki użytkownik nie istnieje';
                return;
            }
            $query = "UPDATE sposoby_wysylki SET";
            if ($nowaNazwa != '') {
                $query .= " Nazwa_uslugi = '$nowaNazwa'";
                $this->setNazwa($nowaNazwa);
            }
            if ($nowaSzybkosc != '') {
                $query .= ", Szybkosc_dostawy = '$nowaSzybkosc'";
                $this->setSzybkosc($nowaSzybkosc);
            }
            if ($nowaCena != '') {
                $query .= ", Cena_uslugi = '$nowaCena'";
                $this->setCena($nowaCena);
            }
            $query .= " WHERE Nazwa_uslugi = '$this->nazwa'";
            if (!$connection->query($query)) {
                $errMsg = 'Zmiany w sposobie wysyłki nie powiodły się';
                return;
            }
        }
    }