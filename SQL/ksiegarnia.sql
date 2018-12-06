DROP DATABASE IF EXISTS Ksiegarnia;
CREATE DATABASE Ksiegarnia CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE Ksiegarnia;
CREATE TABLE `Ksiazki` (
	`Id` INT NOT NULL AUTO_INCREMENT,
	`Tytul` TEXT NOT NULL,
	`Autor` varchar(100) NOT NULL,
	`Opis` TEXT NOT NULL,
	`Gatunek` INT NOT NULL,
	`Data_wydania` DATE NOT NULL,
	`Wydawnictwo` INT NOT NULL,
	`Ocena_ksiazki` DECIMAL(3,1) NOT NULL,
	`Cena` DECIMAL(10,2) NOT NULL,
	`Sprzedanych` INT NOT NULL DEFAULT 0,
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
	`Ilosc` INT NOT NULL DEFAULT '1',
	PRIMARY KEY (`Id`)
);

CREATE TABLE `Koszyk` (
    `Id` INT NOT NULL AUTO_INCREMENT,
    `Id_uzytkownika` INT NOT NULL,
    `Id_produktu` INT NOT NULL,
    `Ilosc` INT NOT NULL DEFAULT '1',
    PRIMARY KEY (`Id`)
);

ALTER TABLE `Ksiazki` ADD CONSTRAINT `Ksiazki_fk0` FOREIGN KEY (`Gatunek`) REFERENCES `Gatunki`(`Id`);

ALTER TABLE `Ksiazki` ADD CONSTRAINT `Ksiazki_fk1` FOREIGN KEY (`Wydawnictwo`) REFERENCES `Wydawnictwa`(`Id`);

ALTER TABLE `Zamowienia` ADD CONSTRAINT `Zamowienia_fk0` FOREIGN KEY (`Id_klienta`) REFERENCES `Uzytkownicy`(`Id`);

ALTER TABLE `Zamowienia` ADD CONSTRAINT `Zamowienia_fk1` FOREIGN KEY (`Rodzaj_platnosci`) REFERENCES `Sposoby_platnosci`(`Id`);

ALTER TABLE `Zamowienia` ADD CONSTRAINT `Zamowienia_fk2` FOREIGN KEY (`Usluga_wysylki`) REFERENCES `Sposoby_wysylki`(`Id`);

ALTER TABLE `Zamowione` ADD CONSTRAINT `Zamowione_fk0` FOREIGN KEY (`Id_zamowienia`) REFERENCES `Zamowienia`(`Id`);

ALTER TABLE `Zamowione` ADD CONSTRAINT `Zamowione_fk1` FOREIGN KEY (`Id_produktu`) REFERENCES `Ksiazki`(`Id`);

ALTER TABLE `Koszyk` ADD CONSTRAINT `Koszyk_fk0` FOREIGN KEY (`Id_uzytkownika`) REFERENCES `Uzytkownicy`(`Id`);

ALTER TABLE `Koszyk` ADD CONSTRAINT `Koszyk_fk1` FOREIGN KEY (`Id_produktu`) REFERENCES `Ksiazki`(`Id`);

INSERT INTO gatunki(Gatunek) VALUES ('Fantastyka');
INSERT INTO gatunki(Gatunek) VALUES ('Literatura piękna');
INSERT INTO gatunki(Gatunek) VALUES ('Historia');
INSERT INTO gatunki(Gatunek) VALUES ('Literatura naukowa');
INSERT INTO gatunki(Gatunek) VALUES ('Komiksy');
INSERT INTO gatunki(Gatunek) VALUES ('Literatura popularno-naukowa');
INSERT INTO gatunki(Gatunek) VALUES ('Horror');
INSERT INTO gatunki(Gatunek) VALUES ('Proza');
INSERT INTO gatunki(Gatunek) VALUES ('Biografie');
INSERT INTO gatunki(Gatunek) VALUES ('Dla młodzieży');

INSERT INTO wydawnictwa(Wydawca) VALUES ('Readers Digest');
INSERT INTO wydawnictwa(Wydawca) VALUES ('Świat książki');
INSERT INTO wydawnictwa(Wydawca) VALUES ('Wolters Kluwer');
INSERT INTO wydawnictwa(Wydawca) VALUES ('Nowa Era');
INSERT INTO wydawnictwa(Wydawca) VALUES ('Wiedza i Praktyka');
INSERT INTO wydawnictwa(Wydawca) VALUES ('Wydawnictwo Naukowe PWN');
INSERT INTO wydawnictwa(Wydawca) VALUES ('Pearson Education');
INSERT INTO wydawnictwa(Wydawca) VALUES ('Helion');
INSERT INTO wydawnictwa(Wydawca) VALUES ('Egmont');
INSERT INTO wydawnictwa(Wydawca) VALUES ('Zielona Sowa');



INSERT INTO ksiazki(Tytul,Autor,Opis,Gatunek,Data_wydania,Wydawnictwo,Ocena_ksiazki,Cena,Sprzedanych) VALUES ('Duma i uprzedzenie ',' Jane Austen ',' ','7','2011-2-1','8','2','70','2');
INSERT INTO ksiazki(Tytul,Autor,Opis,Gatunek,Data_wydania,Wydawnictwo,Ocena_ksiazki,Cena,Sprzedanych) VALUES ('Władca Pierścieni ',' JRR Tolkien ',' ','3','2010-10-25','4','7','60','27');
INSERT INTO ksiazki(Tytul,Autor,Opis,Gatunek,Data_wydania,Wydawnictwo,Ocena_ksiazki,Cena,Sprzedanych) VALUES ('Jane Eyre ',' Charlotte Bronte ',' ','2','2013-6-23','4','6','53','33');
INSERT INTO ksiazki(Tytul,Autor,Opis,Gatunek,Data_wydania,Wydawnictwo,Ocena_ksiazki,Cena,Sprzedanych) VALUES ('Seria o Harrym Potterze ',' JK Rowling ',' ','7','2012-9-4','9','6','61','38');
INSERT INTO ksiazki(Tytul,Autor,Opis,Gatunek,Data_wydania,Wydawnictwo,Ocena_ksiazki,Cena,Sprzedanych) VALUES ('Zabić drozdad ',' Harper Lee ',' ','2','2006-9-30','2','7','51','56');
INSERT INTO ksiazki(Tytul,Autor,Opis,Gatunek,Data_wydania,Wydawnictwo,Ocena_ksiazki,Cena,Sprzedanych) VALUES ('Wichrowe Wzgórza ',' Emily Bronte ',' ','9','2013-9-12','6','9','75','55');
INSERT INTO ksiazki(Tytul,Autor,Opis,Gatunek,Data_wydania,Wydawnictwo,Ocena_ksiazki,Cena,Sprzedanych) VALUES ('Rok 1984 ',' George Orwell ',' ','4','2005-1-21','9','6','91','20');
INSERT INTO ksiazki(Tytul,Autor,Opis,Gatunek,Data_wydania,Wydawnictwo,Ocena_ksiazki,Cena,Sprzedanych) VALUES ('Mroczne materie',' Philip Pullman ',' ','2','2008-4-11','8','1','86','59');
INSERT INTO ksiazki(Tytul,Autor,Opis,Gatunek,Data_wydania,Wydawnictwo,Ocena_ksiazki,Cena,Sprzedanych) VALUES ('Wielkie nadzieje ',' Charles Dickens ',' ','5','2005-3-8','5','8','54','24');
INSERT INTO ksiazki(Tytul,Autor,Opis,Gatunek,Data_wydania,Wydawnictwo,Ocena_ksiazki,Cena,Sprzedanych) VALUES ('Małe kobietki ',' Louisa M Alcott ',' ','1','2003-10-27','3','8','58','9');
INSERT INTO ksiazki(Tytul,Autor,Opis,Gatunek,Data_wydania,Wydawnictwo,Ocena_ksiazki,Cena,Sprzedanych) VALUES ('Tessa D’Urberville ',' Thomas Hardy ',' ','10','2012-11-11','8','6','82','19');
INSERT INTO ksiazki(Tytul,Autor,Opis,Gatunek,Data_wydania,Wydawnictwo,Ocena_ksiazki,Cena,Sprzedanych) VALUES ('Paragraf 22 ',' Joseph Heller ',' ','7','2011-9-14','9','10','50','33');
INSERT INTO ksiazki(Tytul,Autor,Opis,Gatunek,Data_wydania,Wydawnictwo,Ocena_ksiazki,Cena,Sprzedanych) VALUES ('Rebeka ',' Daphne Du Maurier ',' ','7','2000-6-13','6','8','62','34');
INSERT INTO ksiazki(Tytul,Autor,Opis,Gatunek,Data_wydania,Wydawnictwo,Ocena_ksiazki,Cena,Sprzedanych) VALUES ('Hobbit ',' JRR Tolkien ',' ','1','2001-3-2','6','7','54','30');
INSERT INTO ksiazki(Tytul,Autor,Opis,Gatunek,Data_wydania,Wydawnictwo,Ocena_ksiazki,Cena,Sprzedanych) VALUES ('Birdsong ',' Sebastian Faulks ',' ','7','2010-2-14','1','8','56','16');
INSERT INTO ksiazki(Tytul,Autor,Opis,Gatunek,Data_wydania,Wydawnictwo,Ocena_ksiazki,Cena,Sprzedanych) VALUES ('Buszujący w zbożu ',' JD Salinger ',' ','8','2004-5-15','3','10','94','45');
INSERT INTO ksiazki(Tytul,Autor,Opis,Gatunek,Data_wydania,Wydawnictwo,Ocena_ksiazki,Cena,Sprzedanych) VALUES ('Żona podróżnika w czasie ',' Audrey Niffenegger ',' ','9','2014-11-21','9','10','51','28');
INSERT INTO ksiazki(Tytul,Autor,Opis,Gatunek,Data_wydania,Wydawnictwo,Ocena_ksiazki,Cena,Sprzedanych) VALUES ('Miasteczko Middlemarch ',' George Eliot ',' ','6','2005-10-8','5','5','67','9');
INSERT INTO ksiazki(Tytul,Autor,Opis,Gatunek,Data_wydania,Wydawnictwo,Ocena_ksiazki,Cena,Sprzedanych) VALUES ('Przeminęło z wiatrem ',' Margaret Mitchell ',' ','1','2013-11-6','8','3','64','30');
INSERT INTO ksiazki(Tytul,Autor,Opis,Gatunek,Data_wydania,Wydawnictwo,Ocena_ksiazki,Cena,Sprzedanych) VALUES ('Wielki Gatsby ',' F Scott Fitzgerald ',' ','10','2007-5-28','4','7','54','11');
INSERT INTO ksiazki(Tytul,Autor,Opis,Gatunek,Data_wydania,Wydawnictwo,Ocena_ksiazki,Cena,Sprzedanych) VALUES ('Samotnia',' Charles Dickens ',' ','8','2013-1-24','5','2','73','16');
INSERT INTO ksiazki(Tytul,Autor,Opis,Gatunek,Data_wydania,Wydawnictwo,Ocena_ksiazki,Cena,Sprzedanych) VALUES ('Wojna i pokój ',' Leo Tolstoy ',' ','1','2010-5-12','5','8','54','56');
INSERT INTO ksiazki(Tytul,Autor,Opis,Gatunek,Data_wydania,Wydawnictwo,Ocena_ksiazki,Cena,Sprzedanych) VALUES ('Autostopem przez Galaktykę ',' Douglas Adams ',' ','5','2002-11-16','4','9','86','25');
INSERT INTO ksiazki(Tytul,Autor,Opis,Gatunek,Data_wydania,Wydawnictwo,Ocena_ksiazki,Cena,Sprzedanych) VALUES ('Znowu w Brideshead ',' Evelyn Waugh ',' ','2','2012-11-29','10','9','51','15');
INSERT INTO ksiazki(Tytul,Autor,Opis,Gatunek,Data_wydania,Wydawnictwo,Ocena_ksiazki,Cena,Sprzedanych) VALUES ('Zbrodnia i kara ',' Fyodor Dostoyevsky ',' ','10','2009-10-17','5','9','89','8');
INSERT INTO ksiazki(Tytul,Autor,Opis,Gatunek,Data_wydania,Wydawnictwo,Ocena_ksiazki,Cena,Sprzedanych) VALUES ('Grona gniewu ',' John Steinbeck ',' ','7','2002-12-23','2','10','63','42');
INSERT INTO ksiazki(Tytul,Autor,Opis,Gatunek,Data_wydania,Wydawnictwo,Ocena_ksiazki,Cena,Sprzedanych) VALUES ('Alicja w Krainie Czarów ',' Lewis Carroll ',' ','2','2007-3-5','4','3','93','58');
INSERT INTO ksiazki(Tytul,Autor,Opis,Gatunek,Data_wydania,Wydawnictwo,Ocena_ksiazki,Cena,Sprzedanych) VALUES ('O czym szumią wierzby ',' Kenneth Grahame ',' ','5','2000-10-29','2','9','90','9');
INSERT INTO ksiazki(Tytul,Autor,Opis,Gatunek,Data_wydania,Wydawnictwo,Ocena_ksiazki,Cena,Sprzedanych) VALUES ('Anna Karenina ',' Leo Tolstoy ',' ','1','2008-7-22','1','1','94','14');
INSERT INTO ksiazki(Tytul,Autor,Opis,Gatunek,Data_wydania,Wydawnictwo,Ocena_ksiazki,Cena,Sprzedanych) VALUES ('David Copperfield ',' Charles Dickens ',' ','3','2004-2-10','5','3','59','10');
INSERT INTO ksiazki(Tytul,Autor,Opis,Gatunek,Data_wydania,Wydawnictwo,Ocena_ksiazki,Cena,Sprzedanych) VALUES ('Opowieści z Narnii ',' CS Lewis ',' ','3','2013-1-25','3','1','77','43');
INSERT INTO ksiazki(Tytul,Autor,Opis,Gatunek,Data_wydania,Wydawnictwo,Ocena_ksiazki,Cena,Sprzedanych) VALUES ('Perswazje ',' Jane Austen ',' ','5','2008-5-4','6','7','60','34');
INSERT INTO ksiazki(Tytul,Autor,Opis,Gatunek,Data_wydania,Wydawnictwo,Ocena_ksiazki,Cena,Sprzedanych) VALUES ('Lew, Czarwnica i Stara Szafa ',' CS Lewis ',' ','3','2009-5-12','8','9','50','27');
INSERT INTO ksiazki(Tytul,Autor,Opis,Gatunek,Data_wydania,Wydawnictwo,Ocena_ksiazki,Cena,Sprzedanych) VALUES ('Chłopiec z latawcem ',' Khaled Hosseini ',' ','10','2001-1-24','1','1','53','57');
INSERT INTO ksiazki(Tytul,Autor,Opis,Gatunek,Data_wydania,Wydawnictwo,Ocena_ksiazki,Cena,Sprzedanych) VALUES ('Kapitan Corelli ',' Louis De Bernieres ',' ','1','2003-8-27','8','7','88','41');
INSERT INTO ksiazki(Tytul,Autor,Opis,Gatunek,Data_wydania,Wydawnictwo,Ocena_ksiazki,Cena,Sprzedanych) VALUES ('Wyznania Gejszy ',' Arthur Golden ',' ','6','2012-10-13','4','7','68','39');
INSERT INTO ksiazki(Tytul,Autor,Opis,Gatunek,Data_wydania,Wydawnictwo,Ocena_ksiazki,Cena,Sprzedanych) VALUES ('Kubuś Puchatek ',' AA Milne ',' ','5','2009-6-12','4','4','100','17');
INSERT INTO ksiazki(Tytul,Autor,Opis,Gatunek,Data_wydania,Wydawnictwo,Ocena_ksiazki,Cena,Sprzedanych) VALUES ('Folwark zwierzęcy ',' George Orwell ',' ','6','2004-5-18','10','5','57','23');
INSERT INTO ksiazki(Tytul,Autor,Opis,Gatunek,Data_wydania,Wydawnictwo,Ocena_ksiazki,Cena,Sprzedanych) VALUES ('Kod Da Vinci ',' Dan Brown ',' ','7','2009-5-26','3','7','51','47');
INSERT INTO ksiazki(Tytul,Autor,Opis,Gatunek,Data_wydania,Wydawnictwo,Ocena_ksiazki,Cena,Sprzedanych) VALUES ('Sto lat samotności ',' Gabriel Garcia Marquez ',' ','6','2001-11-14','5','2','99','14');
INSERT INTO ksiazki(Tytul,Autor,Opis,Gatunek,Data_wydania,Wydawnictwo,Ocena_ksiazki,Cena,Sprzedanych) VALUES ('Modlitwa za Owena ',' John Irving ',' ','6','2013-8-6','3','9','99','11');
INSERT INTO ksiazki(Tytul,Autor,Opis,Gatunek,Data_wydania,Wydawnictwo,Ocena_ksiazki,Cena,Sprzedanych) VALUES ('Kobieta w bieli ',' Wilkie Collins ',' ','7','2004-12-2','3','8','74','53');
INSERT INTO ksiazki(Tytul,Autor,Opis,Gatunek,Data_wydania,Wydawnictwo,Ocena_ksiazki,Cena,Sprzedanych) VALUES ('Ania z Zielonego Wzgórza ',' LM Montgomery ',' ','8','2014-6-2','5','4','55','38');
INSERT INTO ksiazki(Tytul,Autor,Opis,Gatunek,Data_wydania,Wydawnictwo,Ocena_ksiazki,Cena,Sprzedanych) VALUES ('Z dala od zgiełku ',' Thomas Hardy ',' ','3','2014-3-29','8','6','92','31');
INSERT INTO ksiazki(Tytul,Autor,Opis,Gatunek,Data_wydania,Wydawnictwo,Ocena_ksiazki,Cena,Sprzedanych) VALUES ('Opowieść podręcznej ',' Margaret Atwood ',' ','1','2002-2-3','6','2','56','32');
INSERT INTO ksiazki(Tytul,Autor,Opis,Gatunek,Data_wydania,Wydawnictwo,Ocena_ksiazki,Cena,Sprzedanych) VALUES ('Władca much ',' William Golding ',' ','7','2005-11-6','9','10','61','37');
INSERT INTO ksiazki(Tytul,Autor,Opis,Gatunek,Data_wydania,Wydawnictwo,Ocena_ksiazki,Cena,Sprzedanych) VALUES ('Pokuta ',' Ian McEwan ',' ','5','2014-12-31','4','9','96','30');
INSERT INTO ksiazki(Tytul,Autor,Opis,Gatunek,Data_wydania,Wydawnictwo,Ocena_ksiazki,Cena,Sprzedanych) VALUES ('Życie Pi ',' Yann Martel ',' ','8','2001-4-12','10','10','77','37');
INSERT INTO ksiazki(Tytul,Autor,Opis,Gatunek,Data_wydania,Wydawnictwo,Ocena_ksiazki,Cena,Sprzedanych) VALUES ('Diuna ',' Frank Herbert ',' ','5','2002-7-4','1','3','71','37');
INSERT INTO ksiazki(Tytul,Autor,Opis,Gatunek,Data_wydania,Wydawnictwo,Ocena_ksiazki,Cena,Sprzedanych) VALUES ('Cold Comfort Farm ',' Stella Gibbons ',' ','7','2011-10-6','9','6','85','39');
INSERT INTO ksiazki(Tytul,Autor,Opis,Gatunek,Data_wydania,Wydawnictwo,Ocena_ksiazki,Cena,Sprzedanych) VALUES ('Rozważna i romantyczna ',' Jane Austen ',' ','6','2012-5-27','3','9','55','4');
INSERT INTO ksiazki(Tytul,Autor,Opis,Gatunek,Data_wydania,Wydawnictwo,Ocena_ksiazki,Cena,Sprzedanych) VALUES ('Pretendent do ręki ',' Vikram Seth ',' ','3','2010-12-10','5','5','60','42');
INSERT INTO ksiazki(Tytul,Autor,Opis,Gatunek,Data_wydania,Wydawnictwo,Ocena_ksiazki,Cena,Sprzedanych) VALUES ('Cień wiatru ',' Carlos Ruiz Zafon ',' ','3','2006-12-23','10','9','81','28');
INSERT INTO ksiazki(Tytul,Autor,Opis,Gatunek,Data_wydania,Wydawnictwo,Ocena_ksiazki,Cena,Sprzedanych) VALUES ('Opowieść o dwóch miastach ',' Charles Dickens ',' ','3','2013-4-30','2','10','77','38');
INSERT INTO ksiazki(Tytul,Autor,Opis,Gatunek,Data_wydania,Wydawnictwo,Ocena_ksiazki,Cena,Sprzedanych) VALUES ('Nowy wspaniały świat ',' Aldous Huxley ',' ','5','2009-7-1','6','7','58','2');
INSERT INTO ksiazki(Tytul,Autor,Opis,Gatunek,Data_wydania,Wydawnictwo,Ocena_ksiazki,Cena,Sprzedanych) VALUES ('Dziwny przypadek psa nocną porą',' Mark Haddon ',' ','5','2003-10-21','4','10','78','4');
INSERT INTO ksiazki(Tytul,Autor,Opis,Gatunek,Data_wydania,Wydawnictwo,Ocena_ksiazki,Cena,Sprzedanych) VALUES ('Miłość w czasach zarazy ',' Gabriel Garcia Marquez ',' ','5','2012-10-3','2','7','76','28');
INSERT INTO ksiazki(Tytul,Autor,Opis,Gatunek,Data_wydania,Wydawnictwo,Ocena_ksiazki,Cena,Sprzedanych) VALUES ('Myszy i ludzie ',' John Steinbeck ',' ','3','2001-10-2','1','4','79','49');
INSERT INTO ksiazki(Tytul,Autor,Opis,Gatunek,Data_wydania,Wydawnictwo,Ocena_ksiazki,Cena,Sprzedanych) VALUES ('Lolita ',' Vladimir Nabokov ',' ','6','2001-3-19','9','3','53','49');
INSERT INTO ksiazki(Tytul,Autor,Opis,Gatunek,Data_wydania,Wydawnictwo,Ocena_ksiazki,Cena,Sprzedanych) VALUES ('Tajemna historia ',' Donna Tartt ',' ','3','2001-6-22','4','2','66','24');
INSERT INTO ksiazki(Tytul,Autor,Opis,Gatunek,Data_wydania,Wydawnictwo,Ocena_ksiazki,Cena,Sprzedanych) VALUES ('Nostalgia anioła ',' Alice Sebold ',' ','1','2014-2-26','9','4','90','60');
INSERT INTO ksiazki(Tytul,Autor,Opis,Gatunek,Data_wydania,Wydawnictwo,Ocena_ksiazki,Cena,Sprzedanych) VALUES ('Hrabia Monte Christo ',' Alexandre Dumas ',' ','3','2000-12-6','8','3','69','60');
INSERT INTO ksiazki(Tytul,Autor,Opis,Gatunek,Data_wydania,Wydawnictwo,Ocena_ksiazki,Cena,Sprzedanych) VALUES ('W drodze ',' Jack Kerouac ',' ','10','2010-2-12','6','3','53','42');
INSERT INTO ksiazki(Tytul,Autor,Opis,Gatunek,Data_wydania,Wydawnictwo,Ocena_ksiazki,Cena,Sprzedanych) VALUES ('Juda nieznany ',' Thomas Hardy ',' ','1','2009-11-27','1','10','79','40');
INSERT INTO ksiazki(Tytul,Autor,Opis,Gatunek,Data_wydania,Wydawnictwo,Ocena_ksiazki,Cena,Sprzedanych) VALUES ('Dziennik Bridget Jones ',' Helen Fielding ',' ','10','2011-7-14','9','9','87','29');
INSERT INTO ksiazki(Tytul,Autor,Opis,Gatunek,Data_wydania,Wydawnictwo,Ocena_ksiazki,Cena,Sprzedanych) VALUES ('Dzieci północy ',' Salman Rushdie ',' ','1','2005-12-12','3','1','90','6');
INSERT INTO ksiazki(Tytul,Autor,Opis,Gatunek,Data_wydania,Wydawnictwo,Ocena_ksiazki,Cena,Sprzedanych) VALUES ('Moby Dick ',' Herman Melville ',' ','1','2004-4-20','8','2','56','49');
INSERT INTO ksiazki(Tytul,Autor,Opis,Gatunek,Data_wydania,Wydawnictwo,Ocena_ksiazki,Cena,Sprzedanych) VALUES ('Oliver Twist ',' Charles Dickens ',' ','10','2009-5-16','7','3','87','4');
INSERT INTO ksiazki(Tytul,Autor,Opis,Gatunek,Data_wydania,Wydawnictwo,Ocena_ksiazki,Cena,Sprzedanych) VALUES ('Dracula ',' Bram Stoker ',' ','2','2006-9-11','3','8','70','47');
INSERT INTO ksiazki(Tytul,Autor,Opis,Gatunek,Data_wydania,Wydawnictwo,Ocena_ksiazki,Cena,Sprzedanych) VALUES ('Tajemniczy ogród ',' Frances Hodgson Burnett ',' ','10','2010-11-1','5','10','74','41');
INSERT INTO ksiazki(Tytul,Autor,Opis,Gatunek,Data_wydania,Wydawnictwo,Ocena_ksiazki,Cena,Sprzedanych) VALUES ('Zapiski z małej wyspy ',' Bill Bryson ',' ','1','2008-2-29','6','7','73','32');
INSERT INTO ksiazki(Tytul,Autor,Opis,Gatunek,Data_wydania,Wydawnictwo,Ocena_ksiazki,Cena,Sprzedanych) VALUES ('Ulisses ',' James Joyce ',' ','9','2002-3-19','10','7','83','42');
INSERT INTO ksiazki(Tytul,Autor,Opis,Gatunek,Data_wydania,Wydawnictwo,Ocena_ksiazki,Cena,Sprzedanych) VALUES ('Szklany kosz ',' Sylvia Plath ',' ','3','2011-7-13','4','4','56','9');
INSERT INTO ksiazki(Tytul,Autor,Opis,Gatunek,Data_wydania,Wydawnictwo,Ocena_ksiazki,Cena,Sprzedanych) VALUES ('Jaskółki i Amazonki ',' Arthur Ransome ',' ','10','2001-2-10','8','10','62','25');
INSERT INTO ksiazki(Tytul,Autor,Opis,Gatunek,Data_wydania,Wydawnictwo,Ocena_ksiazki,Cena,Sprzedanych) VALUES ('Germinal ',' Emile Zola ',' ','8','2013-3-30','6','10','77','52');
INSERT INTO ksiazki(Tytul,Autor,Opis,Gatunek,Data_wydania,Wydawnictwo,Ocena_ksiazki,Cena,Sprzedanych) VALUES ('Targowisko próżności ',' William Makepeace Thackeray ',' ','9','2007-12-17','5','3','74','47');
INSERT INTO ksiazki(Tytul,Autor,Opis,Gatunek,Data_wydania,Wydawnictwo,Ocena_ksiazki,Cena,Sprzedanych) VALUES ('Opętanie ',' AS Byatt ',' ','6','2007-5-30','8','9','55','58');
INSERT INTO ksiazki(Tytul,Autor,Opis,Gatunek,Data_wydania,Wydawnictwo,Ocena_ksiazki,Cena,Sprzedanych) VALUES ('Opowieść wigilijna ',' Charles Dickens ',' ','8','2004-8-18','7','3','100','4');
INSERT INTO ksiazki(Tytul,Autor,Opis,Gatunek,Data_wydania,Wydawnictwo,Ocena_ksiazki,Cena,Sprzedanych) VALUES ('Atlas chmur ',' David Mitchell ',' ','3','2009-9-27','7','10','75','5');
INSERT INTO ksiazki(Tytul,Autor,Opis,Gatunek,Data_wydania,Wydawnictwo,Ocena_ksiazki,Cena,Sprzedanych) VALUES ('Kolor purpury ',' Alice Walker ',' ','9','2012-8-20','1','3','52','56');
INSERT INTO ksiazki(Tytul,Autor,Opis,Gatunek,Data_wydania,Wydawnictwo,Ocena_ksiazki,Cena,Sprzedanych) VALUES ('Okruchy dnia ',' Kazuo Ishiguro ',' ','7','2005-12-13','8','2','96','58');
INSERT INTO ksiazki(Tytul,Autor,Opis,Gatunek,Data_wydania,Wydawnictwo,Ocena_ksiazki,Cena,Sprzedanych) VALUES ('Pani Bovary ',' Gustave Flaubert ',' ','8','2000-3-7','2','4','54','60');
INSERT INTO ksiazki(Tytul,Autor,Opis,Gatunek,Data_wydania,Wydawnictwo,Ocena_ksiazki,Cena,Sprzedanych) VALUES ('A Fine Balance ',' Rohinton Mistry ',' ','5','2008-11-9','2','7','62','4');
INSERT INTO ksiazki(Tytul,Autor,Opis,Gatunek,Data_wydania,Wydawnictwo,Ocena_ksiazki,Cena,Sprzedanych) VALUES ('Pajęczyna Szarloty ',' EB White ',' ','6','2013-10-29','6','5','74','48');
INSERT INTO ksiazki(Tytul,Autor,Opis,Gatunek,Data_wydania,Wydawnictwo,Ocena_ksiazki,Cena,Sprzedanych) VALUES ('Pięć osób, które spotykamy w niebie ',' Mitch Albom ',' ','8','2007-12-18','6','6','83','15');
INSERT INTO ksiazki(Tytul,Autor,Opis,Gatunek,Data_wydania,Wydawnictwo,Ocena_ksiazki,Cena,Sprzedanych) VALUES ('Przygody Scherlocka Holmesa ',' Sir Arthur Conan Doyle ',' ','2','2013-7-11','4','9','77','38');
INSERT INTO ksiazki(Tytul,Autor,Opis,Gatunek,Data_wydania,Wydawnictwo,Ocena_ksiazki,Cena,Sprzedanych) VALUES ('The Faraway Tree Collection ',' Enid Blyton ',' ','3','2000-7-20','1','6','52','40');
INSERT INTO ksiazki(Tytul,Autor,Opis,Gatunek,Data_wydania,Wydawnictwo,Ocena_ksiazki,Cena,Sprzedanych) VALUES ('Jądro ciemności ',' Joseph Conrad ',' ','10','2006-8-23','4','1','68','46');
INSERT INTO ksiazki(Tytul,Autor,Opis,Gatunek,Data_wydania,Wydawnictwo,Ocena_ksiazki,Cena,Sprzedanych) VALUES ('Mały Książę ',' Antoine De Saint-Exupery ',' ','7','2011-12-12','3','8','64','25');
INSERT INTO ksiazki(Tytul,Autor,Opis,Gatunek,Data_wydania,Wydawnictwo,Ocena_ksiazki,Cena,Sprzedanych) VALUES ('Fabryka os ',' Iain Banks ',' ','1','2005-3-9','10','2','93','49');
INSERT INTO ksiazki(Tytul,Autor,Opis,Gatunek,Data_wydania,Wydawnictwo,Ocena_ksiazki,Cena,Sprzedanych) VALUES ('Wodnikowe Wzgórze ',' Richard Adams ',' ','9','2009-3-17','2','5','75','30');
INSERT INTO ksiazki(Tytul,Autor,Opis,Gatunek,Data_wydania,Wydawnictwo,Ocena_ksiazki,Cena,Sprzedanych) VALUES ('Sprzysiężenie głupców',' John Kennedy Toole ',' ','2','2001-10-14','9','8','98','46');