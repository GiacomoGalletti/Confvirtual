#STORED PROCEDURE PER LA VISUALIZZAZIONE DELLE STATISTICHE NELLA HOME PAGE

use confvirtual;

DELIMITER $$
DROP PROCEDURE IF EXISTS contaConferenzeRegistrate $$
CREATE PROCEDURE contaConferenzeRegistrate()
BEGIN
SELECT count(*) AS numConferenzeRegistrate
FROM CONFERENZA;
END $$
DELIMITER ;

DELIMITER $$
DROP PROCEDURE IF EXISTS contaConferenzeAttive $$
CREATE PROCEDURE contaConferenzeAttive()
BEGIN
SELECT count(*) AS numConferenzeAttive
FROM CONFERENZA
WHERE statoSvolgimento = 'attiva';
END $$
DELIMITER ;

DELIMITER $$
DROP PROCEDURE IF EXISTS contaUtentiTotali $$
CREATE PROCEDURE contaUtentiTotali()
BEGIN
SELECT count(*) AS numUtentiTotali
FROM UTENTE;
END $$
DELIMITER ;

DELIMITER $$
DROP PROCEDURE IF EXISTS contaUtentiAmministratori $$
CREATE PROCEDURE contaUtentiAmministratori()
BEGIN
SELECT count(*) AS numUtentiAmministratori
FROM UTENTE
WHERE userName IN (SELECT userNameUtente FROM AMMINISTRATORE);
END $$
DELIMITER ;

DELIMITER $$
DROP PROCEDURE IF EXISTS contaUtentiSpeaker $$
CREATE PROCEDURE contaUtentiSpeaker()
BEGIN
SELECT count(*) AS numUtentiSpeaker
FROM UTENTE
WHERE userName IN (SELECT userNameUtente FROM SPEAKER);
END $$
DELIMITER ;

DELIMITER $$
DROP PROCEDURE IF EXISTS contaUtentiPresenter $$
CREATE PROCEDURE contaUtentiPresenter()
BEGIN
SELECT count(*) AS numUtentiPresenter
FROM UTENTE
WHERE userName IN (SELECT userNameUtente FROM PRESENTER);
END $$
DELIMITER ;