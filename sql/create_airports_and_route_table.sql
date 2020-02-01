use flightplandb;

create table airports
(
icao varchar(4),
flughafen_name varchar(100),
primary key(icao)
);

create table routen 
(
id int auto_increment,
route varchar(7500),
treibstoff varchar(15),
start_flughafen varchar(4),
ziel_flughafen varchar(4),
foreign key(start_flughafen) references airports(icao),
foreign key (ziel_flughafen) references airports(icao),
primary key(id)
);