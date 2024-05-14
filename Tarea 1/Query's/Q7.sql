/*****
*Se selecciona el titulo con su calificación IMDb, de la primera
*tabla, ordenando respecto a la calificación IMDb de manera descendente.
*****/
SELECT
	TOP 10 [Title],[IMDb]
FROM
	[Tarea_1].[dbo].[Animated_Tv_Series]
 ORDER BY
	[IMDb] DESC;