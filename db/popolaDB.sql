USE spotted;

INSERT INTO TIPI_UTENTI (nomeTipo) VALUES 
('admin'),
('utente');

INSERT INTO UTENTI (username, nome, cognome, password, stato, idTipo, fotoProfilo) VALUES 
('admin', 'Massimo', 'Decimo', '$2y$10$K2Jdvdl4Jegtwk5ufgFoDuE1W5s9malDt.8rwuSGXQzMlYtv7o6Cy', 'attivo', 1, 'default.png'),
('zleo24', 'Luca', 'Rossi', '$2y$10$K2Jdvdl4Jegtwk5ufgFoDuE1W5s9malDt.8rwuSGXQzMlYtv7o6Cy', 'attivo', 2, 'default.png'),   
('steppo04', 'Giulia', 'Bianchi', '$2y$10$K2Jdvdl4Jegtwk5ufgFoDuE1W5s9malDt.8rwuSGXQzMlYtv7o6Cy', 'attivo', 2, 'default.png'),
('giaguaro04', 'Leone', 'Bianchi', '$2y$10$K2Jdvdl4Jegtwk5ufgFoDuE1W5s9malDt.8rwuSGXQzMlYtv7o6Cy', 'attivo', 2, 'default.png'),
('utentebloccato', 'Marco', 'Neri', '$2y$10$K2Jdvdl4Jegtwk5ufgFoDuE1W5s9malDt.8rwuSGXQzMlYtv7o6Cy', 'bloccato', 2, 'default.png');   

INSERT INTO CATEGORIE (nome) VALUES 
('Info Aule'), 
('Oggetti Smarriti'), 
('Info Universitarie');

INSERT INTO SOTTOCATEGORIE (nome, idCategoria) VALUES 
('Biblioteca', 1),
('Mensa', 1),
('Aula Studio', 1),
('Elettronica', 2),
('Libri/Appunti', 2),
('Esami', 3);

INSERT INTO SPOT (titolo, testo, stato, idCategoria, idSottoCategoria, usernameUtente, usernameAdminApprovato, dataApprovazione) 
VALUES 
('Aula Biblioteca', 'La polivalente è disponibile?', 'approvato', 1, 1, 'zleo24', 'admin', NOW());

INSERT INTO SPOT (titolo, testo, stato, idCategoria, idSottoCategoria, usernameUtente, usernameAdminApprovato, dataApprovazione) 
VALUES 
('Spotto ragazza', 'Chi è la ragazza che si trova sempre in polivalente?', 'approvato', 1, 1, 'zleo24', 'admin', NOW());

INSERT INTO SPOT (titolo, testo, stato, idCategoria, idSottoCategoria, usernameUtente, usernameAdminApprovato, dataApprovazione) 
VALUES 
('Spotto GymBro', 'Qualcuno vuole venire con me in palestra? ', 'approvato', 1, 1, 'zleo24', 'admin', NOW());


INSERT INTO SPOT (titolo, testo, stato, idCategoria, idSottoCategoria, usernameUtente, usernameAdminApprovato, dataApprovazione) 
VALUES 
('Perso iPhone', 'Ho dimenticato il mio iPhone nero in mensa verso le 13:00. Aiuto!', 'in_attesa', 2, 4, 'giaguaro04', NULL, NULL);

INSERT INTO SPOT (titolo, testo, stato, idCategoria, idSottoCategoria, usernameUtente, usernameAdminApprovato, dataApprovazione) 
VALUES 
('Domanda esame Basi di Dati', 'Qualcuno sa se il prof accetta i diagrammi fatti a mano?', 'approvato', 3, 6, 'steppo04', 'admin', NOW());

INSERT INTO SPOT (titolo, testo, stato, idCategoria, idSottoCategoria, usernameUtente, usernameAdminApprovato, dataApprovazione) 
VALUES 
('Offerta illegale', 'Vendo risposte esame a 5 euro...', 'rifiutato', 3, 6, 'utentebloccato', 'admin', NOW());
INSERT INTO COMMENTI (testo, idSpot, usernameUtente) 
VALUES 
('Forse ero io, stavo studiando lì!', 1, 'zleo24');

INSERT INTO COMMENTI (testo, idSpot, usernameUtente, idCommentoRisposto) 
VALUES 
('Scrivimi in privato!', 1, 'steppo04', 1);

INSERT INTO PREFERITI (usernameUtente, idSpot) VALUES 
('zleo24', 1),
('steppo04', 3);

