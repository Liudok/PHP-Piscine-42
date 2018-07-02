SELECT title, summary
FROM db_lberezyn.film
WHERE (LOWER(summary) LIKE '%vincent%')
ORDER BY id_film ASC
;