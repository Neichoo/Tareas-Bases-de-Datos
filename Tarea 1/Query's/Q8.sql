/*****
*Se selecciona el título con su calificación de Google_users,
*de la primera tabla, siempre y cuando su porcentaje sea menor a un 30%,
*buscando así las peores.
*****/
SELECT
	[Title], [Google_users]
FROM
	[Tarea_1].[dbo].[Animated_Tv_Series]
WHERE
	CAST(REPLACE([Google_users], '%', '') AS INT) <30;