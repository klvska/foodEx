DROP DATABASE IF EXISTS foodEx;
CREATE DATABASE foodEx;
USE foodEx;

CREATE TABLE Uzytkownicy (
    id INT(11) PRIMARY KEY AUTO_INCREMENT,
    Imie TEXT(250),
    Nazwisko TEXT(250),
    Nazwa_Uzytkownika TEXT(250),
    Haslo TEXT(250),
    Id_Zamowienia INT(11),
    Adres INT(11),
    Formy_Platnosci INT(11),
    Administrator BOOL,
    FOREIGN KEY (Id_Zamowienia) REFERENCES Zamowienia(id),
    FOREIGN KEY (Adres) REFERENCES Adresy(id),
    FOREIGN KEY (Formy_Platnosci) REFERENCES Formy_Platnosci(id)
);

CREATE TABLE Zamowienia (
    id INT(11) PRIMARY KEY AUTO_INCREMENT,
    id_dan INT(11),
    Cena FLOAT(20),
    Adres INT(11),
    FOREIGN KEY (id_dan) REFERENCES Dania_w_restauracji_XD(id_dwr),
    FOREIGN KEY (Adres) REFERENCES Adresy(id)
);

CREATE TABLE Restauracje (
    id INT(11) PRIMARY KEY AUTO_INCREMENT,
    nazwa_restauracji TEXT(250),
    Miasto TEXT(250)
);

CREATE TABLE Dania (
    id INT(11) PRIMARY KEY AUTO_INCREMENT,
    Nazwa TEXT(250),
    Cena FLOAT(20)
);

CREATE TABLE Adresy (
    id INT(11) PRIMARY KEY AUTO_INCREMENT,
    Miasto TEXT(250),
    Ulica TEXT(250),
    Nr_Domu_Mieszkania INT(11),
    Kod_Pocztowy INT(11)
);

CREATE TABLE Formy_Platnosci (
    id INT(11) PRIMARY KEY AUTO_INCREMENT,
    Karta INT(11),
    Paypal INT(11),
    W_Naturze BOOL
);

CREATE TABLE Dania_w_restauracji_XD (
    id_dwr INT(11) PRIMARY KEY AUTO_INCREMENT,
    id_res INT(11),
    id_Dania INT(11),
    FOREIGN KEY (id_res) REFERENCES Restauracje(id),
    FOREIGN KEY (id_Dania) REFERENCES Dania(id)
);
