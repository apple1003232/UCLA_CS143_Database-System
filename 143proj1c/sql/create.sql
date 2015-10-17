create table Movie (
	id int not null,
	/*each movie should has an id.*/
	title varchar(100) not null,
	/*each movie should has a title.*/
	year int not null,
	/*each movie should has its production year.*/
	rating varchar(10),
	company varchar(50) not null,
	/*each movie should has its company*/
	primary key (id) /*each movie has a unique identification number.*/
) ENGINE = INNODB;

create table Actor (
	id int not null,
	last varchar(20) not null,
	first varchar(20) not null,
	sex varchar(6) not null,
	dob date not null,
	dod date,
	primary key (id)/*each actor has a unique identification number.*/
) ENGINE = INNODB;

create table Director(
	id int not null,
	last varchar(20) not null,
	first varchar(20) not null,
	dob date not null,
	dod date,
	primary key (id)/*each director has a unique identification number.*/
) ENGINE = INNODB;

create table MovieGenre(
	mid int not null,
	genre varchar(20) not null,
	primary key (mid,genre),/*mid and genre of each movie should be unique.*/
	foreign key (mid) references Movie(id)/*movie id which does not exist in Movie should not be inserted.*/
) ENGINE = INNODB;

create table MovieDirector(
	mid int not null,
	did int not null,
	primary key (mid,did),/*mid and did of each movie should be unique.*/
	foreign key (mid) references Movie(id),/*movie id which does not exist in Movie should not be inserted.*/
	foreign key (did) references Director(id)/*director id which does not exist in Director should not be inserted.*/
) ENGINE = INNODB;

create table MovieActor(
	mid int not null,
	aid int not null,
	role varchar(50) not null,
	primary key (mid,aid),/*mid and aid of each movie should be unique.*/
	foreign key (mid) references Movie(id),/*movie id which does not exist in Movie should not be inserted.*/
	foreign key (aid) references Actor(id)/*actor id which does not exist in Actor should not be inserted.*/
) ENGINE = INNODB;

create table Review(
	name varchar(20) not null,
	time timestamp not null,
	mid int not null,
	rating int,
	comment varchar(500) not null,
	foreign key (mid) references Movie(id)/*one can only write reviews about movies which exist in Movie.*/
) ENGINE = INNODB;

create table MaxPersonID(
	id int not null/*maintain the largest ID number that the system has assigned to a person so far*/
);

create table MaxMovieID(
	id int not null/*maintain the largest ID number that the system has assigned to a movie so far*/
);




























