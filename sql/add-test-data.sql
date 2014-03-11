INSERT INTO kategoria (nimi)
VALUES ('Yleinen keskustelu');

INSERT INTO kategoria (nimi)
VALUES ('Viihde');

INSERT INTO Aihe (KategoriaID, Nimi)
VALUES(1, 'Esittele itsesi');

INSERT INTO Aihe (KategoriaID, Nimi)
VALUES(1, 'Ole esittelematta itsesi');

INSERT INTO Kayttaja(Nimi, Salasana, Sahkoposti)
VALUES('Arto', 'asd', 'maito@auto.com');

INSERT INTO Kayttaja(Nimi, Salasana, Sahkoposti)
VALUES('Pekka', 'asdasd', 'palo@auto.com');

INSERT INTO Viesti(AiheID, Aloitusviesti, Kirjoitusaika, viestin_sisalto, kirjoittaja)
VALUES(1, TRUE, current_timestamp, 'AAAAAAAAAAAAAAA', 1);