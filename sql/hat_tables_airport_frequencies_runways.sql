use flightplandb;
create table airport_runway
(
icao varchar(4),
runway_id int,
foreign key (icao) references airports(icao),
foreign key (runway_id) references runways(id)
);

create table airport_frequencies
(
icao varchar(4),
atis_id int,
delivery_id int,
ground_id int,
tower_id int,
approach_id int,

foreign key (icao) references airports(icao),
foreign key (atis_id) references atis(id),
foreign key (delivery_id) references delivery(id),
foreign key (ground_id) references ground(id),
foreign key (tower_id) references tower(id),
foreign key (approach_id) references approach(id)

);