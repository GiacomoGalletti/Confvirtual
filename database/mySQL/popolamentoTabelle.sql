

use CONFVIRTUAL;

insert into CONFERENZA(annoEdizione,acronimo,totaleSponsorizzazioni,immagineLogo,statoSvolgimento,nome)
                values('2020','ces20','0','/uploads/img/logostock.jpg','completata','consumer electronic show 20'),
                       ( '2021','ces21','0','/uploads/img/logostock.jpg','completata','consumer electronics show 21'),
                        ('2022','ces22','0','/uploads/img/logostock.jpg','attiva','consumer electronics show 22'),
                        ('2022','mlfuture','0','/uploads/img/logostock.jpg','attiva','studio di machine learning futura'),
                        ('2022','mlpast','0','/uploads/img/logostock.jpg','completata','studio di machine learning passata'),
                        ('2022','ss1','0','/uploads/img/logostock.jpg','attiva','sviluppo software I'),
                        ('2022','prvcht','0','/uploads/img/logostock.jpg','attiva','conferenza prova chat'),
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
                        ('2023-09-03','2023','ces23'),

                        ('2022-08-01','2022','prvcht'),      #prova chat
                        ('2022-08-02','2022','prvcht'),
                        ('2022-08-03','2022','prvcht'),
                        ('2022-08-04','2022','prvcht'),
                        ('2022-08-05','2022','prvcht'),
                        ('2022-08-06','2022','prvcht'),
                        ('2022-08-07','2022','prvcht'),
                        ('2022-08-08','2022','prvcht'),
                        ('2022-08-09','2022','prvcht'),
                        ('2022-08-10','2022','prvcht'),
                        ('2022-08-11','2022','prvcht'),
                        ('2022-08-12','2022','prvcht'),
                        ('2022-08-13','2022','prvcht');

insert into SESSIONE(codice,oraInizio,oraFine,titolo,linkStanza,numeroPresentazioni, giornoData, annoEdizioneConferenza, acronimoConferenza)
              values('1','08:00:00','12:00:00','sessione giorno 1 mattina','link','2','2022-09-01','2022','ces22'),
                    ('2','09:00:00','18:00:00','sessione giorno 2','link','0','2022-09-02','2022','ces22'),
                    ('3','10:00:00','12:00:00','sessione giorno 2 extra','link','0','2022-09-02','2022','ces22'),
                    ('4','08:00:00','14:00:00','sessione giorno 3 mattina','link','0','2022-09-03','2022','ces22'),
                    ('5','14:00:00','18:00:00','sessione giorno 3 pomeriggio' ,'link','0','2022-09-03','2022','ces22'),
                    ('6','08:00:00','20:00:00','sessione giorno 2' ,'link','1','2022-09-03','2022','ces22'),
                    ('7','08:00:00','20:00:00','sesione giornaliera' ,'link','1','2021-09-03','2021','ces21'),

                    ('8','08:00:00','23:00:00','sesione giornaliera prova chat' ,'link','1','2022-08-04','2022','prvcht'),  #sempre attive per prova chat
                    ('9','08:00:00','23:00:00','sesione giornaliera prova chat' ,'link','1','2022-08-05','2022','prvcht'),
                    ('10','08:00:00','23:00:00','sesione giornaliera prova chat' ,'link','1','2022-08-06','2022','prvcht'),
                    ('11','08:00:00','23:00:00','sesione giornaliera prova chat' ,'link','1','2022-08-07','2022','prvcht'),
                    ('12','08:00:00','23:00:00','sesione giornaliera prova chat' ,'link','1','2022-08-08','2022','prvcht'),
                    ('13','08:00:00','23:00:00','sesione giornaliera prova chat' ,'link','1','2022-08-09','2022','prvcht'),

                    ('14','08:00:00','23:00:00','sesione giornaliera ces20' ,'link','1','2020-09-01','2020','ces20');




insert into PRESENTAZIONE(codice, codiceSessione, oraInizio, oraFine, numeroSequenza)
                    values('1','1','08:00:00','10:00:00','1'),        #tutorial
                          ('2','1','10:00:00','11:00:00','2'),
                          ('3','7','10:00:00','11:00:00','1'),

                          ('4','8','09:00:00','11:00:00','1'),
                          ('5','8','12:00:00','14:00:00','2'),

                          ('6','9','09:00:00','11:00:00','1'),
                          ('7','9','12:00:00','14:00:00','2'),

                          ('8','10','09:00:00','11:00:00','1'),
                          ('9','10','12:00:00','14:00:00','2'),

                          ('10','11','09:00:00','11:00:00','1'),
                          ('11','11','12:00:00','14:00:00','2'),
                                                                        #articoli
                          ('12','10','09:00:00','11:00:00','1'),
                          ('13','10','12:00:00','14:00:00','2'),

                          ('14','11','09:00:00','11:00:00','1'),
                          ('15','11','12:00:00','14:00:00','2'),

                          ('16','14','12:00:00','14:00:00','1');







insert into CREATORICONFERENZA(userNameUtente, annoEdizioneConferenza, acronimoConferenza)
                        values('admin1','2022','ces22'),
                              ('admin1','2020','ces20'),
                              ('admin2','2022','prvcht');

insert into SPEAKER(userNameUtente, curriculum, foto, nomeUniversita, nomeDipartimento)
            values('buzz', 'descrizione del curriculum','/uploads/img/avatar.jpg','unibo','dip informatica'),
                  ('userone', 'descrizione del curriculum','/uploads/img/avatar.jpg','unibo','dip informatica');

insert into AUTORE(codicePresentazione, codiceSessione, nome, cognome)
            values('4','8','enzo','como');

insert into PRESENTER(userNameUtente, curriculum, foto, nomeUniversita, nomeDipartimento)
                values('lightyear','descrizione del curriculum','/uploads/img/avatar.jpg','unibo', 'dip informatica' ),
                      ('userten','descrizione del curriculum','/uploads/img/avatar.jpg','unibo', 'dip informatica' );

insert into SPONSOR(nome, immagineLogo)
            values('sponsorone','/uploads/img/logostock.jpg'),
                  ('nokia','/uploads/img/logostock.jpg'),
                  ('apple','/uploads/img/logostock.jpg'),
                  ('samsung','/uploads/img/logostock.jpg'),
                  ('olivetti','/uploads/img/logostock.jpg'),
                  ('magneti marelli','/uploads/img/logostock.jpg');

insert into SPONSORIZZAZIONI(importo, annoEdizioneConferenza, acronimoConferenza, nomeSponsor)
                      values('250000','2020','ces20','sponsorone'),
                            ('350000','2021','ces21','nokia'),
                            ('18000','2022','ces22','apple'),
                            ('400','2022','mlfuture','samsung'),
                            ('1000','2022','mlpast','olivetti'),
                            ('4500','2023','ces23','olivetti');

insert into UTENTEREGISTRATO(userNameUtente, annoEdizioneconferenza, acronimoConferenza)
                      values('userone','2020', 'ces20'),
                            ('usertwo','2020', 'ces20'),
                            ('userthree','2020', 'ces20'),
                            ('userfour','2020', 'ces20'),
                            ('userfive','2020', 'ces20'),

                            ('userone','2021', 'ces21'),
                            ('usertwo','2021', 'ces21'),
                            ('userthree','2021', 'ces21'),

                            ('userone','2022', 'ces22'),
                            ('usertwo','2022', 'ces22'),
                            ('userthree','2022', 'ces22'),

                            ('userone','2022', 'mlfuture'),
                            ('usertwo','2022', 'mlfuture'),
                            ('userthree','2022', 'mlfuture'),

                            ('userone','2022', 'mlpast'),
                            ('userfour','2022', 'mlpast'),

                            ('userone','2022', 'prvcht'),
                            ('usertwo','2022', 'prvcht'),
                            ('userthree','2022', 'prvcht'),
                            ('userten','2022', 'prvcht');


# insert into MESSAGGIO(ID, CODICESESSIONE, USERNAMEUTENTE, TESTO, DATAINVIO)
# values();

insert into TUTORIAL(codicePresentazione, codiceSessione, titolo, abstract)
              values('1','1','come vendere elettronica','vendita elettronica al dettaglio'),
                    ('2','1','come programmare','vendita elettronica al dettaglio'),
                    ('3','7','come vendere chip','vendita elettronica al dettaglio'),
                    ('4','8','come vendere elettronica','vendita elettronica al dettaglio'),
                    ('5','8','come programmare','vendita elettronica al dettaglio'),
                    ('6','9','come vendere chip','vendita elettronica al dettaglio'),
                    ('7','9','come vendere elettronica','vendita elettronica al dettaglio'),
                    ('8','10','come programmare','vendita elettronica al dettaglio'),
                    ('9','10','come vendere chip','vendita elettronica al dettaglio'),
                    ('10','11','come vendere chip','vendita elettronica al dettaglio'),
                    ('11','11','come vendere chip','vendita elettronica al dettaglio');

insert into ARTICOLO(codicePresentazione, codiceSessione, titolo, filePdf, numeroPagine,statoSvolgimento)
                values('12','10','electronic consumers','/uploads/pdf/Sample.pdf','1','non coperto'),
                      ('13','10','l informatica','/uploads/pdf/Sample.pdf','1','non coperto'),
                      ('14','11','storia tecnica','/uploads/pdf/Sample.pdf','1','non coperto'),
                      ('15','11','articolone','/uploads/pdf/Sample.pdf','1','non coperto'),
                      ('16','14','articolone','/uploads/pdf/Sample.pdf','1','non coperto');

insert into PRESENTAZIONESPEAKER(userNameUtente, titoloTutorial, codicePresentazione, codiceSessione, linkWeb, descrizione)
                          values('buzz','come vendere elettronica','1','1','link','lorem ipsum'),
                                ('userone','come programmare','2','1','link','lorem ipsum'),
                                ('buzz','come vendere chip','3','7','link','lorem ipsum'),
                                ('userone','come vendere elettronica','4','8','link','lorem ipsum');

insert into PRESENTAZIONEPRESENTER(userNameUtente, titoloArticolo, codicePresentazione, codiceSessione)
                            values('lightyear','electronic consumers','12','10'),
                                  ('userten','l informatica','13','10'),
                                  ('lightyear','storia tecnica','14','11'),
                                  ('userten','l informatica','15','11'),
                                  ('lightyear','articolone','16','14');

# insert into PAROLACHIAVE(parola, codicePresentazione, codiceSessione)
#                 values();

insert into VALUTAZIONE(userNameUtente, codicePresentazione, codiceSessione, voto, note)
                 values ('admin1','1','1','4','recensione lorem ipsum'),
                        ('admin2','2','1','4','recensione lorem ipsum'),
                        ('admin3','3','7','4','recensione lorem ipsum'),
                        ('admin4','4','8','4','recensione lorem ipsum'),
                        ('admin1','5','8','4','recensione lorem ipsum'),
                        ('admin2','6','9','4','recensione lorem ipsum'),
                        ('admin3','7','9','4','recensione lorem ipsum'),
                        ('admin4','8','10','4','recensione lorem ipsum'),
                        ('admin1','9','10','4','recensione lorem ipsum'),
                        ('admin2','10','11','4','recensione lorem ipsum'),
                        ('admin3','11','11','4','recensione lorem ipsum'),
                        ('admin4','12','10','4','recensione lorem ipsum'),
                        ('admin1','13','10','4','recensione lorem ipsum'),
                        ('admin2','14','11','4','recensione lorem ipsum'),
                        ('admin3','15','11','4','recensione lorem ipsum');
