CREATE DATABASE IF NOT EXISTS Convention;
USE Convention;
CREATE TABLE IF NOT EXISTS Piano(
    Numero CHAR(3) NOT NULL,
    PRIMARY KEY(Numero)
);
CREATE TABLE IF NOT EXISTS Sala(
    NomeSala VARCHAR(20) NOT NULL,
    NpostiSala INT(3) NULL,
    Numero_fk CHAR(3) NULL,
    FOREIGN KEY(Numero_fk) REFERENCES Piano(Numero) ON DELETE CASCADE,
    PRIMARY KEY(NomeSala)
);
CREATE TABLE IF NOT EXISTS Speech(
    IDSpeech INT(3) NOT NULL AUTO_INCREMENT,
    Titolo VARCHAR(100) NULL,
    Argomento VARCHAR(100) NULL,
    PRIMARY KEY(IDSpeech)
);
CREATE TABLE IF NOT EXISTS Azienda(
    RagioneSocialeAzienda VARCHAR(30) NOT NULL,
    Nome VARCHAR(30) NULL,
    IndirizzoAzienda VARCHAR(60) NULL,
    TelefonoAzienda CHAR(10) NULL,
    PRIMARY KEY(RagioneSocialeAzienda)
);
CREATE TABLE IF NOT EXISTS Relatore(
    IDRel INT(3) NOT NULL AUTO_INCREMENT,
    NomeRel VARCHAR(20) NULL,
    CognomeRel VARCHAR(20) NULL,
    RSAzienda_fk VARCHAR(30) NULL,
    PRIMARY KEY (IDRel),
    FOREIGN KEY(RSAzienda_fk) REFERENCES Azienda(RagioneSocialeAzienda) ON DELETE CASCADE
);
CREATE TABLE IF NOT EXISTS Programma(
    IDProgramma INT(3) NOT NULL AUTO_INCREMENT,
    FasciaOraria TIME NULL,
    IDSpeech_fk INT(3) NULL,
    NomeSala_fk VARCHAR(20) NULL,
    FOREIGN KEY(IDSpeech_fk) REFERENCES Speech(IDSpeech),
    FOREIGN KEY(NomeSala_fk) REFERENCES Sala(NomeSala),
    PRIMARY KEY(IDProgramma)
);
CREATE TABLE IF NOT EXISTS Partecipante(
    IDPart INT(3) NOT NULL AUTO_INCREMENT,
    NomePart VARCHAR(20) NULL,
    CognomePart VARCHAR(20) NULL,
    TipologiaPart VARCHAR(20) NULL,
    PRIMARY KEY(IDPart)
);
CREATE TABLE IF NOT EXISTS Sceglie(
    IDProgramma_fk INT(3) NOT NULL,
    IDPart_fk INT(3) NOT NULL,
    PRIMARY KEY(IDProgramma_fk,IDPart_fk),
    FOREIGN KEY(IDProgramma_fk) REFERENCES Programma(IDProgramma),
    FOREIGN KEY(IDPart_fk) REFERENCES Partecipante(IDPart)
);
CREATE TABLE IF NOT EXISTS Relaziona(
    IDProgramma_fk INT(3) NOT NULL,
    IDRel_fk INT(3) NOT NULL,
    PRIMARY KEY(IDProgramma_fk,IDRel_fk),
    FOREIGN KEY(IDProgramma_fk) REFERENCES Programma(IDProgramma),
    FOREIGN KEY(IDRel_fk) REFERENCES Relatore(IDRel)
);
CREATE TABLE IF NOT EXISTS User(
    Id_user INT(3) NOT NULL AUTO_INCREMENT,
    Mail VARCHAR(30) NULL,
    Password_user CHAR(64) NULL,
    IDPart_fk INT(3) NULL,
    IDRel_fk INT(3) NULL,
    FOREIGN KEY(IDRel_fk) REFERENCES Relatore(IDRel) ON DELETE CASCADE,
    FOREIGN KEY(IDPart_fk) REFERENCES Partecipante(IDPart) ON DELETE CASCADE,
    PRIMARY KEY(Id_user)
);
CREATE VIEW PostiRimastiPerFasciaOraria AS
SELECT p.IDProgramma,
       p.FasciaOraria,
       s.NomeSala,
       s.NpostiSala - COUNT(sc.IDPart_fk) AS PostiRimasti
FROM Programma p
JOIN Sala s ON p.NomeSala_fk = s.NomeSala
LEFT JOIN Sceglie sc ON p.IDProgramma = sc.IDProgramma_fk
GROUP BY p.IDProgramma, p.FasciaOraria, s.NomeSala;
