/*****
*Se juntan todos los géneros de las películas, seperados mediante coma.
*****/
SELECT
	STRING_AGG(t1.value, ', ') AS [Genres]
FROM 
	(SELECT DISTINCT s.value 
	 FROM [Tarea_1].[dbo].[final_movies] t
	 CROSS APPLY STRING_SPLIT(t.genre, '|') s) t1;