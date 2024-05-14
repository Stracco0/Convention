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
INSERT INTO Azienda (RagioneSocialeAzienda, Nome, IndirizzoAzienda, TelefonoAzienda) VALUES
('Azienda Innovativa Srl', 'Innovativa', 'Via Roma 123', '0123456789'),
('Visione Avanzata Spa', 'Avanzata', 'Corso Italia 456', '0987654321'),
('Eccellenza Tecnologica Srl', 'Eccellenza', 'Piazza Garibaldi 789', '0345678901'),
('Futuro Digitale Spa', 'Futuro Digitale', 'Via Dante 1011', '0456789012'),
('Prospettive Globali Srl', 'Prospettive Globali', 'Corso Vittorio Emanuele 1213', '0567890123'),
('Creatività Illimitata Spa', 'Creatività Illimitata', 'Piazza Duomo 1415', '0678901234'),
('Progresso Tecnologico Srl', 'Progresso', 'Via Milano 1617', '0789012345'),
('Avanzamento Sostenibile Spa', 'Avanzamento Sostenibile', 'Corso Venezia 1819', '0890123456'),
('Soluzioni Creative Srl', 'Soluzioni Creative', 'Piazza San Carlo 2021', '0901234567'),
('Innovazione Continua Spa', 'Innovazione Continua', 'Via Po 2223', '0912345678');

-- Inserimento dati per la tabella Relatore
INSERT INTO Relatore (NomeRel, CognomeRel, RSAzienda_fk) VALUES
('Mario', 'Rossi', 'Azienda Innovativa Srl'),
('Laura', 'Bianchi', 'Visione Avanzata Spa'),
('Giovanni', 'Verdi', 'Eccellenza Tecnologica Srl'),
('Chiara', 'Neri', 'Futuro Digitale Spa'),
('Alessandro', 'Bianco', 'Prospettive Globali Srl'),
('Francesca', 'Verde', 'Creatività Illimitata Spa'),
('Luigi', 'Gialli', 'Progresso Tecnologico Srl'),
('Martina', 'Rosa', 'Avanzamento Sostenibile Spa'),
('Simone', 'Blu', 'Soluzioni Creative Srl'),
('Sara', 'Arancio', 'Innovazione Continua Spa');

-- Inserimento dati per la tabella Programma
INSERT INTO Programma (FasciaOraria, IDSpeech_fk, NomeSala_fk) VALUES
('09:00:00', 1, 'Sala A'),
('10:30:00', 2, 'Sala B'),
('12:00:00', 3, 'Sala C'),
('14:00:00', 4, 'Sala D'),
('15:30:00', 5, 'Sala E'),
('17:00:00', 6, 'Sala F'),
('18:00:00', 7, 'Sala G'),
('19:30:00', 8, 'Sala H'),
('21:00:00', 9, 'Sala I'),
('23:00:00', 10, 'Sala J');

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
('utente1@example.com', SHA2('password1', 256), 1, NULL),
('utente2@example.com', SHA2('password2', 256), 2, NULL),
('utente3@example.com', SHA2('password3', 256), 3, NULL),
('utente4@example.com', SHA2('password4', 256), 4, NULL),
('relatore1@example.com', SHA2('password5', 256), NULL, 1),
('relatore2@example.com', SHA2('password6', 256), NULL, 2),
('relatore3@example.com', SHA2('password7', 256), NULL, 3),
('relatore4@example.com', SHA2('password8', 256), NULL, 4),
('relatore5@example.com', SHA2('password9', 256), NULL, 5),
('relatore6@example.com', SHA2('password10', 256), NULL, 6);

-- Jolly
INSERT INTO Relatore (NomeRel, CognomeRel, RSAzienda_fk) VALUES
('Simone', 'Verdi', 'Azienda Innovativa Srl');

INSERT INTO Partecipante (NomePart, CognomePart, TipologiaPart) VALUES
('Simone', 'Verdi', 'Delegato');

INSERT INTO User (Mail, Password_user, IDPart_fk, IDRel_fk) VALUES
('simone.verdi@example.com', SHA2('password_simone', 256), 11, 11);

INSERT INTO User (Mail, Password_user) VALUES
('admin@admin.com', SHA2('admin', 256));