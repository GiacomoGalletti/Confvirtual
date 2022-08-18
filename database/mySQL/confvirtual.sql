DROP DATABASE IF EXISTS CONFVIRTUAL;
CREATE DATABASE CONFVIRTUAL;
use CONFVIRTUAL;

CREATE TABLE CONFERENZA (
                            annoEdizione year not null,
                            acronimo varchar(10) not null,
                            totaleSponsorizzazioni int default 0,
                            immagineLogo varchar(260),
                            statoSvolgimento enum('attiva','completata') default('attiva'),
                            nome varchar(50) not null,
                            primary key (annoEdizione,acronimo)
)engine='InnoDB';

CREATE TABLE UTENTE (
                        userName varchar(50) not null,
                        nome varchar(50) not null,
                        cognome varchar(50) not null,
                        pswd varchar(50) not null,
                        luogoNascita varchar(50),
                        dataNascita date not null,
                        primary key(userName)
)engine='InnoDB';

CREATE TABLE DATACONFERENZA (
    giorno date not null,
    annoEdizioneConferenza year not null,
    acronimoConferenza varchar (50) not null,
    primary key (giorno,annoEdizioneConferenza,acronimoConferenza),
    foreign key (annoEdizioneConferenza, acronimoConferenza) references CONFERENZA(annoEdizione,acronimo) ON DELETE CASCADE
)engine='InnoDB';

CREATE TABLE SESSIONE(
	codice int auto_increment,
    oraInizio time not null,
    oraFine time not null,
    constraint controlloOrario check(oraFine > oraInizio), # VERIFICARE I CONTROLLI CON LE DATE
    titolo varchar(50) not null,
    linkStanza varchar(260) not null,
    numeroPresentazioni int default 0,
    giornoData date not null,
    annoEdizioneConferenza year not null,
    acronimoConferenza varchar(50),
    primary key (codice),
    foreign key (giornoData,annoEdizioneConferenza,acronimoConferenza) references DATACONFERENZA(giorno,annoEdizioneConferenza,acronimoConferenza)ON DELETE CASCADE
)engine='InnoDB';

CREATE TABLE PRESENTAZIONE (
     codice int auto_increment,
     codiceSessione int not null,
     oraInizio time not null,
     oraFine time not null,
     numeroSequenza int default 1,
     primary key (codice, codiceSessione),
     foreign key (codiceSessione) references SESSIONE(codice) ON DELETE CASCADE
)engine='InnoDB';

CREATE TABLE AMMINISTRATORE (
                                userNameUtente varchar(50),
                                primary key (userNameUtente),
                                foreign key (userNameUtente) references UTENTE(userName)
                                    ON DELETE CASCADE
)engine='InnoDB';

CREATE TABLE CREATORICONFERENZA(
                                   userNameUtente varchar(50),
                                   annoEdizioneConferenza year,
                                   acronimoConferenza varchar (50),
                                   primary key(userNameUtente,annoEdizioneConferenza,acronimoConferenza),
                                   foreign key (annoEdizioneConferenza,acronimoConferenza) references CONFERENZA(annoEdizione,acronimo),
                                   foreign key (userNameUtente) references AMMINISTRATORE(userNameUtente)
)engine='InnoDB';

CREATE TABLE SPEAKER (
                         userNameUtente varchar(50),
                         curriculum varchar(30),
                         foto varchar(260),
                         nomeUniversita varchar(50),
                         nomeDipartimento varchar(50),
                         primary key (userNameUtente),
                         foreign key (userNameUtente) references UTENTE(userName)
                             ON DELETE CASCADE
)engine='InnoDB';

CREATE TABLE AUTORE(
                       codicePresentazione int,
                       codiceSessione int,
                       nome varchar(50),
                       cognome varchar(50),
                       primary key (codicePresentazione, codiceSessione,nome,cognome),
                       foreign key (codicePresentazione,codiceSessione) references PRESENTAZIONE(codice,codiceSessione)
                           ON DELETE CASCADE
)engine = 'InnoDB';

CREATE TABLE PRESENTER (
                           userNameUtente varchar(50),
                           curriculum varchar(30),
                           foto varchar(260),
                           nomeUniversita varchar(50),
                           nomeDipartimento varchar(50),
                           primary key (userNameUtente),
                           foreign key (userNameUtente) references UTENTE(userName)ON DELETE CASCADE
)engine = 'InnoDB';

CREATE TABLE SPONSOR (
                         nome varchar(50),
                         immagineLogo varchar(260),
                         primary key(nome)
)engine = 'InnoDB';

CREATE TABLE SPONSORIZZAZIONI(
                                 importo double not null,
                                 annoEdizioneConferenza year,
                                 acronimoConferenza varchar(10),
                                 nomeSponsor varchar(50),
                                 primary key (annoEdizioneConferenza,acronimoConferenza,nomeSponsor),
                                 foreign key (nomeSponsor) references SPONSOR(nome) ON DELETE CASCADE,
                                 foreign key (annoEdizioneConferenza,acronimoConferenza) references CONFERENZA(annoEdizione,acronimo) ON DELETE CASCADE
)engine = 'InnoDB';

CREATE TABLE UTENTEREGISTRATO(
                                 userNameUtente varchar(50),
                                 annoEdizioneconferenza year,
                                 acronimoConferenza varchar(50),
                                 primary key(userNameUtente,annoEdizioneconferenza,acronimoConferenza),
                                 foreign key (userNameUtente) references UTENTE(userName),
                                 foreign key (annoEdizioneConferenza,acronimoConferenza) references CONFERENZA(annoEdizione,acronimo)
                                     ON DELETE CASCADE
)engine = 'InnoDB';

CREATE TABLE MESSAGGIO(
                          id int auto_increment,
                          codiceSessione int,
                          userNameUtente varchar(50),
                          testo varchar(500),
                          dataInvio date,
                          primary key(id,codiceSessione,userNameUtente),
                          foreign key (codiceSessione) references SESSIONE(codice),
                          foreign key (userNameUtente) references UTENTE(userName)
                              ON DELETE CASCADE
)engine = 'InnoDB';

CREATE TABLE TUTORIAL(
                         codicePresentazione int,
                         codiceSessione int,
                         titolo varchar(50),
                         abstract varchar(500),
                         primary key (codicePresentazione, codiceSessione),
                         foreign key (codiceSessione, codicePresentazione) references PRESENTAZIONE(codiceSessione, codice)
                             ON DELETE CASCADE
)engine = 'InnoDB';

CREATE TABLE RISORSATUTORIAL (
                              link varchar(260),
                              descrizione varchar(100),
                              codicePresentazione int,
                              codiceSessione int,
                              primary key(link, codicePresentazione, codiceSessione),
                              foreign key (codicePresentazione,codiceSessione) references PRESENTAZIONE(codice,codiceSessione)
                                  ON DELETE CASCADE
)engine = 'InnoDB';

CREATE TABLE ARTICOLO(
                         codicePresentazione int,
                         codiceSessione int,
                         titolo varchar(50) not null,
                         filePdf varchar(260),
                         numeroPagine int,
                         statoSvolgimento enum('coperto','non coperto') default ('non coperto'),
                         primary key (codicePresentazione, codiceSessione),
                         foreign key (codiceSessione, codicePresentazione) references PRESENTAZIONE(codiceSessione, codice)ON DELETE CASCADE
)engine = 'InnoDB';

CREATE TABLE PRESENTAZIONESPEAKER(
                                     userNameUtente varchar(50),
                                     titoloTutorial varchar(50),
                                     codicePresentazione int,
                                     codiceSessione int,
                                     linkWeb varchar(260),
                                     descrizione varchar(200),
                                     primary key(userNameUtente, codicePresentazione, codiceSessione),
                                     foreign key (userNameUtente) references SPEAKER(userNameUtente)ON DELETE CASCADE,
                                     foreign key (codicePresentazione,codiceSessione) references
                                         TUTORIAL(codicePresentazione,codiceSessione)
                                         ON DELETE CASCADE
)engine = 'InnoDB';

CREATE TABLE PRESENTAZIONEPRESENTER(
                              userNameUtente varchar(50),
                              titoloArticolo varchar(50),
                              codicePresentazione int,
                              codiceSessione int,
                              primary key (codicePresentazione, codiceSessione),
                              foreign key (userNameUtente) references PRESENTER(userNameUtente)ON DELETE CASCADE,
                              foreign key (codicePresentazione,codiceSessione) references
                                  ARTICOLO(codicePresentazione,codiceSessione)ON DELETE CASCADE
)engine = 'InnoDB';

CREATE TABLE PAROLACHIAVE (
                              parola varchar(20),
                              codicePresentazione int,
                              codiceSessione int,
                              primary key(parola, codicePresentazione, codiceSessione),
                              foreign key (codicePresentazione,codiceSessione) references PRESENTAZIONE(codice,codiceSessione)
                                  ON DELETE CASCADE
)engine = 'InnoDB';

CREATE TABLE VALUTAZIONE(
                            userNameUtente varchar(50),
                            codicePresentazione int,
                            codiceSessione int,
                            voto int not null,
                            constraint validazioneVoto check (voto>=0 and voto <= 10),
                            note varchar(50),
                            primary key (userNameUtente, codicePresentazione, codiceSessione),
                            foreign key (codicePresentazione,codiceSessione) references PRESENTAZIONE(codice,codiceSessione)
                                ON DELETE CASCADE
)engine = 'InnoDB';
