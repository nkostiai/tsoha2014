CREATE TABLE kategoria(
KategoriaID SERIAL primary key, --kategorian yksilollinen tunniste
Nimi varchar(30) not null, --kategorian nimi
Kuvaus varchar(300) not null);--kategorian kuvaus

CREATE TABLE aihe(
AiheID SERIAL primary key, --aiheen yksilollinen tunniste
KategoriaID INTEGER REFERENCES kategoria(kategoriaid), --kategoria, johon aihe kuuluu
Nimi varchar(300) not null); --Aiheen nimi

CREATE TABLE kayttaja(
KayttajaID SERIAL primary key, --kayttajan yksiloiva ID
Nimi VARCHAR(20) NOT NULL, --Kayttajan kayttajanimi
Salasana VARCHAR(36) NOT NULL, --Kayttajan salasana
Adminstatus BOOLEAN NOT NULL default FALSE); --onko kayttaja yllapitaja

CREATE TABLE viesti(
ViestiID SERIAL primary key, --viestin yksilollinen tunniste
AiheID INTEGER REFERENCES aihe(AiheID), --aihe, johon viesti kuuluu
Kirjoitusaika TIMESTAMP NOT NULL, --Koska viesti on kirjoitettu
Viimeisin_muokkaus TIMESTAMP, --Koska viestia on viimeksi muokattu
viestin_sisalto VARCHAR(4000) NOT NULL, --Viestin tekstuaalinen sisalto
Kirjoittaja INTEGER REFERENCES kayttaja(kayttajaID), --Viestin kirjoittanut kayttaja.
otsikko VARCHAR(300) NOT NULL);--Viestin otsikko.

CREATE TABLE luetut(
kayttajaid integer references kayttaja(kayttajaid) ON UPDATE CASCADE ON DELETE CASCADE,
viestiid integer references viesti(viestiid) ON UPDATE CASCADE ON DELETE CASCADE, 
CONSTRAINT viesti_kayttajaid PRIMARY KEY (kayttajaid, viestiid)
);

