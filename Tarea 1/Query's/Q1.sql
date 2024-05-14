/*****
*Se selecciona cada título con su año de lanzamiento, obtenido de la tabla 'Animated_Tv_Series',
*luego se ordena de manera ascendente.
*****/
SELECT 
	[Title], LEFT([Year],4) AS [Release_Year]
FROM
	[Tarea_1].[dbo].[Animated_Tv_Series]
ORDER BY
	LEFT([Year],4) ASC;