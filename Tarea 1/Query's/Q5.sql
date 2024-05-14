/*****
*Se calcula el promedio con 2 decimales (redondeado) de las
*'pel�culas animadas y series animadas de Netflix'.
*****/
SELECT
	CAST(ROUND(AVG([IMDb]), 2) AS NUMERIC(3,2)) AS Avg_IMdB
FROM
	[Tarea_1].[dbo].[Animated_Tv_Series]
WHERE
	[American_company] = 'Netflix Animation';