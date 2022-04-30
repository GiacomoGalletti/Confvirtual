use confvirtual;
DELIMITER //
drop procedure if exists checkUserType //
CREATE PROCEDURE checkUserType(
IN nomeUtente varchar(50))
BEGIN
DECLARE res_type varchar(20) DEFAULT 'utente'; #default fallisce
	if exists(
		SELECT userNameUtente
		FROM amministratore
		WHERE amministratore.userNameUtente = nomeUtente
	)
	THEN 
		set res_type = 'amministratore';
	ELSE
		if exists (
			SELECT userNameUtente
			FROM speaker
			WHERE speaker.userNameUtente = nomeUtente
        )
        then
			set res_type = 'speaker';
		else
			if exists (
				SELECT userNameUtente
				FROM presenter
				WHERE presenter.userNameUtente = nomeUtente
            )
            then
				set res_type = 'presenter';
			end if;
		end if;
    END IF;
	select res_type;
END; 
//
DELIMITER ;

DELIMITER //
drop procedure if exists  checkUserExists //
CREATE PROCEDURE checkUserExists(
IN nomeUtente varchar(50),
IN pswd varchar(50))
BEGIN
	SELECT userName
	FROM UTENTE
	WHERE UTENTE.userName = nomeUtente AND UTENTE.pswd = pswd;
END; 
//
DELIMITER ;

DELIMITER //
drop procedure if exists register//
CREATE PROCEDURE register(
IN inUnserName varchar(50),
IN inPswd varchar(50),
IN inName varchar(50),
IN inSurname varchar(50),
IN inBirthPlace varchar(50),
IN inBirthday date)
BEGIN
	insert into UTENTE(
	userName,
    nome,
    cognome,
    pswd,
    luogoNascita,
    dataNascita) values (
    inUnserName,
    inName,
    inSurname,
    inPswd,
    inBirthPlace,
    inBirthday
    );
END; 
//
DELIMITER ;

DELIMITER //
drop procedure if exists createConference//
CREATE PROCEDURE createConference(IN in_annoEdizione year,IN in_acronimo varchar(10),IN in_immagineLogo varchar(260),IN in_nome varchar(50),IN in_userName varchar(50))
BEGIN  
	insert into CONFERENZA(annoEdizione,acronimo,immagineLogo,nome) values (in_annoEdizione,in_acronimo,in_immagineLogo,in_nome);
	insert into CREATORICONFERENZA (userNameUtente,annoEdizioneConferenza,acronimoConferenza) values (in_userName, in_annoEdizione, in_acronimo);
END; 
//
DELIMITER ;

DELIMITER //
drop procedure if exists aggiungiData//
CREATE PROCEDURE aggiungiData(IN in_giorno date,IN in_annoEdizione year,IN in_acronimo varchar(10))
BEGIN    
	insert into DATACONFERENZA(giorno,annoEdizioneConferenza,acronimoConferenza) values (in_giorno,in_annoEdizione,in_acronimo);
END; 
//
DELIMITER ;

DELIMITER //
drop procedure if exists ritornaConferenza //
CREATE PROCEDURE ritornaConferenza(IN in_acronimo varchar(10),IN in_annoEdizione year)
BEGIN
	select *
    from CONFERENZA
    where (CONFERENZA.acronimo = in_acronimo,CONFERENZA.annoEdizione = in_annoEdizione)
    ;
END //
DELIMITER ;

DELIMITER //
drop procedure if exists ritornaConferenzeFuture //
CREATE PROCEDURE ritornaConferenzeFuture()
BEGIN
	select *
    from CONFERENZA
    where (CONFERENZA.statoSvolgimento = 'attiva');
END //
DELIMITER ;

DELIMITER //
drop procedure if exists ritornaConferenzePassate //
CREATE PROCEDURE ritornaConferenzePassate()
BEGIN
	select *
    from CONFERENZA
    where (CONFERENZA.statoSvolgimento = 'completata');
END //
DELIMITER ;

DELIMITER //
drop procedure if exists ritornaGiorniConferenza //
CREATE PROCEDURE ritornaGiorniConferenza (IN in_acronimo varchar(10), IN in_annoEdizioneConferenza year)
BEGIN
	select giorno
    from DATACONFERENZA
    where (DATACONFERENZA.acronimoConferenza = in_acronimo) AND (DATACONFERENZA.annoEdizioneConferenza = in_annoEdizioneConferenza);
END //
DELIMITER ;

#procedure creazione sessione
DELIMITER //
drop procedure if exists createSession //
CREATE PROCEDURE createSession(IN in_oraInizio time,IN in_oraFine time,IN in_titolo varchar(50),IN in_linkStanza varchar(360),
							   IN in_giornoData date,IN in_annoEdizioneConferenza year,IN in_acronimoConferenza varchar(50))
BEGIN
	insert into sessione(oraInizio,oraFine,titolo,linkStanza,giornoData,annoEdizioneConferenza,acronimoConferenza) values (
				in_oraInizio,in_oraFine,in_titolo,in_linkStanza,in_giornoData,in_annoEdizioneConferenza,in_acronimoConferenza);
END;
//
DELIMITER ;

#procedure ottenimento di tutte le sessioni di una conferenza
DELIMITER //
drop procedure if exists getSessionsFromConfrernce //
CREATE PROCEDURE getSessionsFromConfrernce(in_acronimoConferenza varchar(50), IN in_annoEdizioneConferenza year)
BEGIN
    select *
    from sessione
    where sessione.acronimoConferenza = in_acronimoConferenza AND sessione.annoEdizioneConferenza = in_annoEdizioneConferenza;
END //
DELIMITER ;


#procedure creazione presentazione
DELIMITER //
drop procedure if exists createPresentaion //
CREATE PROCEDURE createPresentation(IN in_codiceSessione int,IN in_oraInizio time,IN in_oraFine time)
BEGIN  
	insert into presentazione(codiceSessione,oraInizio,oraFine) values (in_codiceSessione,in_oraInizio,in_oraFine);
END; 
//
DELIMITER ;

DELIMITER //
drop procedure if exists getAdminConferences //
CREATE PROCEDURE getAdminConferences(IN userName int)
BEGIN
    select *
    from conferenza
    where conferenza.acronimo in (
        SELECT creatoriconferenza.acronimoConferenza
        from creatoriconferenza
        where creatoriconferenza.userNameUtente = userName
        );
END;
//
DELIMITER ;

DELIMITER $$
DROP PROCEDURE IF EXISTS getPresetationInfo $$
CREATE PROCEDURE getPresentationInfo(IN in_codiceSessione int)
BEGIN
    SELECT * FROM presentazione WHERE in_codiceSessione = presentazione.codiceSessione ORDER BY presentazione.codiceSessione;
    SELECT * FROM tutorial WHERE in_codiceSessione = tutorial.codiceSessione ORDER BY tutorial.codiceSessione;
    SELECT * FROM articolo WHERE in_codiceSessione = articolo.codiceSessione ORDER BY articolo.codiceSessione;
END$$
DELIMITER ;