/*****
*Se seleccionan los 5 primeros t�tulos con su calificaci�n IMDb, de la primera tabla,
*donde el canal original sea el deseado a consultar, ordenados por su calificaci�n IMDb
*de manera descendiente.
*****/
SELECT TOP 5
	[Title], [IMDb]
FROM
	[Tarea_1].[dbo].[Animated_Tv_Series]
WHERE
	[Original_channel] = 'Nickelodeon'
ORDER BY
	[IMDb] DESC;