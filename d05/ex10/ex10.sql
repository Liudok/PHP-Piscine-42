SELECT title as 'Title' , summary as 'Summary', prod_year
FROM db_lberezyn.film 
INNER JOIN db_lberezyn.genre using(id_genre)
WHERE (name = 'erotic')
ORDER BY prod_year
DESC
;