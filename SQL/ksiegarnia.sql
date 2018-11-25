DROP DATABASE IF EXISTS Ksiegarnia;
CREATE DATABASE Ksiegarnia CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE Ksiegarnia;
CREATE TABLE `Ksiazki` (
	`Id` INT NOT NULL AUTO_INCREMENT,
	`Nazwa` TEXT NOT NULL,
	`Autor` varchar(100) NOT NULL,
	`Opis` TEXT NOT NULL,
	`Gatunek` INT NOT NULL,
	`Data_wydania` DATE NOT NULL,
	`Wydawnictwo` INT NOT NULL,
	`Ocena_ksiazki` DECIMAL(3,1) NOT NULL,
	`Cena` DECIMAL(10,2) NOT NULL,
	PRIMARY KEY (`Id`)
);

CREATE TABLE `Gatunki` (
	`Id` INT NOT NULL AUTO_INCREMENT,
	`Gatunek` varchar(100) NOT NULL UNIQUE,
	PRIMARY KEY (`Id`)
);

CREATE TABLE `Wydawnictwa` (
	`Id` INT NOT NULL AUTO_INCREMENT,
	`Wydawca` varchar(100) NOT NULL UNIQUE,
	PRIMARY KEY (`Id`)
);

CREATE TABLE `Sposoby_platnosci` (
	`Id` INT NOT NULL AUTO_INCREMENT,
	`Nazwa_uslugi` varchar(100) NOT NULL UNIQUE,
	`Cena_uslugi` DECIMAL(6,2) NOT NULL UNIQUE,
	PRIMARY KEY (`Id`)
);

CREATE TABLE `Sposoby_wysylki` (
	`Id` INT NOT NULL AUTO_INCREMENT,
	`Nazwa_uslugi` varchar(100) NOT NULL UNIQUE,
	`Szybkosc_dostawy` INT(3) NOT NULL,
	`Cena_uslugi` DECIMAL(6,2) NOT NULL,
	PRIMARY KEY (`Id`)
);

CREATE TABLE `Uzytkownicy` (
	`Id` INT NOT NULL AUTO_INCREMENT,
	`Nazwa_uzytkownika` varchar(20) NOT NULL UNIQUE,
	`Haslo` varchar(255) NOT NULL,
	`Imie` varchar(30) NOT NULL,
	`Nazwisko` varchar(30) NOT NULL,
	`Ulica` varchar(100) NOT NULL,
	`Miasto` varchar(40) NOT NULL,
	`Kod_pocztowy` varchar(10) NOT NULL,
	`Email` varchar(50) NOT NULL UNIQUE,
	`Numer_telefonu` INT(16) NOT NULL,
	`Czy_pracownik` TINYINT(1) NOT NULL DEFAULT 0,
	PRIMARY KEY (`Id`)
);

CREATE TABLE `Zamowienia` (
	`Id` INT NOT NULL AUTO_INCREMENT,
	`Id_klienta` INT NOT NULL,
	`Rodzaj_platnosci` INT NOT NULL,
	`Usluga_wysylki` INT NOT NULL,
	`Data_zamowienia` DATE NOT NULL,
	`Zaplacone?` tinyint(1) NOT NULL DEFAULT '0',
	`Wykonane?` tinyint(1) NOT NULL DEFAULT '0',
	PRIMARY KEY (`Id`)
);

CREATE TABLE `Zamowione` (
	`Id` INT NOT NULL AUTO_INCREMENT,
	`Id_zamowienia` INT NOT NULL,
	`Id_produktu` INT NOT NULL,
	PRIMARY KEY (`Id`)
);

ALTER TABLE `Ksiazki` ADD CONSTRAINT `Ksiazki_fk0` FOREIGN KEY (`Gatunek`) REFERENCES `Gatunki`(`Id`);

ALTER TABLE `Ksiazki` ADD CONSTRAINT `Ksiazki_fk1` FOREIGN KEY (`Wydawnictwo`) REFERENCES `Wydawnictwa`(`Id`);

ALTER TABLE `Zamowienia` ADD CONSTRAINT `Zamowienia_fk0` FOREIGN KEY (`Id_klienta`) REFERENCES `Uzytkownicy`(`Id`);

ALTER TABLE `Zamowienia` ADD CONSTRAINT `Zamowienia_fk1` FOREIGN KEY (`Rodzaj_platnosci`) REFERENCES `Sposoby_platnosci`(`Id`);

ALTER TABLE `Zamowienia` ADD CONSTRAINT `Zamowienia_fk2` FOREIGN KEY (`Usluga_wysylki`) REFERENCES `Sposoby_wysylki`(`Id`);

ALTER TABLE `Zamowione` ADD CONSTRAINT `Zamowione_fk0` FOREIGN KEY (`Id_zamowienia`) REFERENCES `Zamowienia`(`Id`);

ALTER TABLE `Zamowione` ADD CONSTRAINT `Zamowione_fk1` FOREIGN KEY (`Id_produktu`) REFERENCES `Ksiazki`(`Id`);

