INSERT INTO kategoria (nimi, kuvaus)
VALUES ('Yleinen keskustelu','Yleistä jupinaa');

INSERT INTO kategoria (nimi, kuvaus)
VALUES ('Viihde', 'Puhetta viihteestä');

INSERT INTO kategoria (nimi, kuvaus)
VALUES ('Viihde1', 'Puhetta viihteestä');

INSERT INTO kategoria (nimi, kuvaus)
VALUES ('Viihde2', 'Puhetta viihteestä');

INSERT INTO kategoria (nimi, kuvaus)
VALUES ('Viihde3', 'Puhetta viihteestä');

INSERT INTO Aihe (KategoriaID, Nimi)
VALUES(1, 'Esittele itsesi');

INSERT INTO Aihe (KategoriaID, Nimi)
VALUES(1, 'Ole esittelematta itsesi');

INSERT INTO Kayttaja(Nimi, Salasana, Sahkoposti)
VALUES('Arto', 'asd', 'maito@auto.com');

INSERT INTO Kayttaja(Nimi, Salasana, Sahkoposti)
VALUES('Pekka', 'asdasd', 'palo@auto.com');

INSERT INTO Kayttaja(Nimi, Salasana, Sahkoposti)
VALUES('Kalle', 'asdasd', 'palo@auto.com');

INSERT INTO Kayttaja(Nimi, Salasana, Sahkoposti)
VALUES('Plöö', 'asdasd', 'palo@auto.com');

INSERT INTO Kayttaja(Nimi, Salasana, Sahkoposti)
VALUES('Plää', 'asdasd', 'palo@auto.com');

INSERT INTO Viesti(AiheID, Aloitusviesti, Kirjoitusaika, viestin_sisalto, kirjoittaja, otsikko)
VALUES(1, TRUE, current_timestamp, 'AAAAAAAAAAAAAAA', 1, 'TESTIAIHE');

INSERT INTO Viesti(AiheID, Aloitusviesti, Kirjoitusaika, viestin_sisalto, kirjoittaja, otsikko)
VALUES(1, TRUE, current_timestamp, 'sdfsdfvfv', 1, 'TESTIAasdasdasIHE');

INSERT INTO Viesti(AiheID, Aloitusviesti, Kirjoitusaika, viestin_sisalto, kirjoittaja, otsikko)
VALUES(1, TRUE, current_timestamp, 'AAAAAAAsfdvdfbdgrtnAAAAAAAA', 1, 'zxczxc');

INSERT INTO Viesti(AiheID, Aloitusviesti, Kirjoitusaika, viestin_sisalto, kirjoittaja, otsikko)
VALUES(1, TRUE, current_timestamp, 'AAAAAAAAFDAFAAAAAAAA', 1, 'TESTIAIHE');

INSERT INTO Viesti(AiheID, Aloitusviesti, Kirjoitusaika, viestin_sisalto, kirjoittaja, otsikko)
VALUES(1, TRUE, current_timestamp, 'AFAEFE', 1, 'TESTIAIHE');

INSERT INTO Viesti(AiheID, Aloitusviesti, Kirjoitusaika, viestin_sisalto, kirjoittaja, otsikko)
VALUES(1, TRUE, current_timestamp, 'zxczxc', 1, 'TESTIAIHE');
