SELECT floor_number as 'floor', SUM(nb_seats) as 'seats'
FROM db_lberezyn.cinema
GROUP BY floor_number
ORDER BY SUM(nb_seats) DESC
;