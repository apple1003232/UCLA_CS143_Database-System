--Tuple: 2184 Just Married 2003 PG-13 20th Century Fox
--has already existed in table Movie.
--Thus any tuples with id = 2184 should not be inserted into
--table Movie, for id is a primary key, 
--which means id is unique and not null .
--Otherwise, the terminal would show error like:
--ERROR 1062 (23000): Duplicate entry '2184' for key 1.
insert into Movie
	values(2184,'title',2007,'R','company');

--Attribute id, title, year and company
--should not be null, for constraints "not null".
--Otherwise, the terminal would show error like:
--ERROR 1048 (23000): Column 'id' cannot be null.--this error shows 4 times.
insert into Movie
	values(null,'title',2007,'R','company');
insert into Movie
	values(1,null,2007,'R','company');
insert into Movie
	values(1,'title',null,'R','company');
insert into Movie
	values(1,'title',2007,'R',null);

--Tuple: 23455 Goldsboro Bobby Male 1941-01-18 NULL
--has already existed in table Actor.
--Thus any tuples with id = 23455 should not be inserted into
--table Actor, for id is a primary key, 
--which means id is unique and not null .
--Otherwise, the terminal would show error like:
--ERROR 1062 (23000): Duplicate entry '23455' for key 1.
insert into Actor
	values(23455,'last','first','Male',1941-01-18,NULL);

--Tuple: 35962 Lee Ang 1954-10-23 NULL
--has already existed in table Director.
--Thus any tuples with id = 35962 should not be inserted into
--table Director, for id is a primary key, 
--which means id is unique and not null .
--Otherwise, the terminal would show error like:
--ERROR 1062 (23000): Duplicate entry '35962' for key 1.
insert into Director
	values(35962,'last','first',1941-01-18,NULL);

--Tuple: 2184 Comedy
--has already existed in table MovieGenre.
--Thus tuple with exact the same values should not be 
--inserted into table MovieGenre, 
--for (mid,genre) is a primary key, 
--which means (mid,genre) is unique and not null .
--Otherwise, the terminal would show error like:
--ERROR 1062 (23000): Duplicate entry '2184-Comedy' for key 1.
insert into MovieGenre
	values(2184,'Comedy');

--Tuple with id = 69000 does not exist in table Movie.
--Thus any tuples with id = 69000 should not be inserted into
--table MovieGenre, for mid is a foreign key, 
--which refers to table Movie.
--Otherwise, the terminal would show error like:
--ERROR 1452 (23000):Cannot add or update a child row: a foreign key constraint fails
-- ('CS143/MovieGenre', CONSTRAINT 'MovieGenre_ibfk_1' FOREIGEN KEY ('mid') REFERENCES
--'Movie' ('id'))
insert into MovieGenre
	values(69000,'Comedy');

--Tuple: 2183 844
--has already existed in table MovieDirector.
--Thus tuple with exact the same values should not be 
--inserted into table MovieDirector, 
--for (mid,did) is a primary key, 
--which means (mid,did) is unique and not null .
--Otherwise, the terminal would show error like:
--ERROR 1062 (23000): Duplicate entry '2184-844' for key 1.
insert into MovieDirector
	values(2183, 844);

--Tuple with id = 69000 does not exist in table Movie.
--Thus any tuples with mid = 69000 should not be inserted into
--table MovieDirector, for mid is a foreign key, 
--which refers to table Movie.
--Otherwise, the terminal would show error like:
--ERROR 1452 (23000):Cannot add or update a child row: a foreign key constraint fails
-- ('CS143/MovieDirector', CONSTRAINT 'MovieDirector_ibfk_1' FOREIGEN KEY ('mid') REFERENCES
--'Movie' ('id'))
insert into MovieDirector
	values(69000,844);

--Tuple with id = 69000 does not exist in table Director.
--Thus any tuples with did = 69000 should not be inserted into
--table MovieDirector, for did is a foreign key, 
--which refers to table Director.
--Otherwise, the terminal would show error like:
--ERROR 1452 (23000):Cannot add or update a child row: a foreign key constraint fails
-- ('CS143/MovieDirector', CONSTRAINT 'MovieDirector_ibfk_2' FOREIGEN KEY ('did') REFERENCES
--'Director' ('id'))
insert into MovieDirector
	values(2183,69000);

--Tuple: 2183 6870 Dr. Flynn
--has already existed in table MovieDirector.
--Thus tuple with exact the same values should not be 
--inserted into table MovieDirector, 
--for (mid,aid) is a primary key, 
--which means (mid,aid) is unique and not null .
--Otherwise, the terminal would show error like:
--ERROR 1062 (23000): Duplicate entry '2183-6870' for key 1.
insert into MovieActor
	values(2183, 6870,'role');

--Tuple with id = 69000 does not exist in table Movie.
--Thus any tuples with mid = 69000 should not be inserted into
--table MovieActor, for mid is a foreign key, 
--which refers to table Movie.
--Otherwise, the terminal would show error like:
--ERROR 1452 (23000):Cannot add or update a child row: a foreign key constraint fails
-- ('CS143/MovieActor', CONSTRAINT 'MovieActor_ibfk_1' FOREIGEN KEY ('mid') REFERENCES
--'Movie' ('id'))
insert into MovieActor
	values(69000,6870,'role');

--Tuple with id = 69000 does not exist in table Actor.
--Thus any tuples with aid = 69000 should not be inserted into
--table MovieActor, for did is a foreign key, 
--which refers to table Actor.
--Otherwise, the terminal would show error like:
--ERROR 1452 (23000):Cannot add or update a child row: a foreign key constraint fails
-- ('CS143/MovieActor', CONSTRAINT 'MovieActor_ibfk_1' FOREIGEN KEY ('aid') REFERENCES
--'Actor' ('id'))
insert into MovieActor
	values(2183,69000,'role');

--Tuple with id = 69000 does not exist in table Movie.
--Thus any tuples with mid = 69000 should not be inserted into
--table Review, for mid is a foreign key, 
--which refers to table Movie.
--Otherwise, the terminal would show error like:
--ERROR 1452 (23000):Cannot add or update a child row: a foreign key constraint fails
-- ('CS143/Review', CONSTRAINT 'Review_ibfk_1' FOREIGEN KEY ('mid') REFERENCES
--'Movie' ('id'))
insert into Review
	values('name',2006-03-10,69000,5,'comment');



