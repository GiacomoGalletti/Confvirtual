

use CONFVIRTUAL;

insert into CONFERENZA(annoEdizione,acronimo,totaleSponsorizzazioni,immagineLogo,statoSvolgimento,nome)
                values('2020','ces20','0','/uploads/img/logostock.jpg','completata','consumer electronic show 20'),
                       ( '2021','ces21','0','/uploads/img/logostock.jpg','completata','consumer electronics show 21'),
                        ('2022','ces22','0','/uploads/img/logostock.jpg','attiva','consumer electronics show 22'),
                        ('2022','mlfuture','0','/uploads/img/logostock.jpg','attiva','studio di machine learning futura'),
                        ('2022','mlpast','0','/uploads/img/logostock.jpg','completata','studio di machine learning passata'),
                        ('2022','ss1','0','/uploads/img/logostock.jpg','attiva','sviluppo software I'),
                        ('2023','ces23','0','/uploads/img/logostock.jpg','attiva','consumer electronics show 23');


insert into DATACONFERENZA(giorno,annoEdizioneConferenza,acronimoConferenza)
                   values('2020-09-01','2020','ces20'),
                        ('2020-09-02','2020','ces20'),
                        ('2020-09-03','2020','ces20'),
                        ('2021-09-01','2021','ces21'),
                        ('2021-09-02','2021','ces21'),
                        ('2021-09-03','2021','ces21'),
                        ('2022-01-03','2022','mlpast'),
                        ('2022-09-01','2022','ces22'),
                        ('2022-09-02','2022','ces22'),
                        ('2022-09-03','2022','ces22'),
                        ('2022-10-01','2022','ss1'),
                        ('2022-10-02','2022','ss1'),
                        ('2022-10-03','2022','ss1'),
                        ('2022-10-04','2022','ss1'),
                        ('2022-11-01','2022','mlfuture'),
                        ('2023-09-01','2023','ces23'),
                        ('2023-09-02','2023','ces23'),
                        ('2023-09-03','2023','ces23');

insert into SESSIONE(codice,oraInizio,oraFine,titolo,linkStanza,numeroPresentazioni, giornoData, annoEdizioneConferenza, acronimoConferenza)
              values('1','08:00:00','12:00:00','sessione giorno 1 mattina','link','2','2022-09-01','2022','ces22'),
                    ('2','09:00:00','18:00:00','sessione giorno 2','link','0','2022-09-02','2022','ces22'),
                    ('3','10:00:00','12:00:00','sessione giorno 2 extra','link','0','2022-09-02','2022','ces22'),
                    ('4','08:00:00','14:00:00','sessione giorno 3 mattina','link','0','2022-09-03','2022','ces22'),
                    ('5','14:00:00','18:00:00','sessione giorno 3 pomeriggio' ,'link','0','2022-09-03','2022','ces22'),
                    ('6','08:00:00','20:00:00','prova chat' ,'link','0','2022-09-03','2022','ces22'),
                    ('7','08:00:00','20:00:00','prova chat' ,'link','1','2021-09-03','2021','ces21');

insert into PRESENTAZIONE(codice, codiceSessione, oraInizio, oraFine, numeroSequenza)
                    values('1','1','08:00:00','10:00:00','1'),
                          ('2','1','10:00:00','11:00:00','2'),
                          ('3','7','10:00:00','11:00:00','1');
                          
insert into ARTICOLO(codicePresentazione, codiceSessione, titolo, filePdf, numeroPagine,statoSvolgimento)
                values('1','1','electronic consumers','','1','non coperto');

insert into TUTORIAL(codicePresentazione, codiceSessione, titolo, abstract)
                values('2','1','come vendere elettronica','vendita elettronica al dettaglio');




insert into PRESENTAZIONEPRESENTER(userNameUtente, titoloArticolo, codicePresentazione, codiceSessione),
                            values('lightyear','electronic consumers','1','1');

insert into PRESENTAZIONESPEAKER(userNameUtente, titoloTutorial, codicePresentazione, codiceSessione, linkWeb, descrizione)
                        values('buzz','come vendere elettronica','2','1','','');


