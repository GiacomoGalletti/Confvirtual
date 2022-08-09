# POPOLAMENTO DB

use confvirtual;
insert into UTENTE(userName,nome,cognome,pswd,luogoNascita,dataNascita)
            values ('admin1','Gianni','Verdi','admin1','Bologna','2000/12/31'),
                   ('admin2','Enzo','Rossi','admin2','Bologna','2000/11/21'),
                   ('admin3','Piero','Gialli','admin3','Bologna','2000/12/20'),
                   ('admin4','Nonni','Rosi','admin4','Bologna','2000/10/19'),
                   ('userone','Giacomo','Neri','userone','Bologna','2001/12/31'),
                   ('usertwo','Edoardo','Bianchi','usertwo','Bologna','2002/12/31'),
                   ('userthree','Stefano','Rovi','userthree','Bologna','2003/12/31'),
                   ('userfour','Lorenzo','Ronni','userfour','Bologna','2004/12/31'),
                   ('userfive','Giovanni','Verdi','userfive','Bologna','2004/12/31'),
                   ('usersix','Giorgio','Rossi','usersix','Bologna','2004/12/31'),
                   ('userseven','Luca','Nerini','userseven','Bologna','2004/12/31'),
                   ('usereight','Pierpaolo','Bianchini','usereight','Bologna','2004/12/31'),
                   ('usernine','Piergiorgio','Rossini','usernine','Bologna','2004/12/31'),
                   ('userten','Piergiovanni','Verdini','userten','Bologna','2004/12/31'),
                   ('buzz','Giannino','Verdi','buzz','Bologna','2005/12/31'),
                   ('lightyear','Gianni','Verdi','lightyear','Bologna','2006/12/31')
                   ;

insert into amministratore(userNameUtente)
                    values ('admin1'),
                           ('admin2'),
                           ('admin3'),
                           ('admin4');
