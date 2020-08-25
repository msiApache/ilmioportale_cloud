create table vehicles
(
    id                    integer auto_increment primary key,
    classe                varchar(50) null,
    targa                 varchar(50) not null,
    modello               varchar(50) null,
    scad_assicurazione date        null,
    scad_bollo         date        null,
    scad_revisione     date        null,
    km_ult_rev          decimal     null
);

insert into vehicles (classe, targa, modello, scad_assicurazione, scad_bollo, scad_revisione, km_ult_rev)
VALUES ('MOTOVEICOLO', 'BK06912', 'APRILIA PEGASO 650', '2014-01-01', '2021-01-01', '2014-01-01', '5876');
insert into vehicles (classe, targa, modello, scad_assicurazione, scad_bollo, scad_revisione, km_ult_rev)
VALUES ('MOTOVEICOLO', 'DJ70083', 'SUZUKI GSR 600', '2020-10-05', '2021-07-01', '2021-04-02', '15050');
insert into vehicles (classe, targa, modello, scad_assicurazione, scad_bollo, scad_revisione, km_ult_rev)
VALUES ('AUTOVEICOLO', 'CP566FX', 'OPEL ASTRA H', '2021-01-07', '2020-08-31', '2021-09-03', '288658');
insert into vehicles (classe, targa, modello, scad_assicurazione, scad_bollo, scad_revisione, km_ult_rev)
VALUES ('AUTOVEICOLO', 'DV978EF', 'OPEL INSIGNIA', '2020-11-09', '2020-08-31', '2021-12-27', '75115');