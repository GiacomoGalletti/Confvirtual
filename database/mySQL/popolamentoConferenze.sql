use confvirtual;
delete from conferenza;

insert into conferenza(annoEdizione, acronimo, nome)
values (2020, 'inf', 'informatica');

insert into conferenza(annoEdizione, acronimo, nome)
values (2022, 'bio', 'biologia');

insert into conferenza(annoEdizione, acronimo, nome)
values (2022, 'inf1', 'informatica1');

select * from conferenza;