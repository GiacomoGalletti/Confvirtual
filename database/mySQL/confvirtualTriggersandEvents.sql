use confvirtual;

SET GLOBAL EVENT_SCHEDULER = ON;

DELIMITER $$
DROP EVENT IF EXISTS cambioStatoConferenza $$
CREATE EVENT cambioStatoConferenza
ON SCHEDULE EVERY 1 DAY STARTS '2015-06-21 00:20:00'
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
DROP EVENT IF EXISTS eliminaFavoritiPassati $$
CREATE EVENT eliminaFavoritiPassati
    ON SCHEDULE EVERY 1 hour STARTS '2015-06-21 00:01:00'
    DO
    BEGIN
        DELETE FROM presentazionefavorita
        WHERE presentazionefavorita.codiceSessione
        IN (
            SELECT sessione.codice
            FROM sessione,presentazione
            where sessione.codice = presentazione.codiceSessione and presentazione.oraFine < CURRENT_TIME AND sessione.giornoData <= CURRENT_DATE
        );
    END $$
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

DELIMITER $$
DROP TRIGGER IF EXISTS aggiornaTotSponsorizzazioniOnInsert $$
CREATE TRIGGER aggiornaTotSponsorizzazioniOnInsert AFTER INSERT ON sponsorizzazioni
FOR EACH ROW
BEGIN
	declare anno year;
    declare acr varchar(10);
    declare done int default 0;
    
    declare cursoreAnnoEdizione cursor for select annoEdizione from conferenza;
    declare cursoreAcronimo cursor for select acronimo from conferenza;
    declare continue handler for not found set done=1;
    
    open cursoreAnnoEdizione;
    open cursoreAcronimo;
    
    repeat
		fetch cursoreAnnoEdizione into anno;
        fetch cursoreAcronimo into acr;
        
        update conferenza
		set totaleSponsorizzazioni = (select count(*) from sponsorizzazioni where annoEdizioneConferenza = anno and acronimoConferenza = acr)
		where conferenza.annoEdizione = anno and conferenza.acronimo = acr;
    until done=1 end repeat;
    
    close cursoreAnnoEdizione;
    close cursoreAcronimo;
END$$
DELIMITER ;

DELIMITER $$
DROP TRIGGER IF EXISTS aggiornaTotSponsorizzazioniOnDelete $$
CREATE TRIGGER aggiornaTotSponsorizzazioniOnDelete AFTER DELETE ON sponsorizzazioni
FOR EACH ROW
BEGIN
	declare anno year;
    declare acr varchar(10);
    declare done int default 0;
    
    declare cursoreAnnoEdizione cursor for select annoEdizione from conferenza;
    declare cursoreAcronimo cursor for select acronimo from conferenza;
    declare continue handler for not found set done=1;
    
    open cursoreAnnoEdizione;
    open cursoreAcronimo;
    
    repeat
		fetch cursoreAnnoEdizione into anno;
        fetch cursoreAcronimo into acr;
        
        update conferenza
		set totaleSponsorizzazioni = (select count(*) from sponsorizzazioni where annoEdizioneConferenza = anno and acronimoConferenza = acr)
		where conferenza.annoEdizione = anno and conferenza.acronimo = acr;
    until done=1 end repeat;
    
    close cursoreAnnoEdizione;
    close cursoreAcronimo;
END$$
DELIMITER ;