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
CREATE PROCEDURE checkUserExists(IN nomeUtente varchar(50),IN pswd varchar(50))
BEGIN
    SELECT userName
    FROM UTENTE
    WHERE UTENTE.userName = nomeUtente AND UTENTE.pswd = pswd;
END;
//
DELIMITER ;

DELIMITER //
drop procedure if exists register//
CREATE PROCEDURE register(IN inUnserName varchar(50),IN inName varchar(50),IN inSurname varchar(50),IN inPswd varchar(50),IN inBirthPlace varchar(50),IN inBirthday date)
BEGIN
    insert into UTENTE(userName,nome,cognome,pswd,luogoNascita,dataNascita) values (inUnserName,inName,inSurname,inPswd,inBirthPlace,inBirthday);
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

#crea articolo con la call a create presentation
DELIMITER //
drop procedure if exists createArticolo //
CREATE PROCEDURE createArticolo(IN in_codicePresentazione int, IN in_codiceSessione int, IN in_titolo varchar(50), IN in_filePdf varchar(260) , IN in_numeroPagine int)
BEGIN
    INSERT INTO  articolo(codicePresentazione,codiceSessione,titolo,filePDF,numeroPagine)VALUES(in_codicePresentazione,in_codiceSessione, in_titolo, in_filePdf, in_numeroPagine);
END;
//
DELIMITER ;

#crea tutorial con la call a create presentation
DELIMITER //
drop procedure if exists createTutorial//
CREATE PROCEDURE createTutorial(IN in_codicePresentazione int, IN in_codiceSessione int, IN in_titolo varchar(50), IN in_abstract varchar(500))
BEGIN
    INSERT INTO  tutorial(codicePresentazione, codiceSessione, titolo, abstract)VALUES(in_codicePresentazione,in_codiceSessione,in_titolo,in_abstract);
END;
//
DELIMITER ;

#procedure creazione presentazione
DELIMITER //
drop procedure if exists createPresentation //
CREATE PROCEDURE createPresentation(IN in_codiceSessione int,IN in_oraInizio time,IN in_oraFine time)
BEGIN
    insert into presentazione(codiceSessione,oraInizio,oraFine) values (in_codiceSessione,in_oraInizio,in_oraFine);
END;
//
DELIMITER ;

#procedure creazione presentazione e articolo
DELIMITER //
DROP PROCEDURE if exists addPresentationArticle //
CREATE PROCEDURE addPresentationArticle(IN in_codiceSessione int,IN in_oraInizio time,IN in_oraFine time,IN in_titolo varchar(50),IN in_filePdf varchar(260),IN in_numeroPagine int)
BEGIN
    DECLARE codice_presentazione INT unsigned DEFAULT 0;
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
        BEGIN
            ROLLBACK;
            SELECT 'ERROR' AS risultato;
        END;
    start transaction;
    call createPresentation(in_codiceSessione,in_oraInizio,in_oraFine);
    SET codice_presentazione = (select max(codice) from presentazione where codiceSessione =  in_codiceSessione);
    call createArticolo (codice_presentazione,in_codiceSessione,in_titolo,in_filePdf,in_numeroPagine);
    SELECT 'OK' AS risultato;
    commit;
END
//
DELIMITER ;

#procedure creazione presentazione e tutorial
DELIMITER //
DROP PROCEDURE if exists addPresentationTutorial //
CREATE PROCEDURE addPresentationTutorial(IN in_codiceSessione int,IN in_oraInizio time,IN in_oraFine time,IN in_titolo varchar(50),IN in_abstract varchar(500))
BEGIN
    DECLARE codice_presentazione INT unsigned DEFAULT 0;
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
        BEGIN
            ROLLBACK;
            SELECT 'ERROR' AS risultato;
        END;
    start transaction;
    call createPresentation(in_codiceSessione,in_oraInizio,in_oraFine);
    SET codice_presentazione = (select max(codice) from presentazione where codiceSessione =  in_codiceSessione);
    call createTutorial(codice_presentazione,in_codiceSessione,in_titolo,in_abstract);
    SELECT 'OK' AS risultato;
    commit;
END
//
DELIMITER ;
DELIMITER //
DROP PROCEDURE IF EXISTS getAllPresentationInfo //
CREATE PROCEDURE getAllPresentationInfo(IN in_codiceSessione int)
BEGIN
    select *
    from presentazione
    where presentazione.codiceSessione = in_codiceSessione
    order by numeroSequenza;
END//
DELIMITER ;

DELIMITER //
DROP PROCEDURE IF EXISTS getPresentationInfo //
CREATE PROCEDURE getPresentationInfo(IN in_codicePresentazione int)
BEGIN
    IF EXISTS (
            SELECT *
            FROM ARTICOLO
            WHERE ARTICOLO.codicePresentazione = in_codicePresentazione
        ) THEN (
                   SELECT *, 'articolo' AS tipoPresentazione
                   FROM PRESENTAZIONE,ARTICOLO
                   WHERE (PRESENTAZIONE.codice = ARTICOLO.codicePresentazione)  and
                           PRESENTAZIONE.codice = in_codicePresentazione
               );ELSE (
                          SELECT *, 'tutorial' AS tipoPresentazione
                          FROM PRESENTAZIONE,TUTORIAL
                          WHERE (PRESENTAZIONE.codice = TUTORIAL.codicePresentazione) AND
                                  PRESENTAZIONE.codice = in_codicePresentazione
                      );
    END IF;
END//
DELIMITER ;

DELIMITER //
drop procedure if exists insertRating//
CREATE PROCEDURE insertRating(
    IN in_usernameUtente varchar(50), IN in_codicePresentaione int, IN in_codiceSessione int, IN in_voto int, IN in_note varchar(50) )
BEGIN
    insert into VALUTAZIONE(userNameUtente, codicePresentazione, codiceSessione, voto, note) values (in_usernameUtente,in_codicePresentaione,in_codiceSessione,in_voto,in_note );
END;
//

DELIMITER //
drop procedure if exists checkRatingExists//
CREATE PROCEDURE checkRatingExists(
    IN in_userNameUtente varchar(50), IN in_codicePresentazione int , IN in_codiceSessione int)
BEGIN

    SELECT *
    FROM valutazione
    WHERE in_userNameUtente = userNameUtente AND in_codicePresentazione = codicePresentazione AND in_codiceSessione = codiceSessione;

END;

DELIMITER $$
DROP PROCEDURE IF EXISTS ritornaUtenti $$
CREATE PROCEDURE ritornaUtenti()
BEGIN
    select userName, nome, cognome, luogoNascita, dataNascita
    from utente
    where username not in (select userNameUtente from speaker) and username not in (select userNameUtente from presenter);
END $$
DELIMITER ;

DELIMITER $$
DROP PROCEDURE IF EXISTS promuoviUtenteASpeaker $$
CREATE PROCEDURE promuoviUtenteASpeaker(IN in_userNameUtente varchar(50))
BEGIN
    insert into speaker(userNameUtente) values (in_userNameUtente);
END $$
DELIMITER ;

DELIMITER $$
DROP PROCEDURE IF EXISTS promuoviUtenteAPresenter $$
CREATE PROCEDURE promuoviUtenteAPresenter(IN in_userNameUtente varchar(50))
BEGIN
    insert into presenter(userNameUtente) values (in_userNameUtente);
END $$
DELIMITER ;

DELIMITER $$
DROP PROCEDURE IF EXISTS ritornaPresenter $$
CREATE PROCEDURE ritornaPresenter()
BEGIN
    select foto,userName,nome,cognome,nomeUniversita,nomeDipartimento
    from UTENTE join PRESENTER on UTENTE.userName = PRESENTER.userNameUtente;
END $$
DELIMITER ;

DELIMITER $$
DROP PROCEDURE IF EXISTS ritornaSpeaker $$
CREATE PROCEDURE ritornaSpeaker()
BEGIN
    select foto,userName,nome,cognome,nomeUniversita,nomeDipartimento
    from UTENTE join SPEAKER on UTENTE.userName = SPEAKER.userNameUtente;
END $$
DELIMITER ;

DELIMITER $$
DROP PROCEDURE IF EXISTS ritornaArticoli $$
CREATE PROCEDURE ritornaArticoli()
BEGIN
    select *
    from articolo
    where (articolo.statoSvolgimento = 'non coperto');
END $$
DELIMITER ;

DELIMITER $$
DROP PROCEDURE IF EXISTS associaPresenter $$
CREATE PROCEDURE associaPresenter(IN in_userNameUtente varchar(50),IN in_titoloArticolo varchar(50), IN in_codicePresentazione int , IN in_codiceSessione int)
BEGIN
    INSERT INTO PRESENTAZIONEPRESENTER(userNameUtente,titoloArticolo,codicePresentazione,codiceSessione) values(in_userNameUtente,in_titoloArticolo,in_codicePresentazione,in_codiceSessione);
END $$
DELIMITER ;

DELIMITER $$
DROP PROCEDURE IF EXISTS ritornaTutorial $$
CREATE PROCEDURE ritornaTutorial(IN in_userNameUtente varchar(50))
BEGIN
    select *
    from TUTORIAL
    where (TUTORIAL.codicePresentazione,TUTORIAL.codiceSessione) not in (
        select codicePresentazione,codiceSessione
        from PRESENTAZIONESPEAKER
        where PRESENTAZIONESPEAKER.userNameUtente = in_userNameUtente
    );
END$$
DELIMITER ;

DELIMITER $$
DROP PROCEDURE IF EXISTS associaSpeaker $$
CREATE PROCEDURE associaSpeaker(IN in_userNameUtente varchar(50),IN in_titoloTutorial varchar(50), IN in_codicePresentazione int , IN in_codiceSessione int)
BEGIN
    INSERT INTO PRESENTAZIONESPEAKER(userNameUtente,titoloTutorial,codicePresentazione,codiceSessione) values(in_userNameUtente,in_titoloTutorial,in_codicePresentazione,in_codiceSessione);
END $$
DELIMITER ;

DELIMITER $$
DROP PROCEDURE IF EXISTS ordinamentoSequenzePresentazioni $$
CREATE PROCEDURE ordinamentoSequenzePresentazioni()
BEGIN
    DECLARE done INT DEFAULT 0;
    DECLARE ora INT;
    DECLARE sessioncode INT;
    DECLARE oldsessioncode INT;
    #DECLARE nseq INT;
    DECLARE getora CURSOR FOR SELECT presentazione.oraFine FROM presentazione INNER JOIN sessione ON presentazione.codiceSessione = sessione.codice
                              ORDER BY presentazione.oraFine AND presentazione.codiceSessione;
    DECLARE getsessioncode CURSOR FOR SELECT presentazione.codiceSessione FROM presentazione INNER JOIN sessione ON presentazione.codiceSessione = sessione.codice
                                      ORDER BY presentazione.oraFine AND presentazione.codiceSessione;
    DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = 1;

    OPEN getora;
    OPEN getsessioncode;

    FETCH getora INTO ora;
    FETCH getsessioncode INTO sessioncode;

    SET @nseq = 1;
    SET oldsessioncode = sessioncode;

    REPEAT
        IF (sessioncode > oldsessioncode) THEN SET @nseq = 1;
        END IF;
        UPDATE presentazione SET numeroSequenza = @nseq WHERE presentazione.oraFine = ora AND presentazione.codiceSessione = sessioncode;
        SET @nseq = @nseq + 1;
        SET oldsessioncode = sessioncode;
        FETCH getora INTO ora;
        FETCH getsessioncode INTO sessioncode;
    UNTIL done = 1 END REPEAT;

    CLOSE getora;
    CLOSE getsessioncode;
END $$
DELIMITER ;

DELIMITER $$
DROP PROCEDURE IF EXISTS eliminaPresentazione $$
CREATE PROCEDURE eliminaPresentazione(IN in_codicePresentazione int , IN in_codiceSessione int)
BEGIN
    DELETE FROM presentazione WHERE in_codicePresentazione = presentazione.codice AND in_codiceSessione = presentazione.codiceSessione;
END $$
DELIMITER ;

DELIMITER $$
DROP PROCEDURE IF EXISTS modificaPresentazione $$
CREATE PROCEDURE modificaPresentazione(IN tipo varchar(20),IN in_codicePresentazione int , IN in_codiceSessione int, IN in_titolo varchar(50),IN in_filePdf varchar(260),IN in_numeroPagine int,IN in_abstract varchar(500))
BEGIN
    IF (tipo = 'articolo') THEN
        UPDATE articolo
        SET titolo = in_titolo, filePdf = in_filePdf, numeroPagine = in_numeroPagine
        WHERE in_codicePresentazione = articolo.codicePresentazione AND in_codiceSessione = articolo.codiceSessione;
    ELSE IF (tipo = 'tutorial') THEN
        UPDATE tutorial
        SET titolo = in_titolo, abstract = in_abstract
        WHERE in_codicePresentazione = tutorial.codicePresentazione AND in_codiceSessione = tutorial.codiceSessione;
    END IF;
    END IF;
END $$
DELIMITER ;

DELIMITER $$
DROP PROCEDURE IF EXISTS creaSponsor $$
CREATE PROCEDURE creaSponsor(IN in_nome varchar(50) , IN in_immagineLogo varchar(260))
BEGIN
    insert into SPONSOR(immagineLogo,nome) values (in_immagineLogo,in_nome);
END $$
DELIMITER ;

DELIMITER $$
DROP PROCEDURE IF EXISTS creaSponsorizzazione $$
CREATE PROCEDURE creaSponsorizzazione(IN in_importo double,IN in_annoEdizione year,IN in_acronimo varchar(10),IN in_nome varchar(50))
BEGIN
    insert into sponsorizzazioni(importo,annoEdizioneConferenza,acronimoConferenza,nomeSponsor) values (in_importo,in_annoEdizione,in_acronimo,in_nome);
END$$
DELIMITER ;

DELIMITER $$
DROP PROCEDURE IF EXISTS eliminaSponsor $$
CREATE PROCEDURE eliminaSponsor(IN in_nome varchar(50))
BEGIN
    DELETE FROM sponsor WHERE in_nome = sponsor.nome;
END $$
DELIMITER ;

DELIMITER $$
DROP PROCEDURE IF EXISTS iscriviUtente $$
CREATE PROCEDURE iscriviUtente(IN in_userNameUtente varchar(50), IN in_acronimoConferenza varchar(50),IN in_annoEdizioneconferenza year)
BEGIN
    insert into utenteregistrato(userNameUtente,acronimoConferenza,annoEdizioneConferenza) values (in_userNameUtente,in_acronimoConferenza,in_annoEdizioneconferenza);
END $$
DELIMITER ;

DELIMITER $$
DROP PROCEDURE IF EXISTS verificaIscrizione $$
CREATE PROCEDURE verificaIscrizione(IN in_userNameUtente varchar(50), IN in_acronimoConferenza varchar(50),IN in_annoEdizioneconferenza year)
BEGIN
    SELECT * FROM utenteregistrato
    WHERE in_userNameUtente = userNameUtente AND in_acronimoConferenza=acronimoConferenza AND in_annoEdizioneconferenza=annoEdizioneconferenza;
END $$
DELIMITER ;

DELIMITER //
drop procedure if exists associateSpeaker //
CREATE PROCEDURE associateSpeaker(IN in_userNameUtente varchar(50),IN in_titoloTutorial varchar(50), IN in_codicePresentazione int, IN in_codiceSessione int)
BEGIN
    insert into presentazionespeaker (userNameUtente, titoloTutorial, codicePresentazione, codiceSessione) values (in_userNameUtente, in_titoloTutorial, in_codicePresentazione, in_codiceSessione);
END //
DELIMITER ;

DELIMITER //
drop procedure if exists associatePresenter //
CREATE PROCEDURE associatePresenter(IN in_userNameUtente varchar(50),IN in_titoloArticolo varchar(50), IN in_codicePresentazione int, IN in_codiceSessione int)
BEGIN
    insert into presentazionepresenter (userNameUtente, titoloArticolo, codicePresentazione, codiceSessione) values (in_userNameUtente, in_titoloArticolo, in_codicePresentazione, in_codiceSessione);
END //
DELIMITER ;

DELIMITER $$
DROP PROCEDURE IF EXISTS ritornaMediaValutazioniPresentazione $$
CREATE PROCEDURE ritornaMediaValutazioniPresentazione(IN in_codiceSessione int, IN in_codicePresentazione int)
BEGIN
    SELECT avg(voto) as mediaVoti
    FROM valutazione
    WHERE codiceSessione = in_codiceSessione and codicePresentazione = in_codicePresentazione;
END $$
DELIMITER ;

DELIMITER $$
DROP PROCEDURE IF EXISTS ritornaImmagineProfilo $$
CREATE PROCEDURE ritornaImmagineProfilo(IN in_username varchar(50),IN in_tipo varchar(20))
BEGIN
    IF (in_tipo = 'speaker') THEN
        select foto
        from speaker
        where userNameUtente = in_username;
    ELSE IF (in_tipo = 'presenter') THEN
        select foto
        from presenter
        where userNameUtente = in_username;
    END IF;
    END IF;
END $$
DELIMITER ;

DELIMITER $$
DROP PROCEDURE IF EXISTS ritornaMessaggi $$
CREATE PROCEDURE ritornaMessaggi(IN in_codice_sessione int)
BEGIN
    select *
    from messaggio
    where messaggio.codiceSessione = in_codice_sessione;
END $$
DELIMITER ;

DELIMITER //
drop procedure if exists creaMessaggio //
CREATE PROCEDURE creaMessaggio(IN in_codice_sessione int, IN in_userNameUtente varchar(50),IN in_messaggio varchar(500), IN in_data date)
BEGIN
    insert into messaggio (codiceSessione,userNameUtente,testo,dataInvio) values (in_codice_sessione,in_userNameUtente, in_messaggio, in_data);
END //
DELIMITER ;

DELIMITER //
DROP PROCEDURE IF EXISTS ritornaAmministratori //
CREATE PROCEDURE ritornaAmministratori()
BEGIN
    select *
    from UTENTE join AMMINISTRATORE on UTENTE.userName = AMMINISTRATORE.userNameUtente;
END //
DELIMITER ;

DELIMITER $$
drop procedure if exists controlloCoperturaPresentazioni $$
CREATE PROCEDURE controlloCoperturaPresentazioni(IN in_codice_presentazione int, IN in_codice_sessione int, IN in_tipo varchar(20))
BEGIN
    IF (in_tipo = 'articolo') THEN
        SELECT *
        FROM PRESENTAZIONEPRESENTER
        WHERE in_codice_presentazione = PRESENTAZIONEPRESENTER.codicePresentazione AND in_codice_sessione = PRESENTAZIONEPRESENTER.codiceSessione;
    ELSE IF (in_tipo = 'tutorial') THEN
        SELECT *
        FROM PRESENTAZIONESPEAKER
        WHERE in_codice_presentazione = PRESENTAZIONESPEAKER.codicePresentazione AND in_codice_sessione = PRESENTAZIONESPEAKER.codiceSessione;
    END IF;
    END IF;
END $$
DELIMITER ;

DELIMITER $$
DROP PROCEDURE IF EXISTS addAuthorAndAssociatePresenter $$
CREATE PROCEDURE addAuthorAndAssociatePresenter(IN in_userNameUtente varchar(50),  IN in_titoloArticolo varchar(50), IN in_codicePresentazione int, IN in_codiceSessione int)
BEGIN
    DECLARE nomeAutore varchar(50);
    DECLARE cognomeAutore varchar(50);
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
        BEGIN
            ROLLBACK;
            SELECT 'ERROR' AS risultato;
        END;
    START TRANSACTION;
    set nomeAutore = (SELECT nome FROM UTENTE WHERE userName = in_userNameUtente);
    set cognomeAutore = (SELECT cognome FROM UTENTE WHERE userName = in_userNameUtente);
    insert into presentazionepresenter (userNameUtente, titoloArticolo, codicePresentazione, codiceSessione) values (in_userNameUtente, in_titoloArticolo, in_codicePresentazione, in_codiceSessione);
    insert into AUTORE (codicePresentazione, codiceSessione, nome, cognome) values (in_codicePresentazione, in_codiceSessione, nomeAutore, cognomeAutore);
    SELECT 'OK' AS risultato;
    COMMIT;
END $$
DELIMITER ;

DELIMITER $$
DROP PROCEDURE IF EXISTS addAuthor $$
CREATE PROCEDURE addAuthor(IN in_codicePresentazione int, IN in_codiceSessione int, IN in_nome varchar(50), IN in_cognome varchar(50))
BEGIN
    INSERT INTO AUTORE (codicePresentazione, codiceSessione, nome, cognome) VALUES (in_codicePresentazione,in_codiceSessione,in_nome,in_cognome);
END $$
DELIMITER ;

DELIMITER $$
DROP PROCEDURE IF EXISTS addKeyWord $$
CREATE PROCEDURE addKeyWord(IN in_codicePresentazione int, IN in_codiceSessione int, IN in_parola varchar(20))
BEGIN
    INSERT INTO parolachiave (codicePresentazione, codiceSessione, parola) VALUES (in_codicePresentazione,in_codiceSessione,in_parola);
END $$
DELIMITER ;

DELIMITER $$
DROP PROCEDURE IF EXISTS getKeyWord $$
CREATE PROCEDURE getKeyWord(IN in_codicePresentazione int, IN in_codiceSessione int)
BEGIN
    select parola from parolachiave where (codiceSessione = in_codiceSessione and codicePresentazione = in_codicePresentazione);
END $$
DELIMITER ;

DELIMITER $$
DROP PROCEDURE IF EXISTS getAuthors $$
CREATE PROCEDURE getAuthors(IN in_codicePresentazione int, IN in_codiceSessione int)
BEGIN
    select nome,cognome from autore where (codiceSessione = in_codiceSessione and codicePresentazione = in_codicePresentazione);
END $$
DELIMITER ;

DELIMITER $$
DROP PROCEDURE IF EXISTS deleteAuthors $$
CREATE PROCEDURE deleteAuthors(IN in_codicePresentazione int , IN in_codiceSessione int)
BEGIN
    DELETE FROM autore WHERE in_codicePresentazione = autore.codicePresentazione AND in_codiceSessione = autore.codiceSessione;
END $$
DELIMITER ;

DELIMITER $$
DROP PROCEDURE IF EXISTS deleteKeyWords $$
CREATE PROCEDURE deleteKeyWords(IN in_codicePresentazione int , IN in_codiceSessione int)
BEGIN
    DELETE FROM parolachiave WHERE in_codicePresentazione = parolachiave.codicePresentazione AND in_codiceSessione = parolachiave.codiceSessione;
END $$
DELIMITER ;