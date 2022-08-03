DROP VIEW IF EXISTS conferenzevalide;
create view conferenzevalide as ( select * from CONFERENZA where (CONFERENZA.statoSvolgimento = 'attiva'));
DELIMITER $$
DROP PROCEDURE IF EXISTS ritornaIscrizioniConferenze $$
CREATE PROCEDURE ritornaIscrizioniConferenze(IN in_userNameUtente varchar(50))
BEGIN
    select * from conferenzevalide,utenteregistrato where conferenzevalide.acronimo = utenteregistrato.acronimoConferenza and conferenzevalide.annoEdizione = utenteregistrato.annoEdizioneconferenza and in_userNameUtente = utenteregistrato.userNameUtente;
END $$
DELIMITER ;

DROP VIEW IF EXISTS speakerConValutazione;
CREATE VIEW speakerConValutazione(userName, codiceSessione, codicePresentazione) AS
SELECT userNameUtente, codiceSessione, codicePresentazione
FROM PRESENTAZIONESPEAKER
WHERE (codiceSessione, codicePresentazione) IN (SELECT codiceSessione, codicePresentazione FROM VALUTAZIONE);

DROP VIEW IF EXISTS presenterConValutazione;
CREATE VIEW presenterConValutazione(userName, codiceSessione, codicePresentazione) AS
SELECT userNameUtente, codiceSessione, codicePresentazione
FROM PRESENTAZIONEPRESENTER
WHERE (codiceSessione, codicePresentazione) IN (SELECT codiceSessione, codicePresentazione FROM VALUTAZIONE);