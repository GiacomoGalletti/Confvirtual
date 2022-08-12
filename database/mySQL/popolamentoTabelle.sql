

use CONFVIRTUAL;

insert into CONFERENZA(annoEdizione,acronimo,totaleSponsorizzazioni,immagineLogo,statoSvolgimento,nome)
values('2020','ces20','0','/uploads/img/logostock.jpg','completata','consumer electronic show 20'),
      ('2021','ces21','0','/uploads/img/logostock.jpg','completata','consumer electronics show 21'),
      ('2022','ces22','0','/uploads/img/logostock.jpg','attiva','consumer electronics show 22'),
      ('2022','mlfuture','0','/uploads/img/logostock.jpg','attiva','studio di machine learning futura'),
      ('2022','mlpast','0','/uploads/img/logostock.jpg','completata','studio di machine learning passata'),
      ('2022','ss1','0','/uploads/img/logostock.jpg','attiva','sviluppo software I'),
      ('2022','prvcht','0','/uploads/img/logostock.jpg','attiva','conferenza prova chat'),
      ('2023','ces23','0','/uploads/img/logostock.jpg','attiva','consumer electronics show 23');


insert into DATACONFERENZA(giorno,annoEdizioneConferenza,acronimoConferenza)
values('2020-09-01','2020','ces20'),
#       ('2020-09-02','2020','ces20'),
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
      ('14','4','11:00:00','12:00:00','2'),
      ('15','4','12:00:00','14:00:00','3'),
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
      ('admin1','2022','mlpast'),
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
      ('540800','2021','ces21','nokia'),
      ('789900','2022','ces22','apple'),
      ('6700','2022','mlfuture','samsung'),
      ('900','2022','mlpast','olivetti'),
      ('200','2022','ss1','nokia'),
      ('5300','2022','prvcht','apple'),
      ('5400','2023','ces23','olivetti');

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


insert into PRESENTAZIONESPEAKER(userNameUtente, titoloTutorial, codicePresentazione, codiceSessione, linkWeb, descrizione)         # TUTORIAL     -------scrivere con selezioone verticale mouse
values('buzz','come vendere elettronica','1','1','link','lorem ipsum'),
      ('codgeruser','come programmare','6','2','link','lorem ipsum'),
      ('usermotion','come programmare','7','2','link','lorem ipsum'),
      ('userlard','come programmare','11','3','link','lorem ipsum'),
      ('fishuser','come programmare','13','4','link','lorem ipsum'),
      ('userflick','come programmare','14','4','link','lorem ipsum'),
      ('userpanties','come programmare','15','4','link','lorem ipsum'),
      ('relishuser','come programmare','19','5','link','lorem ipsum'),
      ('wearyuser','come programmare','20','5','link','lorem ipsum'),
      ('userpaperclips','come programmare','22','6','link','lorem ipsum'),
      ('userbottle','come programmare','23','6','link','lorem ipsum'),
      ('codgeruser','come programmare','24','6','link','lorem ipsum'),
      ('usermotion','come programmare','25','6','link','lorem ipsum'),
      ('userlard','come programmare','31','7','link','lorem ipsum'),
      ('fishuser','come programmare','32','7','link','lorem ipsum'),
      ('userflick','come programmare','33','7','link','lorem ipsum'),
      ('userpanties','come programmare','34','7','link','lorem ipsum'),
      ('relishuser','come programmare','40','8','link','lorem ipsum'),
      ('wearyuser','come programmare','41','8','link','lorem ipsum'),
      ('userpaperclips','come programmare','42','8','link','lorem ipsum'),
      ('userbottle','come programmare','43','8','link','lorem ipsum'),
      ('codgeruser','come programmare','49','9','link','lorem ipsum'),
      ('usermotion','come programmare','50','9','link','lorem ipsum'),
      ('userlard','come programmare','51','9','link','lorem ipsum'),
      ('fishuser','come programmare','52','9','link','lorem ipsum'),
      ('userflick','come programmare','58','10','link','lorem ipsum'),
      ('userpanties','come programmare','59','10','link','lorem ipsum'),
      ('relishuser','come programmare','60','10','link','lorem ipsum'),
      ('wearyuser','come programmare','61','10','link','lorem ipsum'),
      ('userpaperclips','come programmare','67','11','link','lorem ipsum'),
      ('userbottle','come programmare','68','11','link','lorem ipsum'),
      ('codgeruser','come programmare','69','11','link','lorem ipsum'),
      ('usermotion','come programmare','70','11','link','lorem ipsum'),
      ('fishuser','come programmare','76','12','link','lorem ipsum'),
      ('userflick','come programmare','77','12','link','lorem ipsum'),
      ('userpanties','come programmare','78','12','link','lorem ipsum'),
      ('relishuser','come programmare','79','12','link','lorem ipsum'),
      ('wearyuser','come programmare','85','13','link','lorem ipsum'),
      ('userpaperclips','come programmare','86','13','link','lorem ipsum'),
      ('userbottle','come programmare','87','13','link','lorem ipsum'),
      ('codgeruser','come programmare','88','13','link','lorem ipsum');





insert into PRESENTAZIONEPRESENTER(userNameUtente, titoloArticolo, codicePresentazione, codiceSessione)                            #  ARTICOLO
values('lightyear','electronic consumers','3','1'),
      ('usereastern','electronic consumers','4','1'),
      ('dogwatchuser','electronic consumers','8','2'),
      ('userjapan','electronic consumers','9','2'),
      ('spanishuser','electronic consumers','10','2'),
      ('userfeisty','electronic consumers','12','3'),
      ('userburnished','electronic consumers','16','4'),
      ('userbong','electronic consumers','17','4'),
      ('userfez','electronic consumers','18','4'),
      ('userurn','electronic consumers','21','5'),
      ('usermarbled','electronic consumers','26','6'),
      ('lightyear','electronic consumers','27','6'),
      ('usereastern','electronic consumers','28','6'),
      ('dogwatchuser','electronic consumers','29','6'),
      ('userjapan','electronic consumers','30','6'),
      ('spanishuser','electronic consumers','35','7'),
      ('userfeisty','electronic consumers','36','7'),
      ('userburnished','electronic consumers','37','7'),
      ('userbong','electronic consumers','38','7'),
      ('userfez','electronic consumers','39','7'),
      ('userurn','electronic consumers','44','8'),
      ('usermarbled','electronic consumers','45','8'),
      ('lightyear','electronic consumers','46','8'),
      ('usereastern','electronic consumers','47','8'),
      ('dogwatchuser','electronic consumers','48','8'),
      ('userjapan','electronic consumers','53','9'),
      ('spanishuser','electronic consumers','54','9'),
      ('userfeisty','electronic consumers','55','9'),
      ('userburnished','electronic consumers','56','9'),
      ('userbong','electronic consumers','57','9'),
      ('userfez','electronic consumers','62','10'),
      ('userurn','electronic consumers','63','10'),
      ('usermarbled','electronic consumers','64','10'),
      ('lightyear','electronic consumers','65','10'),
      ('usereastern','electronic consumers','66','10'),
      ('dogwatchuser','electronic consumers','71','11'),
      ('userjapan','electronic consumers','72','11'),
      ('spanishuser','electronic consumers','73','11'),
      ('userfeisty','electronic consumers','74','11'),
      ('userburnished','electronic consumers','75','11'),
      ('userfez','electronic consumers','80','12'),
      ('userurn','electronic consumers','81','12'),
      ('usermarbled','electronic consumers','82','12'),
      ('lightyear','electronic consumers','83','12'),
      ('usereastern','electronic consumers','84','12'),
      ('usereastern','electronic consumers','89','13'),
      ('dogwatchuser','electronic consumers','90','13'),
      ('userjapan','electronic consumers','91','13'),
      ('spanishuser','electronic consumers','92','13'),
      ('userfeisty','electronic consumers','93','13');


# insert into PAROLACHIAVE(parola, codicePresentazione, codiceSessione)
#                 values();

insert into VALUTAZIONE(userNameUtente, codicePresentazione, codiceSessione, voto, note)
values ('admin1','1','1','4','recensione lorem ipsum'),
       ('admin2','2','1','4','recensione lorem ipsum'),
       ('admin3','3','1','4','recensione lorem ipsum'),
       ('admin2','4','1','5','seconda recensione lorem ipsum'),
       ('admin4','5','2','2','questa presentazione e` brutta'),
       ('admin4','6','2','4','recensione lorem ipsum'),
       ('admin1','7','2','4','recensione lorem ipsum'),
       ('admin2','8','2','4','recensione lorem ipsum'),
       ('admin3','9','2','4','recensione lorem ipsum'),
       ('admin2','11','3','3','recensione lorem ipsum'),
       ('admin3','12','3','3','recensione lorem ipsum'),
       ('admin4','13','4','3','recensione lorem ipsum'),
       ('admin1','14','4','3','recensione lorem ipsum'),
       ('admin2','15','4','3','recensione lorem ipsum'),
       ('admin3','16','4','3','recensione lorem ipsum'),
       ('admin2','17','4','3','recensione lorem ipsum'),
       ('admin3','18','4','3','recensione lorem ipsum'),
       ('admin4','19','5','3','recensione lorem ipsum'),
       ('admin1','20','5','3','recensione lorem ipsum'),
       ('admin2','21','5','3','recensione lorem ipsum'),
       ('admin3','22','6','3','recensione lorem ipsum'),
       ('admin2','23','6','3','recensione lorem ipsum'),
       ('admin3','24','6','4','recensione lorem ipsum'),
       ('admin4','25','6','4','recensione lorem ipsum'),
       ('admin1','26','6','4','recensione lorem ipsum'),
       ('admin2','27','6','4','recensione lorem ipsum'),
       ('admin3','28','6','4','recensione lorem ipsum'),
       ('admin2','29','6','4','recensione lorem ipsum'),
       ('admin3','30','6','4','recensione lorem ipsum'),
       ('admin4','31','7','4','recensione lorem ipsum'),
       ('admin1','32','7','4','recensione lorem ipsum'),
       ('admin2','33','7','4','recensione lorem ipsum'),
       ('admin3','34','7','4','recensione lorem ipsum'),
       ('admin2','35','7','7','recensione lorem ipsum'),
       ('admin3','36','7','7','recensione lorem ipsum'),
       ('admin4','37','7','7','recensione lorem ipsum'),
       ('admin1','38','7','7','recensione lorem ipsum'),
       ('admin2','39','7','7','recensione lorem ipsum'),
       ('admin3','40','8','7','recensione lorem ipsum'),
       ('admin2','41','8','7','recensione lorem ipsum'),
       ('admin3','42','8','7','recensione lorem ipsum'),
       ('admin4','43','8','9','recensione lorem ipsum'),
       ('admin1','44','8','9','recensione lorem ipsum'),
       ('admin2','45','8','9','recensione lorem ipsum'),
       ('admin3','46','8','9','recensione lorem ipsum'),
       ('admin2','47','8','9','recensione lorem ipsum'),
       ('admin3','48','8','9','recensione lorem ipsum'),
       ('admin1','49','9','3','recensione lorem ipsum'),
       ('admin2','50','9','6','recensione lorem ipsum'),
       ('admin3','51','9','9','recensione lorem ipsum'),
       ('admin2','52','9','3','recensione lorem ipsum'),
       ('admin4','53','9','6','recensione lorem ipsum'),
       ('admin4','54','9','9','recensione lorem ipsum'),
       ('admin1','55','9','3','recensione lorem ipsum'),
       ('admin2','56','9','6','recensione lorem ipsum'),
       ('admin3','57','9','9','recensione lorem ipsum'),
       ('admin1','58','10','3','recensione lorem ipsum'),
       ('admin2','59','10','6','recensione lorem ipsum'),
       ('admin3','60','10','9','recensione lorem ipsum'),
       ('admin2','61','10','3','recensione lorem ipsum'),
       ('admin1','62','10','6','recensione lorem ipsum'),
       ('admin2','63','10','9','recensione lorem ipsum'),
       ('admin3','64','10','3','recensione lorem ipsum'),
       ('admin2','65','10','6','recensione lorem ipsum'),
       ('admin3','66','10','9','recensione lorem ipsum'),
       ('admin4','67','11','3','recensione lorem ipsum'),
       ('admin1','68','11','6','recensione lorem ipsum'),
       ('admin2','69','11','9','recensione lorem ipsum'),
       ('admin3','70','11','3','recensione lorem ipsum'),
       ('admin2','71','11','6','recensione lorem ipsum'),
       ('admin3','72','11','9','recensione lorem ipsum'),
       ('admin4','73','11','3','recensione lorem ipsum'),
       ('admin1','74','11','6','recensione lorem ipsum'),
       ('admin2','75','11','9','recensione lorem ipsum'),
       ('admin3','76','12','3','recensione lorem ipsum'),
       ('admin2','77','12','6','recensione lorem ipsum'),
       ('admin3','78','12','9','recensione lorem ipsum'),
       ('admin4','79','12','3','recensione lorem ipsum'),
       ('admin1','80','12','6','recensione lorem ipsum'),
       ('admin2','81','12','9','recensione lorem ipsum'),
       ('admin3','82','12','3','recensione lorem ipsum'),
       ('admin2','83','12','6','recensione lorem ipsum'),
       ('admin3','84','12','9','recensione lorem ipsum'),
       ('admin3','85','13','3','recensione lorem ipsum'),
       ('admin2','86','13','6','recensione lorem ipsum'),
       ('admin3','87','13','9','recensione lorem ipsum'),
       ('admin4','88','13','3','recensione lorem ipsum'),
       ('admin1','89','13','6','recensione lorem ipsum'),
       ('admin2','90','13','9','recensione lorem ipsum'),
       ('admin3','91','13','3','recensione lorem ipsum'),
       ('admin2','92','13','6','recensione lorem ipsum'),
       ('admin3','93','13','9','recensione lorem ipsum');

