USE Convention;
-- Inserimento dati per la tabella Piano
INSERT INTO Piano (Numero) VALUES
('001'), ('002'), ('003'), ('004'), ('005'),
('006'), ('007'), ('008'), ('009'), ('010');

-- Inserimento dati per la tabella Sala
INSERT INTO Sala (NomeSala, NpostiSala, Numero_fk) VALUES
('Sala A', 50, '001'),
('Sala B', 30, '002'),
('Sala C', 100, '003'),
('Sala D', 20, '004'),
('Sala E', 80, '005'),
('Sala F', 40, '006'),
('Sala G', 60, '007'),
('Sala H', 70, '008'),
('Sala I', 25, '009'),
('Sala J', 90, '010');

-- Inserimento dati per la tabella Speech
INSERT INTO Speech (Titolo, Argomento) VALUES
('Introduzione all evento', 'Presentazione generale della convention'),
('Tendenze nel settore tecnologico', 'Nuove tecnologie emergenti'),
('Strategie di marketing digitale', 'Come promuovere il proprio brand online'),
('Sostenibilità ambientale nelle aziende', 'Riduzione dell impatto ambientale'),
('Gestione delle risorse umane', 'Migliorare la produttività e la soddisfazione dei dipendenti'),
('Innovazioni nel settore sanitario', 'Nuove scoperte e trattamenti medici'),
('Impatto dell intelligenza artificiale sull industria', 'Applicazioni pratiche e prospettive future'),
('Cybersecurity: sfide e soluzioni', 'Protezione dai rischi informatici'),
('Gestione dell innovazione', 'Strategie per sviluppare nuovi prodotti e servizi'),
('Leadership e sviluppo personale', 'Abilità di leadership e crescita personale');

-- Inserimento dati per la tabella Azienda
INSERT INTO Azienda (RagioneSocialeAzienda, IndirizzoAzienda, TelefonoAzienda) VALUES
('ABC Srl', 'Via Roma 123', '0123456789'),
('XYZ Spa', 'Corso Italia 456', '0987654321'),
('DEF Srl', 'Piazza Garibaldi 789', '0345678901'),
('GHI Spa', 'Via Dante 1011', '0456789012'),
('MNO Srl', 'Corso Vittorio Emanuele 1213', '0567890123'),
('PQR Spa', 'Piazza Duomo 1415', '0678901234'),
('STU Srl', 'Via Milano 1617', '0789012345'),
('VWX Spa', 'Corso Venezia 1819', '0890123456'),
('YZA Srl', 'Piazza San Carlo 2021', '0901234567'),
('KLM Spa', 'Via Po 2223', '0912345678');

-- Inserimento dati per la tabella Relatore
INSERT INTO Relatore (NomeRel, CognomeRel, RSAzienda_fk) VALUES
('Mario', 'Rossi', 'ABC Srl'),
('Laura', 'Bianchi', 'XYZ Spa'),
('Giovanni', 'Verdi', 'DEF Srl'),
('Chiara', 'Neri', 'GHI Spa'),
('Alessandro', 'Bianco', 'MNO Srl'),
('Francesca', 'Verde', 'PQR Spa'),
('Luigi', 'Gialli', 'STU Srl'),
('Martina', 'Rosa', 'VWX Spa'),
('Simone', 'Blu', 'YZA Srl'),
('Sara', 'Arancio', 'KLM Spa');

-- Inserimento dati per la tabella Programma
INSERT INTO Programma (FasciaOraria, IDSpeech_fk, NomeSala_fk) VALUES
('09:00:00', 1, 'Sala A'),
('10:30:00', 2, 'Sala B'),
('12:00:00', 3, 'Sala C'),
('14:00:00', 4, 'Sala D'),
('15:30:00', 5, 'Sala E'),
('17:00:00', 6, 'Sala F'),
('09:00:00', 7, 'Sala G'),
('10:30:00', 8, 'Sala H'),
('12:00:00', 9, 'Sala I'),
('14:00:00', 10, 'Sala J');

-- Inserimento dati per la tabella Partecipante
INSERT INTO Partecipante (NomePart, CognomePart, TipologiaPart) VALUES
('Marco', 'Bianchi', 'Delegato'),
('Anna', 'Rossi', 'Delegato'),
('Luca', 'Verdi', 'Delegato'),
('Elena', 'Neri', 'Delegato'),
('Giorgio', 'Bianco', 'Visitatore'),
('Maria', 'Verde', 'Visitatore'),
('Paolo', 'Gialli', 'Visitatore'),
('Giovanna', 'Rosa', 'Visitatore'),
('Carlo', 'Blu', 'Visitatore'),
('Silvia', 'Arancio', 'Visitatore');

-- Inserimento dati per la tabella Sceglie
INSERT INTO Sceglie (IDProgramma_fk, IDPart_fk) VALUES
(1, 1), (2, 2), (3, 3), (4, 4), (5, 5),
(6, 6), (7, 7), (8, 8), (9, 9), (10, 10);

-- Inserimento dati per la tabella Relaziona
INSERT INTO Relaziona (IDProgramma_fk, IDRel_fk) VALUES
(1, 1), (2, 2), (3, 3), (4, 4), (5, 5),
(6, 6), (7, 7), (8, 8), (9, 9), (10, 10);

-- Inserimento dati per la tabella User
INSERT INTO User (Mail, Password_user, IDPart_fk, IDRel_fk) VALUES
('utente1@example.com', 'password1', 1, NULL),
('utente2@example.com', 'password2', 2, NULL),
('utente3@example.com', 'password3', 3, NULL),
('utente4@example.com', 'password4', 4, NULL),
('relatore1@example.com', 'password5', NULL, 1),
('relatore2@example.com', 'password6', NULL, 2),
('relatore3@example.com', 'password7', NULL, 3),
('relatore4@example.com', 'password8', NULL, 4),
('relatore5@example.com', 'password9', NULL, 5),
('relatore6@example.com', 'password10', NULL, 6);
