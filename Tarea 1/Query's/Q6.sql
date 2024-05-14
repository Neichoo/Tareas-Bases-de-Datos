/*****
*Se selecciona el título y su canal original donde fue transmitido, de
*la primera tabla, donde su canal original sea 'Cartoon Network'.
*****/
SELECT
	[Title], [Original_channel]
FROM
	[Tarea_1].[dbo].[Animated_Tv_Series]
WHERE
	[Original_channel] = 'Cartoon Network';