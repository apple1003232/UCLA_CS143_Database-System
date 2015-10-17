--1.The names of all the actors in the movie 'Die Another Day'.
select concat(a.first,' ' , a.last)
from Movie as m, Actor as a, MovieActor as ma
where m.title = 'Die Another Day' and m.id = ma.mid and ma.aid = a.id;


--2.The count of all the actors who acted in multiple movies.
select count(*) 
from  (select ma.aid
		from MovieActor as ma
		group by ma.aid 
		having count(ma.mid) > 1) as num;


--3.The count of directors who had direct Crime movie before.
select count(distinct d.id) as director_id
from Director d, MovieGenre mg, MovieDirector md 
where mg.genre = 'Crime' and mg.mid = md.mid and md.did = d.id;


--4.List Movie id , Movie title and the number of actors in every movie directed by Ang Lee.
select m.id, m.title, count(distinct ma.aid) as actor_count
from Director d, MovieDirector md, Movie as m, MovieActor as ma
where d.last = 'Lee' and d.first = 'Ang' and d.id = md.did and m.id = md.mid and m.id = ma.mid
group by ma.mid;

--5. Another query I came up with:
--List Movie id, Movie title, Movie company
--of a production company, whose name includes 'Fox'.
--Only list movies producted in 2002.
select m.id, m.title, m.year, m.company
from Movie m
where company like '%Fox' and m.year = 2002
order by m.id;

