use flightplandb;
create table runways
(
id int auto_increment,
richtung varchar(3),
primary key(id)
);

create table tower
(
id int auto_increment,
bezeichnung varchar(100),
frequenz varchar(7),
primary key(id)
);

create table delivery
(
id int auto_increment,
bezeichnung varchar(100),
frequenz varchar(7),
primary key(id)
);

create table ground
(
id int auto_increment,
bezeichnung varchar(100),
frequenz varchar(7),
primary key(id)
);

create table atis
(
id int auto_increment,
bezeichnung varchar(100),
frequenz varchar(7),
primary key(id)
);

create table approach
(
id int auto_increment,
bezeichnung varchar(100),
frequenz varchar(7),
primary key(id)
);



