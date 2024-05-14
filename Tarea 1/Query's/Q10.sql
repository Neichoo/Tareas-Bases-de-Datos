/*****
*Se elimina de la tabla 1, todo lo que tenga una calificación IMDb menor a 3,
*siendo estas las peores evaluadas.
*****/
DELETE FROM
	[Tarea_1].[dbo].[Animated_Tv_Series]
WHERE
	ISNULL(imdb, 0) < 3;
