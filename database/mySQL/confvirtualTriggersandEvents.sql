use confvirtual;

SET GLOBAL EVENT_SCHEDULER = ON;

DELIMITER $$
DROP EVENT IF EXISTS cambioStatoConferenza $$
CREATE EVENT cambioStatoConferenza
ON SCHEDULE EVERY 1 second
DO
BEGIN
UPDATE conferenza INNER JOIN dataconferenza ON conferenza.annoEdizione = dataconferenza.annoEdizioneConferenza AND conferenza.acronimo = dataconferenza.acronimoConferenza
    SET conferenza.statoSvolgimento = 'completata'
WHERE CURRENT_DATE > (
    SELECT MAX(giorno) FROM dataconferenza WHERE acronimo = acronimoConferenza AND annoEdizione = annoEdizioneConferenza
    );
END$$
DELIMITER ;

DELIMITER $$
DROP TRIGGER IF EXISTS contatorePresentazioniOnInsert $$
CREATE TRIGGER contatorePresentazioniOnInsert AFTER INSERT ON presentazione
FOR EACH ROW
BEGIN
    UPDATE sessione
    SET numeroPresentazioni = (
        SELECT count(codiceSessione)
        FROM presentazione
        WHERE sessione.codice = presentazione.codiceSessione);
END$$
DELIMITER ;

DELIMITER $$
DROP TRIGGER IF EXISTS contatorePresentazioniOnDelete $$
CREATE TRIGGER contatorePresentazioniOnDelete AFTER DELETE ON presentazione
    FOR EACH ROW
BEGIN
    UPDATE sessione
    SET numeroPresentazioni = (
        SELECT count(codiceSessione)
        FROM presentazione
        WHERE sessione.codice = presentazione.codiceSessione);
END$$
DELIMITER ;

#CREARE UN TRIGGER CHE IMPLEMENTI L'OPERAZIONE DI CAMBIO DI STATO_SVOLGIMENTO DI UNA PRESENTAZIONE DI ARTICOLO, PORTANDOLO DA NON COPERTO A COPERTO
DELIMITER $$
DROP TRIGGER IF EXISTS cambioStatoArticolo $$
CREATE TRIGGER cambioStatoArticolo AFTER INSERT ON presentazionepresenter
FOR EACH ROW
BEGIN
	UPDATE articolo, presentazionepresenter
    SET articolo.statoSvolgimento = 'coperto' WHERE articolo.codiceSessione = presentazionepresenter.codiceSessione AND articolo.codicePresentazione = presentazionepresenter.codicePresentazione;
END$$
DELIMITER ;