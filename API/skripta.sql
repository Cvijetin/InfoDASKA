drop database if exists daska_api;
create database daska_api character set utf8 collate utf8_general_ci;
use daska_api;

create  table autor(
sifra int not null primary key auto_increment,
ime varchar(50) not null,
prezime varchar(50)not null,
email varchar(50) not null,
fakultet varchar(250) not null,
datumprijave TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)engine=innodb CHARACTER SET utf8 COLLATE utf8_general_ci;

create  table rad(
sifra int not null primary key auto_increment,
naslov varchar(250) not null,
sazetak text not null,
kljucnerijeci varchar(250) not null,
pocetakizlaganja datetime,
krajizlaganja datetime,
radionica boolean default false
)engine=innodb CHARACTER SET utf8 COLLATE utf8_general_ci;

create table autorrad (
autor int references sifra(autor),
rad int references sifra(rad),
prvi boolean
)engine=innodb CHARACTER SET utf8 COLLATE utf8_general_ci;

create table svidamise (
sifra int not null primary key auto_increment,
imei varchar(50) not null,
rad int references sifra(rad)
)engine=innodb CHARACTER SET utf8 COLLATE utf8_general_ci;

insert into autor(ime,prezime,email,fakultet,datumprijave)
values("Jure", "Žilić", "jzilic@ffos.hr", "FFOS", now());

insert into rad (naslov, sazetak, kljucnerijeci)
values("Zaštita tigrova", "Plan o zaštiti ugroženih tigrova.", "tigar, zaštita, ugrožena vrsta");

select * from autor;

select * from rad;

select * from autorrad;

select * from svidamise;