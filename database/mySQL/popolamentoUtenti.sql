# POPOLAMENTO DB

use confvirtual;
insert into UTENTE(userName,nome,cognome,pswd,luogoNascita,dataNascita)

values ('admin1','Gianni','Verdi','admin1','Bologna','2000/12/31'),                     #admin
       ('admin2','Enzo','Rossi','admin2','Bologna','2000/11/21'),
       ('admin3','Piero','Gialli','admin3','Bologna','2000/12/20'),
       ('admin4','Nonni','Rosi','admin4','Bologna','2000/10/19'),

       ('admin5','Giannino','Verdi','admin5','Bologna','2000/12/31'),
       ('admin6','Enzino','Rossi','admin6','Bologna','2000/11/21'),
       ('admin7','Pierino','Gialli','admin7','Bologna','2000/12/20'),
       ('admin8','Nonnino','Rosi','admin8','Bologna','2000/10/19'),

       ('userone','Giacomo','Neri','userone','Bologna','2001/12/31'),                   #generici
       ('usertwo','Edoardo','Bianchi','usertwo','Bologna','2002/12/31'),
       ('userthree','Stefano','Rovi','userthree','Bologna','2003/12/31'),
       ('userfour','Lorenzo','Ronni','userfour','Bologna','2004/12/31'),
       ('userfive','Giovanni','Verdi','userfive','Bologna','2004/12/31'),
       ('usersix','Giorgio','Rossi','usersix','Bologna','2004/12/31'),
       ('userseven','Luca','Nerini','userseven','Bologna','2004/12/31'),
       ('usereight','Pierpaolo','Bianchini','usereight','Bologna','2004/12/31'),
       ('usernine','Piergiorgio','Rossini','usernine','Bologna','2004/12/31'),
       ('userten','Piergiovanni','Verdini','userten','Bologna','2004/12/31'),

       ('buzz','Giannino','Verdi','buzz','Bologna','2005/12/31'),                       #speaker
       ('codgeruser','Lydia','Conn','codgeruser','Imola','2003/03/20'),
       ('usermotion','Joy','Turner','usermotion','Imola','2003/03/20'),
       ('userlard','Olaf','Jerde','userlard','Imola','2003/03/20'),
       ('fishuser','Lacey','Ward','fishuser','Imola','2003/03/20'),
       ('userflick','Vida','Mertz','userflick','Imola','2003/03/20'),
       ('userpanties','Hollis','Orn','userpanties','Imola','2003/03/20'),
       ('relishuser','Matt','Lemke','relishuser','Imola','2003/03/20'),
       ('wearyuser','Ken','Harris','wearyuser','Imola','2003/03/20'),
       ('userpaperclips','Kyle','Ortiz','userpaperclips','Imola','2003/03/20'),
       ('userbottle','Myrna','Howe','userbottle','Imola','2003/03/20'),


       ('lightyear','Gianni','Verdi','lightyear','Bologna','2006/12/31'),                #presenter
       ('usereastern','Kim','Brekke','usereastern','Bologna','2006/12/31'),
       ('dogwatchuser','Rey','Grimes','dogwatchuser','Bologna','2006/12/31'),
       ('userjapan','Rene','Terry','userjapan','Bologna','2006/12/31'),
       ('spanishuser','Niko','Ferry','spanishuser','Bologna','2006/12/31'),
       ('userfeisty','Jan','Ryan','userfeisty','Bologna','2006/12/31'),
       ('userburnished','Hester','Orn','userburnished','Bologna','2006/12/31'),
       ('userbong','Lloyd','Koch','userbong','Bologna','2006/12/31'),
       ('userfez','Aric','Marks','userfez','Bologna','2006/12/31'),
       ('userurn','Reese','Yost','userurn','Bologna','2006/12/31'),
       ('usermarbled','Kaya','Jones','usermarbled','Bologna','2006/12/31');

insert into amministratore(userNameUtente)
values ('admin1'),
       ('admin2'),
       ('admin3'),
       ('admin4'),

       ('admin5'),
       ('admin6'),
       ('admin7'),
       ('admin8');