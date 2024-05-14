/*****
*Selecciona toda la tabla "Animated_Tv_Series"  y luego se seleccionan las peliculas, de la tabla "final_movies",
*que tengan en la columna g�nero (genre), el g�nero de animaci�n (Animation).
*****/
SELECT
	[Id],[Title]
FROM
	[Tarea_1].[dbo].[Animated_Tv_Series]
UNION ALL
SELECT
	[id] AS [Id],[title] AS[Title]
FROM
	[Tarea_1].[dbo].[final_movies]
WHERE
	[genre] LIKE '%Animation%';