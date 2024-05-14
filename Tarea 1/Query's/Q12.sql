/*****
*Se transforman los tiempos de duraci�n, de la tabla 2, a minutos para trabajar m�s f�cil con ellos,
*luego se obtiene el promedio de las duraciones de las pel�culas, siempre y cuando su tiempo no sea nulo.
*****/
SELECT
	convert(varchar, ([result] / 60)) + 'h ' + convert(varchar, ([result] % 60)) + 'm' AS [Avg_Movies_Duration]
FROM
	(SELECT
		AVG(IIF(CHARINDEX('h', isnull([run_time], '')) > 0,
		left([run_time], CHARINDEX('h', [run_time]) -1) * 60, 0) + IIF(CHARINDEX('m', isnull([run_time], '')) > 0,
		replace(substring(run_time, CHARINDEX('h', [run_time]) + 1, len([run_time])), 'm', '') , 0)) as [result]
	FROM 
		[Tarea_1].[dbo].[final_movies]
	WHERE
		[run_time] is not null) AS [t1];
