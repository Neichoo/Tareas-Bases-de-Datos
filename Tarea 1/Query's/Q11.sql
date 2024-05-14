/*****
*Se selecciona el top 1, con su título y sus episodios, de la tabla 1,
*ordenado de manera descendiente.
*****/
SELECT TOP 1
	[Title],[Episodes]
FROM
	[Tarea_1].[dbo].[Animated_Tv_Series]
ORDER BY
	[Episodes] DESC;