use confvirtual;

SET GLOBAL EVENT_SCHEDULER = ON;

DELIMITER $$
DROP EVENT IF EXISTS cambioStatoConferenza $$
CREATE EVENT cambioStatoConferenza
ON SCHEDULE EVERY 1 MINUTE
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
DROP TRIGGER IF EXISTS contatorePresentazioni $$
CREATE TRIGGER contatorePresentazioni AFTER INSERT ON presentazione
FOR EACH ROW
BEGIN
UPDATE sessione
SET numeroPresentazioni = (SELECT count(codiceSessione) FROM presentazione WHERE sessione.codice = presentazione.codiceSessione GROUP BY codiceSessione);
END$$
DELIMITER ;