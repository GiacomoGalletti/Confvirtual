use confvirtual;

delete from dataconferenza;
delete from conferenza;
delete from creatoriconferenza;

call createConference(2022, 'inf', 'no-image', 'informatica', 'admin1');
call aggiungiData('2022-04-28', 2022, 'inf');
call createConference(2022, 'bio', 'no-image', 'biologia', 'admin1');
call aggiungiData('2022-05-20', 2022, 'bio');
call createConference(2022, 'eco', 'no-image', 'economia', 'admin1');
call aggiungiData('2022-04-25', 2022, 'eco');
call aggiungiData('2022-04-22', 2022, 'eco');
call createConference(2022, 'sci', 'no-image', 'scienze', 'admin1');
call aggiungiData('2022-04-24', 2022, 'sci');
call aggiungiData('2022-05-10', 2022, 'sci');
call aggiungiData('2022-04-26', 2022, 'sci');
call aggiungiData('2022-04-28', 2022, 'sci');
call aggiungiData('2022-04-22', 2022, 'sci');
call createConference(2022, 'rel', 'no-image', 'religione', 'admin1');
call aggiungiData('2022-04-22', 2022, 'rel');
call aggiungiData('2022-04-19', 2022, 'rel');
call aggiungiData('2022-04-21', 2022, 'rel');
call createConference(2022, 'art', 'no-image', 'arte', 'admin1');
call aggiungiData('2022-04-23', 2022, 'art');
call aggiungiData('2022-04-24', 2022, 'art');
call aggiungiData('2022-04-25', 2022, 'art');
call createConference(2022, 'arc', 'no-image', 'architettura', 'admin1');
call aggiungiData('2022-04-24', 2022, 'arc');
call aggiungiData('2022-04-22', 2022, 'arc');
call createConference(2022, 'geo', 'no-image', 'geografia', 'admin1');
call aggiungiData('2022-04-20', 2022, 'geo');
call aggiungiData('2022-04-22', 2022, 'geo');

select * from conferenza;
select * from dataconferenza;

-- select max(giorno) from dataconferenza where acronimoConferenza = 'sci';