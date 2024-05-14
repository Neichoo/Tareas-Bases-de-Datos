/*****
*Se selecciona cada título con sus episodios, de la tabla 'Animated_Tv_Series',
*luego se filtran por los que tengan más de 100 episodios.
*****/
SELECT
	[Title], [Episodes]
FROM
	[Tarea_1].[dbo].[Animated_Tv_Series]
WHERE
	[Episodes] > 100;