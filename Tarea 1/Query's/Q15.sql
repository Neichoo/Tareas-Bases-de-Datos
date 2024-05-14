/*****
*Se obtienen todas las películas que empiecen por la letra 'C'.
*****/
SELECT *
FROM
	[Tarea_1].[dbo].[final_movies]
WHERE
	[title] LIKE 'C%';
