

use CONFVIRTUAL;

insert into CONFERENZA(annoEdizione,acronimo,totaleSponsorizzazioni,immagineLogo,statoSvolgimento,nome)
values('2020','ces20','0','/uploads/img/logostock.jpg','completata','consumer electronic show 20'),
      ('2021','ces21','0','/uploads/img/logostock.jpg','completata','consumer electronics show 21'),
      ('2022','ces22','0','/uploads/img/logostock.jpg','attiva','consumer electronics show 22'),
      ('2022','mlfuture','0','/uploads/img/logostock.jpg','attiva','studio di machine learning futura'),
#       ('2022','mlpast','0','/uploads/img/logostock.jpg','completata','studio di machine learning passata'),
      ('2022','ss1','0','/uploads/img/logostock.jpg','attiva','sviluppo software I'),
      ('2022','prvcht','0','/uploads/img/logostock.jpg','attiva','conferenza prova chat'),
      ('2023','ces23','0','/uploads/img/logostock.jpg','attiva','consumer electronics show 23');


insert into DATACONFERENZA(giorno,annoEdizioneConferenza,acronimoConferenza)
values('2020-09-01','2020','ces20'),
#       ('2020-09-02','2020','ces20'),
      ('2021-09-01','2021','ces21'),
      ('2021-09-02','2021','ces21'),
      ('2021-09-03','2021','ces21'),
#       ('2022-01-03','2022','mlpast'),
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

      #prova chat
      ('2022-08-04','2022','prvcht'),
      ('2022-08-05','2022','prvcht'),
      ('2022-08-06','2022','prvcht'),
      ('2022-08-07','2022','prvcht');

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

      ('12','08:00:00','23:00:00','sesione giornaliera ces23' ,'link','1','2023-09-01','2023','ces23'),

      ('13','08:00:00','23:00:00','sesione giornaliera ces20' ,'link','1','2020-09-01','2020','ces20');
#       ('14','08:00:00','23:00:00','sesione giornaliera ces20' ,'link','1','2020-09-02','2020','ces20');





insert into PRESENTAZIONE(codice, codiceSessione, oraInizio, oraFine, numeroSequenza)
values('1','1','08:00:00','09:00:00','1'),        #tutorial
      ('2','1','09:00:00','10:00:00','2'),
      ('3','1','10:00:00','11:00:00','3'),        #articoli
      ('4','1','11:00:00','12:00:00','4'),

      ('5','2','09:00:00','11:00:00','1'),        #tutorial
      ('6','2','11:00:00','12:00:00','2'),
      ('7','2','12:00:00','14:00:00','3'),
      ('8','2','14:00:00','15:00:00','4'),        #articoli
      ('9','2','15:00:00','16:00:00','5'),
      ('10','2','16:00:00','17:00:00','6'),

      ('11','3','10:00:00','11:00:00','1'),        #tutorial
      ('12','3','11:00:00','12:00:00','2'),        #articoli

      ('13','4','08:00:00','09:00:00','1'),        #tutorial
      ('14','4','09:00:00','10:00:00','2'),
      ('15','4','10:00:00','11:00:00','3'),
      ('16','4','11:00:00','12:00:00','4'),        #articoli
      ('17','4','15:00:00','16:00:00','5'),
      ('18','4','16:00:00','17:00:00','6'),

      ('19','5','14:00:00','15:00:00','1'),        #tutorial
      ('20','5','16:00:00','17:00:00','2'),
      ('21','5','17:00:00','18:00:00','3'),        #articoli

      ('22','6','08:00:00','09:00:00','1'),        #tutorial
      ('23','6','09:00:00','10:00:00','2'),
      ('24','6','10:00:00','11:00:00','3'),
      ('25','6','11:00:00','12:00:00','4'),
      ('26','6','12:00:00','13:00:00','5'),        #articoli
      ('27','6','13:00:00','14:00:00','6'),
      ('28','6','14:00:00','15:00:00','7'),
      ('29','6','15:00:00','16:00:00','8'),
      ('30','6','16:00:00','17:00:00','9'),

      ('31','7','08:00:00','09:00:00','1'),        #tutorial
      ('32','7','09:00:00','10:00:00','2'),
      ('33','7','10:00:00','11:00:00','3'),
      ('34','7','11:00:00','12:00:00','4'),
      ('35','7','12:00:00','13:00:00','5'),        #articoli
      ('36','7','13:00:00','14:00:00','6'),
      ('37','7','14:00:00','15:00:00','7'),
      ('38','7','15:00:00','16:00:00','8'),
      ('39','7','16:00:00','17:00:00','9'),


      ('40','8','08:00:00','09:00:00','1'),        #tutorial
      ('41','8','09:00:00','10:00:00','2'),
      ('42','8','10:00:00','11:00:00','3'),
      ('43','8','11:00:00','12:00:00','4'),
      ('44','8','12:00:00','13:00:00','5'),        #articoli
      ('45','8','13:00:00','14:00:00','6'),
      ('46','8','14:00:00','15:00:00','7'),
      ('47','8','15:00:00','16:00:00','8'),
      ('48','8','16:00:00','17:00:00','9'),

      ('49','9','08:00:00','09:00:00','1'),        #tutorial
      ('50','9','09:00:00','10:00:00','2'),
      ('51','9','10:00:00','11:00:00','3'),
      ('52','9','11:00:00','12:00:00','4'),
      ('53','9','12:00:00','13:00:00','5'),        #articoli
      ('54','9','13:00:00','14:00:00','6'),
      ('55','9','14:00:00','15:00:00','7'),
      ('56','9','15:00:00','16:00:00','8'),
      ('57','9','16:00:00','17:00:00','9'),

      ('58','10','08:00:00','09:00:00','1'),        #tutorial
      ('59','10','09:00:00','10:00:00','2'),
      ('60','10','10:00:00','11:00:00','3'),
      ('61','10','11:00:00','12:00:00','4'),
      ('62','10','12:00:00','13:00:00','5'),        #articoli
      ('63','10','13:00:00','14:00:00','6'),
      ('64','10','14:00:00','15:00:00','7'),
      ('65','10','15:00:00','16:00:00','8'),
      ('66','10','16:00:00','17:00:00','9'),

      ('67','11','08:00:00','09:00:00','1'),        #tutorial
      ('68','11','09:00:00','10:00:00','2'),
      ('69','11','10:00:00','11:00:00','3'),
      ('70','11','11:00:00','12:00:00','4'),
      ('71','11','12:00:00','13:00:00','5'),        #articoli
      ('72','11','13:00:00','14:00:00','6'),
      ('73','11','14:00:00','15:00:00','7'),
      ('74','11','15:00:00','16:00:00','8'),
      ('75','11','16:00:00','17:00:00','9'),

      ('76','12','08:00:00','09:00:00','1'),        #tutorial                           #ces 23
      ('77','12','09:00:00','10:00:00','2'),
      ('78','12','10:00:00','11:00:00','3'),
      ('79','12','11:00:00','12:00:00','4'),
      ('80','12','12:00:00','13:00:00','5'),        #articoli
      ('81','12','13:00:00','14:00:00','6'),
      ('82','12','14:00:00','15:00:00','7'),
      ('83','12','15:00:00','16:00:00','8'),
      ('84','12','16:00:00','17:00:00','9'),

      ('85','13','08:00:00','09:00:00','1'),        #tutorial                           #ces 20
      ('86','13','09:00:00','10:00:00','2'),
      ('87','13','10:00:00','11:00:00','3'),
      ('88','13','11:00:00','12:00:00','4'),
      ('89','13','12:00:00','13:00:00','5'),        #articoli
      ('90','13','13:00:00','14:00:00','6'),
      ('91','13','14:00:00','15:00:00','7'),
      ('92','13','15:00:00','16:00:00','8'),
      ('93','13','16:00:00','17:00:00','9');






insert into CREATORICONFERENZA(userNameUtente, annoEdizioneConferenza, acronimoConferenza)
values('admin1','2020','ces20'),
      ('admin1','2021','ces21'),
      ('admin1','2022','ces22'),
      ('admin1','2022','mlfuture'),
#       ('admin1','2022','mlpast'),
      ('admin1','2022','ss1'),
      ('admin1','2022','prvcht'),
      ('admin1','2023','ces23');


insert into SPEAKER(userNameUtente, curriculum, foto, nomeUniversita, nomeDipartimento)
values('buzz', 'descrizione del curriculum','/uploads/img/avatar.jpg','unibo','dip informatica'),

      ('codgeruser', 'descrizione del curriculum','/uploads/img/avatar.jpg','unibo','dip informatica'),
      ('usermotion', 'descrizione del curriculum','/uploads/img/avatar.jpg','unibo','dip informatica'),
      ('userlard', 'descrizione del curriculum','/uploads/img/avatar.jpg','unibo','dip informatica'),
      ('fishuser', 'descrizione del curriculum','/uploads/img/avatar.jpg','unibo','dip informatica'),
      ('userflick', 'descrizione del curriculum','/uploads/img/avatar.jpg','unibo','dip informatica'),
      ('userpanties', 'descrizione del curriculum','/uploads/img/avatar.jpg','unibo','dip informatica'),
      ('relishuser', 'descrizione del curriculum','/uploads/img/avatar.jpg','unibo','dip informatica'),
      ('wearyuser', 'descrizione del curriculum','/uploads/img/avatar.jpg','unibo','dip informatica'),
      ('userpaperclips', 'descrizione del curriculum','/uploads/img/avatar.jpg','unibo','dip informatica'),
      ('userbottle', 'descrizione del curriculum','/uploads/img/avatar.jpg','unibo','dip informatica');

insert into AUTORE(codicePresentazione, codiceSessione, nome, cognome)      #per gli ARTICOLI
values('1','1','enzo','Rossi'),
      ('2','1','Jadon','Ward'),
      ('3','1','Layne','Bins'),
      ('4','1','Beau','Hills'),
      ('5','2','Ana','Brekke'),
      ('6','2','Alec','Bruen'),
      ('7','2','Baby','Ortiz'),
      ('8','2','Misael','Rau'),
      ('9','2','Dolly','Hahn'),
      ('10','2','Dax','Torphy'),

      ('11','3','Letha','Dach'),
      ('12','3','Lenny','Moen'),
      ('13','4','Merl','Green'),
      ('14','4','Josh','Wyman'),
      ('15','4','Gabe','Smith'),
      ('16','4','Mabel','Lind'),
      ('17','4','Hilda','Haag'),
      ('18','4','Orrin','Roob'),
      ('19','5','Cora','Bayer'),
      ('20','5','Kaya','Wolff'),
      ('21','5','Kevon','Beer'),
      ('22','6','Clare','Cole'),
      ('23','6','Jayne','Moen'),
      ('24','6','Lue','Cremin'),
      ('25','6','Lila','Hauck'),
      ('26','6','Art','Cremin'),
      ('27','6','Bettie','Orn'),
      ('28','6','Kole','Wolff'),
      ('29','6','Ali','Hudson'),
      ('30','6','Darius','Fay'),
      ('31','7','Cory','Crist'),
      ('32','7','Celia','Jast'),
      ('33','7','Jensen','Von'),
      ('34','7','Susie','Torp'),
      ('35','7','Rae','Crooks'),
      ('36','7','Eden','Lemke'),
      ('37','7','Jess','Doyle'),
      ('38','7','Cecil','Mann'),
      ('39','7','John','Fahey'),
      ('40','8','Anna','Doyle'),
      ('41','8','Noemy','King'),
      ('42','8','Jude','Blick'),
      ('43','8','Daren','Wiza'),
      ('44','8','Wilma','Rath'),
      ('45','8','Gwen','Sipes'),
      ('46','8','Fanny','Rice'),
      ('47','8','Icie','Blick'),
      ('48','8','Jairo','Haag'),
      ('49','9','Leonor','Von'),
      ('50','9','Flavie','Von'),
      ('51','9','Leann','Dare'),
      ('52','9','Maud','Boehm'),
      ('53','9','Dock','Beier'),
      ('54','9','Raheem','Fay'),
      ('55','9','Cali','Hayes'),
      ('56','9','Alek','Green'),
      ('57','9','Edna','Feest'),
      ('58','10','Layne','Bailey'),
      ('59','10','Blair','Ward'),
      ('60','10','Joey','Mann'),
      ('61','10','Sammy','Johns'),
      ('62','10','Viva','Veum'),
      ('63','10','Shany','Kulas'),
      ('64','10','Marie','Mraz'),
      ('65','10','Sven','Veum'),
      ('66','10','Sean','Haley'),
      ('67','11','Jewel','Welch'),
      ('68','11','Ethyl','Mohr'),
      ('69','11','Mable','Will'),
      ('70','11','John','Beer'),
      ('71','11','Dean','Stehr'),
      ('72','11','Rory','Kulas'),
      ('73','11','Lexus','Stamm'),
      ('74','11','Alize','Bode'),
      ('75','11','Percy','West'),
      ('76','12','Kirk','Conn'),
      ('77','12','Amina','Morar'),
      ('78','12','Santa','Yost'),
      ('79','12','Kolby','Auer'),
      ('80','12','Emmie','Wiza'),
      ('81','12','Orlo','Koch'),
      ('82','12','Freda','Jerde'),
      ('83','12','Tanya','Veum'),
      ('84','12','Mara','Howe'),



      ('89','13','Garry','Crona'),              #ces 20
      ('90','13','Bette','Feil'),
      ('91','13','Tony','Roob'),
      ('92','13','Kolby','Kutch'),
      ('93','13','Oliver','Hane');




insert into PRESENTER(userNameUtente, curriculum, foto, nomeUniversita, nomeDipartimento)
values('lightyear','descrizione del curriculum','/uploads/img/avatar.jpg','unibo', 'dip informatica' ),
      ('usereastern','descrizione del curriculum','/uploads/img/avatar.jpg','unibo', 'dip informatica' ),
      ('dogwatchuser','descrizione del curriculum','/uploads/img/avatar.jpg','unibo', 'dip informatica' ),
      ('userjapan','descrizione del curriculum','/uploads/img/avatar.jpg','unibo', 'dip informatica' ),
      ('spanishuser','descrizione del curriculum','/uploads/img/avatar.jpg','unibo', 'dip informatica' ),
      ('userfeisty','descrizione del curriculum','/uploads/img/avatar.jpg','unibo', 'dip informatica' ),
      ('userburnished','descrizione del curriculum','/uploads/img/avatar.jpg','unibo', 'dip informatica' ),
      ('userbong','descrizione del curriculum','/uploads/img/avatar.jpg','unibo', 'dip informatica' ),
      ('userfez','descrizione del curriculum','/uploads/img/avatar.jpg','unibo', 'dip informatica' ),
      ('userurn','descrizione del curriculum','/uploads/img/avatar.jpg','unibo', 'dip informatica' ),
      ('usermarbled','descrizione del curriculum','/uploads/img/avatar.jpg','unibo', 'dip informatica' );

insert into SPONSOR(nome, immagineLogo)
values('sponsorone','/uploads/img/logostock.jpg'),
      ('nokia','/uploads/img/logostock.jpg'),
      ('apple','/uploads/img/logostock.jpg'),
      ('samsung','/uploads/img/logostock.jpg'),
      ('olivetti','/uploads/img/logostock.jpg'),
      ('magneti marelli','/uploads/img/logostock.jpg');

insert into SPONSORIZZAZIONI(importo, annoEdizioneConferenza, acronimoConferenza, nomeSponsor)
values('350000','2020','ces20','sponsorone'),
#       ('540800','2021','ces21','nokia'),
      ('789900','2022','ces22','apple'),
      ('6700','2022','mlfuture','samsung'),
#       ('900','2022','mlpast','olivetti'),
      ('200','2022','ss1','nokia'),
      ('5300','2022','prvcht','apple');
#       ('5400','2023','ces23','olivetti');

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

#       ('userone','2022', 'mlpast'),
#       ('userfour','2022', 'mlpast'),

      ('userone','2022', 'prvcht'),
      ('usertwo','2022', 'prvcht'),
      ('userthree','2022', 'prvcht'),
      ('userten','2022', 'prvcht');


# insert into MESSAGGIO(ID, CODICESESSIONE, USERNAMEUTENTE, TESTO, DATAINVIO)
# values();

insert into TUTORIAL(codicePresentazione, codiceSessione, titolo, abstract)
values('1','1','come vendere elettronica','vendita elettronica al dettaglio'),
      ('2','1','come programmare','vendita elettronica al dettaglio'),

      ('5','2','come programmare','vendita elettronica al dettaglio'),
      ('6','2','come programmare','vendita elettronica al dettaglio'),
      ('7','2','come programmare','vendita elettronica al dettaglio'),

      ('11','3','come programmare','vendita elettronica al dettaglio'),

      ('13','4','come programmare','vendita elettronica al dettaglio'),
      ('14','4','come programmare','vendita elettronica al dettaglio'),
      ('15','4','come programmare','vendita elettronica al dettaglio'),

      ('19','5','come programmare','vendita elettronica al dettaglio'),
      ('20','5','come programmare','vendita elettronica al dettaglio'),

      ('22','6','come programmare','vendita elettronica al dettaglio'),
      ('23','6','come programmare','vendita elettronica al dettaglio'),   #fatto
      ('24','6','come programmare','vendita elettronica al dettaglio'),
      ('25','6','come programmare','vendita elettronica al dettaglio'),

      ('31','7','come programmare','vendita elettronica al dettaglio'),
      ('32','7','come programmare','vendita elettronica al dettaglio'),
      ('33','7','come programmare','vendita elettronica al dettaglio'),
      ('34','7','come programmare','vendita elettronica al dettaglio'),

      ('40','8','come programmare','vendita elettronica al dettaglio'),
      ('41','8','come programmare','vendita elettronica al dettaglio'),
      ('42','8','come programmare','vendita elettronica al dettaglio'),
      ('43','8','come programmare','vendita elettronica al dettaglio'),

      ('49','9','come programmare','vendita elettronica al dettaglio'),
      ('50','9','come programmare','vendita elettronica al dettaglio'),
      ('51','9','come programmare','vendita elettronica al dettaglio'),
      ('52','9','come programmare','vendita elettronica al dettaglio'),

      ('58','10','come programmare','vendita elettronica al dettaglio'),
      ('59','10','come programmare','vendita elettronica al dettaglio'),
      ('60','10','come programmare','vendita elettronica al dettaglio'),
      ('61','10','come programmare','vendita elettronica al dettaglio'),

      ('67','11','come programmare','vendita elettronica al dettaglio'),
      ('68','11','come programmare','vendita elettronica al dettaglio'),
      ('69','11','come programmare','vendita elettronica al dettaglio'),
      ('70','11','come programmare','vendita elettronica al dettaglio'),
      #ces23 futuro
      ('76','12','come programmare','vendita elettronica al dettaglio'),
      ('77','12','come programmare','vendita elettronica al dettaglio'),
      ('78','12','come programmare','vendita elettronica al dettaglio'),
      ('79','12','come programmare','vendita elettronica al dettaglio'),
      #ces20
      ('85','13','come programmare','vendita elettronica al dettaglio'),
      ('86','13','come programmare','vendita elettronica al dettaglio'),
      ('87','13','come programmare','vendita elettronica al dettaglio'),
      ('88','13','come programmare','vendita elettronica al dettaglio');



insert into ARTICOLO(codicePresentazione, codiceSessione, titolo, filePdf, numeroPagine,statoSvolgimento)
values('3','1','electronic consumers','/uploads/pdf/Sample.pdf','1','non coperto'),
      ('4','1','electronic consumers','/uploads/pdf/Sample.pdf','1','non coperto'),

      ('8','2','electronic consumers','/uploads/pdf/Sample.pdf','1','non coperto'),
      ('9','2','electronic consumers','/uploads/pdf/Sample.pdf','1','non coperto'),
      ('10','2','electronic consumers','/uploads/pdf/Sample.pdf','1','non coperto'),

      ('12','3','electronic consumers','/uploads/pdf/Sample.pdf','1','non coperto'),

      ('16','4','electronic consumers','/uploads/pdf/Sample.pdf','1','non coperto'),
      ('17','4','electronic consumers','/uploads/pdf/Sample.pdf','1','non coperto'),
      ('18','4','electronic consumers','/uploads/pdf/Sample.pdf','1','non coperto'),

      ('21','5','electronic consumers','/uploads/pdf/Sample.pdf','1','non coperto'),

      ('26','6','electronic consumers','/uploads/pdf/Sample.pdf','1','non coperto'),
      ('27','6','electronic consumers','/uploads/pdf/Sample.pdf','1','non coperto'),
      ('28','6','electronic consumers','/uploads/pdf/Sample.pdf','1','non coperto'),
      ('29','6','electronic consumers','/uploads/pdf/Sample.pdf','1','non coperto'),
      ('30','6','electronic consumers','/uploads/pdf/Sample.pdf','1','non coperto'),

      ('35','7','electronic consumers','/uploads/pdf/Sample.pdf','1','non coperto'),
      ('36','7','electronic consumers','/uploads/pdf/Sample.pdf','1','non coperto'),
      ('37','7','electronic consumers','/uploads/pdf/Sample.pdf','1','non coperto'),
      ('38','7','electronic consumers','/uploads/pdf/Sample.pdf','1','non coperto'),
      ('39','7','electronic consumers','/uploads/pdf/Sample.pdf','1','non coperto'),

      ('44','8','electronic consumers','/uploads/pdf/Sample.pdf','1','non coperto'),
      ('45','8','electronic consumers','/uploads/pdf/Sample.pdf','1','non coperto'),
      ('46','8','electronic consumers','/uploads/pdf/Sample.pdf','1','non coperto'),
      ('47','8','electronic consumers','/uploads/pdf/Sample.pdf','1','non coperto'),
      ('48','8','electronic consumers','/uploads/pdf/Sample.pdf','1','non coperto'),

      ('53','9','electronic consumers','/uploads/pdf/Sample.pdf','1','non coperto'),
      ('54','9','electronic consumers','/uploads/pdf/Sample.pdf','1','non coperto'),
      ('55','9','electronic consumers','/uploads/pdf/Sample.pdf','1','non coperto'),
      ('56','9','electronic consumers','/uploads/pdf/Sample.pdf','1','non coperto'),
      ('57','9','electronic consumers','/uploads/pdf/Sample.pdf','1','non coperto'),

      ('62','10','electronic consumers','/uploads/pdf/Sample.pdf','1','non coperto'),
      ('63','10','electronic consumers','/uploads/pdf/Sample.pdf','1','non coperto'),
      ('64','10','electronic consumers','/uploads/pdf/Sample.pdf','1','non coperto'),
      ('65','10','electronic consumers','/uploads/pdf/Sample.pdf','1','non coperto'),
      ('66','10','electronic consumers','/uploads/pdf/Sample.pdf','1','non coperto'),

      ('71','11','electronic consumers','/uploads/pdf/Sample.pdf','1','non coperto'),
      ('72','11','electronic consumers','/uploads/pdf/Sample.pdf','1','non coperto'),
      ('73','11','electronic consumers','/uploads/pdf/Sample.pdf','1','non coperto'),
      ('74','11','electronic consumers','/uploads/pdf/Sample.pdf','1','non coperto'),
      ('75','11','electronic consumers','/uploads/pdf/Sample.pdf','1','non coperto'),

      #ces 23 - futuro

      ('80','12','electronic consumers','/uploads/pdf/Sample.pdf','1','non coperto'),
      ('81','12','electronic consumers','/uploads/pdf/Sample.pdf','1','non coperto'),
      ('82','12','electronic consumers','/uploads/pdf/Sample.pdf','1','non coperto'),
      ('83','12','electronic consumers','/uploads/pdf/Sample.pdf','1','non coperto'),
      ('84','12','electronic consumers','/uploads/pdf/Sample.pdf','1','non coperto'),
      #ces20
      ('89','13','electronic consumers','/uploads/pdf/Sample.pdf','1','non coperto'),
      ('90','13','electronic consumers','/uploads/pdf/Sample.pdf','1','non coperto'),
      ('91','13','electronic consumers','/uploads/pdf/Sample.pdf','1','non coperto'),
      ('92','13','electronic consumers','/uploads/pdf/Sample.pdf','1','non coperto'),
      ('93','13','electronic consumers','/uploads/pdf/Sample.pdf','1','non coperto');


insert into PRESENTAZIONESPEAKER(userNameUtente,codicePresentazione, codiceSessione, linkWeb, descrizione)         # TUTORIAL     -------scrivere con selezioone verticale mouse
values('buzz','1','1','link','lorem ipsum'),
      ('codgeruser','6','2','link','lorem ipsum'),
      ('usermotion','7','2','link','lorem ipsum'),
      ('userlard','11','3','link','lorem ipsum'),
      ('fishuser','13','4','link','lorem ipsum'),
      ('userflick','14','4','link','lorem ipsum'),
      ('userpanties','15','4','link','lorem ipsum'),
      ('relishuser','19','5','link','lorem ipsum'),
      ('wearyuser','20','5','link','lorem ipsum'),
      ('userpaperclips','22','6','link','lorem ipsum'),
      ('userbottle','23','6','link','lorem ipsum'),
#       ('codgeruser','24','6','link','lorem ipsum'),
#       ('usermotion','25','6','link','lorem ipsum'),
#       ('userlard','31','7','link','lorem ipsum'),
#       ('fishuser','32','7','link','lorem ipsum'),
      ('userflick','33','7','link','lorem ipsum'),
      ('userpanties','34','7','link','lorem ipsum'),
      ('relishuser','40','8','link','lorem ipsum'),
      ('wearyuser','41','8','link','lorem ipsum'),
      ('userpaperclips','42','8','link','lorem ipsum'),
      ('userbottle','43','8','link','lorem ipsum'),
      ('codgeruser','49','9','link','lorem ipsum'),
#       ('usermotion','50','9','link','lorem ipsum'),
#       ('userlard','51','9','link','lorem ipsum'),
#       ('fishuser','52','9','link','lorem ipsum'),
#       ('userflick','58','10','link','lorem ipsum'),
      ('userpanties','59','10','link','lorem ipsum'),
      ('relishuser','60','10','link','lorem ipsum'),
      ('wearyuser','61','10','link','lorem ipsum'),
      ('userpaperclips','67','11','link','lorem ipsum'),
      ('userbottle','68','11','link','lorem ipsum'),
      ('codgeruser','69','11','link','lorem ipsum'),
      ('usermotion','70','11','link','lorem ipsum'),
      ('fishuser','76','12','link','lorem ipsum'),
      ('userflick','77','12','link','lorem ipsum'),
      ('userpanties','78','12','link','lorem ipsum'),
#       ('relishuser','79','12','link','lorem ipsum'),
#       ('wearyuser','85','13','link','lorem ipsum'),
#       ('userpaperclips','86','13','link','lorem ipsum'),
      ('userbottle','87','13','link','lorem ipsum'),
      ('codgeruser','88','13','link','lorem ipsum');





insert into PRESENTAZIONEPRESENTER(userNameUtente, codicePresentazione, codiceSessione)                            #  ARTICOLO
values('lightyear','3','1'),
      ('usereastern','4','1'),
      ('dogwatchuser','8','2'),
      ('userjapan','9','2'),
      ('spanishuser','10','2'),
      ('userfeisty','12','3'),
      ('userburnished','16','4'),
#       ('userbong','17','4'),
      ('userfez','18','4'),
      ('userurn','21','5'),
      ('usermarbled','26','6'),
      ('lightyear','27','6'),
      ('usereastern','28','6'),
      ('dogwatchuser','29','6'),
      ('userjapan','30','6'),
      ('spanishuser','35','7'),
      ('userfeisty','36','7'),
      ('userburnished','37','7'),
      ('userbong','38','7'),
      ('userfez','39','7'),
      ('userurn','44','8'),
#       ('usermarbled','45','8'),
      ('lightyear','46','8'),
      ('usereastern','47','8'),
#       ('dogwatchuser','48','8'),
#       ('userjapan','53','9'),
#       ('spanishuser','54','9'),
#       ('userfeisty','55','9'),
#       ('userburnished','56','9'),
#       ('userbong','57','9'),
      ('userfez','62','10'),
      ('userurn','63','10'),
      ('usermarbled','64','10'),
      ('lightyear','65','10'),
      ('usereastern','66','10'),
      ('dogwatchuser','71','11'),
#       ('userjapan','72','11'),
#       ('spanishuser','73','11'),
#       ('userfeisty','74','11'),
      ('userburnished','75','11'),
      ('userfez','80','12'),
      ('userurn','81','12'),
      ('usermarbled','82','12'),
      ('lightyear','83','12'),
      ('usereastern','84','12'),
#       ('usereastern','89','13'),
#       ('dogwatchuser','90','13'),
#       ('userjapan','91','13'),
      ('spanishuser','92','13'),
      ('userfeisty','93','13');

insert into PAROLACHIAVE(parola, codicePresentazione, codiceSessione)   # ARTICOLI
values('mission','3','1'),('sounder','3','1'),('fluther','3','1'),('clowder','3','1'),
      ('descent','4','1'),('nursery','4','1'),('journey','4','1'),('prickle','4','1'),
      ('unction','8','2'),('coterie','8','2'),('draught','8','2'),('quarrel','8','2'),
      ('cluster','9','2'),('bouquet','9','2'),('scourge','9','2'),('surfeit','9','2'),

      ('clutter','10','2'),('complex','10','2'),('dossier','10','2'),('cortege','10','2'),
      ('cortege','12','3'),('scourge','12','3'),('complex','12','3'),('sounder','12','3'),
      ('glozing','16','4'),('clowder','16','4'),('faculty','16','4'),('promise','16','4'),
      ('culture','17','4'),('clutter','17','4'),('quarrel','17','4'),('dopping','17','4'),
      ('promise','18','4'),('doading','18','4'),('shrivel','18','4'),('glaring','18','4'),
      ('rangale','21','5'),('network','21','5'),('clamour','21','5'),('fluther','21','5'),
      ('shrivel','26','6'),('glaring','26','6'),('surfeit','26','6'),('thought','26','6'),
      ('doading','27','6'),('nursery','27','6'),('fluther','27','6'),('pitying','27','6'),
      ('rookery','28','6'),('sounder','28','6'),('rangale','28','6'),('fluther','28','6'),
      ('fanfare','29','6'),('doading','29','6'),('company','29','6'),('culture','29','6'),
      ('network','30','6'),('library','30','6'),('bouquet','30','6'),('unction','30','6'),
      ('faculty','35','7'),('dopping','35','7'),('draught','35','7'),('prickle','35','7'),
      ('chapter','36','7'),('cluster','36','7'),('sownder','36','7'),('phalanx','36','7'),
      ('library','37','7'),('unction','37','7'),('rookery','37','7'),('dossier','37','7'),
      ('balance','38','7'),('prickle','38','7'),('thought','38','7'),('doading','38','7'),
      ('sownder','39','7'),('descent','39','7'),('balance','39','7'),('chapter','39','7'),
      ('worship','44','8'),('coterie','44','8'),('journey','44','8'),('rangale','44','8'),
      ('pitying','45','8'),('cortege','45','8'),('worship','45','8'),('fanfare','45','8'),
      ('dossier','46','8'),('phalanx','46','8'),('coterie','46','8'),('quarrel','46','8'),
      ('linkage','47','8'),('chapter','47','8'),('mission','47','8'),('library','47','8'),
      ('phalanx','48','8'),('linkage','48','8'),('balance','48','8'),('complex','48','8'),
      ('linkage','53','9'),('culture','53','9'),('shrivel','53','9'),('company','53','9'),
      ('thought','54','9'),('glozing','54','9'),('surfeit','54','9'),('sownder','54','9'),
      ('clamour','55','9'),('mission','55','9'),('glozing','55','9'),('scourge','55','9'),
      ('dopping','56','9'),('pitying','56','9'),('worship','56','9'),('linkage','56','9'),
      ('glaring','57','9'),('fanfare','57','9'),('bouquet','57','9'),('journey','57','9'),

      ('network','62','10'),('chapter','62','10'),('glozing','62','10'),('cortege','62','10'),
      ('faculty','63','10'),('promise','63','10'),('clutter','63','10'),('worship','63','10'),
      ('draught','64','10'),('clamour','64','10'),('rangale','64','10'),('network','64','10'),
      ('rookery','65','10'),('unction','65','10'),('culture','65','10'),('chapter','65','10'),
      ('clutter','66','10'),('company','66','10'),('journey','66','10'),('promise','66','10'),
      ('cluster','71','11'),('bouquet','71','11'),('rookery','71','11'),('clamour','71','11'),
      ('nursery','72','11'),('complex','72','11'),('descent','72','11'),('unction','72','11'),
      ('clowder','73','11'),('descent','73','11'),('balance','73','11'),('company','73','11'),
      ('fluther','74','11'),('faculty','74','11'),('coterie','74','11'),('bouquet','74','11'),
      ('draught','75','11'),('cluster','75','11'),('prickle','75','11'),('complex','75','11'),
      ('doading','80','12'),('sownder','80','12'),('library','80','12'),('descent','80','12'),
      ('scourge','81','12'),('dopping','81','12'),('fluther','81','12'),('faculty','81','12'),
      ('sounder','82','12'),('shrivel','82','12'),('draught','82','12'),('cluster','82','12'),
      ('thought','83','12'),('phalanx','83','12'),('doading','83','12'),('sownder','83','12'),
      ('mission','84','12'),('clowder','84','12'),('scourge','84','12'),('dopping','84','12'),
      ('dossier','89','13'),('fanfare','89','13'),('sounder','89','13'),('shrivel','89','13'),
      ('linkage','90','13'),('quarrel','90','13'),('thought','90','13'),('phalanx','90','13'),
      ('cortege','91','13'),('glaring','91','13'),('mission','91','13'),('clowder','91','13'),
      ('worship','92','13'),('surfeit','92','13'),('dossier','92','13'),('fanfare','92','13'),
      ('network','93','13'),('pitying','93','13'),('linkage','93','13'),('quarrel','93','13');



insert into VALUTAZIONE(userNameUtente, codicePresentazione, codiceSessione, voto, note)
values ('admin1','1','1','4','recensione lorem ipsum'),('admin5','1','1','4','seconda recensione lorem ipsum'),
       ('admin2','2','1','4','recensione lorem ipsum'),('admin6','2','1','4','seconda recensione lorem ipsum'),
       ('admin3','3','1','4','recensione lorem ipsum'),('admin7','3','1','4','seconda recensione lorem ipsum'),
       ('admin2','4','1','5','recensione lorem ipsum'),('admin8','4','1','5','seconda recensione lorem ipsum'),
       ('admin4','5','2','2','recensione lorem ipsum'),('admin5','5','2','2','seconda recensione lorem ipsum'),
       ('admin4','6','2','4','recensione lorem ipsum'),('admin6','6','2','4','seconda recensione lorem ipsum'),
       ('admin1','7','2','4','recensione lorem ipsum'),('admin7','7','2','4','seconda recensione lorem ipsum'),
       ('admin2','8','2','4','recensione lorem ipsum'),('admin8','8','2','4','seconda recensione lorem ipsum'),
       ('admin3','9','2','4','recensione lorem ipsum'),('admin5','9','2','4','seconda recensione lorem ipsum'),

       ('admin2','11','3','3','recensione lorem ipsum'),('admin5','11','3','3','seconda recensione lorem ipsum'),
       ('admin3','12','3','3','recensione lorem ipsum'),('admin6','12','3','3','seconda recensione lorem ipsum'),
       ('admin4','13','4','3','recensione lorem ipsum'),('admin7','13','4','3','seconda recensione lorem ipsum'),
       ('admin1','14','4','3','recensione lorem ipsum'),('admin8','14','4','3','seconda recensione lorem ipsum'),
       ('admin2','15','4','3','recensione lorem ipsum'),('admin5','15','4','3','seconda recensione lorem ipsum'),
       ('admin3','16','4','3','recensione lorem ipsum'),('admin6','16','4','3','seconda recensione lorem ipsum'),
       ('admin2','17','4','3','recensione lorem ipsum'),('admin7','17','4','3','seconda recensione lorem ipsum'),
       ('admin3','18','4','3','recensione lorem ipsum'),('admin8','18','4','3','seconda recensione lorem ipsum'),
       ('admin4','19','5','3','recensione lorem ipsum'),('admin5','19','5','3','seconda recensione lorem ipsum'),
       ('admin1','20','5','3','recensione lorem ipsum'),('admin5','20','5','3','seconda recensione lorem ipsum'),
       ('admin2','21','5','3','recensione lorem ipsum'),('admin6','21','5','3','seconda recensione lorem ipsum'),
       ('admin3','22','6','3','recensione lorem ipsum'),('admin7','22','6','3','seconda recensione lorem ipsum'),
       ('admin2','23','6','3','recensione lorem ipsum'),('admin8','23','6','3','seconda recensione lorem ipsum'),
       ('admin3','24','6','4','recensione lorem ipsum'),('admin5','24','6','4','seconda recensione lorem ipsum'),
       ('admin4','25','6','4','recensione lorem ipsum'),('admin6','25','6','4','seconda recensione lorem ipsum'),
       ('admin1','26','6','4','recensione lorem ipsum'),('admin7','26','6','4','seconda recensione lorem ipsum'),
       ('admin2','27','6','4','recensione lorem ipsum'),('admin8','27','6','4','seconda recensione lorem ipsum'),
       ('admin3','28','6','4','recensione lorem ipsum'),('admin5','28','6','4','seconda recensione lorem ipsum'),
       ('admin2','29','6','4','recensione lorem ipsum'),('admin6','29','6','4','seconda recensione lorem ipsum'),
       ('admin3','30','6','4','recensione lorem ipsum'),('admin7','30','6','4','seconda recensione lorem ipsum'),
       ('admin4','31','7','4','recensione lorem ipsum'),('admin8','31','7','4','seconda recensione lorem ipsum'),
       ('admin1','32','7','4','recensione lorem ipsum'),('admin5','32','7','4','seconda recensione lorem ipsum'),
       ('admin2','33','7','4','recensione lorem ipsum'),('admin6','33','7','4','seconda recensione lorem ipsum'),
       ('admin3','34','7','4','recensione lorem ipsum'),('admin7','34','7','4','seconda recensione lorem ipsum'),
       ('admin2','35','7','7','recensione lorem ipsum'),('admin8','35','7','7','seconda recensione lorem ipsum'),
       ('admin3','36','7','7','recensione lorem ipsum'),('admin5','36','7','7','seconda recensione lorem ipsum'),
       ('admin4','37','7','7','recensione lorem ipsum'),('admin5','37','7','7','seconda recensione lorem ipsum'),
       ('admin1','38','7','7','recensione lorem ipsum'),('admin6','38','7','7','seconda recensione lorem ipsum'),
       ('admin2','39','7','7','recensione lorem ipsum'),('admin7','39','7','7','seconda recensione lorem ipsum'),
       ('admin3','40','8','7','recensione lorem ipsum'),('admin8','40','8','7','seconda recensione lorem ipsum'),
       ('admin2','41','8','7','recensione lorem ipsum'),('admin5','41','8','7','seconda recensione lorem ipsum'),
       ('admin3','42','8','7','recensione lorem ipsum'),('admin6','42','8','7','seconda recensione lorem ipsum'),
       ('admin4','43','8','9','recensione lorem ipsum'),('admin7','43','8','9','seconda recensione lorem ipsum'),
       ('admin1','44','8','9','recensione lorem ipsum'),('admin8','44','8','9','seconda recensione lorem ipsum'),
       ('admin2','45','8','9','recensione lorem ipsum'),('admin5','45','8','9','seconda recensione lorem ipsum'),
       ('admin3','46','8','9','recensione lorem ipsum'),('admin6','46','8','9','seconda recensione lorem ipsum'),
       ('admin2','47','8','9','recensione lorem ipsum'),('admin7','47','8','9','seconda recensione lorem ipsum'),
       ('admin3','48','8','9','recensione lorem ipsum'),('admin8','48','8','9','seconda recensione lorem ipsum'),
       ('admin1','49','9','3','recensione lorem ipsum'),('admin5','49','9','3','seconda recensione lorem ipsum'),
       ('admin2','50','9','6','recensione lorem ipsum'),('admin6','50','9','6','seconda recensione lorem ipsum'),
       ('admin3','51','9','9','recensione lorem ipsum'),('admin7','51','9','9','seconda recensione lorem ipsum'),
       ('admin2','52','9','3','recensione lorem ipsum'),('admin8','52','9','3','seconda recensione lorem ipsum'),
       ('admin4','53','9','6','recensione lorem ipsum'),('admin5','53','9','6','seconda recensione lorem ipsum'),
       ('admin4','54','9','9','recensione lorem ipsum'),('admin6','54','9','9','seconda recensione lorem ipsum'),
       ('admin1','55','9','3','recensione lorem ipsum'),('admin7','55','9','3','seconda recensione lorem ipsum'),
       ('admin2','56','9','6','recensione lorem ipsum'),('admin8','56','9','6','seconda recensione lorem ipsum'),
       ('admin3','57','9','9','recensione lorem ipsum'),('admin5','57','9','9','seconda recensione lorem ipsum'),

       ('admin1','58','10','3','recensione lorem ipsum'),('admin5','58','10','3','seconda recensione lorem ipsum'),
       ('admin2','59','10','6','recensione lorem ipsum'),('admin6','59','10','6','seconda recensione lorem ipsum'),
       ('admin3','60','10','9','recensione lorem ipsum'),('admin7','60','10','9','seconda recensione lorem ipsum'),
       ('admin2','61','10','3','recensione lorem ipsum'),('admin8','61','10','3','seconda recensione lorem ipsum'),
       ('admin1','62','10','6','recensione lorem ipsum'),('admin5','62','10','6','seconda recensione lorem ipsum'),
       ('admin2','63','10','9','recensione lorem ipsum'),('admin6','63','10','9','seconda recensione lorem ipsum'),
       ('admin3','64','10','3','recensione lorem ipsum'),('admin7','64','10','3','seconda recensione lorem ipsum'),
       ('admin2','65','10','6','recensione lorem ipsum'),('admin8','65','10','6','seconda recensione lorem ipsum'),
       ('admin3','66','10','9','recensione lorem ipsum'),('admin5','66','10','9','seconda recensione lorem ipsum'),
       ('admin4','67','11','3','recensione lorem ipsum'),('admin5','67','11','3','seconda recensione lorem ipsum'),
       ('admin1','68','11','6','recensione lorem ipsum'),('admin6','68','11','6','seconda recensione lorem ipsum'),
       ('admin2','69','11','9','recensione lorem ipsum'),('admin7','69','11','9','seconda recensione lorem ipsum'),
       ('admin3','70','11','3','recensione lorem ipsum'),('admin8','70','11','3','seconda recensione lorem ipsum'),
       ('admin2','71','11','6','recensione lorem ipsum'),('admin5','71','11','6','seconda recensione lorem ipsum'),
       ('admin3','72','11','9','recensione lorem ipsum'),('admin6','72','11','9','seconda recensione lorem ipsum'),
       ('admin4','73','11','3','recensione lorem ipsum'),('admin7','73','11','3','seconda recensione lorem ipsum'),
       ('admin1','74','11','6','recensione lorem ipsum'),('admin8','74','11','6','seconda recensione lorem ipsum'),
       ('admin2','75','11','9','recensione lorem ipsum'),('admin5','75','11','9','seconda recensione lorem ipsum'),
       ('admin3','76','12','3','recensione lorem ipsum'),('admin6','76','12','3','seconda recensione lorem ipsum'),
       ('admin2','77','12','6','recensione lorem ipsum'),('admin7','77','12','6','seconda recensione lorem ipsum'),
       ('admin3','78','12','9','recensione lorem ipsum'),('admin8','78','12','9','seconda recensione lorem ipsum'),
       ('admin4','79','12','3','recensione lorem ipsum'),('admin5','79','12','3','seconda recensione lorem ipsum'),
       ('admin1','80','12','6','recensione lorem ipsum'),('admin6','80','12','6','seconda recensione lorem ipsum'),
       ('admin2','81','12','9','recensione lorem ipsum'),('admin7','81','12','9','seconda recensione lorem ipsum'),
       ('admin3','82','12','3','recensione lorem ipsum'),('admin8','82','12','3','seconda recensione lorem ipsum'),
       ('admin2','83','12','6','recensione lorem ipsum'),('admin5','83','12','6','seconda recensione lorem ipsum'),
       ('admin3','84','12','9','recensione lorem ipsum'),('admin5','84','12','9','seconda recensione lorem ipsum'),
       ('admin3','85','13','3','recensione lorem ipsum'),('admin6','85','13','3','seconda recensione lorem ipsum'),
       ('admin2','86','13','6','recensione lorem ipsum'),('admin7','86','13','6','seconda recensione lorem ipsum'),
       ('admin3','87','13','9','recensione lorem ipsum'),('admin8','87','13','9','seconda recensione lorem ipsum'),
       ('admin4','88','13','3','recensione lorem ipsum'),('admin5','88','13','3','seconda recensione lorem ipsum'),
#        ('admin1','89','13','6','recensione lorem ipsum'),('admin6','89','13','6','seconda recensione lorem ipsum'),
       ('admin2','90','13','9','recensione lorem ipsum'),('admin7','90','13','9','seconda recensione lorem ipsum'),
       ('admin3','91','13','3','recensione lorem ipsum'),('admin8','91','13','3','seconda recensione lorem ipsum'),
       ('admin2','92','13','6','recensione lorem ipsum'),('admin5','92','13','6','seconda recensione lorem ipsum'),
       ('admin3','93','13','9','recensione lorem ipsum'),('admin6','93','13','9','seconda recensione lorem ipsum');

