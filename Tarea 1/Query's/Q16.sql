/*****
*Se agrega a un string separado por coma, juntando con union all, todas las
*peículas y series presentes en ambas tablas por año de lanzamiento.
*****/
SELECT
	t1.released_year as [released_year], STRING_AGG(t1.title, ', ') AS total
FROM
	[Tarea_1].[dbo].[final_movies] t1
WHERE
	t1.released_year is not NULL
GROUP BY
	t1.released_year
UNION ALL
SELECT
	LEFT([Year], 4) as [released_year], STRING_AGG(t2.title, ', ') AS total
FROM
	[Tarea_1].[dbo].[Animated_Tv_Series] t2
WHERE
	[YEAR] is not NULL
GROUP BY
	t2.[Year]
ORDER BY
	[released_year];