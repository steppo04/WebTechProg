INSERT INTO TIPI_UTENTI (Nome_tipo) VALUES 
('Amministratore'),
('Utente');

INSERT INTO UTENTI (Username, Nome, Cognome, Password, Stato, Tipo_id) VALUES 
('admin_max', 'Massimo', 'Decimo', 'adminpass123', 'attivo', 1),
('luca_studente', 'Luca', 'Rossi', 'pizza123', 'attivo', 2),   
('giulia_b', 'Giulia', 'Bianchi', 'gatto456', 'attivo', 2),
('troll_account', 'Marco', 'Neri', '123456', 'bloccato', 2);   

INSERT INTO CATEGORIE (Nome) VALUES 
('Aule'), 
('Oggetti Smarriti'), 
('Info Universitarie');

INSERT INTO SOTTOCATEGORIE (Nome, Categoria_id) VALUES 
('Biblioteca', 1),
('Mensa', 1),
('Aula Studio', 1),
('Elettronica', 2),
('Libri/Appunti', 2),
('Esami', 3);

INSERT INTO SPOT (Titolo, Testo_spot, Categoria_id, Sottocategoria_id, Utente_username, Admin_approvatore, Data_approvazione) 
VALUES 
('Aula Biblioteca', 'La polivalente è disponibile?', 1, 1, 'luca_studente', 'admin_max', NOW());

INSERT INTO SPOT (Titolo, Testo_spot, Categoria_id, Sottocategoria_id, Utente_username, Admin_approvatore, Data_approvazione) 
VALUES 
('Perso iPhone', 'Ho dimenticato il mio iPhone nero in mensa verso le 13:00. Aiuto!', 2, 4, 'giulia_b', NULL, NULL);

INSERT INTO SPOT (Titolo, Testo_spot, Categoria_id, Sottocategoria_id, Utente_username, Admin_approvatore, Data_approvazione) 
VALUES 
('Domanda esame Basi di Dati', 'Qualcuno sa se il prof accetta i diagrammi fatti a mano?', 3, 6, 'luca_studente', 'admin_max', NOW());

INSERT INTO COMMENTI (Testo, Spot_id, Utente_username) 
VALUES 
('Forse ero io, stavo studiando lì!', 1, 'giulia_b');

INSERT INTO COMMENTI (Testo, Spot_id, Utente_username, Parent_id) 
VALUES 
('Scrivimi in privato!', 1, 'luca_studente', 1);

INSERT INTO PREFERITI (Utente_username, Spot_id) VALUES 
('giulia_b', 1),
('luca_studente', 3);


