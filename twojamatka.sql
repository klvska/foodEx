Uzytkownicy {
	id integer pk increments
	Imie text
	Nazwisko text
	Nazwa_Uzytkownika text
	Haslo text
	Id_Zamowienia integer >* Zamowienia.id
	Adres integer *>* Adresy.id
	Formy_Platnosci integer >* Formy_Platnosci.id
	Administrator boolean
}

Zamowienia {
	id integer pk increments
	id_dan integer >* Dania_w_restauracji_XD.id_dwr
	Cena float
	Adres integer *>* Adresy.id
}

Restauracje {
	id integer pk increments
	nazwa_restauracji text
	Miasto text
}

Dania {
	id integer pk increments
	Nazwa text
	Cena float
}

Adresy {
	id integer pk increments
	Miasto text
	Ulica text
	Nr_Domu/Mieszkania integer
	Kod_Pocztowy integer
}

Formy_Platnosci {
	id integer pk increments
	Karta integer
	Paypal integer
	W_Naturze boolean
}

Dania_w_restauracji_XD {
	id_dwr integer pk increments
	id_res integer *> Restauracje.id
	id_Dania integer *>* Dania.id
}