/*****
*Selecciona toda la tabla "Animated_Tv_Series"  y luego se seleccionan las peliculas, de la tabla "final_movies",
*que tengan en la columna género (genre), el género de animación (Animation).
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