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

-- SELECT DATE((ADDDATE(MAX(dataconferenza.giorno), INTERVAL 1 DAY))) FROM dataconferenza;
-- SELECT (CURRENT_DATE());
-- SELECT * FROM conferenza INNER JOIN dataconferenza ON conferenza.annoEdizione = dataconferenza.annoEdizioneConferenza AND conferenza.acronimo = dataconferenza.acronimoConferenza;

-- SHOW FULL PROCESSLIST;

-- ADDDATE(MAX(dataconferenza.giorno), INTERVAL 1 DAY) > (CURRENT_DATE())
-- SELECT ADDDATE(CURRENT_DATE(), INTERVAL 1 DAY);