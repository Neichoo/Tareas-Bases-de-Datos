/*****
*Se selecciona cada t�tulo con sus episodios, de la tabla 'Animated_Tv_Series',
*luego se filtran por los que tengan m�s de 100 episodios.
*****/
SELECT
	[Title], [Episodes]
FROM
	[Tarea_1].[dbo].[Animated_Tv_Series]
WHERE
	[Episodes] > 100;