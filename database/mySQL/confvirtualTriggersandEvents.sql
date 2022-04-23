use confvirtual;

DELIMITER $$
DROP PROCEDURE IF EXISTS  aggiungiSponsorizzazione $$
CREATE PROCEDURE aggiungiSponsorizzazione(IN in_importo double, IN in_annoEdizioneConferenza year, IN in_acronimoConferenza varchar(10), IN in_nomeSponsor varchar(50))
BEGIN
	INSERT INTO sponsorizzazioni(importo, annoEdizioneConferenza, acronimoConferenza, nomeSponsor) VALUES(in_importo, in_annoEdizioneConferenza, in_acronimoConferenza, in_nomeSponsor);
END$$
DELIMITER ;

#TRIGGER DI AGGIUNTA SPONSOR NELLA LISTA DEGLI SPONSOR DOPO AVER AGGIUNTO UNA SPONSORIZZAZIONE TRAMITE PROCEDURE

CALL aggiungiSponsorizzazione(1000, 2020, 'inf', 'Red Bull'); #non si può aggiungere il nomeSponsor perchè, essendo foreign key, non è presente nella tabella sponsor che contiene la primary key

-- DELIMITER $$
-- CREATE TRIGGER aggiuntaSponsor
-- AFTER UPDATE ON sponsorizzazioni
-- FOR EACH ROW
-- BEGIN
-- 	SELECT nomeSponsor FROM sponsorizzazioni WHERE sponsor.nome != sponsorizzazioni.nomeSponsor;
-- 	INSERT INTO sponsor(nome) VALUES(sponsorizzazioni.nomeSponsor);
-- END$$
-- DELIMITER ;

#creare un evento schedulato che controlli che tutte le date più recenti (MAX) di tutte le conferenze esistenti siano più vecchie di un giorno rispetto alla data corrente (CURRENT_TIMESTAMP())
-- CREATE EVENT cambioStatoConferenza
-- ON SCHEDULE