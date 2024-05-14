/*****
*Se agrupan los registros por a�o de lanzamiento, llevando un contador,
*luego se conservar�n los que tengan m�s de 5 registros.
*****/
SELECT
	SUBSTRING([Year],1,4) AS [Release_Year], COUNT(*) AS [Total]
FROM	
	[Tarea_1].[dbo].[Animated_Tv_Series]
GROUP BY
	SUBSTRING([Year],1,4)
HAVING
	COUNT(*) > 5;