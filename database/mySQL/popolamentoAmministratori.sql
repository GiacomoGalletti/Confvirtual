# POPOLAMENTO DB
use confvirtual;
insert into UTENTE(userName,nome,cognome,pswd,luogoNascita,dataNascita) values ('admin1','Gianni','Verdi','admin1','Bologna','2000/12/31');
insert into amministratore(userNameUtente) values ('admin1');