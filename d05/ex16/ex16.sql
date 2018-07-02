SELECT COUNT(*) AS 'movies'
FROM db_lberezyn.member_history
WHERE (DATE(date) > CAST("2006-10-30" AS DATE) AND DATE(date) < CAST("2007-07-27" AS DATE))
OR (MONTH(date) = 12 AND DAY(date) = 24)
;