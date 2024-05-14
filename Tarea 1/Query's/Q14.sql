/*****
*Se obtuvieron los datos que estaban en las 2 tablas a la vez, utilizando join.
*****/
SELECT
	t1.title, t1.released_year, t1.rated_class, t1.run_time, t1.stars, t1.total_ratings, t2.Episodes, t2.[Year], t2.Original_channel, t2.American_company, t2.Technique, t2.IMDb, t2.Google_users
FROM
	[Tarea_1].[dbo].[final_movies] t1
JOIN
	[Tarea_1].[dbo].[Animated_Tv_Series] t2 ON t2.PeliculaId = t1.id
WHERE
	t1.run_time is not null and t2.Episodes is not null;