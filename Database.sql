/*CREAZIONE STRUTTURA DB*/

-- Creazione del database
CREATE DATABASE IF NOT EXISTS Sondaggi24;

-- Seleziona il database
USE Sondaggi24;

-- Creazione delle tabelle
CREATE TABLE Utente (
    email VARCHAR(255) PRIMARY KEY,
    `password` VARCHAR(255),
    nome VARCHAR(255),
    cognome VARCHAR(255),
    anno INT,
    luogoNascita VARCHAR(255),
    totaleBonus DECIMAL(10,2)
);

CREATE TABLE Premio (
    nome VARCHAR(255) PRIMARY KEY,
    descrizione TEXT,
    foto VARCHAR(255),
    punti INT
);

CREATE TABLE Storico (
    email VARCHAR(255),
    nome VARCHAR(255),
    FOREIGN KEY (email) REFERENCES Utente(email),
    FOREIGN KEY (nome) REFERENCES Premio(nome)
);

CREATE TABLE Amministratore (
    email VARCHAR(255) PRIMARY KEY,
    FOREIGN KEY (email) REFERENCES Utente(email)
);

CREATE TABLE Premium (
    email VARCHAR(255),
    costo DECIMAL(10,2),
    numSondaggi INT,
    dataInizioAbbonamento DATE,
    dataFineAbbonamento DATE,
    FOREIGN KEY (email) REFERENCES Utente(email)
);

-- -- --
CREATE TABLE Domanda (
    id INT PRIMARY KEY AUTO_INCREMENT,
    testo TEXT,
    punteggio INT,
    foto VARCHAR(255)
);
CREATE INDEX idx_domanda_id ON Domanda(id);

-- -- --

CREATE TABLE Aperta (
    id INT,
    risposta TEXT,
    FOREIGN KEY (id) REFERENCES Domanda(id)
);

CREATE TABLE Chiusa (
    id INT,
    FOREIGN KEY (id) REFERENCES Domanda(id)
);

CREATE TABLE Opzione (
   id INT AUTO_INCREMENT,
   numProgressivo INT PRIMARY KEY,
    testo TEXT,
    idOpzione INT ,
    FOREIGN KEY (id) REFERENCES Chiusa(id)
);

CREATE TABLE Inserimento (
    email VARCHAR(255),
    nome VARCHAR(255),
    FOREIGN KEY (email) REFERENCES Amministratore(email),
    FOREIGN KEY (nome) REFERENCES Premio(nome)
);

CREATE TABLE Interesse (
    email VARCHAR(255),
    parolaChiave VARCHAR(255),
    FOREIGN KEY (email) REFERENCES Utente(email),
    FOREIGN KEY (parolaChiave) REFERENCES Sondaggio(parolaChiave)
);

-- -- --

CREATE TABLE Sondaggio (
    codice INT AUTO_INCREMENT PRIMARY KEY,
    Dominio VARCHAR(255),
    descrizione TEXT,
    titolo VARCHAR(255),
    dataCreazione DATE,
    maxUtenti INT,
    stato VARCHAR(255),
    dataChiusura DATE,
    UNIQUE (codice, Dominio)
);
CREATE INDEX idx_sondaggio_codice_dominio ON Sondaggio(Dominio, codice);

-- -- --

CREATE TABLE Invito (
    id INT PRIMARY KEY,
    email VARCHAR(255),
    Dominio VARCHAR(255),
    esito VARCHAR(255),
    FOREIGN KEY (email) REFERENCES Utente(email),
    FOREIGN KEY (Dominio) REFERENCES Sondaggio(Dominio)
);

CREATE TABLE Contenuto (
    Dominio VARCHAR(255),
    codice VARCHAR(255),
    id INT,
    FOREIGN KEY (Dominio, codice) REFERENCES Sondaggio(Dominio, codice),
    FOREIGN KEY (id) REFERENCES Domanda(id)
);



CREATE TABLE Azienda (
    codFiscale VARCHAR(255) PRIMARY KEY,
    sede VARCHAR(255)
);

CREATE TABLE Creazione (
    codFiscale VARCHAR(255),
    Dominio VARCHAR(255),
    codice VARCHAR(255),
    email VARCHAR(255),
    FOREIGN KEY (codFiscale) REFERENCES Azienda(codFiscale),
    FOREIGN KEY (Dominio, codice) REFERENCES Sondaggio(Dominio, codice),
    FOREIGN KEY (email) REFERENCES Premium(email)
);

CREATE TABLE InserimentoDomanda (
    codFiscale VARCHAR(255),
    id INT,
    email VARCHAR(255),
    FOREIGN KEY (codFiscale) REFERENCES Azienda(codFiscale),
    FOREIGN KEY (id) REFERENCES Domanda(id),
    FOREIGN KEY (email) REFERENCES Premium(email)
);

/*FINE STRUTTURA DB*/

-- Verifica se le tabelle sono già popolate
SELECT COUNT(*) AS count_Utente FROM Utente;
SELECT COUNT(*) AS count_Premio FROM Premio;
SELECT COUNT(*) AS count_Domanda FROM Domanda;
SELECT COUNT(*) AS count_Azienda FROM Azienda;


/*codice di popolamento solo se le tabelle sono vuote*/
IF count_Utente = 0 AND count_Premio = 0 AND count_Domanda = 0 AND count_Azienda = 0

THEN

                /*POPOLAMENTO TABELLE*/

-- Popolamento della tabella Utente
INSERT INTO Utente (email, nome, cognome, anno, luogoNascita, totaleBonus)
VALUES
    ('utente1@example.com', 'Mario', 'Rossi', 1990, 'Roma', 100.00),
    ('utente2@example.com', 'Laura', 'Bianchi', 1985, 'Milano', 50.00),
    ('utente3@example.com', 'Giuseppe', 'Verdi', 1982, 'Napoli', 75.00),
    ('utente4@example.com', 'Anna', 'Gialli', 1995, 'Firenze', 30.00),
    ('utente5@example.com', 'Luigi', 'Neri', 1998, 'Torino', 80.00);

-- Popolamento della tabella Premio
INSERT INTO Premio (nome, descrizione, foto, punti)
VALUES
    ('Premio1', 'Descrizione premio 1', 'foto1.jpg', 100),
    ('Premio2', 'Descrizione premio 2', 'foto2.jpg', 50),
    ('Premio3', 'Descrizione premio 3', 'foto3.jpg', 75),
    ('Premio4', 'Descrizione premio 4', 'foto4.jpg', 30),
    ('Premio5', 'Descrizione premio 5', 'foto5.jpg', 80);

-- Popolamento della tabella Domanda
INSERT INTO Domanda (id, testo, punteggio, foto)
VALUES
    (1, 'Testo domanda 1', 10, 'foto_domanda1.jpg'),
    (2, 'Testo domanda 2', 5, 'foto_domanda2.jpg'),
    (3, 'Testo domanda 3', 8, 'foto_domanda3.jpg'),
    (4, 'Testo domanda 4', 3, 'foto_domanda4.jpg'),
    (5, 'Testo domanda 5', 7, 'foto_domanda5.jpg');

-- Popolamento della tabella Azienda
INSERT INTO Azienda (codFiscale, sede)
VALUES
    ('1234567890', 'Milano'),
    ('0987654321', 'Roma'),
    ('4567890123', 'Firenze'),
    ('9876543210', 'Napoli'),
    ('5678901234', 'Torino');

                /*FINE POPOLAMENTO TABELLE*/
END IF;

    /*STORED PROCEDURES*/

    /*INSERIMENTO UTENTE GENERICO*/

    DELIMITER //
CREATE PROCEDURE CreazioneUtente(
    IN p_email VARCHAR(255),
    IN p_password VARCHAR(255),
    IN p_nome VARCHAR(255),
    IN p_cognome VARCHAR(255),
    IN p_anno INT,
    IN p_luogoNascita VARCHAR(255)
)
BEGIN
    INSERT INTO Utente (email, password, nome, cognome, anno, luogoNascita, totaleBonus)
    VALUES (p_email,p_password, p_nome, p_cognome, p_anno, p_luogoNascita, 0);
    
    SELECT LAST_INSERT_ID() AS new_user_id;
END //
DELIMITER ;


    /*INSERIMENTO UTENTE PREMIUM O AMMINISTRATORE*/

DELIMITER //

CREATE PROCEDURE InserisciUtente(
    IN p_email VARCHAR(255),
    IN p_nome VARCHAR(255),
    IN p_cognome VARCHAR(255),
    IN p_anno INT,
    IN p_luogoNascita VARCHAR(255),
    IN p_ruolo VARCHAR(10),
    IN p_costo DECIMAL(10,2),
    IN p_numSondaggi INT,
    IN p_dataInizioAbbonamento DATE,
    IN p_dataFineAbbonamento DATE
)
BEGIN
    -- Inserimento nella tabella Utente
    INSERT INTO Utente (email, nome, cognome, anno, luogoNascita, totaleBonus)
    VALUES (p_email, p_nome, p_cognome, p_anno, p_luogoNascita, 0);

    -- Verifica del ruolo
    IF p_ruolo = 'amministratore' THEN
        -- Inserimento nella tabella Amministratore
        INSERT INTO Amministratore (email)
        VALUES (p_email);
    ELSEIF p_ruolo = 'premium' THEN
        -- Inserimento nella tabella Premium
        INSERT INTO Premium (email, costo, numSondaggi, dataInizioAbbonamento, dataFineAbbonamento)
        VALUES (p_email, p_costo, p_numSondaggi, p_dataInizioAbbonamento, p_dataFineAbbonamento);
    END IF;
END //

DELIMITER;

    /*INSERIMENTO UTENTE AZIENDA*/

DELIMITER //

CREATE PROCEDURE InserisciAzienda(
    IN p_codFiscale VARCHAR(255),
    IN p_sede VARCHAR(255)
)
BEGIN
    INSERT INTO Azienda (codFiscale, sede)
    VALUES (p_codFiscale, p_sede);
END //

DELIMITER ;


    /*INSERIMENTO DOMANDA APERTA*/

DELIMITER //

CREATE PROCEDURE CreazioneDomandaAperta (
    IN p_dominio VARCHAR(255),
    IN p_codice INT,
    IN p_testo TEXT,
    IN p_punteggio INT,
    IN p_foto VARCHAR(255)
)
BEGIN
    -- Inserimento della domanda nella tabella Domanda
    INSERT INTO Domanda (testo, punteggio, foto) VALUES (p_testo, p_punteggio, p_foto);

    -- Recupero dell'ID della domanda appena creata
    SET @new_domandaID = LAST_INSERT_ID();
    
    -- Inserimento della domanda aperta nella tabella Aperta
    INSERT INTO Aperta (id) VALUES (@new_domandaID);

    INSERT INTO Contenuto (dominio, codice, id) VALUES (p_dominio, p_codice, @new_domandaID);
    
    -- Restituzione dell'ID della domanda appena creata
    SELECT @new_domandaID AS new_domandaID;
END //

DELIMITER ;


    /*INSERIMENTO DOMANDA CHIUSA*/
DELIMITER //

CREATE PROCEDURE CreazioneDomandaChiusa (
    IN p_dominio VARCHAR(255),
    IN p_codice INT,
    IN p_testo VARCHAR(255),
    IN p_punteggio INT,
    IN p_foto VARCHAR(255),
    IN p_testo_opzione1 VARCHAR(255),
    IN p_testo_opzione2 VARCHAR(255),
    IN p_testo_opzione3 VARCHAR(255)
)
BEGIN
    DECLARE v_domanda_id INT;
    
    -- Inserimento dei dati nella tabella Domanda
    INSERT INTO Domanda (testo, punteggio, foto)
    VALUES (p_testo, p_punteggio, p_foto);

    -- Recupero dell'ID della domanda appena creata
    SET @new_domandaID = LAST_INSERT_ID();

    -- Inserimento delle opzioni nella tabella Opzione
    INSERT INTO Opzione (numProgressivo, testo, idOpzione)
    VALUES (1, p_testo_opzione1, v_domanda_id),
           (2, p_testo_opzione2, v_domanda_id),
           (3, p_testo_opzione3, v_domanda_id);

    INSERT INTO Contenuto (dominio, codice, id) VALUES (p_dominio, p_codice, @new_domandaID);    

    SELECT @new_domanda_ID AS new_domanda_ID;
END;

DELIMITER ;


    /*CREAZIONE SONDAGGIO*/

DELIMITER //

CREATE PROCEDURE CreazioneSondaggio(
    IN p_parolaChiave VARCHAR(255),
    IN p_titolo VARCHAR(255),
    IN p_descrizione TEXT,
    IN p_dataCreazione DATE,
    IN p_dataChiusura DATE,
    IN p_maxUtenti INT,
    IN p_stato VARCHAR(255)
)
BEGIN
    INSERT INTO Sondaggio (Dominio, titolo, descrizione, dataCreazione, dataChiusura, maxUtenti, stato)
    VALUES (p_parolaChiave, p_titolo, p_descrizione, p_dataCreazione, p_dataChiusura, p_maxUtenti, p_stato);
END //

DELIMITER ;

    /*INSERISCI PREMIO*/

DELIMITER //

CREATE PROCEDURE InserisciPremio(
    IN nome VARCHAR(255),
    IN descrizione TEXT,
    IN foto VARCHAR(255),
    IN punti INT
)
BEGIN
    INSERT INTO Premio (nome, descrizione, foto, punti)
    VALUES (nome, descrizione, foto, punti);
END //

DELIMITER ;
