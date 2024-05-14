/*****
*Se agrupan los registros por año de lanzamiento, llevando un contador,
*luego se conservarán los que tengan más de 5 registros.
*****/
SELECT
	SUBSTRING([Year],1,4) AS [Release_Year], COUNT(*) AS [Total]
FROM	
	[Tarea_1].[dbo].[Animated_Tv_Series]
GROUP BY
	SUBSTRING([Year],1,4)
HAVING
	COUNT(*) > 5;