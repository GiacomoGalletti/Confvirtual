# POPOLAMENTO DB

use confvirtual;
insert into UTENTE(userName,nome,cognome,pswd,luogoNascita,dataNascita)
            values ('admin1','Gianni','Verdi','admin1','Bologna','2000/12/31'),
                   ('admin2','Gianni','Verdi','admin2','Bologna','2000/11/21'),
                   ('admin3','Gianni','Verdi','admin3','Bologna','2000/12/20'),
                   ('admin4','Gianni','Verdi','admin4','Bologna','2000/10/19'),
                   ('userone','Gianni','Verdi','userone','Bologna','2001/12/31'),
                   ('usertwo','Gianni','Verdi','usertwo','Bologna','2002/12/31'),
                   ('userthree','Gianni','Verdi','userthree','Bologna','2003/12/31'),
                   ('userfour','Gianni','Verdi','userfour','Bologna','2004/12/31'),
                   ('buzz','Gianni','Verdi','buzz','Bologna','2005/12/31'),
                   ('lightyear','Gianni','Verdi','lightyear','Bologna','2006/12/31')
                   ;

insert into amministratore(userNameUtente) values ('admin1'),('admin2'),('admin3'),('admin4');
